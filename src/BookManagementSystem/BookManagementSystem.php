<?php
  namespace BookManagementSystem;
  use Ratchet\MessageComponentInterface;
  use Ratchet\ConnectionInterface;

  class BookManagementSystem implements MessageComponentInterface {
    private $clients;
    private $link;

    public function __construct() {
      $this->clients = new \SplObjectstorage;
      $this->link = new Database();
    }

    public function onOpen(ConnectionInterface $connect) {
      $this->clients->attach($connect);

      // New connection, send all data
      $connect->send(json_encode(array('type' => 'init', 'data' => $this->link->getAll())));

      echo "Has new connection: " . $connect->resourceId . "\n";
    }

    public function onMessage(ConnectionInterface $from, $message) {
      $message = json_decode($message);

      switch ($message->type) {
        case 'insert':
          if ($this->link->insert($message->data)) {
            $response = $this->link->getById($this->link->getLastId());
          }
          break;

        case 'getAll':
          $response = $this->link->getAll();
          break;
      }

      foreach ($this->clients as $client) {
        $client->send(json_encode(array('type' => $message->type, 'data' => $response)));
      }
    }

    public function onError(ConnectionInterface $connect, \Exception $e) {
      echo "An error has occured: " . $e->getMessage() . ".\n";
      $connect->close();
    }

    public function onClose(ConnectionInterface $connect) {
      $this->clients->detach($connect);
      echo "Connection " . $connect->resourceId . " has disconnected.\n";
    }
  }
