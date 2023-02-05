"use strict";

window.addEventListener("DOMContentLoaded", () => {

    var start_build_name = document.getElementById("startpoint");
    var end_build_name = document.getElementById("endpoint");

    start_build_name.onchange = () =>{

       const xhttp = new XMLHttpRequest();

       xhttp.open("GET", "https://loki.trentu.ca/~classfind/4000/getrooms.php?build_code="+start_build_name.value);

        xhttp.addEventListener("load", (ev) =>{
            if(xhttp.status == 200)
            {
                console.log(xhttp.responseText);
                const data = JSON.parse(xhttp.responseText);

                let output = ""

                for(let i=0; i < data.length;i++)
                {
                    output = output +  `<option value=${data[i][0]}>${data[i][1]}</option>`
                    
                }

                console.log(output);

                var caption = document.getElementsByTagName("p"); 
                var start_room_name = document.getElementById("startroom");

                var L = L = start_room_name.options.length - 1;
                for(let j = L; j >= 1; j--) {
                    start_room_name.remove(j);
                    }

                start_room_name.insertAdjacentHTML("beforeend",output);
                caption[0].removeAttribute("class");
                start_room_name.removeAttribute("class");
            }


        });

        xhttp.send();
    }

        end_build_name.onchange = () =>{

            const xhttp = new XMLHttpRequest();
     
            xhttp.open("GET", "https://loki.trentu.ca/~classfind/4000/getrooms.php?build_code="+end_build_name.value);
     
             xhttp.addEventListener("load", (ev) =>{
                 if(xhttp.status == 200)
                 {
                     console.log(xhttp.responseText);
                     const data = JSON.parse(xhttp.responseText);
     
                     let output = ""
     
                     for(let i=0; i < data.length;i++)
                     {
                         output = output +  `<option value=${data[i][0]}>${data[i][1]}</option>`
                         
                     }
     
                     console.log(output);
     
                     var caption = document.getElementsByTagName("p"); 
                     var end_room_name = document.getElementById("endroom");
     
                     var L = L = end_room_name.options.length - 1;
                     for(let j = L; j >= 1; j--) {
                         end_room_name.remove(j);
                         }
     
                     end_room_name.insertAdjacentHTML("beforeend",output);
                     caption[1].removeAttribute("class");
                     end_room_name.removeAttribute("class");
                 }
     
     
             });

             xhttp.send();
        }
          
          
});
