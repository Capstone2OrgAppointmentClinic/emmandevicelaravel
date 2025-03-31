<div class="page-section">
    <div class="container">
    <h1 class="text-center wow fadeInUp mb-5" 
            style="color:color: #006400; font-size: 40px; font-weight: bold; text-transform: uppercase;">
            Make an Appointment
        </h1>
        <form class="main-form bg-light p-4 rounded shadow" action="{{url('appointment')}}" method="POST">
            @csrf

            <div class="row g-3">
    <!-- Date Selection -->
    <div class="col-12 col-md-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
        <label for="date" class="form-label">Select Date</label>
        <input type="date" id="date" name="date" class="form-control" required>
    </div>

    <!-- Time Selection -->
    <div class="col-12 col-md-6 py-2 wow fadeInRight" data-wow-delay="300ms">
        <label for="time" class="form-label">Select Time</label>
        <input type="time" id="time" name="time" class="form-control" required>
    </div>
</div>

<!-- Service Selection -->
<div class="row g-3 mt-3">
    <div class="col-12 col-md-6 py-2 wow fadeInRight" data-wow-delay="300ms">
        <label for="service" class="form-label">Select Service</label>
        <select name="service" id="service" class="form-control" required>
            <option value="" disabled selected>Select Service</option>
            <option value="Check-ups">Check-ups</option>
            <option value="Medicine">Medicine</option>
            <option value="Healthcare">Healthcare</option>
            <option value="Emergency Response">Emergency Response</option>
        </select>
    </div>
    <!-- Contact Number -->
    <div class="col-12 col-md-6 py-2 wow fadeInUp" data-wow-delay="300ms">
        <label for="number" class="form-label">Contact Number</label>
        <input type="text" id="number" name="number" class="form-control" placeholder="Enter your number..." required>
    </div>
</div>

<!-- Message -->
<div class="row g-3 mt-3">
    <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
        <label for="message" class="form-label">Purpose</label>
        <textarea name="message" id="message" class="form-control" rows="5" placeholder="Provide details about your request..." required></textarea>
    </div>
</div>

<!-- Submit Button -->
<div class="text-center mt-4 wow fadeInUp" data-wow-delay="300ms">
    <button type="submit" class="btn btn-success px-5 py-2">Submit Request</button>
</div>
</form>

        <script src="../assets/js/jquery-3.5.1.min.js"></script>
        <script src="../assets/js/bootstrap.bundle.min.js"></script>
        <script src="../assets/vendor/owl-carousel/js/owl.carousel.min.js"></script>
        <script src="../assets/vendor/wow/wow.min.js"></script>
        <script src="../assets/js/theme.js"></script>

<script>
        document.addEventListener("DOMContentLoaded", function () {
    let dateInput = document.querySelector("input[name='date']");
    let timeInput = document.querySelector("input[name='time']");
    let submitButton = document.querySelector("button[type='submit']");

    let today = new Date().toISOString().split('T')[0];
    dateInput.setAttribute("min", today);

    dateInput.addEventListener("change", function () {
        if (this.value < today) {
            alert("Select a valid date.");
            this.value = today;
        }
    });

    dateInput.addEventListener("change", function () {
        let selectedDate = this.value;

        if (selectedDate) {
            fetch(`/check-appointments?date=${selectedDate}`)
                .then(response => response.json())
                .then(data => {
                    if (data.count >= 5) {
                        alert("The limit of 5 appointments has been reached for this date.");
                        submitButton.disabled = true;
                    } else {
                        submitButton.disabled = false;
                    }
                })
                .catch(error => console.error("Error checking appointments:", error));
        }
    });

    const setTimeRange = () => {
        let options = [];
        for (let h = 8; h <= 20; h++) {
            for (let m = 0; m < 60; m += 30) {
                let hour = h < 10 ? "0" + h : h;
                let minute = m === 0 ? "00" : "30";
                options.push(`${hour}:${minute}`);
            }
        }
        timeInput.innerHTML = options.map(time => `<option value="${time}">${time}</option>`).join('');
    };

    setTimeRange();

    timeInput.addEventListener("change", function () {
        let selectedDate = dateInput.value;
        let selectedTime = timeInput.value;

        let timeParts = selectedTime.split(':');
        let hour = parseInt(timeParts[0], 10);
        
        if (hour < 8 || hour >= 20) {
            alert("Appointments can only scheduled between 8 AM and 8 PM.");
            timeInput.value = '';
            submitButton.disabled = true;
        } else {
            submitButton.disabled = false;

            if (selectedDate && selectedTime) {
                fetch(`/check-appointment-conflict?date=${selectedDate}&time=${selectedTime}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.conflict) {
                            alert("An appointment is already scheduled at this time. Please choose a different time.");
                            submitButton.disabled = true;
                        } else {
                            submitButton.disabled = false;
                        }
                    })
                    .catch(error => console.error("Error checking conflicts:", error));
            }
        }
    });

    const form = document.querySelector("form");
    form.addEventListener("submit", function () {
        submitButton.disabled = true;
        submitButton.innerText = "Processing...";
    });
});
</script>

    </div>
</div>
