<?php
class Usuario{
    private $usuario;
    private $password;

    public function inicializar($usuario,$password){
        $this->usuario=$usuario;
        $this->contra=$password;
    }
    public function conectarBD(){
        $con=mysqli_connect("localhost","root","","cinetec") or die ("Problemas de conexion con la base de datos");
        return $con;
    }
    public function validarDatos($usuario,$password){
        $admin=mysqli_query($this->conectarBD(),"select * from empleado where usuario='$usuario' and password='$password'")or die(mysqli_error($this->conectarBD()));
        if($reg=mysqli_fetch_array($admin)){
            header('location:empleado.html');
        }
        else{
            $admin=mysqli_query($this->conectarBD(),"select * from gerente where usuario='$usuario' and password='$password'")or die(mysqli_error($this->conectarBD()));
            if($reg=mysqli_fetch_array($admin)){
            header("location:gerente.html");
            }
            else{
            echo'<script type="text/javascript">
            alert("Correo o Contraseña incorrectos");
            window.location.href="iniciar_sesion.html";
            </script>';
            }
        }
    }


    public function cerrarBD(){
        mysqli_close($this->conectarBD());
    }
    }
?>