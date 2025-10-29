<?php
session_start();

class userAuth
{
    private $validUsername = "reformedtech";
    private $validPassword = "rafi123";

    public function signin($username, $password)
    {
        if ($username === $this->validUsername && $password === $this->validPassword) {
            $_SESSION['username'] = $username;
            header('Location: dashboard.php');
            exit();
        } else {
            return "Wrong username/password";
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    $auth = new userAuth();
    $message = $auth->signin($username, $password);
    //var_dump($message);
    if (!empty($message)) {
        echo "<p>$message</p>";
    }
}
