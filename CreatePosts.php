<?php

echo "<html>
<head>
    <link href='MyCustomStyle.css' rel='stylesheet' type='text/css' />
    <title>Create User</title>
</head>
<body>
    <header>
        <div class='Container'>
            <div class='Navbar'>
                <h1 id='NavExp'>Pages</h1>
            </div>
            <div class='Navbar'>
                <a href='https://people.eecs.ku.edu/~b122p496/subdir/eecs448/Lab05/UserHome.html'>User Home</a>
            </div>
			<div class='Navbar'>
                <a href='https://people.eecs.ku.edu/~b122p496/subdir/eecs448/Lab05/CreateUser.html'>Create User</a>
            </div>
            <div class='Navbar'>
                <a href='https://people.eecs.ku.edu/~b122p496/subdir/eecs448/Lab05/CreatePosts.html'>Create posts</a>
            </div>
        </div>
    </header>";

//access the global array called $_POST to get the values from the text fields
$username = $_POST["username"];
$content = $_POST["message"];
if ($username != "") {
	echo "<p>Attempting to use username: " . $username . "<br></p>";
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
			echo "<p>Attempting to post the message with content: " . $content . "<br></p>";
			if ($content=="" ) {
				echo "<p>Message is empty! Please enter text into the message and retry submission!</p>";
			}else{
				$query = "insert into Posts (content, author_id) values ( '" . $content . "', '" . $username . "');";
				If($myDatabaseClass->query($query)){
					echo "<p>Message Posted!</p>";
				}else{
					echo "<p>Failed posting message!</p>";
				}
			}


		}else{
			echo "<p>Enter a valid username!</p>";
		}
	}

	/* close connection */
	$myDatabaseClass->close();
}
else {
	echo "<p>You must enter a username in order to post a message!</p>";
}

echo "    <footer>
        <p>
            Created by Brandon Pramann 2019.
        </p>
    </footer>
</body>
</html>";

?> 