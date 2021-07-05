import { Controller } from 'stimulus';

export default class extends Controller {
    filter(e){
        const files = document.querySelector("#toggleImage");
        const embedded = document.querySelector("#toggleVideo");

       document.querySelector('#check-image').onchange = function (){
           if (files.classList.contains("d-none")){
               files.classList.remove("d-none");

               if (embedded.classList.contains("d-none")){}
               else {
                   embedded.classList.add("d-none");
               }
           }
        }

        document.querySelector('#check-video').onchange = function (){
            if (embedded.classList.contains("d-none")){
                embedded.classList.remove("d-none");

                if (files.classList.contains("d-none")){}
                else {
                    files.classList.add("d-none");
                }


            }
        }
    }
}