<?php
require_once 'database.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $query = "DELETE FROM task WHERE id = $id";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        die('Query Failed.');
    }

    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Task Deleted Successfully</strong>     
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>';
}

?>