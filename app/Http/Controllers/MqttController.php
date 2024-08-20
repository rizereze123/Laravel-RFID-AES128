<?php

namespace App\Http\Controllers;

use PhpMqtt\Client\Facades\MQTT;

class MqttController extends Controller
{
    public function publishMessage()
    {
        $mqtt = MQTT::connection();
        $mqtt->publish('hanari/feeds/doorlock', 'foo', 1);
        $mqtt->loop(true);
    }
}
