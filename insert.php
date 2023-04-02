<?php
include_once 'connection.php';

if(isset($_POST['action'])=='post'){

    try
    {
        $database = new Connection();
        $db = $database->openConnection();
        

        $statement = $db->prepare("SELECT * FROM control LIMIT 1");
        $statement->execute();
        $result = $statement->fetchAll();

        if($statement->rowCount()>0){
            if($result[0]['have_control']==1 && $result[0]['user_id']!=$_POST['user_id']){
                echo 'Other user have control you can not press the key';
            }
            if($result[0]['have_control']==1 && $result[0]['user_id']==$_POST['user_id']){
                $get_statement = $db->prepare(
                    "SELECT * FROM buttons 
                    WHERE key_name = '".$_POST["key"]."' 
                    LIMIT 1"
                   );
                $get_statement->execute();
                $data = $get_statement->fetchAll();
                if(count($data)>0){
                    $update_statement = $db->prepare(
                        "UPDATE buttons
                        SET is_pressed = :is_pressed , user_id = :user_id
                        WHERE key_name = :key_name
                        "
                       );
                       $update = $update_statement->execute(
                        array(
                         ':is_pressed' => !$data[0]['is_pressed'],
                         ':user_id' => $_POST['user_id'],
                         ':key_name'   => $_POST["key"]
                        )
                    );
                  
                    echo '';
                }
            }
            if($result[0]['user_id']==null && $result[0]['have_control']==0){
                echo 'Please take control first';
            }
            if($result[0]['have_control']==0){
                echo 'Please take control first';
            }
        }else{
            echo 'Please take control first';
        }
       
    }
    catch (PDOException $e)
    {
        echo "There is some problem in connection: " . $e->getMessage();
    }
}
?>