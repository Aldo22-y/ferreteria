<?php
require_once __DIR__ . '/../config/database.php';
function sanitizeInput($input) {
    return htmlspecialchars(strip_tags(trim($input)));

}

function formatDate($date) {
    return $date->toDateTime()->format('Y-m-d');
}

function crearPocesos($herramienta, $precio, $estop, $descripcion, $fechaEntrega) {
    global $tasksCollection;
    $resultado = $tasksCollection->insertOne([
        'herramienta' => sanitizeInput($herramienta),
        'precio' => sanitizeInput($precio),
        'estop' => sanitizeInput($descripcion),
        'descripcion' => sanitizeInput($estop),
        'fechaEntrega' => new MongoDB\BSON\UTCDateTime(strtotime($fechaEntrega) * 1000),
        'completada' => false
    ]);
    return $resultado->getInsertedId();
}

function obtenerProcesos() {
    global $tasksCollection;
    return $tasksCollection->find();
}

function obtenerProcesosPorId($id) {
    global $tasksCollection;
    return $tasksCollection->findOne(['id' => new MongoDB\BSON\ObjectId($id)]);
}

function actualizarProcesos($herramienta, $precio, $estop, $descripcion, $fechaEntrega, $completada) {
    global $tasksCollection;
    $resultado = $tasksCollection->updateOne(
        ['id' => new MongoDB\BSON\ObjectId($id)],
        ['$set' => [
            'herramienta' => sanitizeInput($herramienta),
            'precio' => sanitizeInput($precio),
            'estop' => sanitizeInput($estop),
            'descripcion' => sanitizeInput($descripcion),
            'fechaEntrega' => new MongoDB\BSON\UTCDateTime(strtotime($fechaEntrega) * 1000),
            'completada' => $completada
        ]]
    );
    return $resultado->getModifiedCount();
}

function eliminarProcesos($id) {
    global $tasksCollection;
    $resultado = $tasksCollection->deleteOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
    return $resultado->getDeletedCount();
}



