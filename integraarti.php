<?php
$datos=new PDO('mysql:host=localhost; dbname=ejemplo', 'root', '3266root');
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
   
    <head>
    <meta charset="UTF-8">
    <title>MANTENIMIENTO ARTICULOS</title>
    
      <script type="text/javascript" >
       function ordenar(ordnar) {
       	if (ordnar==2)
        		document.f.ordnar.value = "vn";
         else if (ordnar==3) 
            document.f.ordnar.value = "nn";
           else if (ordnar==4)
            document.f.ordnar.value = "gd"; 
            else 	  
            document.f.ordnar.value = "of";		
        
        document.f.submit();
       } 
              
        function grabar(gra1,id) {
       	if (gra1==1)
        		document.f1.gra1.value = "gd";
         else if(gra1==2)   
            document.f1.gra1.value = "bd";	
          else if (gra1==3) {
          	
          	   if (confirm("Desea borrar el registro con id  " + id + " ?")){
          	   	alert('El registro ha sido eliminado correctamente!!!');
               document.f1.gra1.value = "borrar";    }      	
          }  	
        document.f1.id.value = id;
        document.f1.submit();
       } 
       
       
    </script>
</head>
  </head>
  <body>
  <div class="jumbotron jumbotron-fluid mb-0">
  <div class="container">
    <h1 class="display-4">My Single Board Computer</h1>
    <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>
  </div>
</div>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Msbc</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Features</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Pricing</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Listados
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="articulos.php">Articulos</a>
          <a class="dropdown-item" href="#">Another action</a>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Mantenim.
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="altasarticulos3.php">AltasArticulos</a>
          <a class="dropdown-item" href="integraarti.php">Mant.articulos</a>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
    </ul>
  </div>
</nav>
   <div class="container">
  
    <?php
     if(isset($_POST[ordnar]))
        {
        	if($_POST[ordnar]=="vn"){
           	$ordnar2="descripcion";}
           	
         elseif($_POST[ordnar]=="nn"){
           	$ordnar2="seccion";}  	
           	
        	elseif($_POST[ordnar]=="gd"){
        		$ordnar2="precio";}
        		
        	else 	
        	 {$ordnar2="id_articulo";}
        }else {
                      
         $ordnar2="id_articulo";
        }
           
        
       if(isset($_POST[gra1]))
        {
        	if($_POST[gra1]=="gd"){
        		$id=$_POST[id]; 
        		echo $id;       		
  	   $ida=$_POST[ida][$id];   		 
    $descripcion=$_POST[des][$id];
    $seccion=$_POST[sec][$id];
    $precio=$_POST[pre][$id];
       
              		
        		 $sql="update articulos set 
    		 
    descripcion='$descripcion',
    seccion='$seccion',
    precio='$precio'
    
    
    
    where id_articulo=$id";   
    echo $_POST['des'][$id];
    $sentencia=$datos->prepare($sql);      
    $sentencia->execute(); 
        		      		
        		
                }
        	else if($_POST[gra1]=="bd")
        	{
    $ida=$_POST[ida][0];   		 
    $descripcion=$_POST[des][0];
    $seccion=$_POST[sec][0];
    $precio=$_POST[pre][0];
    $stock =50;   
                 
                 
             $sql="insert into articulos(descripcion,seccion,stock,precio) value('$descripcion','$seccion','$stock','$precio')";

        	 /*$sql="insert into mitarbeiter   values ('', '$vorname1', '$nachname1',  '$geburtsdatum1', '$geschlecht1', '$strasse1', '$ort2', '$plz1',  '$land1', '$emailadresse1',  '$telefonnummer1',  '$abteilung1', '$benutzername1', '$passwort1' )" ;  */
         // $sentencia=$datos->prepare($sql);      
        // $sentencia->execute();
        $datos->exec($sql); 	
    
        	
        	}
        	
        	else if($_POST[gra1]=="borrar")
        	
        	{
        		$id=$_POST[id];
             $sql = "DELETE FROM articulos WHERE id_articulo=$id";

    // use exec() because no results are returned
    $datos->exec($sql);
    echo "Record deleted successfully";        	
        	
        	}
        }  
        
         echo "<form name='f' action='integraarti.php' method='post'>";
        	       echo "<input name='ordnar' type='hidden'>";
        	       echo "</form>";  	       

       echo "<form name='f1' action='integraarti.php' method='post'>";
        	       echo "<input name='gra1' type='hidden'>";
        	       echo "<input name='id' type='hidden'>";
        	      
        	       
        	       
     
     
      echo "<table border = '1'> \n"; 
   echo "<tr><td><a href='javascript:ordenar(1);'>id</td><td><a href='javascript:ordenar(2);'>descripcion</td><td><a href='javascript:ordenar(3);'>seccion</td><td><a href='javascript:ordenar(4);'>precio</td></tr> \n"; 
 echo "<tr><td><input name='ida[0]' size='6' readonly='readonly'></td><td>
        	      <input name='des[0]' size='15'</td><td>
        	      <input name='sec[0]' size='12'</td><td>
        	      <input name='pre[0]' size='10'</td><td>" ."<a href='javascript:grabar(2,0);'>agregar</a>"."</td></tr>";
        	                   
        	                   
        	                   



      $query = $datos->query ("select * from articulos order by $ordnar2");
                  
        while ($fila = $query -> fetch(PDO::FETCH_ASSOC)) {
        	$id=$fila["id_articulo"];
        	           
         	     echo "<tr><td><input name='[ida][$id]' value='".$fila["id_articulo"]."' size='6' readonly='readonly'></td><td>
        	      <input name='des[$id]' value='" .$fila[descripcion]."'size='15'</td><td>
        	      <input name='sec[$id]' value='" .$fila[seccion]."'size='12'</td><td>
        	      <input name='pre[$id]' value='" .$fila["precio"]."'size='10'</td><td>"
        	                      ."<a href='javascript:grabar(1,$id);'>modificar</a>"."</td><td>"
        	                   
        	                    ."<a href='javascript:grabar(3,$id);'>borrar</a>"."</td></tr>";
        	                   
                       }
  
           echo"</table>";  
           echo"</form>";
     ?>
      
   
   </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
  </body>
</html>