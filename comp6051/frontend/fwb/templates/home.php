<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
	
		<title>Friends With Benefits</title>
			
		<link rel="stylesheet" href="/css/bootstrap.css">
		<link rel="stylesheet" href="/css/bootstrap-responsive.css">
		<style type="text/css">
		body {
			background-color: #f0f0f0;
			
			padding-top: 20px;
			padding-bottom: 20px;
		}
		/* Jumbotrons
		-------------------------------------------------- */
		.jumbotron {
		  position: relative;
		}
		.jumbotron h1 {
		  margin-bottom: 9px;
		  font-size: 81px;
		  letter-spacing: -1px;
		  line-height: 1;
		}
		.jumbotron p {
		  margin-bottom: 18px;
		  font-weight: 300;
		}
		.jumbotron .btn-large {
		  font-size: 20px;
		  font-weight: normal;
		  padding: 14px 24px;
		  margin-right: 10px;
		  -webkit-border-radius: 6px;
		 	-moz-border-radius: 6px;
		  		border-radius: 6px;
		}
		
		/* Masthead (docs home) */
		.masthead {
		  padding-top: 36px;
		  margin-bottom: 72px;
		}
		.masthead h1,
		.masthead p {
		  text-align: center;
		}
		.masthead h1 {
		  margin-bottom: 18px;
		}
		.masthead p {
		  margin-left: 5%;
		  margin-right: 5%;
		  font-size: 30px;
		  line-height: 36px;
		}
		
		#matches {
			text-align: center;
		}
		
		.person {
			display: block;
			padding: 10px;
			border: 1px solid #ccc;
			border-radius: 3px;
			background: white;
		}
		
		.person h1 {
			margin-top: 15px;
			font-size: 36px;
			font-weight: normal;
			text-align: center;
		}
		
		.person img {
			margin: 0 auto;
			height: 120px;
			display: block;
		}
		
		.downarrow {
			text-align: center;
			font-size: 60px;
			line-height: 70px;
			padding-bottom: 15px;
		}
		
		img.person-icon {
			width: 25px;
			height: 25px;
		}
		</style>
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		<script src="/js/bootstrap.min.js"></script>
	</head>
	
	<body>
		<div id="fb-root"></div>
		<script>
		  window.fbAsyncInit = function() {
		    FB.init({
		      appId      : '317284658320582', // App ID
		      channelUrl : 'https://friendswithbenefits.tom.gd/facebook/channel', // Channel File
		      status     : true, // check login status
		      cookie     : true, // enable cookies to allow the server to access the session
		      xfbml      : false // parse XFBML
		    });
		
		    // Additional initialization code here
		  };
		
		  // Load the SDK Asynchronously
		  (function(d){
		     var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
		     if (d.getElementById(id)) {return;}
		     js = d.createElement('script'); js.id = id; js.async = true;
		     js.src = "https://connect.facebook.net/en_US/all.js";
		     ref.parentNode.insertBefore(js, ref);
		   }(document));
		</script>

		
		<div class="container">
			<header id="jumbotron" class="jumbotron masthead" <?php if ($question !== null): ?>style="display:none"<?php endif; ?>>
				<h1>Friends With Benefits</h1>
				<p>Ask a question, any question, and we'll help you find the best person you know to ask!</p>
			</header>
			
			<div class="container body">
				<form method="post" id="ask" action="/ask">
					<fieldset>
						<div>
							<input name="question" id="question" type="text" style="font-size: 42px; line-height: normal; height: 56px; padding: 5px; width: 99%" placeholder="e.g. Where can I get a coffee in London?" value="<?=htmlentities($question)?>" autocomplete="off">
						</div>
					</fieldset>
				</form>
				
				<script>
				function askquestion() {
					$.post('/ask', {'question': $('#question').val()}, function (ret) {
						// Debug print out.
						ret_print =  JSON.stringify(ret, null, 4);
						$('#debug').text(ret_print);
						
						if (!ret.answer.best) {
							$('#result').hide(500);
							return;
						}
						
						$('#matches').html('');
						
						for (var idx in ret.answer.matches) {
							var match = ret.answer.matches[idx];
							
							$('#matches').append('<img src="https://graph.facebook.com/' + match.fbid + '/picture" class="person-icon" />&nbsp;');
						}
						
						
						FB.api('/' + ret.answer.best.fbid, function (r) {
							$('#best h1').text(r.name);
						});
						
						FB.api('/' + ret.answer.best.fbid + '/picture?type=large&return_ssl_resources=1', function (r) {
							$('#best img').attr('src', r);
							
							$('#result').show(500);
						});
					}, 'json');
				};
				
				
				timeout = false;
				$('#question').keydown(function () {
					if (timeout !== false) {
						clearTimeout(timeout);
					}
					
					timeout = setTimeout(askquestion, 1000);
				});
				

				$('#ask').submit(function () {
					// \n triggers keydown as well and there is no submit button..
					//askquestion();
					
					return false;
				});
				</script>
			</div>
			
			<div id="result" style="display:none">
				<div class="row">
					<div class="span2">&nbsp;</div>
					
					<div class="span8" id="matches">
						
					</div>
					
					<div class="span2">&nbsp;</div>
				</div>
				
				<div class="row">
					<div class="span4">&nbsp;</div>
					
					<div class="span4">
						<p class="downarrow">&darr;</p>
					</div>
					
					<div class="span4">&nbsp;</div>
				</div>
				
				<div class="row">
					<div class="span4">&nbsp;</div>
					
					<div class="span4">
						<div class="person" id="best">
							<img src="#" />
							
							<h1>Tom Hennigan</h1>
						</div>
					</div>
					
					<div class="span4">&nbsp;</div>
				</div>
			</div><!-- /result -->
			
			<div class="row">
				<div class="span12">
					<h2>Debug</h2>
				<pre id="debug"></pre>
				</div>
			</div>
		</div>
		
		<script>		
		hidemotron = function () {
			val = $('#question').val();
			
			if (val.length === 0) {
				$('#jumbotron').slideDown(500);
			} else {
				$('#jumbotron').slideUp(500);
			}
		};
		
		$(document).ready(function () {
			$('#question').focus();
			hidemotron();
		});
		
		$('#question').keyup(hidemotron);
		</script>
	</body>
</html>
