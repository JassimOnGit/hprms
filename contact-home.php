<?php require_once('./config.php'); //redirect('./index-home.php') ?>

<!DOCTYPE html>
<html>
<head>
	<title> CHMC </title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="css/style.css" type="text/css" rel="stylesheet">
	<style>
        /* Styles for the floating chat button */
        .chat-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #428bca;
            color: white;
            border: none;
            border-radius: 50px;
            width: 60px;
            height: 60px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
            cursor: pointer;
            z-index: 1000;
        }
        .chat-button:hover {
            background-color: #357ABD;
        }
        .chat-icon {
            font-size: 28px;
            line-height: 60px;
        }
    </style>
</head>
<body>
	
<div class="top">
    <div class="contact-info">
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
	
	
	
	
	
	<div class="bottom">
		<div>
			<table border="0">
				<tr>
					<td width="700px">
						<font color="#000">_________________ </font> <br> <br>

					<font color="#000" size="6px"> CONTACT US </font> <br> <br>

					Commonwealth Hospital and Medical Center
					
					<br>
					<br>
					
					Contact No. (02) 8930 0000
					
					<br>
					<br>
					
					Email: CHMC_MAIN@gmail.com

					<br>
					<br>

					<a href="https://www.facebook.com/CommonwealthMedh/" target="_blank"><img src="img/icons8-facebook-48.png" alt="Facebook"></a>
					<a href="https://www.instagram.com/commonwealthmed/" target="_blank"><img src="img/icons8-instagram-48.png" alt="Instagram"></a>
					<a href="https://www.linkedin.com/company/commonwealthmed/" target="_blank"><img src="img/icons8-linkedin-48.png" alt="LinkedIn"></a>
					<br>
					<br>
					<td style="padding-left:20px; vertical-align: top;"> <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3858.668405814497!2d121.05810117565106!3d14.731329973861566!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b06666203d2d%3A0x7a9c35c225705db8!2sCommonwealth%20Hospital%20and%20Medical%20Center!5e0!3m2!1sen!2sph!4v1705823651295!5m2!1sen!2sph" width="400" height="270" style="border:0;" allowfullscreen="1" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></td>
					
					</tr>
			</table>
		<!-- </div>
	</div> -->
	<br>
	<br>
<div class="nav_down">
	<div>
		&copy; 2024 Commonwealth Hospital and Medical Center, site designed & developed by Charl Cadigoy, Matthew Serrano, Jassim Tagarda 
	</div>
</div>
</body>
</html>

<script>
<!-- Chat button click event-->
function openChat() {
	window.open('./chat-home.php', '_blank', 'width=1300, height=1050');
}

</script>

<!-- Floating chat button -->
<button class="chat-button" onclick="openChat()" style="font-size: 20px;">
	<span class="chat-icon" onmouseover="this.innerHTML = 'Chat'" onmouseout="this.innerHTML = '&#x1F4AC;'" style="display: inline-block; width: 100px; text-align: left; font-size: 18px; position: relative; top: -10px;">&#x1F4AC;</span>
</button>