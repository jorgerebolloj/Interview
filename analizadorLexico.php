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
			$output_array = "";
			$coord1 = $coord2 = $coord3 = "";
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				if (empty($_POST["inputString"])) {
					$inputStringErr = "No puede estar vacío el campo de texto";
				} else if (strlen($_POST["inputString"]) > 250) {
					$inputStringErr = "La cadena no puede contener más de 250 caracteres.";
				} else {
					$result = inputString_process($_POST["inputString"]);
				}
			}

			function inputString_process($string) {
				$inputString = $string;

				$output_array = inputString_validation($inputString, "");
				$coord1 = setCoord($output_array[2], $output_array[3], $output_array[4], $output_array[5]);
				$inputString = after($output_array[5], $inputString);

				$output_array = inputString_validation($inputString, "");
				$coord2 = setCoord($output_array[2], $output_array[3], $output_array[4], $output_array[5]);
				$inputString = after($output_array[5], $inputString);

				$output_array = inputString_validation($inputString, "last");
				$coord3 = setCoord($output_array[2], $output_array[3], $output_array[4]);

				$resultArray = array($coord1 ,$coord2, $coord3);
				return $resultArray;
			}

			function inputString_validation($string, $lastElement) {
				if ($lastElement == "") {
					preg_match('/(([(]\d{2,}[,])(\d*[)])([a-zA-Z0-9()]+)([(]\d{2,}[,]))/', $string, $output_array);
				} else {
					preg_match('/(([(]\d{2,}[,])(\d*[)])([a-zA-Z0-9()]+))/', $string, $output_array);
				}
				
				return $output_array;
			}

			function setCoord($coordA, $coordB, $string, $nextCoord) {
				$coordString = $coordA.$coordB." ".$string;
				return $coordString;
			}

			function after($nextCoord, $inputString) {
		        if (!is_bool(strpos($inputString, $nextCoord))) {
		        	 $inputString = $nextCoord.substr($inputString, strpos($inputString, $nextCoord)+strlen($nextCoord));
		        }
		        return $inputString;
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
		<span class="result"><?php foreach ($result as $key => $val) { echo $val."<br/>"; } ?></span>

	</body>
</html>