<?php
    session_start();

    $_logindaten = ARRAY("name"=>"demo", "passwort"=>"demo");

    if ((isset($_POST["loginname"]) && isset($_POST["loginpasswort"])) || (isset($_GET["user"]) && isset($_GET["pass"])))
        {
        if (($_logindaten["name"] == $_POST["loginname"] && $_logindaten["passwort"] == $_POST["loginpasswort"]) || ($_logindaten["name"] == $_GET["user"] && $_logindaten["passwort"] == $_GET["pass"])) {
            $_SESSION["login"] = 1;
            }
        }
		?>
<html manifest="app.cache?a<?php echo rand(); ?>">
<head>
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="viewport" content="initial-scale = 1.0,maximum-scale = 1.0" />
	<audio id="speech" autobuffer></audio>
	<title>EverAssist</title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<style>
	body {
		height:100%;
		background-color:rgb(248, 248, 248);
		filter: blur(2px);
	}
    h2 {
      font: normal 14pt/17pt HelveticaNeue, SegoeWP, SegoeUI, Roboto, Sans-serif;
      color: #4d4d4d;
      margin-top: 50px;
      overflow: hidden;
      text-transform: uppercase;
      white-space: nowrap;
      text-overflow: ellipsis;
    }
	<?php
	if ($_SESSION["login"] == 1) {
	echo "input {
		background-color:rgb(248, 248, 248);
		color:rgb(248, 248, 248);
		border:0px
		}"; } ?>
	.header {
		display:none;
	    padding:.5em;
	    margin:0;
	    position:absolute;
	    top:0;
	    right:0;
	    left:0;
	    font-size:1.5em;
	    text-align:center;
	    border-bottom:1px solid rgba(0,0,0,.15);
	    background:rgba(255,255,255,.75);
	    z-index:3;
	}
	.overlay {
		display:none;
	    height:100%;
	    position:absolute;
	    top:0;
	    right:0;
	    left:0;
	    overflow:hidden;
	    z-index:2;
	}
	.clone {
	    height:100%;
	    padding:10em 1em 1em;
	    position:absolute;
	    top:0;
	    right:0;
	    left:0;
	    bottom:0;
	    overflow:hidden;
	    -webkit-filter: blur(.25em);
	    background:#fff;    
	}
	.header2 {
		font-family:sans-serif;
	    padding:.5em;
	    margin:0;
	    position:absolute;
	    top:0;
	    right:0;
	    left:0;
	    font-size:1.5em;
	    text-align:center;
	    border-bottom:1px solid rgba(0,0,0,.15);
	    background:rgba(255,255,255,.75);
	    z-index:3;
	}
	.overlay2 {
	    height:3.25em;
	    position:absolute;
	    top:0;
	    right:0;
	    left:0;
	    overflow:hidden;
	    z-index:2;
	}
	.clone2 {
	    height:3.25em;
	    padding:3em 1em 1em;
	    position:absolute;
	    top:0;
	    right:0;
	    left:0;
	    bottom:0;
	    overflow:hidden;
	    -webkit-filter: blur(.25em);
	    background:#fff;    
	}
	.launch {
		background-color:#c7c7c7;
		text-indent:0px;
		display:inline-block;
		color:#000000;
      font: normal 19pt HelveticaNeue, SegoeWP, SegoeUI, Roboto, Sans-serif;
        text-transform: uppercase;
		font-style:normal;
		height:50px;
		line-height:50px;
		width:131px;
		text-decoration:none;
		text-align:center;
	}
	.buttons {
		margin-top: 80px;
	}
	</style>
	<script src="jquery-1.11.0.min.js"></script>
<?php
 if ($_SESSION["login"] == 1) {
	echo "<script>\n";
	$code = md5(gethostname().getdate()."e1v2e3r4a5s6s7i8s9t10");
		echo "function doesConnectionExist() {
		    var xhr = new XMLHttpRequest();
		    var file = \"http://".$_SERVER['SERVER_NAME']."/run.php\";
		    var randomNum = Math.round(Math.random() * 10000);
     
		    xhr.open('HEAD', file + \"?rand=\" + randomNum, false);
     
		    try {
		        xhr.send();
         
		        if (xhr.status >= 200 && xhr.status < 304) {
					console.log('Server is reachable!');
		        } else {
		            $('.overlay').show();
					$('.header').show();
		        }
		    } catch (e) {
	            $('.overlay').show();
				$('.header').show();
		    }
		}
		function result(echo) {
			var tts = echo.replace(\"ä\",\"ae\").replace(\"ü\",\"ue\").replace(\"ö\",\"oe\").replace(\"ß\",\"sz\");
			var file = \"http://translate.google.com/translate_tts?tl=de&q=\" + encodeURI(tts);
			console.log('Playing ' + file);
			$('#repeat').attr(\"onclick\",\"say('\" + file + \"')\");
			$('#repeat')[0].click();
			$('#output').hide();
			$('#output').text(echo);
			$('#repeat').fadeIn(2000);
			$('#output').fadeIn(2000);
		}
		function enablesound() {
			result('Ton aktiviert');
			$('#enablesound').fadeOut(500);
		}
		function say(url) {
			$('#speech').attr(\"src\",url).trigger(\"play\");
		}
		function geturl(urltoget) {
	        return $.ajax({
	        type: \"GET\",
	        url: urltoget,
	        async: false
	    }).responseText;
		}
		window.onload = function() {
			doesConnectionExist();
			document.body.addEventListener('touchmove', function(e){ e.preventDefault(); });
		$(\"#input\").keyup(function() {
		    var input = $(this).val();
		    if (input !== '') {
		        var checker = function(v) {
		            if (input !== v) {
		                setTimeout('checker(input)', 1000);
		            }
		            else {
		                console.log(input);
						if (input.indexOf(\"Wie geht es dir\") + 1) {
							result(\"Gut. Und dir?\");
						} else if (input.indexOf(\"Gut danke\") +1) {
							result(\"Das freut mich\");
						} else if ((input.indexOf(\"Musik\") +1 || input.indexOf(\"iedergabe\") +1) && (input.indexOf(\"paus\") +1) || input.indexOf(\"stop\") +1) {
							result(\"Musik pausiert.\");
							geturl(\"run.php?code=".$code."&command=xbmcpause\");
						} else if (input.indexOf(\"chster\") +1 && (input.indexOf(\"Song\") +1 || input.indexOf(\"Titel\") +1)) {
							result(\"Springe einen Titel weiter...\");
							geturl(\"run.php?code=".$code."&command=xbmcnext\");
						} else if (input.indexOf(\"Vorherig\") +1 && (input.indexOf(\"Song\") +1 || input.indexOf(\"Titel\") +1)) {
							result(\"Springe einen Titel zurück...\");
							geturl(\"run.php?code=".$code."&command=xbmcprev\");
						} else if ((input.indexOf(\"Lauts\") +1 || input.indexOf(\"Ton\") +1 || input.indexOf(\"Musik\") +1 || input.indexOf(\"Film\") +1) && ((input.indexOf(\"erh\") +1 && input.indexOf(\"hen\") +1) || input.indexOf(\"laut\") +1)) {
							result(geturl(\"run.php?code=".$code."&command=xbmclouder\"));
						} else if ((input.indexOf(\"Lauts\") +1 || input.indexOf(\"Ton\") +1) && (input.indexOf(\"leiser\") +1 || input.indexOf(\"niedrig\") +1)) {
							result(geturl(\"run.php?code=".$code."&command=xbmcquieter\"));
						} else if (input.indexOf(\"Musik weiter\") +1 || input.indexOf(\"Wiedergabe fortsetzen\") +1 || input.indexOf(\"Musik spielen\") +1 || input.indexOf(\"Musik wiedergeben\") +1 || input.indexOf(\"Musik abspielen\") +1) {
							result(\"Musik wird abgespielt.\");
							geturl(\"run.php?code=".$code."&command=xbmcpause\");
						} else if ((input.indexOf(\"Unterricht\") +1 || input.indexOf(\"cher\") +1) && input.indexOf(\"heute\") +1) {
							result(geturl(\"run.php?code=".$code."&command=unterricht&weekday=heute\"));
						} else if ((input.indexOf(\"Unterricht\") +1 || input.indexOf(\"cher\") +1) && input.indexOf(\"Montag\") +1) {
							result(geturl(\"run.php?code=".$code."&command=unterricht&weekday=Monday\"));
						} else if ((input.indexOf(\"Unterricht\") +1 || input.indexOf(\"cher\") +1) && input.indexOf(\"Dienstag\") +1) {
							result(geturl(\"run.php?code=".$code."&command=unterricht&weekday=Tuesday\"));
						} else if ((input.indexOf(\"Unterricht\") +1 || input.indexOf(\"cher\") +1) && input.indexOf(\"Mittwoch\") +1) {
							result(geturl(\"run.php?code=".$code."&command=unterricht&weekday=Wednesday\"));
						} else if ((input.indexOf(\"Unterricht\") +1 || input.indexOf(\"cher\") +1) && input.indexOf(\"Donnerstag\") +1) {
							result(geturl(\"run.php?code=".$code."&command=unterricht&weekday=Thursday\"));
						} else if ((input.indexOf(\"Unterricht\") +1 || input.indexOf(\"cher\") +1) && input.indexOf(\"Freitag\") +1) {
							result(geturl(\"run.php?code=".$code."&command=unterricht&weekday=Friday\"));
						} else if ((input.indexOf(\"Unterricht\") +1 || input.indexOf(\"cher\") +1) && input.indexOf(\"Samstag\") +1) {
							result(geturl(\"run.php?code=".$code."&command=unterricht&weekday=Satursday\"));
						} else if ((input.indexOf(\"Unterricht\") +1 || input.indexOf(\"cher\") +1) && input.indexOf(\"Sonntag\") +1) {
							result(geturl(\"run.php?code=".$code."&command=unterricht&weekday=Sunday\"));
						} else if (input.indexOf(\"eute\") +1 && input.indexOf(\"Vertretung\") +1) {
							result(\"Vertretungsunterricht kann noch nicht ausgegeben werden.\");
						} else if ((input.indexOf(\"Wie\") +1 || input.indexOf(\"Welcher\") +1) && (input.indexOf(\"Song\") +1 || input.indexOf(\"Titel\") +1)) {
							result(geturl(\"run.php?code=".$code."&command=xbmcwhat\"));
						} else if (input.indexOf(\"Server neu\") +1) {
							geturl(\"run.php?code=".$code."&command=restart\");
							result(\"Server wird neu gestartet.\");
						} else {
							result(\"Das habe ich leider nicht verstanden.\");
						}
						$('#input').val('');
						document.activeElement.blur();
						$(\"input\").blur();
		            }
		        }
		        setTimeout(function() {
		            checker(input)
		        }, 1000);
		    }
		});
	    var focused = $('input:first');
		$('#input').trigger('touchstart');
	    $('input').on('touchstart', function () {
	        $(this).focus();
	        focused = $(this);
	    });
	}";
	echo "\n</script>\n"; } ?>
</head>
<body>
	<div class="header"><h2>Keine Internetverbindung</h2></div>
	    <div class="overlay"><div class="clone"></div></div>
	    <div class="header2"><img style="max-height:1.25em" src="icon.png">&nbsp;EverAssist</div>
	    <div class="overlay2"><div class="clone2"></div></div>
		<?php if ($_SESSION["login"] != 1) {
			echo "<form method=\"POST\" action=\"index.php\">
<br><br><br><h2>Login</h2><br>
<br>
Username: <input name=\"loginname\"><br>
Passwort: <input name=\"loginpasswort\" type=password><br>
<br>
<input type=submit name=submit value=\"Einloggen\">
</body></html>";
			exit;
		}
		?>
	<input id="input" type="text"></div>
	<div align="center">
	<h2><div id="output"></div></h2><div class="buttons">
	<a href="javascript:" class="launch" id="button" onclick="$('#input').focus()" class="button">Starten</a><br><br>
	<a id="repeat" href="javascript:" class="launch" style="display:none;height:30px;line-height:30px;font-size:13px">Wiederholen</a><br><br><br>
	<a id="enablesound" href="javascript:" class="launch" onclick="enablesound()" style="height:30px;line-height:30px;font-size:13px">Ton aktivieren</a></div>
</body>
</html>
