<!doctype html>
<html lang="en">
<head>
    <title><?php
        $app = new App();
        $action = $app->getAction();
        $controller = $action!='login' ? $app->getController() : "";
        echo $controller != "" ? $controller."-".ucwords($action) : ucwords($action);?></title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <?php
    $css = 'base-css.php';
    if($action=="login" || $action=="logout" || empty($action)){
        $css = 'login-css.php';
    }
    include_once ("../basephp/public/css/".$css);
    ?>
</head>
