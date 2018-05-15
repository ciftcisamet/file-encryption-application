<?php

session_start();

if(!isset($_SESSION['username'])){
  header('Location: login.php');
}

?>

<html>

	<head>
		<meta charset="utf-8"/>
		<title>JavaScript Dosya Sifreleme</title>

		<meta name="viewport" content="width=device-width, initial-scale=1" />

		<link href="http://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet" />
		<link href="assets/css/style.css" rel="stylesheet" />
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

	</head>

	<body>

<table class="table">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">kullanıcı adı</th>
      <th scope="col">dosya</th>
      <th scope="col">isim</th>
      <th scope="col">tarih</th>
    </tr>
  </thead>
  <tbody>

    <?php

    include "connect.php";

    $session_username = $_SESSION['username'];

    if($session_username!='admin'){

    $query = mysqli_query($conn,"SELECT * FROM files where username = '$session_username'");

    while($row = mysqli_fetch_array($query)){

    $id = $row['id'];
    $username = $row['username'];
    $url = $row['url'];
    $dosyaismi = $row['isim'];
    $time = $row['time'];
    $name = $row['name'];

    ?>

    <tr>
      <th scope="row"><?php echo $id; ?></th>
      <td><?php echo $username; ?></td>
      <td><a download="<?php echo $name;?>" class="download2" href="<?php echo $url;?>">indir</td>
      <td><?php echo $dosyaismi; ?></td>
      <td><?php echo $time; ?></td>
    </tr><?php }}

else{

  $query = mysqli_query($conn,"SELECT * FROM files");

  while($row = mysqli_fetch_array($query)){

  $id = $row['id'];
  $username = $row['username'];
  $url = $row['url'];
  $dosyaismi = $row['isim'];
  $time = $row['time'];
  $name = $row['name'];

  ?>

  <tr>
    <th scope="row"><?php echo $id; ?></th>
    <td><?php echo $username; ?></td>
    <td><a download="<?php echo $name;?>" class="download2" href="<?php echo $url;?>">İndir</td>
    <td><?php echo $dosyaismi; ?></td>
    <td><?php echo $time; ?></td>
  </tr><?php }}?>

  </tbody>
</table>

<script src="assets/js/aes.js"></script>
<script src="assets/js/UploaderForGoogleDrive.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="assets/js/script2.js"></script>

</body>

</html>
