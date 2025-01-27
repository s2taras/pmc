<?php

require_once __DIR__ . '/../vendor/autoload.php';

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
        echo " [*] TTL: $ttl \n";
        if ($ttl > 0) {
            echo " [*] Exists value: " . $redis->get($key) . "\n";
        } else {
            echo " [*] Delete: $key \n";
            $redis->del($key);
        }
    } else {
        echo " [*] Set: $key \n";
        $redis->set($key, "test value");
        $redis->expire($key, $ttl);
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}