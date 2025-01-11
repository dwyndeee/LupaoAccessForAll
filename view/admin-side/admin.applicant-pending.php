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

            <li class="nav-item">

                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesScholarship"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fa fa-graduation-cap"></i>
                    <span>Scholarship</span>
                </a>

                <div id="collapsePagesScholarship" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="admin.scholarships.php">Scholarship Programs</a>
                        <a class="collapse-item" href="admin.scholars.php">Scholar List</a>
                        <a class="collapse-item" href="admin.scholars-pending.php">Pending Application</a>
                        <a class="collapse-item" href="admin.scholars-rejected.php">Rejected Application</a>
                    </div>
                </div>

            </li>
            <li class="nav-item active">

                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesEmployment"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Employment</span>
                </a>

                <div id="collapsePagesEmployment" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="admin.employer.php">Employer List</a>
                        <a class="collapse-item active" href="admin.applicant-pending.php">Pending Application</a>
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

                <div id="collapsePagesUsers" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
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

                    <h1 class="h3 mb-2 text-gray-800">Pending Job Application</h1>
                    <p class="mb-4">This page shows all the Jobs Application within Lupao, and you can also filter them by the company they belong.</p>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-list"></i> My Jobs Application List</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Application Id</th>
                                            <th>Applicant</th>
                                            <th>Company</th>
                                            <th>Position</th>
                                            <th>Salary</th>
                                            <th>Date Applied</th>
                                            <th>Deadline</th>
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
            <style>
                /* Hide the first column (ID) */
                #dataTable2 th:nth-child(1),
                #dataTable2 td:nth-child(1) {
                    display: none;
                }
            </style>

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

    <!-- VIEW MODAL JOB -->
    <div class="modal fade" id="viewApplication-Modal" tabindex="-1" aria-labelledby="viewApplication-Modal" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h4 class="modal-title fw-bold">View Job Application</h4>
                    <button type="button" class="close text-white" data-bs-dismiss="modal" aria-label="Close">x</button>
                </div>
                <div class="modal-body">
                    <form id="viewApplicationScholarForm" enctype="multipart/form-data" method="post">

                        <!-- Job Application Info -->
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <label for="jobApplicationId" class="form-label fw-semibold">Application ID</label>
                                <input type="text" class="form-control shadow-sm" id="jobApplicationId" name="jobApplicationId" placeholder="ID" readonly>
                            </div>
                            <div class="col-md-4">
                                <label for="applicantName" class="form-label fw-semibold">Applicant Name</label>
                                <input type="text" class="form-control shadow-sm" id="applicantName" name="applicantName" placeholder="Applicant Name" readonly>
                            </div>
                            <div class="col-md-4">
                                <label for="applicantEmail" class="form-label fw-semibold">Email</label>
                                <input type="text" class="form-control shadow-sm" id="applicantEmail" name="applicantEmail" placeholder="Email" readonly>
                            </div>
                        </div>

                        <!-- Job and Company Details -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="company" class="form-label fw-semibold">Company</label>
                                <input type="text" class="form-control shadow-sm" id="company" name="company" placeholder="Company" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="position" class="form-label fw-semibold">Position</label>
                                <input type="text" class="form-control shadow-sm" id="position" name="position" placeholder="Position" readonly>
                            </div>
                        </div>

                        <!-- Salary and Date Applied -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="salary" class="form-label fw-semibold">Salary</label>
                                <input type="text" class="form-control shadow-sm" id="salary" name="salary" placeholder="Salary" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="appliedOn" class="form-label fw-semibold">Date Applied</label>
                                <input type="date" class="form-control shadow-sm" id="appliedOn" name="updateDateApplied" placeholder="Date Applied" readonly>
                            </div>
                        </div>

                        <!-- Dynamic Requirements -->
                        <div class="row g-3 mb-4">
                            <!-- Requirement 1 -->
                            <div class="col-md-6 mb-4" id="req-1-div">
                                <h6 class="fw-semibold text-uppercase text-secondary">Your Resume here..</h6>
                                <div class="requirement-wrapper">
                                    <canvas id="req-1-canvas" width="300" height="300" style="display: none;"></canvas>
                                    <a id="req-1-link" href="#" target="_blank" class="text-center text-decoration-none d-none">
                                        <div class="file-preview-icon">
                                            <i id="req-1-icon" class="fa fa-file-pdf fa-3x text-danger"></i>
                                            <p class="mt-2 text-secondary fw-semibold" id="req-1-filename">File Name</p>
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <!-- Requirement 2 -->
                            <div class="col-md-6 mb-4" id="req-2-div">
                                <h6 class="fw-semibold text-uppercase text-secondary">Requirement 2</h6>
                                <div class="requirement-wrapper">
                                    <canvas id="req-2-canvas" width="300" height="300" style="display: none;"></canvas>
                                    <a id="req-2-link" href="#" target="_blank" class="text-center text-decoration-none d-none">
                                        <div class="file-preview-icon">
                                            <i id="req-2-icon" class="fa fa-file-pdf fa-3x text-danger"></i>
                                            <p class="mt-2 text-secondary fw-semibold" id="req-2-filename">File Name</p>
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <!-- Requirement 3 -->
                            <div class="col-md-6 mb-4" id="req-3-div">
                                <h6 class="fw-semibold text-uppercase text-secondary">Requirement 3</h6>
                                <div class="requirement-wrapper">
                                    <canvas id="req-3-canvas" width="300" height="300" style="display: none;"></canvas>
                                    <a id="req-3-link" href="#" target="_blank" class="text-center text-decoration-none d-none">
                                        <div class="file-preview-icon">
                                            <i id="req-3-icon" class="fa fa-file-pdf fa-3x text-danger"></i>
                                            <p class="mt-2 text-secondary fw-semibold" id="req-3-filename">File Name</p>
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <!-- Requirement 4 -->
                            <div class="col-md-6 mb-4" id="req-4-div">
                                <h6 class="fw-semibold text-uppercase text-secondary">Requirement 4</h6>
                                <div class="requirement-wrapper">
                                    <canvas id="req-4-canvas" width="300" height="300" style="display: none;"></canvas>
                                    <a id="req-4-link" href="#" target="_blank" class="text-center text-decoration-none d-none">
                                        <div class="file-preview-icon">
                                            <i id="req-4-icon" class="fa fa-file-pdf fa-3x text-danger"></i>
                                            <p class="mt-2 text-secondary fw-semibold" id="req-4-filename">File Name</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>


                        <!-- Modal Footer Buttons -->
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success fw-bold" name="approveJobApplication" id="approveJobApplication-btn">Approve</button>
                            <button type="submit" class="btn btn-danger fw-bold" name="rejectJobApplication" id="rejectJobApplication-btn">Reject</button>
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
                        <span aria-hidden="true">X</span>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../assets/js/sb-admin-2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!--  -->

    <script>
        var ownerId = '<?php echo $id; ?>'; // PHP session variable embedded in JavaScript                
        let isDropdownOpen = false; // Track the dropdown state

        $(document).ready(function() {
            var employer_id = '<?php echo $id; ?>'; // PHP session variable embedded in JavaScript                

            $.ajax({
                url: '../../controllers/adminController.php',
                type: 'POST',
                data: {
                    getPendingJobApplications: true,
                    employer_id: employer_id
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success === true) {
                        let pendingJobApplications = response.pendingJobApplicationsData;
                        let tbody = $('#dataTable2 tbody');
                        tbody.empty();
                        pendingJobApplications.forEach(function(pendingJobApplications, index) {

                            let statusText = pendingJobApplications.status === null ? 'Pending' : (pendingJobApplications.status == 1 ? 'Approved' : 'Rejected');

                            let row = `<tr>
                                <td style="display:none;">${pendingJobApplications.id}</td>
                                <td>${pendingJobApplications.applicant}</td>
                                <td>${pendingJobApplications.company}</td>
                                <td>${pendingJobApplications.position}</td>
                                <td>${pendingJobApplications.salary}</td>
                                <td>${pendingJobApplications.applied_on}</td>
                                <td>${pendingJobApplications.application_deadline}</td>
                                <td>
                                    ${statusText}
                                </td>

                                <td>
                                    <!-- View button as an individual button -->
                                    <button type="button" class="btn btn-primary btn-sm" id="viewApplication_btn"
                                        data-job-id="${pendingJobApplications.id}"
                                        data-applicant="${pendingJobApplications.applicant}"
                                        data-applicant-email="${pendingJobApplications.email}" 
                                        data-company="${pendingJobApplications.company}"
                                        data-position="${pendingJobApplications.position}"
                                        data-salary="${pendingJobApplications.salary}"
                                        data-req-one="${pendingJobApplications.requirement_1}"
                                        data-req-two="${pendingJobApplications.requirement_2}"
                                        data-req-three="${pendingJobApplications.requirement_3}"
                                        data-req-four="${pendingJobApplications.requirement_4}"
                                        data-applied-on="${pendingJobApplications.applied_on}"
                                        data-application_deadline="${pendingJobApplications.application_deadline}"
                                        data-status="${pendingJobApplications.status}"
                                        data-req1-path="${pendingJobApplications.requirement_1}"
                                        data-req2-path="${pendingJobApplications.requirement_2}"
                                        data-req3-path="${pendingJobApplications.requirement_3}"
                                        data-req4-path="${pendingJobApplications.requirement_4}"
                                        data-bs-toggle="modal" data-bs-target="#viewApplication-Modal">
                                        <i class="fa fa-eye"></i> View
                                    </button>
                                </td>

                            </tr>`;
                            tbody.append(row);
                        });

                        new simpleDatatables.DataTable(document.getElementById('dataTable2'));

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

            $('#dataTable2').on('click', '#viewApplication_btn', function() {
                // File paths
                let req1Path = $(this).data('req1-path');
                let req2Path = $(this).data('req2-path');
                let req3Path = $(this).data('req3-path');
                let req4Path = $(this).data('req4-path');
                let jobId = $(this).data('job-id');
                let applicant = $(this).data('applicant');
                let email = $(this).data('applicant-email');
                let company = $(this).data('company');
                let position = $(this).data('position');
                let salary = $(this).data('salary');
                let appliedOn = $(this).data('applied-on');

                // Populate the modal fields
                $('#jobApplicationId').val(jobId);
                $('#applicantName').val(applicant);
                $('#applicantEmail').val(email);
                $('#company').val(company);
                $('#position').val(position);
                $('#salary').val(salary);
                $('#appliedOn').val(appliedOn);
                // Function to dynamically handle each requirement
                function handleRequirement(canvasId, divId, filePath, linkId, fileNameId, fileTypeClass) {
                    let fileExt = filePath.split('.').pop().toLowerCase(); // Get file extension
                    let isEmpty = filePath === `requirements_${divId.split('-')[1]}/` || filePath.trim() === '';

                    if (isEmpty) {
                        // Hide the div if the file path is empty
                        $(`#${divId}`).hide();
                    } else {
                        // Show the div
                        $(`#${divId}`).show();

                        let fileUrl = '../../uploads/jobs/' + filePath;

                        if (['png', 'jpg', 'jpeg', 'gif'].includes(fileExt)) {
                            // Handle image files
                            let canvas = document.getElementById(canvasId);
                            let ctx = canvas.getContext('2d');
                            let img = new Image();

                            img.onload = function() {
                                ctx.clearRect(0, 0, canvas.width, canvas.height);
                                ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
                            };

                            img.src = fileUrl;

                            // Display the canvas and hide the link icon
                            $(`#${canvasId}`).show().css('cursor', 'pointer');
                            $(`#${linkId}`).addClass('d-none');

                            // Make the canvas clickable to open the image in a new tab
                            $(`#${canvasId}`).off('click').on('click', function() {
                                window.open(fileUrl, '_blank');
                            });

                        } else if (['pdf', 'doc', 'docx'].includes(fileExt)) {
                            // Handle PDF or Word files
                            let fileIcon = fileExt === 'pdf' ? 'fa-file-pdf' : 'fa-file-word'; // Set icon class
                            let fileColor = fileExt === 'pdf' ? 'text-danger' : 'text-primary'; // Set icon color

                            $(`#${canvasId}`).hide();
                            $(`#${linkId}`)
                                .removeClass('d-none') // Show the link
                                .attr('href', fileUrl) // Set the link for document viewing
                                .attr('target', '_blank') // Open in a new tab
                                .attr('download', filePath); // Allow downloading
                            $(`#${fileNameId}`).text(filePath.split('/').pop()); // Display the file name
                            $(`#${fileTypeClass}`).attr('class', `fa ${fileIcon} fa-3x ${fileColor}`); // Update icon dynamically
                        }
                    }
                }

                // Apply to each requirement
                handleRequirement('req-1-canvas', 'req-1-div', req1Path, 'req-1-link', 'req-1-filename', 'req-1-icon');
                handleRequirement('req-2-canvas', 'req-2-div', req2Path, 'req-2-link', 'req-2-filename', 'req-2-icon');
                handleRequirement('req-3-canvas', 'req-3-div', req3Path, 'req-3-link', 'req-3-filename', 'req-3-icon');
                handleRequirement('req-4-canvas', 'req-4-div', req4Path, 'req-4-link', 'req-4-filename', 'req-4-icon');
            });

            $('#approveJobApplication-btn').on('click', function(event) {
                event.preventDefault();

                var formData = {
                    id: $('#jobApplicationId').val(),
                    applicantName: $('#applicantName').val(),
                    email: $('#applicantEmail').val(),
                    company: $('#company').val(),
                    position: $('#position').val(),
                    salary: $('#salary').val(),
                    applied_on: $('#appliedOn').val(),
                    scholarAction: 'acceptJobApplication',
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

                console.log(formData);


                submitJobApplicationAction(formData);
            });

            $('#rejectJobApplication-btn').on('click', function(event) {
                event.preventDefault();

                var formData = {
                    id: $('#jobApplicationId').val(),
                    applicantName: $('#applicantName').val(),
                    email: $('#applicantEmail').val(),
                    company: $('#company').val(),
                    position: $('#position').val(),
                    salary: $('#salary').val(),
                    applied_on: $('#appliedOn').val(),
                    scholarAction: 'rejectJobApplication'
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

                console.log(formData);

                submitJobApplicationAction(formData);
            });

            function submitJobApplicationAction(formData) {
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
                        }).then(() => {
                            location.reload();
                        });

                        console.log(xhr, status, error);


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