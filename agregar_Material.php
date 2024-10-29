<?php
require_once __DIR__ . '/includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = crearPocesos($_POST['material'], $_POST['precio'], $_POST['estop'], $_POST['descripcion'], $_POST['fechaEntrega']);
    if ($id) {
        header("Location: index.php?mensaje=proceso creada con éxito");
        exit;
    } else {
        $error = "No se pudo crear la proceso.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Nuevo Proceso</title>
    <link rel="stylesheet" href="public/css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Agregar Nuevo Proceso</h1>

        <?php if (isset($error)): ?>
    <div class="error"><?php echo $error; ?></div>
<?php endif; ?>

<form method="POST">
    <label>Material: <input type="text" name="material" required></label>
    <label>Precio: <input type="text" name="precio" required></label>
    <label>estop: <input type="text" name="estop" required></label>
    <label>Descripción: <textarea name="descripcion" required></textarea></label>
    <label>Fecha de Entrega: <input type="date" name="fechaEntrega" required></label>
    <input type="submit" value="Agregar Producto">
</form>

<a href="index.php" class="button">Volver a la lista de procesos</a>

</div>
</body>
</html>



