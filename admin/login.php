<?php require_once("includes/header.php") ?>
<?php

if ($session->isSignedIn()) {
    redirect("index.php");
}

if (isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);


$userFound = User::verifyUser($username,$password);


if($userFound){
    $session->login($userFound);
    redirect("index.php");
}else{
    $message = "Your password or username are incorrect";
}
}else{
    $username = "";
    $password = "";
    $message = "";
}
?>


<div class="col-md-5 col-md-offset-3">

<h4 class="bg-danger"><?= $message ?></h4>
	
<form id="login-id" action="" method="post">
	
<div class="form-group">
	<label for="username">Username</label>
	<input type="text" class="form-control" name="username" value="<?php echo htmlentities($username); ?>" >

</div>

<div class="form-group">
	<label for="password">Password</label>
	<input type="password" class="form-control" name="password" value="<?php echo htmlentities($password); ?>">
	
</div>


<div class="form-group">
<input type="submit" name="submit" value="Submit" class="btn btn-primary">

</div>


</form>


</div>