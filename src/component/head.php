<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo(isset($params['title']) ? $params['title']: 'Sistema Electoral UPTAEB');?></title>
    <link rel="stylesheet" href="assets/icons/css/boxicons.min.css">
    <link href="assets/css/estilos.css" rel="stylesheet"/>
    <link rel="icon" type="image/png" href="assets/imgs/icons/favicon.png"/> 
    <link href="public/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="assets/css/sweetalert2.min.css" rel="stylesheet"/>
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet"/>
    <link href="assets/css/global.css" rel="stylesheet"/>
    <?php
        if(isset($params['links'])){
            
            foreach($params['links'] as $k){

                $rel = $k['rel'] ?? 'stylesheet';
                $attr = $k['attr'] ?? '';
                echo('<link rel="'.$rel.'" href="'.$k['href'].'" '.$attr.'/>');
            }
        }
    ?>
</head>
<body>