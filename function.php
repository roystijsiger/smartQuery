<?php
class smartQuery{
	private $QueryStr;
	private $Con;
	private $Stmt;
	public $QueryType;
	
	public function __construct($mysqli,$queryStr,$paramTypes,$stmt){
		$this->QueryStr = $queryStr;
		$this->Con = $mysqli;
		$this->Stmt = $stmt;
		$this->setQueryType();
	}
	
	
	//query uitvoeren
	public function executeQuery($columnValues,$paramTypes){
		if($this->Stmt){
			
			
			$this->bindParams($columnValues,$paramTypes);
			
			
			if(!$this->Stmt->execute())
				return "Can't execute";
						
			else
				return $this->QueryType != "SELECT" ? "Query executed" : $stmt->bind_result($columnValues);
			
		}
		else{
			return "Error" . $this->Stmt->error;	
		}
	}
	//private functions
	private function setQueryType(){
				
		$this->QueryType = trim(substr(trim($this->QueryStr),0,7));
	}
	
	private function refValues($arr){
		if (strnatcmp(phpversion(),'5.3') >= 0) //Reference is required for PHP 5.3+
		{
			$refs = array();
			foreach($arr as $key => $value)
				$refs[$key] = &$arr[$key];
			return $refs;
		}
		return $arr;
	} 
	
	//parameter binding
	private function bindParams($columnValues,$paramTypes){
		array_unshift($columnValues,$paramTypes);
		$bindType = $this->QueryType != "SELECT" ? "bind_param" : "bind_result";
		call_user_func_array(array($this->Stmt, $bindType),$this->refValues($columnValues));
	}
}

?>