// Buttons Go-to-the-Top Functions
let myButton = document.getElementById("myBtn");

window.onscroll = function() {scrollFunction()};

function scrollFunction()
{
    if(document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        myButton.style.display = "block";
    } else {
        myButton.style.display = "none";
    }
}

function topFunction() 
{
    document.body.scrollTop = 0; // For Safari
    document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}

myButton.addEventListener("click", topFunction);

// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("bookingBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

let btnDate = document.getElementById("yo");
let btnDate2 = document.getElementById("ya");

let btnHour = document.querySelector('.hour1');
let btnHour2 = document.querySelector('.hour2');
let btnHour3 = document.querySelector('.hour3');
let btnHour4 = document.querySelector('.hour4');
let btnHour5 = document.querySelector('.hour5');
let btnHour6 = document.querySelector('.hour6');
let btnHour7 = document.querySelector('.hour7');

let btnHour8 = document.querySelector('.hour8');
let btnHour9 = document.querySelector('.hour9');
let btnHour10 = document.querySelector('.hour10');
let btnHour11 = document.querySelector('.hour11');
let btnHour12 = document.querySelector('.hour12');
let btnHour13 = document.querySelector('.hour13');
let btnHour14 = document.querySelector('.hour14');

btnHour.addEventListener("click", function()
{
  console.log("coucou")
})

btnDate.addEventListener("click", function()
{
  btnHour.style.display = "grid";
  btnHour2.style.display = "grid";
  btnHour3.style.display = "grid";
  btnHour4.style.display = "grid";
  btnHour5.style.display = "grid";
  btnHour6.style.display = "grid";
  btnHour7.style.display = "grid";

  btnHour8.style.display = "grid";
  btnHour9.style.display = "grid";
  btnHour10.style.display = "grid";
  btnHour11.style.display = "grid";
  btnHour12.style.display = "grid";
  btnHour13.style.display = "grid";
  btnHour14.style.display = "grid";
  console.log("salut");
})

btnDate2.addEventListener("click", function()
{
  btnHour.style.display = "none";
  btnHour2.style.display = "none";
  btnHour3.style.display = "none";
  btnHour4.style.display = "none";
  btnHour5.style.display = "none";
  btnHour6.style.display = "none";
  btnHour7.style.display = "none";

  btnHour8.style.display = "none";
  btnHour9.style.display = "none";
  btnHour10.style.display = "none";
  btnHour11.style.display = "none";
  btnHour12.style.display = "none";
  btnHour13.style.display = "none";
  btnHour14.style.display = "none";
})