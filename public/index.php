<?php 
/**
 * Файл точки входа
 */

/*Подключаем init.php*/

require_once '../core/init.php';


if(Session::exists('home')){
   echo'<p>'.Session::flash('home').'</p>'; 
}

$user = new User();
if($user->isLogin()){
 ?>
<p>Привет <a href="profile.php?user=<?php echo $user->data()->username?>"><?php echo $user->data()->username?>!</a><p>
    
<ul>
    <li><a href="logout.php">Выйти</a></li>
    <li><a href="update.php">Обновить данные</a></li>
    <li><a href="changepassword.php">Сменить пароль</a></li>
</ul>
<?php
if($user->hasPermissions('admin')){
   echo "Вы администратор!"; 
}

}
else{
    echo '<p>Вам нужно пройти <a href="register.php">регистрацию</a> или <a href="login.php">войти</a></p>';
}

