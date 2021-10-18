<?php require "../classes/init.php"; ?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Profile</title>
	<link rel="stylesheet" href="../css/font-awesome-4.5.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="../css/w3.css">
	<link rel="stylesheet" href="../css/style2.css">
	<?php //require_once '../theme.php'; ?>
	
	<style media="screen">
		* {
			border-radius: 3px;
		}

		.user-box {
			width: 100%;
			padding: 4px;
			display: flex;
			border: 0;
			outline: 0;
			align-items: center;
			flex-direction: column;
		}

		.west {
			padding: 5px;
		}

		.user-image {
			width: 100%;
			display: flex;
			justify-content: flex-start;
			border: 1px solid grey;
			padding: 10px;
		}

		.user-image img {
			max-width: 30%;
			max-height: 150px;
		}

		.image-data {
			padding: 0 10px;
		}

		.image-data .u {
			text-decoration: underline;
			font-weight: lighter;
		}

		.image-data .detail {
			font-family: candara, sans-serif;
			font-style: oblique;
		}

		.image-data p {
			margin: 0;
			padding: 3px 0;
		}

		.user-info {
			width: 100%;
			padding: 5px;
			display: flex;
			justify-content: space-between;
		}

		.profile-data {
			justify-content: flex-end;
			display: flex;
		}

		.profile-data button {
			margin-right: 4px;
			cursor: pointer;
			display: flex;
			padding: 5px;
			width: auto;
		}

		.fa {
			color: inherit !important;
		}

		/*ADDITIONAL*/
		.modal {
			position: fixed;
			display: none;
			width: 100%;
			top: 0;
			z-index: 10;
			background-color: rgba(255, 255, 255, 0.5);
			height: 100%;
		}

		.modal-content {
			position: absolute;
			padding: 10px;
			border-radius: 5px;
			width: 50%;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
			font-family: arial, sans-serif;
		}

		@media only screen and (max-width: 500px) {
			.modal-content {
				width: 100%;
			}

			.profile-data {
				flex-direction: column;
			}

			.footer {
				padding: 0;
				font-size: 12px;
			}

			.user-image {
				flex-direction: column;
			}

		}

		@media only screen and (max-width: 400px) {
			.user-info {
				flex-direction: column;
			}

			.user-image {
				flex-direction: column;
				flex-wrap: wrap;
			}

			.user-image img {
				width: 100%;
			}
		}

		.change {
			padding: 7px 10px;
			margin: 5px auto;
			width: 100%;
			display: block;
			border: 2px solid dodgerblue;
			border-radius: 4px;
		}

		.change:hover {
			cursor: pointer;
		}

		.close-modal {
			padding: 4px;
			position: absolute;
			right: 0;
			color: red !important;
			top: 0;
			cursor: pointer;
			margin-right: 0;
		}

		.modal-content textarea {
			padding: 5px;
			resize: vertical;
			max-height: ;
			border: 1px solid blue;
			border-radius: 5px;
			width: 100%;
		}

		.modal-content select {
			padding: 10px;
			text-align: center;
			width: 50%;
			left: 50%;
			margin-left: 25%;
		}

		.user-data {
			flex: 20%;
		}
	</style>
</head>

<body class="w3-theme-l3">
	<div class="modal" id="login-modal">
		<span class="close-modal"><i class="fa fa-times" style="font-size: 25px;"></i></span>
		<div class="modal-content">
			<input id="file" style="display: none;" name="image" form="form1" accept="image/*" type="file" />
			<button id="choose" class="change w3-button w3-theme-dark">
				<i style="color: inherit;" class="fa fa-image"></i>&nbsp;<span>Choose image</span>
			</button>
		</div>
	</div><?php
	$user=$_GET['id'];
$user_obj = new User($db_connection,$user);
  	$sele=$user_obj->profile1($user);
  	    $fname=$_SESSION['p_userfname'];
          $lname=$_SESSION['p_userlname'];
            $about=$_SESSION['p_userabout'];
             $address=$_SESSION['p_useraddress'];
              //$image=$_SESSION['image'];
 // echo "valiables".$fname.$lname;
	?>

	
	<div class="container w3-theme-light">
		<?php require '../menu/menu.php'; ?>
		<div class="west w3-card">
			<?php require_once 'error.php'; ?>
			<div class="user-box w3-card-4 w3-theme-d1 w3-round-large">
				<div class="user-image">
					<!--<img class="" id="profile" src="../images/<?php echo $me->profile_pic; ?>" alt="profile" />-->
					<?php $sele=$user_obj->profile1_image($user); ?>
					<div class="image-data">
						<p><span style="font-weight: bold;"><?php  echo ucfirst($fname) . " " . ucfirst($lname); ?></span></p>
						<p><span class='u'>From</span>: <span class="detail"><?php echo $address; ?></span></p>
						<p><span class='u'>About me</span>: <span><?php echo ucfirst($about); ?></span></p>
					</div>
				</div>
				<div class="user-info">
					<div class="user-data">
						<li><?php echo ucfirst($fname) . " " . ucfirst($lname); ?></li>
					</div>
					
				</div>
			</div>
			<div class="footer w3-card-4 w3-round-large w3-theme-dark">
			</div>
			<div id="forms" style="display: none;">
			
			</div>
		</div>
	</div>
</body>
<script>
	(function() {
		document.getElementsByTagName('textarea')[0].value = "";
		var close = document.getElementsByClassName('close-modal');
		for (var i = 0; i < close.length; i++) {
			close[i].onclick = function() {
				this.parentElement.style.display = 'none';
			}
		}
	})();

	function myFunction(elementId) {
		var modal = document.getElementById(elementId);
		modal.style.display = "block";
	}

	document.getElementById('choose').onclick = function() {
		let element = document.getElementById("file");
		if (element.value !== "") {
			document.getElementById("form1").submit();
		} else {
			element.click();
		}
	}
	document.getElementById('file').onchange = function() {
		if (this.value !== "") {
			document.getElementById('form1').submit();
		}
	}
	window.onclick = function(e) {
		var modals = document.getElementsByClassName("modal");
		for (var i = 0; i < modals.length; i++) {
			if (e.target == modals[i]) {
				modals[i].style.display = "none";
			}
		}
	}
	document.getElementsByClassName('fa-times')[0].onclick = function() {
		this.parentElement.style.display = "none";
	}

	function sendData(id, form) {
		var data = document.getElementById(id);
		//alert(data.value);
		if (data.value != "" && data.value != "seled") {
			document.getElementById(form).submit();
		} else {
			alert("Data empty");
		}
	}
</script>

</html>