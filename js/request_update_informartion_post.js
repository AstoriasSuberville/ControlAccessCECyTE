const getPath = (url) => {
    const parts = url.split('/');
    return parts[parts.length - 1];
}

const request_update_information = (form) => {
    form.onsubmit = (evt) => {
        evt.preventDefault();
        const SEND_FORM_PATH = getPath(form.action);
        const SEND_FORM_DATA = new FormData(form);
        const REQUEST_METHOD = form.method.toUpperCase();

        fetch(`api/${SEND_FORM_PATH}`, {
            headers: new Headers(),
            method: REQUEST_METHOD,
            body: SEND_FORM_DATA
        })
            .then(res => res.json())
            .then(res => {
                let alert_class = ``;
                let title = ``;
                let description = ``;

                if(res.code == "200"){
                    alert_class = `alert-success`;
                    title = `Bien hecho!`;
                    description = `La información ha sido actualizada correctamente! :3`;
                } else {
                    alert_class = `alert-warning`;
                    title = `Error faltan!`;
                    description = `La información no ha sido actualizada correctamente! :0`;
                }

                const operation_sucess = `
                        <div class="alert ${alert_class} alert-dismissible fade show" id="alert_information" role="alert">
                            <strong>${title}</strong> ${description}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    `;

                setTimeout(() => {
                    const element = document.getElementById('alert_information');
                    if (element) element.remove();
                }, 5000);

                form.insertAdjacentHTML('beforebegin', operation_sucess);
                console.log(res.message);
            });
    }
}

(() => {
    let forms = document.getElementsByTagName('form');
    Array.from(forms).forEach(form => request_update_information(form));
})();