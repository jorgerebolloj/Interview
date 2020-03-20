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
			$inputNumber = "";
			$output_array = "";
			$coord1 = $coord2 = $coord3 = "";

			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				if (empty($_POST["inputNumber"])) {
					$inputStringErr = "No puede estar vacío el campo";
				} else if ($_POST["inputNumber"] < 10 || $_POST["inputNumber"]> 10000) {
					$inputStringErr = "El número no puede ser menor a 10 y mayor a 10000";
				} else {
					$result = inputNumber_process($_POST["inputNumber"]);
				}
			}

			function inputNumber_process($number) {
				$inputNumber = $number;
				inputNumber_reverse($inputNumber);
			}

			function inputNumber_reverse($number) {
				# pasamos el valor numerico a cadena
				$nstring=(string)$number;
				 
				# definimos la variable que contendra el resultado
				$result="";
				 
				# realizamos un bucle recorriendo toda la cadena desde el final hasta el inicio
				for($i=strlen($n);$i>=0;$i--)
				{
				    # añadimos cada uno de los valores a la variable $result
				    $result.=$nstring[$i];
				}
				 
				# Mostramos el numero invertido
				echo "El valor invertido es: ".(int)$result." <br>";
			}
		?>

		<h2>Capicúas</h2>
		<p><span class="error">* campo requerido</span></p>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
			Ingresar un número mayor a 9 y menor a 10000: <input type="number" min="10" max="10000" name="inputNumber" value="<?php echo $inputNumber;?>">
			<span class="error">* <?php echo $inputStringErr;?></span>
			<br><br>
			<input type="submit" name="submit" value="Validar">
		</form>
		<br><br>
		<h3>Resultado:</h3>
		<span class="result"><?php foreach ($result as $key => $val) { echo $val."<br/>"; } ?></span>

	</body>
</html>