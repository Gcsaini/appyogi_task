<?php
    include_once 'connection.php';
    $database = new Connection();
    $db = $database->openConnection();

    $statement = $db->prepare("SELECT * FROM buttons ORDER BY id ASC");
    $statement->execute();
    $result = $statement->fetchAll();
    $output = '';
    $output .='<div class="grid-container" >'; 
    if($statement->rowCount() > 0){
        foreach($result as $row)
        {
            switch($row['key_name']){
                case 1:
                    $color = $row['is_pressed']==0?'white':($row['user_id']==1?'red':'yellow');
                   
                    $output .= '<div class="grid-item" onClick="btnPressed(1)" style="background:'.$color.'">1</div>';
                    break;
                case 2:
                    $color = $row['is_pressed']==0?'white':($row['user_id']==1?'red':'yellow');
                    $output .= '<div class="grid-item" onClick="btnPressed(2)" style="background:'.$color.'">2</div>';
                    break;
                case 3:
                    $color = $row['is_pressed']==0?'white':($row['user_id']==1?'red':'yellow');
                    $output .= '<div class="grid-item" onClick="btnPressed(3)" style="background:'.$color.'">3</div>';
                    break;
                case 4:
                    $color = $row['is_pressed']==0?'white':($row['user_id']==1?'red':'yellow');
                    $output .= '<div class="grid-item" onClick="btnPressed(4)" style="background:'.$color.'">4</div>';
                    break;  
                case 5:
                    $color = $row['is_pressed']==0?'white':($row['user_id']==1?'red':'yellow');
                    $output .= '<div class="grid-item" onClick="btnPressed(5)" style="background:'.$color.'">5</div>';
                    break;     
                case 6:
                    $color = $row['is_pressed']==0?'white':($row['user_id']==1?'red':'yellow');
                    $output .= '<div class="grid-item" onClick="btnPressed(6)" style="background:'.$color.'">6</div>';
                    break; 
                case 7:
                    $color = $row['is_pressed']==0?'white':($row['user_id']==1?'red':'yellow');
                    $output .= '<div class="grid-item" onClick="btnPressed(7)" style="background:'.$color.'">7</div>';
                    break; 
                case 8:
                    $color = $row['is_pressed']==0?'white':($row['user_id']==1?'red':'yellow');
                    $output .= '<div class="grid-item" onClick="btnPressed(8)" style="background:'.$color.'">8</div>';
                    break; 
                case 9:
                    $color = $row['is_pressed']==0?'white':($row['user_id']==1?'red':'yellow');
                    $output .= '<div class="grid-item" onClick="btnPressed(9)" style="background:'.$color.'">9</div>';
                    break;   
                case 10:
                    $color = $row['is_pressed']==0?'white':($row['user_id']==1?'red':'yellow');
                    $output .= '<div class="grid-item" onClick="btnPressed(9)" style="background:'.$color.'">10</div>';
                    break;                
            }
          
        }
    }
    $output .='</div>';
    $output .='<div style="display:flex;justify-content:center;margin-top:40px" onClick="takeControl()"><button>Take Control</button></div>';
   
    echo $output;

?>