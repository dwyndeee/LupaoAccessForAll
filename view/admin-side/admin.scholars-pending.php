<?php

session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: ../../index.php');
    exit;
}

$firstname = isset($_SESSION['firstname']) ? $_SESSION['firstname'] : 'Guest';
$lastname = isset($_SESSION['lastname']) ? $_SESSION['lastname'] : 'Guest';

$role = isset($_SESSION['role']) ? $_SESSION['role'] : '';
$id = isset($_SESSION['id']) ? $_SESSION['id'] : '';

if (strtolower($role) !== 'admin') {
    header('Location: ../../unauthorized.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $role ?> Side | Lupao Scholarship and Enrollment Portal</title>

    <link href="../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="icon" href="../../assets/img/Lupao_Nueva_Ecija_seal_logo.png">

    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link href="../../assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />

    <style>
        .file-preview-icon {
            cursor: pointer;
            text-align: center;
            border: 1px dashed #ccc;
            padding: 20px;
            border-radius: 5px;
            transition: box-shadow 0.3s ease, transform 0.2s ease;
        }

        .file-preview-icon:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transform: scale(1.05);
        }

        .file-preview-icon i {
            font-size: 3rem;
        }

        .file-preview-icon p {
            margin-top: 10px;
            font-size: 0.9rem;
            color: #555;
        }

        /* Image hover zoom effect */
        .hover-zoom {
            transition: transform 0.3s ease-in-out;
        }

        .hover-zoom:hover {
            transform: scale(1.05);
        }

        /* File preview wrapper styles */
        .p-3.border {
            text-align: center;
            padding: 20px;
            border: 1px solid #ddd;
            background-color: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .file-preview-icon {
            text-align: center;
            margin-top: 10px;
        }

        .file-preview-icon i {
            font-size: 2rem;
            margin-bottom: 5px;
        }
    </style>
</head>

<body id="page-top">

    <div id="wrapper">

        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="admin.index.php">

                <div class="sidebar-brand-icon" style="width: 50px; height: 40px;">
                    <img src="../../assets/img/Lupao_Nueva_Ecija_seal_logo.png" alt="Logo" style="width: 100%; height: 100%;">
                </div>

                <div class="sidebar-brand-text mx-3">Access For All</div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item">

                <a class="nav-link" href="admin.index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>

            </li>

            <hr class="sidebar-divider">

            <div class="sidebar-heading">
                Administrative Pages
            </div>

            <li class="nav-item active">

                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesScholarship"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fa fa-graduation-cap"></i>
                    <span>Scholarship</span>
                </a>

                <div id="collapsePagesScholarship" class="collapse" aria-labelledby="headingPages"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="admin.scholarships.php">Scholarship Programs</a>
                        <a class="collapse-item" href="admin.scholars.php">Scholar List</a>
                        <a class="collapse-item active" href="admin.scholars-pending.php">Pending Application</a>
                        <a class="collapse-item" href="admin.scholars-rejected.php">Rejected Application</a>
                    </div>
                </div>

            </li>
            <li class="nav-item">

                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesEmployment"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Employment</span>
                </a>

                <div id="collapsePagesEmployment" class="collapse" aria-labelledby="headingPages"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="admin.employer.php">Employer List</a>
                        <a class="collapse-item" href="admin.applicant-pending.php">Pending Application</a>
                        <a class="collapse-item" href="admin.applicant-approved.php">Approved Application</a>
                        <a class="collapse-item" href="admin.applicant.rejected.php">Rejected Application</a>
                        <a class="collapse-item" href="admin.jobs.php">Job Openings</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesUsers"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fa fa-users"></i>
                    <span>User Management</span>
                </a>

                <div id="collapsePagesUsers" class="collapse" aria-labelledby="headingPages"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="admin.allu-users.php">All Users List</a>
                        <a class="collapse-item" href="admin.pending-registration.php">Pending Registration List</a>
                        <a class="collapse-item" href="admin.approved-registration.php">Approved Registration</a>
                        <a class="collapse-item" href="admin.rejected-registration.php">Rejected Registration</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="admin.announcements.php">
                    <i class="fa fa-bullhorn"></i>
                    <span>Announcements</span></a>
            </li>

            <hr class="sidebar-divider d-none d-md-block">

            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <?php
                include('admin-header.php');
                ?>

                <div class="container-fluid">

                    <h1 class="h3 mb-2 text-gray-800">Pending Scholar Applications</h1>
                    <p class="mb-4">This page shows the pending scholar applications within Lupao, and you can also
                        filter them by the program they belong.</p>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-graduation-cap"></i> Scholar
                                List</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <!-- <th>ID</th> -->
                                            <th>Student</th>
                                            <th>Grantor</th>
                                            <th>Title</th>
                                            <th>Date Applied</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Lupao Scholarship & Employment Portal</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- view Scholar -->
    <div class="modal fade" id="viewApplication-Modal" tabindex="-1" aria-labelledby="viewApplication-Modal"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content shadow-lg rounded-3">
                <div class="modal-header bg-primary text-white">
                    <h4 class="modal-title fs-5 fw-bold" id="viewApplication-ModalLabel">View Scholar Application</h4>
                    <button type="button" class="btn close text-white" data-bs-dismiss="modal"
                        aria-label="Close">X</button>
                </div>
                <div class="modal-body px-4 py-3 mx-3">
                    <form id="viewApplicationScholarForm" enctype="multipart/form-data" method="post">

                        <div class="row border rounded p-3 mb-4 bg-light shadow-sm">
                            <div class="col-md-3 d-none">
                                <label for="program_id  " class="form-label text-secondary fw-semibold">Program ID</label>
                                <input type="text" class="form-control" id="program_id" name="program_id" readonly>
                            </div>
                            <div class="col-md-3 d-none">
                                <label for="updateId" class="form-label text-secondary fw-semibold">ID</label>
                                <input type="text" class="form-control" id="updateId" name="updateId" readonly>
                            </div>
                            <div class="col-md-3">
                                <label for="updateGrantor" class="form-label text-secondary fw-semibold">Grantor</label>
                                <input type="text" class="form-control" id="updateGrantor" name="updateGrantor"
                                    readonly>
                            </div>

                            <div class="col-md-3">
                                <label for="updateProgram_title" class="form-label text-secondary fw-semibold">Program
                                    Title</label>
                                <input type="text" class="form-control" id="updateProgram_title"
                                    name="updateProgram_title" readonly>
                            </div>
                            <div class="col-md-3">
                                <label for="updateDateApplied" class="form-label text-secondary fw-semibold">Date
                                    Applied</label>
                                <input type="date" class="form-control" id="updateDateApplied" name="updateDateApplied"
                                    readonly>
                            </div>

                            <div class="col-md-6">
                                <label for="student_name" class="form-label text-secondary fw-semibold">Student
                                    Name</label>
                                <input type="text" class="form-control" id="student_name" name="student_name" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label text-secondary fw-semibold">Email</label>
                                <input type="email" class="form-control" id="email" name="email" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="contact_no" class="form-label text-secondary fw-semibold">Contact
                                    Number</label>
                                <input type="text" class="form-control" id="contact_no" name="contact_no" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Dynamic requirements rendered here -->
                            <div class="col-md-6 mb-4" id="req-1-div">
                                <h6 class="fw-semibold text-uppercase text-secondary">School ID</h6>
                                <div class="requirement-wrapper">
                                    <canvas id="req-1-canvas" width="300" height="300" style="display: none;"></canvas>
                                    <a id="req-1-link" href="#" target="_blank" class="text-center text-decoration-none d-none">
                                        <div class="file-preview-icon">
                                            <i id="req-1-icon" class="fa fa-file-pdf fa-3x text-danger"></i>
                                            <!-- PDF icon as default -->
                                            <p class="mt-2 text-secondary fw-semibold" id="req-1-filename">File Name</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4" id="req-2-div">
                                <h6 class="fw-semibold text-uppercase text-secondary">Birth Certificate(PSA)</h6>
                                <div class="requirement-wrapper">
                                    <canvas id="req-2-canvas" width="300" height="300" style="display: none;"></canvas>
                                    <a id="req-2-link" href="#" target="_blank" class="text-center text-decoration-none d-none">
                                        <div class="file-preview-icon">
                                            <i id="req-2-icon" class="fa fa-file-pdf fa-3x text-danger"></i>
                                            <!-- PDF icon as default -->
                                            <p class="mt-2 text-secondary fw-semibold" id="req-2-filename">File Name</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4" id="req-3-div">
                                <h6 class="fw-semibold text-uppercase text-secondary">Certificate of Enrollment </h6>
                                <div class="requirement-wrapper">
                                    <canvas id="req-3-canvas" width="300" height="300" style="display: none;"></canvas>
                                    <a id="req-3-link" href="#" target="_blank" class="text-center text-decoration-none d-none">
                                        <div class="file-preview-icon">
                                            <i id="req-3-icon" class="fa fa-file-pdf fa-3x text-danger"></i>
                                            <!-- PDF icon as default -->
                                            <p class="mt-2 text-secondary fw-semibold" id="req-3-filename">File Name</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4" id="req-4-div">
                                <h6 class="fw-semibold text-uppercase text-secondary">Certificate of Grades</h6>
                                <div class="requirement-wrapper">
                                    <canvas id="req-4-canvas" width="300" height="300" style="display: none;"></canvas>
                                    <a id="req-4-link" href="#" target="_blank" class="text-center text-decoration-none d-none">
                                        <div class="file-preview-icon">
                                            <i id="req-4-icon" class="fa fa-file-pdf fa-3x text-danger"></i>
                                            <!-- PDF icon as default -->
                                            <p class="mt-2 text-secondary fw-semibold" id="req-4-filename">File Name</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>



                        <div class="modal-footer d-flex justify-content-end">
                            <button type="submit" class="btn btn-success btn-sm me-2" name="approveScholarship"
                                id="approveScholarship-btn">
                                Approve
                            </button>
                            <button type="submit" class="btn btn-danger btn-sm" name="rejectScholarship"
                                id="rejectScholarship-btn">
                                Reject
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../../controllers/logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../assets/js/sb-admin-2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!--  -->

    <script>
        var ownerId = '<?php echo $id; ?>'; // PHP session variable embedded in JavaScript                
        let isDropdownOpen = false; // Track the dropdown state

        $(document).ready(function() {
            // Add this AJAX request to get user count
            $.ajax({
                url: '../../controllers/adminController.php',
                type: 'POST',
                data: {
                    getAllScholarPending: true
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success === true) {
                        let pendingScholars = response.pendingScholarsData;
                        let tbody = $('#dataTable tbody');
                        tbody.empty();
                        pendingScholars.forEach(function(pendingScholars, index) {

                            let statusText = pendingScholars.status === null ? 'Pending' : (pendingScholars.status == 1 ? 'Approved' : 'Rejected');

                            let row = `<tr>
                                <td style="display:none;">${pendingScholars.id}</td>
                                <td>${pendingScholars.student_name}</td>
                                <td>${pendingScholars.grantor}</td>
                                <td>${pendingScholars.program_title}</td>
                                <td>${pendingScholars.date_applied}</td>
                                <td>
                                    ${statusText}
                                    (${pendingScholars.remarks})
                                </td>

                                <td>
                                    <!-- View button as an individual button -->
                                    <button type="button" class="btn btn-primary btn-sm" id="viewApplication_btn"
                                        data-id="${pendingScholars.id}"
                                        data-program_id="${pendingScholars.program_id}"
                                        data-student_id="${pendingScholars.student_id}"
                                        data-date_applied="${pendingScholars.date_applied}"
                                        data-date_approved="${pendingScholars.date_approved}"
                                        data-requirement_1="${pendingScholars.requirement_1}"
                                        data-requirement_2="${pendingScholars.requirement_2}"
                                        data-requirement_3="${pendingScholars.requirement_3}"
                                        data-requiremetn_4="${pendingScholars.requiremetn_4}"
                                        data-status="${pendingScholars.status}"
                                        data-remarks="${pendingScholars.remarks}"
                                        data-grantor="${pendingScholars.grantor}"
                                        data-program_title="${pendingScholars.program_title}"
                                        data-student_name="${pendingScholars.student_name}"
                                        data-email="${pendingScholars.email}"
                                        data-contact="${pendingScholars.contact_no}"
                                        data-req1-path="${pendingScholars.requirement_1}"
                                        data-req2-path="${pendingScholars.requirement_2}"
                                        data-req3-path="${pendingScholars.requirement_3}"
                                        data-req4-path="${pendingScholars.requirement_4}"
                                        data-bs-toggle="modal" data-bs-target="#viewApplication-Modal">
                                        <i class="fa fa-eye"></i> View
                                    </button>
                                </td>
                            </tr>`;
                            tbody.append(row);
                        });

                        new simpleDatatables.DataTable(document.getElementById('dataTable'));

                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message,
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Request Failed',
                        text: 'Something went wrong while fetching the data. Please try again.',
                    });
                }
            });

            $('#dataTable').on('click', '#viewApplication_btn', function() {
                let req1Path = $(this).data('req1-path');
                let req2Path = $(this).data('req2-path');
                let req3Path = $(this).data('req3-path');
                let req4Path = $(this).data('req4-path');

                function loadFilePreview(divId, canvasId, linkId, filePath, prefix) {
                    let fileWrapper = $(`#${divId}`);
                    let canvas = $(`#${canvasId}`);
                    let link = $(`#${linkId}`);
                    let fileNameElement = $(`#${linkId}-filename`);

                    // Clear any previous content in the wrapper
                    fileWrapper.find('img').remove();
                    canvas.hide(); // Hide canvas as it won't be used for images

                    // If the filePath is valid (non-empty and doesn't equal prefix), process the file
                    if (filePath && filePath.trim() !== '' && filePath.trim() !== prefix) {
                        let fileExtension = filePath.split('.').pop().toLowerCase();

                        // Show the file wrapper div
                        fileWrapper.show();

                        // Check if the file is an image (jpg, jpeg, png, gif)
                        if (['jpg', 'jpeg', 'png', 'gif'].includes(fileExtension)) {
                            // Hide the link and display the image in the wrapper
                            link.addClass('d-none');

                            let imgSrc = '../../uploads/programs/' + filePath;

                            // Create the image element
                            let imgElement = $('<img>')
                                .attr('src', imgSrc)
                                .addClass('img-fluid rounded shadow-lg hover-zoom') // Add modern design classes
                                .css({
                                    maxWidth: '100%',
                                    maxHeight: '300px',
                                    cursor: 'pointer',
                                    objectFit: 'cover',
                                })
                                .on('click', function() {
                                    // Open the image in a new tab when clicked
                                    window.open(imgSrc, '_blank');
                                });

                            // Append the image to the wrapper
                            fileWrapper.append(imgElement);

                        } else {
                            // If not an image, show the file link
                            link.removeClass('d-none');
                            let fileName = filePath.split('/').pop();
                            fileNameElement.text(fileName);

                            // Set the link URL
                            link.attr('href', '../../uploads/programs/' + filePath);

                            // Set the icon based on the file type (PDF, Word, Excel, etc.)
                            let iconClass = 'fa fa-file'; // Default icon for unknown file types
                            if (fileExtension === 'pdf') {
                                iconClass = 'fa fa-file-pdf text-danger';
                            } else if (['doc', 'docx'].includes(fileExtension)) {
                                iconClass = 'fa fa-file-word text-primary';
                            } else if (['xls', 'xlsx'].includes(fileExtension)) {
                                iconClass = 'fa fa-file-excel text-success';
                            }
                            link.find('i').attr('class', iconClass);
                        }
                    } else {
                        // If no file is provided, hide the file wrapper div
                        fileWrapper.hide();
                    }
                }

                // Apply the logic to all requirements
                loadFilePreview('req-1-div', 'req-1-canvas', 'req-1-link', req1Path, 'requirements_1/');
                loadFilePreview('req-2-div', 'req-2-canvas', 'req-2-link', req2Path, 'requirements_2/');
                loadFilePreview('req-3-div', 'req-3-canvas', 'req-3-link', req3Path, 'requirements_3/');
                loadFilePreview('req-4-div', 'req-4-canvas', 'req-4-link', req4Path, 'requirements_4/');

                // Populate the form fields with the data from the clicked row
                $('#updateId').val($(this).data('id'));
                $('#program_id').val($(this).data('program_id'));
                $('#updateGrantor').val($(this).data('grantor'));
                $('#updateProgram_title').val($(this).data('program_title'));
                $('#updateDescription').val($(this).data('description'));
                $('#updateBeneficiaries').val($(this).data('beneficiaries'));
                $('#updateRequirements').val($(this).data('requirements'));
                $('#updateDateApplied').val($(this).data('date_applied'));
                $('#student_name').val($(this).data('student_name'));
                $('#email').val($(this).data('email'));
                $('#contact_no').val($(this).data('contact'));
                $('#slotsLeft').val($(this).data('slot'));
                $('#updateStatus').val($(this).data('status'));
            });

            $('#approveScholarship-btn').on('click', function(event) {
                event.preventDefault();

                var formData = {
                    id: $('#updateId').val(),
                    program_id: $('#program_id').val(),
                    email: $('#email').val(),
                    contact_no: $('#contact_no').val(),
                    student_name: $('#student_name').val(),
                    grantor: $('#updateGrantor').val(),
                    program_title: $('#updateProgram_title').val(),
                    action: 'acceptScholarship'
                };

                console.log(contact_no)
                // Show loading indicator
                Swal.fire({
                    title: 'Processing you request',
                    text: 'Please wait...',
                    showConfirmButton: false, // No confirm button
                    allowOutsideClick: false, // Disable clicking outside to close
                    allowEscapeKey: false, // Disable escape key to close
                    onOpen: () => {
                        Swal.showLoading();
                    }
                });

                submitScholarshipAction(formData);
            });

            $('#rejectScholarship-btn').on('click', function(event) {
                event.preventDefault();

                var formData = {
                    id: $('#updateId').val(),
                    email: $('#email').val(),
                    student_name: $('#student_name').val(),
                    grantor: $('#updateGrantor').val(),
                    program_title: $('#updateProgram_title').val(),
                    action: 'rejectScholarship'
                };

                // Show loading indicator
                Swal.fire({
                    title: 'Processing you request',
                    text: 'Please wait...',
                    showConfirmButton: false, // No confirm button
                    allowOutsideClick: false, // Disable clicking outside to close
                    allowEscapeKey: false, // Disable escape key to close
                    onOpen: () => {
                        Swal.showLoading();
                    }
                });

                submitScholarshipAction(formData);
            });

            function submitScholarshipAction(formData) {
                $.ajax({
                    url: '../../controllers/adminController.php',
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: response.message
                            }).then(() => {
                                location.reload();
                            });

                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Update Failed',
                                text: response.message,
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Request Failed',
                            text: 'An error occurred while updating. Please try again.',
                        });
                    }
                });
            }

            // SEND MESSAGES
            $.ajax({
                url: '../../controllers/adminController.php', // Your controller path
                type: 'POST',
                data: {
                    getAllUsers: true
                }, // Adjust this to match the controller’s POST variable
                dataType: 'json',
                success: function(response) {
                    if (response.success === true) {
                        let usersData = response.usersData; // Your fetched user data
                        let tbody = $('#userTable tbody'); // Targeting tbody of the DataTable
                        tbody.empty(); // Clear existing rows
                        usersData.forEach(function(user, index) {
                            // Create the table row
                            let row = `<tr>
                                <td>${user.firstname + " " + user.lastname}</td>
                                <td>
                                    <!-- Select Button -->
                                    <button type="button" class="btn btn-primary btn-sm selectUser" data-toggle="modal" data-target="#sendMessage" data-user-id="${user.id}" data-user-name="${user.firstname} ${user.lastname}">
                                        <i class="fas fa-paper-plane"></i>
                                        Send
                                    </button>
                                </td>
                            </tr>`;
                            tbody.append(row); // Add the new row to the table
                        });

                        // new simpleDatatables.DataTable(document.getElementById('userTable'));
                        const dataTable = new simpleDatatables.DataTable(document.getElementById('userTable'), {
                            searchable: true, // Ensure search is enabled
                            perPage: 10, // Add pagination if needed
                        });

                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message,
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Request Failed',
                        text: 'Something went wrong while fetching the data. Please try again.',
                    });
                }
            });

            // Populate sendMessageModal when the "Send" button is clicked
            $(document).on('click', '.selectUser', function() {
                const userId = $(this).data('user-id');
                const userName = $(this).data('user-name');

                // Populate the input field in the sendMessageModal
                $('#sendMessage #userSenderId').val(ownerId);
                $('#sendMessage #userReceiverId').val(userId);
                $('#sendMessage #userName').val(userName);
            });

            $(document).on('click', '#sendMessageButton', function() {
                const userId = $('#userSenderId').val();
                const userReceiverId = $('#userReceiverId').val();
                const userName = $('#userName').val();
                const userMessage = $('#userMessage').val();

                if (!userMessage) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Validation Error',
                        text: 'Please enter a message before sending.',
                    });
                    return;
                }

                $.ajax({
                    url: '../../controllers/messageController.php',
                    type: 'POST',
                    data: {
                        sendMessage: true,
                        userSenderId: userId,
                        userReceiverId: userReceiverId,
                        userMessage: userMessage,
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Message Sent',
                                text: response.message,
                            }).then(() => {
                                $('#sendMessageForm')[0].reset(); // Clear form
                                $('#sendMessage').modal('hide'); // Hide modal
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message,
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Request Failed',
                            text: 'Something went wrong. Please try again.',
                        });
                    },
                });
            });

            function fetchUnreadMessageCount() {
                $.ajax({
                    url: '../../controllers/messageController.php', // URL to fetch messages
                    type: 'POST',
                    data: {
                        getUnreadCount: true,
                        sender_id: ownerId
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log(response); // Check the response structure

                        if (response.success === true) {
                            let unreadCount = response.unreadCount; // Assuming response contains unread count
                            let unreadCountElement = $('#unread_count'); // Targeting the unread count badge

                            // Update unread count
                            unreadCountElement.text(unreadCount);

                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message,
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Request Failed',
                            text: 'Something went wrong. Please try again.',
                        });
                    }
                });
            }

            function fetchMessages() {
                $.ajax({
                    url: '../../controllers/messageController.php',
                    type: 'POST',
                    data: {
                        getMessages: true,
                        sender_id: ownerId
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            console.log(response);

                            var messages = response.messages;
                            var messageListHtml = '';

                            if (messages.length === 0) {
                                messageListHtml = '<div class="dropdown-item d-flex align-items-center">No messages available</div>';
                            } else {
                                messages.forEach(function(message) {
                                    let senderName = message.sender_user_name || "";
                                    let initials = senderName
                                        .split(" ")
                                        .map(word => word[0])
                                        .join("")
                                        .toUpperCase();

                                    let date = new Date(message.created_at);
                                    let formattedTime = date.toLocaleTimeString([], {
                                        hour: '2-digit',
                                        minute: '2-digit',
                                        hour12: true
                                    });

                                    // Here we pass the message id to open the conversation
                                    messageListHtml += `
                                        <a class="dropdown-item d-flex align-items-center" href="#" data-toggle="modal" data-target="#messageModal" data-message-id="${message.id}" data-sender-id="${message.sender_id}">
                                            <div class="dropdown-list-image mr-3">
                                                <div class="rounded-circle bg-primary d-flex justify-content-center align-items-center text-white" 
                                                    style="width: 40px; height: 40px; font-size: 16px;">
                                                    ${initials}
                                                </div>
                                            </div>
                                            <div class="font-weight-bold">
                                                <div class="text-truncate">${message.message}</div>
                                                <div class="small text-gray-500">${message.sender_user_name}  ${formattedTime}</div>
                                            </div>
                                        </a>
                                    `;
                                });
                            }

                            $('#message-list').html(messageListHtml);
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Could not fetch messages.',
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Request Failed',
                            text: 'Something went wrong. Please try again.',
                        });
                    }
                });
            }

            function fetchConversation(messageId, senderId) {
                var ownerId = '<?php echo $id; ?>'; // PHP session variable embedded in JavaScript

                $.ajax({
                    url: '../../controllers/messageController.php',
                    type: 'POST',
                    data: {
                        getConversation: true,
                        message_id: messageId,
                        sender_id: senderId
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log(response); // Log the response to the console to check the structure

                        if (response.success) {
                            const conversation = response.conversation;
                            let conversationHtml = '';

                            conversation.forEach(function(message) {
                                // Ensure sender name is defined; use "You" if undefined
                                let senderName = message.sender_user_name || "You";

                                // Ensure created_at is defined; use current time if undefined
                                let date = message.created_at ? new Date(message.created_at) : new Date();
                                let formattedTime = date.toLocaleTimeString([], {
                                    hour: '2-digit',
                                    minute: '2-digit',
                                    hour12: true
                                });

                                // Adjust layout based on whether the current user or the other user is sending the message
                                if (message.sender_id === ownerId) {
                                    // For the current user
                                    conversationHtml += `
                                        <div class="message-item d-flex justify-content-end">
                                            <div class="message" style="background-color: #e1f7d5; border-radius: 10px; padding: 8px 12px; max-width: 60%;">
                                                <div class="sender">You <span class="text-gray-500">${formattedTime}</span></div>
                                                <div class="message-text">${message.message}</div>
                                            </div>
                                        </div>
                                    `;
                                } else {
                                    // For the other user
                                    conversationHtml += `
                                        <div class="message-item d-flex justify-content-start">
                                            <div class="message" style="background-color: #f1f1f1; border-radius: 10px; padding: 8px 12px; max-width: 60%;">
                                                <div class="sender">${senderName} <span class="text-gray-500">${formattedTime}</span></div>
                                                <div class="message-text">${message.message}</div>
                                            </div>
                                        </div>
                                    `;
                                }
                            });

                            $('#conversation').html(conversationHtml); // Inject the conversation HTML into the modal body
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Could not fetch the conversation.',
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Request Failed',
                            text: 'Something went wrong while loading the conversation.',
                        });
                    }
                });
            }

            function markMessageAsRead(messageId) {
                $.ajax({
                    url: '../../controllers/messageController.php',
                    type: 'POST',
                    data: {
                        markMessageAsRead: true,
                        message_id: messageId
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            console.log(response.message); // Message marked as read
                        } else {
                            console.error(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Request failed: ' + error);
                    }
                });
            }

            $('#sendReply').on('click', function() {
                const message = $('#replyMessage').val().trim(); // Get the message
                const recipientId = $('#messageModal').data('recipient-id'); // Assume recipient ID is stored when opening the modal
                const senderId = ownerId; // Assuming you have the ownerId available

                if (message !== '') {

                    const currentDate = new Date();
                    const currentTime = currentDate.toLocaleTimeString([], {
                        hour: '2-digit',
                        minute: '2-digit',
                        hour12: true
                    });

                    $.ajax({
                        url: '../../controllers/messageController.php',
                        type: 'POST',
                        data: {
                            replyMessage: true,
                            message: message,
                            recipient_id: recipientId,
                            sender_id: senderId
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.success) {
                                $('#replyMessage').val(''); // Clear the input field

                                const newMessageHtml = `
                                    <div class="message-item d-flex justify-content-end">
                                        <div class="message mb-3" style="background-color: #e1f7d5; border-radius: 10px; padding: 8px 12px; max-width: 60%;">
                                            <div class="sender">You <span class="text-gray-500">${currentTime}</span></div>
                                            <div class="message-text">${message}</div>
                                        </div>
                                    </div>
                                `;
                                $('#conversation').append(newMessageHtml); // Append new message to conversation
                                $('#conversation').scrollTop($('#conversation')[0].scrollHeight); // Scroll to the bottom
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Could not send the message.',
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Request Failed',
                                text: 'Something went wrong. Please try again.',
                            });
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Empty Message',
                        text: 'Please type a message before sending.',
                    });
                }
            });

            // When a message is clicked, load the conversation
            $('#message-list').on('click', '.dropdown-item', function() {
                var messageId = $(this).data('message-id');
                var senderId = $(this).data('sender-id');

                $('#messageModal').data('recipient-id', senderId); // Store the recipient ID
                fetchConversation(messageId, senderId);
                markMessageAsRead(messageId);

            });

            setInterval(function() {
                fetchMessages();
                fetchUnreadMessageCount();
            }, 5000);
        });
    </script>

</body>

</html>