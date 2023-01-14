<?php
  include('db.php');
  $month = $_GET['month'];
  $id = $_GET['id'];
  
  // Total journeys started monthly
  $total_journeys_started_monthly_sql = "SELECT count(journeys.departure_station_id) as startedjourneysM FROM journeys INNER JOIN stations ON journeys.departure_station_id = stations.id WHERE stations.id = $id AND MONTHNAME(journeys.departure_date) = '$month'";
  //echo $total_journeys_started_sql;
  $total_journeys_started_monthly_query = mysqli_query($db, $total_journeys_started_monthly_sql);
  $total_journeys_started_monthly_fetch = mysqli_fetch_assoc($total_journeys_started_monthly_query);
  $total_journeys_started_monthly_res = $total_journeys_started_monthly_fetch['startedjourneysM'];

  // Total journeys ended monthly
  $total_journeys_ended_monthly_sql = "SELECT count(journeys.return_station_id) as endedjourneysM FROM journeys INNER JOIN stations ON journeys.return_station_id = stations.id WHERE stations.id = $id AND MONTHNAME(journeys.return_date) = '$month'";
  //echo $total_journeys_ended_sql;
  $total_journeys_ended_monthly_query = mysqli_query($db, $total_journeys_ended_monthly_sql);
  $total_journeys_ended_monthly_fetch = mysqli_fetch_assoc($total_journeys_ended_monthly_query);
  $total_journeys_ended_monthly_res = $total_journeys_ended_monthly_fetch['endedjourneysM'];

  // The average distance of a journey starting from the station (Monthly)
  // First we get the sum of the covered distance 
  $AVstarted_monthly_sql = "SELECT sum(covered_distance) as AVdistancestartedM FROM journeys WHERE departure_station_id = $id AND MONTHNAME(journeys.departure_date) = '$month'";
  $AVstarted_monthly_query = mysqli_query($db, $AVstarted_monthly_sql);
  $AVstarted_monthly_fetch = mysqli_fetch_assoc($AVstarted_monthly_query);
  $AVstarted_monthly_res = $AVstarted_monthly_fetch['AVdistancestartedM'];

  //count the journeys departured from this station
  $AVstartedcount_monthly_sql = "SELECT count(covered_distance) as countjourneysstartedM FROM journeys WHERE departure_station_id = $id AND MONTHNAME(journeys.departure_date) = '$month'";
  $AVstartedcount_monthly_query = mysqli_query($db, $AVstartedcount_monthly_sql);
  $AVstartedcount_monthly_fetch = mysqli_fetch_assoc($AVstartedcount_monthly_query);
  $AVstartedcount_monthly_res = $AVstartedcount_monthly_fetch['countjourneysstartedM'];
  //echo $AVstartedcount_res;

  // average formula
  if($AVstartedcount_monthly_res > 0){
    $AVstartedjourneysMdone = $AVstarted_monthly_res / $AVstartedcount_monthly_res;
    // to km
    //Changing covered distance into km
    $AVstarted_monthly_distance_km =  $AVstartedjourneysMdone / 1000;
    // format into two decimals
    $AVstarted_monthly_km_decimal = number_format($AVstarted_monthly_distance_km, 2);
  }else{
    $AVstarted_monthly_km_decimal = number_format(0, 2);
  }

  // The average distance of a journeys ended (monthly)
  // First we get the sum of the covered distance 
  $AVended_monthly_sql = "SELECT sum(covered_distance) as AVdistanceendedM FROM journeys WHERE return_station_id = $id AND MONTHNAME(journeys.return_date) = '$month'";
  $AVended_monthly_query = mysqli_query($db, $AVended_monthly_sql);
  $AVended_monthly_fetch = mysqli_fetch_assoc($AVended_monthly_query);
  $AVended_monthly_res = $AVended_monthly_fetch['AVdistanceendedM'];

  //count the journeys departured from this station
  $AVended_monthly_count_sql = "SELECT count(covered_distance) as countjourneysendedM FROM journeys WHERE return_station_id = $id AND MONTHNAME(journeys.return_date) = '$month'";
  $AVended_monthly_count_query = mysqli_query($db, $AVended_monthly_count_sql);
  $AVended_monthly_count_fetch = mysqli_fetch_assoc($AVended_monthly_count_query);
  $AVended_monthly_count_res = $AVended_monthly_count_fetch['countjourneysendedM'];

  // average formula
  if($AVended_monthly_count_res > 0){
    $AVendedjourneysdone_monthly = $AVended_monthly_res / $AVended_monthly_count_res;
  
    // to km
    //Changing covered distance into km
    $AVended_monthly_distance_km =  $AVendedjourneysdone_monthly / 1000;
    // format into two decimals
    $AVended_monthly_km_decimal = number_format($AVended_monthly_distance_km, 2);
  }else{
    $AVended_monthly_km_decimal = number_format(0, 2);
  }
  
  echo ' 
  <div class="row">
  <div class="col s5 offset-s1" id ="left-col">
    <p class="label">Total journeys started</p>
    <h5 class="bold-text">'.$total_journeys_started_monthly_res.'</h5>
  </div>
  <div class="col s5" id ="right-col">
    <p class="label">Total journeys ended</p>
    <h5 class="bold-text">'.$total_journeys_ended_monthly_res.'</h5>
  </div>
</div>

<div class="row">
  <div class="col s5 offset-s1" id ="left-col">
    <p class="label">Average distance of started journeys</p>
    <h5 class="bold-text">'.$AVstarted_monthly_km_decimal.'km</h5>
  </div>
  <div class="col s5" id ="right-col">
    <p class="label">Average distance of ended journey</p>
    <h5 class="bold-text">'.$AVended_monthly_km_decimal.'km</h5>
  </div>
</div>';
?>