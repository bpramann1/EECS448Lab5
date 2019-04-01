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


//access the global array called $_POST to get the values from the text fields
	$myDatabaseClass = new mysqli("mysql.eecs.ku.edu", "b122p496", "yae9Kei3", "b122p496");

	/* check connection */
	if ($myDatabaseClass->connect_error) {
	    printf("Connect failed: %s\n", $myDatabaseClass->connect_error);
	    exit();
	}

	$deleteString = "";
	$postIdsToDelete = "";
	$ItemIndexInDeleteString = 0;
	foreach ($_POST['Posts'] as &$value) {
		if ($ItemIndexInDeleteString == 0) {
			$deleteString = $deleteString . "'" . $value . "'";
			$postIdsToDelete = $postIdsToDelete . $value;
		}else{
			$deleteString = $deleteString . " OR post_id ='" . $value . "'";
			if ($ItemIndexInDeleteString == (sizeOf($_POST['Posts'])-1)) {
				$postIdsToDelete = $postIdsToDelete . ", and " . $value;
			}else{
				$postIdsToDelete = $postIdsToDelete . ", " . $value;
			}
		}
		$ItemIndexInDeleteString = $ItemIndexInDeleteString + 1;
	}
	$query = "Delete FROM Posts WHERE post_id =" . $deleteString . ";";

	if ($result = $myDatabaseClass->query($query)) {
		echo "Successful in deleting posts with id: " . $postIdsToDelete . "!";
		$result->free();
	}else{
		echo "Faliure in deleting posts!\n";
	}

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