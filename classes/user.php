<?php
class User{
    private $db,
            $data = [],
            $sessionName,
            $cookieName,
            $isLogin;
    
    public function __construct() {
        $this->db = Db::getInstance();
        $this->sessionName = Config::get('session/session_name');
        $this->cookieName = Config::get('remember/cookie_name');
        
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
    
     public function update($field = [],$id = null){
        
         if(!$id && $this->isLogin){
            $id = $this->data()->id; 
         }
         if(!$this->db->update('users',$id,$field)){
            throw new Exception("Возникли сложности!");
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
    

    public function login($username = null,$password = null,$remember = false){
        
       
        
        if(!$username && !$password && $this->exists()){
           Session::put($this->sessionName,$this->data()->id);  
        }else{
          $user = $this->find($username);  
        }
        
        if($user){
            if($this->data->password === Hash::make($password)){
                Session::put($this->sessionName,  $this->data->id);
                
                if($remember){
                    $hash = Hash::unique();
                    
                    $hashcheck = $this->db->get('user',['user_id', '=', $this->data()->id]);
                    
                    if(!$hashcheck->count()){
                        $this->db->insert('user',[
                            'user_id' => $this->data()->id,
                            'hash' => $hash
                        ]);
                    }
                    else{
                        $hash = $hashcheck->first()->hash;
                    }
                    
                    Cookie::put($this->cookieName,$hash, Config::get('remember/cookie_expiry'));
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
        
        $this->db->delete('user',['user_id','=',43]);
        Session::delete($this->sessionName);
        Cookie::delete($this->cookieName);
    }
    
    public function exists(){
        return (!empty($this->data)) ? true : false;
    }
    
   
    
}


