<?php

session_start();
include('db.php'); // Include the database connection file  
if (!isset($_SESSION['username'])) {
    header("Location: coordinator.php");
    exit();
}
$userid = $_SESSION['username'];
$sql = "SELECT * FROM login WHERE role IN (0, 1)";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orlia Super Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/styles/admin.css">
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        table.dataTable {
            width: 100%;
            margin: 30px 0;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .dataTables_wrapper {
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);
        }

        table.dataTable thead th {
            padding: 15px 10px;
            background: #134e4a;
            /* Changed to match navbar color */
            color: white;
            /* Changed to white for better contrast */
            font-weight: 600;
            border-bottom: 2px solid #134e4a;
            /* Darker shade for border */
        }

        table.dataTable tbody td {
            padding: 12px 10px;
            border-bottom: 1px solid #eee;
        }

        table.dataTable tbody tr:hover {
            background-color: #f5f5f5;
        }

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
        <h2>Orlia</h2>
        <ul class="sidebar-nav">
            <li><a href="superadmin.php"><i class="ri-dashboard-line"></i> Super Dashboard</a></li>
            <li><a href="admins.php" class="active"><i class="ri-admin-line"></i> Manage Admins</a></li>
            <li><a href="events.php"><i class="ri-calendar-event-line"></i> Events</a></li>
        </ul>
    </aside>

    <div class="main-content">
        <header class="navbar">
            <h1>Orlia'25</h1>
            <div class="nav-right">
                <div class="notification">
                    <i class="ri-notification-3-line"></i>
                    <span class="badge">5</span>
                </div>
                <div class="profile-dropdown">
                    <div class="profile">
                        <i class="ri-shield-user-line"></i>
                        <span><?php echo $userid ?></span>
                    </div>
                    <div class="dropdown-menu">

                        <a href="logout.php"><i class="ri-logout-box-r-line"></i> Logout</a>
                    </div>
                </div>
            </div>
        </header>
        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addmodal">Add new user</button>
        <button id="downloadExcel" class="download-btn">
            <i class="ri-file-excel-2-line"></i>
            Download Excel Reports
        </button>
        <table id="usersTable" class="display">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>userid</th>
                    <th>password</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $s = 1;
                while ($row = mysqli_fetch_array($result)) {
                ?>
                    <tr>
                        <td><?php echo $s ?></td>
                        <td><?php echo $row['userid'] ?></td>
                        <td><?php echo $row['password'] ?></td>
                        <td>
                            <button type="button" class="btn btn-danger btndelete" value="<?php echo $row['id']; ?>">Delete user</button>
                            <button type="button" class="btn btn-warning btnedit" value="<?php echo $row['id']; ?>">Edit user</button>
                        </td>

                    </tr>
                <?php
                    $s++;
                }
                ?>
            </tbody>
        </table>
        <div class="modal fade" id="addmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="Adduser">
                        <div class="modal-body">
                            <label for="userid">Userid</label><br>
                            <input type="text" id="userid" name="userid" class="form-control" placeholder="Enter your Userid" required><br>

                            <label for="password">Password</label><br>
                            <input type="text" id="password" name="password" class="form-control" placeholder="Enter your password" required><br>

                            <label for="role">Role</label><br>
                            <input type="role" id="role" name="role" class="form-control" placeholder="Enter your Role" required><br>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="Editusers" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="Editnewuser">
                        <div class="modal-body">
                            <input type="hidden" name="id" id="id" required>
                            <label for="Userid">Userid</label><br>
                            <input type="text" id="Userid" name="userid" class="form-control" placeholder="Enter your Userid" required><br>

                            <label for="Password">Password</label><br>
                            <input type="text" id="Password" name="password" class="form-control" placeholder="Enter your password" required><br>

                            <label for="Role">Role</label><br>
                            <input type="role" id="Role" name="role" class="form-control" placeholder="Enter your Role" required><br>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

    <script>
        $(document).ready(function() {
            let table = $('#usersTable').DataTable({
                pageLength: 10,
                responsive: true,
                order: [
                    [0, 'asc']
                ],
                language: {
                    search: "🔍 Search admins:",
                    lengthMenu: "Display _MENU_ admins per page",
                    info: "Showing _START_ to _END_ of _TOTAL_ admins",
                    paginate: {
                        first: "First",
                        last: "Last",
                        next: "Next →",
                        previous: "← Previous"
                    }
                }
            });

            $(document).on('submit', '#Adduser', function(e) {
                e.preventDefault();
                var Formdata = new FormData(this);
                Formdata.append("Addadmins", true);

                $.ajax({
                    url: "backend.php",
                    method: "POST",
                    data: Formdata,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        var res = jQuery.parseJSON(response);
                        if (res.status == 200) {
                            $('#addmodal').modal('hide');
                            $('#Adduser')[0].reset();
                            // Reload the page and maintain table state
                            location.reload();
                        } else if (res.status == 500) {
                            $('#addmodal').modal('hide');
                            $('#Adduser')[0].reset();
                            alert("Something went wrong! Try again.");
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Ajax Error:", error);
                        alert("Error occurred while saving data");
                    }
                });
            });

            $(document).on('click', '.btndelete', function(e) {
                e.preventDefault();
                if (confirm('Are you sure you want to delete this data?')) {
                    var id = $(this).val();
                    console.log(id)
                    $.ajax({
                        url: "backend.php",
                        method: "POST",
                        data: {
                            'delete_user': true,
                            'userid': id
                        },
                        success: function(response) {
                            var res = jQuery.parseJSON(response);
                            if (res.status == 500) {
                                alert(res.message);
                            } else {
                                alert("user deleted");
                                location.reload();
                            }
                        }
                    })
                }
            })

            $(document).on('click', '.btnedit', function(e) {
                e.preventDefault();
                var user_id = $(this).val();
                console.log(user_id)
                $.ajax({
                    type: "POST",
                    url: "backend.php",
                    data: {
                        'edit_user': true,
                        'user_id': user_id
                    },
                    success: function(response) {

                        var res = jQuery.parseJSON(response);
                        console.log(res)
                        if (res.status == 500) {
                            alert(res.message);
                        } else {
                            //$('#student_id2').val(res.data.uid);

                            $('#id').val(res.data.id);
                            $('#Userid').val(res.data.userid);
                            $('#Password').val(res.data.password);
                            $('#Role').val(res.data.role);


                            $('#Editusers').modal('show');

                        }
                    }
                });
            });

            $(document).on('submit', '#Editnewuser', function(e) {
                e.preventDefault();
                var formData = new FormData(this);

                formData.append("save_edituser", true);
                console.log(formData);
                $.ajax({
                    type: "POST",
                    url: "backend.php",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        var res = jQuery.parseJSON(response);
                        console.log(res);
                        if (res.status == 200) {
                            $('#Editusers').modal('hide');
                            $('#Editnewuser')[0].reset();
                            location.reload();
                            alert(res.message)

                        } else if (res.status == 500) {
                            $('#Editusers').modal('hide');
                            $('#Editnewuser')[0].reset();
                            console.error("Error:", res.message);
                            alert("Something Went wrong.! try again")
                        }
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

            // Excel download handler
            $('#downloadExcel').click(function() {
                let table = document.getElementById("usersTable");
                let ws = XLSX.utils.table_to_sheet(table);
                let wb = XLSX.utils.book_new();

                // Format phone numbers as text
                const range = XLSX.utils.decode_range(ws['!ref']);
                for (let R = range.s.r + 1; R <= range.e.r; ++R) {
                    const cellRef = XLSX.utils.encode_cell({
                        r: R,
                        c: 2
                    }); // password column
                    if (ws[cellRef]) {
                        ws[cellRef].t = 's';
                        ws[cellRef].z = '@';
                    }
                }

                XLSX.utils.book_append_sheet(wb, ws, "Admin Users");
                XLSX.writeFile(wb, "Admin_Users_" + new Date().toISOString().slice(0, 10) + ".xlsx");
            });
        });
    </script>
</body>

</html>