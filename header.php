<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <script src="js/jquery-3.5.0.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GroomRoom</title>
</head>
<body>
<header>
<div><img src="img/logo.png" alt="logo"></div>
<div><h1>GroomRoom</h1>
    <nav>
    <div><a href="index.php">Главная</a></div>
    <div><a href="add.php">Добавить заявку</a></div>
    <div><a href="/galery.php">Просмотр заявок</a></div>
    <div class="searcha"> <a href="#">Поиск фотографий</a></div>
</nav>
</div>
<div class="auth"><?php if (!$_SESSION['login']){ ?> <a href="authorization.php">Вход | Регистрация</a><?php } else { ?>Вы вошли как: <a href="user.php"><?php echo $_SESSION["login"]; ?></a> <a href="<?=$url ?>">Выйти</a> <?php } ?></div>
    </header>