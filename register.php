<!DOCTYPE html>
<?php session_start();  ?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="register_style.css">
</head>
<body>

<div class="container">

<div class="corpo">
<div id="wrap"><h1>Registe-se!</h1></div>
<div id="formulario">
<form id="registo" action="regista.php" method="post">

Nome:<br>
<input type="textbox" name="nome"/><br>
e-mail:<br>
<input type="textbox" name="email"/><br>
password:<br>
<input type="password" name="passw"/><br><br>
<input type="submit" value="Registar!"/>

</form>
</div>
<div id="footer"><p><a href="index.php"><< Voltar ao Index</a></p></div>

</div>

</div>

</body>
</html>