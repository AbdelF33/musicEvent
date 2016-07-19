<?php
    require "session.php";
    require "config.php";
    function chargerclasses($class){
        require("dao/".$class.".class.php");
    }
    spl_autoload_register('chargerclasses');
    $mgt = new BDDmusicManager(HOST,DBNAME,USER,PASSWORD);
    $mgt->connect();
    $playlist = $mgt->readMusicGenre($_SESSION['genre1'], $_SESSION['genre2'], $_SESSION['genre3']);
    //echo $_SESSION['genre1']."<br>".$_SESSION['genre2']."<br>".$_SESSION['genre3'];
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

    <!--<link rel="stylesheet" href="content/style/app.css" />-->
    <script>
        $(function(){
            $("[data-role='navbar']").navbar();
            $("[data-role='header'], [data-role='footer']").toolbar();
        });      
    </script>
</head>
<body>

<div data-role="page">
    <div data-role="header">
        <h1>Music Events Application</h1>
        <a href="logout.php" class="ui-btn-right ui-btn ui-btn-inline ui-mini ui-corner-all ui-btn-icon-right">Log out</a>
    </div>
    <div data-role="main" class="ui-content">

        <div id="dz-root"></div>
        <div id="player" style="width:100%;" align="center"></div>
        <script type="text/javascript">
            console.log($("#player").width());
            //Initialiser le player
            window.dzAsyncInit = function() {
                DZ.init({
                    appId : '151331',
                    channelUrl : 'http://vps104447.ovh.net/rila13/projetweb/AbdelR/index.php',
                        player: {
                            container: 'player',
                            width: 600,
                            height: 300
                            /*width: $("#player").width(),
                            height: $("#player").height()*/
                        }
                });
            };
                /*(function() {
                var e = document.createElement('script');
                e.src = 'http://cdn-files.deezer.com/js/min/dz.js';
                e.async = true;
                document.getElementById('dz-root').appendChild(e);
            }());*/
        </script>
        <br>
        <div align="center">
            <button class="ui-btn ui-shadow ui-corner-all ui-icon-carat-l ui-btn-icon-notext ui-btn-b ui-btn-inline" data-enhanced="true" onclick="DZ.player.prev(); return false;" >
                prev</button>
            <button class="ui-btn ui-shadow ui-corner-all ui-icon-play ui-btn-icon-notext ui-btn-b ui-btn-inline" data-enhanced="true" onclick="DZ.player.play(); return false;" >
                play</button>
            <button class="ui-btn ui-shadow ui-corner-all ui-icon-delete ui-btn-icon-notext ui-btn-b ui-btn-inline" data-enhanced="true" onclick="DZ.player.pause(); return false;" >
                pause</button>
            <button class="ui-btn ui-shadow ui-corner-all ui-icon-delete ui-btn-icon-notext ui-btn-b ui-btn-inline" data-enhanced="true" onclick="DZ.player.setVolume(0); return false;" >
                Mute</button>
            <button class="ui-btn ui-shadow ui-corner-all ui-icon-audio ui-btn-icon-notext ui-btn-b ui-btn-inline" data-enhanced="true" onclick="DZ.player.setVolume(80); return false;" >
                set Volume 60</button>
            <button class="ui-btn ui-shadow ui-corner-all ui-icon-carat-r ui-btn-icon-notext ui-btn-b ui-btn-inline" data-enhanced="true" onclick="DZ.player.next(); return false;" >
                next</button>
        </div>
        <!--<div class="ui-nodisc-icon">
            <a href="#" class="ui-btn ui-shadow ui-corner-all ui-icon-delete ui-btn-icon-notext ui-btn-b ui-btn-inline">Delete</a>
            <a href="#" class="ui-btn ui-shadow ui-corner-all ui-icon-plus ui-btn-icon-notext ui-btn-b ui-btn-inline">Plus</a>
            <a href="#" class="ui-btn ui-shadow ui-corner-all ui-icon-minus ui-btn-icon-notext ui-btn-b ui-btn-inline">Minus</a>
            <a href="#" class="ui-btn ui-shadow ui-corner-all ui-icon-check ui-btn-icon-notext ui-btn-b ui-btn-inline">Check</a>
        </div>-->
        <div class="ui-grid-a">
            <div class="ui-block-a"><div class="ui-bar ui-bar-a" style="height:110px">
                <button data-enhanced="true" type="button"
                onclick="DZ.player.playTracks([
                    <?php foreach ($playlist as $music_id => $resultat) {
                        if ($resultat->track_mood_id == "65322") { //peacefull
                            echo $resultat->deezer_id.",";
                        }
                    } ?>
                ]); return false;">
                    In the morning
                </button>
            </div></div>
            <div class="ui-block-b"><div class="ui-bar ui-bar-a" style="height:110px">
                <button data-enhanced="true" type="button" 
                onclick="DZ.player.playTracks([
                    <?php foreach ($playlist as $music_id => $resultat) {
                        if ($resultat->track_mood_id == "65332") { //lively
                            echo $resultat->deezer_id.",";
                        }
                    } ?>
                ]); return false;">
                    Shower
                </button>
            </div></div>
            <div class="ui-block-a"><div class="ui-bar ui-bar-a" style="height:110px">
                <button data-enhanced="true" type="button" 
                onclick="DZ.player.playTracks([
                    <?php foreach ($playlist as $music_id => $resultat) {
                        if ($resultat->track_mood_id == "42949") { //melancoly
                            echo $resultat->deezer_id.",";
                        }
                    } ?>
                ]); return false;">
                    Walk alone
                </button>
            </div></div>
            <div class="ui-block-b"><div class="ui-bar ui-bar-a" style="height:110px">
                <button data-enhanced="true" type="button" 
                onclick="DZ.player.playTracks([
                    <?php foreach ($playlist as $music_id => $resultat) {
                        if ($resultat->track_mood_id == "65326") { //cool
                            echo $resultat->deezer_id.",";
                        }
                    } ?>
                ]); return false;">
                    Great day
                </button>
            </div></div>
            <div class="ui-block-a"><div class="ui-bar ui-bar-a" style="height:110px">
                <button data-enhanced="true" type="button" 
                onclick="DZ.player.playTracks([
                    <?php foreach ($playlist as $music_id => $resultat) {
                        if ($resultat->track_mood_id == "42961") { //energizing
                            echo $resultat->deezer_id.",";
                        }
                    } ?>
                ]); return false;">
                    On work road
                </button>
            </div></div>
            <div class="ui-block-b"><div class="ui-bar ui-bar-a" style="height:110px">
                <button data-enhanced="true" type="button" 
                onclick="DZ.player.playTracks([
                    <?php foreach ($playlist as $music_id => $resultat) {
                        if ($resultat->track_mood_id == "65328") { //serious
                            echo $resultat->deezer_id.",";
                        }
                    } ?>
                ]); return false;">
                    At work
                </button>
            </div></div>
            <div class="ui-block-a"><div class="ui-bar ui-bar-a" style="height:110px">
                <button data-enhanced="true" type="button" 
                onclick="DZ.player.playTracks([
                    <?php foreach ($playlist as $music_id => $resultat) {
                        if ($resultat->track_mood_id == "42961" || $resultat->track_mood_id == "42958") { //energizing, aggressive
                            echo $resultat->deezer_id.",";
                        }
                    } ?>
                ]); return false;">
                    Sport
                </button>
            </div></div>
            <div class="ui-block-b"><div class="ui-bar ui-bar-a" style="height:110px">
                <button data-enhanced="true" type="button" 
                onclick="DZ.player.playTracks([
                    <?php foreach ($playlist as $music_id => $resultat) {
                        if ($resultat->track_mood_id == "65323") { //romantic
                            echo $resultat->deezer_id.",";
                        }
                    } ?>
                ]); return false;">
                    Romantic moments
                </button>
            </div></div>
            <div class="ui-block-a"><div class="ui-bar ui-bar-a" style="height:110px">
                <button data-enhanced="true" type="button" 
                onclick="DZ.player.playTracks([
                    <?php foreach ($playlist as $music_id => $resultat) {
                        if ($resultat->track_mood_id == "42960") { //exiting
                            echo $resultat->deezer_id.",";
                        }
                    } ?>
                ]); return false;">
                    Party
                </button>
            </div></div>
            <div class="ui-block-b"><div class="ui-bar ui-bar-a" style="height:110px">
                <button data-enhanced="true" type="button" 
                onclick="DZ.player.playTracks([
                    <?php foreach ($playlist as $music_id => $resultat) {
                        if ($resultat->track_mood_id = "42946") { //easygoing
                            echo $resultat->deezer_id.",";
                        }
                    } ?>
                ]); return false;">
                    Relaxation
                </button>
            </div></div>
            <div class="ui-block-a"><div class="ui-bar ui-bar-a" style="height:110px">
                <button data-enhanced="true" type="button" 
                onclick="DZ.player.playTracks([
                    <?php foreach ($playlist as $music_id => $resultat) {
                        if ($resultat->track_mood_id == "65322") { //peacefull
                            echo $resultat->deezer_id.",";
                        }
                    } ?>
                ]); return false;">
                    Lunch time
                </button>
            </div></div>
            <div class="ui-block-b"><div class="ui-bar ui-bar-a" style="height:110px">
                <button data-enhanced="true" type="button" 
                onclick="DZ.player.playTracks([
                    <?php foreach ($playlist as $music_id => $resultat) {
                        if ($resultat->track_mood_id == "65326") { //energizing
                            echo $resultat->deezer_id.",";
                        }
                    } ?>
                ]); return false;">
                    Road trip
                </button>
            </div></div>
        </div><!-- /grid-c -->

    </div>

    <div data-role="footer" data-position="fixed" data-theme="a">
        <div data-role="navbar">
            <ul>
                <li><a href="index.php" data-prefetch="true" data-transition="none">Playlist</a></li>
                <li><a href="page-b.html" data-prefetch="true" data-transition="flip">Mood</a></li>
                <li><a href="tasks.php" data-prefetch="true" data-transition="turn">Custom</a></li>
                <li><a href="setting.php" data-prefetch="true" data-transition="slide">Setting</a></li>
            </ul>
        </div><!-- /navbar -->
    </div><!-- /footer -->
</div>
</body>
</html>
<script src="content/js/deezerFunctions.js"></script>
<?php $mgt->disconnect(); ?>