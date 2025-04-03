<?php
session_start();
include('db.php'); // Include the database connection file  
if (!isset($_SESSION['username'])) {
    header("Location: coordinator.php");
    exit();
}
$userid = $_SESSION['username'];
$groupEvents = [
    'Divideconquer',
    'Firelesscooking',
    'Trailertime',
    'Iplauction',
    'Lyricalhunt',
    'Dumpcharades',
    'Groupdance',
    'Rangoli',
    'Sherlockholmes',
    'Freefire',
    'Treasurehunt',
    'Artfromwaste',
    'Twindance',
    'Mime',
    'Vegetablefruitart',
];

// Add these database queries before using $result1
if (in_array($userid, $groupEvents)) {
    $sql1 = "SELECT * FROM groupevents WHERE events='$userid'";
} else {
    $sql1 = "SELECT * FROM events WHERE events='$userid'";
}
$result1 = mysqli_query($conn, $sql1);

if (!$result1) {
    die("Query failed: " . mysqli_error($conn));
}

// Update the PHP function to better format the data
function getEventData($conn, $userid, $groupEvents)
{
    if (in_array($userid, $groupEvents)) {
        $sql = "SELECT * FROM groupevents WHERE events='$userid' ORDER BY id";
        $result = mysqli_query($conn, $sql);
        $data = array();
        while ($row = mysqli_fetch_assoc($result)) {
            // Format team members data
            if ($row['tmembername']) {
                $members = json_decode($row['tmembername'], true);
                $membersList = array();
                foreach ($members as $member) {
                    $membersList[] = $member['name'] . ' / ' . $member['roll'];
                }
                $row['Team_Members'] = implode(', ', $membersList);
            }
            // Format phone number
            $row['phoneno'] = sprintf('%s', $row['phoneno']);
            $data[] = $row;
        }
    } else {
        $sql = "SELECT * FROM events WHERE events='$userid' ORDER BY id";
        $result = mysqli_query($conn, $sql);
        $data = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $row['phoneno'] = sprintf('%s', $row['phoneno']);
            $data[] = $row;
        }
    }
    return $data; // Return array instead of JSON
}

$eventData = getEventData($conn, $userid, $groupEvents);

// Add this before closing PHP tag
echo "<script>const eventData = " . json_encode($eventData) . ";</script>";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orlia Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/styles/admin.css">
    <style>
        .download-btn {
            float: right;
            margin: 20px;
            padding: 10px 20px;
            background: #134e4a;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: background 0.3s;
        }

        .download-btn:hover {
            background: #0d3d3b;
        }
    </style>
</head>

<body>
    <aside class="sidebar">
        <h2><i class="ri-theatre-line"></i> Orlia</h2>
        <ul class="sidebar-nav">
            <li><a href="dashboard.php"><i class="ri-mic-2-line"></i> Dashboard</a></li>
            <li><a href="#" class="active"><i class="ri-group-2-line"></i> Participants</a></li>
        </ul>
    </aside>

    <div class="main-content">
        <header class="navbar">
            <h1>Event Participants</h1>
            <div class="nav-right">
                <div class="notification">
                    <i class="ri-music-2-line"></i>
                </div>
                <div class="profile-dropdown">
                    <div class="profile">
                        <i class="ri-user-3-line"></i>
                        <span><?php echo $userid ?></span>
                    </div>
                    <div class="dropdown-menu">
                        <a href="logout.php"><i class="ri-logout-box-r-line"></i> Logout</a>
                    </div>
                </div>
            </div>
        </header>

        <main class="dashboard-grid">
            <div class="table-container">
                <button id="downloadExcel" class="download-btn">
                    <i class="ri-file-excel-2-line"></i> Download Excel Report
                </button>
                <?php if (!in_array($userid, $groupEvents)) { ?>
                    <table id="usersTable" class="display">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Name</th>
                                <th>Register Number</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Year</th>
                                <th>Department</th>
                                <th>Event Name</th>
                                <th>Event Day</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $s = 1;
                            while ($row = mysqli_fetch_array($result1)) {
                            ?>
                                <tr>
                                    <td><?php echo $s; ?></td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['regno']; ?></td>
                                    <td><?php echo $row['mail']; ?></td>
                                    <td><?php echo $row['phoneno']; ?></td>
                                    <td><?php echo $row['year']; ?></td>
                                    <td><?php echo $row['dept']; ?></td>
                                    <td><?php echo $row['events']; ?></td>
                                    <td><?php echo $row['day']; ?></td>
                                </tr>
                            <?php
                                $s++;
                            }
                            ?>
                        </tbody>
                    </table>

                <?php } else { ?>

                    <table id="usersTable" class="display">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Team Name</th>
                                <th>Leader Name/Roll No</th>
                                <th>LeaderEmail/Phone</th>
                                <th>Team Members/RollNo</th>

                                <th>Year</th>
                                <th>Department</th>
                                <th>Event Name</th>
                                <th>Event Day</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $s = 1;
                            while ($row = mysqli_fetch_array($result1)) {

                            ?>
                                <tr>
                                    <td><?php echo $s ?></td>
                                    <td><?php echo $row['teamname'] ?></td>
                                    <td><?php echo $row['teamleadname'] . ' / ' . $row['tregno'] ?></td>
                                    <td><?php echo $row['temail'] . ' / ' . $row['phoneno'] ?></td>
                                    <td>
                                        <?php
                                        $teamMembers = json_decode($row['tmembername'], true); // Decode JSON
                                        if (!empty($teamMembers)) {
                                            foreach ($teamMembers as $member) {
                                                echo $member['name'] . " / " . $member['roll'] . "<br>"; // Format: Name (Roll No)
                                            }
                                        } else {
                                            echo "No team members"; // Fallback if JSON is empty
                                        }
                                        ?>
                                    </td>


                                    <td><?php echo $row['year'] ?></td>
                                    <td><?php echo $row['dept'] ?></td>
                                    <td><?php echo $row['events'] ?></td>
                                    <td><?php echo $row['day'] ?></td>
                                </tr>
                            <?php
                                $s++;
                            }
                            ?>
                        </tbody>
                    </table>
                <?php } ?>
            </div>
        </main>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#usersTable').DataTable({
                pageLength: 10,
                responsive: true,
                order: [
                    [0, 'asc']
                ],
                language: {
                    search: "🔍 Search participants:",
                    lengthMenu: "Display _MENU_ participants per page",
                    info: "Showing _START_ to _END_ of _TOTAL_ participants",
                    paginate: {
                        first: "First",
                        last: "Last",
                        next: "Next →",
                        previous: "← Previous"
                    }
                },
                dom: '<"top"lf>rt<"bottom"ip><"clear">'
            });

            $('#downloadExcel').click(function() {
                const data = <?php echo json_encode($eventData); ?>;
                if (!data || data.length === 0) {
                    alert('No data available to download');
                    return;
                }

                try {
                    let ws = XLSX.utils.json_to_sheet(data);
                    let wb = XLSX.utils.book_new();

                    // Set column widths
                    ws['!cols'] = [{
                            wch: 5
                        }, // S.No
                        {
                            wch: 20
                        }, // Name/Team Name
                        {
                            wch: 15
                        }, // Regno/Leader
                        {
                            wch: 25
                        }, // Email
                        {
                            wch: 15
                        }, // Phone
                        {
                            wch: 40
                        }, // Team Members (if group)
                        {
                            wch: 10
                        }, // Year
                        {
                            wch: 15
                        }, // Dept
                        {
                            wch: 20
                        }, // Event
                        {
                            wch: 10
                        } // Day
                    ];

                    XLSX.utils.book_append_sheet(wb, ws, "Event Participants");
                    XLSX.writeFile(wb, "<?php echo $userid ?>_Participants_" + new Date().toISOString().slice(0, 10) + ".xlsx");
                } catch (error) {
                    console.error('Excel generation error:', error);
                    alert('Error generating Excel file. Please try again.');
                }
            });
        });

        document.querySelector('.profile').addEventListener('click', function() {
            document.querySelector('.dropdown-menu').classList.toggle('show');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            if (!event.target.closest('.profile-dropdown')) {
                document.querySelector('.dropdown-menu').classList.remove('show');
            }
        });
    </script>
</body>

</html>