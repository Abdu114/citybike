<?php 
  include('db.php');
  include('single-station-query.php'); 
?>
<!DOCTYPE html>
<html>
  <head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!--font-->
		<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <!-- External CSS file-->
    <link rel="stylesheet" href="station-single.css">
    <title>City Bike || Stations Single VIew</title>
  </head>
  <body>
    <nav>
			<a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
			<div class="nav-wrapper">
				<ul class="hide-on-med-and-down" id="nav-center">
					<li><a href="index.php">Journey list</a></li>
					<li><a href="stations.php">Station List</a></li>
					<li class="active"><a href="stations-single.php">Single station view</a></li>
					<li><a href="filter-journeys.php">Filter Journeys</a></li>
				</ul>
			</div>
		</nav>
		<ul class="sidenav" id="mobile-demo">
			<li><a href="index.php">Journey list</a></li>
			<li><a href="stations.php">Station List</a></li>
			<li class="active"><a href="stations-single.php">Single station view</a></li>
			<li><a href="filter-journeys.php">Filter Journeys</a></li>
		</ul>

    <div class="row">
      <!-- List box -->
      <div class="col l3 s12 offset-l1" id="list-box">
        <div class="row">
          <div class="col s12">
            <div class="row">
              <div class="input-field col s12">
                <i class="material-icons prefix">search</i>
                <input id="icon_prefix" type="text" class="validate">
                <label for="icon_prefix">Station name</label>
              </div>
            </div>
            <ul class="collections">
              <?php
                $sql = "SELECT nimi, osoite FROM stations ORDER BY nimi ASC";
                $res = mysqli_query($db, $sql);
                $no = 1;
                while($row = mysqli_fetch_assoc($res)){
                  $station_nimi = $row["nimi"];
                  // if the station name is same as the one in the link
                  if($station_nimi == $station_link_res_name){
                    echo '
                    <a href="stations-single.php?station='.$station_nimi.'"><li class="collection-items active  ">
                    '.$no++, ". ", $station_nimi.'</li></a>
                    ';
                  }
                  // if the station name is same as the first station name in the DB
                  else if($station_nimi == $first_station_res_name && !isset($_GET['station'])){
                    echo '
                    <a href="stations-single.php?station='.$station_nimi.'"><li class="collection-items active  ">
                    '.$no++, ". ", $station_nimi.'</li></a>
                    ';
                  }
                  else{
                    echo '
                    <a href="stations-single.php?station='.$station_nimi.'"><li class="collection-items">
                    '.$no++, ". ", $station_nimi.'</li></a>
                    ';
                  }
                }
              ?>
            </ul>
          </div>
        </div>
      </div>
      <!-- Data box -->
      <div class="col l7 s12 " id="data-box">
        <div class="row">
          <div class="input-field col l2 s6" id="right-align">
            <p class="bold-text">Filter by monthly</p>
            <select id="select">
              <option value="May">May</option>
              <option value="June">June</option>
              <option value="July">July</option>
            </select>
            <input type="hidden" name="id" id="id" value=<?php echo $station_link_res_id?>>
          </div>
        </div>
        <div class="row" id="name-row">
          <div class="col s5 offset-s1" id ="left-col">
            <p class="label">Nimi</p>
            <h5 class="bold-text"><?php echo $station_link_res_name?></h5>
            <h5><?php echo $station_link_res_namn?></h5>

          </div>
          <div class="col s5" id ="right-col">
            <p class="label">Address</p>
            <h5 class="bold-text"><?php echo $station_link_res_osoite?></h5>
          </div>
        </div>
        <div class="row">
          <div class="col s5 offset-s1" id ="left-col">
            <p class="label">Total journeys started</p>
            <h5 class="bold-text"><?php echo $total_journeys_started_res?></h5>
          </div>
          <div class="col s5" id ="right-col">
            <p class="label">Total journeys ended</p>
            <h5 class="bold-text"><?php echo $total_journeys_ended_res?></h5>
          </div>
        </div>

        <div class="row">
          <div class="col s5 offset-s1" id ="left-col">
            <p class="label">Average distance of started journeys</p>
            <h5 class="bold-text"><?php echo $AVstarted_km_decimal, "km"?></h5>
          </div>
          <div class="col s5" id ="right-col">
            <p class="label">Average distance of ended journey</p>
            <h5 class="bold-text"><?php echo $AVended_km_decimal, "km"?></h5>
          </div>
        </div>

        <div class="row">
          <div class="col s12" id="monthly">
            <h5 class="center-align bold-text" id="monthly-id">Monthly ( May )</h5>
          </div>
        </div>
        <div class="row">
          <div class="col s12">
            <div class="center" id="loader">
              <img src="loader.svg" alt="Loading">
            </div>
          </div>
        </div>
        <div id="result">
          <div class="row">
            <div class="col s5 offset-s1" id ="left-col">
              <p class="label">Total journeys started</p>
              <h5 class="bold-text"><?php echo $total_journeys_started_monthly_res?></h5>
            </div>
            <div class="col s5" id ="right-col">
              <p class="label">Total journeys ended</p>
              <h5 class="bold-text"><?php echo $total_journeys_ended_monthly_res?></h5>
            </div>
          </div>

          <div class="row">
            <div class="col s5 offset-s1" id ="left-col">
              <p class="label">Average distance of started journeys</p>
              <h5 class="bold-text"><?php echo $AVstarted_monthly_km_decimal, "km"?></h5>
            </div>
            <div class="col s5" id ="right-col">
              <p class="label">Average distance of ended journey</p>
              <h5 class="bold-text"><?php echo $AVended_monthly_km_decimal, "km"?></h5>
            </div>
          </div>

        </div>

        <div class="row">
          <div class="col l8 s12 offset-l2">
            <div id="map"></div>
          </div>
        </div>

      </div>
    </div>
    
    <!-- js materializecss -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    </script>
    <!--Google map Js-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDohh_3rmXgWfj1lv59ll3GT28kKdH7ctk&callback=initMap&v=weekly"defer></script>
    <script src="stations-single.js"></script>
    <script>
      function initMap() {
        const uluru = { lat: <?php echo $station_link_res_y?>, lng: <?php echo $station_link_res_x?> };
        const map = new google.maps.Map(document.getElementById("map"), {
          zoom: 15 ,
          center: uluru,
        });
        const marker = new google.maps.Marker({
          position: uluru,
          map: map,
        });
      }
      window.initMap = initMap;
    </script>
  </body>
</html>