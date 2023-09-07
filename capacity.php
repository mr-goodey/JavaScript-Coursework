<?php
	$servername = "sci-mysql";
	$dbname = "coa123wdb";
	$username = "coa123wuser";
	$password = "grt64dkh!@2FD";
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	if (!$conn) {
		die("Connection failed: ".mysqli_connect_error());
	}
	$minCapacity = $_GET["minCapacity"];
	$maxCapacity = $_GET["maxCapacity"];
	$sql="SELECT * FROM venue WHERE capacity >= $minCapacity AND capacity <= $maxCapacity AND licensed = 1";
	$result = mysqli_query($conn, $sql);
	if ($minCapacity <= $maxCapacity && $minCapacity >= 0 && $maxCapacity >= 0) {
		if (mysqli_num_rows($result) > 0) {
			echo "<table border = '1px solid black'>";
			echo "<tr><th>Venue Name</th><th>Weekday Price</th><th>Weekend Price</th></tr>";
			while ($row = mysqli_fetch_array($result)) {
				echo "<tr><td>".$row["name"]."</td><td>".$row["weekday_price"]."</td><td>".$row["weekend_price"]."</td></tr>";
			}
			echo "</table>";
		} else {
			echo "No results";
		}
	} else {
		echo "Invalid inputs";
	}
	mysqli_close($conn);
?>