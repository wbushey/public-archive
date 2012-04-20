/**
 * Function used to submit form data via post.
 *
 * Author: Bill Bushey <wbushey@acm.org>
 * Last Updated: 7/16/2008
 */

/*
 * Sends an HTTP request via post to the provided url which contains the
 * the elements identified by the provided array
 */
function sendPost(url, elements){
    // Create a new hidden form with the provided url being the action 
    var hidden_form = document.createElement("form");
    hidden_form.style.display = 'none';
    document.getElementById('content').appendChild(hidden_form);
    hidden_form.action = url;
    hidden_form.method = "post";
    
    var element;
    for (var i = 0; i <= elements.length; ++i){
        element = document.getElementById(elements[i]);
        hidden_form.appendChild(element);
   }
    hidden_form.submit();
}

/*
 * A slight adaptation of the above function to allow for file uploads.
 */
function sendFile(url, elements){
    // Create a new hidden form with the provided url being the action 
    var hidden_form = document.createElement("form");
    hidden_form.style.display = 'none';
    document.getElementById('content').appendChild(hidden_form);
    hidden_form.action = url;
    hidden_form.method = "post";
    hidden_form.enctype = "multipart/form-data";
    
    var element;
    for (var i = 0; i <= elements.length; ++i){
        element = document.getElementById(elements[i]);
        hidden_form.appendChild(element);
   }
    hidden_form.submit();
}