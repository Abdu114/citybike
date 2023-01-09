<?php 

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