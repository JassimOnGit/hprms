<?php require_once('./config.php'); //redirect('./index-home.php') ?>

<!DOCTYPE html>
<html>
<head>
    <title> CHMC </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" type="text/css" rel="stylesheet">
</head>
<div>
    <div style="text-align: center; background-image: url('img/b.jpg'); background-size: cover; background-position: center; height: 1300px; width: 1300px; margin: 0 auto;">
        <br>
        <h1 style="font-family: 'Times New Roman'; font-weight: bold; background-color: white; padding: 3px; width: fit-content;">Make an Appointment</h1>
        <br>
        <br>
        <br>
        <form method="POST" action="submit-appointment.php" onsubmit="return validateForm()">
            <table style="margin: 0 auto;">
                <tr>
                    <td style="text-align: left">
                        <label for="first_name" style="font-weight: bold; background-color: white; padding: 3px;">First Name</label><br>
                        <input type="text" id="first_name" name="first_name" placeholder="First Name" style="margin-right: 87px;">
                    </td>
                    <td style="text-align: left;">
                        <label for="last_name" style="font-weight: bold; background-color: white; padding: 3px;">Last Name</label><br>
                        <input type="text" id="last_name" name="last_name" placeholder="Last Name">
                    </td>
                </tr>
                <tr height="30px"></tr>
                <tr>
                    <td style="text-align: left;">
                        <label for="email" style="font-weight: bold; background-color: white; padding: 3px;">Email Address</label><br>
                        <input type="text" id="email" name="email" placeholder="Email Address">
                    </td>
                    <td style="text-align: left;">
                        <label for="mobile" style="font-weight: bold; background-color: white; padding: 3px;">Mobile No.</label><br>
                        <input type="text" id="mobile" name="mobile" placeholder="Mobile No.">
                    </td>
                </tr>
                <tr height="30px"></tr>
                <tr>
                    <td style="text-align: left;">
                        <label for="sex" style="font-weight: bold; background-color: white; padding: 3px;">Gender</label><br>
                        <select id="sex" name="sex" style="width: 280px;">
                            <option value=""> -- Gender -- </option>
                            <option value="Male"> Male </option>
                            <option value="Female"> Female </option>
                            <option value="LGBTQ+"> LGBTQ+ </option>
                            <option value="Other"> Other </option>
                        </select>
                    </td>
                    <td style="text-align: left;">
                        <label for="doctor_schedule" style="font-weight: bold; background-color: white; padding: 3px;">Specific Doctor's Appointment?</label><br>
                        <select id="doctor_schedule" name="doctor_schedule" placeholder="Specific Doctor's Appointment?" style=" width: 280px;">
                            <option value=""> -- Select Doctor -- </option>
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
                        <label for="appointment_date" style="font-weight: bold; background-color: white; padding: 3px;">General Appointment Date and Time</label><br>
                        <input type="datetime-local" id="appointment_date" name="appointment_date" placeholder="General Appointment Date and Time" style="width: 275px; height: 38px;">
                    </td>
                    <td style="text-align: left;">
                        <label for="doctor_schedule_appointment_date" style="font-weight: bold; background-color: white; padding: 3px;">Doctor's Appointment Date and Time</label><br>
                        <input type="datetime-local" id="doctor_schedule_appointment_date" name="doctor_schedule_appointment_date" placeholder="Doctor's Appointment Date and Time" style="width: 275px; height: 38px;">
                    </td>
                </tr>
                <tr height="30px"></tr>
                <tr>
                    <td colspan="2" style="text-align: left;">
                        <label for="message" style="font-weight: bold; background-color: white; padding: 3px;">Message</label><br>
                        <textarea id="message" name="message" placeholder="Message"></textarea>
                    </td>
                <tr height="30px"></tr>
                <tr>
                    <td colspan="2"><button type="submit">SUBMIT</button></td>
                </tr>
                <tr height="30px"></tr>
                <tr>
                    <td colspan="2"><button type="button" onclick="window.location.href='update-appointment.php'">UPDATE APPOINTMENT</button></td>
                </tr>
                <tr height="30px"></tr>
                <tr>
                    <td colspan="2"><button type="button" onclick="window.open('https://calendly.com/doctors-schedules', '_blank')">VIEW DOCTOR'S CALENDLY SCHEDULES</button></td>
                </tr>
                <tr height="30px"></tr>
                <tr>
                    <td colspan="2"><button type="button" onclick="window.open('https://zoom.us/test', '_blank')">ONLINE CONSULTATION</button></td>
                </tr>
            </table>
        </form>
    </div>
</html>