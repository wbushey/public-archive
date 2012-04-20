/*
 * Functions used in the admin/celebrities view.
 *
 * Author: Bill Bushey <wbushey@acm.org>
 * Last Updated: 9/04/08
 */

/*
 * Display the Edit Name popup to the user.
 */
function show_edit_name(){
    field = document.getElementById('edit_name_field');
    display = document.getElementById('display_name');
    field.value = display.innerHTML;
    setSize('edit_name_div', '400', '30');
    setVisible('edit_name_div');
}

/*
 * Display the Edit Reference popup to the user.
 */
function show_edit_reference(){
    field = document.getElementById('edit_reference_field');
    display = document.getElementById('display_reference');
    
    field.value = display.innerHTML;
    setSize('edit_reference_div', '470', '30');
    setVisible('edit_reference_div');
}

/*
 * Update the reference field and hide the Edit Reference popup.
 * DEBUG: NOT USED
 */
function update_reference(){
    field = document.getElementById('edit_reference_field');
    display = document.getElementById('display_reference');
    
    display.innerHTML = field.value;
    display.href = field.value;
    setVisible('edit_reference_div', false);
}

/*
 * Show the dialog that allows a user to add a celebrity picture.
 */
function show_add_picture(){
    setSize('add_picture_div', '670', '30');
    setVisible('add_picture_div');
}

/*
 * Close the dialog that allows a user to add a celebrity picture.
 */
function close_add_picture(){
    setVisible('add_picture_div', false);
}

/*
 * Display a popup that contains the full sized image and
 * an option to remove the image.
 */
function show_full_picture(image_path, image_file){
    img = document.getElementById('full_picture');
    img.src = image_path;
    
    pic_to_remove = document.getElementById('picture_to_remove');
    pic_to_remove.value = image_file;
    
    setSize('edit_picture_div', '310', '430');
    setVisible('edit_picture_div');
}

/*
 * Close the full picture display.
 */
function close_full_picture(){
    setVisible('edit_picture_div', false);
}

/*
 * Display a warning/question about the removal of the current celebrity.
 */
function show_remove_celeb(){
    setSize('remove_celeb_div', '400', '200');
    setVisible('remove_celeb_div');
}

/*
 * Close the warning/question about the removal of the current celebrity.
 */
function close_remove_celeb(){
    setVisible('remove_celeb_div', false);
}

/*
 * Redirect the user to another page.
 */
function redirect(url){
	window.location=url;
}