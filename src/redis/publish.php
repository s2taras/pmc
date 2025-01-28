<?php

require_once __DIR__ . '/../vendor/autoload.php';

try {
    $redis = new Predis\Client([
        'scheme' => 'tcp',
        'host'   => 'pmc_redis',
        'port'   => 6379,
    ]);

    $redis->publish(
        'testchannel',
        json_encode([
           'test' => 'success',
        ])
    );
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . PHP_EOL;
}

echo 'Done' . PHP_EOL;
