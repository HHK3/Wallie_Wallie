// Get the modal
var modal1 = document.getElementById('id01');
var modal2 = document.getElementById('id02');
var modal3 = document.getElementById('id03');
var modal4 = document.getElementById('id04');
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal2) {
        modal2.style.display = "none";
    } else if (event.target == modal1) {
        modal1.style.display = "none";
    } else if (event.target == modal3) {
        modal3.style.display = "none";
    } else if (event.target == modal4) {
        modal4.style.display = "none";
    }


};

function myFunction() {
    document.getElementById('id01').style.display = 'none';
}

function myFunction2() {
    document.getElementById('id02').style.display = 'none';
}

function myFunction3() {
    document.getElementById('id03').style.display = 'none';
}

function myFunction4() {
    document.getElementById('id04').style.display = 'none';
}


function myFunction7() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}