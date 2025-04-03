<?php
session_start();
include('db.php'); // Include the database connection file  
if (!isset($_SESSION['username'])) {
    header("Location: coordinator.php");
    exit();
}
$userid = $_SESSION['username'];
$sql1 = "SELECT * FROM events";
$result1 = mysqli_query($conn, $sql1);

$sql2 = "SELECT * FROM groupevents";
// echo $sql2;
$result2 = mysqli_query($conn, $sql2);

function getSoloEventsData($conn)
{
    $sql = "SELECT name, regno, mail, phoneno, year, dept, events, day FROM events ORDER BY id";
    $result = mysqli_query($conn, $sql);
    $data = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    return json_encode($data);
}

function getGroupEventsData($conn)
{
    $sql = "SELECT teamname, teamleadname, tregno, temail, phoneno, tmembername, year, dept, events, day FROM groupevents ORDER BY id";
    $result = mysqli_query($conn, $sql);
    $data = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    return json_encode($data);
}

echo "<script>const soloEventsData = " . getSoloEventsData($conn) . ";</script>";
echo "<script>const groupEventsData = " . getGroupEventsData($conn) . ";</script>";
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
    <link rel="stylesheet" href="assets/styles/admin.css">
    <style>
        .event-tabs {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .tab-button {
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            background: #ddd;
            font-weight: bold;
        }

        .tab-button.active {
            background: #007bff;
            color: white;
        }

        .hidden {
            display: none;
        }

        /* Add these dropdown styles */
        .profile-dropdown {
            position: relative;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            right: 0;
            top: 100%;
            background: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            border-radius: 4px;
            min-width: 150px;
            z-index: 1000;
        }

        .dropdown-menu.show {
            display: block;
        }

        .dropdown-menu a {
            display: block;
            padding: 10px 15px;
            color: #333;
            text-decoration: none;
        }

        .dropdown-menu a:hover {
            background: #f5f5f5;
        }

        .button-container {
            display: flex;
            justify-content: flex-end;
            margin: 20px 0;
            padding-right: 20px;
        }

        .download-btn {
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
            <li><a href="overdashboard.php"><i class="ri-mic-2-line"></i> Dashboard</a></li>
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


        <nav class="event-tabs" style="margin-top: 50px;">
            <button class="tab-button active" data-target="soloTable">Solo Events</button>
            <button class="tab-button" data-target="groupTable">Group Events</button>
        </nav>

        <div class="table-container">

            <div id="soloTableDiv">
                <div class="button-container">
                    <button id="downloadSoloExcel" class="download-btn">
                        <i class="ri-file-excel-2-line"></i>
                        Download Solo Events
                    </button>
                </div>
                <table id="soloTable" class="display event-table">
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
                                <td><?php echo $s ?></td>
                                <td><?php echo $row['name'] ?></td>
                                <td><?php echo $row['regno'] ?></td>
                                <td><?php echo $row['mail'] ?></td>
                                <td><?php echo $row['phoneno'] ?></td>
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
            </div>


            <div id="groupTableDiv" style="display: none;">
                <div class="button-container">
                    <button id="downloadGroupExcel" class="download-btn">
                        <i class="ri-file-excel-2-line"></i>
                        Download Group Events
                    </button>
                </div>
                <table id="groupTable" class="display event-table">
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
                        while ($row = mysqli_fetch_array($result2)) {

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
                                        echo "No team members";
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
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize DataTables for both tables
            const soloTable = $('#soloTable').DataTable();
            const groupTable = $('#groupTable').DataTable();

            // Tab switching logic
            $('.tab-button').click(function() {
                var targetTable = $(this).data('target');

                // Update button states
                $('.tab-button').removeClass('active');
                $(this).addClass('active');

                // Hide all table divs
                $('#soloTableDiv, #groupTableDiv').hide();

                // Show selected table div
                if (targetTable === 'soloTable') {
                    $('#soloTableDiv').show();
                    soloTable.columns.adjust();
                } else {
                    $('#groupTableDiv').show();
                    groupTable.columns.adjust();
                }
            });

            // Show solo table by default
            $('#soloTableDiv').show();
            $('#groupTableDiv').hide();

            // Add this dropdown toggle code
            $('.profile').on('click', function(e) {
                e.stopPropagation();
                $('.dropdown-menu').toggleClass('show');
            });

            // Close dropdown when clicking outside
            $(document).on('click', function(e) {
                if (!$(e.target).closest('.profile-dropdown').length) {
                    $('.dropdown-menu').removeClass('show');
                }
            });

            // Excel download handlers
            $('#downloadSoloExcel').click(function() {
                // Create worksheet from database data
                let ws = XLSX.utils.json_to_sheet(soloEventsData);
                let wb = XLSX.utils.book_new();

                // Format phone numbers
                const range = XLSX.utils.decode_range(ws['!ref']);
                const phoneColIndex = 3; // Index of phone number column in data

                for (let R = range.s.r + 1; R <= range.e.r; ++R) {
                    const cellRef = XLSX.utils.encode_cell({
                        r: R,
                        c: phoneColIndex
                    });
                    if (ws[cellRef]) {
                        ws[cellRef].t = 's';
                        ws[cellRef].z = '@';
                    }
                }

                XLSX.utils.book_append_sheet(wb, ws, "Solo Events");
                XLSX.writeFile(wb, "Solo_Events_" + new Date().toISOString().slice(0, 10) + ".xlsx");
            });

            $('#downloadGroupExcel').click(function() {
                // Process team members data
                const processedData = groupEventsData.map(row => {
                    let teamMembers = '';
                    if (row.tmembername) {
                        const members = JSON.parse(row.tmembername);
                        teamMembers = members.map(m => `${m.name} / ${m.roll}`).join(', ');
                    }
                    return {
                        ...row,
                        tmembername: teamMembers
                    };
                });

                let ws = XLSX.utils.json_to_sheet(processedData);
                let wb = XLSX.utils.book_new();

                // Format phone numbers
                const range = XLSX.utils.decode_range(ws['!ref']);
                const phoneColIndex = 4; // Index of phone number column in data

                for (let R = range.s.r + 1; R <= range.e.r; ++R) {
                    const cellRef = XLSX.utils.encode_cell({
                        r: R,
                        c: phoneColIndex
                    });
                    if (ws[cellRef]) {
                        ws[cellRef].t = 's';
                        ws[cellRef].z = '@';
                    }
                }

                XLSX.utils.book_append_sheet(wb, ws, "Group Events");
                XLSX.writeFile(wb, "Group_Events_" + new Date().toISOString().slice(0, 10) + ".xlsx");
            });
        });
    </script>
    <script>
        document.getElementById('downloadExcel').addEventListener('click', function() {
            let table = document.getElementById("usersTable");
            let eventName = <?php echo json_encode($userid); ?>;

            // Convert table data to worksheet with custom formatting
            let ws = XLSX.utils.table_to_sheet(table);

            // Get the range of the worksheet
            const range = XLSX.utils.decode_range(ws['!ref']);

            // Find the phone number column index (4 for individual events, 3 for group events)
            const phoneColIndex = <?php echo !in_array($userid, $groupEvents) ? '4' : '3' ?>;

            // Format phone numbers as text for each row
            for (let R = range.s.r + 1; R <= range.e.r; ++R) {
                const cellRef = XLSX.utils.encode_cell({
                    r: R,
                    c: phoneColIndex
                });
                if (ws[cellRef]) {
                    ws[cellRef].t = 's'; // Set cell type as string
                    ws[cellRef].z = '@'; // Format as text
                }
            }

            let workbook = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(workbook, ws, "Participants");
            XLSX.writeFile(workbook, eventName + ".xlsx");
        });
    </script>
</body>

</html>