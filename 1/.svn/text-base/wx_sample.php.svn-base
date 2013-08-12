<?php
/**
  * wechat php test
  */

//define your token
define("TOKEN", "wechat");

header('Content-Type:text/html; charset=UTF-8');

class Database {
    public $name=SAE_MYSQL_USER;
    public $password=SAE_MYSQL_PASS;
    public $db=SAE_MYSQL_DB;
    
    public function dql($sql){
        $mysql=new mysqli(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,$this->name,$this->password,$this->db);
        $mysql->query("set names utf8");    
        $res=$mysql->query($sql);
        return $res;
    }
    
    public function dml($sql)
    {   
        $mysql=new mysqli(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,$this->name,$this->password,$this->db);
        $mysql->query("set names utf8");    
        $mysql->query($sql);
        
    }
}

class wechat extends Database
{
	public function valid()
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if($this->checkSignature()){
        	echo $echoStr;
        	exit;
        }
    }

    public function responseMsg()
    {   
        // Welcome Information
        include 'welcome.php';

		//get post data, May be due to the different environments
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

      	//extract post data
		if (!empty($postStr)){
                
              	$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $fromUsername = $postObj->FromUserName;
                $toUsername = $postObj->ToUserName;
                $keyword = trim($postObj->Content);
                $time = time();
                $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";             
				if(!empty( $keyword ))
                {
              		$msgType = "text";
                	$contentStr = $welcomeinfo;
                	$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                	echo $resultStr;
                }else{
                	echo "Input something...";
                    $contentStr = $welcomeinfo;
                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                    echo $resultStr;
                }

        }else {
        	$contentStr = $welcomeinfo;
            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
            echo $resultStr;
        	// exit;
        }
    }
		
	private function checkSignature()
	{
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];	
        		
		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
}

$wechatObj = new wechat();
$wechatObj->responseMsg();
?>