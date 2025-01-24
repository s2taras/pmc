<?php

require_once __DIR__ . '/../vendor/autoload.php';

$redis = new \Redis();
$redis->connect('pmc_redis', 6379);
echo $redis->ping();