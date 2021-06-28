import { Controller } from 'stimulus';

export default class extends Controller {

    Add = document.querySelector("#pagination");
//TODO : check why query doubles
    addPage(e){
        e.preventDefault();
        this.Add.addEventListener("click", () => {

            //get current url
            const Url = new URL(window.location.href)
            const Page = new URLSearchParams('page');
            let number = 1;

            //make ajax query
            fetch(Url.pathname + "?" + Page + (number + 1), {
                headers: {
                    "x-Requested-With": 'XMLHttpRequest'
                }
            }).then(response =>
                response.json()
            ).then(data => {
                const tricks = document.querySelector('#loadTrick')
                let child = data.content;
                number = data.page;

                tricks.insertAdjacentHTML("beforeend", child);
                history.pushState({}, null, Url.pathname + '?' + Page + (number))
            }).catch(e => alert(e))
        })
    }
}