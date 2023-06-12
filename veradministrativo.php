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
    <link rel="stylesheet" href="css/footer.css">
    <link rel="shortcut icon" type="image/icon" href="img/icon/logo.ico">
    <title>Ver Administrativo</title>
</head>

<body>
    <?php
    require_once('components/navbar.php');
    ?>
    <div class="container table-responsive">

        <div class="mt-3">
            <h1 style="text-align:center">Lista De Administrativos</h1>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido Paterno</th>
                        <th scope="col">Apellido Materno</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Cargo</th>
                        <th scope="col">Opciones</th>

                    </tr>
                </thead>
                <tbody id="contentAdmon">
                    <?php
                    $limit = (isset($_GET['page'])) ? $_GET['page'] * 5 : 0;
                    $countSql = "select count(u.id) as total from user as u join rol r on u.rol_id = r.id where lower(r.name) <> 'estudiante' order by u.id;";
                    $sql = "select u.id, u.name, u.last_name_p, u.last_name_m, u.user_name, r.name as rol_name from user as u join rol r on u.rol_id = r.id where lower(r.name) <> 'estudiante' order by u.id limit $limit, 5;";
                    $query = mysqli_query($con, $sql);
                    while ($getSadmon = mysqli_fetch_array($query)) {
                    ?>

                        <tr>
                            <th scope="row"><?php echo $getSadmon['name']; ?></th>
                            <td><?php echo $getSadmon['last_name_p']; ?></td>
                            <td><?php echo $getSadmon['last_name_m']; ?></td>
                            <td><?php echo $getSadmon['user_name']; ?></td>
                            <td><?php echo $getSadmon['rol_name']; ?></td>
                            <td>
                                <a class="btn btn-lg btn-success" href="student.php?student_id=<?php echo $getSadmon['id']; ?>"><img src="./resourses/icons/Edit.png" width="30" height="30" alt=""></a>
                                <button class="btn btn-lg btn-success btnDelete" aria-details="<?php echo $getSadmon['id']; ?>" href=""><img src="./resourses/icons/trash.svg" alt=""></button>
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
                        <li class="page-item"><a href="veradministrativo.php?page=<?php echo $i ?>" class="page-link"><?php echo $i + 1; ?></a></li>
                    <?php } ?>
                </ul>
            </nav>
        </div>
    </div>
    </div>

    <?php
    require_once('components/footer.php');
    ?>
    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <script src="js/fontawesome.js"></script>
    <script src="./js/sweetalert2.all.min.js"></script>

    <?php if (Session::in('msj')) { ?>
        <script defer>
            Swal.fire({
                icon: 'success',
                title: 'Se realizo la acción',
                text: '<?php echo Session::get('msj') ?>'
            });
        </script>
    <?php } ?>
</body>

</html>