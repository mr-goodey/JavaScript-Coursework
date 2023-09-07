<?php
	$min = $_GET["min"];
	$max = $_GET["max"];
	$c1 = $_GET["c1"];
	$c2 = $_GET["c2"];
	$c3 = $_GET["c3"];
	$c4 = $_GET["c4"];
	$c5 = $_GET["c5"];
	echo "<table border = '1px solid black'>";
	echo "<tr><th></th><th>".$c1."</th><th>".$c2."</th><th>".$c3."</th><th>".$c4."</th><th>".$c5."</th></tr>";
	for ($i = $min; $i <= $max; $i += 5) {
		echo "<tr><th>".$i."</th><td>".($i * $c1)."</td><td>".($i * $c2)."</td><td>".($i * $c3)."</td><td>".($i * $c4)."</td><td>".($i * $c5)."</td></tr>";
	}
	echo "</table>";
?>