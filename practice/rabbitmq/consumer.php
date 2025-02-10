<?php

require __DIR__ . '/../vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;

$connection = new AMQPStreamConnection('pmc_rabbitmq', 5672, 'guest', 'guest');
$channel = $connection->channel();

$channel->queue_declare('hello', false, false, false, false);

echo " [*] Waiting for messages. To exit press CTRL+C\n";

/**
 * @param \PhpAmqpLib\Message\AMQPMessage $msq
 * @return void
 */
$callback = function (\PhpAmqpLib\Message\AMQPMessage $msq): void {
    echo " [x] Received: {$msq->body}\n";
};

$channel->basic_consume('hello', '', false, true, false, false, $callback);

try {
    $channel->consume();
} catch (\Throwable $exception) {
    echo $exception->getMessage();
}

//while(count($channel->callbacks)) {
//    try {
//        $channel->wait();
//    } catch (Throwable $e) {
//        echo $e->getMessage();
//    }
//}
//
//$channel->close();
//$connection->close();
