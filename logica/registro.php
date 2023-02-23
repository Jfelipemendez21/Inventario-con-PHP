<?php

    include("conexion.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="validar.css">
    <title>Registro</title>
    
</head>
<body>

<center>
<form action="" class="regis_login form group p-4 col-xl-8 mt-4 bg-primary" method="POST">
        <?php 
        if(isset($_POST['btnGuardar'])){
            $Nombre= $_POST[('nombre')]; 
            $cedula= $_POST[('cedula')];
            $Correo= $_POST[('correo')];
            $Telefono= $_POST[('telefono')];
            $username= $_POST[('username')];
            $Contraseña= $_POST[('contraseña')];

            $campos=array(); 

            if($Nombre== ""){
                array_push($campos, "El campo Nombre no puede estar vacio");
            }
            if($cedula== ""){
                array_push($campos, "El campo Cedula no puede estar vacio");
            }
            if($Correo== "" || strpos($Correo, "@")===false){
                array_push($campos, "Ingresa un correo electronico valido");
            }
            if($Telefono== ""){
                array_push($campos, "El campo Telefono no puede estar vacio");
            }
            if($username== ""){
                array_push($campos, "El campo Username no puede estar vacio");
            }
            if($Contraseña== "" || strlen($Contraseña < 10)){
                array_push($campos, "El campo Contraseña no puede estar vacio, ni tener menos de 10 caracteres");
            }
            

            if(count($campos) > 0){
               echo "<div class='error'>";
               for($i=0; $i< count($campos); $i++){
                echo "<li>".$campos[$i]."</li>";
               }
            }else{
                echo "<div class='correcto'>Se ha creado su usuario de forma correcta!</div>"; 
                
                if(isset($_POST['btnGuardar'])){

                    $Nombre= $_POST[('nombre')]; 
                    $cedula= $_POST[('cedula')];
                    $Correo= $_POST[('correo')];
                    $Telefono= $_POST[('telefono')];
                    $username= $_POST[('username')];
                    $Contraseña= $_POST[('contraseña')];


                    $insert_bd= "INSERT INTO `usuario` (nombre,cedula,correo,telefono,username,contraseña) VALUES ('$Nombre','$cedula','$Correo','$Telefono','$username','$Contraseña')"; 
                    
                    $enviar = mysqli_query($conex, $insert_bd);
                    
                    if(!$enviar){

                        echo"fallo al enviar los datos";
                    }
                } 

            }
            echo"</div>";
        }
        ?>
        <h1>Registro</h1><br>
        <input type="text" placeholder="Nombre"  class="form form-control" name="nombre"><br>   
        <input type="number" placeholder="Cedula"  class="form form-control" name="cedula"><br>
        <input type="number" placeholder="Telefono"  class="form form-control" name="telefono"><br>
        <input type="text" placeholder="Correo"  class="form form-control" name="correo"><br>
        <input type="text" placeholder="Username"  class="form form-control" name="username"><br>
        <input type="password" placeholder="Contraseña" class="form form-control" name="contraseña"><br>
        <br><br>
        <input type="submit" value="Guardar" class="col btn btn-success" name="btnGuardar">
        <br><br>
        <a class="link" href="../login.php">Iniciar sesion</a>
    </form>
</center>

      
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="validarDatos.js"></script>
</body>
</html>

<?php

?>