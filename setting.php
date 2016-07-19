<!DOCTYPE html>
<html>
	<head lang="en">
	    <meta charset="UTF-8">
	    <title>Setting - Music Events</title>
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
		    <div data-role="header"><h1>Setting</h1></div>
		    
		    <div data-role="main" class="ui-content">

	    	</div>

	    	<div data-role="footer" data-position="fixed" data-theme="a">
        		<div data-role="navbar">
		            <ul>
		                <li><a href="index.php" data-prefetch="true" data-transition="none">Playlist</a></li>
		                <li><a href="page-b.html" data-prefetch="true" data-transition="flip">Albums</a></li>
		                <li><a href="tasks.php" data-prefetch="true" data-transition="turn">Tasks</a></li>
		                <li><a href="setting.php" data-prefetch="true" data-transition="slide">Setting</a></li>
		            </ul>
		        </div><!-- /navbar -->
		    </div><!-- /footer -->

    	</div>
	</body>
</html>