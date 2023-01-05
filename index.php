<?php
	include('db.php');
	//connect to database.
	$mysqli = $db;

	// Get the total number of records from our table "students".
	$total_pages = $mysqli->query('SELECT * FROM journeys WHERE covered_distance > 10 AND duration > 10 LIMIT 100')->num_rows;

	// Check if the page number is specified and check if it's a number, if not return the default page number which is 1.
	$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

	// Number of results to show on each page.
	$num_results_on_page = 7;

	if ($stmt = $mysqli->prepare('SELECT * FROM journeys WHERE covered_distance > 10 AND duration > 10 ORDER BY id LIMIT ?,?')) {
	// Calculate the page to get the results we need from our table.
		$calc_page = ($page - 1) * $num_results_on_page;
		$stmt->bind_param('ii', $calc_page, $num_results_on_page);
		$stmt->execute(); 
		// Get the results...
		$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html>
	<head>
		<!--Import Google Icon Font-->
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<!--Import materialize.css-->
		<link type="text/css" rel="stylesheet" href="materialize/css/materialize.min.css"  media="screen,projection"/>
		<!--font-->
		<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
		<title>City Bike</title>
		<meta charset="utf-8">
		<style>
			html {
				font-family: quicksand;
				padding: 20px;
				background-color: #F8F9F9;
			}
			table{
				font-size: 1.2rem;
			}
			.test2 {
				padding: 15px ;
				display: inline-flex;
				justify-content: space-between;
				box-sizing: border-box;
				margin-top: 20px;
			}
			.test2 li {
				box-sizing: border-box;
				padding-right: 10px;
			}
			.test2 li a {
				box-sizing: border-box;
				padding: 4px 10px;
				text-decoration: none;
				font-size: 1.2rem;
				color: #616872;
				border-radius: 2px;
			}
			.test2 li a:hover {
				background-color: #eee;
				cursor: pointer;
			}
			.test2 .currentpage a {
				background-color: #ee6e73;
				color: #fff;
			}
			.test2 .currentpage a:hover {
				background-color: #ef5c61;
			}
			.material-icons {
				font-size: 1.8rem;
				line-height: 1;
				margin-top: 1px;
			}
			/*remove -bg from previous arrow*/
			li:first-child a:hover {
				background: none;
			}
			/*remove -bg from next arrow*/
			li:last-child a:hover {
				background: none;
			}
			.total{
				font-size: 1.3rem;
				letter-spacing: 2px;
				font-weight: 600;
			}
			.total_num{
				margin-left: 10px;
			}
		</style>
	</head>
	<body>
		<div class="row">
    	<div class="col s12 l8 center offset-l2">
				<h2>Journey list view</h2></br>
				<table class="responsive-table highlight">
					<tr>
						<th>Journey id</th>
						<th>Departure station name</th>
						<th>Return station name</th>
						<th>Covered Distance</th>
						<th>Duration</th>
					</tr>
					<?php 
						while ($row = $result->fetch_assoc()):
							//Changing covered distance into km
							$distance_km =  $row['covered_distance'] / 1000;
							// format into two decimals
							$km_decimal = number_format($distance_km, 2);

							//Changing covered distance into km
							$duration_min = $row['duration'] ;
							//Calculate seconds
							$secs = $duration_min % 60;
							//Calculate hours
							$hrs = $duration_min / 60;
							//Calculate minutes
							$mins = $hrs % 60;

							$hrs = $hrs / 60;
							// format into two decimals
							//$km_decimal = number_format($distance_km, 2);
					?>
					<tr>
						<td><?php echo $row['id']; ?></td>
						<td><?php echo $row['departure_station_name']; ?></td>
						<td><?php echo $row['return_station_name']; ?></td>
						<td><?php echo $km_decimal, "km"; ?></td>
						<td>
							<?php 
								// if duration is over an hour
								if($hrs >= 1){
									echo (int)$hrs . "h " . (int)$mins . "m " . (int)$secs . "s"; 
								}
								//less than one hour
								else{
									echo (int)$mins . "m " . (int)$secs . "s"; 
								}
							?></td>
					</tr>
					<?php endwhile; ?>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col s12 center">
			<?php if (ceil($total_pages / $num_results_on_page) > 0): ?>
				<ul class="test2">
					<?php if ($page > 1): ?>
					<!--<li class="prev"><a href="test2.php?page=<?php echo $page-1 ?>">Prev</a></li>-->
					<li class="waves-effect"><a href="test2.php?page=<?php echo $page-1 ?>"><i class="material-icons">chevron_left</i></a></li>
					<?php endif; ?>
	
					<?php if ($page > 3): ?>
					<li class="start"><a href="test2.php?page=1">1</a></li>
					<li class="dots">...</li>
					<?php endif; ?>
	
					<?php if ($page-2 > 0): ?><li class="page"><a href="test2.php?page=<?php echo $page-2 ?>"><?php echo $page-2 ?></a></li><?php endif; ?>
					<?php if ($page-1 > 0): ?><li class="page"><a href="test2.php?page=<?php echo $page-1 ?>"><?php echo $page-1 ?></a></li><?php endif; ?>
	
					<li class="currentpage"><a href="test2.php?page=<?php echo $page ?>"><?php echo $page ?></a></li>
	
					<?php if ($page+1 < ceil($total_pages / $num_results_on_page)+1): ?><li class="page"><a href="test2.php?page=<?php echo $page+1 ?>"><?php echo $page+1 ?></a></li><?php endif; ?>
					<?php if ($page+2 < ceil($total_pages / $num_results_on_page)+1): ?><li class="page"><a href="test2.php?page=<?php echo $page+2 ?>"><?php echo $page+2 ?></a></li><?php endif; ?>
	
					<?php if ($page < ceil($total_pages / $num_results_on_page)-2): ?>
					<li class="dots">...</li>
					<li class="end"><a href="test2.php?page=<?php echo ceil($total_pages / $num_results_on_page) ?>"><?php echo ceil($total_pages / $num_results_on_page) ?></a></li>
					<?php endif; ?>
	
					<?php if ($page < ceil($total_pages / $num_results_on_page)): ?>
					<!--<li class="next"><a href="test2.php?page=<?php echo $page+1 ?>">Next</a></li>-->
					<li class="waves-effect"><a href="test2.php?page=<?php echo $page+1 ?>"><i class="material-icons">chevron_right</i></a></li>
					<?php endif; ?>
				</ul>
				<?php endif; ?>
				<p class="center-align total">Total journeys:<span class="total_num"><?php echo $total_pages;?></span></p>
			</div>
		</div>
		<script type="text/javascript" src="materialize/js/materialize.min.js"></script>
	</body>
</html>
<?php
//close query connection
	$stmt->close();
	}
?>