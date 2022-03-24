<?php

    // Tietokanta-asetukset
    $dbServer = "localhost";
    $dbUsername = "trtkm21a_15";
    $dbPassword = "KGmBRPh5";
    $db = "wp_trtkm21a_15";

    try {
        $pdo = new PDO("mysql:host=$dbServer;dbname=$db", $dbUsername, $dbPassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec("SET NAMES 'utf8';");
        }
    catch(PDOException $e)
        {
        echo "<p>Yhteys epäonnistui</p><p>" . $e->getMessage() . "</p>";
        }

    function preparedQuery($sql,$params) {
        for ($i=0; $i<count($params); $i++) {
        $sql = preg_replace('/\?/',$params[$i],$sql,1);
        }
        return $sql;
    }

?>