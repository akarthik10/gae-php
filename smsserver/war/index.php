<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<title>IndyaRocks server v1.0</title>
	
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	
	<style media="screen" type="text/css">

	* {
	margin: 0;
	padding: 0;
}

body {
	font-size: 62.5%;
	font-family: Helvetica, sans-serif;
	background: url(http://smsserver-akarthik10.appspot.com/stripe.png) repeat;
}

p {
	font-size: 2.5em;
	margin-bottom: 15px;
}

#page-wrap {
	width: 265px;
	background: white;
	padding: 10px 30px 10px 30px;
	margin: 20px auto;
	min-height: 200px;
	height: auto !important;
	
}

#contact-area {
	width: 300px;
	margin-top: 25px;
}

#contact-area input, #contact-area textarea {
	padding: 5px;
	width: 250px;
	font-family: Helvetica, sans-serif;
	font-size: 1.4em;
	margin: 0px 0px 10px 0px;
	border: 2px solid #ccc;
}

#contact-area textarea {
	height: 90px;
}

#contact-area textarea:focus, #contact-area input:focus {
	border: 2px solid #900;
}

#contact-area input.submit-button {
	width: 100px;
	float: left;
}

label {
	float: left;
	text-align: left;
	margin-right: 15px;
	width: 100px;
	padding-bottom: 5px;
	font-size: 1.9em;
}

	</style>
</head>

<body>

	<div id="page-wrap">

		<p> IndyaRocks server v1.0</p>
		<div>[beta] powered by</div> <img src="https://ssl.gstatic.com/images/icons/product/app_engine-64.png">
				
		<div id="contact-area">
			
			<form method="post" action="http://smsserver-akarthik10.appspot.com/indyarocks.php">
				<label for="Username">Username:</label>
				<input type="text" name="user" id="user" />
				
				<label for="Password">Password:</label>
				<input type="password" name="pass" id="pass" />
	
				<label for="Numbers">Number:</label>
				<input type="text" name="num" id="num" />
				
				<label for="Message">Message:</label><br />
				<textarea name="msg" rows="20" cols="20" id="msg"></textarea>

				<input type="submit" name="submit" value="Send SMS" class="submit-button" />
			</form>
			
			
			
			<div style="clear: both;"></div>
			
		
		</div>
	
	</div>

</body>

</html>