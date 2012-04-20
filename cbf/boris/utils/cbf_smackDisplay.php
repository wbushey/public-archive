<?php
/**
 * Definition of a simple struct like class for holding information about smack in
 * a way that is easily accessable by the templates.
 * 
 * @author: Bill Bushey <wbushey@acm.org>
 * Last Updated: 7/27/08
 */

class cbf_SmackDisplay{
    public $username;               // Username of the person who posted the smack
    public $user_id;                // Id of the user who posted the smack
    public $fight;                  // Text of the fight that this smack belongs to
    public $fight_id;               // Id of the fight that this smack belongs to
    public $date;                   // Date and time of the posting
    public $body;                   // Body of the smack
    public $body_for_input;         // Body of the smack that has been processed for editing
    public $smack_id;               // Id of the post
}
?>