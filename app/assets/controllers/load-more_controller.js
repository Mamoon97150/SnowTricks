import { Controller } from 'stimulus';

export default class extends Controller {
    addPage(e){
        const Load = document.querySelector('.load');
        const Page = document.querySelector('.load .page');

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
                //show page
                const tricks = document.querySelector('.loadBlock')
                let child = data.content;
                let number = parseInt(Page.value);
                number++;
                Page.value = number;
                Param.set('page', Page.value)

                // hide load more
                const button = document.querySelector('.loadButton');
                if (Page.value >= data.maxPage){
                    button.classList.add('d-none');
                }

                tricks.insertAdjacentHTML("beforeend", child);
                history.pushState({}, null, Url.pathname + '?page='+ (Page.value - 1) )
            }).catch(e => alert(e))
        }

}