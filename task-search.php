<?php
require_once 'database.php';

$search = $_POST['search'];

if (!empty($search)) {
    $query = "SELECT t.id, t.name, t.description ";
    $query.= "FROM task t ";
    $query.= "WHERE name LIKE '%$search%' "; // buscamos con todos lo elementos que se parescan a la busqueda
    $result = mysqli_query($connection, $query);

    if (!$result) {
        die('Query Error' . mysqli_error($connection));
    }

    $json = array();
    while ($row = mysqli_fetch_array($result)) {
        $json[] = array(
            'name' => $row['name'],
            'description' => $row['description'],
            'id' => $row['id']
        );
    }

    $jsonstring = json_encode($json);
    echo $jsonstring;
}



?>