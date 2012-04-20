<?php

require 'models/om/BaseTourneyRoundStatusPeer.php';


/**
 * Skeleton subclass for performing query and update operations on the 'tourney_round_status' table.
 *
 * Status of a round of the tournament.
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    models
 */
class TourneyRoundStatusPeer extends BaseTourneyRoundStatusPeer {
	
	/**
	 * Generates the next round up in the fight bracket.
	 * 
	 * The next round will be generated and saved using the fights in the $t_pre_fights array (which
	 * should be all the fights of the previous round.) Fight pairings will be randomized. 
	 * Previous fights will have their parent field updated to refer to the correct fight in the new 
	 * round. Once finished, the function will return the object representing the new round and the 
	 * fights of the new round.
	 * 
	 * @return array 0=> TourneyRoundStatus, 1=> array(TourneyFights)
	 */
	public static function buildNextRound(array $t_pre_fights, TourneyRoundStatus $pre_round){
		
		$new_round = new TourneyRoundStatus();
		$new_round->setTourneyId($pre_round->getTourneyId());
		$new_round->setRoundNumber($pre_round->getRoundNumber() + 1);
		$new_round->save();
		
		shuffle($t_pre_fights);
		$t_cur_fights = array();
		while (!empty($t_pre_fights)){
			$t_cur_fight = new TourneyFights();
			$t_fight_left = array_pop($t_pre_fights);
			$t_fight_right = array_pop($t_pre_fights);
			
			$t_cur_fight->setTourneyId($new_round->getTourneyId());
			$t_cur_fight->setRoundNumber($new_round->getRoundNumber());
			$t_cur_fight->setChildLeft($t_fight_left->getId());
			$t_cur_fight->setChildRight($t_fight_right->getId());
			$t_cur_fight->setParent(null);
			
			$t_cur_fight->save();
			$t_cur_fights[] = $t_cur_fight;
			
			// Update children's parent pointer
			$t_fight_left->setParent($t_cur_fight->getId());
			$t_fight_right->setParent($t_cur_fight->getId());
			$t_fight_left->save();
			$t_fight_right->save();
		}
		
		return array($new_round, $t_cur_fights);
	}
	
	/**
	 * Generates the first round in the fight bracket.
	 * 
	 * The initial round of the fight (number 1) will be built using the provided $t_fighters array,
	 * which should contain all participaters in the tournament. First round pairings will be randomized.
	 * All fights will have their children point to NULL. Once finished, the function will return the object 
	 * representing the first round and the fights of the first round.
	 * 
	 * @return array 0=> TourneyRoundStatus, 1=> array(TourneyFights)
	 */
	public static function buildFirstRound(array $t_fighters, TourneyStatus $tourney){
		$round1 = new TourneyRoundStatus();
	    $round1->setTourneyId($tourney->getId());
	    $round1->setRoundNumber(1); 
	    $round1->save();
	     
	    // Populate Round 1
	    shuffle($t_fighters);
	    $t_round1_fights = array();
	    while (!empty($t_fighters)){
	    	$t_fighter1 = array_pop($t_fighters);
	    	$t_fighter2 = array_pop($t_fighters);
	     	
	     	$t_fight = new TourneyFights();
	     	$t_fight->setTourneyId($tourney->getId());
	     	$t_fight->setRoundNumber($round1->getRoundNumber());
	     	
	     	$t_fight->setOneId($t_fighter1->getFighterId());
	     	$t_fight->setTwoId($t_fighter2->getFighterId());
	     	$t_fight->setOneWins(0);
	     	$t_fight->setTwoWins(0);
	     	$t_fight->setChildLeft(null);
	     	$t_fight->setChildRight(null);
	     	$t_fight->setParent(null);
	     	
	     	$t_fight->save();
	     	$t_round1_fights[] = $t_fight;
	    }
	    
	    return array($round1, $t_round1_fights);
	}
	
	private static function buildRound(){
		
	}

} // TourneyRoundStatusPeer
