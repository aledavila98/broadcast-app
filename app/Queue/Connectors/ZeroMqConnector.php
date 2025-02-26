<?php

namespace App\Queue\Connectors;

use Illuminate\Queue\Connectors\ConnectorInterface;
use App\Queue\ZeroMqQueue;
use ZMQContext;

class ZeroMqConnector implements ConnectorInterface
{
    public function connect(array $config)
    {
        $context = new ZMQContext();
        $socket = $context->getSocket(\ZMQ::SOCKET_PUSH, 'queue');
        $socket->connect($config['host']);

        return new ZeroMqQueue($socket, $config['queue'], $config['retry_after']);
    }
}
