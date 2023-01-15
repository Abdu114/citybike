const searchBox = document.getElementById('icon_prefix').addEventListener('keyup', search);
const searchBoxSmall = document.getElementById('icon_prefix_small').addEventListener('keyup', search_small);
const loader = document.getElementById('loader');      
const loaderSmall = document.getElementById('loader_small');      

function search(e) {
  //get card
  const card = document.getElementById('card');
  const cardValue = e.target.value;
  // input is not empty
  if(e.target.value !== ''){
    card.style.display = 'block';

    const xhr = new XMLHttpRequest();

    xhr.open('GET', 'journey_ajax.php?j=' + cardValue, true);

    // We show a loader while ajax is loading
    xhr.onloadstart = function(){
      loader.style.display = 'block';
    }
    xhr.onload = function(){
      if (xhr.readyState == 4 && xhr.status == 200) { 
        // Put the result in DOM
        loader.style.display = 'none';
        card.innerHTML = xhr.responseText;
      }
      else{
        console.log('error');
      }
    }
    xhr.send();
  }
  else{
    card.style.display = 'none';
  }
}
// for small screens search box      
function search_small(e) {
  //get card
  const cardSmall = document.getElementById('card_small');
  const cardValueSmall = e.target.value;
  // input is not empty
  if(e.target.value !== ''){
    // cardSmall.style.display = 'block';

    const xhr_small = new XMLHttpRequest();

    xhr_small.open('GET', 'journey_ajax.php?j=' + cardValueSmall, true);

    // We show a loader while ajax is loading
    xhr_small.onloadstart = function(){
      loaderSmall.style.display = 'block';
    }
    xhr_small.onload = function(){
      if (xhr_small.readyState == 4 && xhr_small.status == 200) { 
        // Put the result in DOM
        loaderSmall.style.display = 'none';
        cardSmall.innerHTML = xhr_small.responseText;
      }
      else{
        console.log('error');
      }
    }
    xhr_small.send();
  }
  else{
    cardSmall.style.display = 'none';
  }
}

document.addEventListener('DOMContentLoaded', function() {
  var elems = document.querySelectorAll('.sidenav');
  var instances = M.Sidenav.init(elems, {});
});