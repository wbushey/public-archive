/* -----------------------------------------------
   Floating layer - v.1
   (c) 2006 www.haan.net
   contact: jeroen@haan.net
   You may use this script but please leave the credits on top intact.
   Please inform us of any improvements made.
   When usefull we will add your credits.
  ------------------------------------------------ */

x = 20;
y = 70;

function setVisible(obj){
    centerIt(obj);
    obj = document.getElementById(obj);
    obj.style.visibility = (obj.style.visibility == 'visible') ? 'hidden' : 'visible';
}

function placeIt(obj){
    obj = document.getElementById(obj);
    if (document.documentElement)
    {
        theLeft = document.documentElement.scrollLeft;
        theTop = document.documentElement.scrollTop;
    }
    else if (document.body)
    {
        theLeft = document.body.scrollLeft;
        theTop = document.body.scrollTop;
    }
    theLeft += x;
    theTop += y;
    obj.style.left = theLeft + 'px' ;
    obj.style.top = theTop + 'px' ;
    setTimeout("placeIt('layer1')",500);
}

//window.onscroll = setTimeout("placeIt('layer1')",500);

function centerIt(obj){
    obj = document.getElementById(obj);
    
    width = obj.style.width;
    width = width.substring(0, width.indexOf("px"));
    
    height = obj.style.height;
    height = height.substring(0, height.indexOf("px"));
    
    x = (document.body.clientWidth - width)/2;
    y = (document.body.clientHeight - height)/2;
    
    obj.style.left = x + 'px';
    obj.style.top = y + 'px';
}

function setSize(obj, width, height){
    obj = document.getElementById(obj);
    obj.style.width = width + 'px';
    obj.style.height = height + 'px';
}