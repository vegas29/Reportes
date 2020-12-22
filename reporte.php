<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Document</title>
    <style type="text/css">
        .centrar-texto{
            text-align:center;
        }
    </style>
</head>
<body>
    <?php if(isset($_POST['equipo'])): ?>
        <h1 class="centrar-texto"><?=$_POST['equipo']?></h1>
        <h3 class="centrar-texto"><?=$_POST['zona']?></h3>
        <p class="centrar-texto"><?=$_POST['fecha']?></p>
        <p class="centrar-texto"><?=$_POST['descripcion']?></p>
    <?php endif; ?>

    
</body>
</html>