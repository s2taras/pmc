<?php

# Создание клиентского объекта
$client = new GearmanClient();

# Указание сервера по умолчанию (localhost).
$client->addServer('pmc_gearman', 4730);

echo "Sending job\n";

//$job_handle = $client->doBackground('reverse', 'this is a test');

# Отправка задания обратно
do {
    $result = $client->doNormal("reverse", "Hello!");

    # Проверка на различные возвращаемые пакеты и ошибки.
    switch ($client->returnCode()) {
        case GEARMAN_WORK_DATA:
            echo "Data: $result\n";
            break;
        case GEARMAN_WORK_STATUS:
            list($numerator, $denominator) = $client->doStatus();
            echo "Status: $numerator/$denominator complete\n";
            break;
        case GEARMAN_WORK_FAIL:
            echo "Failed\n";
            exit;
        case GEARMAN_SUCCESS:
            echo "Success: $result\n";
            break;
        default:
            echo "RET: " . $client->returnCode() . "\n";
            exit;
    }
} while ($client->returnCode() != GEARMAN_SUCCESS);
