<?php 
    //require("xml/parser_xml_graceNote.php");
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

    </div>

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
</div>
</body>
</html>
<script src="content/js/deezerFunctions.js"></script>