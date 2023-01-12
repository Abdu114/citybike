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
    <title>City Bike || Filtering journeys</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-alpha.4/css/materialize.min.css" rel="stylesheet"/>
    <!--Materialize-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  </head>
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
      .bold-text{
        font-weight: 600;
      }
      .select2 .selection .select2-selection--single, .select2-container--default .select2-search--dropdown .select2-search__field {
          border-width: 0 0 1px 0 !important;
          border-radius: 0 !important;
          height: 2.05rem;
      }

      .select2-container--default .select2-selection--multiple, .select2-container--default.select2-container--focus .select2-selection--multiple {
          border-width: 0 0 1px 0 !important;
          border-radius: 0 !important;
      }

      .select2-results__option {
          color: #26a69a;
          padding: 8px 16px;
          font-size: 16px;
      }

      .select2-container--default .select2-results__option--highlighted[aria-selected] {
          background-color: #eee !important;
          color: #26a69a !important;
      }

      .select2-container--default .select2-results__option[aria-selected=true] {
          background-color: #e1e1e1 !important;
      }

      .select2-dropdown {
          border: none !important;
          box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12);
      }

      .select2-container--default .select2-results__option[role=group] .select2-results__group {
          background-color: #333333;
          color: #fff;
      }

      .select2-container .select2-search--inline .select2-search__field {
          margin-top: 0 !important;
      }

      .select2-container .select2-search--inline .select2-search__field:focus {
          border-bottom: none !important;
          box-shadow: none !important;
      }

      .select2-container .select2-selection--multiple {
          min-height: 2.05rem !important;
      }

      .select2-container--default.select2-container--disabled .select2-selection--single {
          background-color: #ddd !important;
          color: rgba(0,0,0,0.26);
          border-bottom: 1px dotted rgba(0,0,0,0.26);
      }
      .select2-search--dropdown {
        display: block;
        padding: 20px;
      }
      .select2-results__option {
        color: #000;
        padding: 12px 21px;
        font-size: 1.2rem;
      }
      .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background-color: #eee !important;
        color: #000 !important;
      }
      .select-wrapper{
        /*display: none;*/
      }
      #mainTable_filter{
        display: none;
      }
      #mainTable_length{
        display: none;
      }
      .btn, .btn-large{
        background-color: transparent;
        border: 2px solid #000;
        color: #000;
        box-shadow: none;
        height: 54px;
        line-height: 49px;
        font-size: 1rem;
        padding: 0 30px;
        margin-top: 15px;
      }
      .btn:hover, .btn-large:hover{
        background-color: #000;
        color: #fff;
      }
      #error {
        padding: 10px 20px;
        background: #ff00001f;
        margin-top: 20px;
        border-bottom: 2px solid #ff0000db;
      }
      #success {
        padding: 10px 20px;
        margin-bottom: 30px;
        border-bottom: 2px solid #000;
      }
      #empty {
        padding: 10px 20px;
        background: #00000014;;
        margin-top: 30px;
        border-bottom: 2px solid #000;
      }
			@media only screen and (max-width: 992px) {
				nav{
					width: 100%;
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
					<li><a href="stations-single.php">Single station view</a></li>
					<li class="active"><a href="filter-journeys.php">Filter Journeys</a></li>
				</ul>
			</div>
		</nav>

		<ul class="sidenav" id="mobile-demo">
			<li><a href="index.php">Journey list</a></li>
			<li class="active"><a href="stations.php">Station List</a></li>
			<li><a href="stations-single.php">Single station view</a></li>
			<li class="active"><a href="filter-journeys.php">Filter Journeys</a></li>
		</ul>
    <div class="container">
      <section class="section">
        <div class="row">
          <div class="col s12 l12 center ">
            <h2>Filtering journeys</h2>
          </div>
          <div class="col s12 l12">
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
              <div class="row">
                <div class="col l4 s12 offset-l2">
                  <p class="bold-text">Departure Date*</p>
                  <input type="text" class="datepicker" name="depDate" placeholder="Choose Departure Date" required>
                </div>
                <div class="col l4 s12">
                  <p class="bold-text">Return Date*</p>
                  <input type="text" class="datepicker" name="retDate" placeholder="Choose return Date" required>
                </div>
              </div>
              <div class="row">
                <div class="col l4 s12 offset-l2">
                  <p class="bold-text">Departure Station*</p>
                  <select id="selectDep" name="selectDepSt" required>
                    <option value="" disabled selected>Choose departure station</option>
                    <!-- Get departure stations from DB -->
                    <?php
                      include('db.php');
                      $sql_dep = "SELECT stations.id, stations.nimi FROM journeys INNER JOIN stations ON journeys.departure_station_id = stations.id GROUP BY stations.nimi ORDER BY stations.nimi ASC";
                      $res_dep = mysqli_query($db, $sql_dep);
                      $no_dep = 1;
                      while($row_dep = mysqli_fetch_assoc($res_dep)){
                        $station_id_dep = $row_dep["id"];
                        $station_nimi_dep = $row_dep["nimi"];
                        echo '<option value="'.$station_id_dep.'">'.$no_dep++, ". ", $station_nimi_dep.'</option>';
                      }
                    ?>
                  </select>
                </div>
                <div class="col l4 s12">
                  <p class="bold-text">Return Station*</p>
                  <select id="selectRet" name="selectRetSt" required>
                    <option value="" disabled selected>Choose return station</option>
                    <?php
                      $sql_ret = "SELECT stations.id, stations.nimi FROM journeys INNER JOIN stations ON journeys.return_station_id = stations.id GROUP BY stations.nimi ORDER BY stations.nimi ASC";
                      $res_ret = mysqli_query($db, $sql_ret);
                      $no_ret = 1;
                      while($row_ret = mysqli_fetch_assoc($res_ret)){
                        $station_id_ret = $row_ret["id"];
                        $station_nimi_ret = $row_ret["nimi"];
                        echo '<option value="'.$station_id_ret.'">'.$no_ret++, ". ", $station_nimi_ret.'</option>';
                      }
                    ?>
                  </select>
                </div>
              </div>
              <div class="center">
                <button class="btn waves-effect waves-light btn-large" type="submit" name="filter">
                  Filter
                </button>
              </div>
            </form>
          </div>
        </div>
          <!-- Form handling -->
        <?php
          if (isset($_POST['filter'])){
            if(!empty($_POST['depDate']) && !empty($_POST['retDate']) && !empty($_POST['selectDepSt']) && !empty($_POST['selectRetSt'])){
              // get values from form
              // format dates
              $depDate = $_POST['depDate'];
              $depDateformat = date('Y-m-d', strtotime($depDate));
              $retDate = $_POST['retDate'];
              $retDateformat = date('Y-m-d', strtotime($retDate));
              //station values
              $selectDepSt = $_POST['selectDepSt'];
              $selectRetSt = $_POST['selectRetSt'];

              //search query 
              $filtering_sql = "SELECT id, departure_date, return_date, departure_station_name, return_station_name, covered_distance, duration from journeys where (date(departure_date) >= '$depDateformat' AND date(return_date) <= '$retDateformat' AND departure_station_id = $selectDepSt AND return_station_id = $selectRetSt) ORDER BY departure_date ASC";
              $filtering_query = mysqli_query($db, $filtering_sql);
              $filtering_count = mysqli_num_rows($filtering_query);
              if( $filtering_count > 0){
                echo '
                <div class="row">
                <div class="col s12 l3 offset-l9 right-align" id="success">
                  <h6 class="center-align bold-text">Found '.$filtering_count.' journeys</h6>
                </div>
                <div class="col s12">
                  <table id="mainTable" class="responsive-table highlight">
                    <thead>
                      <tr>
                        <th>Journey Id. <i class="material-icons">arrow_drop_down</i></th>
                        <th>Departure Date <i class="material-icons">arrow_drop_down</i></th>
                        <th>Return Date <i class="material-icons">arrow_drop_down</i></th>
                        <th>Departure station <i class="material-icons">arrow_drop_down</i></th>
                        <th>Return station <i class="material-icons">arrow_drop_down</i></th>
                        <th>Covered Distance <i class="material-icons">arrow_drop_down</i></th>
                        <th>Duration <i class="material-icons">arrow_drop_down</i></th>
                      </tr>
                    </thead>
                    <tbody>
                ';
                while($filtering_rows = mysqli_fetch_assoc($filtering_query)){

                  $journey_id =  $filtering_rows['id'];
                  $journey_depDate = $filtering_rows['departure_date'];
                  $journey_depDate_format = date('d.m.Y H:i:s', strtotime($journey_depDate));
                  $journey_retDate = $filtering_rows['return_date'];
                  $journey_retDate_format = date('d.m.Y H:i:s', strtotime($journey_retDate));
                  $journey_depSta = $filtering_rows['departure_station_name'];
                  $journey_retSta = $filtering_rows['return_station_name'];
                  $journey_distance = $filtering_rows['covered_distance'];

                  //Changing covered distance into km
                  $distance_km =  $filtering_rows['covered_distance'] / 1000;
                  // format into two decimals
                  $km_decimal = number_format($distance_km, 2);

                  //Changing seconds into real time
                  $duration_min = $filtering_rows['duration'] ;
                  //Calculate seconds
                  $secs = $duration_min % 60;
                  //Calculate hours
                  $hrs = $duration_min / 60;
                  //Calculate minutes
                  $mins = $hrs % 60;
                  $hrs = $hrs / 60;

                  echo '
                    <tr>
                      <td>'.$journey_id.'</td>
                      <td>'.$journey_depDate_format.'</td>
                      <td>'.$journey_retDate.'</td>
                      <td>'.$journey_depSta.'</td>
                      <td>'.$journey_retSta.'</td>
                      <td>'.$km_decimal.'km</td>';
                      if($hrs >= 1){
                        echo '<td>'.(int)$hrs . "h " . (int)$mins . "m " . (int)$secs . "s".'</td>'; 
                      }
                      //less than one hour
                      else{
                        echo '<td>'.(int)$mins . "m " . (int)$secs . "s".'</td>';
                      }
                    echo '
                    </tr>
                  ';
                }
                echo '
                        </tbody>
                    </table>
                  </div>
                </div>
                ';
              }
              // not found data
              else{
                echo '
                  <div class="row">
                    <div class="col l4 s12 offset-l4" id="empty">
                      <h5 class="center-align">No data found.</h5>
                    </div>
                    </div>
                ';
              }
            }else{
              echo '
                  <div class="row">
                  <div class="col s12 l4 offset-l4" id="error">
                  <h6 class="center-align">The fields can not be empty.</h6>
                  </div>
                  </div>
              ';
            }
          }
          mysqli_close($db);
        ?>
      </section>
    </div>

    <!-- jquery -->
    <!-- jquery with datatable -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <!-- datatable.materializecss.min.js here the css is implemented to the datatable -->
    <script src="stations_datatables.js"></script>
    <!-- select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.datepicker');
        var instances = M.Datepicker.init(elems, {
          // date it adjusted to may 2021. 
          defaultDate: new Date(2021,3,31)
        });
      });
      // searchable select using select2 jQuery
      $('#selectDep').select2({width: "100%"});
      $('#selectRet').select2({width: "100%"});

      //Sidenav
      document.addEventListener('DOMContentLoaded', function() {
          var elems = document.querySelectorAll('.sidenav');
          var instances = M.Sidenav.init(elems, {});
        });
    </script>

  </body>
</html>