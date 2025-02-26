<?php

namespace App\Http\Controllers;

use \ZMQContext;
use \ZMQ;

class ZmqTestController extends Controller
{
    public function index()
    {
            
        if (class_exists("ZMQ") && defined("ZMQ::LIBZMQ_VER")) {
            echo ZMQ::LIBZMQ_VER, PHP_EOL;
        } else {
            // if (!extension_loaded('zmq')) {
            //     echo "The ZeroMQ extension is not loaded.\n";
            //     return;
            // }

            // $context = new ZMQContext();
            // $socket = $context->getSocket(ZMQ::SOCKET_REQ);
            // $socket->connect("tcp://localhost:5555");
            // $socket->send("Hello World");

            // $reply = $socket->recv();
            // echo "Received reply: [$reply]\n";
        }
    }
}
