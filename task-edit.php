<?php
require_once 'database.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];

    $query = "UPDATE task SET ";
    $query.= "name = '$name', description = '$description' ";
    $query.= "WHERE id = '$id'";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        die('Query Failed.');
    }

    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Task Updated Successfully</strong>     
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>';
}
?>