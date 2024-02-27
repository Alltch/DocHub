<?php
if (isset($_POST["submit"])) {
    $Username = $_POST["Username"];
    $email = $_POST["email"];
    $Pass = $_POST["Pass"];
    $confpass = $_POST["confpass"];
    if (!empty($Username) && !empty($email) && !empty($Pass) && !empty($confpass)) {
        $link = mysqli_connect("localhost", "root", "", "dochub");
        if ($link == false){
            die(mysqli_connect_error());
        }
        $sql = "INSERT INTO users (Username, Passwords, Email) VALUES ('$Username', '$Pass', '$email')";
        if (mysqli_query($link, $sql)) {
            echo "Record inserted succesfully";
        } else {
            echo "Something went wrong";
        }

    } else {
        echo ("Please provide all infornation");
    }



}
?>