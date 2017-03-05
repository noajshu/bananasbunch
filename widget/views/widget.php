<!-- This file is used to markup the public-facing widget. -->
this is a widget <h1>HI GUYS</h1>
<?php
echo "Today is " . date("Y/m/d") . "<br>";
echo "Today is " . date("Y.m.d") . "<br>";
echo "Today is " . date("Y-m-d") . "<br>";
echo "Today is " . date("l");

<form action="#complete_application" >
  <input type="text" name="client_name" id="client_name" placeholder="Client First Name"/>
  <input type="submit" name="create_appointment" value="Create Appointment" />
</form>
?>
