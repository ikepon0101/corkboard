<?php
try {
	$pdo = new PDO("mysql:host=127.0.0.1;dbname=corkboard;charset=utf8", "root", "ikepon0101");
	$stmt = $pdo->prepare("SELECT id, time, text, country FROM comments WHERE time > now() - INTERVAL 300 SECOND ORDER BY id LIMIT 10");
	$stmt->execute();

	$list = array();
	while ($row = $stmt->fetch()) {
		$item = array('id' => $row['id'], 'time' => $row['time'], 'text' => $row['text'], 'country' => $row['country']);
		array_push($list, $item);
	}

	header( 'Content-Type: text/javascript; charset=utf-8' );
	print $_GET['callback'] . "(" . json_encode($list) . ")";

} catch (Exception $e){
	echo $e;
	session_destroy();
}
exit();
