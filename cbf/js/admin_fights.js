/*
 * Functions used in the admin/fights view.
 *
 * Author: Bill Bushey <wbushey@acm.org>
 * Last Updated: 7/27/08
 */
 
 
/*
 * Display a warning/question about the removal of a fight.
 */
function show_remove_fight(){
    setSize('remove_fight_div', 400, 100);
    setVisible('remove_fight_div');
}

/*
 * Close the warning/question about the removal of a fight.
 */
function close_remove_fight(){
    setVisible('remove_fight_div', false);
}

/*
 * Display a warning/question about the removal of a fight.
 */
function show_edit_post(post_id){
    setSize('edit_post_div', 600, 400);
    textarea = document.getElementById('edit_post_text');
    textarea.value = document.getElementById('smack_body_for_input_' + post_id).innerHTML;
    document.getElementById('post_to_edit').value = post_id;
    setVisible('edit_post_div');
}

/*
 * Close the warning/question about the removal of a fight.
 */
function close_edit_post(){
    setVisible('edit_post_div', false);
}
 

/*
 * Display a warning/question about the removal of a post.
 */
function show_remove_post(post_id){
    setSize('remove_post_div', '400', '100');
    post_to_remove = document.getElementById('post_to_remove');
    post_to_remove.value = post_id;
    setVisible('remove_post_div');
}

/*
 * Close the warning/question about the removal of a post.
 */
function close_remove_post(){
    setVisible('remove_post_div', false);
}