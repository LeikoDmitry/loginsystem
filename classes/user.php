<?php
class User{
    private $db,
            $data = [],
            $sessionName,
            $isLogin;
    
    public function __construct() {
        $this->db = Db::getInstance();
        $this->sessionName = Config::get('session/session_name');
        $user = null;
        if(!$user){
           if(Session::exists($this->sessionName)){
              $user = Session::get($this->sessionName);
              if($this->find($user)){
                  $this->isLogin = true;
              }
           } 
        }
        else{
            $this->find($user);
        }
    }
    
    public function create($fields){
        if(!$this->db->insert('users',$fields)){
            throw new Exception('Возникли сложности с созданием аккаунта!'); 
        } 
    }
    public function find($user = null){
        if($user){
            $field = (is_numeric($user)) ? 'id' : 'username';
            $data = $this->db->getU('users',[$field,'=',$user]);
            foreach ($data as $item){
                $this->data = $item;
            }
            return true;
         }
        
    }
    

    public function login($username = null,$password = null, $remember){
        
        $user = $this->find($username);
        
        if($user){
            if($this->data->password === Hash::make($password)){
                Session::put($this->sessionName,  $this->data->id);
                
                if($remember){
                    
                }
                
                return true;
            }
        }
        
        return false;
        
        
    }
    
    public function data(){
        return $this->data;
    }
    
    public function isLogin(){
        return $this->isLogin;
    }
    
    public function logout(){
        Session::delete($this->sessionName);
    }
    
}


