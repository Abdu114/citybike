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
      .btn, .btn-large{
        background-color: transparent;
        border: 2px solid #000;
        color: #000;
        box-shadow: none;
      }
      .btn:hover, .btn-large:hover{
        background-color: #000;
        color: #fff;
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
                  <input type="text" class="datepicker" name="depDate" placeholder="Choose Departure Date">
                </div>
                <div class="col l4 s12">
                  <p class="bold-text">Return Date*</p>
                  <input type="text" class="datepicker" name="retDate" placeholder="Choose return Date">
                </div>
              </div>
              <div class="row">
                <div class="col l4 s12 offset-l2">
                  <p class="bold-text">Departure Station*</p>
                  <select id="selectDep" name="Retselect">
                    <option value="" disabled selected>Choose deperture station</option>
                    <option value="291">99. Itäkeskus Metrovarikko</option>
                    <option value="51">100. Itälahdenkatu</option>
                    <option value="30">101. Itämerentori</option>
                    <option value="639">102. Itäportti</option>
                    <option value="338">103. Jakomäentie</option>
                    <option value="340">104. Jakomäki</option>
                    <option value="85">105. Jalavatie</option>
                    <option value="80">106. Jäähalli</option>
                  </select>
                </div>
                <div class="col l4 s12">
                  <p class="bold-text">Return Station*</p>
                  <select id="selectRet" name="selectRet">
                    <option value="" disabled selected>Choose return station</option>
                    <option value="291">99. Itäkeskus Metrovarikko</option>
                    <option value="51">100. Itälahdenkatu</option>
                    <option value="30">101. Itämerentori</option>
                    <option value="639">102. Itäportti</option>
                    <option value="338">103. Jakomäentie</option>
                    <option value="340">104. Jakomäki</option>
                    <option value="85">105. Jalavatie</option>
                    <option value="80">106. Jäähalli</option>
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
      </section>
    </div>
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <!-- js materializecss -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <!-- jquery with datatable -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <!-- datatable.materializecss.min.js here the css is implemented to the datatable -->
    <!--<script src="stations_datatables.js"></script>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-alpha.4/js/materialize.min.js"></script>

    <script>
      document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.datepicker');
        var currYear = (new Date()).getFullYear();

        var instances = M.Datepicker.init(elems, {
          // date it adjusted to may 2021. 
          defaultDate: new Date(2021,3,31),
        });
      });
      // searchable select using select2 (jQuery framework)
      $('select').select2({width: "100%"});

      // Datatables
      $(document).ready(function () {
        $('#mainTable').DataTable();
        $('select').formSelect();
      });
      //Sidenav
      document.addEventListener('DOMContentLoaded', function() {
          var elems = document.querySelectorAll('.sidenav');
          var instances = M.Sidenav.init(elems, {});
        });
    </script>

  </body>
</html>