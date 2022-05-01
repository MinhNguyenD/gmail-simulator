<?php
    $db = new mysqli("localhost", "root", "root", "jedi_encrypted_email"); 
    if($db->connect_error){
        die("Not connected ". $db->connect_error); 
    }
?>