<?php
class Sucursal{
    private $nombre_sucur;
    public function inicializar($nombre_sucur){
        $this->nomb=$nombre_sucur;
    }
    public function conectarBD(){
        $con=mysqli_connect("localhost","root","","cinetec")or die("Problemas en la conexion");
        return $con;
    }
    public function ingresarSucursal(){
        $bus=mysqli_query($this->conectarBD(),"SELECT * from sucursal where nombre_sucursal='$this->nomb'")or die(mysqli_error($this->conectarBD()));
            if ($reg=mysqli_fetch_array($bus)){
                
                echo '<main class="contenedor">
        <div class="formu">
        <form method="post" action="mantene _socursal.php">
        El nombre de sucursal ya existe
            
            <input type="submit" name="opcion" value="Listar">
        </form>
            
        </div>
                </main>';
            }
            else{
        mysqli_query($this->conectarBD(),"INSERT INTO sucursal(nombre_sucursal)
        VALUES('$this->nomb')")
        or die("Problemas en el insert".mysqli_error($this->conectarBD()));
        echo '<main class="contenedor">
        <div class="formu">
        <form method="post" action="mantene _socursal.php">
            Se agrego una sucursal
            
            <input type="submit" name="opcion" value="Listar">
        </form>
            
        </div>
                </main>';
        }
    }
    public function listarSucursal(){
        $registros=mysqli_query($this->conectarBD(),"SELECT * FROM sucursal") or die ("Problemas para listar colaboradores".mysqli_error($this->conectarBD()));
        echo '<main class="contenedor">
        <h1>Sucursal</h1>

        <div class="servi">
            <table>';
        echo '<tr >
            <th>Agregar <a href="agregar_socursal.html"><i class="fa-solid fa-circle-plus"></i></th></i>
            </tr>
            <tr id="lis">
            <th>ID de sucursal</th><th>Nombre de la sucursal</th><th colspan="2">Opciones</th>
            </tr>';
        while($sucur=mysqli_fetch_array($registros)){
            echo '<tr id="lis"><td>'.$sucur['id_sucursal'].'</td>';
            echo '<td>'.$sucur['nombre_sucursal'].'</td>';
            echo '<td><a href="CtrlEliminarSucu.php?opcion=Borrar&nombre='.$sucur['nombre_sucursal'].'"><i class="fa-solid fa-trash-can"></i></td>
                <td><a href="CtrlModificacionSucu.php?opcion=Modificar&nombre='.$sucur['nombre_sucursal'].'"><i class="fa-solid fa-pen-to-square"></i></td>
                <td><a href="CtrlConsultarSu.php?opcion=Consultar&nombre='.$sucur['nombre_sucursal'].'"><i class="fa-solid fa-magnifying-glass"></i></td></tr>';
        }
        echo '</table>';
        echo '</div>
                </main>
                <footer class="footer">
                <p class="footer__texto">Equipo Trabajo Esmeralda - Todos los derechos Reservados 2022.</p>
            </footer>';
    }
    public function  consutarSucursal($nombre_sucur){
        $registros=mysqli_query($this->conectarBD(),"SELECT * FROM sucursal where nombre_sucursal='$nombre_sucur'") or die ("Problemas para listar colaboradores".mysqli_error($this->conectarBD()));
        echo '<main class="contenedor">
        <h1>Sucursal</h1>

        <div class="servi">
            <table>
            <tr id="lis">
            <th>ID de sucursal</th><th>Nombre de la sucursal</th>
            </tr>';
            if($sucur=mysqli_fetch_array($registros)){
            echo '<tr id="lis"><td>'.$sucur['id_sucursal'].'</td>';
            echo '<td>'.$sucur['nombre_sucursal'].'</td>';

                
        }
        echo '</table>';
        echo '</div>
                </main>';
    }
    
    
    public function eliminarSucur($nombre_sucur){
        $registro=mysqli_query($this->conectarBD(),"SELECT * FROM sucursal WHERE nombre_sucursal = '$nombre_sucur'") or die ("Problemas con la consulta".mysqli_error($this->conectarBD()));
        if($sucur=mysqli_fetch_array($registro)){
            echo '<main class="contenedor">
            <h1>Sucursal</h1>
    
            <div class="formu">
        <form method="post" action="mantene _socursal.php">';

          
            echo ' ID sucursal: '.$sucur['id_sucursal'].'<br>';
        
            mysqli_query($this->conectarBD(),"DELETE FROM sucursal WHERE nombre_sucursal = '$nombre_sucur'") or die("Problemas para eliminar la sucursal".mysqli_error($this->conectarBD()));    
            echo 'Se ha eliminado la sucursal '.$sucur['nombre_sucursal'].'
            <br><br><br>
            <input type="submit" name="opcion" value="Listar"> 
            </form>
            
        </div>';
        }      
        else{
            echo 'No existe una sucursal con ese nombre';
        }	
    }
    public function cerrarBD(){
        mysqli_close($this->conectarBD());
    }
    public function modificarSucursal($nombre_sucur){
        $registro=mysqli_query($this->conectarBD(),"SELECT * FROM sucursal WHERE nombre_sucursal = '$nombre_sucur") or die ("Problemas con la consulta".mysqli_error($this->conectarBD()));
        if($sucur=mysqli_fetch_array($registro)){
            echo '<main class="contenedor">
            <h1>Sucursal</h1>
    
            <div class="formu">
        <form method="post" action="ctrlModificarSucu2.php">
                <input type="number" placeholder="id Sucursal" name="id_sucursal" value='.$sucur['id_sucursal'].' readonly>
                <input placeholder="Titulo de pelicula" type="text" name="nombre_pro" value='.$sucur['nombre_sucursal'].' readonly>
                <input type="submit" name="opcion" value="Cargar">

        </form>
        </div>
        </main>';
        } 
        else {
            echo "No existe esa Sucursal con dicho nombre ";
        }
    }

    public function modificarSucursal2($codigo,$nombre_sucur){
        $peli=mysqli_query($this->conectarBD(),"UPDATE sucursal SET id_sucursal='$codigo', nombre_sucursal='$nombre_sucur'
        WHERE id_sucursal = '$codigo'") or die("Error en la actualización ".mysqli_error($this->conectarBD()));
        echo '<main class="contenedor">
        <div class="formu">
        <form method="post" action="mantene _socursal.php">
            Los datos se modificaron correctamente
            
            <input type="submit" name="opcion" value="Listar">
        </form>
            
        </div>
       
        </main>';
    }
    
    public function cerrarB(){
        mysqli_close($this->conectarBD());
    }
}
?>

