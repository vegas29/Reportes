<?php

include 'conexion.php';

if(isset($_POST['crear_reporte'])){
    $equipo = $_POST['equipo'];
    $zona = $_POST['zona'];
    $descripcion = $_POST['descripcion'];

    $query = "INSERT INTO registro (equipo_reporte, zona_reporte, descripcion_reporte) VALUES ('$equipo', '$zona', '$descripcion')";
    $result = mysqli_query($con, $query);

    if(!$result){
        die('La consulta fallo');
    }

    echo "<script> alert('Creado exitosamente') </script>";
}




?>