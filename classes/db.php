<?php

/**
 * Класс для работы с базой данных
 * Паттерн Singleton(Синглтон)
 */

class Db {

    private static $instance = null;
    private $pdo;
    private $query;
    private $error;
    private $result;
    private $count = 0;

    private function __construct() {
        try {
        $this->pdo = new PDO("mysql:host=". Config::get('mysql/host') . ";dbname=". Config::get('mysql/db') . ";charset=". Config::get('mysql/charset'). "", Config::get('mysql/username'),'');
        } catch (PDOException $e) {
        die($e->getMessage());
        }
    }
        
    public static function getInstance(){
        if (!isset(self::$instance)) {
        self::$instance = new Db();
        }
        return self::$instance;
    }
    
    private function __clone() {
    }
    private function __wakeup() {
    }

   /**
    * метод для запроса к базе данных
    */ 
   public function query($sql,$params = array()){
     
       $this->error = FALSE;
       if($this->query = $this->pdo->prepare($sql)){
       
           if($this->query->execute($params)){
              $this->result = $this->query->fetchAll(PDO::FETCH_OBJ);
              $this->count = $this->query->rowCount();
            }
          else{
              $this->error = true;
          }
       }
       return $this;
   }
   public function queryUser($sql,$params = array()){
      
       $this->error = FALSE;
       if($this->query = $this->pdo->prepare($sql)){
          
           if($this->query->execute($params)){
              $this->result = $this->query->fetchAll(PDO::FETCH_OBJ);
              $this->count = $this->query->rowCount();
            }
          else{
              $this->error = true;
          }
       }
       return $this->result;
   }
   /**
    * Метод  возвращает строку sql-запроса вида SELECT * FROM uuser
    * @param type $actions string
    * @param type $table   string
    * @param type $where   array
    * @return boolean|false
    */
   public function actions($actions,$table,$where = []){
       if(count($where) === 3){
          $operators = ['=','<','>','>=','<='];
          $field = $where[0];
          $operator = $where[1];
          $value[] = $where[2];
          
          if(in_array($operator, $operators)){
              $sql = "{$actions} FROM {$table} WHERE {$field} {$operator} ?";
              if(!$this->query($sql,$value)->error()){
                  return $this;
              }
          }
          
       }
       
      return false; 
   }
   
   public function get($table,$where){
       return $this->actions("SELECT *",$table,$where);
   }
   public function getU($table, $dat=[]){
       if(count($dat) === 3){
          $operators = ['=','<','>','>=','<='];
          $field = $dat[0];
          $operator = $dat[1];
          $value[] = $dat[2];
          
          if(in_array($operator, $operators)){
               $sql = "SELECT * FROM {$table} WHERE $field $operator ?";
               
               return $this->queryUser($sql,$value);  
          
       }
     }
   }
   public function delete($table,$where){
        return print_r($this->actions("DELETE * ",$table,$where));
   }
   
   
   public function insert($table,$fields = array()){
        
       $keys = array_keys($fields);
       
       $values = '';
         $x = 1;
         foreach ($fields as $field[]){
             $values .= "?";
             if($x < count($fields)){
                $values .= ', '; 
             }
             $x++;
             
         }
          
         $sql = "INSERT INTO $table(".'`'.implode('`,`',$keys).'`'.") VALUES({$values})";
          
         if($this->queryUser($sql,$field)){
            return true;  
          }
      
      return false;
   }
   
   public function update($table,$id,$fields = array()){
       $set = '';
       $x = 1;
       foreach ($fields as $name => $value[]){
          $set.= "$name = ?";
          if($x < count($fields)){
             $set .= ', '; 
          }
          $x++;
       }
       $sql = "UPDATE {$table} SET {$set} WHERE id = {$id}";
       if(!$this->query($sql,$value)->error()){
            return true;  
          }
      
      return false;
       
   }
   
   public function result(){
       return $this->result;
   }
   
   public function first(){
       return $this->result()[0];
   }


   public function error(){
       return $this->error;
   }
   
   public function count(){
       return $this->count;
   }
   
   
   
   
}

