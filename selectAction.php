<?php
try {
	$pdo = new PDO("mysql:host=127.0.0.1;dbname=corkboard;charset=utf8", "root", "ikepon0101");
	$stmt = $pdo->prepare("SELECT id, time, text, country FROM comments WHERE time > now() - INTERVAL 60 SECOND");
	//$stmt->bindValue(':TEXT', $_REQUEST['text'], PDO::PARAM_STR);
	//$stmt->bindValue(':COUNTRY', $_REQUEST['country'], PDO::PARAM_STR);
	$stmt->execute();

	$json = array();
	while ($row = $stmt->fetch()) {
		$array = array('id' => $row['id'], 'time' => $row['time'], 'text' => $row['text'], 'country' => $row['country']);
		array_push($json, json_encode($array));
	}

	print json_encode($json);

} catch (Exception $e){
	echo $e;
	session_destroy();
}
exit();
