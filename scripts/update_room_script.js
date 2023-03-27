"use strict";

window.addEventListener("DOMContentLoaded", () => {

    var delete_images = document.getElementsByClassName("fa-solid fa-trash"); // get all the trash bins on the page

    if(delete_images != null){
    
      Array.from(delete_images).forEach(function(delete_image) {
    
        delete_image.addEventListener("click", function(ev) { // if any of the trash bin are clicked
    
            // var image_upload_remove = document.querySelectorAll("#updateimage");
    
            // image_upload_remove.forEach(element => {
            //     element.remove();        
            // });
    
            var check_empty = document.getElementsByClassName("trash");
    
            Array.from(check_empty).forEach(function(element)  {
               let c_nodes = element.childNodes;
               Array.from(c_nodes).forEach(function(element) {
                  if(element.className != "fa-solid fa-trash" && element.className != "hidden")
                  {
                    element.remove();
                  }      
                        
                  if(element.className == "fa-solid fa-trash" || element.className == "hidden"){
                    element.removeAttribute("class");
                    element.setAttribute("class","fa-solid fa-trash");
                  }
               });       
            
                console.log(c_nodes);
            });
    
    
    
          const yes = "<button id='yes' type='button'>Yes</button>"; 
          const no = "<button id='no' type='button'>No</button>";
    
          delete_image.parentNode.insertAdjacentHTML("beforeend", yes); // make a yes button add in the trash div
          delete_image.parentNode.insertAdjacentHTML("beforeend", no); // make no button  add in the trash div
          delete_image.setAttribute("class","hidden");
    
          var dont_delete = document.getElementById("no");
          var yes_delete = document.getElementById("yes");
    
    
            dont_delete.addEventListener("click", function(ev){ // if user doesnt want to delete image
    
            delete_image.removeAttribute("class");
            delete_image.setAttribute("class","fa-solid fa-trash");
            //remove the yes and no buttons
            yes_delete.remove(); 
            dont_delete.remove();
    
          }); // end of dont_delete click
    
          yes_delete.addEventListener("click", function(ev) {
    
            var name = yes_delete.parentNode.previousElementSibling.innerText; // get the name of the image that is being deleted
    
            delete_image.remove(); // delete the trash can
    
            yes_delete.parentNode.previousElementSibling.remove(); // remove the name of the image
    
            let id = document.querySelector("input[name='oldID']").value;
    
            const xhttp = new XMLHttpRequest();
    
            xhttp.open("GET", "https://loki.trentu.ca/~classfind/4000/includes/update_room_images?oldID="+id);
    
            console.log(name);
    
            xhttp.addEventListener("load", (ev) =>{
                if(xhttp.status == 200)
                {
                    console.log(xhttp.responseText);
                    const img = JSON.parse(xhttp.responseText);
    
                    img['Image'] = img['Image'].replace(name," ");
    
                    console.log(img['Image']);
    
                    const xhttp_img = new XMLHttpRequest();
    
                    xhttp_img.open("GET","https://loki.trentu.ca/~classfind/4000/includes/upload_room_delete.php?newimgs="+img['Image']+"&oldID="+id+"&delete="+name);
    
                    xhttp_img.addEventListener("load", (ev) =>{
                        if(xhttp_img.status == 200){
                            console.log(xhttp_img.responseText);
                        }
    
                    });
    
                    xhttp_img.send();
                }
            });
    
            xhttp.send();
    
            //make a label and input for the new image to be uploaded to the same div as the yes and no buttons
            yes_delete.parentNode.insertAdjacentHTML("beforeend","<label id='updateroomimage' for='updateroomimage'>Upload new image:</label>"); 
            yes_delete.parentNode.insertAdjacentHTML("beforeend","<input type='file' id='updateroomimage' name='updateroomimage[]' multiple>");
    
            //remove the yes and no buttons
            yes_delete.remove();
            dont_delete.remove();
    
          }); // end of yes_delete click
    
        }); //end of if any trash bin is clicked
    
      }); // end of foreach
    }

});