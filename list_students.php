<?php
session_start();
require_once('./Helpers/Session.php');
require_once('./admon/conexion.php');

if (!Session::exists()) {
    Session::withMessage(['msj' => 'Usted no ha iniciado sesion'], function () {
        header('Location: /login.php');
    });
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/searchbar.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="shortcut icon" type="image/icon" href="img/icon/logo.ico">
    <title>Estudiantes</title>
</head>

<body>
    <?php
    require_once('components/navbar.php');
    ?>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./Home.php">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Lista De Estudiantes</li>
        </ol>
    </nav>

    <div class="container-fluid">
        <div class="mt-3">
            <h1 style="text-align:center">Lista De Estudiantes</h1>
        </div>

        <form class="form mb-3">
            <button>
                <svg width="17" height="16" fill="none" xmlns="http://www.w3.org/2000/svg" role="img" aria-labelledby="search">
                    <path d="M7.667 12.667A5.333 5.333 0 107.667 2a5.333 5.333 0 000 10.667zM14.334 14l-2.9-2.9" stroke="currentColor" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round">
                    </path>
                </svg>
            </button>
            <input class="input" id="search" placeholder="Filtra por nombre o apellidos" required="" type="text">
            <button class="reset" type="reset">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </form>

        <div class="table-responsive">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Matricula</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido Materno</th>
                        <th scope="col">Apellido Paterno</th>
                        <th scope="col">Especialidad</th>
                        <th scope="col">Opciones</th>

                    </tr>
                </thead>
                <tbody id="contentStudents">
                    <?php
                    $limit = (isset($_GET['page'])) ? $_GET['page'] * 5 : 0;
                    $countSql = "select count(u.id) as total from user u join rol r on u.rol_id = r.id left join especialities c on u.speciality_id = c.id where lower(r.name) = 'estudiante' order by u.id;";
                    $sql = "select u.id, u.barcode, u.name, u.last_name_p, u.last_name_m, c.name as carrier_name from user u join rol r on u.rol_id = r.id left join especialities c on u.speciality_id = c.id where lower(r.name) = 'estudiante' order by u.id limit $limit, 5;";
                    $query = mysqli_query($con, $sql);
                    while ($getStudent = mysqli_fetch_array($query)) {
                    ?>
                        <tr>
                            <th scope="row"><?php echo $getStudent['barcode']; ?></th>
                            <td><?php echo $getStudent['name']; ?></td>
                            <td><?php echo $getStudent['last_name_p']; ?></td>
                            <td><?php echo $getStudent['last_name_m']; ?></td>
                            <td><?php echo $getStudent['carrier_name']; ?></td>
                            <td>
                                <a class="btn btn-lg btn-success" href="student.php?student_id=<?php echo $getStudent['id']; ?>"><img src="./resourses/icons/Edit.png" width="30" height="30" alt=""></a>
                                <button class="btn btn-lg btn-success btnDelete" aria-details="<?php echo $getStudent['id']; ?>" href=""><img src="./resourses/icons/trash.svg" alt=""></button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <nav class="d-flex justify-content-center" aria-label="Page navigation">
                <ul class="pagination">
                    <?php
                    $res = mysqli_fetch_array(mysqli_query($con, $countSql));
                    for ($i = 0; $i < ceil($res['total'] / 5); $i++) {
                    ?>
                        <li class="page-item"><a href="list_students.php?page=<?php echo $i; ?>" class="page-link"><?php echo $i + 1; ?></a></li>
                    <?php } ?>
                </ul>
            </nav>
        </div>
    </div>

    <?php
    require_once('components/footer.php');
    ?>
    <script src="./js/app.js"></script>
    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <script src="js/fontawesome.js"></script>

    <script src="./js/request_data_students.js"></script>
    <script src="./js/sweetalert2.all.min.js"></script>

    <?php if (Session::in('msj')) { ?>
        <script defer>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Muy bien :)',
                text: '<?php echo Session::get('msj') ?>'
            });
        </script>
    <?php } ?>
</body>

</html>