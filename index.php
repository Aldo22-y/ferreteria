<?php
require_once __DIR__ . '/includes/functions.php';

if (isset($_GET['accion']) && $_GET['accion'] === 'eliminar' && isset($_GET['id'])) {
    $count = eliminarProcesos($_GET['id']);
    $mensaje = $count > 0 ? "Tarea eliminada con éxito." : "No se pudo eliminar la proceso.";
}

$procesos = obtenerProcesos();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de ferreteria</title>
    <link rel="stylesheet" href="public/css/styles.css">
</head>
<body>
<div class="container">
    <h1>Gestión de ferreteria</h1>

    <?php if (isset($mensaje)): ?>
        <div class="<?php echo $count > 0 ? 'success' : 'error'; ?>">
            <?php echo $mensaje; ?>
        </div>
    <?php endif; ?>

    <a href="agregar_Material.php" class="button">Agregar Nuevo agregar Material</a>

    <h2>Lista de Material</h2>
    <!-- ... -->
</div>

<table>
    <tr>
        <th>Herramienta</th>
        <th>Precio</th>
        <th>Estop</th>
        <th>Descripción</th>
        <th>Fecha de Entrega</th>
        <th>Completada</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($procesos as $proceso): ?>
    <tr>
        <td><?php echo htmlspecialchars($proceso['herramienta']); ?></td>
        <td><?php echo htmlspecialchars($proceso['precio']); ?></td>
        <td><?php echo htmlspecialchars($proceso['estop']); ?></td>
        <td><?php echo htmlspecialchars($proceso['descripcion']); ?></td>
        <td><?php echo formatDate($proceso['fechaEntrega']); ?></td>
        <td><?php echo $proceso['completada'] ? 'Sí' : 'No'; ?></td>
        <td class="actions">
            <a href="editar_proceso.php?id=<?php echo $proceso['_id']; ?>" class="button">Editar</a>
            <a href="index.php?accion=eliminar&id=<?php echo $proceso['_id']; ?>" class="button" onclick="return confirm('¿Estás seguro de que quieres eliminar esta proceso?');">Eliminar</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

</div>
</body>
</html>




