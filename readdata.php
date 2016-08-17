<?php

require_once("connect.php");

$conn = new Connect;
$alldat = $conn->getgame();
$mc = new Memcached();
$mc->addServer("localhost", 11211);
$mc->set("data", json_encode($alldat));