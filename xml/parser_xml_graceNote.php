<?php
	header('Content-Type: application/xml; charset=utf-8');
	$getUserId = file_get_contents("https://c353280-70AB51967DB91FCD379E83A2243A3F91.web.cddbp.net/webapi/xml/1.0/register?client=353280-70AB51967DB91FCD379E83A2243A3F91");
	$xml_chaine = new SimpleXMLElement($getUserId) ;
	$userId = $xml_chaine->RESPONSE->USER;

	$soulRnb = file_get_contents("https://c".$userId.".web.cddbp.net/webapi/xml/1.0/radio/create?genre=36057&return_count=50&client=353280-70AB51967DB91FCD379E83A2243A3F91&user=".$userId);
	$rapHiphop = file_get_contents("https://c".$userId.".web.cddbp.net/webapi/xml/1.0/radio/create?genre=36058&return_count=50&select_extended=cover,mood,tempo&client=353280-70AB51967DB91FCD379E83A2243A3F91&user=".$userId);
	$pop = file_get_contents("https://c".$userId.".web.cddbp.net/webapi/xml/1.0/radio/create?genre=36056&return_count=50&client=353280-70AB51967DB91FCD379E83A2243A3F91&user=".$userId);
	$reggae = file_get_contents("https://c".$userId.".web.cddbp.net/webapi/xml/1.0/radio/create?genre=36065&return_count=50&client=353280-70AB51967DB91FCD379E83A2243A3F91&user=".$userId);
	$metal = file_get_contents("https://c".$userId.".web.cddbp.net/webapi/xml/1.0/radio/create?genre=36053&return_count=50&client=353280-70AB51967DB91FCD379E83A2243A3F91&user=".$userId);
	$danceHouse = file_get_contents("https://c".$userId.".web.cddbp.net/webapi/xml/1.0/radio/create?genre=36054&return_count=50&client=353280-70AB51967DB91FCD379E83A2243A3F91&user=".$userId);
	$Soundtrack = file_get_contents("https://c".$userId.".web.cddbp.net/webapi/xml/1.0/radio/create?genre=36063&return_count=50&client=353280-70AB51967DB91FCD379E83A2243A3F91&user=".$userId);
	$Jazz = file_get_contents("https://c".$userId.".web.cddbp.net/webapi/xml/1.0/radio/create?genre=25974&return_count=50&client=353280-70AB51967DB91FCD379E83A2243A3F91&user=".$userId);
	$Latin = file_get_contents("https://c".$userId.".web.cddbp.net/webapi/xml/1.0/radio/create?genre=25982&return_count=50&client=353280-70AB51967DB91FCD379E83A2243A3F91&user=".$userId);
	$romance = file_get_contents("https://c".$userId.".web.cddbp.net/webapi/xml/1.0/radio/create?&mood=65323,&return_count=50&client=353280-70AB51967DB91FCD379E83A2243A3F91&user=".$userId);

	$genre = file_get_contents("https://c".$userId.".web.cddbp.net/webapi/xml/1.0/radio/create/fieldvalues?fieldname=RADIOGENRE&client=353280-70AB51967DB91FCD379E83A2243A3F91&user=".$userId);
	$mood = file_get_contents("https://c".$userId.".web.cddbp.net/webapi/xml/1.0/radio/create/fieldvalues?fieldname=RADIOMOOD&client=353280-70AB51967DB91FCD379E83A2243A3F91&user=".$userId);
	$era = file_get_contents("https://c".$userId.".web.cddbp.net/webapi/xml/1.0/radio/create/fieldvalues?fieldname=RADIOERA&client=353280-70AB51967DB91FCD379E83A2243A3F91&user=".$userId);
	$tempo = file_get_contents("https://c".$userId.".web.cddbp.net/webapi/xml/1.0/radio/create/fieldvalues?fieldname=RADIOTEMPO&client=353280-70AB51967DB91FCD379E83A2243A3F91&user=".$userId);

	$moodFilter = file_get_contents("https://c".$userId.".web.cddbp.net/webapi/xml/1.0/radio/create?&mood=65323&select_extended=cover,mood,tempo,link&return_count=50&client=353280-70AB51967DB91FCD379E83A2243A3F91&user=".$userId);


	echo $moodFilter;


	//$res = file_get_contents("http://api.deezer.com/search?q=xxxxxxx");

?>