<?php
ini_set('date.timezone', 'Asia/Shanghai');
require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;

$connection = new AMQPStreamConnection('47.114.133.238', 5672, 'xingzai', 'cx1995');
$channel = $connection->channel();

$channel->queue_declare('task_queue', false, true, false, false);

//echo " [*] Waiting for messages. To exit press CTRL+C\n";

$callback = function ($msg) {
    $messageBody = '执行时间'.date('Y-m-d H:i:s');

    echo $messageBody.' [x] Received ', $msg->body, "\n";
    sleep(substr_count($msg->body, '.'));

//    echo " [x] Done\n";
    $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
};

$channel->basic_qos(null, 1, null);
$channel->basic_consume('task_queue', '', false, false, false, false, $callback);

while (1) {
    $channel->wait();
}

$channel->close();
$connection->close();
?>