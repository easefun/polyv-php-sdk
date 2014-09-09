<?php 

class PolyvSDK {
		
	private $_readtoken;				
	private $_writetoken;
	private $_privateKey;
	private $_sign;
	
	function __construct() {
	
		$this->_readtoken 	= "nsJ7ZgQMN0-QsVkscukWt-qLfodxoDFm";
		$this->_writetoken 	= "Y07Q4yopIVXN83n-MPoIlirBKmrMPJu0";	
		$this->_privatekey = "DFZhoOnkQf";	
		$this->_sign = true;//提交参数是否需要签名
	}
	
	private function _processXmlResponse($url, $xml = ''){

		if (extension_loaded('curl')) {
			$ch = curl_init() or die ( curl_error() );
			$timeout = 10;
			curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false);	
			curl_setopt( $ch, CURLOPT_URL, $url );
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
			curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, $timeout);
			if(!empty($xml)){
				curl_setopt($ch, CURLOPT_HEADER, 0);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
				curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                                       'Content-type: application/xml',
                                       'Content-length: ' . strlen($xml)
                                     ));
			}
			$data = curl_exec( $ch );
			curl_close( $ch );

			if($data)
				return (new SimpleXMLElement($data));
			else
				return false;
		}
		if(!empty($xml))
			throw new Exception('Set xml, but curl does not installed.');

		return (simplexml_load_file($url));	
	}
	private function makeVideo($video){
		return array(
					'vid' => $video->vid, 
					'hlsIndex' => $video->hlsIndex, 
					'swf_link' => $video->swf_link, 
					'ptime' => $video->ptime, 
					'status' => $video->status, 
					'df' => $video->df, 
					'first_image' => $video->first_image, 
					'title' => $video->title, 
					'desc' => $video->context, 
					'duration' => $video->duration, 
					'flv1' => $video->flv1, 
					'flv2' => $video->flv2, 
					'flv3' => $video->flv3, 
					'mp4_1' => $video->mp4_1,
					'mp4_2' => $video->mp4_2,
					'mp4_3' => $video->mp4_3,					
					'hls_1' => $video->hls_1,
					'hls_2' => $video->hls_2,
					'hls_3' => $video->hls_3,
					'seed' => $video->seed
					);
	}
			
	public function getById($vid) {
		if($this->_sign){
			$hash = sha1('readtoken='.$this->_readtoken.'&vid='.$vid.$this->_privatekey);
		}
		$xml = $this->_processXmlResponse('http://v.polyv.net/uc/services/rest?readtoken='.$this->_readtoken.'&method=getById&vid='.$vid.'&format=xml&sign='.$hash, $xml);
		if($xml) {
			if($xml->error=='0') 
				
					return $this->makeVideo($xml->data->video);
			else 
				return array(
					'returncode' => $xml->error
					);
		}
		else {
			return null;
		}
		
	}
	
	public function getNewList($pageNum,$numPerPage,$catatree) {
	
					
		if($this->_sign){
			$hash = sha1('catatree='.$catatree.'&numPerPage='.$numPerPage.'&pageNum='.$pageNum.'&readtoken='.$this->_readtoken.$this->_privatekey);
		}
		//echo 'http://v.polyv.net/uc/services/rest?readtoken='.$this->_readtoken.'&method=getNewList&pageNum='.$pageNum.'&format=xml&numPerPage='.$numPerPage.'&catatree='.$catatree.'&sign='.$hash;
		$xml = $this->_processXmlResponse('http://v.polyv.net/uc/services/rest?readtoken='.$this->_readtoken.'&method=getNewList&pageNum='.$pageNum.'&format=xml&numPerPage='.$numPerPage.'&catatree='.$catatree.'&sign='.$hash, $xml);
		if($xml) {
			if($xml->error=='0') {
				foreach ($xml->data->video as $video){ 
					
					$videodata = $this->makeVideo($video);
					$result[$num] =$videodata;
					$num++;
				}
				return $result;
			}else{
				return array(
					'returncode' => $xml->error
					);
			}
		}
		else {
			return null;
		}
		
	}
}