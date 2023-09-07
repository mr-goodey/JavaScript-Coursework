<?php
	$servername = "sci-mysql";
	$dbname = "coa123wdb";
	$username = "coa123wuser";
	$password = "grt64dkh!@2FD";
	$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	$month = $_GET["month"];
	if ($month >= 1 && $month <= 12) {
		$stmt = $pdo->prepare("SELECT a.name, COUNT(a.venue_id) FROM venue a INNER JOIN venue_booking b ON a.venue_id = b.venue_id WHERE MONTH(b.booking_date) = $month GROUP BY a.name ORDER BY COUNT(a.venue_id) DESC");
		$stmt->execute([$month]);
		$data = $stmt->fetchAll();
		echo "<table border = '1px solid black'>";
		echo "<tr><th>Venue Name</th><th>Number of Bookings</th></tr>";
		foreach ($data as $row) {
			echo "<tr>";
			echo "<td>" . $row['name'] . "</td>";
			echo "<td>" . $row['COUNT(a.venue_id)'] . "</td>";
			echo "</tr>";
		}
		echo "</table>";
	} else {
		echo "Invalid input";
	}
?>