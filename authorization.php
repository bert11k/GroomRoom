<?php require_once('header.php');



if(isset($_POST['auth'])){

  $_SESSION['email']= $_POST['email'];

  $_SESSION['login'] =  $_POST['login'];

  $_SESSION['password'] = md5($_POST['password']);

};



$email = $_SESSION['email'];

$login = $_SESSION['login'];

$password = $_SESSION['password'];



if(isset($_POST['auth'])){

  $emailTrue = mysqli_fetch_assoc($link->query("SELECT`email`,`password`FROM`users`WHERE`email` = '$email'"))['email'];

  $passwordTrue = mysqli_fetch_assoc($link->query("SELECT`email`,`password`FROM`users`WHERE`email` = '$email'"))['password'];

  if($email == $emailTrue && $password == $passwordTrue){ 

      $_SESSION['auth'] = true; 

      $_SESSION["id"] = mysqli_fetch_assoc($link->query("SELECT`id`,`login`,`password`FROM`users`WHERE`email` = '$email'"))['id'];

      $_SESSION['login']= mysqli_fetch_assoc($link->query("SELECT`email`,`login`,`password`FROM`users`WHERE`email` = '$email'"))['login'];

      echo "<script type='text/javascript'>

          location.replace('/');

      </script>";

  }  elseif($email == '' || $password == '' || $login == ' ' || $password == ' '){

      $error = 'Вы ввели пустую строку';

  }elseif($email != $emailTrue || $password != $passwordTrue ){

      $error = 'Неверный логин или пароль!';

  }

}



    if($_SESSION['auth'] == true){

        echo "<script type='text/javascript'>

          location.replace('/');

      </script>";

    }

    



if(isset($_POST['reg'])){

  $login = $_POST['login'];

  $password = md5($_POST['password']);

  $email = $_POST['email'];

  $ismail = filter_var($email, FILTER_VALIDATE_EMAIL);

  $emailHere = mysqli_fetch_assoc($link->query("SELECT `email` FROM `users` WHERE `email` = '$email'"))['email'];

  if(!ctype_alnum($login)){

      $error = 'Только буквы или цифры!';

  } elseif($email != $emailHere && $login != '' && $email != '' && $password != '' && $ismail){

      $link->query("INSERT INTO `users`(`login`, `password`, `email`) VALUES ('$login', '$password' ,'$email')");

      $_SESSION["id"] = mysqli_fetch_assoc($link->query("SELECT`id`,`login`,`password`FROM`users`WHERE`email` = '$email'"))['id'];

      $_SESSION['auth'] = true;

      $_SESSION['login'] = $login;

      echo "<script type='text/javascript'>

          location.replace('/');

      </script>";

  } elseif($emailHere == $email){

      $error = 'Такая почта уже зарегестрирована';

  } elseif ($login == '' || $email == '' || $password == ''){

      $error = 'Вы ввели пустую строку';

  } elseif (!$ismail){

      $error = 'Некоректный email';

  }

}
?>



    <link rel="stylesheet" type="text/css" href="css/styleauth.css" />

<div class="form">

      <ul class="tab-group">
        <li class="tab active"><a href="#signup">Зарегестрироваться</a></li>
        <li class="tab"><a href="#login">Войти</a></li>
      </ul>



<div class="tab-content">

                
                <div id="signup">   
             <h1>Регистрация</h1>
                <div class="reg_popup">

                    <form method="post" action="<?=$url?>" name="reg">
                    <div class="top-row">
                    <div class="field-wrap">
                    <label for="login1">
                     Логин<span class="req">*</span>
                    </label>
                    <input id="login1" type="text"  name="login" required autocomplete="off">
                     </div>
                   <br>
                   </div>


                   <div class="field-wrap">
            <label for="email">
              Почта<span class="req">*</span>
            </label>
            <input id="email" type="email"name="email" required autocomplete="off">
          </div>
          
          <div class="field-wrap">
            <label for="pass1" >
              Пароль<span class="req">*</span>
            </label>
            <input id="pass1" type="password" name="password" required>
          </div>
                        <button class="button button-block" type='submit' name='reg'>Зарегистрироваться</button><br>
                        <?php if(!empty($error)){ ?>
                            <p id="errorPHP" style='color:brown; font-size: 16pt;'><?= $error?></p>
                        <?php } ?>
                    </form>
                    </div>
                    </div>







                <div id="login">   
                <h1>Добро пожаловать</h1>
                    <form method='post' action="<?=$url?>" name='auth'>



                    <div class="field-wrap">
                    <label for="email">
                    Почта <span class="req">*</span>
                    </label>
                    <input type="email" id="login" name="email" required autocomplete="off"><br>
                    </div>



                    <div class="field-wrap">
                    <label for="pass">
                    Пароль <span class="req">*</span>
                    </label>
                        <input id="pass" type="password" name="password" required><br>
            </div>
                        <button class="button button-block" type="submit" name='auth'>Войти</button><br>
                        <?php if(!empty($error)){ ?>
                            <p style='color:brown; font-size: 16pt;'><?= $error?></p>
                        <?php } ?>
                    </form>
                </div>
            </div>
                        </div>
        






      <?php require_once('footer.php') ?>