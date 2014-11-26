<?php
require_once '../core/init.php';
if(Input::exists()){
   if(Token::check(Input::getItem('token'))){
      $validate = new Validate();
      $validation = $validate->check($_POST,array(
          'username' => array('requered' => true),
          'password' => array('requered' => true)
      ));
      
      if($validate->passed()){
         $user = new User();
         
         $remember = (Input::getItem('remember')=== 'on') ? true : false;
         $login = $user->login(Input::getItem('username'),Input::getItem('password'),$remember);
         if($login){
             Redirect::to('index.php');
         }
         else {
             echo '<p>Извините, вы не можете войти!</p>';
         } 
      }
      else{
          foreach ($validate->errors()as $error){
              echo $error,'<br />';
          }
      }
   } 
}
?>

<form method="post">
  <div class="form-group">
    <label for="username">Имя</label>
    <input name="username" type="text" class="form-control" id="username" placeholder="Username" autocomplete="off"/>
  </div>
  <div class="form-group">
    <label for="Password">Пароль</label>
    <input name="password" type="password" class="form-control" id="Password" placeholder="Password"/>
  </div>
    <div class="form-group">
        <label for="remember">
            <input type="checkbox" name="remember" id="remember"/> Запомнить меня
        </label>
    </div>  
    <input type="hidden" name="token" value="<?php echo Token::generate();?>"/>
    <input type="submit" class="btn btn-default" value="Войти"/>
</form>

