<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="products.css">
    <title>Ventas</title>
</head>
<body>
<header>
        <img class="icono" src="../imgs/icono.jpg" alt="">
        <h1 class="title">INVENTORY</h1>
</header>
<center>
                <?php  
                    include("../logica/conexion.php");

                    if(isset($_POST['btnGuardar'])){

                        
                        $id_compra= $_POST[('id_compra')]; 
                        $id_producto= $_POST[('id_producto')];
                        $cantidad= $_POST[('cantidad')];
                        $fecha= $_POST[('fecha')];
                        $cliente= $_POST[('cliente')];
                        

                    $campos=array();  

                    if($id_compra==""){
                        array_push($campos, "El campo Codigo compra no puede estar vacio");
                    }
                    if($id_producto==""){
                        array_push($campos, "El campo Codigo producto no puede estar vacio");
                    }
                    if($cantidad== ""){
                        array_push($campos, "Ingresa un Cantidad electronico valido");                  
                    }
                    if($fecha== ""){
                        array_push($campos, "El campo Fecha no puede estar vacio");
                    }
                    if($cliente== ""){
                        array_push($campos, "El campo Cliente no puede estar vacio");
                    }

                    if(count($campos) > 0){
                    echo "<div   >";
                    for($i=0; $i< count($campos); $i++){
                        echo "<li class='error'>".$campos[$i]."</li>";
                    }
                    }else{

                            $compararNombre= "SELECT id_producto, precio, unidades_dispon FROM `productos`";  
                            $enviar = mysqli_query($conex, $compararNombre);
                            while($row= mysqli_fetch_array($enviar)){
                                if($id_producto==$row['id_producto']){
                                    $precio=$row['precio'];
                                    $unidades_dispon=$row['unidades_dispon'];
                                    $total=$precio*$cantidad;
                                    $cantidadTotal= $unidades_dispon-$cantidad;
                                    
                                    if($unidades_dispon>=1 && $cantidad<=$unidades_dispon){

                                        $insert_bd= "INSERT INTO `ventas` (id_compra,id_producto,cantidad,pago_total,fecha_compra,nombre_cliente) VALUES ('$id_compra','$id_producto','$cantidad','$total','$fecha','$cliente')"; 
                                        $updateCantidad= "UPDATE productos set unidades_dispon='$cantidadTotal' WHERE id_producto= '$id_producto'";
                                        $enviar2= mysqli_query($conex, $insert_bd);
                                        $enviar3= mysqli_query($conex, $updateCantidad);
                                        echo "<li class='correcto'>Se ha efectuado la venta de forma correcta!</li>";  

                                    }else{
                                        echo "<li class='agotado'>Este producto esta agotado!</li>";  
                                    }



                                }
                            }
                            
                            if(!$enviar){
                                echo"fallo al enviar los datos";
                            }
                    } 
                    echo"</div>";
                }
                ?>
                <?php


                ?>
                </center>
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

    <div class="col-xl-8 ml-5">
            <form action="" class="col form group p-4 bg-light mt-4" method="post">
            <h2>Ventas</h2>
            <input class="form-control" type="number" name="id_compra" placeholder="Codigo compra">
            <input class="form-control" type="text" name="id_producto" placeholder="Codigo producto">
            <input class="form-control" type="number" name="cantidad" placeholder="cantidad">
            <br>
            <label>Fecha de compra</label>
            <input class="form-control" name="fecha" type="date">
            <input class="form-control" type="text" name="cliente" placeholder="nombre cliente">
            <br>
            <center>
                <button type="submit" name="btnGuardar" class="btn btn-info">Subir venta</button>
            </center>
             </form> 

    </div>
    </div>

    <div class="col-xl-11 ml-4">
            <br>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                    <th>Codigo compra</th>
                    <th>Nombre producto</th>
                    <th>Cantidad</th>
                    <th>Fecha de compra</th>
                    <th>Nombre del cliente</th>
                    <th>Total a pagar</th>
                    <th>Reporte</th>
                </tr>
            </thead>
            
            <tbody>
                <?php
                $query = "SELECT * FROM ventas INNER JOIN productos ON ventas.id_producto = productos.id_producto";
                $resultado= mysqli_query($conex, $query);
                while($row= mysqli_fetch_array($resultado)){?> 
                  <tr>
                      <td><?php echo $row['id_compra']?> </td>
                      <td><?php echo $row['nombre_producto']?> </td>
                      <td><?php echo $row['cantidad']?> </td>
                      <td><?php echo $row['fecha_compra']?> </td>
                      <td><?php echo $row['nombre_cliente']?> </td>
                      <td class="bg-warning"><?php echo $row['pago_total']?> </td>
                      <?php } ?>      
                      <td><a class="bg-danger" href="pdf.php">Descargar reporte</a></td>
                    </tr>
            
            </tbody>
            
        </table> 
    </div>


    
</body>
</html>