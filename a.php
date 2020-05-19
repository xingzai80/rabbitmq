<?php
/**
 * Created by PhpStorm.
 * User: 86155
 * Date: 2020/5/18
 * Time: 22:56
 */
require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use PhpAmqpLib\Wire\AMQPTable;

$connection = new AMQPStreamConnection('47.114.133.238', 5672, 'xingzai', 'cx1995');
$channel    = $connection->channel();
$channel->exchange_declare('delay_non_chat_queue', "x-delayed-message", false, true, false, null, null, array("x-delayed-type" => array("S", "direct")));


$minute = 10;
$delay = $minute*1000*60;
$headers = new AMQPTable(array("x-delay" => $delay));
$msg = date('Y-m-d H:i:s');
$data    = new AMQPMessage($msg, array('delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT));
$data->set('application_headers', $headers);
$channel->basic_publish($data, 'delay_non_chat_queue', 'key_non_chat_delay');

$channel->close();
$connection->close();

