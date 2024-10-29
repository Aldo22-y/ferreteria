<?php
require_once __DIR__ . '/includes/functions.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$proceso = obtenerProcesosPorId($_GET['id']);

if (!$proceso) {
    header("Location: index.php?mensaje=Tarea no encontrada");
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar que todas las variables estén definidas
    if (isset($_POST['herramienta'], $_POST['precio'], $_POST['estop'])) {
        $count = actualizarProcesos($_GET['id'], $_POST['herramienta'], $_POST['precio'], $_POST['estop'], $_POST['descripcion'], $_POST['fechaEntrega'], isset($_POST['completada']));
        if ($count > 0) {
            header("Location: index.php?mensaje=Proceso actualizada con éxito");
            exit;
        } else {
            $error = "No se pudo actualizar el proceso.";
        }
    } else {
        $error = "Faltan datos requeridos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Proceso</title>
    <link rel="stylesheet" href="public/css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Editar Proceso</h1>

        <?php if (!empty($error)): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form method="POST">
            <label>Material: <input type="text" name="herramienta" value="<?php echo htmlspecialchars($proceso['herramienta']); ?>" required></label>
            <label>Precio: <input type="text" name="precio" value="<?php echo htmlspecialchars($proceso['precio']); ?>" required></label>
            <label>Estop: <input type="text" name="estop" value="<?php echo htmlspecialchars($proceso['estop']); ?>" required></label>
            <label>Descripción: <textarea name="descripcion" required><?php echo htmlspecialchars($proceso['descripcion']); ?></textarea></label>
            <label>Fecha de Entrega: <input type="date" name="fechaEntrega" value="<?php echo formatDate($proceso['fechaEntrega']); ?>" required></label>
            <label>Completada: <input type="checkbox" name="completada" <?php echo $proceso['completada'] ? 'checked' : ''; ?>></label>
            <input type="submit" value="Actualizar Tarea">
        </form>

        <a href="index.php" class="button">Volver a la lista de procesos</a>
    </div>
</body>
</html>
