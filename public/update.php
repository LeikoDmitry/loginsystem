<?php
require_once '../core/init.php';

$user = new User();
if(!$user->isLogin()){
    Redirect::to('index.php');
}

if(Input::exists()){
   if(Token::check(Input::getItem('token'))){
      $validate = new Validate();
      $validation = $validate->check($_POST,[
          'name'=>[
              'requered' => true,
              'min' => 2,
              'max' => 50
              
          ]
      ]);
      
      if($validate->passed()){
          
          try {
              $user->update(array(
                  'name' => Input::getItem('name')
              ));
              Session::flash('home/Ваши данные обновлены');
              Redirect::to('index.php');
          } catch (Exception $e) {
              die($e->getMessage());
          }
          }
      else{
          foreach ($validate->errors() as $errors){
              echo $errors ,'<br />';
          }
      }
              
   } 
}


?>
<form role="form" method="post">
  <div class="form-group">
    <label for="name">Имя</label>
    <input type="text" class="form-control" id="name" value="<?php echo $user->data()->name?>" name="name">
  </div>
  <input type="hidden" name="token" value="<?php echo Token::generate()?>"/>
 <button type="submit" class="btn btn-default">Обновить данные</button>
</form>

