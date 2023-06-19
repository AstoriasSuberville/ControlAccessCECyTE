
$('#slPeriodo').select2();

jQuery(() => {
    $('#form').on('submit', event => {
        event.preventDefault();
        request();
    });
});

const request = () => {
    const url_request = `api/get-assistances-student.php`;
    const form = new FormData();

    form.append('period_id', $('#slPeriodo').val());
    form.append('student_id', $('#student_id').val());

    fetch(url_request, {
        method: 'POST',
        headers: new Headers(),
        body: form
    })
        .then(res => res.json())
        .then(res => {
            // create array with days indicated
            const semesterDays = getDaysFrom(res.request.semester.first_day, res.request.semester.last_day);
            // mapping only days attended
            const daysAttended = res.request.asistencesStudent.map(item => item.day);
            // create array with days non working
            const daysNonWorking = res.request.daysNonWorking;
            // delete from semesterDays the days non working
            const onlyDaysWithClasses = deleteCoincidences(semesterDays, daysNonWorking);
            // create array from the days non attended
            const daysNonAttended = deleteCoincidences(onlyDaysWithClasses, daysAttended);

            graphics(['Asistencias', 'Dias no asistidos'], [daysAttended.length, daysNonAttended.length]);

            showAsistencesIntable(res.request.asistencesStudent);
        });
}


const getDaysFrom = (initDate, endDate) => {
    initDate = new Date(initDate);
    endDate = new Date(endDate);

    const aDay = 24 * 60 * 60 * 1000;
    const totalDays = Math.round(Math.abs(initDate - endDate) / aDay);

    let habilityDays = [];

    for (let x = 0; x < totalDays; x++) {
        const currentDate = new Date(initDate.getTime() + (x * aDay));
        if (currentDate.getDay() !== 0 && currentDate.getDay() !== 6) {
            const year = currentDate.getFullYear();
            const month = addZero(currentDate.getMonth() + 1);
            const day = addZero(currentDate.getDate());
            habilityDays.push(`${year}-${month}-${day}`);
        }
    }

    return habilityDays;
}

const addZero = value => {
    return value < 10 ? '0' + value : value;
}

const deleteCoincidences = (arr1, arr2) => arr1.filter(item => !arr2.includes(item));


const showAsistencesIntable = asistences => {
    let tbody = ``;
    asistences.forEach(item => {
        tbody += `<tr>
        <td>${item.day}</td>
        <td>${item.get_id}</td>
        <td>${item.get_out}</td>
            </tr>`;
    });
    $('#assistences').html(tbody);
}