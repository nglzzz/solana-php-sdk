<?php

namespace JosephOpanel\SolanaSDK\WebSocket;

use React\Promise\PromiseInterface;

class SlotsUpdatesSubscription extends WebSocketClient
{
    public function subscribe(callable $callback): PromiseInterface
    {
        return $this->connect()->then(function ($conn) use ($callback) {
            $request = [
                'jsonrpc' => '2.0',
                'id' => 1,
                'method' => 'slotsUpdatesSubscribe',
                'params' => []
            ];

            $conn->send(json_encode($request));

            $conn->on('message', function ($message) use ($callback) {
                $callback(json_decode($message, true));
            });

            return $conn;
        });
    }

    public function unsubscribe(int $subscriptionId): PromiseInterface
    {
        return $this->connect()->then(function ($conn) use ($subscriptionId) {
            $request = [
                'jsonrpc' => '2.0',
                'id' => 2,
                'method' => 'slotsUpdatesUnsubscribe',
                'params' => [$subscriptionId]
            ];

            $conn->send(json_encode($request));
        });
    }
}
