<!DOCTYPE html>
<html lang="en">
<head>
  <!--Import Google Icon Font-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="materialize/css/materialize.min.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Test</title>
</head>
<body>
  <div class="row">
    <div class="col s12 center">
      <h1>Converting data</h1>
      <table>
        <thead>
          <tr>
              <th>No.</th>
              <th>Departure</th>
              <th>Return</th>
              <th>Departure station id</th>
              <th>Departure station name</th>
              <th>Return station id</th>
              <th>Return station name</th>
              <th>Covered distance (m)</th>
              <th>Duration (sec.)</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $co = 1;
            $maxLines = 10;
            if(($file_handle = fopen("2021-07.csv", "r")) !== FALSE) {
              for ($i = 0; $i < $maxLines && !feof($file_handle); $i++)
              {
                $line_of_text = fgetcsv($file_handle, 1024, ",");
                echo "<tr>";
                echo "<td>".$co++.".</td>";
                echo "<td>$line_of_text[0]</td>";
                echo "<td>$line_of_text[1]</td>";
                echo "<td>$line_of_text[2]</td>";
                echo "<td>$line_of_text[3]</td>";
                echo "<td>$line_of_text[4]</td>";
                echo "<td>$line_of_text[5]</td>";
                echo "<td>$line_of_text[6]</td>";
                echo "<td>$line_of_text[7]</td>";
                //echo $data[0] . "<br />\n";
                echo "</tr>";
              }
              fclose($file_handle);
            }
          ?>
        </tbody>
      </table>

      <!-- Stations -->
      <h1>Stations data</h1>
      <table>
        <thead>
          <tr>
              <th>No.</th>
              <th>FID</th>
              <th>ID</th>
              <th>Nimi</th>
              <th>Namn</th>
              <th>Name</th>
              <th>Osoite</th>
              <th>Adress</th>
              <th>Kaupunki</th>
              <th>Stad</th>
              <th>Operaattor</th>
              <th>Kapasiteet</th>
              <th>x</th>
              <th>y</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $row = 1;
            $co = 1;
            $maxLines = 5;
            if(($file_handle = fopen("stations.csv", "r")) !== FALSE) {
              for ($i = 0; $i < $maxLines && !feof($file_handle); $i++)
              {
                $line_of_text = fgetcsv($file_handle, 1024);
                echo "<tr>";
                echo "<td>".$co++.".</td>";
                echo "<td>$line_of_text[0]</td>";
                echo "<td>$line_of_text[1]</td>";
                echo "<td>$line_of_text[2]</td>";
                echo "<td>$line_of_text[3]</td>";
                echo "<td>$line_of_text[4]</td>";
                echo "<td>$line_of_text[5]</td>";
                echo "<td>$line_of_text[6]</td>";
                echo "<td>$line_of_text[7]</td>";
                echo "<td>$line_of_text[8]</td>";
                echo "<td>$line_of_text[9]</td>";
                echo "<td>$line_of_text[10]</td>";
                echo "<td>$line_of_text[11]</td>";
                echo "<td>$line_of_text[12]</td>";
                //echo $data[0] . "<br />\n";
                echo "</tr>";
              }
              fclose($file_handle);
            }
          ?>
        </tbody>
      </table>
    </div>
  </div>

<script type="text/javascript" src="materialize/js/materialize.min.js"></script>
</body>
</html>