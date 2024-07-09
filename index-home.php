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
	<div class="middle">
	<br>
		<div style="text-align: center; background-image: url('img/a.gif'); background-size: cover; background-position: center; height: 1300px; width: 1300px; margin: 0 auto;">
			<h1 style="font-family: 'Times New Roman'; text-shadow: 10px 10px 18px white;">Make an Appointment</h1>
			<br>
			<br>
			<br>
			<form method="POST" action="submit-appointment.php" onsubmit="return validateForm()">
				<table style="margin: 0 auto;">
					<tr>
						<td style="text-align: left">
							<label for="first_name" style="font-weight: bold; background-color: white; padding: 2px;">First Name</label><br>
							<input type="text" id="first_name" name="first_name" placeholder="First Name" style="margin-right: 87px;">
						</td>
						<td style="text-align: left;">
							<label for="last_name" style="font-weight: bold; background-color: white; padding: 2px;">Last Name</label><br>
							<input type="text" id="last_name" name="last_name" placeholder="Last Name">
						</td>
					</tr>
					<tr height="30px"></tr>
					<tr>
						<td style="text-align: left;">
							<label for="email" style="font-weight: bold; background-color: white; padding: 2px;">Email Address</label><br>
							<input type="text" id="email" name="email" placeholder="Email Address">
						</td>
						<td style="text-align: left;">
							<label for="mobile" style="font-weight: bold; background-color: white; padding: 2px;">Mobile No.</label><br>
							<input type="text" id="mobile" name="mobile" placeholder="Mobile No.">
						</td>
					</tr>
					<tr height="30px"></tr>
					<tr>
						<td style="text-align: left;">
							<label for="sex" style="font-weight: bold; background-color: white; padding: 2px;">Sex</label><br>
							<select id="sex" name="sex" style="width: 280px;">
								<option value=""> -- Sex -- </option>
								<option value="Male"> Male </option>
								<option value="Female"> Female </option>
							</select>
						</td>
						<td style="text-align: left;">
							<label for="doctor_schedule" style="font-weight: bold; background-color: white; padding: 2px;">Specific Doctor Appointment?</label><br>
							<select id="doctor_schedule" name="doctor_schedule" placeholder="Specific Doctor Appointment?" style=" width: 280px;">
								<option value=""> --Select Doctor-- </option>
								<option value="Doctor MD1 (General Practitioner)"> Doctor MD1 (General Practitioner) </option>
								<option value="Doctor MD2 (Pediatrician)"> Doctor MD2 (Pediatrician) </option>
								<option value="Doctor MD3 (Ob-Gyn)"> Doctor MD3 (Ob-Gyn) </option>
								<option value="Doctor MD4 (Geriatrics)"> Doctor MD4 (Geriatrics) </option>
								<option value="Doctor MD5 (Family Medicine)"> Doctor MD5 (Family Medicine) </option>
							</select>
						</td>
					</tr>
					<tr height="30px"></tr>
					<tr>
						<td style="text-align: left;">
							<label for="appointment_date" style="font-weight: bold; background-color: white; padding: 2px;">General Appointment Date and Time</label><br>
							<input type="datetime-local" id="appointment_date" name="appointment_date" placeholder="General Appointment Date and Time" style="width: 275px; height: 38px;">
						</td>
						<td style="text-align: left;">
							<label for="doctor_schedule_appointment_date" style="font-weight: bold; background-color: white; padding: 2px;">Doctor's Appointment Date and Time</label><br>
							<input type="datetime-local" id="doctor_schedule_appointment_date" name="doctor_schedule_appointment_date" placeholder="Doctor's Appointment Date and Time" style="width: 275px; height: 38px;">
						</td>
					</tr>
					<tr height="30px"></tr>
					<tr>
						<td colspan="2" style="text-align: left;">
							<label for="message" style="font-weight: bold; background-color: white; padding: 2px;">Message</label><br>
							<textarea id="message" name="message" placeholder="Message"></textarea>
						</td>
					</tr>
					<tr height="30px"></tr>
					<tr>
						<td colspan="2"><button type="submit">SUBMIT</button></td>
					</tr>
					<tr height="30px"></tr>
					<tr>
						<td colspan="2"><button type="button" onclick="window.location.href='update-appointment.php'">UPDATE APPOINTMENT</button></td>
					</tr>
				</table>
			</form>
		</div>
	</div>


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
	<!-- <div class="bottom_up">
	</div> -->
	<br>
	<br>
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