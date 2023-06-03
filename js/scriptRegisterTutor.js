(() => {
    $('#SelectorTutorExistente').select2({
        placeholder: "Selecciona un tutor",
        allowCrear: true,
        minimumInputLength: 0
    }).on('select2:select', event => {
        const tutor_id = event.target.value;
        if (tutor_id > 0) {
            const URL = `api/get-tutor.php`;
            const form = new FormData();
            form.append('tutor_id', tutor_id);
            request(URL, form, stuffed);
        } else {
            cleanFields();
        }
    });
})();


const request = (URL, form, callback) => {
    fetch(URL, {
        headers: new Headers(),
        method: 'POST',
        body: form
    }).then(res => res.json())
        .then(res => callback(res))
        .catch(error => console.log(error));
}

const stuffed = json => {
    const tutor = json.tutor;
    $('#inputNameTutor').val(tutor.name);
    $('#inputApellidoP').val(tutor.last_name_p);
    $('#inputApellidoM').val(tutor.last_name_m);
    $('#inputTelefonoHome').val(tutor.tel_home);
    $('#inputTelefonoPerson').val(tutor.tel_personal);
}

const cleanFields = () => {
    $('#inputNameTutor').val('');
    $('#inputApellidoP').val('');
    $('#inputApellidoM').val('');
    $('#inputTelefonoHome').val('');
    $('#inputTelefonoPerson').val('');
}