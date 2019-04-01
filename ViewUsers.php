<?php

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

	$myDatabaseClass = new mysqli("mysql.eecs.ku.edu", "b122p496", "yae9Kei3", "b122p496");

	/* check connection */
	if ($myDatabaseClass->connect_error) {
	    printf("Connect failed: %s\n", $myDatabaseClass->connect_error);
	    exit();
	}

	$query = "select user_id from Users;";
	$userNumber = 1;
	echo "<table>";
	echo "<tr><td>User number</td><td>Username</td></tr>";

	if ($result = $myDatabaseClass->query($query)) {
		/* fetch associative array */
		while ($row = $result->fetch_assoc()) {
			echo "<tr>";
			echo "<td>" . $userNumber . "</td>";
			echo "<td>" . $row[user_id] . "</td>";
			echo "</tr>";
			$userNumber = $userNumber + 1;
		}

		/* free result set */
		$result->free();
	}
	echo "</table>";
	/* close connection */
	$myDatabaseClass->close();

	echo "    <footer>
        <p>
            Created by Brandon Pramann 2019.
        </p>
    </footer>

</body>
</html>";

?> 