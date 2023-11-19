<!DOCTYPE html>
<html>
<head>
	<title>Notice</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/print.css')}}" media="print">
	<style>
		.rectangle{
			height: 550px; 
			width: 900px; 
			border: 5px solid;
			background-size: contain;
			background-image: url("images/notice_images/backgroundImage/1.jpeg");
		}
		.logo{
			height:100px;
			width:100px;
			border-radius: 50px;
			margin-top:15px;
		}
		.church-name{
			margin:20px 0 0 100px;
			font-size: 60px;
			font-family: copperplate;
		}
		.address{
			margin:-40px 0 0 300px;
		}
		.Fellowship{
			margin:0 0 0 260px;
			text-decoration: underline;
		}
		.notice{
			height: 50px;
			width: 150px;
			border:2px;
			background: black;
			margin:5px 0 0 350px;
		}
		.text{
			color: white;
			font-size: 40px;
			padding: 0 0 0 10px;
		}
		.lead{
			margin:100px 0 0 50px;
			font-family: cursive;
			font-size: 40px;
		}
		.sermon{
			margin-right: 30px;
		}
		.lead-image{
			height: 200px;
			width: 150px;
			border-radius: 60px;
			margin: -60px 0 0 220px;
		}
		.lead-name{
			font-size: 20px;
			margin-left: 220px;
		}
		.whole{
			margin-top: -60px;
		}
		
	</style>
</head>
<body>
<div class="container">
	<div class="row">
		<div class="rectangle">
			<div class="d-flex px-10">
				<img src="{{ asset('storage/images/users/'.Auth::user()->church_logo )}}"" class="logo">
				<font class="church-name text-color" style="font-weight: bold; font-size:40px; " >{{ Auth::user()->church_name }}</font>
                <h4 class="text-color">Date:{{ $date }}</h4>
			</div>
			<div>
				<h4 class="address text-color">{{ Auth::user()->church_address }}</h4>
				<h3 class="Fellowship text-color">{{ $fellowship }}</h3>
				<div class="notice">
					<h6 class="text">Notice</h6>
				</div>
			</div><br>
			<div class="row whole">
				<div class="col-md-6">
					<div class="row d-flex">
						<h1 class="lead text-color">Lead By:</h1>
						<img src="{{ asset('storage/photos/'.$leadImg )}}" class="lead-image">
					</div>
					<p class="lead-name text-color">{{ $lead }}</p>
				</div>
				<div class="col-md-6" style="margin-top: 100px;">
					<div class="row d-flex">
						<h1 class="sermon text-color">Sermon By:</h1>
						<img src="{{ asset('storage/photos/'.$sermonImg )}}" class="lead-image">
					</div>
					<p class="lead-name text-color">{{ $sermon }}</p>
				</div>
			</div>
		</div>
	</div>
</div>
<br><br><br>
<div style="margin:0; width:50%;">
	<input type="button" id="btn" value="Change Background Color" style="float: right;" class="btn btn-info btn-md">
	<input type="button" id="btn_text_color" value="Change Text Color" style="float: right;" class="btn btn-secondary btn-md">
	<input type="button" id="btn_font_family" value="Change Font Family" style="float: right;" class="btn btn-success btn-md">
	<input type="button" id="print_btn" value="Print" style="float: right;" class="btn btn-primary btn-md" onclick="window.print()">
	<a href="{{ route('showNotices') }}" class="btn btn-md btn-warning" id="btn_go_back">Go Back</a>
</div>

<!-- <script>
	let color = ['red','silver','gray','maroon','purple','fuchsia','green','lime','olive','yellow','navi','blue','teal','aqua','aquamarine','azure','beige','bisque','blanchedalmond','blueviolet','brown','burlywood','cadetblue','coral','chocolate','cyan'];
	let btn = document.getElementById('btn');
	btn.addEventListener('click',function(){
		// console.log(Math.floor(Math.random()*color.length));
		let randomColor = color[Math.floor(Math.random()*color.length)];
		// console.log(randomColor);
		document.getElementsByClassName('rectangle').style.background = randomColor;
	});
</script> -->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
	$(document).ready(function(){
		$(document).on("click","#btn",function(){
			let color = ['linear-gradient(blue, pink)','linear-gradient(red, yellow)','linear-gradient(red, blue)','linear-gradient(purple, pink)','linear-gradient(cyan, teal)','linear-gradient(red, green)','linear-gradient(pink, blue)','linear-gradient(teal, cyan)','linear-gradient(green, teal)','linear-gradient(black, teal)','linear-gradient(yellow, teal)','linear-gradient(pink, blue)','linear-gradient(yellow, red)','linear-gradient(blue, red)'];
			let randomColor = color[Math.floor(Math.random()*color.length)];
			$(".rectangle").css("background",randomColor);
			console.log(randomColor);
		});

		$(document).on("click","#btn_text_color",function(){
			let color = ['red','linear-gradient(red, yellow)','linear-gradient(red, blue)','linear-gradient(purple, pink)','linear-gradient(cyan, teal)','linear-gradient(red, green)','silver','gray','maroon','purple','fuchsia','green','lime','olive','yellow','navi','blue','teal','aqua','aquamarine','azure','beige','bisque','blanchedalmond','blueviolet','brown','burlywood','cadetblue','coral','chocolate','cyan','#CD5C5C','#FFA07A','linear-gradient(to bottom, #ff3300 0%, #ff99cc 100%)','magenta','#FF51EB','#F4F269'];
			let randomColor = color[Math.floor(Math.random()*color.length)];
			$(".text-color").css("color",randomColor);
			console.log(randomColor);
		});


		$(document).on("click","#btn_font_family",function(){
			let fontFamily = ['tahoma','Times New Roman','bradley hand itc'];
			let randomfontFamily = fontFamily[Math.floor(Math.random()*fontFamily.length)];
			$(".text-color").css("font-family",randomfontFamily);
			console.log(randomfontFamily);
		});
	});
</script>
</body>
</html>