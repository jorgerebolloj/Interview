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
			#Definición de variables y seteo a valores vacios
			$inputNumber = "";
			$summation = 0;
			$output_array = "";

			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				if (empty($_POST["inputNumber"])) {
					$inputStringErr = "No puede estar vacío el campo";
				} else if ((int)$_POST["inputNumber"] < 10 || (int)$_POST["inputNumber"] > 10000) {
					$inputStringErr = "El número no puede ser menor a 10 y mayor a 10000";
				} else {
					$result = inputNumber_process($_POST["inputNumber"]);
				}
			}

			#Procesamiento de número
			function inputNumber_process($number) {
				$continue = 1;
				$finalString = "";

				do {
				    $iterations = $iterations + 1;
					$reverseNumber = inputNumber_reverse($number);
					$sum = sumNumbers($number, $reverseNumber);
					$notCapicua = validateNumber($sum);

					$numberIterationsIsCapicua = array($sum, $notCapicua, $iterations); 

					$summation = (int)$numberIterationsIsCapicua[0];
					$continue = (int)$numberIterationsIsCapicua[1];
					$iterations = (int)$numberIterationsIsCapicua[2];

					$finalString = $summation." ".$iterations;

				} while ($continue == 1);

				return $finalString;
			}

			#invertir el número
			function inputNumber_reverse($number) {
			    $num = (string)$number;  
			    $revstr = strrev($num);   
			    $reverse = (int) $revstr;
				return (int)$reverse;
			}

			#Suma de numero dado y número invertido
			function sumNumbers($number, $reverseNumber) {
				$sumNumbers = $number + $reverseNumber;
				return $sumNumbers;
			}

			#validar si el número sumado es capicúa
			function validateNumber($sumNumber) {
		        $notCapicua = 1;
				$numinv = 0;
				$cociente = $sumNumber;
				while ( $cociente != 0)
				{
					$resto = $cociente % 10;
					$numinv = $numinv * 10 + $resto;
					$cociente = (int)($cociente / 10);
				}
				if ($sumNumber == $numinv ) {
					$notCapicua = 0;
				} else {
					$notCapicua = 1;
				}
		        return $notCapicua;
			}
		?>

		<h2>Capicúas</h2>
		<p><span class="error">* campo requerido</span></p>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
			Ingresar un número mayor a 9 y menor a 10000: <input type="number" name="inputNumber" value="<?php echo $inputNumber;?>">
			<span class="error">* <?php echo $inputStringErr;?></span>
			<br><br>
			<input type="submit" name="submit" value="Validar">
		</form>
		<br><br>
		<h3>Resultado:</h3>
		<span class="result"><?php echo $result."<br/>"; ?></span>

	</body>
</html>