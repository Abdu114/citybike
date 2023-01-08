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
    <title>City Bike || Stations List VIew</title>
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
					<li class="active"><a href="stations.php">Station List</a></li>
					<li><a href="stations-single.php">Single station view</a></li>
					<li><a href="filter-journeys.php">Filter Journeys</a></li>
				</ul>
			</div>
		</nav>

		<ul class="sidenav" id="mobile-demo">
			<li><a href="index.php">Journey list</a></li>
			<li class="active"><a href="stations.php">Station List</a></li>
			<li><a href="stations-single.php">Single station view</a></li>
			<li><a href="filter-journeys.php">Filter Journeys</a></li>
		</ul>
    <div class="container">
      <section class="section">
        <div class="row">
          <div class="col s12 l12 center ">
          <h2>Stations list view</h2></br>
            <table id="mainTable" class="responsive-table highlight">
              <thead>
                <tr>
                  <th>No. <i class="material-icons">arrow_drop_down</i></th>
                  <th>Nimi <i class="material-icons">arrow_drop_down</i></th>
                  <th>Osoite <i class="material-icons">arrow_drop_down</i></th>
                  <th>Kapasiteetti <i class="material-icons">arrow_drop_down</i></th>
                </tr>
              </thead>
              <tbody>
                <?php
                  include('db.php');
                  $sql = "SELECT * FROM stations";
                  $res = mysqli_query($db, $sql);
                  $no = 1;
                  while($row = mysqli_fetch_assoc($res)){
                  ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['nimi'] ?></td>
                    <td><?= $row['osoite'] ?></td>
                    <td><?= $row['kapasiteet'] ?></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </section>
    </div>
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <!-- js materializecss -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <!-- jquery with datatable -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <!-- datatable.materializecss.min.js here the css is implemented to the datatable -->
    <script src="stations_datatables.js"></script>

  </body>
</html>