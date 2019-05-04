<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Favicon -->
        <link rel="icon" href="<?php echo INSIGNIA ?>">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="<?php echo CSS ?>bootstrap.min.css">
        <!-- FontAwesome CSS -->
        <link rel="stylesheet" href="<?php echo CSS ?>fontawesome.min.css">
        <!-- MiEstilo CSS -->
        <link rel="stylesheet" href="<?php echo CSS ?>estilo.css">
        <?php
        if (!isset($titulo) || empty($titulo)) {
            $titulo = 'Radio Web fortoul';
        }
        echo "<title>$titulo</title>";
        ?>

    </head>
    <body class="mt">