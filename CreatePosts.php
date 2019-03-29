<?php
//access the global array called $_POST to get the values from the text fields
$username = $_POST["username"];
if ($username != "") {
	echo "<p>Attempted to add username: " . $username . "<br></p>";
	$myDatabaseClass = new mysqli("mysql.eecs.ku.edu", "b122p496", "yae9Kei3", "b122p496");

	/* check connection */
	if ($myDatabaseClass->connect_error) {
	    printf("Connect failed: %s\n", $myDatabaseClass->connect_error);
	    exit();
	}

	$user_exists = false;
	$query = "select user_id from Users;";

	if ($result = $myDatabaseClass->query($query)) {

		/* fetch associative array */
		while ($row = $result->fetch_assoc()) {
			if ($row[user_id] == $username){
				$user_exists = true;
			}
		}

		/* free result set */
		$result->free();


		if ($user_exists){
			echo "<p>Username already exists! Choose another!</p>";
		}else{
			$query = "insert into Users (user_id) values ( '" . $username . "');";
			If($myDatabaseClass->query($query)){
				echo "<p>Username added!</p>";
			}else{
				echo "<p>Failed adding username!</p>";
			}

		}
	}

	/* close connection */
	$myDatabaseClass->close();
}
else {
	echo "<p>Username must be non-empty!</p>";
}








?> 