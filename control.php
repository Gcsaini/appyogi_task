<?php

include_once 'connection.php';
$database = new Connection();
$db = $database->openConnection();

if(isset($_POST['action'])=='takeControl'){
    $statement = $db->prepare("SELECT * FROM control LIMIT 1");
    $statement->execute();
    $result = $statement->fetchAll();
    if($statement->rowCount()>0){
        if($result[0]['have_control']==0){
            $update_statement = $db->prepare(
                "UPDATE control 
                SET have_control = :have_control , user_id = :user_id
                WHERE is_update = :is_update
                "
               );
               $update = $update_statement->execute(
                array(
                 ':user_id' => $_POST['user_id'],
                 ':have_control'   => 1,
                 'is_update'=>1
                )
            );
            echo 'You have control now';
        }
        if($result[0]['have_control']==1 && $result[0]['user_id']!=$_POST['user_id']){
            echo 'Other user have control';
        }
        if($result[0]['have_control']==1 && $result[0]['user_id']==$_POST['user_id']){
            echo 'You already have control';
        }
    }else{
        $statement = $db->prepare("
        INSERT INTO control (user_id, have_control) 
        VALUES (:user_id, :have_control)
        ");
        $result = $statement->execute(
        array(
            ':user_id' =>$_POST['user_id'],
            ':have_control' => 1
        )
        );
       echo 'You have control now';
    }
}

if(isset($_POST['type'])=='revoke'){
    if(isset($_POST['user_id'])){
        $utatement = $db->prepare(
            "UPDATE control 
            SET have_control = :have_control
            WHERE is_update = :is_update
            "
           );
           $isUpdate = $utatement->execute(
            array(
             ':have_control'   => 0,
             'is_update'=>1
            )
        );
        if(!empty($isUpdate))
        {
            echo 'permission revokedd';
        }
    }
}


if(isset($_POST['status'])=='status'){
    $sstatement = $db->prepare("SELECT * FROM control LIMIT 1");
    $sstatement->execute();
    $status = $sstatement->fetchAll();
    if($sstatement->rowCount()>0){
        if($status[0]['have_control']==0){
            echo 'No user have control';
        }
        if($status[0]['user_id']==$_POST['user_id'] && $status[0]['have_control']==1){
            echo 'You have control now';
        }
        if($status[0]['user_id']!=$_POST['user_id'] && $status[0]['have_control']==1){
            echo 'someone else have control';
        }
    }else{
        echo 'No user has control now';
    }
}




?>