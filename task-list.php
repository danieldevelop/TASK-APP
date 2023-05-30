<?php
require_once 'database.php';

$query = "SELECT t.id, t.name, t.description ";
$query.=" FROM task t ";
$query.= "ORDER BY t.id DESC";
$result = mysqli_query($connection, $query);

if (!$result) {
    die('Query Failed.');
}

$json = array();
while($row = mysqli_fetch_array($result)) {
    $json[] = array(
        'name' => $row['name'],
        'description' => $row['description'],
        'id' => $row['id']
    );
}

$jsonstring = json_encode($json);
echo $jsonstring;

?>