<?php
	$servername = "sci-mysql";
	$dbname = "coa123wdb";
	$username = "coa123wuser";
	$password = "grt64dkh!@2FD";
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	if (!$conn) {
		die("Connection failed: ".mysqli_connect_error());
	}
	$date = date('Y-m-d', strtotime($_GET["date"]));
	$size = $_GET["size"];
	$grade = $_GET["grade"];
	$sql="SELECT a.name, ANY_VALUE(a.capacity) AS cap, ANY_VALUE(a.licensed) AS lic, ANY_VALUE(c.cost) AS cost, CASE WHEN WEEKDAY('$date') < 5 THEN ANY_VALUE(a.weekday_price) ELSE ANY_VALUE(a.weekend_price) END AS price, CASE WHEN WEEKDAY('$date') < 5 THEN ANY_VALUE(a.weekday_price + (c.cost * $size)) ELSE ANY_VALUE(a.weekend_price + (c.cost * $size)) END AS total, COUNT(b.venue_id) AS boo, CASE WHEN WEEKDAY('$date') = 0 THEN 'Monday' WHEN WEEKDAY('$date') = 1 THEN 'Tuesday' WHEN WEEKDAY('$date') = 2 THEN 'Wednesday' WHEN WEEKDAY('$date') = 3 THEN 'Thursday' WHEN WEEKDAY('$date') = 4 THEN 'Friday' WHEN WEEKDAY('$date') = 5 THEN 'Saturday' ELSE 'Sunday' END AS dow FROM venue a JOIN venue_booking b ON a.venue_id = b.venue_id JOIN catering c ON a.venue_id = c.venue_id WHERE c.grade = $grade AND a.capacity >= $size AND a.name NOT IN(SELECT a.name FROM venue a JOIN venue_booking b ON a.venue_id = b.venue_id WHERE b.booking_date = '$date') GROUP BY a.name ORDER BY boo DESC";
	$result = mysqli_query($conn, $sql);
	$allDataArray = array();
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		$allDataArray[] = $row;
	}
	echo json_encode($allDataArray);
?>