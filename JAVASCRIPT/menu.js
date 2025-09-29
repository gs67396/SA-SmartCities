const icon = document.getElementById("icon");
const menuButton = document.getElementById("menuButton");

let closed = true;

menuButton.addEventListener("click", function() {
  
  if (closed){
    icon.src = "../../IMAGENS/x_icon_172101.png";
  } else{
    icon.src = "../../IMAGENS/Hamburger_icon.svg.png"
  }
  closed = !closed;

});


function openav(){
    document.getElementById('navbar').style.display = document.getElementById('navbar').style.display === 'none' ? 'block' : 'none' ;
}

