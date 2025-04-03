<?php
// Add this at the top of the file, before HTML
$closedEvents = [
    'Drawing',
    'Mehandi',
    'Photography'
    // Add more closed events here
];

if (isset($_GET['event']) && in_array($_GET['event'], $closedEvents)) {
    echo "<script>
        alert('Registration for this event is closed. Please try other events.');
        window.location.href = 'index.html';
    </script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Orlia'25</title>
    <link rel="stylesheet" href="assets/styles/styles.css">
    <link rel="stylesheet" href="assets/styles/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">

</head>

<body>
    <div class="registration-container">
        <div class="brand-section">
            <div class="floating-circle"></div>
            <div class="floating-circle"></div>
            <div class="floating-circle"></div>
            <h1>ORLIA'25</h1>
            <p>Join us for an incredible technical symposium experience at MKCE</p>
        </div>
        <div class="form-section">
            <div class="floating-circle"></div>
            <div class="floating-circle"></div>
            <div class="registration-form">
                <h2>ORLIA 2K25</h2>
                <form id="registerForm">
                    <div class="form-group">
                        <input type="text" id="fullName" name="fullName" placeholder="Name" required>
                    </div>
                    <div class="form-group">
                        <input type="text" id="rollNumber" name="rollNumber" placeholder="Roll Number" required>
                    </div>
                    <div class="form-group">
                        <input type="email" id="mailid" name="mailid" placeholder="Mail Id" required>
                    </div>
                    <div class="form-group">

                        <select id="year" name="year" required>
                            <option value="" disabled selected>Select Year</option>
                            <option value="I year">I Year</option>
                            <option value="II year">II year</option>
                            <option value="III year">III year</option>
                            <option value="IV year">IV year</option>

                        </select>
                    </div>
                    <div class="form-group">
                        <input type="tel" id="phoneNumber" name="phoneNumber" placeholder="Phone Number" required>
                    </div>
                    <div class="form-group">
                        <select id="department" name="department" required>
                            <option value="" disabled selected>Select Department</option>
                            <option value="AIDS">Artificial Intelligence and Data Science</option>
                            <option value="AIML">Artificial Intelligence and Machine Learning</option>
                            <option value="CSE">Computer Science Engineering</option>
                            <option value="CSBS">Computer Science And Business Systems</option>
                            <option value="ECE">Electronics & Communication Engineering</option>
                            <option value="EEE">Electrical & Electronics Engineering</option>
                            <option value="MECH">Mechanical Engineering</option>
                            <option value="CIVIL">Civil Engineering</option>
                            <option value="IT">Information Technology</option>
                            <option value="VLSI">Electronics Engineering (VLSI Design)</option>
                            <option value="MCA">Master Of Computer Applications</option>
                            <option value="MBA">Master of Business Administration</option>
                        </select>
                    </div>

                    <?php
                    $selectedDay = isset($_GET['day']) ? $_GET['day'] : '';
                    $selectedEvent = isset($_GET['event']) ? $_GET['event'] : '';
                    ?>

                    <div class="form-group">
                        <select id="daySelection" name="daySelection" required onchange="updateEvents()"
                            <?php echo $selectedDay ? 'disabled' : ''; ?>>
                            <option value="" disabled>Select Day</option>
                            <option value="day1" <?php echo ($selectedDay == 'day1') ? 'selected' : ''; ?>>Day 1
                            </option>
                            <option value="day2" <?php echo ($selectedDay == 'day2') ? 'selected' : ''; ?>>Day 2
                            </option>
                        </select>
                        <?php if ($selectedDay) echo "<input type='hidden' name='daySelection' value='$selectedDay'>"; ?>
                    </div>

                    <div class="form-group">
                        <select id="events" name="events" required <?php echo $selectedEvent ? 'disabled' : ''; ?>>
                            <option value="" disabled selected>Select Event</option>
                        </select>
                        <?php if ($selectedEvent) echo "<input type='hidden' name='events' value='$selectedEvent'>"; ?>
                    </div>

                    <button type="submit" class="submit-btn">Register</button>
                    <div class="event-footer">
                        <div class="event-location">
                            <i class="ri-map-pin-line"></i>
                            <span>MKCE</span>
                        </div>
                        <a href="index.html" class="event-btn">Home</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="assets/script/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).on('submit', '#registerForm', function(e) {
            e.preventDefault();
            var Formdata = new FormData(this);
            Formdata.append("Add_newuser", true);
            console.log(Formdata)
            $.ajax({
                url: "backend.php",
                method: "POST",
                data: Formdata,
                processData: false,
                contentType: false,
                success: function(response) {
                    var res = jQuery.parseJSON(response);
                    console.log(res);
                    if (res.status == 200) {
                        $('#registerForm')[0].reset();
                        Swal.fire({
                            title: "Good job!",
                            text: "You Register for the Events",
                            icon: "success"
                        });
                    } else if (res.status == 500) {
                        $('#registerForm')[0].reset();
                        console.error("Error:", res.message);
                        alert("Something Went wrong.! try again")
                    }
                }
            });
        });

        function updateEvents() {
            const daySelection = document.getElementById("daySelection");
            const eventsDropdown = document.getElementById("events");

            eventsDropdown.innerHTML = '<option value="" disabled selected>Select Event</option>';
            eventsDropdown.disabled = false;

            let eventList = [];

            if (daySelection.value === "day1") {
                eventList = [{
                        value: "Tamilspeech",
                        text: "Tamil Speech"
                    },
                    {
                        value: "Englishspeech",
                        text: "English Speech"
                    },
                    {
                        value: "Singing",
                        text: "Singing"
                    },
                    // {
                    //     value: "Drawing",
                    //     text: "Drawing"
                    // },
                    // {
                    //     value: "Mehandi",
                    //     text: "Mehandi"
                    // },
                    {
                        value: "Memecreation",
                        text: "Meme Creation"
                    },
                    {
                        value: "Solodance",
                        text: "Solo Dance"
                    }
                ];
            } else if (daySelection.value === "day2") {
                eventList = [
                    // {
                    //     value: "Photography",
                    //     text: "Photography"
                    // },
                    {
                        value: "Shortflim",
                        text: "Shortflim"
                    },
                    {
                        value: "Bestmanager",
                        text: "Best Manager"
                    },
                    {
                        value: "Instrumentalplaying",
                        text: "Instrumental Playing"
                    },
                    {
                        value: "Mime",
                        text: "Mime"
                    },
                    {
                        value: "Rjvj",
                        text: "Rj/vj Hunt"
                    }
                ];
            }

            eventList.forEach(event => {
                const option = document.createElement("option");
                option.value = event.value;
                option.textContent = event.text;
                eventsDropdown.appendChild(option);
            });
        }

        window.onload = function() {
            const selectedDay = '<?php echo $selectedDay; ?>';
            const selectedEvent = '<?php echo $selectedEvent; ?>';

            if (selectedDay) {
                const daySelect = document.getElementById('daySelection');
                daySelect.value = selectedDay;
                daySelect.disabled = true;

                updateEvents();

                if (selectedEvent) {
                    setTimeout(() => {
                        const eventsDropdown = document.getElementById('events');
                        for (let i = 0; i < eventsDropdown.options.length; i++) {
                            if (eventsDropdown.options[i].value === selectedEvent) {
                                eventsDropdown.selectedIndex = i;
                                eventsDropdown.disabled = true;
                                break;
                            }
                        }
                    }, 100);
                }
            }
        };
    </script>
</body>

</html>