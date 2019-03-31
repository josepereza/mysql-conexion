
 <html>
 
<style>
  td{
   background-color:greenyellow;  
  
  }
  </style>
 
 </html>       
<?php

try{
$datos=new PDO ( "mysql:host=localhost; dbname=FlughafenDB;charset=utf8", "root", "3266root");

$query = $datos->query ("select * from buchung limit 100");
        while ($fila = $query -> fetch(PDO::FETCH_OBJ)) {
               echo $fila->flug_id ." precio ....". $fila->preis .'<br>';
    }
}catch(PDOException  $e ){
echo "Error: ".$e;
}



$datos2=new PDO ( "mysql:host=localhost; dbname=ejemplo;charset=utf8", "root", "3266root");


function leerDatosHaciaAdelante($gbd) {

  $campo="categoria";
  $seleccion="b%";

  $sql ="SELECT * FROM productos where nombre like :seleccion ORDER BY $campo";
  try {
    $sentencia = $gbd->prepare($sql);
    $sentencia->bindValue(':seleccion', $seleccion, PDO::PARAM_STR);
    $sentencia->execute();
    while ($fila = $sentencia->fetch()) {
     // $datos = $fila[0] ."\t". $fila[1] . "\t" . $fila[2] . "\n";
      // print $datos;
      
      echo $fila[0],$fila[1],$fila[2],$fila[3],"<br>";
    }
    $sentencia = null;
  }
  catch (PDOException $e) {
    print $e->getMessage();
  }
}



function leerDatos2($gbd) {
  $sql = 'SELECT * FROM productos ORDER BY nombre';
  try {
    $sentencia = $gbd->prepare($sql);
    $sentencia->execute();
    while ($fila = $sentencia->fetch()) {
     // $datos = $fila[0] ."\t". $fila[1] . "\t" . $fila[2] . "\n";
      // print $datos;
      
      echo $fila[nombre],$fila[descripcion],$fila[categoria],$fila[precio],"<br>";
    }
   $gbd = null;
  }
  catch (PDOException $e) {
    print $e->getMessage();
  }
}


function leerDatos3($gbd) {
  $sql = 'SELECT * FROM productos ORDER BY nombre';
  try {
    $sentencia = $gbd->query($sql);
   
    while ($fila = $sentencia->fetch()) {
     // $datos = $fila[0] ."\t". $fila[1] . "\t" . $fila[2] . "\n";
      // print $datos;
      
      echo $fila[nombre],$fila[descripcion],$fila[categoria],$fila[precio],"<br>";
    }
   $gbd = null;
  }
  catch (PDOException $e) {
    print $e->getMessage();
  }
}


function borrarDatos4($gbd) {
  $sql = "delete FROM productos where nombre like 'mo%'";
  try {
    $count = $gbd->exec($sql);
   
    
      
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
   $gbd = null;
  }
  catch (PDOException $e) {
    print $e->getMessage();
  }
}


function leerDatos6($gbd) {
  $sql = "select *  FROM productos"; // where nombre like 'to%'
  try {
    $sentencia = $gbd->query($sql);
    
       
    $row=$sentencia->fetchAll();
    
    foreach   ($row as $fila) {
     // $datos = $fila[0] ."\t". $fila[1] . "\t" . $fila[2] . "\n";
      // print $datos;
      
      echo $fila[nombre],$fila[descripcion],$fila[categoria],$fila[precio],"<br>";
     
    }
   $gbd = null;
  }
  catch (PDOException $e) {
    print $e->getMessage();
  }
}


function leerDatos7($gbd) {
  $sql = "select *  FROM productos where nombre like'ba%'";
  try {
    $sentencia = $gbd->query($sql);
    
          echo "<table border='1'>";
          echo "<thead style='background:orange';><tr><th>nombre</th><th>descripcion</th><th>categoria</th><th>precio</th></tr></thead>";
       
    while   ($fila=$sentencia->fetch()){
     // $datos = $fila[0] ."\t". $fila[1] . "\t" . $fila[2] . "\n";
      // print $datos;
      

     
      echo "<tr><td>".$fila[nombre] ."</td><td>".$fila[descripcion]."</td><td>".$fila[categoria]."</td><td>".$fila[precio]."</td></tr>";
     
      
      
      
     
    }
     echo "</table>";
   $gbd = null;
  }
  catch (PDOException $e) {
    print $e->getMessage();
  }
}


function insertarDatos($gbd, $nombre, $descripcion, $categoria, $precio) {
	
	
	
	
  $sql = 'INSERT INTO productos (nombre,descripcion,categoria,precio) values(:nombre,:descripcion,:categoria,:precio)';
  try {
    $sentencia = $gbd->prepare($sql);
    
    $sentencia->bindValue(':nombre', $nombre);  
    $sentencia->bindValue(':descripcion', $descripcion); 
    $sentencia->bindValue(':categoria', $categoria); 
    $sentencia->bindValue(':precio', $precio);   
    
    $sentencia->execute();
    
   $gbd = null;
  }
  catch (PDOException $e) {
    print $e->getMessage();
  }
}

function actualizarDatos($gbd,$nombre,$descripcion) {
	
	
	
	$sql2="update productos set descripcion=:descri where nombre=:nom";
   $sql= "select * from productos";
	  
  try {
    $sentencia = $gbd->prepare($sql);
    $sentencia2 = $gbd->prepare($sql2);
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
    
   $gbd = null;
  }
  catch (PDOException $e) {
    print $e->getMessage();
  }
}



actualizarDatos($datos2,'pepita','jabon de marsella');
 
echo "<br><br><br>";
print "<h2>Esto es la prueba1</h2>";
echo "<br><br><br>";

leerDatosHaciaAdelante($datos2);

echo "<br><br><br>";
print "<h2>Esto es la prueba2</h2>";
echo "<br><br><br>";
leerDatos2($datos2);

echo "<br><br><br>";
print "<h2>Esto es la prueba3e</h2>";
echo "<br><br><br>";
leerDatos3($datos2);

echo "<br><br><br>";
print "<h2>Esto es  prueba 4</h2>";
echo "<br><br><br>";
borrarDatos4($datos2);

echo "<br><br><br>";
print "<h2>Esto es  prueba 5</h2>";
echo "<br><br><br>";
leerDatos5($datos2);

echo "<br><br><br>";
print "<h2>Esto es  prueba 6</h2>";
echo "<br><br><br>";

leerDatos6($datos2);

echo "<br><br><br>";
print "<h2>Esto es  prueba 7</h2>";
echo "<br><br><br>";

leerDatos7($datos2);
insertarDatos($datos2,'zopenco','zopenco del norte de africa','deportes',100);
echo "<br><br><br>";
print "<h2>Esto es  prueba 8</h2>";
echo "<br><br><br>";

actualizarDatos($datos2,'pepita','leche con y miel jabon');
insertarDatos($datos2,'zopenco2','zopenco2 del norte de africa','deportes',100);
insertarDatos($datos2,'zopenco5','zopenco5 del norte de africa y america','deportes',300);


?>

