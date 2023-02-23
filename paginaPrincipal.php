<?php
        session_start(); 

        $usuario= $_SESSION['username'];

        if(!isset($usuario)){
            header("location: login.php");
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="principal.css">
    <title>Inventario</title>
</head>
<body>
    <header>
            <img class="icono" src="imgs/icono.jpg" alt="">
            <h1 class="title">INVENTORY</h1>
    </header>
    <div class="row">
        <div>
            <br><br>
            <ul>
                <li class="li_menu"><a href="paginaPrincipal.php">Nuevo producto <img  class="icon_menu" src="imgs/nuevo.png" alt=""> </a></li>
                <li class="li_menu"><a href="categorias/productos.php">Lista de productos <img  class="icon_menu" src="imgs/lista.png" alt=""> </a></li>
                <li class="li_menu"><a href="categorias/salidas.php">Venta productos <img  class="icon_menu" src="imgs/ventas.png" alt=""> </a></li>
                <li class="li_menu"><a href="logica/cerrarSesion.php">Cerrar sesion <img class="icon_menu"  src="imgs/cerrar.png" alt=""> </a></li>
            </ul>
        </div>
        <div class="contForm col">
            
            <form class="form group p-4 mt-4" action="" method="post" enctype="multipart/form-data">
                <h2 class="col">Agrega un producto <img class="producto" src="imgs/producto.png" alt=""></h2>
                <br>
                <input placeholder="Nombre producto" name="nombre" class="form-control" type="text">
                <input placeholder="Codigo producto" name="codigo" class="form-control" type="Number">
                <input placeholder="Precio" name="precio" class="form-control" type="Number">
                <input placeholder="Categoria" name="categoria" class="form-control" type="text">
                <input placeholder="Estado" name="estado" class="form-control" type="text">
                <br>
                <textarea placeholder="descripcion" name="descripcion" class="form-control" type="text"></textarea>
                <input placeholder="Unidades disponibles" name="unidades_dispon" class="form-control" type="text">
                <br>
                <label for="">Añadir imagen</label>
                <input name="añadirImg" REQUIRED class="form-control" type="file" accept="image/*">
                <br><br>
                <button name="btnGuardar" class="col btn btn-success" type="submit">Guardar producto</button>
                <br><br>
                <center>
                <?php  
            
                    include("logica/conexion.php");

                    if(isset($_POST['btnGuardar'])){
                    $nombre= $_POST[('nombre')]; 
                    $codigo= $_POST[('codigo')];
                    $precio= $_POST[('precio')];
                    $categoria= $_POST[('categoria')];
                    $estado= $_POST[('estado')];
                    $descripcion= $_POST[('descripcion')];
                    $unidades_disponibles= $_POST[('unidades_dispon')];
                    $añadirImg= addslashes(file_get_contents($_FILES['añadirImg']['tmp_name']));

                    $campos=array();  

                    if($nombre==""){
                        array_push($campos, "El campo Nombre no puede estar vacio");
                    }
                    if($codigo==""){
                        array_push($campos, "El campo Codigo producto no puede estar vacio");
                    }
                    if($precio== ""){
                        array_push($campos, "Ingresa un Precio electronico valido");
                    }
                    if($categoria== ""){
                        array_push($campos, "El campo Categoria no puede estar vacio");
                    }
                    if($estado== ""){
                        array_push($campos, "El campo Estado no puede estar vacio");
                    }
                    if($descripcion== ""){
                        array_push($campos, "El campo Descripcion no puede estar vacio");
                    }
                    if($unidades_disponibles== ""){
                        array_push($campos, "El campo Unidades no puede estar vacio");
                    }

                    if(count($campos) > 0){
                    echo "<div   >";
                    for($i=0; $i< count($campos); $i++){
                        echo "<li class='error'>".$campos[$i]."</li>";
                    }
                    }else{
                        
                        if(isset($_POST['btnGuardar'])){
                            
                            $insert_bd= "INSERT INTO `productos` (id_producto,nombre_producto,precio,estado,categoria,descripcion,unidades_dispon,imagen) VALUES ('$codigo','$nombre','$precio','$estado','$categoria','$descripcion','$unidades_disponibles','$añadirImg')"; 
                            
                            $enviar = mysqli_query($conex, $insert_bd);
                            
                            echo "<li class='correcto'>Se ha guardado el producto de forma correcta! <img class='chulo' src='imgs/lista.png' alt=''></li>"; 
                            
                            if(!$enviar){

                                echo"fallo al enviar los datos";
                            }
                        } 

                    } 
                    echo"</div>";
                }
                ?>
                </center>
            </form>
        </div>
    </div>
</body>
</html>