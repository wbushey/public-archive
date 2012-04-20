/*
 * Functions used in the admin/users view.
 *
 * Author: Bill Bushey <wbushey@acm.org>
 * Last Updated: 9/05/08
 */
 
 /*
 * Display the Ban Email popup to the user.
 */
function show_ban_email(){
    setSize('ban_email_div', '400', '160');
    setVisible('ban_email_div');
}

/*
 * Close the dialog that allows a user to ban a user.
 */
function close_ban_email(){
    setVisible('ban_email_div', false);
}

/*
 * Display the Ban User Name popup to the user.
 */
function show_ban_username(){
    setSize('ban_username_div', '400', '160');
    setVisible('ban_username_div');
}

/*
 * Close the dialog that allows a user to ban a user.
 */
function close_ban_username(){
    setVisible('ban_username_div', false);
}

/*
 * Display the Ban IP Address popup to the user.
 */
function show_ban_ip(){
    setSize('ban_ip_div', '400', '160');
    setVisible('ban_ip_div');
}

/*
 * Close the dialog that allows a user to ban a user.
 */
function close_ban_ip(){
    setVisible('ban_ip_div', false);
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