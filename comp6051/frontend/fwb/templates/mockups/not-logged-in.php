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
		</style>
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		<script src="/js/bootstrap.min.js"></script>
	</head>
	
	<body>
		<div class="container">
			<header id="jumbotron" class="jumbotron masthead" <?php if ($question !== null): ?>style="display:none"<?php endif; ?>>
				<h1>Friends With Benefits</h1>
				<p>Ask a question, any question, and we'll help you find the best person you know to ask!</p>
			</header>
			
			<div class="container body">
				<div class="row">
					<div class="span1">&nbsp;</div>
					
					<div class="span5">
						<a href="#">
							<div class="connect">
								<i class="wgs-facebook"></i>
								<h1>Facebook</h1>
								<p>Connect Friends With Benefits to your Facebook account so that we can find your friends in this network!</p>
							</div>
						</a>
					</div>
					
					<div class="span5">
						<a href="#">
							<div class="connect">
								<i class="wgs-twitter"></i>
								<h1>Twitter</h1>
								<p>Connect Friends With Benefits to your Twitter account so that we can find your friends in this network!</p>
							</div>
						</a>
					</div>
					
					<div class="span1">&nbsp;</div>
				</div>
			</div>
		</div>
	</body>
</html>
