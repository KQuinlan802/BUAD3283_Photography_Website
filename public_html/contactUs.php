<?php
echo"Book an Appointment";
?>
<!DOCTYPE html>
<head>
  <link rel="stylesheet" href="style.css">
  <title>Book an Appointment </title>
</head>
<body>
  <h1> Book your appointment now! </h1>
   <form action="endpoint.php" method="get" class="form">
  <fieldset>
<legend> Schedule today! </legend>
<div class="form-group"><label for="name">Name</label>
  <input type="text" name="name" value="" id="name" placeholder="Type Your Name"></div>
<div class="form-group"><label for="email">Email</label>
  <input type="email" name="email" value="" id="email" placeholder="Type Your Email Address"></div>
<div class="form-group"><label for="phone">Phone</label>
    <input type="phone" name="phone" value="" id="phone" placeholder="Type Your Phone Number"></div>
   
<div class="form-group"><label for="comment" class="label-textarea">Notes</label>
  <textarea id="comment" name="comment" rows="6" cols="30"></textarea></div>
 <div class="form-group"><label for="submit" class="hidden"></label>
   <input type="Submit" name="Submit" value="Submit" id="Submit" class="input-submit"></div>
</fieldset>
<fieldset>
  <legend> Order your prints! </legend>
</form>
<div class="container col-sm-6">
	<form action="endpoint.php">
		<div class="form-group">
			  <label>Payment amount</label>
			  <input id="PaymentAmount" class="form-control" type="text" ></input>
		</div>
		<div class="form-group">
			  <label>Name on card</label>
			  <input id="NameOnCard" class="form-control" type="text" placeholder="Name on Card"></input>
		</div>
		<div class="form-group">
			  <label>Card number</label>
			  <input id="CreditCardNumber" class="form-control" type="text"></input>
		</div>
		<div class="form-group">
			  <label>Expiration date</label>
			  <input id="ExpirationDate" class="form-control" type="text" placeholder="MM / YY" ></input>
		</div>
		<div class="form-group">
			  <label>Security code</label>
			  <input id="SecurityCode" class="form-control" type="text" ></input>
		</div>
		<div class="form-group">
			  <label>ZIP Code</label>
			  <input id="ZIPCode" class="form-control" type="text" ></input>
		</div>
			  <button id="PayButton" class="btn btn-block btn-success submit-button" type="submit">Pay</button>
	</form>
  </fieldset>
</div>
</body>
</html>
