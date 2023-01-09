<?php

// Connect to Cassandra
$cluster   = Cassandra::cluster()
               ->withContactPoints('127.0.0.1')
               ->build();
$keyspace  = 'mykeyspace';
$session   = $cluster->connect($keyspace);

// Insert data
$query = "INSERT INTO users (id, name, email) VALUES (1, 'John', 'john@example.com')";
$session->execute(new Cassandra\SimpleStatement($query));

// Select data
$query = "SELECT * FROM users WHERE id = 1";
$result = $session->execute(new Cassandra\SimpleStatement($query));

foreach ($result as $row) {
    printf("Id: %d, Name: %s, Email: %s\n", $row['id'], $row['name'], $row['email']);
}

// Disconnect from Cassandra
$cluster->close();

?>
