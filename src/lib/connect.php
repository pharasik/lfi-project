<?php
  # Hardcodowane dane dostępowe do bazy danych
  define("USERNAME", "root");
  define("PASSWORD", "root");
  define("DATABASE", "baim_db");
  define("SERVERNAME", "mysql");
  define("PORT", "3306");

  function connectDb() {
    $connection = new mysqli(SERVERNAME, USERNAME, PASSWORD, DATABASE, PORT);
    if ($connection->connect_error) {
      die("Connection failed: " . $connection->connect_error);
    }
    return $connection;
  }
?>