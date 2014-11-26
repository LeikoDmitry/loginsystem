
<?php
require_once '../core/init.php';

if(Input::exists()){
   $validate = new Validate();
   $validation = $validate->check($_POST,array(
       'username' => array(
           'requered' => true,
           'min'=> 2,
           'max'=> 20,
           'unique' =>'users'
       ),
       'password' => array(
           'requered' => true,
           'min' => 4,
           
       ),
       'password2' => array(
           'requered' => true,
           'matches' => 'password'
       ),
       'name' =>array(
          'requered' => true,
          'min' => 2,
          'max' => 50
       )
));
  
   if($validate->passed()){
       $user = new User();
       $salt = Hash::salt(32);
       try {
          
          $user->create(array(
              'username' => Input::getItem('username'),
              'password' => Hash::make(Input::getItem('password')),
              'salt' => $salt,
              'name' =>Input::getItem('name'),
              'joined' =>date('Y-m-d H:i:s'),
              'group' => 1,
          ));
          
          Session::flash('home','Вы зарегестрированы!');
          Redirect::to('index.php');
           
       } catch (Exception $e) {
           die($e->getMessage());
       }
    }
   else {
         $erArray = $validate->errors();
         foreach ($erArray as $eror => $er){
             echo $er,'<br />';
         }
         
    } 
   
   
}
?>
<form method="post">
  <div class="form-group">
    <label for="username">Имя пользователя</label>
    <input name="username" type="text" value="<?php echo Input::getItem('username');?>"class="form-control" id="username" placeholder="Введите имя" autocomplete="off"/>
  </div>
  <div class="form-group">
    <label for="password">Выберите пароль</label>
    <input name="password" type="password" class="form-control" id="password" placeholder="Пароль" autocomplete="off"/>
  </div>
  <div class="form-group">
    <label for="password2">Повторите пароль</label>
    <input name="password2" type="password" class="form-control" id="password2" placeholder="Пароль" autocomplete="off"/>
  </div>
  <div class="form-group">
    <label for="name">Введите ваше имя</label>
    <input name="name" type="text" value="<?php echo Input::getItem('name');?>" class="form-control" id="name" placeholder="Имя" autocomplete="off"/>
  </div>    
    <input type="hidden" name="token" value="<?php echo Token::generate()?>"/>
    <input type="submit" class="btn btn-default" value="Отправить"/>
</form>

