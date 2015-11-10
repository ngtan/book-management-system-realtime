<?php
  use Ratchet\Server\IoServer;
  use Ratchet\Http\HttpServer;
  use Ratchet\WebSocket\WsServer;
  use BookManagementSystem\BookManagementSystem;

  require dirname(__DIR__) . '/vendor/autoload.php';

  $server = IoServer::factory(new HttpServer(new WsServer(new BookManagementSystem())), 8080);
  $server->run();
