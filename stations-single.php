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
                    '.$no++, ". ", ucfirst($station_nimi).'</li></a>
                    ';
                  }
                  // if the station name is same as the first station name in the DB
                  else if($station_nimi == $first_station_res_name && !isset($_GET['station'])){
                    echo '
                    <a href="stations-single.php?station='.$station_nimi.'"><li class="collection-items active  ">
                    '.$no++, ". ", ucfirst($station_nimi).'</li></a>
                    ';
                  }
                  else{
                    echo '
                    <a href="stations-single.php?station='.$station_nimi.'"><li class="collection-items">
                    '.$no++, ". ", ucfirst($station_nimi).'</li></a>
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
          <?php
            if(isset($_POST['create'])){
              //check if inputs aren't empty
              if(!empty($_POST['nimi']) && !empty($_POST['namn']) && !empty($_POST['name']) && !empty($_POST['osoite']) && !empty($_POST['adress']) && !empty($_POST['kaupunki']) && !empty($_POST['stad']) && !empty($_POST['operaattori']) && !empty($_POST['kapasiteetti']) && !empty($_POST['latitude']) && !empty($_POST['longitude']) && !empty($_POST['lastid'])){
                $nimi = $_POST['nimi'];
                $namn = $_POST['namn'];
                $name = $_POST['name'];
                $osoite = $_POST['osoite'];
                $adress = $_POST['adress'];
                $kaupunki = $_POST['kaupunki'];
                $stad = $_POST['stad'];
                $operaattori = $_POST['operaattori'];
                $kapasiteetti = $_POST['kapasiteetti'];
                $x = $_POST['latitude'];
                $y = $_POST['longitude'];
                $lastid = $_POST['lastid'];
                $lastid_done = $lastid + 1;
                $insert_sql = "INSERT INTO stations(id, nimi, namn, name, osoite, adress, kaupunki, stad, operaattor, kapasiteet, x, y) VALUES ($lastid_done,'".$nimi."','".$namn."','".$name."','".$osoite."','".$adress."','".$kaupunki."','".$stad."','".$operaattori."','.$kapasiteetti.','".$y."','".$x."')";
                if(mysqli_query($db, $insert_sql)){
                  echo '
                  <div class="col l4 s12 offset-l4" id="success">
                    <h6 class="center-align">Created succesfully.</h6>
                  </div>
                  ';
                }else{
                  echo '
                  <div class="col l4 s12 offset-l4" id="error">
                    <h6 class="center-align">There is an error.</h6>
                  </div> 
                ';
                }
              }else{
                echo '
                <div class="col l4 s12 offset-l4" id="error">
                  <h6 class="center-align">Please fill all the fields.</h6>
                </div> 
                ';
              }
            }else{}
          ?>
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
            <h5 class="bold-text"><?php echo ucfirst($station_link_res_name); ?></h5>
            <h5><?php echo ucfirst($station_link_res_namn) ?></h5>

          </div>
          <div class="col s5" id ="right-col">
            <p class="label">Address</p>
            <h5 class="bold-text"><?php echo ucfirst($station_link_res_osoite);?></h5>
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
        <div class="fixed-action-btn">
        <a class="btn-floating btn-large black modal-trigger" href="#modal1">
          <i class="large material-icons">add</i>
        </a>
      </div>

      <div id="modal1" class="modal">
        <div class="modal-content">
          <h4 class="center-align">Create a new bicycle station</h4>
          <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="row">
              <div class="col l4 s12">
                <p class="bold-text" id="input-label">Nimi</p>
                <input type="text" name="nimi" placeholder="Nimi*">
              </div>
              <div class="col l4 s12">
                <p class="bold-text" id="input-label">Namn</p>
                <input type="text" name="namn" placeholder="Namn*">
              </div>
              <div class="col l4 s12">
                <p class="bold-text" id="input-label">Name</p>
                <input type="text" name="name" placeholder="Name*">
              </div>
            </div>
            <div class="row">
              <div class="col l6 s12">
                <p class="bold-text" id="input-label">Osoite</p>
                <input type="text" name="osoite" placeholder="Osoite*">
              </div>
              <div class="col l6 s12">
                <p class="bold-text" id="input-label">Adress</p>
                <input type="text" name="adress" placeholder="Adress*">
              </div>
            </div>
            <div class="row">
              <div class="col l6 s12">
                <p class="bold-text" id="input-label">Kaupunki</p>
                <input type="text" name="kaupunki" placeholder="Kaupunki*">
              </div>
              <div class="col l6 s12">
                <p class="bold-text" id="input-label">Stad</p>
                <input type="text" name="stad" placeholder="Stad*">
              </div>
            </div>
            <div class="row">
              <div class="col l6 s12">
                <p class="bold-text" id="input-label">Operaattori*</p>
                <input type="text" name="operaattori" placeholder="Operaattori">
              </div>
              <div class="col l6 s12">
                <p class="bold-text" id="input-label">Kapasiteetti</p>
                <input type="number" name="kapasiteetti" placeholder="Kapasiteetti*">
              </div>
            </div>
            <div class="row">
              <div class="col l10 s12 offset-l1">
                <div id="mapNew"></div>
              </div>
            </div>
            <input type="hidden" id="latitudeID" name="latitude">
            <input type="hidden" id="longitudeID" name="longitude">
        </div>
          <div class="modal-footer">
            <h6 class="center-align red-text" id="chooseMap">*Please choose a place from the map</h6>
            <div class="center">
              <button class="btn waves-effect waves-light btn-large" id="submitBtn" type="submit" name="create">
                Create
              </button>
            </div>
          </div>
          <input type="hidden" name="lastid" value="<?php echo $last_row_id_res ?>">
        </form>
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
      const latitudeID = document.getElementById('latitudeID');
      const longitudeID = document.getElementById('longitudeID');
      const chooseMap = document.getElementById('chooseMap');

      const submitBtn = document.getElementById('submitBtn').addEventListener('click', submitPrevent);
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

        /*Map for the new station form*/
        const uluruNew = {
          /*Helsinki railway station*/
          lat: 60.17104889537247,
          lng: 24.941539764404297
        };
        const mapNew = new google.maps.Map(document.getElementById("mapNew"), {
          zoom: 15,
          center: uluruNew,
        });

        const markerNew = new google.maps.Marker({
          position: uluruNew,
          map: mapNew,
        });
        // Configure the click listener.
        mapNew.addListener("click", (mapsMouseEvent) => {
          placeMarkerAndPanTo(mapsMouseEvent.latLng, mapNew);

          function placeMarkerAndPanTo(latLng, mapNew) {
            if (markerNew) {
              // remove the previous marker
              markerNew.setMap(null);
              // change the marker into the clicked position
              markerNew.setPosition(latLng);
              markerNew.setMap(mapNew);
              //center the map with the latLng
              mapNew.panTo(latLng);

              // hidden inputs to get the lat, lng.. 
              latitudeID.value = mapsMouseEvent.latLng.lat();
              longitudeID.value = mapsMouseEvent.latLng.lng();
            }
          }
        });

      }
      window.initMap = initMap;

      //don't submit if it not choosed a place from the map
      function submitPrevent(e) {
        if (latitudeID.value === '' && longitudeID.value === '') {
          console.log('prevented');
          chooseMap.style.display = 'block';
          e.preventDefault();
        } else {
        }
      }
    </script>
  </body>
</html>