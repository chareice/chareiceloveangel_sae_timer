<?php
date_default_timezone_set("Asia/Shanghai");
class Together{
	public static $begin;
	public static function getTogetherTime(){
		self::$begin = strtotime('2014-02-18 20:30');
		$now = time();
		$timeSecond = $now - self::$begin;
		return array(
			'begin' => self::$begin,
			'now' => $now,
			'timeSecond' => $timeSecond,
			'days' => intval($timeSecond / (60*60*24)),
			'hours'=> intval(($timeSecond / (60*60)) % 24),
			'minutes' => intval(($timeSecond / 60) % 60),
			'seconds' => intval($timeSecond % 60)
			);
	}
}
$request_header = array();
foreach(getallheaders() as $name => $value){
    $request_header[$name] = $value;
}
if(isset($request_header['Origin'])){
    header("Access-Control-Allow-Origin: {$request_header['Origin']}");
}
if(isset($_GET['callback'])){
	header("Content-type:application/x-javascript");
	echo sprintf("%s(%s)",$_GET['callback'],json_encode(Together::getTogetherTime()));
}else{
	header("Content-type:application/json");
	echo json_encode(Together::getTogetherTime());
}
