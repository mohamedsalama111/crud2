<?php
	session_start();


	$con = new mysqli('localhost', 'root', '', 'crud') or die(mysql_error($con));

	$id 	= 0;
	$name	= null;
	$loc	= null;
	$update	= false;

		if(isset($_POST['save'])) {
			$name = $_POST['name'];
			$loc  = $_POST['location'];
			$con->query("INSERT INTO new (name,loc) VALUES('$name', '$loc')") or die($con->error);
			$_SESSION['message']  = 'Record Has Been Saved!!';
			$_SESSION['msg_type'] = 'success';

			header('location: index.php');
		}

		if(isset($_GET['delete'])) {
			$id = $_GET['delete'];
			$con->query("DELETE FROM new WHERE id=$id") or die(mysql_error());
			$_SESSION['message']  = 'Record Has Been Deleted!!';
			$_SESSION['msg_type'] = 'danger';

			header('location: index.php');
		}

		if(isset($_GET['edit'])) {
			$id = $_GET['edit'];
			$update = true;
			$result = $con->query("SELECT * FROM new WHERE id=$id") or die($con->error);
			if (count(array($result))==1) {
				$row  = $result->fetch_array();
				$name = $row['name'];
				$loc  = $row['loc'];
			}
		}
		
		if (isset($_POST['update'])) {
		$id = $_POST['id'];
		$name = $_POST['name'];
		$loc  = $_POST['location'];
		$con->query("UPDATE new SET name='$name', loc='$loc' WHERE id=$id") or die(mysql_error());

		$_SESSION['message']  = 'Record Has Been Updated!!';
		$_SESSION['msg_type'] = 'warning';

		header('location: index.php');
	}