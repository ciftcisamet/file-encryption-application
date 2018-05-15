<?php

include "connect.php";

session_start();

if(!isset($_SESSION['username'])){
  header('Location: login.php');
}

$username = $_SESSION['username'];

if(isset($_POST['gonder'])){

$url = $_POST['url'];
$dosyaismi = $_POST['dosyaismi'];
$name = $_POST['name'];

$query = "INSERT INTO files(username,url,isim,name) VALUES('$username','$url','$dosyaismi','$name')";

if (mysqli_query($conn, $query))
{
     echo "Inserted successfully";
  }

  else
  {
     echo "Error: ". $query . "<br>" . mysqli_error($conn);}mysqli_close($conn);
  }

?>

<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8"/>
		<title>JavaScript Dosya Şifreleme</title>

		<meta name="viewport" content="width=device-width, initial-scale=1" />

		<link href="http://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet" />
		<link href="assets/css/style.css" rel="stylesheet" />

	</head>

	<body>

		<a class="back"></a>

		<form method="post" action="">

		<div id="stage">

			<div id="step1">
				<div class="content">
					<h1>Ne yapmak istiyorsun?</h1>
					<a class="button encrypt green">Dosyayı Şifrele</a>
					<a class="button decrypt magenta">Şifreyi Çöz</a>
					<a class="button encrypt green" href="files.php">Dosyalar</a>

					<?php if(isset($_SESSION['username'])){

					?><a class="button users red" href="logout.php">Çıkış</a> <?php }?>
				</div>
			</div>

			<div id="step2">

				<div class="content if-encrypt">
					<h1>Şifrelenecek dosyayı seçin</h1>
					<h2>Dosyanın şifrelenmiş bir kopyası oluşturulacak.</h2>
					<a class="button browse blue">Gözat</a>

					<input type="file" id="encrypt-input" />
				</div>

				<div class="content if-decrypt">
					<h1>Şifresi çözülecek dosyayı seçin</h1>
					<h2>Sadece şifrelenmiş dosyalar seçilebilir.</h2>
					<a class="button browse blue">Gözat</a>

					<input type="file" id="decrypt-input" />
				</div>

			</div>

			<div id="step3">

				<div class="content if-encrypt">
					<h1>Bir şifre girin</h1>
					<h2>Şifre yükleyeceğiniz dosya üzerine uygulanacak. Şifrenizi unutmayın; şifreyi unutursanız dosyaya erişemezsiniz.</h2>

					<input type="password" placeholder="Şifre: "/>
					<input type="text" name="dosyaismi" placeholder="Dosya Adı: ">
					<a class="button process red">Şifrele!</a>
				</div>

				<div class="content if-decrypt">
					<h1>Şifreyi girin</h1>
					<h2>Dosya üzerine uyguladığınız şifreyi girin. Şifreyi girmeden dosyaya erişemezsiniz.</h2>

					<input type="password" />
					<a class="button process red">Şifreyi çöz!</a>
				</div>

			</div>

			<div id="step4">

				<div class="content">
					<h1>Dosyanız hazır!</h1>
					<a id="download" class="button download green">İndir</a>
					<a id="upload" class="button upload green">Yükle</a>

					<input hidden type="text" name="url" id="buton">
          <input hidden type="text" name="name" id="buton2">
					<input hidden class="gonder" type="submit" name="gonder">
				</div>

			</div>

		</div>

		</form>

	</body>

	<script src="assets/js/aes.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="assets/js/script.js"></script>

</html>
