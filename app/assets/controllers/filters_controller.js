import { Controller } from 'stimulus';

export default class extends Controller {

    FiltersForm = document.querySelector("#filters");

    filter(e){
        document.querySelectorAll("#filters input").forEach( input => {
            input.addEventListener("change", () =>  {
                //TODO : check why query doubles

                //get the form and ts values
                const Form = new FormData(this.FiltersForm)

                //creating param (query string)
                const Param = new URLSearchParams();
                Form.forEach(((value, key) => {
                    Param.append(key, value);
                    console.log(key, value)
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