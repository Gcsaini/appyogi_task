<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <title>Task</title>
    <style>
       
        .grid-container {
        display: grid;
        grid-template-columns: auto auto auto auto auto;
        background-color: #000000;
        padding: 5px;
        }
        .grid-item {
        background-color: rgba(255, 255, 255, 0.8);
        border: 1px solid rgba(0, 0, 0, 0.8);
        padding: 20px;
        font-size: 30px;
        text-align: center;
        }
</style>
</head>
<body>
    <h1>Task</h1>
    <div id="result">
            <!-- <div class="grid-item" onClick="btnPressed(1)">1</div>
            <div class="grid-item" onClick="btnPressed(2)">2</div>
            <div class="grid-item" onClick="btnPressed(3)">3</div>  
            <div class="grid-item" onClick="btnPressed(4)">4</div>
            <div class="grid-item" onClick="btnPressed(5)">5</div>
            <div class="grid-item" onClick="btnPressed(6)">6</div>  
            <div class="grid-item" onClick="btnPressed(7)">7</div>
            <div class="grid-item" onClick="btnPressed(8)">8</div>
            <div class="grid-item" onClick="btnPressed(9)">9</div>   -->
        </div>
        <div style="display:flex;justify-content:center;margin-top:10px;color:black" id="status"></div>
    </div>
</body>
<script>

var timeout ;

$(document).ready(function(){
    insertData();
    streamData();
    getStatus();
});


function btnPressed(key){
    var user_id = window.location.href.split('?user=')[1];
    $.ajax({
    url : "insert.php", 
    method:"post",
    data:{action:'post',key:key,user_id:user_id},
    success:function(data){
        if(data==''){
            getData();
            revokeControl(user_id);
            getStatus();
        }else{
            alert(data);
        }
      
    }
    });
}

function streamData(){
    getData();
    setInterval(()=>{
        getData();
        
    },1000);
}

function getStatus(){
    var user_id = window.location.href.split('?user=')[1];
    setInterval(()=>{
        $.ajax({
        url : "control.php", 
        method:"post",
        data:{status:'status',user_id:user_id},
        success:function(data){
            $("#status").html(data);
        }
    });
    },1000);
}

function getData(){
    $.ajax({
        url : "fetch.php", 
        method:"get",
        success:function(data){
            $("#result").html(data);
        }
    });
}


function takeControl(){
    var user_id = window.location.href.split('?user=')[1];
    $.ajax({
        url : "control.php", 
        method:"post",
        data:{action:'takeControl',user_id:user_id},
        success:function(data){
            alert(data);
            getStatus();
            timeout = setTimeout(() => {
                releaseControl(user_id);
                getStatus();
            }, 10000);
        }
    });
}

function revokeControl(user_id){
    releaseControl(user_id);
    getStatus();
    clearTimeout(timeout);
}


function releaseControl(user_id){
    $.ajax({
        url : "control.php", 
        method:"post",
        data:{type:'revoke',user_id:user_id},
        success:function(data){
            console.log('permission revoked');
        
        }
    });
}

function insertData(){
    $.ajax({
        url : "create.php", 
        method:"get",
        success:function(data){
            console.log(data);
        }
    });
}

</script>
</html>