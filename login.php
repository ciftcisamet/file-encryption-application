<?php

session_start();

if(isset($_SESSION['username'])){
  header('Location: index.php');
}

include "connect.php";

if(isset($_POST['username']) and isset($_POST['password'])){

$username = $_POST['username'];
$password = $_POST['password'];

$query = "SELECT * FROM users WHERE username = '$username' and password = '$password'";

$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
$count = mysqli_num_rows($result);

if($count==1){
  $_SESSION['username'] = $username;
}

else{
  echo "bilgiler hatalı";
}

if(isset($_SESSION['username'])){
  header('Location: index.php');
}

}

if(isset($_POST['kayit'])){

  $kullaniciadi = $_POST['kullaniciadi'];
  $sifre = $_POST['sifre'];

$query2 = "INSERT INTO users(username,password) VALUES('$kullaniciadi','$sifre')";

if (mysqli_query($conn, $query2))
{
  $_SESSION['kullaniciadi'] = $username;
  }

  else
  {
     echo "Error: ". $query2 . "<br>" . mysqli_error($conn);}mysqli_close($conn);
  }

?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Giris</title>

        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style2.css">



        <link rel="shortcut icon" href="assets/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">

    </head>

    <body>

        <!-- Top content -->
        <div class="top-content">

            <div class="inner-bg">
                <div class="container">

                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1>Giris Yap & Üye Ol</h1>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-5">

                        	<div class="form-box">
	                        	<div class="form-top">
	                        		<div class="form-top-left">
	                        			<h3>Siteye Giris Yap</h3>
	                            		<p>Kullanıcı adı ve sifrenizi girin:</p>
	                        		</div>
	                        		<div class="form-top-right">
	                        			<i class="fa fa-lock"></i>
	                        		</div>
	                            </div>
	                            <div class="form-bottom">
				                    <form role="form" action="" method="post" class="login-form">
				                    	<div class="form-group">
				                    		<label class="sr-only" for="form-username">Kullanıcı Adı</label>
				                        	<input type="text" name="username" placeholder="Kullanıcı Adı..." class="form-username form-control" id="form-username">
				                        </div>
				                        <div class="form-group">
				                        	<label class="sr-only" for="form-password">Şifre</label>
				                        	<input type="password" name="password" placeholder="Şifre..." class="form-password form-control" id="form-password">
				                        </div>
				                        <button type="submit" class="btn">Giriş Yap!</button>
				                    </form>
			                    </div>
		                    </div>

                        </div>

                        <div class="col-sm-1 middle-border"></div>
                        <div class="col-sm-1"></div>

                        <div class="col-sm-5">

                        	<div class="form-box">
                        		<div class="form-top">
	                        		<div class="form-top-left">
	                        			<h3>Üye Ol</h3>
	                            		<p>Formdaki alanları doldurarak üye olabilirsiniz.</p>
	                        		</div>
	                        		<div class="form-top-right">
	                        			<i class="fa fa-pencil"></i>
	                        		</div>
	                            </div>
	                            <div class="form-bottom">
                                <form role="form" action="" method="post" class="login-form">
    				                    	<div class="form-group">
    				                    		<label class="sr-only" for="form-username">Kullanıcı Adı</label>
    				                        	<input type="text" name="kullaniciadi" placeholder="Kullanıcı Adı..." class="form-username form-control" id="form-username">
    				                        </div>
    				                        <div class="form-group">
    				                        	<label class="sr-only" for="form-password">Şifre</label>
    				                        	<input type="password" name="sifre" placeholder="Şifre..." class="form-password form-control" id="form-password">
    				                        </div>
    				                        <button type="submit" name="kayit" class="btn">Üye ol!</button>
    				                    </form>
			                    </div>
                        	</div>

                        </div>
                    </div>

                </div>
            </div>

        </div>

        <!-- Footer -->
        <footer>
        	<div class="container">
        		<div class="row">

        		</div>
        	</div>
        </footer>

        <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/scripts.js"></script>

        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>
