<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="logica/validar.css">
    <title>Login</title>
</head>
<body>
    <center>
        <br><br><br>
        <div class="col-xl-8 mt-4">
            <form action="login.php" class="login form group p-4 bg-primary mt-4" name="form" method="POST">
                <h1>Login</h1><br>
                <input type="text" placeholder="Username" class="form-control" name="username"><br>
                <input type="password"placeholder="Contraseña" class="form-control"  name="contraseña"><br>
                <br>
                <input type="submit" value="Iniciar sesion" class="btn btn-info w-auto" name="btnLogin">
                <br><br>
                    <a class="link" href="logica/registro.php">Registrate</a>
                <br>
                <br>
                <?php
                include("logica/conexion.php");

                if(isset($_POST['btnLogin'])){
                    
                session_start(); 

                $username= $_POST[('username')]; 
                $contraseña= $_POST[('contraseña')];

                $sql= "SELECT COUNT(*) AS contar FROM usuario WHERE username= '$username' AND contraseña= '$contraseña'"; 

                $query= mysqli_query($conex, $sql); 
                $array= mysqli_fetch_array($query);

                    if($array['contar']>0){
                        // el nombre de la sesion es el username
                        $_SESSION['username']= $username; 
                        header("location: paginaPrincipal.php");
                    }else{
                        $campos=array(); 

                        if($username== ""){
                            array_push($campos, "El campo Nombre no puede estar vacio");
                        }else{
                            array_push($campos, "Usuario incorrecto!"); 
                        }
                        if($contraseña== ""){
                            array_push($campos, "El campo Contraseña no puede estar vacio");
                        }else{
                            array_push($campos, "Contraseña incorrecta!");
                        }
                        if($campos>0){
                            echo"<div class='error'>";
                            for($i=0; $i<count($campos); $i++){
                                echo"<li>".$campos[$i]."</li>";
                            }
                        }
                    } 
                }
                
            ?>
            </form> 
        </div>
       
    </center>
    
</body>
</html>

