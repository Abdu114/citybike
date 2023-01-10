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
        height: 400px; 
        width: 100%;
        margin-top: 30px;
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
            <select id="select">
              <!--<option value="" disabled selected>Filter monthly</option>-->
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
          <div class="col s8 offset-l2">
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