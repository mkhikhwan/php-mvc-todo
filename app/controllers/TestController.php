<?php

class TestController{
    public function test(){
        echo 'Hello World!';
    }

    public function name(){
        if(!isset($_GET['name'])){
            echo 'Please input a name';
            return;
        }
        
        echo 'Your name is ' . $_GET['name'];
    }

    public function shownum($num){
        if($num == ''){
            echo 'give a number!';
        }

        echo 'The number given is ' . $num . '!';
    }
}

?>