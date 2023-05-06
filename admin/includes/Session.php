<?php

class Session
{

    private $signedIn = false;
    public $userID;
    public $message;

    function __construct()
    {
        session_start();
        $this->checkLogin();
        $this->checkMessage();
    }

public function message($msg=""){
    if(!empty($msg)){
        $_SESSION['message'] = $msg;

    }else{
        return $this->message;
    }
}

public function checkMessage () {
    if(isset($_SESSION['message'])){
        $this->message = $_SESSION['message'];
        unset($_SESSION['message']);
    }else{
        $this->message = "";
    }
}

    public function isSignedIn()
    {

        return $this->signedIn;
    }

    public function login($user)
    {
        if ($user) {
            $this->userID = $_SESSION['userID'] = $user->id;
            $this->signedIn = true;
        }
    }

    public function logout()
    {
        unset($_SESSION['userID']);
        unset($this->userID);
        $this->signedIn = false;

    }

    private function checkLogin()
    {
        if (isset($_SESSION['userID'])) {
            $this->userID = $_SESSION['userID'];
            $this->signedIn = true;
        } else {
            unset($this->userID);
            $this->signedIn = false;
        }
    }
}

$session = new Session();


?>