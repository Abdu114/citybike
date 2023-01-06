<?php
  include('db.php');
  // get the typed value from ajax
  $journey = $_REQUEST['j'];
  $select_sql = "SELECT departure_station_name, return_station_name, covered_distance, duration  FROM journeys WHERE id = '$journey'";
  $select_query = mysqli_query($db, $select_sql);
  if(mysqli_num_rows($select_query) > 0){
    while($select_rows = mysqli_fetch_assoc($select_query)){
      echo '
      <div class="card-content">
        <div class="row" id="row_journey">
          <div class="col s12 center">Journey id<br>
            <span id="bold_text">'.$journey.'</span>
          </div>
        </div>
        <div class="row" id="row">
          <div class="col s6" id="col-right">Departure station<br>
            <span id="bold_text">'.$select_rows['departure_station_name'].'</span>
          </div>
          <div class="col s6">Return station<br>
            <span id="bold_text">'.$select_rows['return_station_name'].'</span>
          </div>
        </div>';

        //Changing covered distance into km
        $distance_km =  $select_rows['covered_distance'] / 1000;
        // format into two decimals
        $km_decimal = number_format($distance_km, 2);

        //Changing seconds into real time
        $duration_min = $select_rows['duration'] ;
        //Calculate seconds
        $secs = $duration_min % 60;
        //Calculate hours
        $hrs = $duration_min / 60;
        //Calculate minutes
        $mins = $hrs % 60;

        $hrs = $hrs / 60;
        
        echo '
        <div class="row" id="row">
          <div class="col s6" id="col-right">Covered Distance<br>
            <span id="bold_text">'.$km_decimal, "km".'</span>
          </div>';

          if($hrs >= 1){
            echo '
            <div class="col s6">Duration<br>
              <span id="bold_text">'.(int)$hrs . "h " . (int)$mins . "m " . (int)$secs . "s".'</span>
            </div>';
          }
          //less than one hour
          else{
            echo '
            <div class="col s6">Duration<br>
              <span id="bold_text">'.(int)$mins . "m " . (int)$secs . "s".'</span>
            </div>';
          }
          echo '
        </div>
      </div>';
    }
  }
  // no data found
  else{
    echo '
      <div class="card-content">
      <div class="row" id="row_journey">
        <div class="col s12 center">No Data Found
        </div>
      </div>
    </div>';
  }
?>