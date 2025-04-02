
<x-guest-layout>
    <x-authentication-card class="">
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>
        
        <x-validation-errors class="mb-4" style="width: 50%;" />

        <form method="POST" action="{{ route('register') }}">
            @csrf


            <!-- Flex Container for Two Columns -->
            <div class="grid grid-cols-2 gap-4">

                <!-- Left Column -->
                <div>
                    <x-label for="name" value="Name" />
                    <x-input id="name" class="block mt-1 w-full" type="text" name="name"  required autofocus placeholder="Enter your full name"/>

                    <x-label for="student_id" value="Student ID" class="mt-4" />
                    <x-input id="student_id" class="block mt-1 w-full" type="text" name="student_id" required placeholder="Student ID"/>

                    <x-label for="email" value="Email" class="mt-4" />
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" required placeholder="Email Address"/>

                    <x-label for="phone" value="Phone" class="mt-4" />
                    <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" required required placeholder="Enter your phone number"/>

                    <x-label for="address" value="Address" class="mt-4" />
                    <x-input id="address" class="block mt-1 w-full" type="text" name="address" required placeholder="Enter your address"/>
                </div>


                <div >
                    <div id="course_container">
                    <x-label for="course" value="Course / Strand" />
                    <select id="course" name="course" class="block mt-1 w-full p-2 border rounded mb-4" required>
                    <option value="" disabled selected>Select Course / Strand</option>
                    <option value="bsit">Bachelor of Science in Information Technology</option>
                    <option value="bshm">Bachelor of Science in Hospitality Management</option>
                    <option value="beed">Bachelor of Elementary Education</option>
                    <option value="bsa">Bachelor of Science in Accountancy</option>
                    <option value="bsba">Bachelor of Science in Business Administration</option>
                    </select>
                 </div>


                    <x-label for="education_level" value="Education Level"/>
                    <select id="education_level" name="education_level" class="block mt-1 w-full p-2 border rounded" onchange="updateYearLevel()">
                        <option value="" disabled selected>Select grade level</option>
                        <option value="college">College</option>
                        <option value="senior_high">Senior High</option>
                        <option value="junior_high">Junior High</option>
                    </select>

                    <x-label for="year_level" value="Year Level" class="mt-4" />
                    <select id="year_level" name="year_level" class="block mt-1 w-full p-2 border rounded" required></select>

                    <x-label for="password" value="Password" class="mt-4" />
                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required placeholder="Password"/>

                    <x-label for="password_confirmation" value="Confirm Password" class="mt-4" />
                    <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required placeholder="Confirm your password"/>
                </div>
            </div>

            <!-- Terms & Conditions -->
            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
            <div class="mt-4">
        <x-label for="terms">
            <div class="flex items-center">
                <x-checkbox name="terms" id="terms" required />
                <span class="ml-2">
                    I agree to the
                    <a href="{{ route('terms.show') }}" class="underline text-sm text-blue-600 hover:text-blue-800">Terms of Service</a>
                    and
                    <a href="{{ route('policy.show') }}" class="underline text-sm text-blue-600 hover:text-blue-800">Privacy Policy</a>
                </span>
            </div>
        </x-label>
    </div>
  @endif


            <!-- Buttons -->
            <div class="flex items-center justify-between mt-4">
                <a class="text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">Already registered?</a>
                <x-button class="bg-green-600 hover:bg-[#AD1457] text-white px-2 py-2 rounded" style="font-size: 17px; padding: 18px; height: auto; font-family:Arial, Helvetica, sans-serif;">Register</x-button>
            </div>
        </form>
    </x-authentication-card>

    <script>
    function updateYearLevel() {
        const educationLevel = document.getElementById('education_level').value;
        const yearLevelSelect = document.getElementById('year_level');
        const courseContainer = document.getElementById('course_container');
        const courseSelect = document.getElementById('course');
       
        yearLevelSelect.innerHTML = "";
        courseSelect.innerHTML = `<option value="" disabled selected>Select Course / Strand</option>`;

        let yearOptions = [];
        let courseOptions = [];

        if (educationLevel === "college") {
            yearOptions = ["1st Year", "2nd Year", "3rd Year", "4th Year", "Extended Year"];
            courseOptions = [
                { value: "bsit", text: "Bachelor of Science in Information Technology" },
                { value: "bshm", text: "Bachelor of Science in Hospitality Management" },
                { value: "beed", text: "Bachelor of Elementary Education" },
                { value: "bsa", text: "Bachelor of Science in Accountancy" },
                { value: "bsba", text: "Bachelor of Science in Business Administration" }
            ];
            courseContainer.style.display = "block";
            courseSelect.required = true;

        } 
        else if (educationLevel === "senior_high") {
            yearOptions = ["Grade 11", "Grade 12"];
            courseOptions = [
                { value: "abm", text: "Accountancy, Business and Management (ABM)" },
                { value: "ict", text: "Information and Communications Technology (ICT)" },
                { value: "humss", text: "Humanities and Social Sciences (HUMSS)" }
            ];
            courseContainer.style.display = "block";
            courseSelect.required = true;
        } 
        else if (educationLevel === "junior_high") {
            yearOptions = ["Grade 7", "Grade 8", "Grade 9", "Grade 10"];
            courseContainer.style.display = "none";
            courseSelect.required = false;

        }

        
        yearOptions.forEach(level => {
            let optionElement = document.createElement("option");
            optionElement.value = level.toLowerCase().replace(" ", " ");
            optionElement.textContent = level;
            yearLevelSelect.appendChild(optionElement);
        });

       
        courseOptions.forEach(course => {
            let optionElement = document.createElement("option");
            optionElement.value = course.value;
            optionElement.textContent = course.text;
            courseSelect.appendChild(optionElement);
        });
    }

    document.addEventListener("DOMContentLoaded", updateYearLevel);
    </script>
</x-guest-layout>