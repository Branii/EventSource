<?php
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

require __DIR__ . '../vendor/autoload.php';

// Define a WebSocket server
class WebSocketServer implements MessageComponentInterface {
    public function onOpen(ConnectionInterface $conn) {
        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        echo "Message received: {$msg}\n";
        $from->send("Received your message: {$msg}");
    }

    public function onClose(ConnectionInterface $conn) {
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error occurred: {$e->getMessage()}\n";
        $conn->close();
    }
}

// Run the WebSocket server
$server = new Ratchet\App('localhost', 8080);
$server->route('/chat', new WebSocketServer(), ['*']);
$server->run();
