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

    <title>City Bike || Stations Single VIew</title>
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
      input[type=text]:not(.browser-default):focus:not([readonly]), input.valid[type=text]:not(.browser-default){
        border-bottom: 1px solid #000;
        box-shadow: 0 1px 0 0 #000;
      }
      input[type=text]:not(.browser-default):focus:not([readonly])+label{
        color: #000;
      }
      .input-field .prefix.active{
        color: #000;
      }
      .collection-items{
        border-bottom: 1px solid #000;
        padding: 10px;
        font-size: 1.2rem;
        /*margin-bottom: 3px;*/
        cursor: pointer;
      }
      .collection-items.active{
        background-color: #000;
        color: #fff;
        transform: scale(1.03);
        transition: 0.5s;
        -ms-transform: scale(1.03);
        -webkit-transform: scale(1.03);
      }
      .collection-items:hover{
        transform: scale(1.03);
        transition: 0.5s;
        -ms-transform: scale(1.03);
        -webkit-transform: scale(1.03);

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
          <div class="col 12">
            <div class="row">
              <div class="input-field col s12">
                <i class="material-icons prefix">search</i>
                <input id="icon_prefix_small" type="text" class="validate">
                <label for="icon_prefix_small">Station name</label>
              </div>
            </div>
            <ul class="collections">
              <li class="collection-items">1. Pasilan asema</li>
              <li class="collection-items">2. Kauppakorkeakoulu</li>
              <li class="collection-items">3. Suomenlahdentie</li>
              <li class="collection-items">4. Armas Launiksen katu</li>
              <li class="collection-items">5. Leppävaaran urheilupuisto</li>
              <li class="collection-items">6. Vanha kirkkopuisto</li>
              <li class="collection-items">7. Eteläinen Hesperiankatu</li>
              <li class="collection-items">8. Lauttasaaren ostoskeskus</li>
              <li class="collection-items">9. Mäkkylän asema</li>
              <li class="collection-items">10. Kapteeninpuistikko</li>
              <li class="collection-items">11. Hämeenlinnanväylä</li>
              <li class="collection-items">12. Kaisaniemenpuisto</li>
            </ul>
          </div>
        </div>
      </div>
      <!-- Data box -->
      <div class="col l7 s12 offset-l1" id="data-box"></div>
    </div>
    
    <!-- js materializecss -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
      // the code will not work probably for the first two clicks. It doesn't remove the first active <li> element. I couldn't solve it.  
      let list = document.getElementsByClassName('collection-items')
      for (let i = 0; i < list.length; i++) {
        list[i].addEventListener("click", function(e){
          let selectedEl = document.querySelector(".active");
          if(selectedEl){
              selectedEl.classList.remove("active");
          }
          this.classList.add("active");
          // Get station names
          let getStationNames = e.target.textContent;
          // get only string values
          const filterStationNames = getStationNames.replace(/[^A-Za-z]/g, '');
          console.log(filterStationNames);
          }, false);;
      }
    </script>
  </body>
</html>