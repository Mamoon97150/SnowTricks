import { Controller } from 'stimulus';

export default class extends Controller {
    filter(e){
        let FiltersForm = document.querySelector("#filters");

        document.querySelectorAll("#filters input").forEach( input => {
            input.addEventListener("input", () =>  {
                //TODO : check why query doubles

                //get the form and ts values
                const Form = new FormData(FiltersForm)

                //creating param (query string)
                const Param = new URLSearchParams();
                Form.forEach(((value, key) => {
                    Param.append(key, value);
                }))

                //get current url
                const Url = new URL(window.location.href)

                //make ajax query
                fetch(Url.pathname + "?" + Param.toString() + "&filters=1", {
                    headers: {
                        "x-Requested-With": 'XMLHttpRequest'
                    }
                }).then(response =>
                    response.json()
                ).then(data => {
                    const content = document.querySelector('#content')
                    content.innerHTML = data.content;
                    history.pushState({}, null, Url.pathname + '?' + Param.toString())
                }).catch(e => alert(e))
            })
        })
    }
}