<?php

include_once 'RandomKeyGenerator.php';

class HashCodeGenerator {
    
    private $hashCode;
    
    function __construct() {
        $this->hashCode = "";
    }
    
    function generateNewHash($key){
        $this->hashCode = md5($key);
        return $this->hashCode;
    }

    public function getHash() {
        return $this->hashCode;
    }
    
    public function __destruct() {
        $this->hashCode = NULL;
    }
}

?>
