<?php

require '../vendor/autoload.php';
include 'config.php';
session_start();

$client = new Google_Client();
$client->setClientId('848757334118-oc21499v4hivplr0so8v8des9vpudc9k.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('http://localhost/test/google_login.php');
$client->addScope('email');
$client->addScope('profile');

if (!isset($_GET['code'])) {
    $auth_url = $client->createAuthUrl();
    header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
    exit;
} else {

    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token);


    $oauth = new Google_Service_Oauth2($client);
    $userInfo = $oauth->userinfo->get();

    $google_id = $userInfo->id;
    $email = $userInfo->email;
    $name = $userInfo->name;
    $profile_pic = $userInfo->picture;


    $stmt = $pdo->prepare("SELECT * FROM users WHERE google_id = ?");
    $stmt->execute([$google_id]);
    $user = $stmt->fetch();

    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['name'];
        echo "Welcome back, " . $user['name'];
    } else {

        $stmt = $pdo->prepare("INSERT INTO users (google_id, email, name, profile_pic) VALUES (?, ?, ?, ?)");
        $stmt->execute([$google_id, $email, $name, $profile_pic]);
        $_SESSION['user_id'] = $pdo->lastInsertId();
        $_SESSION['username'] = $name;
        $_SESSION['profile_pic'] = $profile_pic;
        echo "Welcome, $name! Your account has been created.";
    }


    header('Location: dashboard.php');
    exit;
}
?>