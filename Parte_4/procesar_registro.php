<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  echo "<h2>Información recibida desde PHP</h2>";
  if (isset($_POST["registrar"])) {
    echo "<h2>Información recibida desde PHP</h2>";
    if (empty($_POST['email']) || empty($_POST['password'])) {
      echo "No se recibieron datos del formulario.";
    } else {
      foreach ($_POST as $key => $value) {
        echo "Nombre del campo: " . htmlspecialchars($key) . "<br>";
        echo "Valor del campo: " . htmlspecialchars($value) . "<br>";
        echo "<br>";
      }
    }
  }
}