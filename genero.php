<?php
class Genero{  
    private $nombre_gene;
    private $descripcion;

    public function inicializar($nombre_gene,$descripcion){
        $this->nomb=$nombre_gene;
        $this->desc=$descripcion;
    }
    public function conectarBD(){
        $con=mysqli_connect("localhost","root","","cinetec")or die("Problemas en la conexion");
        return $con;
    }
    public function ingresarGenero(){
        $bus=mysqli_query($this->conectarBD(),"SELECT * from genero where nombre_genero='$this->nomb'")or die(mysqli_error($this->conectarBD()));
            if ($reg=mysqli_fetch_array($bus)){
                echo '<main class="contenedor">
                <div class="formu">
                <form method="post" action="mantener_genero.php">
                El nombre del genero ya existe
                    
                    <input type="submit" name="opcion" value="Listar">
                </form>
                    
                </div>
                </main>';
                
            }
            else{
            mysqli_query($this->conectarBD(),"INSERT INTO genero(nombre_genero,descripcion)
            VALUES('$this->nomb','$this->desc')")
            or die("Problemas en el insert".mysqli_error($this->conectarBD()));
        
        echo '<main class="contenedor">
                <div class="formu">
                <form method="post" action="mantener_genero.php">
                Se agrego una genero
                    
                    <input type="submit" name="opcion" value="Listar">
                </form>  
                </div>
                </main>';
        }
    }
    public function listarGenero(){
        $registros=mysqli_query($this->conectarBD(),"SELECT * FROM genero") or die ("Problemas para listar colaboradores".mysqli_error($this->conectarBD()));
        echo '<main class="contenedor">
        <h1>Genero</h1>

        <div class="servi">
            <table>';
        echo '<tr>
            <th>Agregar <a href="agregar_genero.html"><i class="fa-solid fa-circle-plus"></i></th></i>
            </tr>
            <tr id="lis">
            <th>ID de genero</th><th>Nombre del genero</th><th>Descripcion</th> <th colspan="2">Opciones</th>
            </tr>';
        while($gene=mysqli_fetch_array($registros)){
            echo '<tr id="lis"><td>'.$gene['id_genero'].'</td>';
            echo '<td>'.$gene['nombre_genero'].'</td>';
            echo '<td>'.$gene['descripcion'].'</td>';
            echo '<td><a href="CtrlEliminarGene.php?opcion=Borrar&nombre='.$gene['nombre_genero'].'"><i class="fa-solid fa-trash-can"></i></td>
                <td><a href="CtrlModificarGene.php?opcion=Modificar&nombre='.$gene['nombre_genero'].'"><i class="fa-solid fa-pen-to-square"></i></td>
                <td><a href="CtrlConsultarGene.php?opcion=Consultar&nombre='.$gene['nombre_genero'].'"><i class="fa-solid fa-magnifying-glass">';
        }
        echo '</table>';
        echo '</div>
                </main>';
    }
    public function consultarGenero($nombre_gene){
        $registros=mysqli_query($this->conectarBD(),"SELECT * FROM genero WHERE nombre_genero = '$nombre_gene'") or die ("Problemas para listar colaboradores".mysqli_error($this->conectarBD()));
        echo '<main class="contenedor">
        <h1>Genero</h1>

        <div class="servi">
            <table>
            <tr id="lis">
            <th>ID de genero</th><th>Nombre del genero</th><th>Descripcion</th>
            </tr>';
            if($gene=mysqli_fetch_array($registros)){
            echo '<tr id="lis"><td>'.$gene['id_genero'].'</td>';
            echo '<td>'.$gene['nombre_genero'].'</td>';
            echo '<td>'.$gene['descripcion'].'</td>';
           
        }
        echo '</table>';
        echo '</div>
                </main>';
    }
    public function eliminarGene($nombre_gene){
        $registro=mysqli_query($this->conectarBD(),"SELECT * FROM genero WHERE nombre_genero = '$nombre_gene'") or die ("Problemas con la consulta".mysqli_error($this->conectarBD()));
        if($gene=mysqli_fetch_array($registro)){
            echo '<main class="contenedor">
            <h1>Clasificacion</h1>
            <div class="formu">
                <form method="post" action="mantener_genero.php"><br>
                ID genero: '.$gene['id_genero'].'<br>
                Nombre de genero: '.$gene['nombre_genero'].'<br>
                Descripcion: '.$gene['descripcion'].'<br>';

        
            mysqli_query($this->conectarBD(),"DELETE FROM genero WHERE nombre_genero = '$nombre_gene'") or die("Problemas para eliminar la sucursal".mysqli_error($this->conectarBD()));    
            echo 'Se ha eliminado el genero '.$gene['nombre_genero'].'	
            <input type="submit" name="opcion" value="Listar">  
            </form>
                    
                </div>
            </main>';
        }      
        else{
            echo 'No existe un genero con ese nombre';
        }	
    }
    
    public function modificarGene($nombre_gene){
        $registro=mysqli_query($this->conectarBD(),"SELECT * FROM genero WHERE nombre_genero = '$nombre_gene'") or die ("Problemas con la consulta".mysqli_error($this->conectarBD()));
        if($gene=mysqli_fetch_array($registro)){
            echo '<main class="contenedor">
            <h1>Genero</h1>
    
            <div class="formu">
                
        <form  method="post" action="ctrlModificarGene2.php">
                <input  type="number"placeholder="id_genero" name="id_genero" value='.$gene['id_genero'].' readonly>
                <input  type="text" placeholder=nombre del genero" name="nombre" value='.$gene['nombre_genero'].' readonly>
                <input type="text" name="descripcion" placeholder="descripcion" value='.$gene['descripcion'].' >
                <input  type="submit" name="opcion" value="Cargar">
        </form>
        </div>
        </main>';
            
        } 
        else {
            echo "No existe es Genero con dicho nombre ";
        }
    }

    public function modificarGene2($codigo,$nombre_gene,$descripcion){
        $peli=mysqli_query($this->conectarBD(),"UPDATE genero SET id_genero='$codigo', nombre_genero='$nombre_gene', descripcion='$descripcion' 
        WHERE id_genero = '$codigo'") or die("Error en la actualización ".mysqli_error($this->conectarBD()));
         echo '<main class="contenedor">
         <h1>Genero</h1>
         <div class="formu">
                <form method="post" action="mantener_genero.php">
                Los datos se modificaron correctamente
      
                <input type="submit" name="opcion" value="Listar">
        </form>
        </main>';
    }
    

    public function cerrarBD(){
        mysqli_close($this->conectarBD());
    }
}