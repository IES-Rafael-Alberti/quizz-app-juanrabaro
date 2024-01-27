<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>PHP Quiz</title>
	<link rel="stylesheet" href="quiz3.css">
</head>
<body>
	<!-- <form method="post" action="process.php"> -->
	<form method="post">
		<h1>PHP Quiz PARTE 4</h1>

		<?php
		// Datos de conexión a la base de datos
		$servername = "db";
		$username = "root";
		$password = "pestillo";
		$database = "Quiz";

		// Crear conexión
		$conn = new mysqli($servername, $username, $password, $database);
		
		// Verificar la conexión
		if ($conn->connect_error) {
			die("Error de conexión: " . $conn->connect_error);
		}
		
		// Realizar operaciones en la base de datos
		// echo "<p>Conexión exitosa</p>";
		
		$queryQuestions = "SELECT * FROM Questions";
		$resultQuestions = $conn->query($queryQuestions);
		
		if ($resultQuestions-> num_rows>0) {
			$count = 1;
			$titleCount = 0;
			
			while ($row = $resultQuestions->fetch_assoc()) {
				$titleCount++;
				$idQuestion = $row["question_id"];
				$textQuestion = $row["question_text"];	
				
				$queryOptions = "SELECT * FROM Options WHERE Questions_question_id = $idQuestion";
				$resultOptions = $conn->query($queryOptions);
				
				$div = "<div class='question'>";

				while ($row = $resultOptions->fetch_assoc()) {
					if ($count === 1) {
						$div .= "<p>". $titleCount .". " . $textQuestion . "</p>";
					}
					$div .= "<label><input type='radio' name='q$titleCount' value='$row[answer_choice]'> ".$row["answer_choice"].") ". $row["option_text"] ."</label>";
					$count++;
				}
				$div .= "</div>";
				echo $div;
				$count = 1;
			}
		} else {
			echo "No se encontraron resultados.";
		}
			






	class Quiz {
		private $preguntas = [];
		private $respuestas = [];
		private $respuestasIncorrectas = [];

		public function añadirPregunta($pregunta, $respuestaCorrecta) {
			$this->preguntas[] = $pregunta;
			$this->respuestas[] = $respuestaCorrecta;
		}

		public function getPreguntas() {
			return $this->preguntas;
		}

		public function calcularResultado($respuestasUsuario) {
			$puntuacion = 0;

			for ($i = 0; $i < count($this->respuestas); $i++) {
				// echo "<p>".$respuestasUsuario[$i]."</p>";
				// echo "<p>".$this->respuestas[$i]."</p>";
				if ($respuestasUsuario[$i] === $this->respuestas[$i]) {
					$puntuacion++;
				} else {
					// echo "<p>NO ACERTADA</p>";
					$this->respuestasIncorrectas[] = $i + 1;
				}
			}

			return $puntuacion;
		}

		public function sacarIncorrectas() {
			return $this->respuestasIncorrectas;
		}

	}

	$quiz = new Quiz();

	$queryQuestions2 = "SELECT * FROM Questions";
	$resultQuestions2 = $conn->query($queryQuestions2);
	if ($resultQuestions2-> num_rows>0) {
		while ($row = $resultQuestions2->fetch_assoc()) {
			$textQuestion2 = $row["question_text"];
			$letraRespuesta = "";
			
			$respuestasQuery = "SELECT * FROM Options WHERE Questions_question_id = $row[question_id]";
			$resultRespuestasQuery = $conn->query($respuestasQuery);
			$contadorRespuestas = 0;
			if ($resultRespuestasQuery-> num_rows>0) {
				while ($row = $resultRespuestasQuery->fetch_assoc()) {
					// echo "<p>". $row["correct_answer"] ."</p>";
					$contadorRespuestas++;
					if ($row["correct_answer"] === "1") {
						switch ($contadorRespuestas) {
							case "1":
								$letraRespuesta = "a";
								break;
							case "2":
								$letraRespuesta = "b";
								break;
							case "3":
								$letraRespuesta = "c";
								break;
							case "4":
								$letraRespuesta = "d";
								break;
							
							default:
								echo "<p>NINGUNA ES CORRECTA??!!</p>";
								break;
						}

					}

				}
			}
			// echo "<p>".$letraRespuesta."</p>";
			$quiz->añadirPregunta($textQuestion2, $letraRespuesta);

		}
	}

	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		$qNoResponded = [];
		$qList = [];



		$queryQuestions3 = "SELECT * FROM Questions";
		$resultQuestions3 = $conn->query($queryQuestions3);
		if ($resultQuestions3-> num_rows>0) {
			$contadorPreguntas = 0;
			while ($row = $resultQuestions3->fetch_assoc()) {
				$contadorPreguntas++;
				$q = strval($_POST["q". $contadorPreguntas .""]);
				$qList[] = $q;
			}
		}




		
		
		for ($i=0; $i < $contadorPreguntas; $i++) { 
			$actualQ = $qList[$i];
			if ($actualQ == "") {
				$qNoResponded[] = $i;
			}
		}
		
		
		if (count($qNoResponded) == 0) {
			$qNoResponded = [];
			$score = $quiz->calcularResultado($qList);
			$mensaje = "<p>Todo respondido todo correctamente!</p> <p>Tu puntuación es de: $score</p>";
			$incorrectas = $quiz->sacarIncorrectas();
			echo $mensaje;
			if ($score < $contadorPreguntas) {
				echo "<p>Las preguntas que has fallado son la: </p>";
				foreach ($incorrectas as $incorrecta) {
					echo "$incorrecta, ";
				}
			}
		} else {
			$mensaje = "<p>Tienes que responder todas las preguntas!</p> <p>Te faltan las siguientes: </p>";
			echo $mensaje;
			foreach ($qNoResponded as $q) {
				echo $q + 1 . ", ";
			}
		}

		
	}







		// Cerrar conexión
		$conn->close();
		?>

		<br>
		<br>
		<br>

		<input type="submit" value="Submit">

		<a href="?retake=true">Reintentar formulario</a>
		<input type="reset" value="Vaciar formulario">
	</form>
	</body>
</html>
