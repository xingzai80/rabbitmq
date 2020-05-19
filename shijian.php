<?php
ini_set('date.timezone', 'Asia/Shanghai');
require_once __DIR__ . '/vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Exchange\AMQPExchangeType;
use PhpAmqpLib\Message\AMQPMessage;
use PhpAmqpLib\Wire\AMQPTable;

$exchange = 'delay_non_chat_queue';
$queue = 'task_queue';

$connection = new AMQPStreamConnection('47.114.133.238', 5672, 'xingzai', 'cx1995');
$channel = $connection->channel();
$channel->queue_declare($queue, false, true, false, false);
$channel->exchange_declare($exchange, "x-delayed-message", false, true, false);

$minute = 1;
$delay = $minute*1000*60;
$delay = 60000;
$headers = new AMQPTable(array("x-delay" => $delay));
$channel->queue_bind($queue, $exchange);
$messageBody = '下单时间六十秒后自动执行'.date('Y-m-d H:i:s');
$message = new AMQPMessage($messageBody, array('content_type' => 'text/plain', 'delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT));
$message->set('application_headers', $headers);
$channel->basic_publish($message, $exchange);
$channel->close();
$connection->close();
