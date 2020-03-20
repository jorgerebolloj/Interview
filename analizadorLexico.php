<!DOCTYPE HTML>  
<html>
<head>
<meta charset="UTF-8"/>
<style>
.error {color: #FF0000;}
.result {color: #000000;}
</style>
</head>
<body>  

<?php
// definiendo variables y seteando valores vacios
$inputString = "";
$coord1 = $coord2 = $coord3 = "";
$subString1 = $subString2 = $subString3 = "";
$result = "";

function inputString_validation($string) {
	
	
	$coord1 = setCoord1();
	$coord2 = setCoord2();
	$coord3 = setCoord3();
	return $coordArray = array($coord1, $coord2, $coord3);
}

function setCoord1() {
	$coord1String = '01 aajakja';
	return $coord1String;
}

function setCoord2() {
	$coord2String = '02 kldskldsklds';
	return $coord2String;
}

function setCoord3() {
	$coord3String = '03 lksdkldsklsd';
	return $coord3String;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["inputString"])) {
    $inputStringErr = "No puede estar vacío el campo de texto";
  } else if (strlen($_POST["inputString"]) > 250) {
  	$inputStringErr = "La cadena no puede contener más de 250 caracteres.";
  } else {
    $result = inputString_validation($_POST["inputString"]);
  }
}
?>

<h2>Analizador Léxico</h2>
<p><span class="error">* campo requerido</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Texto en formato (X1,Y1)texto1(X2,Y2)texto2(X3,Y3)texto3: <input type="text" name="inputString" value="<?php echo $inputString;?>">
  <span class="error">* <?php echo $inputStringErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="Analizar">
</form>
<br><br>
<h3>Resultado:</h3>
<span class="result"><?php foreach ($result as $key => $val) {
   echo $val."<br/>";
} ?></span>

</body>
</html>