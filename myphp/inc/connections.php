<?php

$conn = mysqli_connect('localhost','root','','mylogin');
if(!$conn){
    die('Error '.mysqli_connect_error());

}

