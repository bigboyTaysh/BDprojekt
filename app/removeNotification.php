<?php
	require "../config.php";
	require "../lib/lib.php";

	try
	{
		$connect = new PDO($servername, $username, $password, $options);
		$sql = "DELETE FROM powiadomienia WHERE id_powiadomienia = '{$_POST['id']}'";
		$statement = $connect->prepare($sql);
		$statement->execute();
	}
	catch(PDOException $error)
	{
		echo $sql . "<br>" . $error->getMessage();
	}
	
	
?>