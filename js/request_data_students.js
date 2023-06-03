const contentStudentsOld = document.getElementById('contentStudents').innerHTML;
const filter = document.getElementById(`search`);

filter.addEventListener("keyup", (evt) => {
    const contentStudents = document.getElementById('contentStudents');
    if (filter.value.length < 3) {
        contentStudents.innerHTML = contentStudentsOld;
        return;
    }

    const form = new FormData();
    form.append(`key_words`, filter.value)
    fetch(`api/get-students.php`, {
        method: `POST`,
        headers: new Headers(),
        body: form
    })
        .then(res => res.json())
        .then(res => {
            let data = '';
            if (res.students.length > 0) {
                res.students.forEach(student => {
                    data += `
                        <tr>
                            <th scope="row">${student.id}</th>
                            <td>${student.name}</td>
                            <td>${student.last_name_p}</td>
                            <td>${student.last_name_m}</td>
                        </tr>
                        `;
                });
            } else {
                data += `
                    <tr>
                        <th scope="row" colspan="5">No hay estudiantes</th>
                    </tr>
                `;
            }
            contentStudents.innerHTML = data;
        });
});