
<?php
include("../logica/conexion.php");

if(isset($_GET['id_producto'])){
    $id= $_GET['id_producto'];
    $query= "SELECT * FROM productos WHERE id_producto= $id";
    $resultado= mysqli_query($conex, $query);
    // para comprobar cuantas filas tiene la variable resultado
    if(mysqli_num_rows($resultado)==1){ 
        // llamar los datos de la base de datos
        $row= mysqli_fetch_array($resultado);
        $nombre= $row['nombre_producto'];
        $precio= $row['precio'];
        $estado= $row['estado'];
        $categoria= $row['categoria'];
        $descripcion= $row['descripcion'];
        $unidades_dispon= $row['unidades_dispon'];
    }
}
 
if(isset($_POST['update'])){
    // llamar los inputs de actualizacion
    $id=$_GET['id'];
    $nombre=$_POST['nombre'];
    $precio=$_POST['precio'];
    $estado=$_POST['estado'];
    $categoria=$_POST['categoria'];
    $descripcion =$_POST['descripcion'];
    $unidades_dispon=$_POST['unidades_dispon'];


    // actualizar los inputs con los nuevos datos y hacerlo tambien en la base
    $query= "UPDATE productos set nombre_producto= '$nombre', precio = '$precio', estado = '$estado', categoria = '$categoria', descripcion = '$descripcion', unidades_dispon='$unidades_dispon' WHERE id_producto= '$id'";
    $resultado= mysqli_query($conex, $query);

    echo"<li class='actualizado'>Actualizado de forma correcta!</li>";

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="products.css">
    <title>Editar</title>
</head>
<body>
    <a href="productos.php"><img class="volver" src="../imgs/volver.png"></a>
    <center>
    <div class="container p-4">
    <div class="row">
        <div class="col-md-5 mx-auto">
            <div class="card card-body">
                <form action='editar.php?id=<?php echo$_GET['id_producto']; ?>' method='POST'>
                    <div class="form-group"> 
                        <input type="text" name="nombre" value="<?php  echo $nombre; ?>" placeholder="actualiza nombre">
                    </div>
                    <div class="form-group">
                        <input type="number" name="precio" value="<?php  echo $precio; ?>" placeholder="actualiza el precio">
                    </div>
                    <div class="form-group">
                        <input type="text" name="estado" value="<?php  echo $estado; ?>" placeholder="actualiza el estado">
                    </div>
                    <div class="form-group">
                        <input type="text" name="categoria" value="<?php  echo $categoria; ?>" placeholder="actualiza categoria">
                    </div>
                    <div class="form-group">
                        <textarea name="descripcion" value="<?php  echo $descripcion; ?>" placeholder="actualiza descripcion"></textarea>
                    </div>
                    <div class="form-group"> 
                        <input type="number" name="unidades_dispon" value="<?php  echo $unidades_dispon; ?>" placeholder="actualiza unidades">
                    </div>
                    <button class="btn btn-success" name="update">Actualizar</button>
                </form>
            </div>

        </div>
    </div>
    </center>


</div>
</body>
</html>
