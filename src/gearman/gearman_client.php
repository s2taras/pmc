<?php

# создание клиента gearman
$client = new GearmanClient();

# указание сервера по умолчанию (localhost)
$client->addServer('pmc_gearman', 4730);

# регистрация функций обратного вызова
$client->setCreatedCallback('reverse_created');
$client->setDataCallback('reverse_data');
$client->setStatusCallback('reverse_status');
$client->setCompleteCallback('reverse_complete');
$client->setFailCallback('reverse_fail');

# указание неких произвольных данных
$data['foo'] = 'bar';

# добавление двух заданий
$task1 = $client->addTask('reverse', 'foo', $data);
$task2 = $client->addTask('reverse', 'bar', null);

# выполнение заданий параллельно (использование двух обработчиков)
if (!$client->runTasks()) {
    echo 'Error: ' . $client->error() . PHP_EOL;
    exit;
}

echo "DONE\n";

function reverse_created(GearmanTask $task) {
    echo "CREATED: " . $task->jobHandle() . PHP_EOL;
}

function reverse_data(GearmanTask $task) {
    echo "DATA: " . $task->data() . PHP_EOL;
}

function reverse_status(GearmanTask $task) {
    echo "STATUS: " . $task->jobHandle() . ' - ' . $task->taskNumerator() . ' / ' . $task->taskDenominator() . PHP_EOL;
}

function reverse_complete(GearmanTask $task) {
    echo "COMPLETE: " . $task->jobHandle() . ', ' . $task->data() . PHP_EOL;
}

function reverse_fail(GearmanTask $task) {
    echo "FAILED: " . $task->jobHandle() . PHP_EOL;
}
