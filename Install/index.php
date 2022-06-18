
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.98.0">
    <title>eCommerce 2022 - Installation</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/sign-in/">



    <link href="https://getbootstrap.com/docs/5.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <meta name="theme-color" content="#712cf9">


    <link href="https://getbootstrap.com/docs/5.2/examples/sign-in/signin.css" rel="stylesheet">
</head>
<body class="text-center">

<main class="form-signin w-100 m-auto">
    <form action="#" method="post">
        <img class="mb-4" src="https://cdn-icons-png.flaticon.com/512/416/416153.png" alt="" width="200px">
        <h1 class="h3 mb-3 fw-normal">Installation</h1>

        <?php



        if(isset($_POST['install'])) {

            $post = $_POST;
            $errors = 0;
            $err_messages = "";
            $dbPass = "";
            $dbHost = "";
            $dbUser = "";
            $dbName = "";
            $viewPath = "";
            $path = "";

            if(isset($post['viewPath']) && !empty($post['viewPath'])) {
                $viewPath = $post['viewPath'];
            } else {
                $errors++;
                $err_messages .= "- Vous devez spécifier le ViewPath ! <br />";
            }

            if(isset($post['path']) && !empty($post['path'])) {
                $path = $post['path'];
            } else {
                $errors++;
                $err_messages .= "- Vous devez spécifier le Path ! <br />";
            }

            if(isset($post['dbHost']) && !empty($post['dbHost'])) {
                $dbHost = $post['dbHost'];
            } else {
                $errors++;
                $err_messages .= "- Vous devez spécifier le nom d'hôte ! <br />";
            }

            if(isset($post['dbName']) && !empty($post['dbName'])) {
                $dbName = $post['dbName'];
            } else {
                $errors++;
                $err_messages .= "- Vous devez spécifier le nom de la base de données ! <br />";
            }

            if(isset($post['dbUser'])) {
                $dbUser = $post['dbUser'];
            } else {
                $errors++;
                $err_messages .= "- Vous devez spécifier le nom d'utilisateur ! <br />";
            }

            if(isset($post['dbPass'])) {
                $dbPass = $post['dbPass'];
            } else {
                $errors++;
                $err_messages .= "- Vous devez spécifier le mot de passe ! <br />";
            }

            if($errors == 0) {

                function stringify($array) {

                    return "<?php return " . $array. ";";

                }

                $dbArray = array(
                    "db_name" => $dbName,
                    "db_user" => $dbUser,
                    "db_pass" => $dbPass,
                    "db_host" => $dbHost
                );
                file_put_contents("../Config/Database.php", stringify(var_export($dbArray, true)));

                $generalArray = 'array(
                    "path" => "'. $path . '",
                    "view" => ROOT . "'.$viewPath.'"
                )';

                file_put_contents("../Config/General.php", stringify($generalArray));


                $db = new PDO("mysql:host=$dbHost;dbname=$dbName;", $dbUser, $dbPass);
                $select = $db->query(file_get_contents('ecommerce.sql'));
                $row = $select->fetch(PDO::FETCH_ASSOC)

                ?>
                <div class="alert alert-success">
                    <strong>Succès !</strong><br />
                    Le site a bien été installé ! <br />
                    Maintenant, vous pouvez supprimer le dossier Install !
                </div>
                <?php
            } else {
                ?>
                <div class="alert alert-danger">
                    <strong>Erreur !</strong><br />
                    <?= $err_messages ?>
                </div>

                <?php
            }

        }
        ?>


        <div class="mb-3">
            <h1 class="h5 mb-3 fw-normal">Informations générales</h1>


            <div class="form-floating">
                <input type="text" class="form-control" id="path" name="path" placeholder="Où est hébergé votre site ?" value="/eCommerce/">
                <label for="path">Path</label>
            </div>

            <div class="form-floating">
                <input type="text" class="form-control" id="viewPath" name="viewPath" placeholder="Où se situe votre dossier Views ?" value="\\eCommerce\\Views\\">
                <label for="viewPath">View Path</label>
            </div>


            <button type="button" class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#infoPathView">
                Qu'est ce que le PathView ou le Path ?
            </button>




            <div class="modal fade" id="infoPathView" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">PathView & Path</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <strong>ViewPath</strong><br />
                            Chemin où se situe votre dossier Views par rapport au nom de domaine. <br>
                            Par exemple, si vous avez hébergé le site sur : localhost/test, <br/>
                            alors le chemin sera : <strong>\\test\\Views\\</strong>


                            <hr />
                            <strong>Path</strong><br />
                            Dossier où se situe votre site par rapport au nom de domaine.<br />
                            Par exemple, si vous avez hébergé le site sur : localhost/test, <br />
                            alors le path sera : <strong>/test/</strong><br />
                            Si il est à la racine : <strong>/</strong>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div>
            <h1 class="h5 mb-3 fw-normal">Base de données</h1>

            <div class="form-floating">
                <input type="text" class="form-control" id="dbHost" name="dbHost" placeholder="Nom d'hôte">
                <label for="dbHost">Nom d'hôte</label>
            </div>

            <div class="form-floating">
                <input type="text" class="form-control" id="dbName" name="dbName" placeholder="Nom de la base de donnée">
                <label for="dbName">Base de données</label>
            </div>

            <div class="form-floating">
                <input type="text" class="form-control" id="dbUser"  name="dbUser" placeholder="Nom d'utilisateur">
                <label for="dbUser">Nom d'utilisateur</label>
            </div>

            <div class="form-floating">
                <input type="password" class="form-control" id="dbPass"  name="dbPass" placeholder="Mot de passe">
                <label for="dbPass">Mot de passe</label>
            </div>
        </div>



        <button class="w-100 btn btn-lg btn-primary" type="submit"  name="install">Installer</button>
        <p class="mt-5 mb-3 text-muted">&copy; 2022</p>
    </form>
</main>

=
<script src="https://kit.fontawesome.com/15d5d48445.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>

</body>
</html>
