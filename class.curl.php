<?
/*
Author : KWJ
Date : 2010-02-25 06:00
*/

class Class_Curl {
	var $url = "";
	var $cookie ="";
	var $post = false;
	var $params = array();
	var $timeout = 30;
	var $receive_data = "";
	var $addopt = "";
	var $pagestatus = "";
	var $return = true;
	var $loadtime = 0;
	var $binarytransfer=0;
	var $headers = array("Content-Type"=>"text/html");
	var $sslverify = false;
	var $useragent = "";
	var $followlocation = 0;
	var $referer = "";
	var $debug = 0;

	public function __construct(){
	}
	
	public function curlInit(){
		if($this->post < 1){ // GET type
			if(is_array($this->params)){
				$tmp_data="";
				while(list($key,$val) = each($this->params)){
					if($tmp_data==""){
						$tmp_data.=$key."=".$val;
					}else{
						$tmp_data.="&".$key."=".$val;
					}
				}
			}else{
				$tmp_data = $this->params;
			}
			
			if($tmp_data!=""){
				if(substr($tmp_data,0,1)=="?"){
					$this->url=$this->url.$tmp_data;
				}else{
					$this->url=$this->url."?".$tmp_data;
				}
			}
		}
	}
	
	public function curlgetPage(){
//		$page_stime=mktime();
		$page_stime=time();
		$__curl_handler = curl_init();
		curl_setopt($__curl_handler, CURLOPT_URL, $this->url);
		curl_setopt($__curl_handler, CURLOPT_HTTPHEADER, $this->headers);
		if($this->post){
			curl_setopt($__curl_handler, CURLOPT_POST, $this->post);
			curl_setopt($__curl_handler, CURLOPT_POSTFIELDS, $this->params);
			if($this->debug){
				print_r($this->params);
			}
		}else{
			if($this->debug){
				echo $this->url;
			}
		}
		if($this->useragent!=""){
			curl_setopt($__curl_handler, CURLOPT_USERAGENT,$this->useragent);
		}
		curl_setopt($__curl_handler, CURLOPT_TIMEOUT, $this->timeout);
		curl_setopt($__curl_handler, CURLOPT_SSL_VERIFYPEER, $this->sslverify);
		curl_setopt($__curl_handler, CURLOPT_RETURNTRANSFER, 1);  //$this->return
		if($this->binarytransfer){
			curl_setopt($__curl_handler, CURLOPT_BINARYTRANSFER, 1);
		}
		curl_setopt($__curl_handler, CURLOPT_TCP_NODELAY, 1); 
		if($this->followlocation){
			curl_setopt($__curl_handler, CURLOPT_FOLLOWLOCATION, true);
		}
		if($this->referer!=""){
			curl_setopt($__curl_handler, CURLOPT_REFERER, $this->referer);
		}
		// add 2016-04-15 14:08 by kwj
		if($this->cookie!=""){
			curl_setopt($__curl_handler, CURLOPT_COOKIE, $this->cookie);
		}
		$this->receive_data = curl_exec ($__curl_handler); 
		$this->pagestatus = curl_getinfo($__curl_handler, CURLINFO_HTTP_CODE);
//		$page_etime=mktime();
		$page_etime=time();
		$this->loadtime = $page_etime-$page_stime;
		
		curl_close($__curl_handler);
	}
}

?>