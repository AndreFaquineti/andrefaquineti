/*header1*/
const sideBar = document.getElementById("sideBar");
const menuIcon = document.getElementById("menuIcon");
const exitIcon = document.getElementById("exitIcon");
const body = document.getElementsByTagName("body")[0];
sideBar.style.display = "none";

menuIcon.addEventListener('click', expandMenu);
function expandMenu() {
    sideBar.style.animationName = "openSidebar";
    sideBar.style.display = ""; 
    body.style.backgroundColor = "rgba(0,0,0,0.4)"
}

exitIcon.addEventListener('click', hideMenu);
function hideMenu() {
    sideBar.style.animationName = "closeSidebar";
    sideBarWait = setTimeout(hidesidebar, 350);
    function hidesidebar() {
        sideBar.style.display = "none";
        clearTimeout(sideBarWait);
    }
    body.style.backgroundColor = "blanchedalmond"
}