import { Controller } from 'stimulus';

export default class extends Controller {
    addPage(e){
        //TODO : add filters to load more function
        const Load = document.querySelector('#load');
        const Page = document.querySelector('#load #page');


        document.querySelector('#loader').onclick = function (){
            const Form = new FormData(Load);

            //creating param (query string)
            const Param = new URLSearchParams();
            Form.forEach(((value, key) => {
                Param.set(key, value);

            }))

            //get current url
            const Url = new URL(window.location.href)

            //make ajax query
            fetch(Url.pathname + "?" + Param.toString() + "&load=" + (Page.value), {
                headers: {
                    "x-Requested-With": 'XMLHttpRequest'
                }
            }).then(response =>
                response.json()
            ).then(data => {
                const tricks = document.querySelector('#loadTrick')
                let child = data.content;
                let number = parseInt(Page.value);
                number++;
                Page.value = number;
                Param.set('page', Page.value)

                console.log(Param.toString())

                tricks.insertAdjacentHTML("beforeend", child);
                history.pushState({}, null, Url.pathname + '?'+ Param.toString() )
            }).catch(e => alert(e))
        }
    }
}