<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CineTec</title>
    <script src="https://kit.fontawesome.com/a7b63346b3.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="img/logo.png" />
    <link rel="preload" href="css/normalize.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="preload" href="css/styles.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header class="header">
        <a href="index.html">
            <img class="header__logo" src="img/logo.png" alt="logo">
        </a>
        <h1>CineTec</h1>
    </header>
    <!-- BARRA DE NAVEGACION -->
    <nav class="navegacion">
        <a class="navegacion__enlace " href="empleado.html">Inicio</a>
        <a class="navegacion__enlace " href="mantene _socursal.php?opcion=Listar"> Socursal</a>
        <a class="navegacion__enlace " href="mantener_sala.html"> Sala</a>
        <a class="navegacion__enlace " href="mantener_horario.html"> Horario</a>
        <a class="navegacion__enlace " href="mantener_pelicula.php?opcion=Listar"> Pelicula</a>
        <a class="navegacion__enlace " href="mantener_genero.php?opcion=Listar"> Genero</a>
        <a class="navegacion__enlace " href="mantener_clasificacion.php?opcion=Listar"> Clasificacion</a>
        <a class="navegacion__enlace " href="programar_funcion.html"> Programar Pelicula</a>
        
    </nav>
    <main>
        
                <?php
                    include("pelicula.php");
                    $peli=new Pelicula();
                    switch ($_REQUEST['opcion']) {
                        case "Consultar":
                            $peli->consultarPelicula(($_REQUEST['titulo']));
                            break;
                    }
                    $peli->cerrarBD();
                 ?>
          
    </main>
    
    
    
       
    <footer class="footer">
        <p class="footer__texto">Equipo Trabajo Esmeralda - Todos los derechos Reservados 2022.</p>
    </footer>

</body>
</html>