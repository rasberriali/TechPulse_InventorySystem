<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST ['uname'];
    $password = $_POST ['psw'];
    $confirm_pass = $_POST ['confirm_pass'];
    $email = $_POST ['email_add']; 

    if ($password !== $confirm_pass) {
        header("Location: ../register.html?error=password_mismatch");
        exit();
    }

    $sql_checkusername = "SELECT * FROM logintable WHERE Username = ?";
    $stmt_checkusername = mysqli_prepare($connection, $sql_checkusername);
    mysqli_stmt_bind_param($stmt_checkusername, "s", $username);
    mysqli_stmt_execute($stmt_checkusername);
    $result_checkusername = mysqli_stmt_get_result($stmt_checkusername);

    
    if (mysqli_num_rows($result_checkusername) > 0)  {
        header("Location: ../register.html?error=username_taken");
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO logintable (Username, Password, Email) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $username, $hashed_password, $email);
    $result = mysqli_stmt_execute($stmt);


    if ($result){
        header("Location: ../login.html?registration=success");
        exit();
    } else {
        header("Location: ../register.html?error=registration_failed");
        exit();
    }

} else {
    header("Location: ../registration.html");
    exit();
}
?>
