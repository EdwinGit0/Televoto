#!/usr/bin/php -q
<?php
require ('phpagi.php') ;
require ('connect.php');

$agiwrapper = new AGI() ;
ob_implicit_flush(true) ;
set_time_limit(30) ;

$option = $_SERVER['argv'][1];

switch($option){
    case 0: 
		$codigo = $_SERVER['argv'][2];
		$query = 'SELECT * FROM voto WHERE codigo = '.$codigo.' LIMIT 0, 30 ';

		$result = mysql_query($query) or die(mysql_error());
		$row = mysql_fetch_array( $result );
			if($row != NULL){
				$result = $row[1];
			}else{
				$result = "0" ;
			}
		$agiwrapper->set_variable(nombre,$result);
		mysql_close($link);
        break;
    case 1: 
		$codigo = $_SERVER['argv'][2];
		$fecha_ini = $_SERVER['argv'][3];
		$fecha_fin = $_SERVER['argv'][4];

		$sql = "UPDATE voto SET fecha_inicio = '$fecha_ini', fecha_fin = '$fecha_fin' WHERE codigo = $codigo ";
		$retval = mysql_query( $sql, $link );
		if(! $retval ){
			die('Imposible cargar datos: ' . mysql_error());
		}
		echo "Datos ingresados con exito\n";
		mysql_close($link);
        break;        
    case 2:
		$codigo = $_SERVER['argv'][2];
		$habilitado = $_SERVER['argv'][3];
				
		$sql = "UPDATE voto SET habilitado = $habilitado WHERE codigo = $codigo ";
		$retval = mysql_query( $sql, $link );
		if(! $retval ){
			die('Imposible cargar datos: ' . mysql_error());
		}
		echo "Datos ingresados con exito\n";
		mysql_close($link);       
    	break;
	case 3: 
		$codigo = $_SERVER['argv'][2];
	
		$sql = "DELETE FROM voto WHERE codigo = $codigo";
		$retval = mysql_query( $sql, $link );
		if(! $retval ){
			die('Imposible cargar datos: ' . mysql_error());
		}
			echo "Datos ingresados con exito\n";
			mysql_close($link);
		break;        
	case 4:
		$codigo = $_SERVER['argv'][2];
		$numero = $_SERVER['argv'][3];
		
		$sql = "UPDATE voto SET numero = $numero WHERE codigo = $codigo ";
		$retval = mysql_query( $sql, $link );
		if(! $retval ){
			die('Imposible cargar datos: ' . mysql_error());
		}
			echo "Datos ingresados con exito\n";
			mysql_close($link);			   
		break;
	case 5:
		$id = $_SERVER['argv'][2];
                $query = 'SELECT * FROM options WHERE id = '.$id.' LIMIT 0, 30 ';

                $result = mysql_query($query) or die(mysql_error());
                $row = mysql_fetch_array( $result );
                        if($row != NULL){
                                $result = $row[1];
                        }else{
                                $result = "0" ;
                        }
                $agiwrapper->set_variable(sound,$result);
                mysql_close($link);
		break;  
}
?>

