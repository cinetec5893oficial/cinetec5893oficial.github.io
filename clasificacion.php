<?php
class Clasificacion{
    private $tipo;
    private $descripcion;

    public function inicializar($tipo,$descripcion){
        $this->tipo=$tipo;
        $this->desc=$descripcion;
    }
    public function conectarBD(){
        $con=mysqli_connect("localhost","root","","cinetec")or die("Problemas en la conexion");
        return $con;
    }
    
    public function ingresarClasificacion(){
        $bus=mysqli_query($this->conectarBD(),"SELECT * from clasificacion where tipo_clasificacion='$this->tipo'")or die(mysqli_error($this->conectarBD()));
            if ($reg=mysqli_fetch_array($bus)){
                echo '<main class="contenedor">
                <div class="formu">
                <form method="post" action="mantener_clasificacion.php">
                echo "la clasificacion ya fue ingresada
                    
                    <input type="submit" name="opcion" value="Listar">
                </form>
                    
                </div>
                </main>';
        }
                
            
            else{
                mysqli_query($this->conectarBD(),"INSERT INTO clasificacion(tipo_clasificacion,descripcion)
                VALUES('$this->tipo','$this->desc')")
             or die("Problemas en el insert".mysqli_error($this->conectarBD()));
                echo '<main class="contenedor">
                <div class="formu">
                <form method="post" action="mantener_clasificacion.php">
                Se agrego una clasificacion
                    
                    <input type="submit" name="opcion" value="Listar">
                </form>
                    
                </div>
                </main>';
        }
    }
    
    public function listarClasificacion(){
        $registros=mysqli_query($this->conectarBD(),"SELECT * FROM clasificacion") or die ("Problemas para listar colaboradores".mysqli_error($this->conectarBD()));
        echo '<main class="contenedor">
        <h1>Clasificacion</h1>

        <div class="servi">
            <table>';
        echo '<tr >
            <th>Agregar <a href="agregar_clasificacion.html"><i class="fa-solid fa-circle-plus"></i></th></i>
            </tr>
            <tr id="lis">
            <th>ID de clasificacion</th><th>tipo de clasificacion</th><th>descripcion</th><th colspan="2">Opciones</th>
            </tr>';
        while($clasi=mysqli_fetch_array($registros)){
            echo '<tr><td>'.$clasi['id_clasificacion'].'</td>';
            echo '<td>'.$clasi['tipo_clasificacion'].'</td>';
            echo '<td>'.$clasi['descripcion'].'</td>';
            echo '<td><a href="CtrlEliminarClasi.php?opcion=Borrar&tipo='.$clasi['tipo_clasificacion'].'"><i class="fa-solid fa-trash-can"></i></td>
                <td><a href="CtrlModificarClasi.php?opcion=Modificar&tipo='.$clasi['tipo_clasificacion'].'"><i class="fa-solid fa-pen-to-square"></i></td>
                <td><a href="CtrlConsultarClasi.php?opcion=Consultar&tipo='.$clasi['tipo_clasificacion'].'"><i class="fa-solid fa-magnifying-glass"></i></td></tr>';
            echo '</table>';
                echo '</div>
                </main>';
        }
       
    } 
    public function consultarClasi($tipo){
        $registros=mysqli_query($this->conectarBD(),"SELECT * FROM clasificacion WHERE tipo_clasificacion='$tipo'") or die ("Problemas para listar colaboradores".mysqli_error($this->conectarBD()));
        echo '<main class="contenedor">
        <h1>Clasificacion</h1>

        <div class="servi">
            <table>
            <tr id="lis">
            <th >ID de clasificacion</th><th>tipo de clasificacion</th><th>Descripcion</th>
            </tr>';
            if($clasi=mysqli_fetch_array($registros)){
            echo '<tr><td>'.$clasi['id_clasificacion'].'</td>';
            echo '<td>'.$clasi['tipo_clasificacion'].'</td>';
            echo '<td>'.$clasi['descripcion'].'</td>';
            echo '</table>';
                echo '</div>
                </main>';
        }
       
    } 
    
    public function eliminarClasi($tipo){
        $registro=mysqli_query($this->conectarBD(),"SELECT * FROM clasificacion WHERE tipo_clasificacion='$tipo'") or die ("Problemas con la consulta".mysqli_error($this->conectarBD()));
        if($clasi=mysqli_fetch_array($registro)){
            echo '<main class="contenedor">
        <h1>Clasificacion</h1>
        <div class="formu">
        <form method="post" action="mantener_clasificacion.php">
        ID de clasificacion: '.$clasi['id_clasificacion'].'
        tipo clasificacion: '.$clasi['tipo_clasificacion'].'
        descripcion: '.$clasi['descripcion'];
            

            mysqli_query($this->conectarBD(),"DELETE FROM clasificacion WHERE tipo_clasificacion='$tipo'") or die("Problemas para eliminar producto".mysqli_error($this->conectarBD()));    
            echo 'Se ha eliminado la clasificacion 
            <input type="submit" name="opcion" value="Listar">
            </form>
            
            </div>
            </main>';	  
        }      
        else{
            echo 'No existe ese tipo de clasificacion';
        }	
    }
    
    public function modificarClasi($tipo){
        $registro=mysqli_query($this->conectarBD(),"SELECT * FROM clasificacion WHERE tipo_clasificacion = '$tipo'") or die ("Problemas con la consulta".mysqli_error($this->conectarBD()));
        if($clasi=mysqli_fetch_array($registro)){
            echo '<main class="contenedor">
            <h1>Clasificacion</h1>
    
            <div class="formu">
        <form class="formu" method="post" action="CtrlModificarClasi2.php">
                <input  type="number" name="id_clasificacion" placeholder="id_clasificacion" value='.$clasi['id_clasificacion'].' readonly>
                <input  type="text" name="tipo" placeholder="tipo de clasificacion" value='.$clasi['tipo_clasificacion'].' readonly>
                <input  type="text" name="descripcion" placeholder="descripcion" value='.$clasi['descripcion'].' >
                <input  type="submit" name="opcion" value="Cargar">
        </form>
        </div>
    </main>';
            
        } 
        else {
            echo "No existe esa clasificacion con dicho tipo de clasificacion";
        }
    }

    public function modificarClasi2($codigo,$tipo,$descripcion){
        $peli=mysqli_query($this->conectarBD(),"UPDATE clasificacion SET id_clasificacion='$codigo',tipo_clasificacion='$tipo', descripcion='$descripcion' WHERE id_clasificacion='$codigo'") or die("Error en la actualización ".mysqli_error($this->conectarBD()));
        echo '<main class="contenedor">
        <div class="formu">
                <form method="post" action="mantener_clasificacion.php">
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
