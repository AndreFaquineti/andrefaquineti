<!--HEADER START-->
<style>
#header-nameDisplay {
    display: flex;
}
#header-nameDisplay p {
    margin: 0px;
    align-content: center;
}
@keyframes openSidebar {
    0% {right: -60%;}
    100% {right: 0;}
}
@keyframes closeSidebar {
    0% {right: 0;}
    100% {right: -60%;}
}
#sideBar {
    margin: 0;
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    height: 100%;
    max-width: 60%;
    right: 0;
    top: 0;
    background-color: blanchedalmond;
    padding: 10px;
    line-height: 2;
    border-left: solid rgb(252, 221, 176) 2px;
    font-size: 20px;
    animation-name: openSidebar;
    animation-duration: 400ms;
}
/*DESKTOP*/
@media screen and (min-width: 800px) {
    #menuIcon {
        display: none;
    }
    #header-home {
    max-height: 50px;
    }
    #header-nameDisplay {
        min-width: 25%;
    }
}
/*MOBILE*/
@media screen and (max-width: 800px) {
    .navItem {
        display:none;
    }
    #header-home {
    max-height: 40px;
    }
    #header-nameDisplay {
        width: 75%;
    }
}
</style>
<div id="header" class="flex-container-direction-row" style="justify-content: end; border-bottom: solid black 2px;">
    <a href="home.php"
    id="logo"
    style="
    margin: 0px auto 0px 10px;
    border: 0px;
    ">
        Meadow
    </a>
    <div id="header-nameDisplay"
    class="navItem">
        <p class="navItem">
            <?php echo $_SESSION["user_nickname"] . ", " . $_SESSION["user_email"]?>
        </p>
    </div>
    <a href="stats.php"
    class="navItem">
        <img
          src="images/stats-icon.svg"
          class="control-button2"
          alt="Statistics Button"
          title="Statistics">
    </a>
    <a href="settings.php"
    class="navItem">
        <img
          src="images/settings-icon.svg"
          class="control-button2"
          alt="Settings Button"
          title="Settings">
    </a>
    <a href="exit.php"
    class="navItem">
        <img
          src="images/logout-icon.svg"
          class="control-button2"
          alt="Exit Button"
          title="Exit Account">
    </a>
    <img
        src="images/menu-icon.svg"
        class="control-button2"
        id="menuIcon"
        alt="Side bar Button"
        title="Side bar">
</div>
<div id="sideBar"
class="flex-container-direction-column">
    <img
        src="images/exit-icon.svg"
        class="control-button2"
        style="margin: -10px; margin-bottom: 10px; font-size: 36; width: 60px; height: 60px;"
        id="exitIcon">
    <div id="sideBar-nameDisplay"
    style="line-height: 1.2; margin-bottom: 10px;">
        <?php echo $_SESSION["user_nickname"] . ", <br>" . $_SESSION["user_email"]?>
    </div>
    <a href="settings.php">
        Settings
    </a>
    <a href="stats.php">
        My statistics
    </a>
    <a href="exit.php">
        Exit
    </a>
</div>
<!--HEADER END-->