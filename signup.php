<?php
include('connection.php');

$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];

$check_username = $mysqli->prepare('SELECT username FROM users WHERE username=?');
$check_username->bind_param('s', $username);
$check_username->execute();
$check_username->store_result();
$username_exists = $check_username->num_rows();

if ($username_exists == 0) {
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    $query = $mysqli->prepare('INSERT INTO users (username, password, email) VALUES (?, ?, ?)');
    $query->bind_param('sss', $username, $hashed_password, $email);
    $query->execute();

    $response['status'] = "success";
    $response['message'] = "User registered successfully!";
} else {
    $response['status'] = "failed";
    $response['message'] = "Username already exists. Please choose a different username.";
}

// Types of HTTP request: POST, GET, PUT, DELETE
echo json_encode($response);
