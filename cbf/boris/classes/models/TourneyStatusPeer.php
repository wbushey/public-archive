<?php

require 'models/om/BaseTourneyStatusPeer.php';


/**
 * Skeleton subclass for performing query and update operations on the 'tourney_status' table.
 *
 * General status of the tournament.
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    models
 */
class TourneyStatusPeer extends BaseTourneyStatusPeer {

	/**
	 * Creates a new tournament using the provided participants.
	 * 
	 * A new TourneyStatus object will be created, along with all required TourneyFighters,
	 * TourneyRoundStatus and TourneyFights objects. The tree structure
	 * of the bracket will be defined, along with relationships between parent
	 * and children fights. When finished, the TourneyStatus object will be returned.
	 * 
	 * @return TourneyStatus
	 */
	public static function buildNewTournament(array $fighterIds){
		
		// Create Tourney object
		$tourney = new TourneyStatus();
        $tourney->save();
        
        // Write the list of fighters to the database
        $t_fighters = array();
        foreach($fighterIds as $cID){
        	$t_fighter = new TourneyFighters();
        	$t_fighter->setTourneyId($tourney->getId());
        	$t_fighter->setFighterId($cID);
        	$t_fighter->save();
        	$t_fighters[] = $t_fighter;
        }
        
        /* Time to build the tree
         * To create random first round fights we create a permutation of the array
         * of fighters, than pop two fighters off at a time and pair them off
         */
         
         // Initalize Round 1
         list($round1, $tfights) = TourneyRoundStatusPeer::buildFirstRound($t_fighters, $tourney);
         $round = $round1;
         
         // Build other rounds
         while (count($tfights) > 1){
         	list($round, $tfights) = TourneyRoundStatusPeer::buildNextRound($tfights, $round);
         }
         
        // Set some status variables for the tournament
        $nowTimestamp = time(); date("Y-m-d H:i:s");
        $startTime = date("Y-m-d H:i:s", $nowTimestamp);
        $endTime = strtotime("+2 weeks", $nowTimestamp);
        $tourney->setStartTime($startTime);
        $round1->setRoundStartTime($startTime);
        $round1->setRoundEndTime($endTime);
        
        $tourney->setRoundNumber(1);
        $tourney->setRoot($tfights[0]->getId());
        
        $round1->save();
        $tourney->save();
        
        return $tourney;
	}

} // TourneyStatusPeer
