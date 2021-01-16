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
<img src="blankface.jpg" width="161" height="350" alt="" style="float:right"/>
<img name="elvislogo" src="elvislogo.gif" width="229" height="32" border="0" alt="Make Me Elvis"/>
<p><strong>Private:</strong> For Elmer's use ONLY<br/>
    Выберете адрес электронной почты которые вы хотите удалить с листа рассылки и нажмите кнопу "Удалить".</p>

<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
    <?php
    $dbc = mysqli_connect('localhost', 'root', 'root', 'elvis_store')
    or die('Ошибка соединения с сервером');

    if (isset($_POST['submit'])) {
        foreach ($_POST['todelete'] as $delete_id) {
            $query = " DELETE FROM email_list WHERE id = $delete_id";
            mysqli_query($dbc, $query)
            or die ('Ошибка запроса к базе данных.');
        }
        echo 'Покупатель удален. <br>';
    }
    $query = " SELECT * FROM email_list";
    $result = mysqli_query($dbc, $query);
    while ($row = mysqli_fetch_array($result)) {
        echo '<input type="checkbox" value="' . $row ['id'] . '" name="todelete[]" />';
        echo $row['first_name'];
        echo ' ' . $row['last_name'];
        echo ' ' . $row['email'];
        echo '<br>';
    }

    mysqli_close($dbc);

    ?>
    <input type="submit" name="submit" value="Удалить" />
</form>
</body>
</html>