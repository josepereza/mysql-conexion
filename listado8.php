
 <html>
 <head>
<title>Conexiones a Mysql con clases</title>

<meta charset="utf-8" />
  </head>
  
  <header><h1>CONEXIONES A MYSQL CON CLASES</h1></header>
<style>
  td{
   background-color:greenyellow;  
  
  }
  </style>
 
 </html>       
<?php

class Conexion{
     
   public function conectar(){
   	
       try {
       
           $conexion=new PDO('mysql:host=localhost; dbname=ejemplo', 'root', '123456');
           $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           $conexion->exec("SET CHARACTER SET UTF8");

     
         
       } catch (Exception $e)   {	
   	  
   	    die("Error" . $e->getMessage());
   	    echo "Linea del error" . $e->getLine();
   	
   	}
   	return $conexion;

}
}



class Crud{
	
	public $rows;
	public $conexion;
	
function __construct(){
	
	$model = new Conexion;
	$this->conexion = $model->conectar();


}	
	
function Read() {
	 echo "<h3>LISTADO 2 - Read</h3>";
	
  $campo="categoria";
  $seleccion="b%";

  $sql ="SELECT * FROM productos where nombre like :seleccion ORDER BY $campo";
  try {
    $sentencia = $this->conexion->prepare($sql);
    $sentencia->bindValue(':seleccion', $seleccion, PDO::PARAM_STR);
    $sentencia->execute();
    while ($fila = $sentencia->fetch()) {
     // $datos = $fila[0] ."\t". $fila[1] . "\t" . $fila[2] . "\n";
      // print $datos;
      
     $this->rows[] =$fila;
    }
    $sentencia = null;
  }
  catch (PDOException $e) {
    print $e->getMessage();
  }
}



function leerDatos2() {
		echo "<h3>LISTADO 2</h3>";
	
  $sql = 'SELECT * FROM productos ORDER BY nombre';
  try {
    $sentencia = $this->conexion->prepare($sql);
    $sentencia->execute();
    while ($fila = $sentencia->fetch()) {
     // $datos = $fila[0] ."\t". $fila[1] . "\t" . $fila[2] . "\n";
      // print $datos;
      
      echo $fila[nombre],$fila[descripcion],$fila[categoria],$fila[precio],"<br>";
    }
   $sentencia = null;
  }
  catch (PDOException $e) {
    print $e->getMessage();
  }
}





function leerDatos4() {
	
	
  $sql = 'SELECT * FROM productos ORDER BY nombre';
  try {
    $sentencia = $this->conexion->query($sql);
    echo "<h3>LISTADO 4</h3>";
    while ($fila = $sentencia->fetch()) {
           echo $fila[nombre],$fila[descripcion],$fila[categoria],$fila[precio],"<br>";
    }
 
  $sentencia = null;
  }
  catch (PDOException $e) {
    print $e->getMessage();
  }
}



function borrarDatos4() {
  $sql = "delete FROM productos where nombre like 'zo%'";
  try {
    $count = $this->conexion->exec($sql);
   
    
      
      echo "el numero de registros BORRADOS es,".$count. "<br>";
echo "$count Zeilen wurden gelöscht.\n";
    
    $gbd = null;
  }
  catch (PDOException $e) {
    print $e->getMessage();
  }
}


function leerDatos5($gbd) {
  $sql = "select *  FROM productos where nombre like 'pe%'";
  try {
    $sentencia = $gbd->query($sql);
    
   
    while ($fila = $sentencia->fetch()) {
     // $datos = $fila[0] ."\t". $fila[1] . "\t" . $fila[2] . "\n";
      // print $datos;
      
      echo $fila[nombre],$fila[descripcion],$fila[categoria],$fila[precio],"<br>";
     
    }
   $sentencia = null;
  }
  catch (PDOException $e) {
    print $e->getMessage();
  }
}



function leerDatos6() {
	
	 echo "<h3>LISTADO 6 - leerDatos6</h3>";
	
			
  $sql = "select *  FROM productos"; // where nombre like 'to%'
  try {
    $sentencia = $this->conexion->query($sql);
    
       
    $row=$sentencia->fetchAll();
    
    foreach   ($row as $fila) {
           
      echo $fila[nombre]," ",$fila[descripcion]," ",$fila[categoria]," ",$fila[precio],"<br>";
     
    }
   $sentencia = null;
  }
  catch (PDOException $e) {
    print $e->getMessage();
  }
}


function leerDatos7() {
	 echo "<h3>LISTADO 7</h3>";
  $sql = "select *  FROM productos where nombre like'ba%'";
  try {
    $sentencia = $this->conexion->query($sql);
    
          echo "<table border='1'>";
          echo "<thead style='background:orange';><tr><th>nombre</th><th>descripcion</th><th>categoria</th><th>precio</th></tr></thead>";
       
    while   ($fila=$sentencia->fetch()){
     
      echo "<tr><td>".$fila[nombre] ."</td><td>".$fila[descripcion]."</td><td>".$fila[categoria]."</td><td>".$fila[precio]."</td></tr>";
         
    }
     echo "</table>";
   $sentencia = null;
  }
  catch (PDOException $e) {
    print $e->getMessage();
  }
}



function insertarDatos($nombre, $descripcion, $categoria, $precio) {
	

	
  $sql = 'INSERT INTO productos (nombre,descripcion,categoria,precio) values(:nombre,:descripcion,:categoria,:precio)';
  try {
    $sentencia = $this->conexion->prepare($sql);
    
    $sentencia->bindValue(':nombre', $nombre);  
    $sentencia->bindValue(':descripcion', $descripcion); 
    $sentencia->bindValue(':categoria', $categoria); 
    $sentencia->bindValue(':precio', $precio);   
    
    $sentencia->execute();
    
   $sentencia = null;
  }
  catch (PDOException $e) {
    print $e->getMessage();
  }
}



function actualizarDatos ($nombre,$descripcion) {

	
	$sql2="update productos set descripcion=:descri where nombre=:nom";
   $sql= "select * from productos";
	  
  try {
    $sentencia = $this->conexion->prepare($sql);
    $sentencia2 = $this->conexion->prepare($sql2);
    $sentencia2->bindValue(":descri", $descripcion);
    $sentencia2->bindValue(":nom", $nombre);
   
     $sentencia2->execute();   
    $sentencia->execute();
     echo "<table border='1'>";
          echo "<thead style='background:orange';><tr><th>nombre</th><th>descripcion</th><th>categoria</th><th>precio</th></tr></thead>";
    
    while   ($fila=$sentencia->fetch()){
     // $datos = $fila[0] ."\t". $fila[1] . "\t" . $fila[2] . "\n";
      // print $datos;
      
     
      echo "<tr><td>".$fila[nombre] ."</td><td>".$fila[descripcion]."</td><td>".$fila[categoria]."</td><td>".$fila[precio]."</td></tr>";
           
      
     
    }
     echo "</table>";
    
   $sentencia = null;
  }
  catch (PDOException $e) {
    print $e->getMessage();
  }
}


}


class Listado extends Crud {
	
	function __construct() {
       parent::__construct();
    }


		  function leerDatos22() {
		  	
		  	echo"<h2>prueba leerdatos 22</h2>";
				
		  $sql = 'SELECT * FROM productos ORDER BY nombre';
		  try {
		    $sentencia = $this->conexion->prepare($sql);
		    $sentencia->execute();
		    while ($fila = $sentencia->fetch()) {
		     // $datos = $fila[0] ."\t". $fila[1] . "\t" . $fila[2] . "\n";
		      // print $datos;
		      
		         echo $fila[nombre],$fila[descripcion],$fila[categoria],$fila[precio],"<br>";
		    }
		   $sentencia = null;
		  }
		  catch (PDOException $e) {
		    print $e->getMessage();
		  }
		}

}



//******************CONTROLADOR**********************
$model2= new Crud;
$model2->read();
$matrizProductos=$model2->rows;
foreach ($matrizProductos as $fila){
echo $fila[nombre],$fila[precio];

}

$model2->leerDatos4();
$model2->leerDatos2();
$model2->insertarDatos("Alicates2 ","Alicates de corte numero 2 5 mm","herramientas",20.30);
$model2->actualizarDatos("zopenco","zopenco del norte de Africa central");
$model2->leerDatos6();
$model2->leerDatos7();
$model2->borrarDatos4();

$model3=new Listado;
echo "<br><br><br>";
echo "LISTADOS CON CLASE LISTADO";
echo "<br><br><br>";

$model3->leerDatos22();
$model3->leerDatos4();


	echo"<h2>prueba sin clase pero utilizando conexion de clase Crud</h2>";
				
		  $sql = 'SELECT * FROM productos ORDER BY nombre';
		  try {
		    $sentencia = $model2->conexion->prepare($sql);
		    $sentencia->execute();
		    while ($fila = $sentencia->fetch()) {
		     		      
		         echo $fila[nombre],$fila[descripcion],$fila[categoria],$fila[precio],"<br>";
		    }
		   $sentencia = null;
		  }
		  catch (PDOException $e) {
		    print $e->getMessage();
		  }
?>

