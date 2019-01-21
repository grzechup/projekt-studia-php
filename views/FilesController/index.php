<!DOCTYPE html>
<html>

<?php include(dirname(__DIR__).'/head.html') ?>

<body onload="getFiles()">

<h1>List of your uploaded files.</h1>


<table class=""table table-hover">

    <thead>
        <tr>
            <th>Filename</th>
            <th>Original filename</th>
            <th>Filesize</th>
            <th>Fileformat</th>
        </tr>
    </thead>
    <tbody>
        <tr>
<!--            <td><?/*= $user->getName(); */?></td>
            <td><?/*= $user->getSurname(); */?></td>
            <td><?/*= $user->getEmail(); */?></td>
            <td><?/*= $user->getRole(); */?></td>-->

        </tr>
    </tbody>
    <tbody>
    <tbody class="files-list">

    </tbody>




</table>


<!--

<?php
/*
    $db = new Database();
    $conn = $db->connect();
    $stmt = $conn->prepare("SELECT FROM ");

    mysql
    while($row = mysqli_fetch_array($stmt)){

        echo $row->name;
        echo $row->fileDescription;
        echo $row->fileName;

    }


*/?>

-->
</body>
</html>