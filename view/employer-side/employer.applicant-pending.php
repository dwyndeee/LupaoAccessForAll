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

if (strtolower($role) !== 'employer') {
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

</head>

<body id="page-top">

    <div id="wrapper">

        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="employer.index.php">

                <div class="sidebar-brand-icon" style="width: 50px; height: 40px;">
                    <img src="../../assets/img/Lupao_Nueva_Ecija_seal_logo.png" alt="Logo" style="width: 100%; height: 100%;">
                </div>

                <div class="sidebar-brand-text mx-3">Access For All</div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item">

                <a class="nav-link" href="employer.index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>

            </li>

            <hr class="sidebar-divider">

            <div class="sidebar-heading">
                Management Pages
            </div>

            <li class="nav-item active">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesEmployment"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Employment</span>
                </a>
                <div id="collapsePagesEmployment" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item active" href="employer.applicant-pending.php">Pending Application</a>
                        <a class="collapse-item" href="employer.applicant-approved.php">Approved Application</a>
                        <a class="collapse-item" href="employer.applicant.rejected.php">Rejected Application</a>
                        <a class="collapse-item" href="employer.jobs.php">Job Openings</a>
                    </div>
                </div>
            </li>

            <hr class="sidebar-divider d-none d-md-block">

            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">
                <?php
                include('employer-header.php');
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

    <!-- VIEW MODAL -->
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
                        <div class="row border rounded p-3 mb-4 bg-light shadow-sm mx-2">
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

                        <div class="row border rounded p-3 mb-4 bg-light shadow-sm mx-2">
                            <div class="col-md-6 mb-3">
                                <div class="mb-3">
                                    <label for="company" class="form-label fw-semibold">Company</label>
                                    <input type="text" class="form-control shadow-sm" id="company" name="company" placeholder="Company" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="position" class="form-label fw-semibold">Position</label>
                                    <input type="text" class="form-control shadow-sm" id="position" name="position" placeholder="Position" readonly>
                                </div>
                            </div>

                            <!-- Salary and Date Applied -->
                            <div class="col-md-6 mb-3">
                                <div class="mb-3">
                                    <label for="salary" class="form-label fw-semibold">Salary</label>
                                    <input type="text" class="form-control shadow-sm" id="salary" name="salary" placeholder="Salary" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="appliedOn" class="form-label fw-semibold">Date Applied</label>
                                    <input type="date" class="form-control shadow-sm" id="appliedOn" name="updateDateApplied" placeholder="Date Applied" readonly>
                                </div>
                            </div>
                        </div>


                        <!-- Requirement Documents -->
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <h6 class="fw-semibold text-uppercase text-secondary">Requirement 1</h6>
                                <div class="ratio ratio-1x1 p-3 border rounded-3 bg-light shadow-sm">
                                    <canvas id="req-1-canvas" width="300" height="300"></canvas>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h6 class="fw-semibold text-uppercase text-secondary">Requirement 2</h6>
                                <div class="ratio ratio-1x1 p-3 border rounded-3 bg-light shadow-sm">
                                    <canvas id="req-2-canvas" width="300" height="300"></canvas>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h6 class="fw-semibold text-uppercase text-secondary">Requirement 3</h6>
                                <div class="ratio ratio-1x1 p-3 border rounded-3 bg-light shadow-sm">
                                    <canvas id="req-3-canvas" width="300" height="300"></canvas>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h6 class="fw-semibold text-uppercase text-secondary">Requirement 4</h6>
                                <div class="ratio ratio-1x1 p-3 border rounded-3 bg-light shadow-sm">
                                    <canvas id="req-4-canvas" width="300" height="300"></canvas>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../assets/js/sb-admin-2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!--  -->

    <script>
        $(document).ready(function() {
            var employer_id = '<?php echo $id; ?>'; // PHP session variable embedded in JavaScript                

            console.log(employer_id);

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
                                    <td>${pendingJobApplications.id}</td>
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
                let jobId = $(this).data('job-id'); // Changed here
                let userId = employer_id;
                let applicantName = $(this).data('applicant');
                let applicantEmail = $(this).data('applicant-email');
                let company = $(this).data('company');
                let position = $(this).data('position');
                let salary = $(this).data('salary');
                let requirementOne = $(this).data('requirement-one');
                let requirementTwo = $(this).data('requirement-two');
                let requirementThree = $(this).data('requirement-three');
                let requirementFour = $(this).data('requirement-four');
                let appliedOn = $(this).data('applied-on');
                let application_deadline = $(this).data('application_deadline');
                let status = $(this).data('status');

                let req1Path = $(this).data('req1-path')
                let req2Path = $(this).data('req2-path')
                let req3Path = $(this).data('req3-path')
                let req4Path = $(this).data('req4-path')

                console.log(req1Path + req2Path);

                function loadCanvasImage(canvasId, imgSrc) {
                    let canvas = document.getElementById(canvasId);
                    let ctx = canvas.getContext('2d');
                    let img = new Image();

                    ctx.clearRect(0, 0, canvas.width, canvas.height);

                    img.onload = function() {
                        ctx.clearRect(0, 0, canvas.width, canvas.height); // Clear canvas
                        ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
                    };
                    img.src = imgSrc;
                }

                // Load images into the canvas elements
                loadCanvasImage('req-1-canvas', '../../uploads/jobs/' + req1Path);
                loadCanvasImage('req-2-canvas', '../../uploads/jobs/' + req2Path);
                loadCanvasImage('req-3-canvas', '../../uploads/jobs/' + req3Path);
                loadCanvasImage('req-4-canvas', '../../uploads/jobs/' + req4Path);

                console.log(jobId);

                console.log(jobId);


                $('#jobApplicationId').val(jobId);
                $('#applicantName').val(applicantName);
                $('#applicantEmail').val(applicantEmail);
                $('#company').val(company);
                $('#position').val(position);
                $('#salary').val(salary);
                $('#appliedOn').val(appliedOn);
                $('#requirementOne').val(requirementOne);


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

        });
    </script>

</body>

</html>