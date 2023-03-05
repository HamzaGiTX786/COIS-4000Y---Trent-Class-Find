"use strict";

window.addEventListener("DOMContentLoaded", () => {

    var start_build_name = document.getElementById("startpoint");
    var end_build_name = document.getElementById("endpoint");

    if(start_build_name != null){
    start_build_name.onchange = () =>{

       const xhttp = new XMLHttpRequest();

       xhttp.open("GET", "https://loki.trentu.ca/~classfind/4000/includes/getrooms.php?build_code="+start_build_name.value);

        xhttp.addEventListener("load", (ev) =>{
            if(xhttp.status == 200)
            {
                const data = JSON.parse(xhttp.responseText);

                let output = "";

                for(let i=0; i < data.length;i++)
                {
                    output = output +  `<option value=${data[i][0]}>${data[i][1]}</option>`
                    
                }

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
}
    if(end_build_name != null){
        end_build_name.onchange = () =>{

            const xhttp = new XMLHttpRequest();
     
            xhttp.open("GET", "https://loki.trentu.ca/~classfind/4000/includes/getrooms.php?build_code="+end_build_name.value);
     
             xhttp.addEventListener("load", (ev) =>{
                 if(xhttp.status == 200)
                 {
                     
                     const data = JSON.parse(xhttp.responseText);
     
                     let output = "";
     
                     for(let i=0; i < data.length;i++)
                     {
                         output = output +  `<option value=${data[i][0]}>${data[i][1]}</option>`
                         
                     }
     
                     var caption = document.getElementsByTagName("p"); 
                     var end_room_name = document.getElementById("endroom");
     
                     var L = end_room_name.options.length - 1;
                     for(let j = L; j >= 1; j--) {
                         end_room_name.remove(j);
                         }
     
                     end_room_name.insertAdjacentHTML("beforeend",output);
                     caption[1].removeAttribute("class");
                     end_room_name.removeAttribute("class");
                 }
     
     
             });

             xhttp.send();
        }}

// ----------------------------------------------------------------------------------------------------------------------------------

var startnode = document.getElementById("Start_Node");

if(startnode != null){

startnode.onchange = () =>{

    console.log(startnode.value);

    const xhttp = new XMLHttpRequest();

    xhttp.open("GET", "https://loki.trentu.ca/~classfind/4000/includes/getnodes.php?start="+startnode.value);

    xhttp.addEventListener("load", (ev) =>{
        if(xhttp.status == 200)
        {
            console.log(xhttp.responseText);
            const datanode = JSON.parse(xhttp.responseText);
     
            let output = "";

            for(let i=0; i < datanode.length;i++)
            {
                output += `<option value=${datanode[i][0]}>${datanode[i][1]}</option>`;
                
            }

            var end_node_list = document.getElementById("End_Node");

            var L = end_node_list.options.length - 1;
            for(let j = L; j >= 1; j--) {
                end_node_list.remove(j);
                }

            end_node_list.insertAdjacentHTML("beforeend",output);
        }});

        xhttp.send();
}}
          
          
});
