const searchBox = document.getElementById('icon_prefix').addEventListener('keyup', search);
      
function search(e) {
  //get card
  const card = document.getElementById('card');
  const cardValue = e.target.value;
  // input is not empty
  if(e.target.value !== ''){
    card.style.display = 'block';

    const xhr = new XMLHttpRequest();

    xhr.open('GET', 'journey_ajax.php?j=' + cardValue, true);

    xhr.onprogress = function(){
    }
    xhr.onload = function(){
      if (xhr.readyState == 4 && xhr.status == 200) { 
        // Put the result in DOM
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