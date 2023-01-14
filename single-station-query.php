<?php 

  // GEt the first station name to use in the link if there is no station name in the link
  $first_station_sql = "SELECT nimi FROM stations ORDER BY nimi ASC LIMIT 1";
  $first_station_query = mysqli_query($db, $first_station_sql);
  $first_station_fetch = mysqli_fetch_assoc($first_station_query);
  $first_station_res_name = $first_station_fetch['nimi'];
  // remove special charecters form link endpoint
  if(!empty($_GET['station'])){
    $link_replace = str_replace('\'', "", $_GET['station']);
  }else{
  }
  // if the link is empty get the first station name in DB
  $station_name = isset($link_replace) && is_string($link_replace) ? $link_replace : $first_station_res_name;

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
  $total_journeys_started_sql = "SELECT count(journeys.departure_station_id) as startedjourneys FROM journeys INNER JOIN stations ON journeys.departure_station_id = stations.id WHERE stations.id = $station_link_res_id";
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
  if($AVstartedcount_res > 0){
    $AVstartedjourneysdone = $AVstarted_res / $AVstartedcount_res;
  }
  else{
    $AVstartedjourneysdone = 0;
  }

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
  if($AVendedcount_res > 0){
    $AVendedjourneysdone = $AVended_res / $AVendedcount_res;
  
    // to km
    //Changing covered distance into km
    $AVended_distance_km =  $AVendedjourneysdone / 1000;
    // format into two decimals
    $AVended_km_decimal = number_format($AVended_distance_km, 2);
  }
  else{
    $AVended_km_decimal = number_format(0, 2);
  }

  //Monthly

  // Total journeys started monthly
  $total_journeys_started_monthly_sql = "SELECT count(journeys.departure_station_id) as startedjourneysM FROM journeys INNER JOIN stations ON journeys.departure_station_id = stations.id WHERE stations.id = $station_link_res_id AND MONTHNAME(journeys.departure_date) = 'May'";
  //echo $total_journeys_started_sql;
  $total_journeys_started_monthly_query = mysqli_query($db, $total_journeys_started_monthly_sql);
  $total_journeys_started_monthly_fetch = mysqli_fetch_assoc($total_journeys_started_monthly_query);
  $total_journeys_started_monthly_res = $total_journeys_started_monthly_fetch['startedjourneysM'];

  // Total journeys ended monthly
  $total_journeys_ended_monthly_sql = "SELECT count(journeys.return_station_id) as endedjourneysM FROM journeys INNER JOIN stations ON journeys.return_station_id = stations.id WHERE stations.id = $station_link_res_id AND MONTHNAME(journeys.return_date) = 'May'";
  //echo $total_journeys_ended_sql;
  $total_journeys_ended_monthly_query = mysqli_query($db, $total_journeys_ended_monthly_sql);
  $total_journeys_ended_monthly_fetch = mysqli_fetch_assoc($total_journeys_ended_monthly_query);
  $total_journeys_ended_monthly_res = $total_journeys_ended_monthly_fetch['endedjourneysM'];

  // The average distance of a journey starting from the station (Monthly)
  // First we get the sum of the covered distance 
  $AVstarted_monthly_sql = "SELECT sum(covered_distance) as AVdistancestartedM FROM journeys WHERE departure_station_id = $station_link_res_id AND MONTHNAME(journeys.departure_date) = 'May'";
  $AVstarted_monthly_query = mysqli_query($db, $AVstarted_monthly_sql);
  $AVstarted_monthly_fetch = mysqli_fetch_assoc($AVstarted_monthly_query);
  $AVstarted_monthly_res = $AVstarted_monthly_fetch['AVdistancestartedM'];

  //count the journeys departured from this station
  $AVstartedcount_monthly_sql = "SELECT count(covered_distance) as countjourneysstartedM FROM journeys WHERE departure_station_id = $station_link_res_id AND MONTHNAME(journeys.departure_date) = 'May'";
  $AVstartedcount_monthly_query = mysqli_query($db, $AVstartedcount_monthly_sql);
  $AVstartedcount_monthly_fetch = mysqli_fetch_assoc($AVstartedcount_monthly_query);
  $AVstartedcount_monthly_res = $AVstartedcount_monthly_fetch['countjourneysstartedM'];

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
  $AVended_monthly_sql = "SELECT sum(covered_distance) as AVdistanceendedM FROM journeys WHERE return_station_id = $station_link_res_id AND MONTHNAME(journeys.return_date) = 'May'";
  $AVended_monthly_query = mysqli_query($db, $AVended_monthly_sql);
  $AVended_monthly_fetch = mysqli_fetch_assoc($AVended_monthly_query);
  $AVended_monthly_res = $AVended_monthly_fetch['AVdistanceendedM'];

  //count the journeys departured from this station
  $AVended_monthly_count_sql = "SELECT count(covered_distance) as countjourneysendedM FROM journeys WHERE return_station_id = $station_link_res_id AND MONTHNAME(journeys.return_date) = 'May'";
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

  // get the last row id
  $last_row_id_sql = "SELECT id FROM stations ORDER BY id DESC LIMIT 1";
  $last_row_id_query = mysqli_query($db, $last_row_id_sql);
  $last_row_id_fetch = mysqli_fetch_assoc($last_row_id_query);
  $last_row_id_res = $last_row_id_fetch['id'];
?>