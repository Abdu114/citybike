<?php
//Bring database connention file
  //include('db.php');

  //Adding stations

  //THe amount of lines we fetch from csv file.
  /*$maxLines = 500;
  //Check if csv file exists
  if(($file_handle = fopen("stations.csv", "r")) !== FALSE) {
    //loop the amount data we need 
    for ($i = 0; $i < $maxLines && !feof($file_handle); $i++)
    {
      //Get the data and 1024 characters maximum
      $line_of_text = fgetcsv($file_handle, 1024);
      //insert file data into database
      $insert = "INSERT INTO stations(ID, nimi, namn, name, osoite, adress, kaupunki, stad, operaattor, Kapasiteet, x, y) VALUES ('".$line_of_text[1]."','".$line_of_text[2]."','".$line_of_text[3]."','".$line_of_text[4]."','".$line_of_text[5]."','".$line_of_text[6]."','".$line_of_text[7]."','".$line_of_text[8]."','".$line_of_text[9]."','".$line_of_text[10]."','".$line_of_text[11]."','".$line_of_text[12]."')";
      //Execute inserting to DB
      $insert_query = mysqli_query($db, $insert);
      echo $insert, "</br>";
    }
    fclose($file_handle);
  }*/


  //Adding journeys

  //THe amount of lines we fetch from csv file (remember to change your Maximum execution time in php ini).
  /*$maxLines = 140000;
  //Check if csv file exists
  if(($file_handle = fopen("2021-07.csv", "r")) !== FALSE) {
    //loop the amount data we need 
    for ($i = 0; $i < $maxLines && !feof($file_handle); $i++)
    {
      //Get the data and 1024 characters maximum
      $line_of_text = fgetcsv($file_handle, 1024);

      // remove the T letter in dates
      $departureCorrector = str_replace('T', ' ', $line_of_text[0]);
      $returnCorrector = str_replace('T', ' ', $line_of_text[1]);

      //insert file data into database
      $insert = "INSERT INTO journeys(id, departure_date, return_date, departure_station_id, departure_station_name, return_station_id, return_station_name, covered_distance, duration) VALUES ('','".$departureCorrector."','".$returnCorrector."','".$line_of_text[2]."','".$line_of_text[3]."','".$line_of_text[4]."','".$line_of_text[5]."','".$line_of_text[6]."','".$line_of_text[7]."')";

      //Execute inserting to DB
      $insert_query = mysqli_query($db, $insert);
      //echo $insert, "</br>";
    }
    fclose($file_handle);
  }*/
?>