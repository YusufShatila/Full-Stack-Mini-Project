<?php

include('connection.php');

$username = 'yusuf';
$password = 'yusuf4';
$query = $mysqli->prepare('select id, username, password, email from users where username = ?');
$query->bind_param('s', $username);
$query->execute();
$query->store_result();
$num_rows = $query->num_rows();
$query->bind_result($id, $username, $hashed_password, $email);
$query->fetch();

if ($num_rows == 0) {
    $response['status'] = "user not found";
} else {
    if (password_verify($password, $hashed_password)) {
        $response['status'] = "logged in";
        $response['user_id'] = $id;
        $response['email'] = $email;
        $response['username'] = $username;
    } else {
        $response['status'] = "wrong password";
    }
}

echo json_encode($response);
