<?php
header("Content-type: text/html; charset=utf-8");
$key  = 'chat';

$mmc = memcache_init();
if($mmc == false){
    echo "mc init failed\n";
}

// 消息都储存在这个文件中
$msg = isset($_REQUEST['msg']) ? $_REQUEST['msg'] : '';
 
if ($msg != ''){
	//file_put_contents($filename,$msg);
	memcache_set($mmc,$key,$msg);
	memcache_set($mmc,"timestamp",time());
	//$s->write('chat', $filename,$msg);
	//$data = $s->read('chat', $filename);
	//echo memcache_get($mmc,$filename);
	die();
}
$mmc = memcache_init();

$lastmodif    = isset($_REQUEST['timestamp']) ? $_REQUEST['timestamp'] : 0;
$currentmodif = memcache_get($mmc,"timestamp");
echo memcache_get($mmc,$key,$msg);
echo $lastmodif;
echo $currentmodif;
/*
if(!$currentmodif){
	$currentmodif = time();
}
while ($currentmodif!=$lastmodif){ // 如果数据文件已经被修改
	usleep(100000); // 100ms暂停 缓解CPU压力
	clearstatcache(); //清除缓存信息
	$currentmodif = memcache_get($mmc,"timestamp");
}
$response = array();
$response['msg']       = urldecode(memcache_get($mmc,$key));
$response['timestamp']       = $currentmodif;
echo json_encode($response); 
flush();
/*
// 不停的循环，直到储存消息的文件被修改
$lastmodif    = isset($_REQUEST['timestamp']) ? $_REQUEST['timestamp'] : 0;

$opt = $s->getAttr('chat',$filename);
//print_r($opt);
$currentmodif = $opt["md5sum"];

//echo $currentmodif;


while ($currentmodif!=$lastmodif){ // 如果数据文件已经被修改
	//usleep(100000); // 100ms暂停 缓解CPU压力
	//clearstatcache(); //清除缓存信息
	$opt = $s->getAttr('chat',$filename);
	$currentmodif = $opt["md5sum"];
}
 
// 返回json数组
$response = array();
$response['msg']       = urldecode($s->read('chat', $filename));
$response['timestamp'] = $currentmodif;
echo json_encode($response); 
flush();
*/
?>