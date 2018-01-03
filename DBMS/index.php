<?php
include './connection/conn.php';
session_start();
if($_SESSION['loggedin'] == 1)
{
	header('location: ./render/render.php');
}
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Welcome|Pinstagram</title>
	<style>

		/* reset */

		html, body, div, span, applet, object, iframe, h1, h2, h3, h4, h5, h6, p, blockquote, pre, a, abbr, acronym, address, big, cite, code, del, dfn, em, img, ins, kbd, q, s, samp, small, strike, strong, sub, sup, tt, var, b, u, i, center, dl, dt, dd, ol, ul, li, fieldset, form, label, legend, table, caption, tbody, tfoot, thead, tr, th, td, article, aside, canvas, details, embed, figure, figcaption, footer, header, hgroup, menu, nav, output, ruby, section, summary, time, mark, audio, video {
			margin: 0;
			padding: 0;
			border: 0;
			font-size: 100%;
			font: inherit;
			vertical-align: baseline
		}

		article, aside, details, figcaption, figure, footer, header, hgroup, menu, nav, section { display: block }

		body { line-height: 1 }

		ol, ul { list-style: none }

		blockquote, q { quotes: none }

		blockquote:before, blockquote:after, q:before, q:after {
			content: '';
			content: none
		}

		table {
			border-collapse: collapse;
			border-spacing: 0
		}

		/* core css */

		html, body { overflow: hidden; }

		.background {
			background-size: cover;
			background-repeat: no-repeat;
			background-position: center center;
			overflow: hidden;
			will-change: transform;
			-webkit-backface-visibility: hidden;
			backface-visibility: hidden;
			height: 130vh;
			position: fixed;
			width: 100%;
			-webkit-transform: translateY(20vh);
			-ms-transform: translateY(20vh);
			transform: translateY(20vh);
			-webkit-transition: all 1.4s cubic-bezier(0.22, 0.44, 0, 1);
			transition: all 1.4s cubic-bezier(0.22, 0.44, 0, 1);
		}

		.background:before {
			content: "";
			position: absolute;
			width: 100%;
			height: 100%;
			top: 0;
			left: 0;
			right: 0;
			bottom: 0;
			/*background-color: rgba(0, 0, 0, 0.3);*/
		}

		.background:first-child {
			background-image: url(maxresdefault.jpg);
			-webkit-transform: translateY(-10vh);
			-ms-transform: translateY(-10vh);
			transform: translateY(-10vh);
		}

		.background:first-child .content-wrapper {
			-webkit-transform: translateY(10vh);
			-ms-transform: translateY(10vh);
			transform: translateY(10vh);
		}

		.background:nth-child(2) { background: #9966ff; }

		.background:nth-child(3) { background: #ffb833; }

		/* Set stacking context of slides */

		.background:nth-child(1) { z-index: 2; }

		.background:nth-child(2) { z-index: 1; }

		.content-wrapper {
			height: 100vh;
			display: -webkit-box;
			display: -webkit-flex;
			display: -ms-flexbox;
			display: flex;
			-webkit-box-pack: center;
			-webkit-justify-content: center;
			-ms-flex-pack: center;
			justify-content: center;
			text-align: center;
			-webkit-flex-flow: column nowrap;
			-ms-flex-flow: column nowrap;
			flex-flow: column nowrap;
			color: #fff;
			font-family: Montserrat;
			/*text-transform: uppercase;*/
			-webkit-transform: translateY(40vh);
			-ms-transform: translateY(40vh);
			transform: translateY(40vh);
			will-change: transform;
			-webkit-backface-visibility: hidden;
			backface-visibility: hidden;
			-webkit-transition: all 1.9s cubic-bezier(0.22, 0.44, 0, 1);
			transition: all 1.9s cubic-bezier(0.22, 0.44, 0, 1);
		}

		.content-title {
			font-size: 12vh;
			line-height: 1.4;
			animation: moveUp 0.7s ease-in-out 0.3s backwards; 
		}
		.content-subtitle{
			font-size: 2vh;
			animation: moveUp 0.7s ease-in-out 0.3s backwards; 
		}



		#ani{
			position: absolute;
			top:-50px;
			left: 400px;
		}

		@keyframes moveUp{
			0% { 
				transform: translateY(40px); 
				opacity: 0;
			}
			100% { 
				transform: translateY(0px);  
				opacity: 1;
			}
		}

		.imgtrans.start{
			animation: moveLeft 0.7s ease-in-out 0.3s backwards;
		}
		.imgtrans1.start{
			animation: moveLeft 0.7s ease-in-out 0.3s backwards;
		}
		.imgtrans2.start{
			animation: moveLeft 0.7s ease-in-out 0.3s backwards;
		}
		.imgtrans3.start{
			animation: moveLeft 0.7s ease-in-out 0.3s backwards;
		}
		.imgtrans4.start{
			animation: moveLeft 0.7s ease-in-out 0.3s backwards;
		}
		.imgtrans5.start{
			animation: moveLeft 0.7s ease-in-out 0.3s backwards;
		}

		@keyframes moveLeft{
			0% { 
				transform: translateX(40px); 
				opacity: 0;
			}
			100% { 
				transform: translateY(0px);  
				opacity: 1;
			}
		}

		.button{
			padding: 10px 60px;
			border-radius: 5px;
			background-color: #4286f4;
			border: none;
			width: 250px;
		}



	</style>
	<link href='http://fonts.googleapis.com/css?family=Berkshire+Swash' rel='stylesheet' type='text/css'>

</head>

<body style="font-family: Garamond;">

	<div class="container">
		<section class="background">
			<div class="content-wrapper" id="ani">
				<p class="content-title" style="font: 400 100px/1.3 'Berkshire Swash', Helvetica, sans-serif;">Pinstagram</p>
				<p class="content-subtitle">Come for what you love.<br>Stay for what you discover.</p> <br> <br>
				<p class="content-subtitle"> 
					<a href="/DBMS_NEW/DBMS/signup/signup.php"><button type="button" class="button" > 
						<h2 style="color: white; width: 100%; font-size: 2.5vh; font-weight: bold; font-family: Garamond;">
							<b>Get Started</b>
						</h2>
					</button></a>
				</p><br><br>
				<p class="content-subtitle"> 
					<a href="/DBMS_NEW/DBMS/login/login.php"><button type="button" class="button" style="background-color: white"> 
						<h2 style="color: black; width: 100%; font-size: 2.5vh; font-weight: bold; font-family: Garamond;">
							<b> Log In  </b>
						</h2>
					</button></a>
				</p>

			</div>
		</section>
		<section class="background">
			<div class="content-wrapper">
				<p class="content-title" style="position: absolute; top: 50px; left: 230px; font: 400 100px/1.3 'Berkshire Swash', Helvetica, sans-serif; ">Your Wall Of Images</p>
				<!-- <p class="content-subtitle">Lorem ipsum dolor sit amet</p> -->
				<img src="pom.jpg" style="border-radius:40px; width:320px; height: 500px; position: absolute; top: 240px;" class="imgtrans">
				<img src="Pin4.jpg" style="border-top-left-radius:40px; border-top-right-radius:40px; width:320px; height: 120px; position: absolute; top: 760px;  " class="imgtrans1">
				<img src="Pin1.jpg" style="border-bottom-left-radius:40px; border-bottom-right-radius:40px; width:320px; height: 320px; position: absolute; top: 250px; left: 350px;" class="imgtrans2">
				<img src="Pin2.jpg" style="border-top-left-radius:40px; border-top-right-radius:40px; width:320px; height: 290px; position: absolute; top: 600px; left: 350px; " class="imgtrans3">
				<img src="Pin3.jpg" style="border-radius:40px; width:320px; height: 500px; position: absolute; top: 240px; left: 700px;">
				<img src="Pin4.jpg" style="border-top-left-radius:40px; border-top-right-radius:40px; width:320px; height: 180px; position: absolute; top: 770px; left: 700px; " class="imgtrans4">
				<img src="Pin5.jpg" style="border-radius:40px; width:320px; height: 370px; position: absolute; top: 240px; left: 1050px;">
				<img src="Pin2.jpg" style="border-top-left-radius:40px; border-top-right-radius:40px; width:320px; height: 330px; position: absolute; top: 640px; left: 1050px;" class="imgtrans5">


			</div>

		</section>
		<section class="background">
			<div class="content-wrapper">
				<p class="content-title"><i class="fa fa-camera fa-4x" aria-hidden="true"></i></p>
				<img src="Pic1.jpg" style="width: 120px; height: 120px; border-radius: 60%; position: absolute; top: 100px; left: 480px;"> <h4 style="position: absolute; top: 225px; left: 500px;"> <strong> Description </strong> </h4>

<img src="Pic2.jpg" style="width: 120px; height: 120px; border-radius: 60%; position: absolute; top: 100px; left: 610px;"> <h4 style="position: absolute; top: 225px; left: 645px;"> <strong> Image </strong> </h4>

<img src="Pic3.jpg" style="width: 120px; height: 120px; border-radius: 60%; position: absolute; top: 100px; left: 740px;"> <h4 style="position: absolute; top: 225px; left: 760px;"> <strong> Comments </strong> </h4>

<img src="Pic5.jpg" style="width: 120px; height: 120px; border-radius: 60%; position: absolute; top: 250px; left: 380px;"> <h4 style="position: absolute; top: 380px; left: 380px;"> <strong> Advertisements </strong> </h4>

<img src="Pic4.jpg" style="width: 120px; height: 120px; border-radius: 60%; position: absolute; top: 250px; left: 530px;"> <h4 style="position: absolute; top: 380px; left: 560px;"> <strong> Connect  </strong> </h4>

<img src="Pic6.jpg" style="width: 120px; height: 120px; border-radius: 60%; position: absolute; top: 250px; left: 670px;"> <h4 style="position: absolute; top: 380px; left: 690px;"> <strong> Categories  </strong> </h4>

<img src="Pic7.jpg" style="width: 120px; height: 120px; border-radius: 60%; position: absolute; top: 250px; left: 820px;"> <h4 style="position: absolute; top: 380px; left: 840px;"> <strong> Boards  </strong> </h4>

<h1 style="font: 400 100px/1.3 'Berkshire Swash', Helvetica, sans-serif; position: absolute; top: 450px; left: 150px;"> Here's What's Trending </h1>



			</div>
		</section>
	</div>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/lodash.js/3.10.1/lodash.min.js'></script> 
	<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script> 
	<script>

var ticking = false;
var isFirefox = /Firefox/i.test(navigator.userAgent);
var isIe = /MSIE/i.test(navigator.userAgent) || /Trident.*rv\:11\./i.test(navigator.userAgent);
var scrollSensitivitySetting = 30;
var slideDurationSetting = 800;
var currentSlideNumber = 0;
var totalSlideNumber = $('.background').length;
function parallaxScroll(evt) {
	if (isFirefox) {
		delta = evt.detail * -120;
	} else if (isIe) {
		delta = -evt.deltaY;
	} else {
		delta = evt.wheelDelta;
	}
	if (ticking != true) {
		if (delta <= -scrollSensitivitySetting) {
			ticking = true;
			if (currentSlideNumber !== totalSlideNumber - 1) {
				currentSlideNumber++;
				nextItem();
			}
			slideDurationTimeout(slideDurationSetting);
		}
		if (delta >= scrollSensitivitySetting) {
			ticking = true;
			if (currentSlideNumber !== 0) {
				currentSlideNumber--;
			}
			previousItem();
			slideDurationTimeout(slideDurationSetting);
		}
	}
}
function slideDurationTimeout(slideDuration) {
	setTimeout(function () {
		ticking = false;
	}, slideDuration);
}
var mousewheelEvent = isFirefox ? 'DOMMouseScroll' : 'wheel';
window.addEventListener(mousewheelEvent, _.throttle(parallaxScroll, 60), false);
function nextItem() {
	var $previousSlide = $('.background').eq(currentSlideNumber - 1);
	$previousSlide.css('transform', 'translate3d(0,-130vh,0)').find('.content-wrapper').css('transform', 'translateY(40vh)');
	currentSlideTransition();
}
function previousItem() {
	var $previousSlide = $('.background').eq(currentSlideNumber + 1);
	$previousSlide.css('transform', 'translate3d(0,30vh,0)').find('.content-wrapper').css('transform', 'translateY(30vh)');
	currentSlideTransition();
}
function currentSlideTransition() {
	var $currentSlide = $('.background').eq(currentSlideNumber);
	$currentSlide.css('transform', 'translate3d(0,-15vh,0)').find('.content-wrapper').css('transform', 'translateY(15vh)');
	;
}

</script>
<script type="text/javascript">

	var _gaq = _gaq || [];
	_gaq.push(['_setAccount', 'UA-36251023-1']);
	_gaq.push(['_setDomainName', 'jqueryscript.net']);
	_gaq.push(['_trackPageview']);

	(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	})();

</script>
</body>
</html>
