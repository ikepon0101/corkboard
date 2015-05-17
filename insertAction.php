<?php
try {
	if (mb_strlen(trim($_REQUEST['text'])) <= 0) exit();
	$requestText = mb_strcut($_REQUEST['text'], 0, 200);
	$pdo = new PDO("mysql:host=127.0.0.1;dbname=corkboard;charset=utf8", "root", "ikepon0101");
	$stmt = $pdo->prepare("INSERT INTO `comments`(`time`, `text`, `country`) VALUES (now(), :TEXT, :COUNTRY)");
	$stmt->bindValue(':TEXT', $requestText, PDO::PARAM_STR);
	$stmt->bindValue(':COUNTRY', $_REQUEST['country'], PDO::PARAM_STR);
	$result = $stmt->execute();
} catch (Exception $e){
	echo $e;
	session_destroy();
}
exit();
