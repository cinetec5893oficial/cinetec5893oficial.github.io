<?php
class Pelicula{
    private $titulo;
    private $duracion;
    private $fecha_exi;
    private $sinopsip;
    private $estatus;
    private $imagen;
    public function inicializar($titulo,$duracion,$fecha_exi,$sinopsip,$estatus,$imagen){
        $this->titulo=$titulo;
        $this->duracion=$duracion;
        $this->fecha_exi=$fecha_exi;
        $this->sinop=$sinopsip;
        $this->esta=$estatus;
        $this->ima=$imagen;

    }
    public function conectarBD(){
        $con=mysqli_connect("localhost","root","","cinetec")or die("Problemas en la conexion");
        return $con;
    }
    public function ingresarPelicula(){
        $bus=mysqli_query($this->conectarBD(),"SELECT * from pelicula where titulo_pelicula='$this->titulo'")or die(mysqli_error($this->conectarBD()));
            if ($reg=mysqli_fetch_array($bus)){
                echo '<main class="contenedor">
        <div class="formu">
        <form method="post" action="mantener_pelicula.php">
        la pelicula  ya existe
            
            <input type="submit" name="opcion" value="Listar">
        </form>
            
        </div>
       
        </main>'; 
                
            }
            else{
        mysqli_query($this->conectarBD(),"INSERT INTO pelicula(titulo_pelicula,duracion,fecha_exibicion,sinopsis,estatus,imagen)
        VALUES('$this->titulo',$this->duracion,'$this->fecha_exi','$this->sinop','$this->esta','$this->ima')")
        or die("Problemas en el insert".mysqli_error($this->conectarBD()));
        echo '<main class="contenedor">
        <div class="formu">
        <form method="post" action="mantener_pelicula.php">
        Se agrego una pelicula
            <input type="submit" name="opcion" value="Listar">
        </form>
            
       
        </div>
                </main>';
        }
    }
    
    public function listarPelicula(){
        $registros=mysqli_query($this->conectarBD(),"SELECT * FROM pelicula") or die ("Problemas para listar colaboradores".mysqli_error($this->conectarBD()));
        echo '<main class="contenedor">
        <h1>Pelicula</h1>

        <div class="servi">
            <table>';
        echo '<tr id="lis">
            <th>Agregar <a href="agregar_pelicula.html"><i class="fa-solid fa-circle-plus"></i></th></i>
            </tr>
            <tr id="lis">
            <th>ID de pelicula</th><th>titulo</th><th>duracion</th><th>fecha_exibicion</th><th>sinopsis</th><th>estatus</th><th>imagen</th><th colspan="2">Opciones</th>
            </tr>';
        while($peli=mysqli_fetch_array($registros)){
            echo '<tr id="lis"><td>'.$peli['id_pelicula'].'</td>';
            echo '<td>'.$peli['titulo_pelicula'].'</td>';
            echo '<td>'.$peli['duracion'].'</td>';
            echo '<td>'.$peli['fecha_exibicion'].'</td>';
            echo '<td>'.$peli['sinopsis'].'</td>';
            echo '<td>'.$peli['estatus'].'</td>';
            echo '<td>'.$peli['imagen'].'</td>';
            echo '<td><a href="CtrlEliminarPeli.php?opcion=Borrar&titulo='.$peli['titulo_pelicula'].'"><i class="fa-solid fa-trash-can"></i></td>
                <td><a href="CtrlModificarPeli.php?opcion=Modificar&titulo='.$peli['titulo_pelicula'].'"><i class="fa-solid fa-pen-to-square"></i></td>
                <td><a href="CtrlConsultaPeli.php?opcion=Consultar&titulo='.$peli['titulo_pelicula'].'"><i class="fa-solid fa-magnifying-glass"></i></td></tr>';
        }
        echo '</table>';
        echo '</div>
                </main>';
    }
    public function  consultarPelicula($titulo){
        $registro=mysqli_query($this->conectarBD(),"SELECT * FROM pelicula WHERE titulo_pelicula = '$titulo'") or die ("Problemas para listar colaboradores".mysqli_error($this->conectarBD()));
        if($peli=mysqli_fetch_array($registro)){
            echo '<main class="contenedor">
        <h1>Pelicula</h1>

        <div class="servi">
            <table>';
        echo '
            <tr id="lis">
            <th>ID de pelicula</th><th>titulo</th><th>duracion</th><th>fecha_exibicion</th><th>sinopsis</th><th>estatus</th><th>imagen</th>
            </tr>';
            
            echo '<tr id="lis"><td>'.$peli['id_pelicula'].'</td>';
            echo '<td>'.$peli['titulo_pelicula'].'</td>';
            echo '<td>'.$peli['duracion'].'</td>';
            echo '<td>'.$peli['fecha_exibicion'].'</td>';
            echo '<td>'.$peli['sinopsis'].'</td>';
            echo '<td>'.$peli['estatus'].'</td>';
            echo '<td>'.$peli['imagen'].'</td>';
        

        echo '</table>';
        echo '</div>
                </main>';
    }        
}      
    public function catalogoPelicula(){
        $registros=mysqli_query($this->conectarBD(),"SELECT * FROM pelicula") or die ("Problemas para listar productos".mysqli_error($this->conectarBD()));
        while($pelicula=mysqli_fetch_array($registros)){

            echo '<main class="contenedor">
            <h1>Estrenos</h1>
            <div class="grid">
                <div class="producto">
                    <a href="pelicula.html">
                        <img class="producto__imagen" src="img/'.$pelicula['imagen'].'" alt="imagen camisa">
                        <div class="producto__informacion">
                            <p class="producto__nombre">'.$pelicula['titulo_pelicula'].'</p>
                            <p class="producto__precio">Hora de Inicio</p>
                        </div>
                    </a>
                </div>  <!--.producto-->
                <div class="producto">
                <a href="pelicula.html">
                    <img class="producto__imagen" src="img/'.$pelicula['imagen'].'" alt="imagen camisa">
                    <div class="producto__informacion">
                        <p class="producto__nombre">'.$pelicula['titulo_pelicula'].'</p>
                        <p class="producto__precio">Hora de Inicio</p>
                    </div>
                </a>
            </div>  <!--.producto-->
            <div class="producto">
            <a href="pelicula.html">
                <img class="producto__imagen" src="img/'.$pelicula['imagen'].'" alt="imagen camisa">
                <div class="producto__informacion">
                    <p class="producto__nombre">'.$pelicula['titulo_pelicula'].'</p>
                    <p class="producto__precio">Hora de Inicio</p>
                </div>
            </a>
        </div>  <!--.producto-->
        <div class="producto">
        <a href="pelicula.html">
            <img class="producto__imagen" src="img/'.$pelicula['imagen'].'" alt="imagen camisa">
            <div class="producto__informacion">
                <p class="producto__nombre">'.$pelicula['titulo_pelicula'].'</p>
                <p class="producto__precio">Hora de Inicio</p>
            </div>
        </a>
    </div>  <!--.producto-->
                <<div class="producto">
                <a href="pelicula.html">
                    <img class="producto__imagen" src="img/'.$pelicula['imagen'].'" alt="imagen camisa">
                    <div class="producto__informacion">
                        <p class="producto__nombre">'.$pelicula['titulo_pelicula'].'</p>
                        <p class="producto__precio">Hora de Inicio</p>
                    </div>
                </a>
            </div>  <!--.producto-->
            <div class="producto">
            <a href="pelicula.html">
                <img class="producto__imagen" src="img/'.$pelicula['imagen'].'" alt="imagen camisa">
                <div class="producto__informacion">
                    <p class="producto__nombre">'.$pelicula['titulo_pelicula'].'</p>
                    <p class="producto__precio">Hora de Inicio</p>
                </div>
            </a>
        </div>  <!--.producto-->
     </div>

</main>';
        }
    }
    public function nombrarimagen($titulo,$duracion,$fecha_exi,$sinopsip,$estatus){
        if(isset($_FILES["imagen"])){
            $extension = explode('.', $_FILES["imagen"]['name']);
            $nuevo_nombre = rand() . '.' . $extension[1];
            $ruta = $_FILES["imagen"]['tmp_name'];
            $ubicacion = './Tnimagen/' . $nuevo_nombre;
            move_uploaded_file($ruta,$ubicacion);
            header("location:CtrlPelicula.php?opcion=regis&titulo=".$titulo."&duracion=".$duracion."&fecha_exibicion=".$fecha_exi."&sinopsis=".$sinopsip."&estatus=".$estatus."&imagen=".$ubicacion."");
        
        }
    }
    public function eliminarPeli($titulo){
        $registro=mysqli_query($this->conectarBD(),"SELECT * FROM pelicula WHERE titulo_pelicula = '$titulo'") or die ("Problemas con la consulta".mysqli_error($this->conectarBD()));
        if($peli=mysqli_fetch_array($registro)){
            echo '<main class="contenedor">
            <h1>Clasificacion</h1>
            <div class="formu">
        <form method="post" action="mantene _pelicula.php">
            ID pelicula: '.$peli['id_pelicula'].'<br>
            titulo de la peli:  '.$peli['titulo_pelicula'].'<br>
            duracion: '.$peli['duracion'].'<br>
            fecha de exibicion: '.$peli['fecha_exibicion'].'<br>
            sinopsis: '.$peli['sinopsis'].'<br>
       estatus: '.$peli['estatus'].'<br>
         imagen: '.$peli['imagen'].'<br>';

    
           
              

            mysqli_query($this->conectarBD(),"DELETE FROM pelicula WHERE titulo_pelicula = '$titulo'") or die("Problemas para eliminar producto".mysqli_error($this->conectarBD()));    
            echo 'Se ha eliminado la pelicula '.$peli['titulo_pelicula'].'
            <input type="submit" name="opcion" value="Listar">
        </form>
            
       
        </div>
            </main>';	  
        }      
        else{
            echo 'No existe una pelicula con ese titulo';
        }	
    }
    
    public function modificarPeli($titulo){
        $registro=mysqli_query($this->conectarBD(),"SELECT * FROM pelicula WHERE titulo_pelicula = '$titulo'") or die ("Problemas con la consulta".mysqli_error($this->conectarBD()));
        if($peli=mysqli_fetch_array($registro)){
            echo '<main class="contenedor">
            <h1>Genero</h1>
    
            <div class="formu">
        <form  method="post" action="ctrlModificarPelicula2.php">
                <input  type="number" placeholder="ID de Pelicula" name="id_pelicula" value='.$peli['id_pelicula'].' readonly>
                <input type="text" name="titulo" placeholder="Titulo de pelicula"value='.$peli['titulo_pelicula'].' readonly>
                <input  type="number" placeholder="name="duracion"  value='.$peli['duracion'].' >
                <input  type="date" placeholder="Fecha de exibicion " name="fecha_exi"  value='.$peli['fecha_exibicion'].'>
                <input  type="text" placeholder="Sinopsis" name="sinopsis" value='.$peli['sinopsis'].'>
                <input  type="text"placeholder="Estatus"  name="estatus" value='.$peli['estatus'].'>
                <input class="controls" type="file" name="imagen"  value='.$peli['imagen'].'>
                <input class="boton" type="submit" name="opcion" value="Cargar">
        </form>
        </div>
        </main>';
            
        } 
        else {
            echo "No existe esa pelicula con dicho tipo de clasificacion";
        }
    }

    public function modificarPeli2($codigo,$titulo,$duracion,$fecha_exi,$sinopsis,$estatus,$imagen){
        $peli=mysqli_query($this->conectarBD(),"UPDATE pelicula SET id_pelicula='$codigo', titulo_pelicula='$titulo', duracion='$duracion', fecha_exibicion='$fecha_exi', sinopsis='$sinopsis',
        estatus='$estatus', imagen='$imagen' WHERE id_pelicula = '$codigo'") or die("Error en la actualización ".mysqli_error($this->conectarBD()));
        echo '<main class="contenedor">
        <h1>Genero</h1>
        <div class="formu">
        <form method="post" action="mantener_pelicula.php">
        Los datos se modificaron correctamente
            <input type="submit" name="opcion" value="Listar">
        </form>
            
        </div>
        
                </main>';
    }
    

    public function cerrarBD(){
        mysqli_close($this->conectarBD());
    }
}
?>