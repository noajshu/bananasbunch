<!-- This file is used to markup the public-facing widget. -->
<form action="#complete_application" method="post" id="create_appointment_form" >
  <h3>Client Details</h3>
  <input type="text" name="client_name" id="client_name" placeholder="Client First Name"/>
  <input type="text" name="client_surname" id="client_surname" placeholder="Client Last Name" />
  <input type="email" name="client_email" id="client_email" placeholder="Client Email Address" />
  <input type="tel" name="client_phone" id="client_phone" placeholder="Client Phone Number" />
  <select name="client_language" id="client_language">
    <option value="en-us" selected> English </option>
    <option value="spa"> Spanish </option>
  </select>

  <h3>Counselor Details</h3>
  <input type="text" name="counselor_name" id="counselor_name" placeholder="Counselor First Name"/>
  <input type="text" name="counselor_surname" id="counselor_surname" placeholder="Counselor Last Name" />
  <input type="email" name="counselor_email" id="counselor_email" placeholder="Counselor Email Address" />
  <input type="tel" name="counselor_phone" id="counselor_phone" placeholder="Counselor Phone Number" />

  <h3>Appointment Details</h3>
  <input type="date" name="appointment_date" id="appointment_date" />
  <input type="time" name="appointment_time" id="appointment_time" />
  <p> Required Documents </p>
  <input type="checkbox" value="document1"> Document 1 </input>

  <input type="submit" name="create_appointment" value="Create Appointment" />
</form>
