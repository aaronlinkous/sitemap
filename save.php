<?php
	require_once 'include/connection.php';
?>
<?php
	if (isset($_POST['data'])) {
		header("Cache-Control: no-cache, must-revalidate");
		header("Content-type: application/json");
		
		$data = json_decode($_POST['data'], true);
		$SQL = '';
		foreach($data as $item){
			$id = $item['id'];
			$pid = ($item['pid'] == 0)?'NULL':$item['pid'];
			$order = $item['order'];
			$SQL .= "UPDATE `sitemap` SET `pid` = $pid, `order` = $order WHERE `id` = $id;";
		}
		$update = dbUpdate($SQL);
		dbClose();
		
		if ($update == 0){
			echo json_encode(array('respond'=>'Saved'));
		} else {
			echo json_encode(array('respond'=>'Error'));
		}
	}
?>