<?php

require_once __DIR__ . '/../vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection('pmc_rabbitmq', 5672, 'guest', 'guest');
$channel = $connection->channel();

$channel->queue_declare('hello', false, false, false, false);

$msq = new AMQPMessage('Hello World!');
$channel->basic_publish($msq, '', 'hello');

echo " [x] Sent 'Hello World!'\n";

$channel->close();
$connection->close();
