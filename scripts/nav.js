"use strict";

// geting html collection of class chevron to narrow it down
let collapsible = document.getElementsByClassName("navmenu");

// opted not to confine to chevron only, but to whole line chevron is on

// iterate over every item in the collection (2 items basically)
for (let i = 0; i < collapsible.length; i++) {
  // adding an event listener for click and defining function
  collapsible[i].addEventListener("click", function() {

    // get the sibling of class arrow (the ul after)
    let navlist = this.nextElementSibling;

    // if the display is none, show it
    // (by setting display to block basically)
    if(navlist.style.display === "none")
    {
      navlist.style.display = "block";
    }
    // otherwise, if it is block (showing), make it none (hide it)
    else {
      navlist.style.display = "none";
    }
  });
}

// end of nav.js