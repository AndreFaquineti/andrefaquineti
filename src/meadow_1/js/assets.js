/*header1*/
const sideBar = document.getElementById("sideBar");
const menuIcon = document.getElementById("menuIcon");
const exitIcon = document.getElementById("exitIcon");
const body = document.getElementsByTagName("body")[0];
sideBar.style.display = "none";

menuIcon.addEventListener('click', expandMenu);
function expandMenu() {
    sideBar.style.display = ""; 
    body.style.backgroundColor = "rgba(0,0,0,0.4)"
}

exitIcon.addEventListener('click', hideMenu);
function hideMenu() {
    sideBar.style.display = "none";
    body.style.backgroundColor = "blanchedalmond"
}