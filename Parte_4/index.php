<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>PHP Quiz</title>
	<link rel="stylesheet" href="quiz4.css">
</head>
<body>
	<!-- <form method="post" action="procesar_registro.php"> -->
	<form method="post">
		<h2>Registro de Usuario</h2>

		<label>Usuario:</label>
		<input name="user">

		<label>Correo Electrónico:</label>
		<input name="email">

		<label>Contraseña:</label>
		<input name="password">

		<input type="submit" name="registrar" value="Registrar" />
	</form>
	<?php
		if ($_SERVER["REQUEST_METHOD"] === "POST") {
			echo "<h2>Información recibida desde PHP</h2>";
			if (isset($_POST["registrar"])) {
				echo "<h2>Registrar</h2>";
				if (empty($_POST['email']) || empty($_POST['password']) || empty($_POST['user'])) {
					echo "Debes rellenar todos los dos datos.";
				} else {
					// foreach ($_POST as $key => $value) {
					// 	echo "Nombre del campo: " . htmlspecialchars($key) . "<br>";
					// 	echo "Valor del campo: " . htmlspecialchars($value) . "<br>";
					// 	echo "<br>";
					// }
					$servername = "db";
					$usernameDB = "root";
					$passwordDB = "pestillo";
					$database = "Quiz";

					// Crear conexión
					$connRegistrar = new mysqli($servername, $usernameDB, $passwordDB, $database);
					
					// Verificar la conexión
					if ($connRegistrar->connect_error) {
						die("Error de conexión: " . $connRegistrar->connect_error);
					}
					
					$username = $_POST['user'];
					$email = $_POST['email'];
					$password = $_POST['password'];
					$consultaRegistrar = "INSERT INTO User (username, password, email) VALUES ('$username', '$password', '$email')";

					$stmtRegistrar = $connRegistrar->prepare($consultaRegistrar);
					$stmtRegistrar->bind_param("sss", $username, $password, $email);

					if ($stmtRegistrar->execute()) {
						echo "<h2>Usuario registrado correctamente</h2>";
					} else {
						echo "Error al registrar usuario: " . $stmtRegistrar->error;
					}
				}
			}
		}
	?>

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
				
				$div = "<div name='$idQuestion' class='question'>";

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
		if (isset($_POST["resultado"])) {

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
		
	}







		// Cerrar conexión
		$conn->close();
		?>

		<br>
		<br>
		<br>

		<input type="submit" name="resultado" value="Submit">
		
		<a href="?retake=true">Reintentar formulario</a>
		<input type="reset" value="Vaciar formulario">
	</form>


	<form method="post" class="form-borrar" name="borrar">
		<h2>Borrar</h2>
		<select name="selectBorrar" style="width: 80%; background-color: white;">
			<?php
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
				
				$queryQuestions = "SELECT * FROM Questions";
				$resultQuestions = $conn->query($queryQuestions);
				
				if ($resultQuestions-> num_rows>0) {
					while ($row = $resultQuestions->fetch_assoc()) {
						echo "<option value='$row[question_id]'>". $row["question_text"] ."</option>";
					}
				}
			?>
		</select>
		<input type="submit" name="borrar" value="Borrar">
	</form>


	<form method="post" name="editar">
		<h2>Editar</h2>
		<select name="selectEditar" style="width: 80%; background-color: white;">
			<?php
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
				
				$queryQuestions = "SELECT * FROM Questions";
				$resultQuestions = $conn->query($queryQuestions);
				
				if ($resultQuestions-> num_rows>0) {
					while ($row = $resultQuestions->fetch_assoc()) {
						echo "<option value='$row[question_id]'>". $row["question_text"] ."</option>";
					}
				}
			?>
		</select>
		<div>
			<label for="">
				<p>Pregunta:</p>
				<input name="pregunta" type="text">
			</label>
			<label for="">
				<p>Respuesta 1:</p>
				<input name="respuesta1" type="text">
			</label>
			<label for="">
				<p>Respuesta 2:</p>
				<input name="respuesta2" type="text">
			</label>
			<label for="">
				<p>Respuesta 3:</p>
				<input name="respuesta3" type="text">
			</label>
			<label for="">
				<p>Respuesta 4:</p>
				<input name="respuesta4" type="text">
			</label>
			<label for="">
				<p>Respuesta Correcta?(solo se permite a, b, c o d):</p>
				<input name="respuestaCorrecta" type="text">
			</label>
		</div>
		<input type="submit" name="editar" value="Editar">
	</form>
	
	
	<form method="post" name="crear-form">
		<h2>Crear Pregunta</h2>
		<div>
			<label for="">
				<p>Pregunta:</p>
				<input name="pregunta" type="text">
			</label>
			<label for="">
				<p>Respuesta 1:</p>
				<input name="respuesta1" type="text">
			</label>
			<label for="">
				<p>Respuesta 2:</p>
				<input name="respuesta2" type="text">
			</label>
			<label for="">
				<p>Respuesta 3:</p>
				<input name="respuesta3" type="text">
			</label>
			<label for="">
				<p>Respuesta 4:</p>
				<input name="respuesta4" type="text">
			</label>
			<label for="">
				<p>Respuesta Correcta?(solo se permite a, b, c o d):</p>
				<input name="respuestaCorrecta" type="text">
			</label>
		</div>
		<input type="submit" name="crear" value="Crear pregunta">
	</form>


	<?php
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
	$ultimaPregunta = "";

	if ($resultQuestions-> num_rows>0) {
		while ($row = $resultQuestions->fetch_assoc()) {
			// echo "<p>". $row["question_text"] ."</p>";
		}
	}

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (isset($_POST["borrar"])) {
			echo "<h1>Pregunta Borrada</h1>";
			$idValorSeleccionado = $_POST['selectBorrar'];
			// echo "El valor seleccionado es: " . $idValorSeleccionado;

			$consulta1 = "DELETE FROM Options WHERE Questions_question_id = $idValorSeleccionado";
			$consulta2 = "DELETE FROM Questions WHERE question_id = $idValorSeleccionado";
			$stmt1 = $conn->prepare($consulta1);
			$stmt2 = $conn->prepare($consulta2);
			$stmt1->bind_param("s", $idValorSeleccionado);
			$stmt2->bind_param("s", $idValorSeleccionado);

			if ($stmt1->execute()) {
					echo "<h2>Elemento borrado! Refresca la página para ver los cambios</h2>";
			}
			if ($stmt2->execute()) {
				// echo "Elemento con ID " . $idValorSeleccionado . " eliminado correctamente.";
			}
			$stmt->close();
			
		} else if (isset($_POST["editar"])) {
			echo "<h1>Pregunta Actualizada</h1>";
			$idValorSeleccionadoEditar = $_POST['selectEditar'];
			$preguntaEditar = $_POST['pregunta'];
			$respuestaEditar1 = $_POST['respuesta1'];
			$respuestaEditar2 = $_POST['respuesta2'];
			$respuestaEditar3 = $_POST['respuesta3'];
			$respuestaEditar4 = $_POST['respuesta4'];
			$respuestaCorrectaEditar = $_POST['respuestaCorrecta'];
			
			// foreach ($_POST as $key => $value) {
			// 	echo "Nombre del campo: " . htmlspecialchars($key) . "<br>";
			// 	echo "Valor del campo: " . htmlspecialchars($value) . "<br>";
			// 	echo "<br>";
			// }

			$queryOptionsAntiguaRespuesta = "SELECT * FROM Options";
			$resultOptionsAntiguaRespuesta = $conn->query($queryOptionsAntiguaRespuesta);
			$antiguaRespuestaCorrecta = "";
			
			if ($resultOptionsAntiguaRespuesta-> num_rows>0) {
				while ($row = $resultOptionsAntiguaRespuesta->fetch_assoc()) {
					// echo "<p> Questions_question_id". $row["Questions_question_id"] ."</p>";
					// echo "<p>idValorSeleccionadoEditar: ". $idValorSeleccionadoEditar ."</p>";
					if ($row["Questions_question_id"] === $idValorSeleccionadoEditar) {
						// echo "<p>ids iguales</p>";
						// echo "<p> correct_answer". $row["correct_answer"] ."</p>";
						if ($row["correct_answer"] === "1") {
							$antiguaRespuestaCorrecta = $row["answer_choice"];
							// echo "<p>Antigua respuesta correcta: ". $antiguaRespuestaCorrecta ."</p>";
						}
					}
				}
			}

			$consultaPregunta = "UPDATE Questions SET question_text='$preguntaEditar'  WHERE question_id=$idValorSeleccionadoEditar";
			$consultaRespuesta1 = "UPDATE Options SET option_text='$respuestaEditar1'  WHERE Questions_question_id=$idValorSeleccionadoEditar";
			$consultaRespuesta2 = "UPDATE Options SET option_text='$respuestaEditar2'  WHERE Questions_question_id=$idValorSeleccionadoEditar";
			$consultaRespuesta3 = "UPDATE Options SET option_text='$respuestaEditar3'  WHERE Questions_question_id=$idValorSeleccionadoEditar";
			$consultaRespuesta4 = "UPDATE Options SET option_text='$respuestaEditar4'  WHERE Questions_question_id=$idValorSeleccionadoEditar";
			$consultaRespuestaQuitarAntiguaCorrecta = "UPDATE Options SET correct_answer=0  WHERE Questions_question_id=$idValorSeleccionadoEditar AND answer_choice = '$antiguaRespuestaCorrecta'";
			$consultaNuevaRespuestaCorrecta = "UPDATE Options SET correct_answer=1  WHERE Questions_question_id=$idValorSeleccionadoEditar AND answer_choice = '$respuestaCorrectaEditar'";
			
			$stmt1 = $conn->prepare($consultaPregunta);
			$stmt2 = $conn->prepare($consultaRespuesta1);
			$stmt3 = $conn->prepare($consultaRespuesta2);
			$stmt4 = $conn->prepare($consultaRespuesta3);
			$stmt5 = $conn->prepare($consultaRespuesta4);
			$stmt6 = $conn->prepare($consultaRespuestaQuitarAntiguaCorrecta);
			$stmt7 = $conn->prepare($consultaNuevaRespuestaCorrecta);
			$stmt1->bind_param("si", $preguntaEditar, $idValorSeleccionadoEditar);
			$stmt2->bind_param("si", $respuestaEditar1, $idValorSeleccionadoEditar);
			$stmt3->bind_param("si", $respuestaEditar2, $idValorSeleccionadoEditar);
			$stmt4->bind_param("si", $respuestaEditar3, $idValorSeleccionadoEditar);
			$stmt5->bind_param("si", $respuestaEditar4, $idValorSeleccionadoEditar);
			$stmt6->bind_param("is", $idValorSeleccionadoEditar, $antiguaRespuestaCorrecta);
			$stmt7->bind_param("is", $idValorSeleccionadoEditar, $respuestaCorrectaEditar);

			if ($stmt1->execute() && $stmt2->execute() && $stmt3->execute() && $stmt4->execute() && $stmt5->execute() && $stmt6->execute() && $stmt7->execute()){
					echo "<h2>Elemento Actualizado! Refresca la página para ver los cambios</h2>";
			} else {
				echo "Error al actualizar1: " . $stmt1->error;
				echo "Error al actualizar2: " . $stmt2->error;
				echo "Error al actualizar3: " . $stmt3->error;
				echo "Error al actualizar4: " . $stmt4->error;
				echo "Error al actualizar5: " . $stmt5->error;
				echo "Error al actualizar6: " . $stmt6->error;
				echo "Error al actualizar7: " . $stmt7->error;
			}
			$stmt->close();



		} else if (isset($_POST["crear"])) {
			echo "<h1>Pregunta Creada</h1>";
			$pregunta = $_POST['pregunta'];
			$respuesta1 = $_POST['respuesta1'];
			$respuesta2 = $_POST['respuesta2'];
			$respuesta3 = $_POST['respuesta3'];
			$respuesta4 = $_POST['respuesta4'];
			$respuestaCorrecta = $_POST['respuestaCorrecta'];

			if (!in_array($respuestaCorrecta, ["a", "b", "c", "d"])) {
					echo "<h2>Respuesta incorrecta, solo se permite a, b, c o d</h2>";
					return;
			}

			$solucion1 = 0;
			$solucion2 = 0;
			$solucion3 = 0;
			$solucion4 = 0;

			if ($respuestaCorrecta === "a") {
					$solucion1 = 1;
			} else if ($respuestaCorrecta === "b") {
					$solucion2 = 1;
			} else if ($respuestaCorrecta === "c") {
					$solucion3 = 1;
			} else if ($respuestaCorrecta === "d") {
					$solucion4 = 1;
			}

			$consulta1 = "INSERT INTO Questions (question_type, question_text) VALUES ('one_choice', ?)";

			$stmt1 = $conn->prepare($consulta1);
			$stmt1->bind_param("s", $pregunta);

			if ($stmt1->execute()) {
					echo "<h2>Elemento creado! Refresca la página para ver los cambios</h2>";

					$queryQuestionsCrear = "SELECT * FROM Questions";
					$resultQuestionsCrear = $conn->query($queryQuestionsCrear);

					if ($resultQuestionsCrear->num_rows > 0) {
							while ($row = $resultQuestionsCrear->fetch_assoc()) {
									if ($row['question_text'] === $pregunta) {
											// echo "<h2>{$row['question_id']}</h2>";
											$idUltimaPregunta = $row['question_id'];
									}
							}
					}
					// echo "<p>". $idUltimaPregunta ."</p>";
					$consulta2 = "INSERT INTO Options (correct_answer, option_type, answer_choice, Questions_question_id, option_text)
											VALUES ($solucion1, 'one_choice', 'a', $idUltimaPregunta, '$respuesta1'),
														($solucion2, 'one_choice', 'b', $idUltimaPregunta, '$respuesta2'),
														($solucion3, 'one_choice', 'c', $idUltimaPregunta, '$respuesta3'),
														($solucion4, 'one_choice', 'd', $idUltimaPregunta, '$respuesta4')";

					$stmt2 = $conn->prepare($consulta2);
					$stmt2->bind_param("iisiisiisiis", $solucion1, $idUltimaPregunta, $respuesta1, $solucion2, $idUltimaPregunta, $respuesta2, $solucion3, $idUltimaPregunta, $respuesta3, $solucion4, $idUltimaPregunta, $respuesta4);

					if ($stmt2->execute()) {
							// echo "<h2>Elemento creado! Refresca la página para ver los cambios</h2>";
					} else {
							echo "Error al insertar opciones2: " . $stmt2->error;
					}

					$stmt2->close();
			} else {
					echo "Error al insertar pregunta: " . $stmt1->error;
			}

			$stmt1->close();

		}
	}

	// Cerrar conexión
	$conn->close();
	?>

	</body>
</html>
