<?php
echo '<!--HEADER START-->
<div id="header" class="flex-container-direction-row" style="justify-content: end;">
    <a href="home.php"
    style="margin-right: auto;">
        <img
          src="images/home-icon.svg"
          class="control-button2">
    </a>
    <div id="header-nameDisplay">
        <p>'?>
            <?php echo "Logged as: " . $_SESSION["user_nickname"] . ", " . $_SESSION["user_email"]?>
<?php
echo '</p>
    </div>
    <a href="settings.php">
        <img
          src="images/settings-icon.svg"
          class="control-button2">
    </a>
    <a href="exit.php">
        <img
          src="images/logout-icon.svg"
          class="control-button2">
    </a>
</div>
<!--HEADER END-->'
?>