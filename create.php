<?php
    include_once 'connection.php';
    $database = new Connection();
    $db = $database->openConnection();

    $statement = $db->prepare("SELECT * FROM buttons");
    $statement->execute();
    $result = $statement->fetchAll();

    if($statement->rowCount()>0){
       echo 'already have buttons';
    }else{
        for($i=1;$i<11;$i++ ){
            $statement = $db->prepare("
            INSERT INTO buttons (key_name) 
            VALUES (:key_name)");
           $statement->execute(
                array(
                    ':key_name' => $i,
                )
            );
        }

        echo 'created button';

    }


?>