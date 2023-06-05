const es = {
    weekdays: {
        shorthand: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
        longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
    },
    months: {
        shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Оct', 'Nov', 'Dic'],
        longhand: ['Enero', 'Febreo', 'Мarzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
    },
};

const config = {
    locale: es,
    dateFormat: 'Y-m-d',
    altInput: true,
    altFormat: "j F Y",
    disable: [
        date => (date.getDay() === 0 || date.getDay() === 6)
    ],
    disable: [
        date => (date.getDay() === 0 || date.getDay() === 6)
    ]
};

const initSemester = $('#initSemester').flatpickr(config);
const finSemester = $('#finSemester').flatpickr(config);

const nonWorkingDays = flatpickr('#nonWorkingDays', {
    locale: es,
    mode: 'multiple',
    dateFormat: 'd-m-Y',
    disable: [
        date => (date.getDay() === 0 || date.getDay() === 6)
    ],
    onChange: (selectedDays, dateStr, instance) => {
        $('#nonWorkingDays').val(`Dias seleccionados: ${selectedDays.length}`);
    }
});

const localeDate = collect => collect.selectedDates.map(date => date.toISOString().substring(0, 10));
const isNull = data => (data.length == 0)


$('#btnSendConfigSemester').on('click', evt => {
    evt.preventDefault();
    const name = $('#nameSemester').val();
    const dateInitSemester = localeDate(initSemester);
    const dateFinalSemester = localeDate(finSemester);
    const dateNonWorkingDays = localeDate(nonWorkingDays);

    if (isNull(name) || isNull(dateInitSemester) || isNull(dateFinalSemester) || isNull(dateNonWorkingDays)) {
        Swal.fire({
            icon: 'question',
            title: 'Campos incompletos',
            text: 'Debes completar todos los campos.',
        });
        return;
    }

    const form = new FormData();
    form.append('name', name);
    form.append('dateInitSemester', dateInitSemester);
    form.append('dateFinalSemester', dateFinalSemester);
    form.append('dateNonWorkingDays', dateNonWorkingDays);

    fetch('api/register-config-semester.php', {
        headers: new Headers(),
        method: 'POST',
        body: form
    })
        .then(res => res.json())
        .then(res => {
            if (res.code == "200") {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: res.msj,
                    showConfirmButton: false,
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: res.msj,
                });
            }
        });
});

