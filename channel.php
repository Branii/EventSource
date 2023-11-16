<?php
session_start();
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
header('Connection: keep-alive');

// Generate event data in this case we reciece the query string params
$param1 = $_GET['param1'] ?? ''; // Retrieving 'param1' with a default empty string if not present
$param2 = $_GET['param2'] ?? ''; // Retrieving 'param2' with a default empty string if not present

$eventData = [
  'message' => ["param1"=>$param1 , "param2" => $param2]
];

// Format the event data as an SSE message
$sseMessage = "data: " . json_encode($eventData) . "\n\n";

// Send the SSE message to the client
echo $sseMessage;

// Flush the output buffer to ensure immediate sending
ob_flush();
flush();
ob_end_flush();
