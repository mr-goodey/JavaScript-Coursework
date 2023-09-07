<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<style>
			.center {
				display: block;
				margin-left: auto;
				margin-right: auto;
				width: 50%;
				height: auto;
			}
			h1 {
				text-align: center;
				font-family: 'Courier New', monospace;
			}
		</style>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script>
			$(document).ready(function() {
				$("#submitBtn").click(function() {
					let date = $("#date").val();
					let size = $("#size").val();
					let grade = $("#grade").val();
					if (size < 0 || grade < 1 || grade > 5 || !(size % 1 === 0) || !(grade % 1 === 0) || !(date)) {
						$("#response").html("Invalid input");
					} else {
						$.ajax({
							url: "process-wedding-request.php",
							type: "GET",
							data: {date:date, size:size, grade:grade},
							success: function (responseData) {
								let len = responseData.length;
								if (len == 0) {
									$("#response").html("No results");
								} else {
									let insertedHtml = "<div style='overflow-x:auto;'><table class='table table-dark table-striped'>";
									insertedHtml += "<tr><th>Name</th><th>Capacity</th><th>Licensed</th><th>Catering Cost</th><th>Day Price</th><th>Total Price</th><th>Bookings</th><th>Day of Week</th></tr>"
									for (let i = 0; i < len; i++) {
										let name = responseData[i].name;
										let cap = responseData[i].cap;
										let lic = responseData[i].lic;
										let cost = responseData[i].cost;
										let price = responseData[i].price;
										let total = responseData[i].total;
										let boo = responseData[i].boo;
										let dow = responseData[i].dow;
										insertedHtml += "<tr>" +
										"<td>" + name + "</td>" +
										"<td>" + cap + "</td>" +
										"<td>" + lic + "</td>" +
										"<td>" + cost + "</td>" +
										"<td>" + price + "</td>" +
										"<td>" + total + "</td>" +
										"<td>" + boo + "</td>" +
										"<td>" + dow + "</td>"
										"</tr>";
									}
									insertedHtml += "</table></div>";
									$("#response").html(insertedHtml);
								}
							},
							error: function (xhr, status, error) {
								console.log(xhr.status + ': ' + xhr.statusText);
							},
							dataType: "json"
						});
					}
				});
			});
		</script>
		<title>Wedding</title>
	</head>
	<body>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
		<h1>Wedding Venues</h1>
		<nav>
			<div class="nav nav-tabs" id="nav-tab" role="tablist">
				<button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Home</button>
				<button class="nav-link" id="nav-search-tab" data-bs-toggle="tab" data-bs-target="#nav-search" type="button" role="tab" aria-controls="nav-search" aria-selected="false">Search</button>
			</div>
		</nav>
		<div class="tab-content" id="nav-tabContent">
			<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
				<img src="wedding.jpeg" class="center">
				<p style="font-size:2vw;">We want to help you find your dream wedding venue! In the search tab you can enter the date, party size and catering grade and we will help you to find the best venues for you.</p>
				<img src="people.jpeg" class="center">
				<p style="font-size:2vw;">We can accommodate all group sizes whether big or small, we hope to make this special day even more special for you.</p>
				<img src="food.jpeg" class="center">
				<p style="font-size:2vw;">We also offer great quality food! You can select your catering grade, 1-5, with delicious and affordable food offered.</p>
				<div style="overflow-x:auto;">
					<table class="table table-dark table-striped">
						<tr>
							<th>Venue Name</th>
						</tr>
						<tr>
							<td>Central Plaza</td>
						</tr>
						<tr>
							<td>Pacific Towers Hotel</td>
						</tr>
						<tr>
							<td>Sky Center Complex</td>
						</tr>
						<tr>
							<td>Sea View Tavern</td>
						</tr>
						<tr>
							<td>Ashby Castle</td>
						</tr>
						<tr>
							<td>Fawlty Towers</td>
						</tr>
						<tr>
							<td>Hilltop Mansion</td>
						</tr>
						<tr>
							<td>Haslegrave Hotel</td>
						</tr>
						<tr>
							<td>Forest Inn</td>
						</tr>
						<tr>
							<td>Southwestern Estate</td>
						</tr>
					</table>
				</div>
				<p style="font-size:2vw;">Each of our venues can offer you the day you have dreamed of...</p>
			</div>
			<div class="tab-pane fade" id="nav-search" role="tabpanel" aria-labelledby="nav-search-tab">
				<div id="searchForm">
					<label for="date">Date:</label><br>
					<input type="date" id="date" name="date"/><br>
					<label for="size">Party Size:</label><br>
					<input type="number" min="0" step="1" id="size" name="size"><br>
					<label for="grade">Catering Grade:</label><br>
					<input type="number" min="0" step="1" id="grade" name="grade"><br>
					<button id="submitBtn">Submit</button><br>
					<div id="response"></div>
				</div><br>
			</div>
		</div>
	</body>
</html>