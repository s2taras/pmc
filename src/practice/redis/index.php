<?php

require_once __DIR__ . '/../vendor/autoload.php';

# redis-cli -a <password>

try {
    $redis = new Predis\Client([
        'scheme' => 'tcp',
        'host'   => 'pmc_redis',
        'port'   => 6379,
    ]);
    $key = 'test_key';
    $ttl = 10;
    $check = $redis->exists($key);

    if ($check) {
        $ttl = $redis->ttl($key);
        echo " [*] TTL: $ttl" . PHP_EOL;
        if ($ttl > 0) {
            echo " [*] Exists value: " . $redis->get($key) . PHP_EOL;
        } else {
            echo " [*] Delete: $key" . PHP_EOL;
            $redis->del($key);
        }
    } else {
        echo " [*] Set: $key" . PHP_EOL;
        $redis->set($key, "test value");
        $redis->expire($key, $ttl);
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . PHP_EOL;
}
