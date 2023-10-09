

<html>
    <body>
        
        <header>
            <h1>REGISTRATION FORM</h1>
            <nav><a href="dash.html">Home</a></nav>
        </header>
        <form action="" method = "post" onsubmit="return displayConfirmation()">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name"> <br>
            <label for="age">Age:</label>
            <input type="number" name="age" id="age"> <br>
            <label for="gender">Gender:</label>
            <select name="gender" id="gender">
                <option value="1">Male</option>
                <option value="2">Female</option>
                <option value="3">Other</option>
                <option value="4">Prefer not to say</option>
            </select><br>
            <label for="symptoms">Symptoms:</label>
            <input type="text" name="symptoms" id="symptoms"> <br>
            <label for="doctor">Doctor Name:</label>
            <select name="doctor" id="doctorSelect" onchange="generateTimeSlots()">
                <option value="1">Ramesh</option>
                <option value="2">Raghu</option>
                <option value="3">Ravi</option>
                <option value="4">Rashmika</option>
            </select>
            <br>
            <div id="timeSlotContainer">
                <!-- Time slots will be inserted here -->
            </div>
            <br>
            <input type="hidden" name="time" id="selectedTimeInput"> <!-- Hidden input field to store the selected time -->
        
            <input type="submit" name="Book an Appointment" value="Book an Appointment">
        </form>
        <script>
            function displayConfirmation() {
                alert("Appointment is booked!");
                return true; // To submit the form
            }
        </script>

    </body>
</html>