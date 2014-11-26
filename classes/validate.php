<?php
/**
 * Класс валидации форм
 */

class Validate{
    private $passed = false,
            $errors = array(),
            $db = null;
    /**
     * При создании объекта создаем подключение к базе
     */
    public function __construct() {
        $this->db = Db::getInstance();
    }
    
    /**
     * 
     * @param type $sours
     * @param type $rules
     */
    public function check($sours,$items = array()){
        foreach ($items as $item => $rules){
            foreach ($rules as $rule => $rulevalue){
               
                $value = $sours[$item];
               
               if($rule === 'requered' && empty($value)){
                   $this->addErors(" Это путое поле - $item");
               }else if(!empty($value)){
                   switch ($rule) {
                       case 'min':
                       if(strlen($value) < $rulevalue){
                         $this->addErors("В {$item} количество символов меньше чем {$rulevalue}");  
                       }
                       break;
                       
                       case 'max':
                       if(strlen($value) > $rulevalue){
                         $this->addErors("В {$item} количество символов больше чем {$rulevalue}");  
                       }
                       break;
                       
                       case 'matches':
                       if($value != $sours[$rulevalue]){
                         $this->addErors("$rulevalue должны совпадать с $item");  
                       }
                       break;
                       
                       case 'unique':
                       $check = $this->db->get($rulevalue,array(
                          $item,'=',$value 
                       ));
                           if($check->count()){
                               $this->addErors("$item такое имя уже есть!");   
                           }
                       break;    
                   
                   }
               }
               
            }
        }
       if(empty($this->errors)){
           $this->passed = true; 
       }
        
       
    }
   
    /**
    * 
    */
    public function passed(){
       return $this->passed;
   }
   
   /**
    * заносит в массив ошибки
    */
   private function addErors($eror){
       $this->errors[] = $eror;  
   }
   /**
    * Возвращает массив ошибок
    */
   public function errors(){
       return $this->errors;
   }
}

