<?php

$connection = mysqli_connect('localhost', 'root', '', 'tasks_app');

if ($connection) {
    echo "Database is connected";
}

?>