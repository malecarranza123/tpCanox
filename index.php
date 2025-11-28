<?php
/* 
Nombre: Malena Carranza
Tema: Encuesta de comida favorita
Descripción: sitio web en PHP que permite votar comida favorita.
*/

require 'includes/header.php';
require 'clases/Encuesta.php';

// cargar JSON
$dataFile = 'data/data.json';
$comidas = ['Pizza', 'Pasta', 'Milanesa', 'Lomito', 'Empanadas', 'Arroz integral', 'Ensalada', 'Sanguchito de miga']; // array indexado

$errores = [];

// leer JSON
if (file_exists($dataFile)) {
    $json = file_get_contents($dataFile);
    $resultados = json_decode($json, true);
} else {
    $resultados = [];
}

// inicializar array multidimensional de votos
if (!isset($resultados['votos'])) {
    $resultados['votos'] = [];
    foreach ($comidas as $c) {
        $resultados['votos'][$c] = 0;
    }
}

// manejo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nombre = trim($_POST['nombre'] ?? '');
    $eleccion = $_POST['comida'] ?? '';

    if ($nombre === '') { $errores[] = "El nombre no puede estar vacío."; }
    if ($eleccion === '') { $errores[] = "Debe elegir una comida."; }

    if (empty($errores)) {
        // Usar clase
        $encuesta = new Encuesta($nombre, $eleccion);

        // Usar método
        $resultado = $encuesta->registrarVoto($resultados['votos']);

        // Guardar JSON
        $resultados['votos'] = $resultado;
        file_put_contents($dataFile, json_encode($resultados, JSON_PRETTY_PRINT));

        echo "<div class='alert alert-success'>¡Gracias por votar, {$encuesta->getNombre()}!</div>";
    }
}

// muestra el formulario y la tabla de resultados
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EncuestaPHP</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body class="bg-dark text-white">
<div class="container mt-4">

<h2>Encuesta: ¿Cuál es tu comida favorita?</h2>

<?php if(!empty($errores)): ?>
<div class="alert alert-danger">
    <?php foreach($errores as $e){ echo "<p>$e</p>"; } ?>
</div>
<?php endif; ?>

<form method="POST" class="mt-3">
    <div class="mb-3">
        <label class="form-label">Ingresá tu nombre</label>
        <input type="text" name="nombre" class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label">Elegí tu comida fav</label>
        <select name="comida" class="form-select">
            <option value="">Seleccionar...</option>
            <?php foreach($comidas as $c): ?>
                <option value="<?= $c ?>"><?= $c ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <button class="btn btn-primary">Votar</button>
</form>

<h3 class="mt-4">Resultados</h3>
<table class="table table-bordered">
<tr><th>Comida</th><th>Votos</th></tr>
<?php foreach($resultados['votos'] as $c => $v): ?>
<tr>
    <td><?= $c ?></td>
    <td><?= $v ?></td>
</tr>
<?php endforeach; ?>
</table>

</div>

<?php require 'includes/footer.php'; ?>
</body>
</html>

