<?php
// Add this at the top of the file, before HTML
$closedGroupEvents = [
    'Firelesscooking',
    'Iplauction',
    'Lyricalhunt',
    'Dumpcharades',
    'Rangoli',
    'Sherlockholmes',
    'Freefire',
    'Treasurehunt'
    // Add more closed group events here
];

if (isset($_GET['event']) && in_array($_GET['event'], $closedGroupEvents)) {
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast/dist/css/iziToast.min.css">
</head>

<body>
    <div class="registration-container">
        <div class="brand-section">
            <h1>ORLIA'25</h1>
            <p>Join us for an incredible technical symposium experience at MKCE</p>
        </div>
        <div class="form-section">
            <div class="registration-form">
                <h2>ORLIA 2K25</h2>
                <form id="Groupform">
                    <div class="form-group">
                        <input type="text" id="TeamName" name="TeamName" placeholder="Team Name" required>
                    </div>
                    <div class="form-group">
                        <input type="text" id="fullName" name="fullName" placeholder="Team Leader Name" required>
                    </div>
                    <div class="form-group">
                        <input type="text" id="rollNumber" name="rollNumber" placeholder="Leader Roll Number" required>
                    </div>
                    <div class="form-group">
                        <input type="email" id="mailid" name="mailid" placeholder="Leader Mail Id" required>
                    </div>

                    <div class="form-group">
                        <select id="year" name="year" required>
                            <option value="" disabled selected>Select Year</option>
                            <option value="I year">I Year</option>
                            <option value="II year">II Year</option>
                            <option value="III year">III Year</option>
                            <option value="IV year">IV Year</option>
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
                        <?php if ($selectedDay)
                            echo "<input type='hidden' name='daySelection' value='$selectedDay'>"; ?>
                    </div>

                    <div class="form-group">
                        <select id="events" name="events" required <?php echo $selectedEvent ? 'disabled' : ''; ?>>
                            <option value="" disabled>Select Event</option>
                            <option value="<?php echo $selectedEvent; ?>"
                                <?php echo $selectedEvent ? 'selected' : ''; ?>><?php echo $selectedEvent; ?></option>
                        </select>
                        <?php if ($selectedEvent)
                            echo "<input type='hidden' name='events' value='$selectedEvent'>"; ?>
                    </div>

                    <div class="form-group">
                        <input type="number" id="teamMembersCount" name="teamMembersCount"
                            placeholder="Number of Team Members" min="1" max="15" required onchange="addTeamMembers()">
                    </div>
                    <div id="teamMembersContainer"></div>
                    <button type="submit" class="submit-btn">Register</button>
                </form>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const eventTeamSizes = {
            'Divideconquer': {
                min: 4,
                max: 5
            },
            'Firelesscooking': {
                min: 2,
                max: 2
            },
            'Trailertime': {
                min: 2,
                max: 2
            },
            'Iplauction': {
                min: 3,
                max: 3
            },
            'Lyricalhunt': {
                min: 2,
                max: 3
            },
            'Dumpcharades': {
                min: 2,
                max: 3
            },
            'Groupdance': {
                min: 6,
                max: 15
            },
            'Rangoli': {
                min: 3,
                max: 4
            },
            'Sherlockholmes': {
                min: 2,
                max: 3
            },
            'Freefire': {
                min: 4,
                max: 4
            },
            'Treasurehunt': {
                min: 3,
                max: 4
            },
            'Artfromwaste': {
                min: 2,
                max: 2
            },
            'Twindance': {
                min: 2,
                max: 2
            },

            'Vegetablefruitart': {
                min: 2,
                max: 2
            }
        };

        window.onload = function() {
            const selectedDay = '<?php echo $selectedDay; ?>';
            const selectedEvent = '<?php echo $selectedEvent; ?>';

            if (selectedDay && selectedEvent) {
                // Set day selection
                const daySelect = document.getElementById('daySelection');
                daySelect.value = selectedDay;
                daySelect.disabled = true;

                // Update events list
                updateEvents();

                // Set event and handle team members
                setTimeout(() => {
                    const eventsDropdown = document.getElementById('events');
                    for (let i = 0; i < eventsDropdown.options.length; i++) {
                        if (eventsDropdown.options[i].value === selectedEvent) {
                            eventsDropdown.selectedIndex = i;
                            eventsDropdown.disabled = true;

                            // Handle team size limits
                            if (eventTeamSizes[selectedEvent]) {
                                const teamMembersInput = document.getElementById('teamMembersCount');
                                const {
                                    min,
                                    max
                                } = eventTeamSizes[selectedEvent];
                                teamMembersInput.min = min - 1;
                                teamMembersInput.max = max - 1;
                                teamMembersInput.disabled = false;
                                teamMembersInput.placeholder = `Enter additional members (${min-1}-${max-1})`;
                                teamMembersInput.value = min - 1;
                                addTeamMembers();
                            }
                            break;
                        }
                    }
                }, 100);
            }
        };

        document.getElementById('events').addEventListener('change', function() {
            const selectedEvent = this.value;
            const teamMembersInput = document.getElementById('teamMembersCount');

            if (eventTeamSizes[selectedEvent]) {
                const {
                    min,
                    max
                } = eventTeamSizes[selectedEvent];
                // Subtract 1 from min and max since leader is counted separately
                teamMembersInput.min = min - 1;
                teamMembersInput.max = max - 1;
                teamMembersInput.disabled = false;
                teamMembersInput.placeholder = `Enter additional members (${min-1}-${max-1})`;

                if (teamMembersInput.value < min - 1 || teamMembersInput.value > max - 1) {
                    teamMembersInput.value = min - 1;
                }
                addTeamMembers();
            } else {
                teamMembersInput.disabled = true;
                teamMembersInput.placeholder = 'Select an event first';
                document.getElementById('teamMembersContainer').innerHTML = '';
            }
        });

        function addTeamMembers() {
            const count = parseInt(document.getElementById("teamMembersCount").value);
            const container = document.getElementById("teamMembersContainer");
            container.innerHTML = "";

            const selectedEvent = document.getElementById('events').value;
            const limits = eventTeamSizes[selectedEvent];

            // Add 1 to count to include the leader
            const totalCount = count + 1;

            if (limits && totalCount >= limits.min && totalCount <= limits.max) {
                // Display total team size including leader
                container.innerHTML =
                    `<div class="form-group"><p>Total team size (including leader): ${totalCount}</p></div>`;

                // Generate fields for additional members
                for (let i = 1; i <= count; i++) {
                    container.innerHTML += `
                        <div class="form-group">
                            <input type="text" name="memberName${i}" placeholder="Team Member ${i} Name" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="memberRoll${i}" placeholder="Team Member ${i} Roll Number" required>
                        </div>
                    `;
                }
            }
        }

        function updateEvents() {
            const daySelection = document.getElementById("daySelection");
            const eventsDropdown = document.getElementById("events");

            eventsDropdown.innerHTML = '<option value="" disabled selected>Select Event</option>';
            eventsDropdown.disabled = false;

            let eventList = [];

            if (daySelection.value === "day1") {
                eventList = [{
                        value: "Divideconquer",
                        text: "Divide conquer"
                    },
                    // {
                    //     value: "Firelesscooking",
                    //     text: "Fireless cooking"
                    // },


                    {
                        value: "Trailertime",
                        text: "Trailer Time"
                    },

                    // {
                    //     value: "Iplauction",
                    //     text: "Ipl Auction"
                    // },
                    // {
                    //     value: "Lyricalhunt",
                    //     text: "Lyrical Hunt"
                    // },
                    // {
                    //     value: "Dumpcharades",
                    //     text: "Dump Charades"
                    // },

                    {
                        value: "Groupdance",
                        text: "Group Dance"
                    },
                ];
            } else if (daySelection.value === "day2") {
                eventList = [
                    // {
                    //         value: "Rangoli",
                    //         text: "Rangoli"
                    //     },


                    //     {
                    //         value: "Sherlockholmes",
                    //         text: "Sherlock Holmes"
                    //     },

                    //     {
                    //         value: "Freefire",
                    //         text: "Free Fire"
                    //     },
                    // {
                    //     value: "Treasurehunt",
                    //     text: "Treasure Hunt"
                    // },

                    {
                        value: "Artfromwaste",
                        text: "Art From Waste"
                    },
                    {
                        value: "Twindance",
                        text: "Twin Dance"
                    },
                    {
                        value: "Mime",
                        text: "Mime"
                    },
                    {
                        value: "Vegetablefruitart",
                        text: "Vegetable Fruit Art"
                    },

                ];
            }

            eventList.forEach(event => {
                const option = document.createElement("option");
                option.value = event.value;
                option.textContent = event.text;
                eventsDropdown.appendChild(option);
            });
        }

        $(document).on('submit', '#Groupform', function(e) {
            console.log("Form submitted");
            e.preventDefault();
            var Formdata = new FormData(this);

            Formdata.append("groupnewuser", true);


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
                        $('#Groupform')[0].reset();
                        Swal.fire({
                            title: "Registered Successfully!",
                            text: "Your team has been registered for the event",
                            icon: "success",
                            confirmButtonColor: '#134e4a'
                        });
                    } else if (res.status == 500) {
                        $('#Groupform')[0].reset();
                        Swal.fire({
                            title: "Error!",
                            text: "Something went wrong, please try again",
                            icon: "error",
                            confirmButtonColor: '#134e4a'
                        });
                    }
                }
            });
        });
    </script>
</body>

</html>