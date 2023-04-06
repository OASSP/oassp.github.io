<?php

error_reporting (E_ALL ^ E_NOTICE);

$fullname = filter_input(INPUT_POST, 'fullname');
$username = filter_input(INPUT_POST, 'username');
$email = filter_input(INPUT_POST, 'email');
$contactnum = filter_input(INPUT_POST, 'contactnum');
$password = filter_input(INPUT_POST, 'password');
$conpass = filter_input(INPUT_POST, 'conpass');
$expertise = filter_input(INPUT_POST, 'expertise');
$description= filter_input(INPUT_POST, 'description');

if(!empty($fullname)){
    if(!empty($username)){
        if(!empty($email)){
            if(!empty($contactnum)){
                if(!empty($password)){
                    $host = "localhost";
                    $dbusername = "root";
                    $dbpassword = "";
                    $dbname = "searchexperts";

                    $conn= new mysqli ($host,$dbusername,$dbpassword,$dbname);
                    if(mysqli_connect_error()){
                        die('Connection Error ('.mysqli_errno().')'.mysqli_connect_error());
                    } else {
                        $sql = "INSERT INTO newregister
                                    (Fullname,Username,Email,Contactnumber,
                                    Password,Expertise,Description) 
                            VALUE('$fullname','$username','$email',
                                '$contactnum','$password',
                                '$expertise','$description')";
                        if($conn->query($sql)){
                            echo " Successfully Registered!";
                        }else{
                            echo "Error :".$sql."<br>".$conn->error;
                        }
                        $conn->close;
                    }
                }else{
                    echo "Password should not be empty";
                }
            }else{
                echo "Contact number should not be empty";
            }
        }else{
            echo "Email should not be empty";
        }
    }else{
        echo "Username should not be empty";
    }
}else{
    echo "Full name should not be empty";
}
?>