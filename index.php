<?php

require_once('TaskManager.php');

$taskManager = new TaskManager();

if ($argv > 2) {

    // Obtén el comando de la línea de comandos
    $command = $argv[1];

    switch ($command) {
        case 'add':
            $taskManager->addTask($argv[2]);
            break;
        case 'list':
            $status = $argv[2] ?? '';
            $taskManager->listTasks($status);
            break;
        case 'update':
            $id = $argv[2];
            $description = $argv[3];

            $taskManager->updateTask($id, $description);
            break;
        case 'mark-in-progress':
            $id = $argv[2];
            $taskManager->markInProgress($id);
            break;
        case 'mark-done':
            $id = $argv[2];
            $taskManager->markDone($id);
            break;
        case 'delete':
            $id = $argv[2];
            $taskManager->deleteTask($id);
            break;

        default:
            echo "Comando desconocido";
    }
} else {
    echo "No hay argumentos";
}
