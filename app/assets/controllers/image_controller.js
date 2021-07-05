import { Controller } from 'stimulus';

export default class extends Controller {
    toggle(e){
        let button = document.querySelector("#addMedia");
        let images = document.querySelector('#toggle div');

        document.querySelector('#toggleButton').onclick = function (){
           if (images.classList.contains("d-none")){
               images.classList.remove("d-none", "nowrap", "flex-row");
               images.classList.add("d-flex", "flex-column")

               button.classList.remove("d-none")
               button.classList.add("d-flex")
           }
           else{
               images.classList.add("d-none", "nowrap", "flex-row");
               images.classList.remove("d-flex", "flex-column")

               button.classList.add("d-none")
               button.classList.remove("d-flex")
           }
        }
    }
}