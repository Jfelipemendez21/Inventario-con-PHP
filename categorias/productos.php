<?php

    $server = "localhost";
    $user = "root";
    $pass= "";
    $bd= "inventario";

    $conex= mysqli_connect($server, $user, $pass, $bd);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="products.css">
    <title>Productos</title>
</head>
<body>
<header>
        <img class="icono" src="../imgs/icono.jpg" alt="">
        <h1 class="title">INVENTORY</h1>
</header>
        <br>
        <br>
    <div class="row">
        
        <div class="row-xl-4">
            <ul>
                <li class="li_menu"><a href="../paginaPrincipal.php">Nuevo producto <img  class="icon_menu" src="../imgs/nuevo.png" alt=""> </a></li>
                <li class="li_menu"><a href="../categorias/productos.php">Lista de productos <img  class="icon_menu" src="../imgs/lista.png" alt=""> </a></li>
                <li class="li_menu"><a href="../categorias/salidas.php">Venta productos <img  class="icon_menu" src="../imgs/ventas.png" alt=""> </a></li>
                <li class="li_menu"><a href="../logica/cerrarSesion.php">Cerrar sesion <img class="icon_menu"  src="../imgs/cerrar.png" alt=""> </a></li>
            </ul>
        </div>
        <div class="col-xl-8 ml-4">
            <br>
            <table class="table table-bordered table-dark table-striped">
                <thead>
                <tr>
                    <th>Codigo Producto</th>
                    <th>Nombre producto</th>
                    <th>Precio</th>
                    <th>Estado</th>
                    <th>Categoria</th>
                    <th>Descripcion</th>
                    <th>Unidades disponibles</th>
                    <th>Imagen</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            
            <tbody>
                <?php
                $query = "SELECT * FROM productos";
                $resultado= mysqli_query($conex, $query);
                while($row= mysqli_fetch_array($resultado)){?> 
                  <tr>
                      <td><?php echo $row['id_producto']?> </td>
                      <td><?php echo $row['nombre_producto']?> </td>
                      <td><?php echo $row['precio']?> </td>
                      <td><?php echo $row['estado']?> </td>
                      <td><?php echo $row['categoria']?> </td>
                      <td><?php echo $row['descripcion']?> </td>
                      <td><?php echo $row['unidades_dispon']?></td>
                      <td><img class="imagenProd" src="data:image/jpg;base64,<?php echo base64_encode($row['imagen']);?>"/></td>
                      <td>
                            <a href="editar.php?id_producto=<?php echo $row['id_producto']?>" class="btn btn-secondary">
                            Editar
                            </a>
                            <a href="eliminar.php?id_producto=<?php echo $row['id_producto']?>" class="btn btn-danger">
                             Eliminar
                             </a>
                     </td>
                 </tr>
            <?php } ?>     
            
            
            </tbody>
            
        </table> 
    </div>
    </div>
</body>
</html>

