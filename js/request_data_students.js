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
            console.log(res);
            let data = '';
            if (res.students.length > 0) {
                res.students.forEach(student => {
                    data += `
                        <tr>
                            <th scope="row">${student.id}</th>
                            <td>${student.name}</td>
                            <td>${student.last_name_p}</td>
                            <td>${student.last_name_m}</td>
                            <td>${student.carrier}</td>
                            <td>
                            <a class="btn btn-lg btn-success" href="student.php?student_id=${student.id}"><img src="./resourses/icons/Edit.png" width="30" height="30" alt=""></a>
                            <button class="btn btn-lg btn-success btnDelete" aria-details="${student.id}" href=""><img src="./resourses/icons/trash.svg" alt=""></button>
                            </td>
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
            con();
        });
});

const con = () => {
    $('.btnDelete').click(evt => {
        Swal.fire({
            title: '¿Seguro que desea realizar esta accion?',
            text: "Una vez eliminado el estudiante no hay vuelta atras, esto tambien implica eliminar todas sus asistencias.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, deseo hacerlo!'
        }).then((result) => {
            if (result.isConfirmed) {
                const student_id = $(evt.target).attr('aria-details');
                const form = new FormData();
                form.append('student_id', student_id);

                fetch(`api/delete-student.php`, {
                    method: 'POST',
                    headers: new Headers(),
                    body: form
                }).then(res => res.json())
                    .then(res => {
                        if (res.code == "200") {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: res.msj,
                                showConfirmButton: false
                            }).then(res => {
                                window.location.reload()
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: res.msj
                            })
                        }
                    })
                    .catch(error => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Ocurrio un error en la ruta URL'
                        })
                    });
            }
        })
    });
};