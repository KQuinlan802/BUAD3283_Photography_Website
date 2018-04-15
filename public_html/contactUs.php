<?php
echo"Book an Appointment";
?>
<head>
  <link rel="stylesheet" href="style.css">
  <title>Book an Appointment </title>
</head>
<body>
  <h1 style="text-align:center;"> Book your appointment now! </h1>
   <form action="endpoint.php" method="get" class="form">
  <fieldset>
<legend> Schedule today! </legend>
<div class="form-group"><label for="name">Name</label>
  <input type="text" name="name" value="" id="name" placeholder="Type Your Name"></div>
<div class="form-group"><label for="email">Email</label>
  <input type="email" name="email" value="" id="email" placeholder="Type Your Email Address"></div>
<div class="form-group"><label for="phone">Phone</label>
    <input type="phone" name="phone" value="" id="phone" placeholder="Type Your Phone Number"></div>
<div <p class="fallbackLabel">Choose a date and time for your photo session:</p>
      <div class="fallbackDateTimePicker">
        <div>
          <span>
            <label for="day">Day:</label>
            <select id="day" name="day">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
          </span>
          <span>
            <label for="month">Month:</label>
            <select id="month" name="month">
              <option selected>January</option>
              <option>February</option>
              <option>March</option>
              <option>April</option>
              <option>May</option>
              <option>June</option>
              <option>July</option>
              <option>August</option>
              <option>September</option>
              <option>October</option>
              <option>November</option>
              <option>December</option>
            </select>
          </span>
          <span>
            <label for="year">Year:</label>
            <select id="year" name="year">
              <option>2018</option>
              <option>2019</option>
              <option>2020</option>
            </select>
          </span>
        </div>
        <div>
          <span>
            <label for="hour">Hour:</label>
            <select id="hour" name="hour">
              <option>10am</option><option>11am</option><option>Noon</option><option>1pm</option><option>2pm</option>
            </select>
          </span>
          <span>
            <label for="minute">Minute:</label>
            <select id="minute" name="minute">
              <option>15</option><option>30</option><option>45</option>
            </select>
          </span>
        </div>
      </div>
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
			  <label>Select your print size</label>
    <select>
  <option value="5x7">5x7</option>
  <option value="4x8">4x8</option>
  <option value="8x11">8x11</option>
</select>
		</div>
    <div class="form-group">
			  <label>How many prints?</label>
			  <input id="amountOfPrints" class="form-control" type="text" ></input>
		</div>
    <div class="form-group">
			  <label>Total</label>
			  <input id="TotalforPrints" class="form-control" type="text" ></input>
		</div>
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
			  <button id="PayButton" class="btn btn-block btn-success submit-button" type="submit">Submit Order</button>
	</form>
  </fieldset>
</div>
</body>
</html>
