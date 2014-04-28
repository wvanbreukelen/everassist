<?php
Header("Access-Control-Allow-Origin: *");
$code = md5(gethostname().getdate()."e1v2e3r4a5s6s7i8s9t10");
if ($_GET["code"] == $code) {
$command = $_GET["command"];
if ($_GET["command"] == "xbmcpause") {
	file_get_contents("http://XBMCURL/jsonrpc?request=%7B%22jsonrpc%22%3A+%222.0%22%2C+%22method%22%3A+%22Player.PlayPause%22%2C+%22params%22%3A+%7B+%22playerid%22%3A+0+%7D%2C+%22id%22%3A+1%7D%");
	echo "gemacht";
}
if ($_GET["command"] == "restart") {
        echo exec("sudo reboot");
}
if ($_GET["command"] == "xbmcnext") {
       echo file_get_contents("http://XBMCURL/jsonrpc?request=%7B%22jsonrpc%22%3A+%222.0%22%2C+%22method%22%3A+%22Player.GoTo%22%2C+%22params%22%3A+%7B+%22playerid%22%3A+0%2C+%22to%22%3A+%22next%22+%7D%2C+%22id%22%3A+1%7D%");
}
if ($command == "xbmcprev") {
	echo file_get_contents("http://XBMCURL/jsonrpc?request=%7B%22jsonrpc%22%3A+%222.0%22%2C+%22method%22%3A+%22Player.GoTo%22%2C+%22params%22%3A+%7B+%22playerid%22%3A+0%2C+%22to%22%3A+%22previous%22+%7D%2C+%22id%22%3A+1%7D%");
}
if ($_GET["command"] == "xbmcquieter") {
	$string = file_get_contents("http://XBMCURL/jsonrpc?request=%7B+%22jsonrpc%22%3A+%222.0%22%2C+%22method%22%3A+%22Application.SetVolume%22%2C+%22params%22%3A+%7B+%22volume%22%3A+%22decrement%22+%7D%2C+%22id%22%3A+1+%7D%");
	$jsonIterator = new RecursiveIteratorIterator(
	    new RecursiveArrayIterator(json_decode($string, TRUE)),
	    RecursiveIteratorIterator::SELF_FIRST);

	foreach ($jsonIterator as $key => $val) {
	    if(is_array($val)) {
	        //echo "$key:\n";
	    } else {
	        //echo "$key => $val<br>\n";
			if ($key == "result") {
				$result = $val;
			}
	    }
	}
	if (!empty($result)) {
		echo "Die neue Lautstärke ist ".$result;
	} else {
		echo "Fehler.";
	}
}
if ($_GET["command"] == "xbmclouder") {
	$string = file_get_contents("http://XBMCURL/jsonrpc?request=%7B+%22jsonrpc%22%3A+%222.0%22%2C+%22method%22%3A+%22Application.SetVolume%22%2C+%22params%22%3A+%7B+%22volume%22%3A+%22increment%22+%7D%2C+%22id%22%3A+1+%7D%");
	$jsonIterator = new RecursiveIteratorIterator(
	    new RecursiveArrayIterator(json_decode($string, TRUE)),
	    RecursiveIteratorIterator::SELF_FIRST);

	foreach ($jsonIterator as $key => $val) {
	    if(is_array($val)) {
	        //echo "$key:\n";
	    } else {
	        //echo "$key => $val<br>\n";
			if ($key == "result") {
				$result = $val;
			}
	    }
	}
	if (!empty($result)) {
		echo "Die neue Lautstärke ist ".$result;
	} else {
		echo "Fehler.";
	}
}
if ($_GET["command"] == "xbmcwhat") {
	$string = file_get_contents("http://XBMCURL/jsonrpc?request=%7B%22jsonrpc%22%3A+%222.0%22%2C+%22method%22%3A+%22Player.GetItem%22%2C+%22params%22%3A+%7B+%22properties%22%3A+%5B%22title%22%2C+%22album%22%2C+%22artist%22%2C+%22duration%22%2C+%22thumbnail%22%2C+%22file%22%2C+%22fanart%22%2C+%22streamdetails%22%5D%2C+%22playerid%22%3A+0+%7D%2C+%22id%22%3A+%22AudioGetItem%22%7D%");
	$jsonIterator = new RecursiveIteratorIterator(
	    new RecursiveArrayIterator(json_decode($string, TRUE)),
	    RecursiveIteratorIterator::SELF_FIRST);

	foreach ($jsonIterator as $key => $val) {
	    if(is_array($val)) {
	        //echo "$key:\n";
	    } else {
	        //echo "$key => $val<br>\n";
			if ($key == "title") {
				$title = $val;
			}
			if ($key == "artist") {
				$artist = $val;
			}
	    }
	}
	if (!empty($title) && !empty($artist)) {
		echo "Das ist ".$title." von ".$artist;
	} else {
		echo "Keine Wiedergabe.";
	}
}
if ($_GET["command"] == "unterricht") {
  if ($_GET["weekday"] == "heute") {
    $weekday = date("l");
  } else {
    $weekday = $_GET["weekday"];
  }
  if ($weekday == "Monday") {
    echo "Mathe, Politik und Spanisch.";
  } else if ($weekday == "Tuesday") {
    echo "Mathe, Englisch und Physik";
  } else {
    echo "Heute keinen Unterricht";
  }
}
} else {
	echo "Fehlerhafter Code!";
}
?>
