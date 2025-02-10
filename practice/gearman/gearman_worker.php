<?php

echo "Starting\n";

# Создание обработчика.
$worker = new GearmanWorker();

# Указание сервера по умолчанию  (localhost).
$worker->addServer('pmc_gearman', 4730);

# Регистрация функции "reverse" на сервере. Изменение функции обработчика на
# "reverse_fn_fast" для более быстрой обработки без вывода.
$worker->addFunction('reverse', 'reverse_fn');
//$worker->addFunction('reverse', 'reverse_fn_fast');

print "Waiting for job...\n";

while ($worker->work()) {
    if ($worker->returnCode() != GEARMAN_SUCCESS) {
        echo "return_code: " . $worker->returnCode() . PHP_EOL;
        break;
    }
}

function reverse_fn(GearmanJob $job)
{
    echo "Received job: " . $job->handle() . "\n";

    $workload = $job->workload();
    $workload_size = $job->workloadSize();

    echo "Workload: $workload ($workload_size)\n";

    # Этот цикл не является необходимым, но показывает как выполняется работа
    for ($x = 0; $x < $workload_size; $x++) {
        echo "Sending status: " . ($x + 1) . "/$workload_size complete\n";
        $job->sendStatus($x + 1, $workload_size);
        $job->sendData(substr($workload, $x, 1));
        sleep(1);
    }

    $result = strrev($workload);
    echo "Result: $result\n";

    # Возвращаем, когда необходимо отправить результат обратно клиенту.
    return $result;
}

function reverse_fn_fast(GearmanJob $job)
{
    return strrev($job->workload());
}
