<html>
<head>
    <title>Televoto</title> 
<style> .container {
  background-color: #fafafa;
  margin: 1rem;
  padding: 1rem;
  text-align: center;
} 
</style>
</head>
    <body>
	<div class="container">
		<h1>CREAR TELEVOTOS</h1>
		<form  method="post">
  			<p>Codigo: <input type="int" name="codigo" size="40" required></p>
			<p>Numero: <input type="int" name="numero" size="40" required></p>
  	 		<p>
    			<input type="submit" name="enviar">
    			<input type="reset">
  			</p>
		</form>
	<div
	<?php
                include("insertar.php");
            ?>
</body>
</html>


