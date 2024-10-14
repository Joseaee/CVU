<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo(isset($params['title']) ? $params['title']: 'Sistema Electoral UPTAEB');?></title>
    <link rel="icon" type="image/png" href="assets/img/icons/favicon.png"/> 
    <link href="public/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="assets/icons/css/boxicons.min.css">
    <link href="assets/css/estilos.css" rel="stylesheet"/>
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