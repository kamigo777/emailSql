<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="style.css">

    <title>Document</title>
</head>
<body>
<?php
$dbc = mysqli_connect('localhost', 'root', 'root', 'elvis_store' )
    or die('Ошибка соединения с сервером');

$first_name = $_POST['firstname'];
$last_name = $_POST['lastname'];
$email = $_POST['email'];

$query = "INSERT INTO email_list (first_name, last_name, email)" .
    "VALUES ('$first_name', '$last_name', '$email')";
mysqli_query($dbc, $query)
    or die('Ошибка при выполнени запроса к базе данных');

echo'Покупатель добавлен.';
mysqli_close($dbc);
?>

</body>
</html>
