<?php 		
	class XunCoin {
		var $rpcUrl;
		var $rpcUser;
		var $rpcPassword;
		function __construct($config=array()) {	
			$this->rpcUrl= $config['rpcUrl'];
			$this->rpcUser= $config['rpcUser'];
			$this->rpcPassword= $config['rpcPassword'];
		}		
 		
		function execute_xunrpc($method='getStatus',$params=array()){
			$apiUrl=$this->rpcUrl;
			$apiuser=$this->rpcUser;
			$apipw=$this->rpcPassword;

			//$apiUrl = 'http://localhost:8070/json_rpc';
			$message_array = array('jsonrpc' => '2.0', 'id' => 1, 'method' => $method);
			if (count($params)>0) {
				$message_array['params']=$params;
			}
		    $message = json_encode($message_array);
		    $requestHeaders = [
		        'Content-type: application/json'
		    ];
		    $ch = curl_init($apiUrl);
		    curl_setopt($ch, CURLOPT_POST, 1);
		    curl_setopt($ch, CURLOPT_USERPWD, $apiuser.":".$apipw);
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		    curl_setopt($ch, CURLOPT_POSTFIELDS, $message);
		    curl_setopt($ch, CURLOPT_HTTPHEADER, $requestHeaders);
		    
		    $response = curl_exec($ch);
		    curl_close($ch);
		    $obj=json_decode($response, false);
		    return $obj->result;
		}
		function get_current_xunBlock(){
			$response=$this->execute_xunrpc('getStatus',[]);
		    return 	$response->blockCount;
		}
		
		function getStatus(){
			$response=$this->execute_xunrpc('getStatus');
			return $response;
		}
		function createAddress(){
			$response=$this->execute_xunrpc('createAddress');
			return $response->address;
		}
		function deleteAddress($address){
			$response=$this->execute_xunrpc('deleteAddress',['address'=>$address]);
			if ($response!=null) {
				return true;
			}else{
				return null;
			}
		}
		function getBalance($xun_address){
			$response=$this->execute_xunrpc('getBalance',['address'=>$xun_address]);
			if (!is_null($response->availableBalance)) {
				//return 	$response->availableBalance/1000000+$response->lockedAmount/1000000;
				return 	$response->availableBalance/1000000;
			}else{
				return null;
			}    
		}
                function getPrivateKey($xun_address){
                        $response=$this->execute_xunrpc('getSpendKeys',['address'=>$xun_address]);
                        if (!is_null($response->guiKey)) {
                                return $response->guiKey;
                        } else {
                                return null;
                        }
                }
		function getUnconfirmedTransactionHashes($address){
			$response=$this->execute_xunrpc('getUnconfirmedTransactionHashes',['address'=>$address]);
			return $response->transactionHashes;
		}
		function getTransactions($firstBlockIndex,$blockCount){
			$response=$this->execute_xunrpc('getTransactions',['firstBlockIndex'=>$firstBlockIndex,'blockCount'=>$blockCount]);
			return $response->items;
		}
		function getTransaction($transactionHash){
			$response=$this->execute_xunrpc('getTransaction',['transactionHash'=>$transactionHash]);
			return $response->transaction;
		}
		function sendTransactionAdvanced($params){
			$response=$this->execute_xunrpc('sendTransaction',$params);
			return $response->transaction;
		}
		function sendTransaction($from,$to,$ammount){
			$params=[
			"addresses"=>[$from],
				"anonymity"=> 2,
				"fee"=> 10000,
				"transfers"=>[
					[
						"amount"=>$ammount,
						"address"=>$to
					]
			]];
			$response=$this->execute_xunrpc('sendTransaction',$params);
			return $response->transactionHash;
		}
		function reset(){
			$response=$this->execute_xunrpc('reset');
			return $response;
		}
		function save(){
			$response=$this->execute_xunrpc('save');
			return $response;
		}
		function get_new_xunTransactions($Starting_block,$Current_block){
			$range=(int)$Current_block-(int)$Starting_block;
			$response=$this->execute_xunrpc('getTransactions',['firstBlockIndex'=>(int)$Starting_block,"blockCount"=>$range]);
			$transactions = array();
		    foreach ($response->items as $key => $item) {
		        if(count($item->transactions)>0){
		            $transactions[]=$item->transactions[0]->amount/1000000;
		        }
		    }
			return 	$response;	
		}
 
	}	 
?>
