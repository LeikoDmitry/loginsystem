<?php

/**
 * файл для смены пароля
 */

require_once '../core/init.php';

$user = new User();
if(!$user->isLogin()){
    Redirect::to('index.php');
}
?>

<form method="post">
  <div class="form-group">
    <label for="curentpassword">Текущий пароль</label>
    <input name="curentpassword" type="text"class="form-control" id="curentpassword" autocomplete="off"/>
  </div>
  <div class="form-group">
    <label for="newpassword">Новый пароль</label>
    <input name="newpassword" type="password" class="form-control" id="newpassword"autocomplete="off"/>
  </div>
  <div class="form-group">
    <label for="newpassword2">Повторите  новый пароль</label>
    <input name="newpassword2" type="password" class="form-control" id="newpassword2"autocomplete="off"/>
  </div>
  <input type="hidden" name="token" value="<?php echo Token::generate();?>"/>
    <input type="submit" class="btn btn-default" value="Изменить пароль"/>
</form>

