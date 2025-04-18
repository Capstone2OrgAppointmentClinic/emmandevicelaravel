
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
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
                    <input type="tel" id="number" name="number" class="form-control" value="+63" maxlength="13" required 
                      oninput="ensurePhoneNumberFormat(this)" onkeydown="preventPrefixDeletion(event, this)">
                    <div id="phone-warning" style="color: red; display: none;">Enter valid number it must start with 9 followed by 9 digits.</div>
                    <div id="phone-error" style="color: red; display: none;">Contact number must contains number only.</div>
                </div>
            </div>

<script>
function ensurePhoneNumberFormat(input) {
    const warningMessage = document.getElementById('phone-warning');
    const errorMessage = document.getElementById('phone-error');
    const regex = /^\+63[9]\d{9}$/;
    
    const invalidCharacterRegex = /[^0-9+]/g;
    if (invalidCharacterRegex.test(input.value)) {
        errorMessage.style.display = 'block';
        warningMessage.style.display = 'none';
    } else {
        errorMessage.style.display = 'none';
        if (input.value.length > 3 && !regex.test(input.value)) {
            warningMessage.style.display = 'block';
        } else {
            warningMessage.style.display = 'none';
        }
    }

    if (input.value.length > 13) {
        input.value = input.value.slice(0, 13);
    }
}

function preventPrefixDeletion(event, input) {
    const prefixLength = 3;
    if (input.selectionStart <= prefixLength && (event.key === 'Backspace' || event.key === 'Delete')) {
        event.preventDefault();
        input.value = '+63' + input.value.slice(3);
    }
}
</script>

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
        } else {
            let selectedDate = new Date(this.value);
            let dayOfWeek = selectedDate.getDay();
            if (dayOfWeek === 0 || dayOfWeek === 6) {
                alert("Appointments can only be scheduled from Monday to Friday.");
                this.value = today;
            }
        }

        let selectedDate = this.value;
        if (selectedDate) {
            fetch(`/check-appointment-limit?date=${selectedDate}`)
                .then(response => response.json())
                .then(data => {
                    if (data.appointmentLimit) {
                        alert("The maximum 5 appointments of this day has been reach.");
                        submitButton.disabled = true;
                    } else {
                        submitButton.disabled = false;
                    }
                })
                .catch(error => console.error("Error checking appointment limit:", error));

            fetch(`/check-weekly-user-appointments?date=${selectedDate}`)
                .then(response => response.json())
                .then(data => {
                    if (data.count >= 3) {
                        alert("You can only make 3 appointments per week.");
                        submitButton.disabled = true;
                    } else {
                        submitButton.disabled = false;
                    }
                })
                .catch(error => console.error("Error checking weekly appointments:", error));
        }
    });

    const setTimeRange = () => {
        let options = [];
        for (let h = 8; h <= 11; h++) {
            for (let m = 0; m < 60; m += 30) {
                if (h === 11 && m > 30) break;
                let hour = h < 10 ? "0" + h : h;
                let minute = m === 0 ? "00" : "30";
                options.push(`${hour}:${minute}`);
            }
        }
        for (let h = 13; h <= 17; h++) {
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

        let [hour, minute] = selectedTime.split(':').map(Number);

        if (hour === 12) {
            alert("Appointments cannot be scheduled between 12PM to 1PM it's lunch break.");
            timeInput.value = '';
            submitButton.disabled = true;
        } else if (hour < 8 || (hour === 11 && minute > 30) || hour > 17) {
            alert("Appointments must be between 8AM to 11:30 AM or 1PM to 5PM.");
            timeInput.value = '';
            submitButton.disabled = true;
        } else {
            fetch(`/check-appointment-conflict?date=${selectedDate}&time=${selectedTime}`)
            .then(response => response.json())
            .then(data => {
                if (data.conflict) {
                    alert(`student has made an appointment at this time ${data.start_time} - ${data.end_time}`);
                    submitButton.disabled = true;
                } else {
                    submitButton.disabled = false;
                }
            })
            .catch(error => console.error("Error checking conflicts:", error));
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
