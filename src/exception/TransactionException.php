<?php 

require_once("exception/BaseException.php");

class TransactionException extends BaseException {
	
	public function __construct($message, Exception $previous = null) {
    	
        parent::__construct($message, $previous);
    }	
	
}

?>