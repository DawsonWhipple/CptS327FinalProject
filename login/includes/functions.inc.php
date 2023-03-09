<?php

//signup.inc.php functions
function emptyInputSignup($name, $email, $username, $pwd, $pwdrepeat) {
    $result = false;
    if(empty($name) || empty($email) || empty($username) || empty($pwd) || empty($pwdrepeat)) {
        $result = true;
    }
    return $result;
}

function invalidUid($username) {
    $result = false;
    if(!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        $result = true;
    }
    return $result;
}

function invalidEmail($email) {
    $result = false;
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    }
    return $result;
}

function pwdMatch($pwd, $pwdRepeat) {
    $result = false;
    if($pwd !== $pwdRepeat) {
        $result = true;
    }
    return $result;
}

function uidExists($conn, $username, $email) {
    //prevents SQL injection by using prepared statements
    $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    //assigning data to variable $row allows this function to be used for signup and login
    if($row = mysqli_fetch_assoc($resultData)) {
        mysqli_stmt_close($stmt);
        return $row;
    }
    else {
        mysqli_stmt_close($stmt);
        $result = false;
        return $result;
    }

    //mysqli_stmt_close($stmt);
}

function createUser($conn, $name, $email, $username, $pwd) {
    //prevents SQL injection by using prepared statements
    $sql = "INSERT INTO users (usersName, usersEmail, usersUid, usersPwd) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }
    //dynamically updated hashing algorithm provided by php
    //will ensure that the strongest possible hashing algorithm is used for password storage
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $username, $hashedPwd);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    header("location: ../signup.php?error=none");
    exit();

}

//login.inc.php functions
function emptyInputLogin($username, $pwd) {
    $result = false;
    if(empty($username) || empty($pwd)) {
        $result = true;
    }
    return $result;
}

function loginUser($conn, $username, $pwd) {
    $uidExists = uidExists($conn, $username, $username);

    if($uidExists === false) {
        header("location: ../login.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $uidExists["usersPwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if($checkPwd === false) {
        header("location: ../login.php?error=wronglogin");
        exit();
    }
    else if($checkPwd === true) {
        session_start();
        $_SESSION["userid"] = $uidExists["usersId"];
        $_SESSION["useruid"] = $uidExists["usersUid"];
        $_SESSION["vCode"] = rand(111111, 999999);
        // *** To Email ***
        $to = $username;
        //
        // *** Subject Email ***
        $subject = 'Email Verification';
        //
        // *** Content Email ***
        $content = 'This is your verification code: ' . strval($_SESSION["vCode"]);
        //
        //*** Head Email ***
        $headers = "From: dlwhip01@gmail.com\r\nReply-To: dlwhip01@gmail.com";

        if (mail($to, $subject, $content, $headers))
        {
            echo "Mail Sent";
        } else {
            echo "Mail Failed";
            header("location: ../index.php?");
            exit();
        }
        header("location: ../email.php");
        exit();
    }
}