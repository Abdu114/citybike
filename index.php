<?php
	include('db.php');
	//connect to database.
	$mysqli = $db;

	// Get the total number of records from our table "journeys".
	$total_pages = $mysqli->query('SELECT * FROM journeys WHERE covered_distance > 10 AND duration > 10 LIMIT 30000')->num_rows;

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
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
		<!--Import Google Icon Font-->
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<!--Import materialize.css-->
		<link type="text/css" rel="stylesheet" href="materialize/css/materialize.min.css"  media="screen,projection"/>
		<!--font-->
		<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
		<!-- External CSS file-->
    <link rel="stylesheet" href="index.css">
    <title>City Bike || Journeys List VIew</title>
	</head>
	<body>
		<nav>
			<a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
			<div class="nav-wrapper">
				<ul class="hide-on-med-and-down" id="nav-center">
					<li class="active"><a href="#">Journey list</a></li>
					<li><a href="stations.php">Station List</a></li>
					<li><a href="stations-single.php">Single station view</a></li>
					<li><a href="filter-journeys.php">Filter Journeys</a></li>
				</ul>
			</div>
		</nav>

		<ul class="sidenav" id="mobile-demo">
			<li class="active"><a href="#">Journey list</a></li>
			<li><a href="stations.php">Station List</a></li>
			<li><a href="stations-single.php">Single station view</a></li>
			<li><a href="filter-journeys.php">Filter Journeys</a></li>
		</ul>
		<div class="row">
			<!-- search for small screens -->
			<div class="col l3 s12 search hide-on-large-only">
				<form">
					<div class="row">
						<div class="input-field col s12">
							<i class="material-icons prefix">search</i>
							<input id="icon_prefix_small" type="number" class="validate">
							<label for="icon_prefix_small">Journey id</label>
						</div>
					</div>
				</form>
				<div class="card" id="card_small">
					<!-- Here comes the ajax result -->
				</div>
			</div>
			<div class="col s12 l6 center offset-l1">
				<h2>Journey list view</h2></br>
				<table class="responsive-table highlight">
					<tr>
						<th>Journey id</th>
						<th>Departure station</th>
						<th>Return station</th>
						<th>Covered Distance</th>
						<th>Duration</th>
					</tr>
					<?php 
						while ($row = $result->fetch_assoc()):
							//Changing covered distance into km
							$distance_km =  $row['covered_distance'] / 1000;
							// format into two decimals
							$km_decimal = number_format($distance_km, 2);

							//Changing seconds into real time
							$duration_min = $row['duration'] ;
							//Calculate seconds
							$secs = $duration_min % 60;
							//Calculate hours
							$hrs = $duration_min / 60;
							//Calculate minutes
							$mins = $hrs % 60;

							$hrs = $hrs / 60;
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
			<div class="col l3 s12 search offset-l1 hide-on-med-and-down">
				<form">
					<div class="row">
						<div class="input-field col s12">
							<i class="material-icons prefix">search</i>
							<input id="icon_prefix" type="number" class="validate">
							<label for="icon_prefix">Journey id</label>
						</div>
					</div>
				</form>
				<div class="card" id="card">
					<!-- Here comes the ajax result -->
					<div class="row">
						<div class="col s12">
							<div class="center" id="loader">
								<img src="loader.svg" alt="Loading">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col l6 s12 center offset-l1">
			<?php if (ceil($total_pages / $num_results_on_page) > 0): ?>
				<ul class="test2">
					<?php if ($page > 1): ?>
					<li class="waves-effect"><a href="index.php?page=<?php echo $page-1 ?>"><i class="material-icons">chevron_left</i></a></li>
					<?php endif; ?>
	
					<?php if ($page > 3): ?>
					<li class="start"><a href="index.php?page=1">1</a></li>
					<li class="dots">...</li>
					<?php endif; ?>
	
					<?php if ($page-2 > 0): ?><li class="page"><a href="index.php?page=<?php echo $page-2 ?>"><?php echo $page-2 ?></a></li><?php endif; ?>
					<?php if ($page-1 > 0): ?><li class="page"><a href="index.php?page=<?php echo $page-1 ?>"><?php echo $page-1 ?></a></li><?php endif; ?>
	
					<li class="currentpage"><a href="index.php?page=<?php echo $page ?>"><?php echo $page ?></a></li>
	
					<?php if ($page+1 < ceil($total_pages / $num_results_on_page)+1): ?><li class="page"><a href="index.php?page=<?php echo $page+1 ?>"><?php echo $page+1 ?></a></li><?php endif; ?>
					<?php if ($page+2 < ceil($total_pages / $num_results_on_page)+1): ?><li class="page"><a href="index.php?page=<?php echo $page+2 ?>"><?php echo $page+2 ?></a></li><?php endif; ?>
	
					<?php if ($page < ceil($total_pages / $num_results_on_page)-2): ?>
					<li class="dots">...</li>
					<li class="end"><a href="index.php?page=<?php echo ceil($total_pages / $num_results_on_page) ?>"><?php echo ceil($total_pages / $num_results_on_page) ?></a></li>
					<?php endif; ?>
	
					<?php if ($page < ceil($total_pages / $num_results_on_page)): ?>
					<li class="waves-effect"><a href="index.php?page=<?php echo $page+1 ?>"><i class="material-icons">chevron_right</i></a></li>
					<?php endif; ?>
				</ul>
				<?php endif; ?>
				<p class="center-align total">Total journeys:<span class="total_num"><?php echo $total_pages;?></span></p>
			</div>
		</div>
		<script type="text/javascript" src="materialize/js/materialize.min.js"></script>
    <script src="journey.js"></script>
	</body>
</html>
<?php
//close query connection
	$stmt->close();
	}
?>