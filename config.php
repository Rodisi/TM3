<?php

    try {
        $dbh = new PDO('mysql:host=localhost;dbname=markitdb;charset=UTF-8', 'root', '');
    }
    catch (PDOException $e) {
        die('unable to connect to database ' . $e->getMessage());
    }    

    // create LM object, pass in PDO connection
    $lm = new lazy_mofo($dbh);

?>