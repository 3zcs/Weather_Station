<?php
require 'confing.php';
require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();

//ready
$app->get('/data/get', function() use ($app) {
	$db =getDB();
	$sql = "SELECT * from weather ORDER BY id DESC";
	$stmt = $db->query($sql); 
	$items = $stmt->fetchAll(PDO::FETCH_OBJ);
	echo json_encode($items);
});


$app->get('/data/android', function() use ($app) {
        $db =getDB();
        $sql = "SELECT * from weather where id =(SELECT MAX(id) FROM weather)";
        $stmt = $db->query($sql); 
        $items = $stmt->fetchAll(PDO::FETCH_OBJ);
        echo json_encode($items);
});


$app->get('/data/post/:one/:two/:three', function ($one, $two,$three) use ($app) {
    echo "The first parameter is " . $one;
    $db =getDB();
	$sql = "INSERT INTO `weather` (`id`, `datetime`, `Temp`, `Humdity`, `smoke`) VALUES (NULL, NULL, '".$one."', '".$two."', '".$three."')";

	$result = $db->query($sql); 
	if($result){
		$app->response->setStatus(201);
		echo '{"flag": "true","msg": "item successfully added"}';
	}else{
		$app->response->setStatus(422);
		echo '{"flag": "false","msg": "Oops! An error occurred"}';
	}
});


$app->put('/data', function() use ($app) {
	$db =getDB();
	$json = $app->request->getBody();
	$data = json_decode($json, true);
	$sql = "update weather set `name` = '".$data['name']."',`count` ='".$data['count']."' where id ='".$data['id']."'";
	$result = $db->query($sql); 
	if($result){
		$app->response->setStatus(200);
		echo '{"flag": "true","msg": "item successfully updated"}';
	}else{
		$app->response->setStatus(422);
		echo '{"flag": "false","msg": "Oops! An error occurred"}';
	}
});

//Ready
$app->get('/data/delete/:id', function($id) use ($app) {
	$db = getDB();
	$sql = "delete from weather where id ='".$id."'";
	$result = $db->query($sql); 
	if($result){
		$app->response->setStatus(200);
		echo '{"flag": "true","msg": "item successfully deleted"}';
	}else{
		$app->response->setStatus(422);
		echo '{"flag": "false","msg": "Oops! An error occurred"}';
	}
});
$app->run();
?>
