<?php

$server = "localhost";
$user = "root";
$pass= "";
$bd= "inventario";

$conex= mysqli_connect($server, $user, $pass, $bd);

if(isset($_GET['id_producto'])){
    $id_producto= $_GET['id_producto'];
    $query= "DELETE FROM productos WHERE id_producto= $id_producto";
    $resultado= mysqli_query($conex, $query);
    if(!$resultado){
        die("Query failed");
    }
        header("Location: productos.php");
    


}
?>