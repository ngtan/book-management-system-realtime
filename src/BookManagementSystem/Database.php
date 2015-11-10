<?php
  namespace BookManagementSystem;

  class Database {
    private $hostname = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'book-management-system-realtime';
    private $connection = null;

    public function __construct() {
      $this->connection = new \mysqli($this->hostname, $this->username, $this->password, $this->database);

      if ($this->connection->connect_error) {
        trigger_error('Connection failed: ' . $this->connection->connect_error);
        exit();
      }
    }

    public function escape($string) {
      return $this->connection->real_escape_string($string);
    }

    public function insert($data) {
      $sql = "INSERT INTO books(name, author, publisher, final_release_date, pages) ";
      $sql .= "VALUES('" . $this->escape($data->{"book-name"}) . "', '" . $this->escape($data->author) . "', ";
      $sql .= "'" . $this->escape($data->publisher) . "', '" . $this->escape($data->{"final-release-date"}) . "', ";
      $sql .= "'" . $this->escape($data->pages) . "')";

      if (!$this->connection->errno && $this->connection->query($sql) === true) {
        return true;
      }

      return false;
    }

    public function getLastId() {
      return $this->connection->insert_id;
    }

    public function getById($id) {
      $query = $this->connection->query("SELECT * FROM books WHERE id = '{$id}'");

      if (!$this->connection->errno && $query->num_rows > 0) {
        return $query->fetch_assoc();
      }

      return false;
    }

    public function getAll() {
      $query = $this->connection->query("SELECT * FROM books");

      if (!$this->connection->errno) {
        $data = array();

        while ($row = $query->fetch_assoc()) {
          $data[] = $row;
        }

        return $data;
      }

      return false;
    }

    public function __destruct() {
      $this->connection->close();
    }
  }
