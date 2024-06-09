	<?php require_once('./config.php'); //redirect('./index-home.php') ?>

<!DOCTYPE html>
<html>
<head>
	<title> CHMC </title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="css/style.css" type="text/css" rel="stylesheet">
</head>
<body>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v19.0" nonce="m2Mes59n"></script>
	
<div class="top">
	<div>
		Contact Us (02) 8930 0000 | CHMC_MAIN@gmail.com  
	</div>
</div>
	
	<div class="logo">
		<div>
			<table>
				<tr>
					<td width="600px" style="font-size:50px;font-family:forte;"> <font color="#428bca"> Commonwealth Hospital &</font><font color="#000"> Medical Center </font> </td>
					<td> <br> <br>
						<font size="4px"> 
							<a href="./index-home.php">HOME</a> 
							<a href="./about-home.php">ABOUT US</a>  
							<a href="./service-home.php">SERVICES</a>
							<a href="./admin/">LOGIN</a> 
							<a href="./contact-home.php">CONTACT US</a>
						</font>
					</td>
				</tr>
			</table>
		</div>
	</div>
	
	<div class="middle">
		<div style="background-image:url('img/a.jpg');background-size: cover; background-position: center; height: 500px; width: 1200px;">
		
		</div>
	</div>
	
	<div class="bottom">
		<div>
			<table border="0">
				<tr>
					<td width="700px">
						<font color="#000"> We are a medical center </font> <br> <br>

					<font color="#000" size="5px"> Serving Community, Serving You! Right Where You Need Us! </font> <br> <br>

Ang aming ICU ay bukas para sa mga pasyente na diagnosed ng acute and chronic illnesses na nangangailangan ng ispesyal na monitoring. <br><br>

Sa CHMC mas protektado ang inyong mga anak! Commonwealth Med provides extra protection against COVID for kids under 10 years old.
So we started installing Hepa Filters in all Pediatric rooms.<br><br>
<ul>
<li>Heart and oxygen level monitoring
<li>Ventillator to assist breathing
<li>Infusion pump precisely controlled medicine dosage
<li>MRI and CT Scan for the precise imaging of internal organs
<li>Over 300 lab test and procedures available
</ul>

<br>
				<td style="padding-left:20px; vertical-align: top; text-align: right;">
					<div class="fb-video" data-href="https://www.facebook.com/CommonwealthMedh/videos/1140840829886088" data-width="487" data-show-text="true" data-allowfullscreen="false">
						<blockquote cite="https://www.facebook.com/CommonwealthMedh/videos/1140840829886088/" class="fb-xfbml-parse-ignore">
							<a href="https://www.facebook.com/CommonwealthMedh/videos/1140840829886088/"></a>
							<p>Together, we will build a healthier Philippines, one customer at a time, one patient at a time.
								Watch the full video here to learn more: https://youtu.be/gLMOyale5eo.
								#MetroPacificHealth
								#TheHeartOfFilipinoHealthcare
								#CommonwealthMed
								#WeCare
							</p>
							Posted by <a href="https://www.facebook.com/CommonwealthMedh">Commonwealth Hospital and Medical Center</a> on Wednesday, November 16, 2022
						</blockquote>
					</div>
				</td>
			
			</table>
		</div>
	</div>
	
	<div class="bottom_up">
	<div>
		Make an Appointment
		<form method="POST" action="submit-appointment.php" onsubmit="return validateForm()">
			<table>
				<tr>
					<td width="500px"> </td>
					<td><input type="text" name="first_name" placeholder="First Name"></td>
					<td><input type="text" name="last_name" placeholder="Last Name"></td>
				</tr>
				<tr height="30px"></tr>
				<tr>
					<td width="500px"> </td>
					<td><input type="text" name="email" id="email" placeholder="Email Address"></td>
					<td><input type="text" name="mobile" id="mobile" placeholder="Mobile No."></td>
				</tr>
				<tr height="30px"></tr>
				<tr>
					<td width="500px"> </td>
					<td>
						<select name="sex" style="width: 280px;">
							<option value=""> -- Sex -- </option>
							<option value="Male"> Male </option>
							<option value="Female"> Female </option>
						</select>
					</td>
					<td><input type="datetime-local" name="appointment_date" placeholder="Appointment Date and Time" style="width: 275px; height: 40px;"></td>
				</tr>
				<tr height="30px"></tr>
				<tr>
					<td width="500px"> </td>
					<td colspan="2"><textarea name="message" placeholder="Message"> </textarea></td>
				</tr>
				<tr height="30px"></tr>
				<tr>
					<td width="500px"> </td>
					<td colspan="2"><button type="submit"> SUBMIT </button></td>
				</tr>
				<tr height="30px"></tr>
				<tr>
					<td width="500px"> </td>
					<td colspan="2"><button type="button" onclick="window.location.href='update-appointment.php'"> UPDATE APPOINTMENT </button></td>
				</tr>
			</table>
		</form>
	</div>
</div>
	
	<div class="nav_down">
		<div>
		 &copy; 2024 Commonwealth Hospital and Medical Center, site designed & developed by Charl Cadigoy, Matthew Serrano, Jassim Tagarda
		</div>
	</div>
</html>

<script>
function validateForm() {
	var email = document.getElementById("email").value;
	var mobile = document.getElementById("mobile").value;
	
	// Email validation
	var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
	if (!emailRegex.test(email)) {
		alert("Please enter a valid email address.");
		return false;
	}
	
	// Mobile number validation
	var mobileRegex = /^\d{11}$/;
	if (!mobileRegex.test(mobile)) {
		alert("Please enter a valid mobile number with 11 digits.");
		return false;
	}
	
	return true;
}
</script>