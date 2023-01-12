const selectBox = document.getElementById('select').addEventListener('change', search);
const monthlyBox = document.getElementById('monthly-id');
const stationID = document.getElementById('id');
const loader = document.getElementById('loader');
      
function search(e) {
  //get resultbox
  const resultBox = document.getElementById('result');
  const monthValue = e.target.value;
  const idValue = stationID.value;
  // select is not empty
  if(e.target.value !== ''){
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'stations-single-ajax.php?month=' + monthValue + '&&' +'id=' + idValue, true);
    
    // We show a loader while ajax is loading
    xhr.onloadstart = function(){
      resultBox.style.display = 'none';
      loader.style.display = 'block';
    }

    xhr.onload = function(){
      if (xhr.readyState == 4 && xhr.status == 200) { 
        // Change month div to the selected month
        monthlyBox.textContent = `Monthly ( ` + e.target.value + ` )`;
        // hide the loader
        loader.style.display = 'none';
        // Put the result in to the DOM
        resultBox.style.display = 'block';
        resultBox.innerHTML = xhr.responseText;

      }
      else{
        console.log('error');
      }
    }
    xhr.send();
  }
  else{
    resultBox.innerHTML = `<p>The selected value is empty</p>`
  }
}

// select element initiation
document.addEventListener('DOMContentLoaded', function() {
  var elems = document.querySelectorAll('select');
  var instances = M.FormSelect.init(elems, {});
});


// search stations list names
const filter = document.querySelector('#icon_prefix');
filter.addEventListener('keyup', filterTasks);
// Filter Tasks
function filterTasks(e) {
  const text = e.target.value.toLowerCase();
  document.querySelectorAll('.collection-items').forEach(
  function(station){
      // Here it gets all the station names
      const item = station.textContent;
      if(item.toLowerCase().indexOf(text) != -1){
        station.parentElement.style.display = 'block';
      }
      else {
        station.parentElement.style.display = 'none';
      }
  });
}

//sidenav
document.addEventListener('DOMContentLoaded', function() {
  var elems = document.querySelectorAll('.sidenav');
  var instances = M.Sidenav.init(elems, {});
});