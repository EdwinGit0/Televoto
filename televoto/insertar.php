
<?php
require ('/var/lib/asterisk/agi-bin/phpagi.php') ;

if (isset($_POST['enviar'])) {
        $id2 = trim($_POST['codigo']);
        $id3 = trim($_POST['numero']);
              
#Conexion Mysql
require ('/var/lib/asterisk/agi-bin/connect.php');
//insertar datos segun valores recibidos del asterisk
$sql = "INSERT INTO voto (codigo,habilitado,numero) VALUES ( '$id2', 0, '$id3')";
$retval = mysql_query( $sql, $link );
if(! $retval )
{
echo 'imposible creado';
}
echo 'televoto creado';
mysql_close($link);
}
?>
