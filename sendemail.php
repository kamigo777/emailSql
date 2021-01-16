<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Make Me Elvis - Send Email</title>
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
<img src="blankface.jpg" width="161" height="350" alt="" style="float:right"/>
<img name="elvislogo" src="elvislogo.gif" width="229" height="32" border="0" alt="Make Me Elvis"/>
<p><strong>Private:</strong> For Elmer's use ONLY<br/>
    Напишите и отошлите электронное письмо.</p>
<?php
if (isset($_POST['submit'])) {
    $from = 'elmer@gmail.com';
    $subject = $_POST ['subject'];
    $text = $_POST ['elvismail'];
    $output_form = false;

    if (empty($subject) && empty($text)) {
        echo ' Вы забыли указать тему и содержание электронного письма. <br>';
        $output_form = true;
    }
    if (empty($subject) && (!empty($text))) {
        echo 'Вы забыли ввести тему письма. <br>';
        $output_form = true;
    }
    if ((!empty($subject)) && empty($text)) {
        echo 'Вы забыли ввести содержание письма. <br>';
        $output_form = true;

    }

} else {
    $output_form = true;
}

if ((!empty($subject)) && (!empty($text))) {
    $dbc = mysqli_connect('localhost', 'root', 'root', 'elvis_store')
        or die('Ошибка соединения с сервером');

    $query = " SELECT * FROM email_list";
    $result = mysqli_query($dbc, $query)
        or die ('Ошибка при выполнении запроса к базе данных.');

    while ($row = mysqli_fetch_array($result)) {
        $to = $row['email'];
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $msg = "Уважаемый $first_name $last_name, \n  $text ";
        mail($to, $subject, $msg, 'From:' . $from);
        echo 'Электронное письмо отправленно:' . $to . ' <br>';
    }

    mysqli_close($dbc);
}
if ($output_form) {

    ?>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="subject">Тема электронного письма:</label><br/>
        <input id="subject" name="subject" type="text" size="30" value="<?php echo $subject; ?>"/><br/>
        <label for="elvismail">Содержание электронного письма:</label><br/>
        <textarea id="elvismail" name="elvismail" rows="8" cols="40"><?php echo $text; ?></textarea><br/>
        <input type="submit" name="submit" value="Отправить"/>
    </form>
    <?php
}
?>
</body>
</html>