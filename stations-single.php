<?php 
  include('db.php');

  // GEt the first station name to use in the link if there is no station name in the link
  $first_station_sql = "SELECT nimi FROM stations ORDER BY nimi ASC LIMIT 1";
  $first_station_query = mysqli_query($db, $first_station_sql);
  $first_station_fetch = mysqli_fetch_assoc($first_station_query);
  $first_station_res_name = $first_station_fetch['nimi'];
  // if the link is empty get the first station name in DB
  $station_name = isset($_GET['station']) ? $_GET['station'] : $first_station_res_name;

  // station in the link
  $station_link_sql = "SELECT id, nimi, namn, x, y, osoite FROM stations WHERE nimi = '$station_name'";
  $station_link_query = mysqli_query($db, $station_link_sql);

  while($station_link_fetch = mysqli_fetch_assoc($station_link_query)){
    $station_link_res_id = $station_link_fetch['id'];
    $station_link_res_name = $station_link_fetch['nimi'];
    $station_link_res_namn = $station_link_fetch['namn'];
    $station_link_res_osoite = $station_link_fetch['osoite'];
    $station_link_res_x = $station_link_fetch['x'];
    $station_link_res_y = $station_link_fetch['y'];
  }

  // Total journeys started
  $total_journeys_started_sql = "SELECT count(journeys.departure_station_id) as startedjourneys FROM journeys INNER JOIN stations ON journeys.departure_station_id = stations.id WHERE stations.id = '$station_link_res_id'";
  $total_journeys_started_query = mysqli_query($db, $total_journeys_started_sql);
  $total_journeys_started_fetch = mysqli_fetch_assoc($total_journeys_started_query);
  $total_journeys_started_res = $total_journeys_started_fetch['startedjourneys'];
  
  // Total journeys ended
  $total_journeys_ended_sql = "SELECT count(journeys.return_station_id) as endedjourneys FROM journeys INNER JOIN stations ON journeys.return_station_id = stations.id WHERE stations.id = $station_link_res_id";
  $total_journeys_ended_query = mysqli_query($db, $total_journeys_ended_sql);
  $total_journeys_ended_fetch = mysqli_fetch_assoc($total_journeys_ended_query);
  $total_journeys_ended_res = $total_journeys_ended_fetch['endedjourneys'];
  
  // The average distance of a journey starting from the station
  // First we get the sum of the covered distance 
  $AVstarted_sql = "SELECT sum(covered_distance) as AVdistancestarted FROM journeys WHERE departure_station_id = $station_link_res_id";
  $AVstarted_query = mysqli_query($db, $AVstarted_sql);
  $AVstarted_fetch = mysqli_fetch_assoc($AVstarted_query);
  $AVstarted_res = $AVstarted_fetch['AVdistancestarted'];

  //count the journeys departured from this station
  $AVstartedcount_sql = "SELECT count(covered_distance) as countjourneysstarted FROM journeys WHERE departure_station_id = $station_link_res_id";
  $AVstartedcount_query = mysqli_query($db, $AVstartedcount_sql);
  $AVstartedcount_fetch = mysqli_fetch_assoc($AVstartedcount_query);
  $AVstartedcount_res = $AVstartedcount_fetch['countjourneysstarted'];
  //echo $AVstartedcount_res;

  // average formula
  $AVstartedjourneysdone = $AVstarted_res / $AVstartedcount_res;

  // to km
  //Changing covered distance into km
  $AVstarted_distance_km =  $AVstartedjourneysdone / 1000;
  // format into two decimals
  $AVstarted_km_decimal = number_format($AVstarted_distance_km, 2);

  // The average distance of a journeys ended
  // First we get the sum of the covered distance 
  $AVended_sql = "SELECT sum(covered_distance) as AVdistanceended FROM journeys WHERE return_station_id = $station_link_res_id";
  $AVended_query = mysqli_query($db, $AVended_sql);
  $AVended_fetch = mysqli_fetch_assoc($AVended_query);
  $AVended_res = $AVended_fetch['AVdistanceended'];

  //count the journeys departured from this station
  $AVendedcount_sql = "SELECT count(covered_distance) as countjourneysended FROM journeys WHERE return_station_id = $station_link_res_id";
  $AVendedcount_query = mysqli_query($db, $AVendedcount_sql);
  $AVendedcount_fetch = mysqli_fetch_assoc($AVendedcount_query);
  $AVendedcount_res = $AVendedcount_fetch['countjourneysended'];

  // average formula
  $AVendedjourneysdone = $AVended_res / $AVendedcount_res;

  // to km
  //Changing covered distance into km
  $AVended_distance_km =  $AVendedjourneysdone / 1000;
  // format into two decimals
  $AVended_km_decimal = number_format($AVended_distance_km, 2);
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

    <title>City Bike || Stations Single VIew</title>
    <style>
      html {
          font-family: quicksand;
          padding: 20px;
          background-color: #fff;
          color: #222;
      }
      table{
          font-size: 1.2rem;
      }
      .pagination li.active {
          background-color: #222;
      }
      .sorting{
          cursor: pointer;
      }
      .material-icons{
          vertical-align: bottom;
      }
      nav{
				background-color: #000;
				color: #fff;
				width: 90%;
				margin: auto;
			}
			#nav-center {
				display:flex;
				justify-content: center;
			}
			nav ul li.active a, nav ul li.active a:hover{
				background-color: #fff;
				color: #222;
			}
			nav ul li:hover{
				background-color: #ffffff50;
			}
      input[type=text]:not(.browser-default):focus:not([readonly]), input.valid[type=text]:not(.browser-default){
        border-bottom: 1px solid #000;
        box-shadow: 0 1px 0 0 #000;
      }
      input[type=text]:not(.browser-default):focus:not([readonly])+label{
        color: #000;
      }
      .input-field .prefix.active{
        color: #000;
      }
      .collections{
        max-height: 600px;
        overflow: overlay;
      }
      .collection-items{
        border-bottom: 1px solid #000;
        padding: 10px;
        font-size: 1.2rem;
        cursor: pointer;
      }
      .collection-items.active{
        background-color: #000;
        color: #fff;
        transform: scale(1.03);
        transition: 0.3s;
        -ms-transform: scale(1.03);
        -webkit-transform: scale(1.03);
      }
      .collection-items:hover{
        transform: scale(1.03);
        transition: 0.3s;
        -ms-transform: scale(1.03);
        -webkit-transform: scale(1.03);
      }
      a{
        color: #000;
      }
      ::-webkit-scrollbar {
        width: 7px;
        height: 7px;

      }
      
      ::-webkit-scrollbar-track {
        background: transparent;
        margin-block: 0.0em;
      }
      
      ::-webkit-scrollbar-thumb {
        background: hsl(0, 0%, 1%);
        height: 150px;
      }
      
      ::-webkit-scrollbar-thumb:hover {
        background: 	hsl(0, 0%, 25%);
      }
      #map {
        height: 400px; /* The height is 400 pixels */
        width: 100%; /* The width is the width of the web page */
      }
      #right-align{
        float: right;
      }
      #left-col{
        padding-left: 90px;
      }
      .label{
        margin-bottom: -12px;
      }
      .bold-text{
        font-weight: 600;
      }
			@media only screen and (max-width: 992px) {
				nav{
					width: 100%;
			  }
        .collections{
        max-height: 300px;
        overflow: overlay;
      }
			}
    </style>
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
          <div class="input-field col s2" id="right-align">
            <select>
              <option value="" disabled selected>Filter monthly</option>
              <option value="5">May</option>
              <option value="6">June</option>
              <option value="7">July</option>
            </select>
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
          <div class="col s8 offset-l2">
            <div id="map"></div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- js materializecss -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    </script>
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDohh_3rmXgWfj1lv59ll3GT28kKdH7ctk&callback=initMap&v=weekly"
      defer
    >
  </script>
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

    // select element initiation
    document.addEventListener('DOMContentLoaded', function() {
      var elems = document.querySelectorAll('select');
      var instances = M.FormSelect.init(elems, {});
    });
    // search
    const filter = document.querySelector('#icon_prefix');
    filter.addEventListener('keyup', filterTasks);
    // Filter Tasks
    function filterTasks(e) {
      const text = e.target.value.toLowerCase();
      document.querySelectorAll('.collection-items').forEach(
      function(task){
          // liiska qoraalkiisa intuu kasoo helaa
          const item = task.textContent;
          if(item.toLowerCase().indexOf(text) != -1){
              task.parentElement.style.display = 'block';
          }
          else {
          task.parentElement.style.display = 'none';
          }
      });
    }
  </script>
  </body>
</html>