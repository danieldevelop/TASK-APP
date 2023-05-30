<?php
require_once 'database.php';

if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];

    $query = "INSERT INTO task(name, description) ";
    $query.= "VALUES ('$name', '$description')";
    $result = mysqli_query($connection, $query);
    
    if (!$result) {
        die('Query Failed.');
    }

    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Task Added Successfully</strong>     
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>';
}

?>