<?php
//access the global array called $_POST to get the values from the text fields

echo "<html>
<head>
    <link href='MyCustomStyle.css' rel='stylesheet' type='text/css' />
    <title>View Posts By User</title>
</head>
<body>
    <header>
        <div id='BigContainer'>
            <div class='Navbar'>
                <h1 id='NavExp'>Pages</h1>
            </div>
            <div class='Navbar'>
                <a href='https://people.eecs.ku.edu/~b122p496/subdir/eecs448/Lab05/AdminHome.html'>Admin Home</a>
            </div>
            <div class='Navbar'>
                <a href='https://people.eecs.ku.edu/~b122p496/subdir/eecs448/Lab05/ViewUsers.php'>View users</a>
            </div>
			<div class='Navbar'>
				<a href='https://people.eecs.ku.edu/~b122p496/subdir/eecs448/Lab05/ViewUserPosts.html'>View posts by user</a>
			</div>
            <div class='Navbar'>
                <a href='https://people.eecs.ku.edu/~b122p496/subdir/eecs448/Lab05/DeletePost.html'>Delete posts</a>
            </div>
        </div>
    </header>";



$username = $_POST["chosenUsername"];
if ($username != "") {
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
			$query = "select * from Posts where author_id = '" . $username . "';";
			echo "<table>";
			echo "<tr><td>Post number</td><td>Username</td><td>Post content</td></tr>";

			if ($result = $myDatabaseClass->query($query)) {
				/* fetch associative array */
				while ($row = $result->fetch_assoc()) {
					echo "<tr>";
					echo "<td>" . $row[post_id] . "</td>";
					echo "<td>" . $row[author_id] . "</td>";
					echo "<td>" . $row[content] . "</td>";
					echo "</tr>";
				}

				/* free result set */
				$result->free();
			}
			echo "</table>";
			
		}else{
			echo "<p>Username does not exist! Choose another!</p>";
		}
	}

	/* close connection */
	$myDatabaseClass->close();
}
else {
	echo "<p>Username must be non-empty!</p>";
}



echo "    <footer>
        <p>
            Created by Brandon Pramann 2019.
        </p>
    </footer>

</body>
</html>";




?> 