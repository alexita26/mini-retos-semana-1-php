<!DOCTYPE html> 
<html lang="es"> 
<head> 
    <meta charset="UTF-8">
    <title>Calculadora Básica en PHP</title> 
</head> 
<body> 
    <h2>Calculadora Básica</h2> 
 
    <!-- FORMULARIO: captura de datos del usuario --> 
    <!-- action (omitido) => por defecto envía a esta misma URL; method="post" => manda datos en el cuerpo de la petición --> 
    <form method="post"> <!-- Inicia formulario; POST evita mostrar datos en la URL y permite más volumen --> 
 
        <!-- Etiqueta asociada al input con id="a"; al pulsar la etiqueta, enfoca el input --> 
        <label for="a">Número 1:</label> 
        <!-- type="number": pide números; los valores igualmente llegan como cadena a PHP --> 
        <!-- step="any": PERMITE CUALQUIER DECIMAL; sin esto el navegador valida "pasos" de 1 (0,1,2,...) --> 
        <!-- name="a": clave con la que PHP recibirá el valor en $_POST['a'] --> 
        <!-- id="a": necesario para vincular la etiqueta <label for="a"> --> 
        <!-- required: el navegador no permite enviar el formulario si está vacío --> 
        <input type="number" step="any" name="a" id="a" required> 
        <br><br> <!-- Dos saltos de línea para separación visual (presentacional) --> 
 
        <label for="b">Número 2:</label> <!-- Mismo concepto que el anterior pero para "b" --> 
        <!-- step="any" otra vez para admitir decimales libres en el segundo número --> 
        <input type="number" step="any" name="b" id="b" required> 
        <br><br> 
 
        <label for="operacion">Operación:</label> <!-- Texto asociado al <select id="operacion"> --> 
        <!-- <select>: control desplegable; name="operacion" será la clave en $_POST['operacion'] --> 
        <!-- required: obliga a elegir una opción (aunque ya hay una por defecto) --> 
        <select name="operacion" id="operacion" required> 
            <!-- Cada <option> tiene un value (lo que viaja al servidor) y un texto visible (lo que ve el usuario) --> 
            <option value="suma">Suma (+)</option> <!-- value="suma" => string que usará PHP en el switch --> 
            <option value="resta">Resta (-)</option> 
            <option value="multiplicacion">Multiplicación (*)</option> 
            <option value="division">División (÷)</option> 
        </select> 
        <br><br> 
 
        <!-- type="submit": botón que envía el formulario --> 
        <!-- value="Calcular": texto que aparece en el botón --> 
        <input type="submit" value="Calcular"> 
    </form> 
 
    <hr> <!-- Regla horizontal; separación visual entre formulario y resultado --> 
 
<?php  /* A partir de aquí corre PHP: lógica del lado servidor */ ?> 
 
<?php 
/** 
 * calcular(): ejecuta la operación pedida sobre $a y $b. 
 * PHP es de tipado dinámico: aquí trataremos $a y $b como números (float). 
 * 
 * Ejemplo en PHP (tipado dinámico) 
 * $variable = 10;         // Ahora es un entero (int) 
 * $variable = "Hola";     // Ahora es una cadena (string) 
 * $variable = 3.14;       // Ahora es un decimal (float) 
* $variable = true;      
*/ 
function calcular($a, $b, $operacion) { 
switch ($operacion) { 
case "suma": 
return $a + $b;  
case "resta": 
return $a - $b; // Operador - (resta) 
case "multiplicacion": 
return $a * $b; // Operador * (multiplicación) 
case "division": 
// Operador ternario condicional: condición ? valor_si_verdadero : valor_si_falso 
// Validación para evitar división entre 0 (error matemático/Infinity) 
return ($b != 0) ? $a / $b : "Error: división por cero"; 
default: // Si $operacion tiene un valor no previsto 
return "Operación no válida"; // Mensaje de error por buena práctica 
} 
} 

if ($_SERVER["REQUEST_METHOD"] === "POST") { 
$b = isset($_POST["b"]) ? (float) $_POST["b"] : 0.0; 
$operacion = isset($_POST["operacion"]) ? $_POST["operacion"] : ""; 
$resultado = calcular($a, $b, $operacion);
echo "<h3>Resultado: " . htmlspecialchars((string)$resultado, ENT_QUOTES, "UTF-8") . "</h3>"; 
} 
?> 
</body> <!-- Cierra el contenido visible --> 
</html> <!-- Fin del documento HTML --> 