<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>PHP Quiz</title>
	<link rel="stylesheet" href="quiz2.css">
</head>
<body>
	<!-- <form method="post" action="process.php"> -->
	<form method="post">
		<h1>PHP Quiz PARTE 2</h1>

		<div class='question'>
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
		echo "<p>Conexión exitosa</p>";

		$queryQuestions = "SELECT * FROM Questions";
		$resultQuestions = $conn->query($queryQuestions);
		
		if ($resultQuestions-> num_rows>0) {
			$count = 1;
			while ($row = $result->fetch_assoc()) {
				$idQuestion = $row["question_id"];
				$textQuestion = $row["question_text"];

				$queryOptions = "SELECT * FROM Options WHERE Questions_question_id = $idQuestion";
				$resultOptions = $conn->query($queryOptions);
				while ($row = $resultOptions->fetch_assoc()) {
					if ($count === 1) {
						echo "<p>". $count .". " . $textQuestion . "</p>";
					}
					echo "<label><input type='radio' name='q$count' value='.$row[answer_choice].'> ".$row["answer_choice"].") ". $row["option_text"] ."</label>";
					$count++;
				}
			}
		} else {
			echo "No se encontraron resultados.";
		}
			
			// Cerrar conexión
			$conn->close();
			?>

		</div>

<!-- 
		Question 1
		<div class="question">
			<p>1. ¿Qúe significa PHP?</p>
			Correcta = 
			<label><input type="radio" name="q1" value="a"> a) Página de inicio personal</label>
			<label><input type="radio" name="q1" value="b"> b) PHP: Procesador de hipertexto</label>
			<label><input type="radio" name="q1" value="c"> c) Procesador de hipervínculos privados</label>
			<label><input type="radio" name="q1" value="d"> d) Página de enlace PHP</label>
		</div>

		Question 2
		<div class="question">
			<p>2. ¿Cuál de los siguientes NO es un tipo de dato de PHP?</p>
			Correcta = 
			<label><input type="radio" name="q2" value="a"> a) Entero</label>
			<label><input type="radio" name="q2" value="b"> b) Booleano</label>
			<label><input type="radio" name="q2" value="c"> c) Caracter</label>
			<label><input type="radio" name="q2" value="d"> d) Flotante</label>
		</div>

		Question 3
		<div class="question">
			<p>3. ¿Cuál de los siguientes NO es un tipo de dato de PHP?</p>
			Correcta = 
			<label><input type="radio" name="q3" value="a"> a) HelloWorld</label>
			<label><input type="radio" name="q3" value="b"> b) Hola Mundo</label>
			<label><input type="radio" name="q3" value="c"> c) HelloWorld</label>
			<label><input type="radio" name="q3" value="d"> d) "Hola Mundo"</label>
		</div>

		Question 4
		<div class="question">
			<p>4. En PHP, ¿qué bucle se utiliza para ejecutar un bloque de código un número especificado de veces?</p>
			Correcta = 
			<label><input type="radio" name="q4" value="a"> a) Bucle for</label>
			<label><input type="radio" name="q4" value="b"> b) Bucle while</label>
			<label><input type="radio" name="q4" value="c"> c) Bucle do...while</label>
			<label><input type="radio" name="q4" value="d"> d) Bucle foreach</label>
		</div>

		Question 5
		<div class="question">
			<p>5. ¿Qué función de PHP se utiliza para abrir un archivo para escritura?</p>
			Correcta = 
			<label><input type="radio" name="q5" value="a"> a) fopen</label>
			<label><input type="radio" name="q5" value="b"> b) file_open</label>
			<label><input type="radio" name="q5" value="c"> c) open_file</label>
			<label><input type="radio" name="q5" value="d"> d) Ninguna de las anteriores</label>
		</div>

		Question 6
		<div class="question">
			<p>6. ¿Cuál es el propósito de la superglobal `$_GET` en PHP?</p>
			Correcta = 
			<label><input type="radio" name="q6" value="a"> a) Recuperar datos de un formulario con el método POST</label>
			<label><input type="radio" name="q6" value="b"> b) Almacenar variables de sesión</label>
			<label><input type="radio" name="q6" value="c"> c) Recuperar datos de la cadena de consulta URL</label>
			<label><input type="radio" name="q6" value="d"> d) Definir constantes globales</label>
		</div>

		Question 7
		<div class="question">
			<p>7. ¿Cuál de los siguientes es un ejemplo de constante mágica de PHP?</p>
			Correcta = 
			<label><input type="radio" name="q7" value="a"> a) $this</label>
			<label><input type="radio" name="q7" value="b"> b) __LINE__</label>
			<label><input type="radio" name="q7" value="c"> c) $var</label>
			<label><input type="radio" name="q7" value="d"> d) functionName()</label>
		</div>

		Question 8
		<div class="question">
			<p>8. ¿Qué hace la función `include` en PHP?</p>
			Correcta = 
			<label><input type="radio" name="q8" value="a"> a) Ejecuta un bloque de código solo si una condición es verdadera</label>
			<label><input type="radio" name="q8" value="b"> b) Incluye y evalúa un archivo especificado</label>
			<label><input type="radio" name="q8" value="c"> c) Define una nueva función</label>
			<label><input type="radio" name="q8" value="d"> d) Genera un número aleatorio</label>
		</div>

		Question 9
		<div class="question">
			<p>9. ¿En PHP, qué comprueba el operador `===`?</p>
			Correcta = 
			<label><input type="radio" name="q9" value="a"> a) Igualdad</label>
			<label><input type="radio" name="q9" value="b"> b) Asignación</label>
			<label><input type="radio" name="q9" value="c"> c) Desigualdad</label>
			<label><input type="radio" name="q9" value="d"> d) Comparación</label>
		</div>

		Question 10
		<div class="question">
			<p>10. ¿Cuál de los siguientes se utiliza para crear un objeto en PHP?</p>
			Correcta = 
			<label><input type="radio" name="q10" value="a"> a) new</label>
			<label><input type="radio" name="q10" value="b"> b) objeto</label>
			<label><input type="radio" name="q10" value="c"> c) crear</label>
			<label><input type="radio" name="q10" value="d"> d) instancia</label>
		</div>
 -->

		<input type="submit" value="Submit">

		<a href="?retake=true">Reintentar formulario</a>
		<input type="reset" value="Vaciar formulario">
	</form>
	<?php

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
					if ($respuestasUsuario[$i] === $this->respuestas[$i]) {
						$puntuacion++;
					} else {
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

		$quiz->añadirPregunta("¿Qúe significa PHP?", "b");
		$quiz->añadirPregunta("¿Cuál de los siguientes NO es un tipo de dato de PHP?", "c");
		$quiz->añadirPregunta("¿Cuál es el resultado de `echo Hola . . Mundo;`?", "b");
		$quiz->añadirPregunta("En PHP, ¿qué bucle se utiliza para ejecutar un bloque de código un número especificado de veces?", "a");
		$quiz->añadirPregunta("¿Qué función de PHP se utiliza para abrir un archivo para escritura?", "d");
		$quiz->añadirPregunta("¿Cuál es el propósito de la superglobal `$_GET` en PHP?", "c");
		$quiz->añadirPregunta("¿Cuál de los siguientes es un ejemplo de constante mágica de PHP?", "b");
		$quiz->añadirPregunta("¿Qué hace la función `include` en PHP?", "b");
		$quiz->añadirPregunta("¿En PHP, qué comprueba el operador `===`?", "a");
		$quiz->añadirPregunta("¿Cuál de los siguientes se utiliza para crear un objeto en PHP?", "a");

		
		
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$q1 = strval($_POST["q1"]);
			$q2 = strval($_POST["q2"]);
			$q3 = strval($_POST["q3"]);
			$q4 = strval($_POST["q4"]);
			$q5 = strval($_POST["q5"]);
			$q6 = strval($_POST["q6"]);
			$q7 = strval($_POST["q7"]);
			$q8 = strval($_POST["q8"]);
			$q9 = strval($_POST["q9"]);
			$q10 = strval($_POST["q10"]);

			$qList = [$q1, $q2, $q3, $q4, $q5, $q6, $q7, $q8, $q9, $q10];
			$qNoResponded = [];
			
			
			for ($i=0; $i < 10; $i++) { 
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
				if ($score < 10) {
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

		
	?>
	</body>
</html>
