<?php 
    //require("xml/parser_xml_graceNote.php");
    if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest') { 
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Home - Music Events</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="content/jquery.mobile-1.4.5/jquery.mobile-1.4.5.min.css" />
    <script src="content/js/jquery-1.7.1.min.js"></script>
    <script src="content/jquery.mobile-1.4.5/jquery.mobile-1.4.5.min.js"></script>

    <script type="text/javascript" src="http://cdn-files.deezer.com/js/min/dz-v00202681.js"></script>
    <link rel="stylesheet" href="content/style/app.css" />
    <script>
        $(function(){
            $("[data-role='navbar']").navbar();
            $("[data-role='header'], [data-role='footer']").toolbar();
        });
    </script>
</head>
<body>
<?php } ?>

<div data-role="page">
    <div data-role="header"><h1>Music Events Application</h1></div>
    <div data-role="main" class="ui-content">

        <div id="dz-root"></div>
        <div id="player" style="width:100% !important;" align="center" ></div>
        <br/>
        <button class="ui-btn ui-btn-inline" data-enhanced="true" onclick="DZ.player.prev(); return false;" >prev</button>
        <button class="ui-btn ui-btn-inline" data-enhanced="true" onclick="DZ.player.play(); return false;" >play</button>
        <button class="ui-btn ui-btn-inline" data-enhanced="true" onclick="DZ.player.pause(); return false;" >pause</button>
        <button class="ui-btn ui-btn-inline" data-enhanced="true" onclick="DZ.player.setVolume(0); return false;" >Mute</button>
        <button class="ui-btn ui-btn-inline" data-enhanced="true" onclick="DZ.player.setVolume(80); return false;" >set Volume 80</button>
        <button class="ui-btn ui-btn-inline" data-enhanced="true" onclick="DZ.player.next(); return false;" >next</button>

        <!--<br/><br/><br/>
        <input type="button" onclick="getStatus();" value="GO !"/>-->

        <div class="ui-grid-b">
            <div class="ui-block-a"><div class="ui-bar ui-bar-a" style="height:60px">
                <button data-enhanced="true" type="button" onclick="DZ.player.playAlbum(302127); return false;">Play Daft Punk - Discovery</button>
            </div></div>
            <div class="ui-block-b"><div class="ui-bar ui-bar-a" style="height:60px">
                <button data-enhanced="true" type="button" onclick="DZ.player.playAlbum(301775); return false;">Play Daft Punk - Homework</button>
            </div></div>
            <div class="ui-block-c"><div class="ui-bar ui-bar-a" style="height:60px">
                <button data-enhanced="true" type="button" onclick="DZ.player.playRadio(203); return false;">Play Radio</button>
            </div></div>
            <div class="ui-block-a"><div class="ui-bar ui-bar-a" style="height:60px">
                <button data-enhanced="true" type="button" onclick="DZ.player.playSmartRadio(13); return false;">Play Smart Radio</button>
            </div></div>
            <div class="ui-block-b"><div class="ui-bar ui-bar-a" style="height:60px">
                <button data-enhanced="true" type="button" onclick="DZ.player.playTracks([3135556, 1152226]); return false;">Play List of Tracks</button>
            </div></div>
            <div class="ui-block-c"><div class="ui-bar ui-bar-a" style="height:60px">Block C</div></div>
            <div class="ui-block-a"><div class="ui-bar ui-bar-a" style="height:60px">Block A</div></div>
            <div class="ui-block-b"><div class="ui-bar ui-bar-a" style="height:60px">Block B</div></div>
            <div class="ui-block-c"><div class="ui-bar ui-bar-a" style="height:60px">Block C</div></div>
        </div><!-- /grid-c -->

    </div>

    <?php if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest') { ?>
    <div data-role="footer" data-position="fixed" data-theme="a">
        <div data-role="navbar">
            <ul>
                <li><a href="index.php" data-prefetch="true" data-transition="none">Playlist</a></li>
                <li><a href="page-b.html" data-prefetch="true" data-transition="flip">Albums</a></li>
                <li><a href="page-c.html" data-prefetch="true" data-transition="turn">Tasks</a></li>
                <li><a href="setting.html" data-prefetch="true" data-transition="slide">Setting</a></li>
            </ul>
        </div><!-- /navbar -->
    </div><!-- /footer -->
    <?php } ?>
</div>
</body>
</html>
<script src="content/js/deezerFunctions.js"></script>