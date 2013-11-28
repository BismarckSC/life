<?php

class RandomKeyGenerator {

    private $randkey;

    public function __construct() {
        $this->randkey = "";
    }

    public function generateNewKey() {
        $amount = rand(8, 12);

        $keyset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $this->randkey = "";
        for ($i = 0; $i < $amount; $i++) {
            $this->randkey .= substr($keyset, rand(0, strlen($keyset) - 1), 1);
        }
        return $this->randkey;
    }

    public function getKey() {
        return $this->randkey;
    }
    
    public function __destruct() {
        $this->randkey = NULL;
    }

}

?>
