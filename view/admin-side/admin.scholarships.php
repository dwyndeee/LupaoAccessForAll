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

                <div id="collapsePagesScholarship" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item active" href="admin.scholarships.php">Scholarship Programs</a>
                        <a class="collapse-item" href="admin.scholars.php">Scholar List</a>
                        <a class="collapse-item" href="admin.scholars-pending.php">Pending Application</a>
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

                <div id="collapsePagesEmployment" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
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

                    <h1 class="h3 mb-2 text-gray-800">Scholarship Programs</h1>
                    <p class="mb-4">This page shows the available scholarships within the whole system.</p>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary"> <i class="fas fa-table me-1"></i> Scholarships List</h6>
                            <button class="btn btn-success btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#add-Modal"><i class="fas fa-plus me-1"></i> Add Program</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Grantor</th>
                                            <th>Title</th>
                                            <!-- <th>Description</th> -->
                                            <!-- <th>Beneficiaries</th> -->
                                            <!-- <th>Req</th> -->
                                            <th>Start date</th>
                                            <th>Deadline</th>
                                            <th>Available Slot</th>
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
                #dataTable th:nth-child(1),
                #dataTable td:nth-child(1) {
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

    <!-- ADD MODAL -->
    <div class="modal fade" id="add-Modal" tabindex="-1" aria-labelledby="add-Modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h4 class="modal-title fs-5">Add Scholarship Program</h4>
                    <button type="button" class="btn btn-sm text-white" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
                <div class="modal-body row mx-3">
                    <form id="addScholarshipForm" enctype="multipart/form-data" method="post">

                        <div class="row border rounded p-3 mb-4 bg-light shadow-sm">
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <label for="grantor1" class="form-label">Grantor</label>
                                    <input type="text" class="form-control" id="grantor1" name="grantor1" placeholder="Grantor Name" required>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <label for="program_title" class="form-label">Program Title</label>
                                    <input type="text" class="form-control" id="program_title" name="program_title" placeholder="Scholarship Program Title" required>
                                </div>
                            </div>
                        </div>

                        <div class="row border rounded p-3 mb-4 bg-light shadow-sm">
                            <div class="col-md-12">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" placeholder="Program Description" required></textarea>
                            </div>
                        </div>

                        <div class="row border rounded p-3 mb-4 bg-light shadow-sm">
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <label for="beneficiaries" class="form-label">Beneficiaries</label>
                                    <input type="text" class="form-control" id="beneficiaries" name="beneficiaries" placeholder="Beneficiaries" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <label for="requirements" class="form-label">Requirements</label>
                                    <textarea class="form-control" id="requirements" name="requirements" placeholder="Program Requirements" required></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row border rounded p-3 mb-4 bg-light shadow-sm">
                            <div class="col-md-6">
                                <label for="application_start" class="form-label">Application Start Date</label>
                                <input type="date" class="form-control" id="application_start" name="application_start" required>
                            </div>
                            <div class="col-md-6">
                                <label for="application_deadline" class="form-label">Application Deadline</label>
                                <input type="date" class="form-control" id="application_deadline" name="application_deadline" required>
                            </div>
                        </div>

                        <div class="row border rounded p-3 mb-4 bg-light shadow-sm">
                            <div class="col-md-6">
                                <label for="slot" class="form-label">Available Slots</label>
                                <input type="number" class="form-control" id="slot" name="slot" placeholder="Number of Slots" min="0" required>
                            </div>

                            <div class="col-md-6">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="modal-footer border-0 d-flex justify-content-end">
                            <button type="submit" class="btn btn-success btn-sm" name="addScholarshipProgram" id="addScholarship-btn">Add Program</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- EDIT MODAL -->
    <div class="modal fade" id="update-Modal" tabindex="-1" aria-labelledby="update-Modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h4 class="modal-title fs-5">Update Scholarship Program</h4>
                    <button type="button" class="btn text-white btn-sm" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
                <div class="modal-body row mx-3">
                    <form id="updateScholarshipForm" enctype="multipart/form-data" method="post">
                        <input type="hidden" id="updateId" name="id" value="">

                        <div class="row border rounded p-3 mb-4 bg-light shadow-sm">
                            <div class="col-md-12 mb-3">
                                <label for="updateGrantor" class="form-label">Grantor</label>
                                <input type="text" class="form-control" id="updateGrantor" name="updateGrantor" placeholder="Grantor Name" required>
                            </div>
                        </div>

                        <div class="row border rounded p-3 mb-4 bg-light shadow-sm">
                            <div class="col-md-12 mb-3">
                                <label for="updateProgram_title" class="form-label">Program Title</label>
                                <input type="text" class="form-control" id="updateProgram_title" name="updateProgram_title" placeholder="Scholarship Program Title" required>
                            </div>
                        </div>

                        <div class="row border rounded p-3 mb-4 bg-light shadow-sm">
                            <label for="updateDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="updateDescription" name="updateDescription" placeholder="Program Description" required></textarea>
                        </div>

                        <div class="row border rounded p-3 mb-4 bg-light shadow-sm">
                            <label for="updateBeneficiaries" class="form-label">Beneficiaries</label>
                            <input type="text" class="form-control" id="updateBeneficiaries" name="updateBeneficiaries" placeholder="Beneficiaries" required>
                        </div>

                        <div class="row border rounded p-3 mb-4 bg-light shadow-sm">
                            <label for="updateRequirements" class="form-label">Requirements</label>
                            <textarea class="form-control" id="updateRequirements" name="updateRequirements" placeholder="Program Requirements" required></textarea>
                        </div>

                        <div class="row border rounded p-3 mb-4 bg-light shadow-sm">
                            <div class="col-md-6 mb-3">
                                <label for="updateApplication_start" class="form-label">Application Start Date</label>
                                <input type="date" class="form-control" id="updateApplication_start" name="updateApplication_start" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="updateApplication_deadline" class="form-label">Application Deadline</label>
                                <input type="date" class="form-control" id="updateApplication_deadline" name="updateApplication_deadline" required>
                            </div>
                        </div>

                        <div class="row border rounded p-3 mb-4 bg-light shadow-sm">
                            <div class="col-md-6 mb-3">
                                <label for="updateSlot" class="form-label">Available Slots</label>
                                <input type="number" class="form-control" id="updateSlot" name="updateSlot" placeholder="Number of Slots" min="0" required>
                            </div>


                            <div class="col-md-6 mb-3">
                                <label for="updateStatus" class="form-label">Status</label>
                                <select class="form-control" id="updateStatus" name="updateStatus" required>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success btn-sm" name="updateScholarship" id="updateScholarship-btn">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- DELETE MODAL -->
    <div class="modal fade" id="delete-Modal" tabindex="-1" aria-labelledby="delete-Modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title fs-5">Delete Scholarship Program</h4>
                    <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Confirmation Message -->
                    <p id="deleteMessage">Are you sure you want to delete <strong id="deleteProgram_title"></strong> by: <strong id="deleteGrantor"></strong>?</p>
                </div>
                <div class="modal-footer">
                    <form id="deleteScholarshipForm" method="post">
                        <input type="hidden" id="deleteId" name="id">
                        <input type="hidden" id="deleteProgram" name="deleteProgram">
                        <button type="submit" class="btn btn-danger btn-sm" name="deleteScholarshipProgram">Confirm Delete</button>
                    </form>
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
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

    <script>
        var ownerId = '<?php echo $id; ?>';
        let isDropdownOpen = false; // Track the dropdown state

        $(document).ready(function() {
            // Add this AJAX request to get user count
            $.ajax({
                url: '../../controllers/adminController.php',
                type: 'POST',
                data: {
                    getAllScholarshipPrograms: true
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success === true) {
                        let scholarshipPrograms = response.scholarshipProgramsData;
                        let tbody = $('#dataTable tbody');
                        tbody.empty();
                        scholarshipPrograms.forEach(function(scholarshipPrograms, index) {

                            let statusText = scholarshipPrograms.status == 1 ? 'Active' : 'Inactive';
                          
                            let row = `<tr>
                                <td style="display:none;">${scholarshipPrograms.id}</td>
                                <td>${scholarshipPrograms.grantor}</td>
                                <td>${scholarshipPrograms.program_title}</td>
                                

                                <td>${scholarshipPrograms.application_start}</td>
                                <td>${scholarshipPrograms.application_deadline}</td>
                                <td>${scholarshipPrograms.slot}</td>
                                <td>${statusText}</td>

                                <td>
                                    <!-- Dropdown Button -->
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-secondary dropdown-toggle btn-sm" data-bs-toggle="dropdown" aria-expanded="false">
                                            Actions
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#" id="edit_btn" 
                                                data-id="${scholarshipPrograms.id}"
                                                data-grantor="${scholarshipPrograms.grantor}" 
                                                data-program_title="${scholarshipPrograms.program_title}"
                                                data-description="${scholarshipPrograms.description}"
                                                data-beneficiaries="${scholarshipPrograms.beneficiaries}"
                                                data-requirements="${scholarshipPrograms.requirements}" 
                                                data-application_start="${scholarshipPrograms.application_start}"
                                                data-application_deadline="${scholarshipPrograms.application_deadline}"
                                                data-slot="${scholarshipPrograms.slot}"
                                                data-status="${scholarshipPrograms.status}"
                                                data-bs-toggle="modal" data-bs-target="#update-Modal"><i class="fa fa-pen"></i> Edit</a>
                                            </li>
                                            <li><a class="dropdown-item" href="#" id="delete_btn"
                                                data-id="${scholarshipPrograms.id}"
                                                data-grantor="${scholarshipPrograms.grantor}"
                                                data-program_title="${scholarshipPrograms.program_title}"
                                                data-bs-toggle="modal" data-bs-target="#delete-Modal"><i class="fa fa-trash"></i> Delete</a>
                                            </li>
                                        </ul>
                                    </div>
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

            $('#addScholarshipForm').on('submit', function(event) {
                event.preventDefault(); // Prevent the default form submission
                // Log the values to verify they're being captured
                console.log('Grantor:', $('#grantor1').val());
                $.ajax({
                    url: '../../controllers/adminController.php',
                    type: 'POST',
                    data: {
                        addScholarshipProgram: true,
                        grantor: $('#grantor1').val(),
                        program_title: $('#program_title').val(),
                        description: $('#description').val(),
                        beneficiaries: $('#beneficiaries').val(),
                        requirements: $('#requirements').val(),
                        application_start: $('#application_start').val(),
                        application_deadline: $('#application_deadline').val(),
                        slot: $('#slot').val(),
                        status: $('#status').val()
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: response.message
                            }).then(() => {
                                // Optionally reload or update the UI
                                location.reload(); // Reloads the page to reflect changes
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', status, error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'An error occurred while processing your request.'
                        });
                    }
                });

            });

            $('#dataTable').on('click', '#edit_btn', function() {

                let id = $(this).data('id');
                let grantor = $(this).data('grantor');
                let program_title = $(this).data('program_title');
                let description = $(this).data('description');
                let beneficiaries = $(this).data('beneficiaries');
                let requirements = $(this).data('requirements');
                let application_start = $(this).data('application_start');
                let application_deadline = $(this).data('application_deadline');
                let slot = $(this).data('slot');
                let status = $(this).data('status');

                console.log(grantor);


                // Populate form fields with the retrieved data
                $('#updateId').val(id);
                $('#updateGrantor').val(grantor);
                $('#updateProgram_title').val(program_title);
                $('#updateDescription').val(description);
                $('#updateBeneficiaries').val(beneficiaries);
                $('#updateRequirements').val(requirements);
                $('#updateApplication_start').val(application_start);
                $('#updateApplication_deadline').val(application_deadline);
                $('#updateSlot').val(slot);
                $('#updateStatus').val(status);

            });

            $('#dataTable').on('click', '#delete_btn', function() {

                let id = $(this).data('id');
                let grantor = $(this).data('grantor');
                let program_title = $(this).data('program_title');

                console.log(grantor);

                // Populate form fields with the retrieved data
                $('#deleteId').val(id);
                $('#deleteGrantor').text(grantor);
                $('#deleteProgram_title').text(program_title);
                $('#deleteProgram').val(program_title);

            });

            $('#updateScholarshipForm').on('submit', function(event) {
                event.preventDefault();

                // let formData = $(this).serialize(); // Gather form data

                var formData = {
                    id: $('#updateId').val(),
                    updateGrantor: $('#updateGrantor').val(),
                    updateProgram_title: $('#updateProgram_title').val(),
                    updateDescription: $('#updateDescription').val(),
                    updateBeneficiaries: $('#updateBeneficiaries').val(),
                    updateRequirements: $('#updateRequirements').val(),
                    updateApplication_start: $('#updateApplication_start').val(),
                    updateApplication_deadline: $('#updateApplication_deadline').val(),
                    updateSlot: $('#updateSlot').val(),
                    updateStatus: $('#updateStatus').val(),
                    updateScholarshipProgram: true
                };

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
            });

            $('#deleteScholarshipForm').on('submit', function(event) {
                event.preventDefault();

                // Gather form data
                var formData = {
                    id: $('#deleteId').val(),
                    program_title: $('#deleteProgram').val(),
                    deleteScholarshipProgram: true
                };

                console.log(formData);
                // return false

                // Optionally add a loading indicator
                Swal.fire({
                    title: 'Processing...',
                    text: 'Please wait while we delete the scholarship program.',
                    allowOutsideClick: false,
                    onOpen: () => {
                        Swal.showLoading();
                    }
                });

                $.ajax({
                    url: '../../controllers/adminController.php', // Adjust this path as needed
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        Swal.close(); // Close the loading indicator

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
                                title: 'Delete Failed',
                                text: response.message
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.close(); // Close the loading indicator
                        Swal.fire({
                            icon: 'error',
                            title: 'Request Failed',
                            text: 'An error occurred while deleting the program. Please try again.'
                        });
                    }
                });
            });

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

<script>
    document.getElementById('slot').addEventListener('input', function() {
        if (this.value < 0) {
            this.value = 0;
        }
    });
    document.getElementById('updateSlot').addEventListener('input', function() {
        if (this.value < 0) {
            this.value = 0;
        }
    });
</script>

</html>