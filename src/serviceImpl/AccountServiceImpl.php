<?php

/**
 * Implementação da interface @{AccountService}
 *
 */

require_once("serviceImpl/BaseService.php");

class AccountServiceImpl extends BaseService implements AccountService {
	
	public function __construct() {
	
		parent::__construct();
	}
	
	public function __destruct() {
	
		parent::__destruct();
	}

	public function searchAccounts($cpf) {

		try{

			$searchRequest = new SearchRequest();
			$searchRequest->setCpf($cpf);

			$httpResponse = $this->getHttpHelper()->post(Config::accountHost, $searchRequest, $this->getAuthenticationHelper()->generateAuthenticationBasic());

			if(!$httpResponse->isResponseOK()){
			
				if($httpResponse->isBadRequest()) {
				
					throw new AccountException("Parametros fornecidos sao invalidos: " . $httpResponse->getResponse());
				}
			
				throw new AccountException("Falha ao criar conta: " . $httpResponse->getResponse());
			}
				
			return $this->parse($httpResponse->getResponse());
			
		} catch (ServiceHttpException $e) {
			
			throw new AccountException("Falha HTTP ao criar conta", $e);
		}	

	}
}


?>