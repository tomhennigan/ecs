<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
	
		<title>Friends With Benefits</title>
			
		<link rel="stylesheet" href="/css/bootstrap.css">
		<link rel="stylesheet" href="/css/bootstrap-responsive.css">
		<link rel="stylesheet" href="/img/wg_stained_sm/icons.css">
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
		
		/* Connect buttons */
		.connect {
			margin: 0 auto;
			display: block;
			width: 400px;
			height: 82px;
			border-radius: 20px;
			background: #333;
			background-size: 20px 20px;
			box-shadow: 0 0 20px #fff;
			padding: 5px;
			color: white;
		}
		
		.connect i {
			float: left;
			margin: 5px 0 5px 0;
		}
		
		a .connect p {
			text-decoration: none;
		}
		
		.connect h1 {
			color: white;
			margin: 10px 0 0 70px;
			font-size: 18px;
			line-height: 24px;
		}
		
		.connect p {
			margin: 0 0 0 70px;
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
		<div class="container">
			<div class="container body">
				<form method="post" id="ask" action="/ask">
					<fieldset>
						<div>
							<input name="question" id="question" type="text" style="font-size: 42px; line-height: normal; height: 56px; padding: 5px; width: 99%" placeholder="e.g. Where can I get a coffee in London?" value="Where can I get a coffee in London?" autocomplete="off">
						</div>
					</fieldset>
				</form>
				
				<div class="row">
					<div class="span2">&nbsp;</div>
					
					<div class="span8">
						<?php for ($count = 0, $id = 4; $count < (26 * 8); $id++, $count++): ?>
						<img src="https://graph.facebook.com/<?=$id?>/picture" class="person-icon" />
						<?php endfor; ?>
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
						<div class="person">
							<img
								src="https://fbcdn-sphotos-a.akamaihd.net/hphotos-ak-snc7/418078_10150646239522010_502302009_9025806_2124552553_n.jpg"
							/>
							
							<h1>Tom Hennigan</h1>
						</div>
					</div>
					
					<div class="span4">&nbsp;</div>
				</div>
			</div>
		</div>
	</body>
</html>
