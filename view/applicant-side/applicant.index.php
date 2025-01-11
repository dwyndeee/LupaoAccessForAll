<?php

session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: ../../index.php');
    exit;
}

$firstname = isset($_SESSION['firstname']) ? $_SESSION['firstname'] : 'Guest';
$lastname = isset($_SESSION['lastname']) ? $_SESSION['lastname'] : 'Guest';
$email = isset($_SESSION['email']) ? $_SESSION['email'] : 'Guest';

$role = isset($_SESSION['role']) ? $_SESSION['role'] : '';
$id = isset($_SESSION['id']) ? $_SESSION['id'] : '';

$response = []; // Initialize response array

if (strtolower($role) !== 'applicant') {
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
    <link rel="icon" href="../../assets/img/Lupao_Nueva_Ecija_seal_logo.png ">

    <link href="../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />


    <link href="../../assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <div id="wrapper">

        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="applicant.index.php">
                <div class="sidebar-brand-icon" style="width: 50px; height: 40px;">
                    <img src="../../assets/img/Lupao_Nueva_Ecija_seal_logo.png" alt="Logo" style="width: 100%; height: 100%;">
                </div>
                <div class="sidebar-brand-text mx-3">Access For All</div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item active">
                <a class="nav-link" href="applicant.index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <hr class="sidebar-divider d-none d-md-block">

            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <?php
                include('applicant-header.php');
                ?>

                <div class="container-fluid">

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Welcome aboard! <?php echo $firstname . " " . $lastname; ?>
                        </h1>
                    </div>

                    <div class="row">

                        <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Available Scholarship</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="schoCount">201</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-book fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Available Jobs</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="jobCount">525</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-briefcase fa-2x text-gray-300"></i>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="row">

                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Scholarships</h6>
                                </div>
                                <div class="card-body">
                                    <div class="search-bar mb-3">
                                        <input type="text" class="form-control" id="scholarshipSearch"
                                            placeholder="Search Scholarship...">
                                    </div>
                                    <div class="scholarships-list">

                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-4 col-lg-7">
                            <div class="card shadow mb-4">
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Announcements</h6>

                                </div>
                                <div class="card-body">
                                    <div class="announcements-list">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-xl-12 col-lg-7">
                            <div class="card shadow mb-4">
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Available Jobs</h6>

                                </div>
                                <div class="card-body">
                                    <div class="search-bar mb-3">
                                        <input type="text" class="form-control" id="jobSearch"
                                            placeholder="Search Jobs...">
                                    </div>
                                    <div class="jobs-list">

                                    </div>
                                </div>
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

    <!-- Job Application Modal -->
    <div class="modal fade" id="jobApplicationModal" tabindex="-1" role="dialog"
        aria-labelledby="jobApplicationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="jobApplicationModalLabel">Apply for this Job</h5>
                    <button type="button" class="close btn-lg text-white" data-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times fa-sm"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form fields for application -->
                    <form id="applyJobForm" class="p-4 bg-white shadow rounded">
                        <input hidden id="jobId" name="jobId">
                        <input hidden id="applicantId" name="applicantId">
                        <input hidden id="applicantEmail" name="applicantEmail">

                        <h3 class="text-primary mb-3">Job Description</h3>
                        <div class="card mb-4 shadow-sm border-0">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <p id="jobDescription" class="text-secondary mb-0"></p>
                            </div>
                        </div>
                        <h3 class="text-primary mb-3">Requirements</h3>
                        <div class="card mb-4 shadow-sm border-0">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <p id="jobRequirements" class="text-secondary mb-0"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="requirement_1" class="form-label">Upload your Resume:</label>
                                <input type="file" id="requirement_1" name="requirement_1"
                                    accept=".pdf,.doc,.docx,.png,.jpeg" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="requirement_2" class="form-label">Requirements 2</label>
                                <input type="file" id="requirement_2" name="requirement_2"
                                    accept=".pdf,.doc,.docx,.png,.jpeg" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="requirement_3" class="form-label">Requirements 3</label>
                                <input type="file" id="requirement_3" name="requirement_3"
                                    accept=".pdf,.doc,.docx,.png,.jpeg" class="form-control">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="requirement_4" class="form-label">Requirements 4</label>
                                <input type="file" id="requirement_4" name="requirement_4"
                                    accept=".pdf,.doc,.docx,.png,.jpeg" class="form-control">
                            </div>
                        </div>
                        <!-- Add more fields as necessary -->
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" form="applyJobForm" class="btn btn-primary btn-md shadow-sm px-4">Submit
                        Application</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scholar Application Modal -->
    <div class="modal fade" id="scholarApplicationModal" tabindex="-1" role="dialog"
        aria-labelledby="scholarApplicationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="scholarApplicationModalLabel">Apply for this Scholarship</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form fields for application -->
                    <form id="applyScholarForm" class="p-4 bg-white shadow rounded">
                        <input hidden id="scholarshipId" name="scholarshipId">
                        <input hidden id="schoApplicantId" name="schoApplicantId">
                        <input hidden id="schoApplicantEmail" name="schoApplicantEmail">
                        <h3 class="text-primary mb-3">Program Description</h3>
                        <div class="card mb-2">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <p id="scholarDescription" class="text-secondary mb-0"></p>
                            </div>
                        </div>
                        <h3 class="text-primary mb-3">Requirements</h3>
                        <div class="card mb-2">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <p id="scholarRequirements" class="text-secondary mb-0"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="requirement_1" class="form-label">School ID</label>
                                <input type="file" id="requirement_1" name="requirement_1"
                                    accept=".pdf,.doc,.docx,.png,.jpeg" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="requirement_2" class="form-label">Birth Certificate(PSA)</label>
                                <input type="file" id="requirement_2" name="requirement_2"
                                    accept=".pdf,.doc,.docx,.png,.jpeg" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="requirement_3" class="form-label">Certificate of Enrollment</label>
                                <input type="file" id="requirement_3" name="requirement_3"
                                    accept=".pdf,.doc,.docx,.png,.jpeg" class="form-control">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="requirement_4" class="form-label">Certificate of Grades</label>
                                <input type="file" id="requirement_4" name="requirement_4"
                                    accept=".pdf,.doc,.docx,.png,.jpeg" class="form-control">
                            </div>
                        </div>
                        <!-- Add more fields as necessary -->
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" form="applyScholarForm" class="btn btn-primary btn-md shadow-sm px-4">Submit
                        Application</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="viewAnnouncementModal" tabindex="-1" role="dialog"
        aria-labelledby="viewAnnouncementModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="jobApplicationModalLabel">View Description</h5>
                    <button type="button" class="close btn-lg text-white" data-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times fa-sm"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form fields for application -->
                    <form id="viewAnnouncement" class="p-4 bg-white shadow rounded">
                        <input hidden id="announcementId" name="announcementId">

                        <h3 class="text-primary mb-3">Announcement</h3>
                        <div class="card mb-4 shadow-sm border-0">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <p id="announcementDescription" class="text-secondary mb-0"></p>
                            </div>
                        </div>
                        <!-- Add more fields as necessary -->
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="../../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../../assets/js/sb-admin-2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>

    <script>
        var ownerId = '<?php echo $id; ?>'; // PHP session variable embedded in JavaScript                
        let isDropdownOpen = false; // Track the dropdown state

        $(document).ready(function() {

            var applicant_id = '<?php echo $id; ?>';
            var applicant_email = '<?php echo $email; ?>';

            $.ajax({
                url: '../../controllers/adminController.php',
                type: 'POST',
                data: {
                    getAllJobs: true
                },
                dataType: 'json',
                success: function(response) {

                    console.log(response);

                    if (response.success === true) {
                        let jobs = response.jobsData;
                        let container = $('.jobs-list');
                        container.empty();

                        function displayJobs(filteredJobs) {
                            container.empty();

                            filteredJobs.forEach(function(jobs, index) {

                                let statusText = jobs.status === null ? 'Pending' : (jobs.status == 1 ? 'On Going' : 'Already Filled');
                                let badgeClass = jobs.status === null ? 'badge-secondary' : (jobs.status == 1 ? 'badge-primary' : 'badge-warning');

                                let applicationStartFormatted = new Date(jobs.application_start).toLocaleDateString('en-US', {
                                    year: 'numeric',
                                    month: 'long',
                                    day: 'numeric'
                                });

                                let applicationDeadlineFormatted = new Date(jobs.application_deadline).toLocaleDateString('en-US', {
                                    year: 'numeric',
                                    month: 'long',
                                    day: 'numeric'
                                });

                                // Check if the user ID is available in the session
                                // const userId = "<?php echo isset($_SESSION['id']) ? htmlspecialchars($_SESSION['id'], ENT_QUOTES, 'UTF-8') : ''; ?>";

                                // Determine if the user has applied for the job
                                let isApplied = jobs.isApplied;
                                let card = `
                                    <div class="card mb-2">
                                        <div class="card-body d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="card-title mb-0 text-dark font-weight-bold">${jobs.position}</h6>
                                                <p class="mb-0 small text-dark">${jobs.company} - ${jobs.employer_name}</p>
                                                <p class="mb-0 small">${applicationStartFormatted} - ${applicationDeadlineFormatted}</p>
                                                <p class="mb-0 small badge ${badgeClass}">${statusText}</p>
                                            </div>
                                            <div>
                                                ${isApplied ?
                                                `<button class="btn btn-secondary btn-sm" disabled>Applied</button>
                                                <a href="applicant-logs.php" class="btn btn-primary btn-sm">Check Status</a>` :
                                                `<button type="button" class="btn btn-primary btn-sm applyJob-btn" id="apply-btn"
                                                    data-toggle="modal"
                                                    data-target="#jobApplicationModal"
                                                    data-job-id="${jobs.id}"
                                                    data-job-requirements="${jobs.requirements}"
                                                    data-job-description="${jobs.description}">
                                                    Apply
                                                </button>`
                                                }
                                            </div>
                                        </div>
                                    </div>
                                `;


                                container.append(card);
                            });
                        }

                        // Initial display of all jobs
                        displayJobs(jobs);

                        // Search functionality
                        $('#jobSearch').on('input', function() {
                            let searchValue = $(this).val().toLowerCase();
                            let filteredJobs = jobs.filter(function(job) {
                                return job.position.toLowerCase().includes(searchValue) ||
                                    job.company.toLowerCase().includes(searchValue) ||
                                    job.employer_name.toLowerCase().includes(searchValue);
                            });
                            displayJobs(filteredJobs);
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

            $(document).on('click', '#apply-btn', function() {
                const jobId = $(this).data('job-id');
                const jobRequirements = $(this).data('job-requirements');
                const jobDescription = $(this).data('job-description');

                // Populate the modal fields
                $('#jobId').val(jobId);
                $('#jobRequirements').text(jobRequirements); // Use .text() for <p> elements
                $('#jobDescription').text(jobDescription); // Use .text() for <p> elements
            });


            $('#applyJobForm').on('submit', function(e) {
                e.preventDefault();

                let formData = new FormData(this);
                formData.append('applyJob', true);

                Swal.fire({
                    title: 'Processing your request',
                    text: 'Please wait...',
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                $.ajax({
                    url: '../../controllers/applicantController.php',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: 'json', // Specify that the response is expected to be JSON
                    success: function(response) {
                        Swal.close(); // Close the loading modal

                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: response.message
                            }).then(() => {
                                location.reload(); // Reload the page after success
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Submission Failed',
                                text: response.message,
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.close(); // Close the loading modal in case of error

                        Swal.fire({
                            icon: 'error',
                            title: 'Request Failed',
                            text: 'Something went wrong while submitting your application. Please try again.',
                        });
                    }
                });
            });

            $.ajax({
                url: '../../controllers/adminController.php',
                type: 'POST',
                data: {
                    getAllScholarshipPrograms: true
                },
                dataType: 'json',
                success: function(response) {

                    console.log(response);

                    if (response.success === true) {
                        let scholarships = response.scholarshipProgramsData;
                        let container = $('.scholarships-list');
                        container.empty();

                        function displayScholarships(filteredScholarships) {
                            container.empty();

                            filteredScholarships.forEach(function(scholarships, index) {

                                let statusText = scholarships.status === null ? 'Pending' : (scholarships.status == 1 ? 'Active' : 'Inactive');
                                let badgeClass = scholarships.status === null ? 'badge-secondary' : (scholarships.status == 1 ? 'badge-primary' : 'badge-warning');

                                let applicationStartFormatted = new Date(scholarships.application_start).toLocaleDateString('en-US', {
                                    year: 'numeric',
                                    month: 'long',
                                    day: 'numeric'
                                });

                                let applicationDeadlineFormatted = new Date(scholarships.application_deadline).toLocaleDateString('en-US', {
                                    year: 'numeric',
                                    month: 'long',
                                    day: 'numeric'
                                });

                                // Check if the user ID is available in the session
                                // const userId = "<?php echo isset($_SESSION['id']) ? htmlspecialchars($_SESSION['id'], ENT_QUOTES, 'UTF-8') : ''; ?>";

                                // Determine if the user has applied for the scholarship
                                let isApplied = scholarships.isApplied;
                                let haveSlot = scholarships.slot;
                                let card = `
                                <div class="card mb-2">
                                    <div class="card-body d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="card-title mb-0 text-dark font-weight-bold">${scholarships.program_title}</h6>
                                            <p class="mb-0 small text-dark">${scholarships.description}</p>
                                            <p class="mb-0 small">${applicationStartFormatted} - ${applicationDeadlineFormatted}</p>
                                            <p class="mb-0 small badge ${badgeClass}">${statusText}</p>
                                        </div>
                                        <div>
                                            ${haveSlot > 0 ? (
                                                isApplied
                                                    ? `<button class="btn btn-secondary btn-sm" disabled>Applied</button>
                                                    <a href="applicant-logs.php" class="btn btn-primary btn-sm">Check Status</a>`
                                                    : `<button class="btn btn-primary btn-sm applyScho-btn" 
                                                        data-toggle="modal" 
                                                        data-target="#scholarApplicationModal" 
                                                        data-program-id="${scholarships.id}" 
                                                        data-program-description="${scholarships.description}" 
                                                        data-program-requirements="${scholarships.requirements}">
                                                        Apply
                                                    </button>`
                                            ) : `<button class="btn btn-secondary btn-sm" disabled>Full</button>`}
                                        </div>
                                    </div>
                                </div>
                            `;





                                container.append(card);
                            });
                        }

                        // Initial display of all jobs
                        displayScholarships(scholarships);

                        // Search functionality
                        $('#scholarshipSearch').on('input', function() {
                            let searchValue = $(this).val().toLowerCase();
                            let filteredScholarships = scholarships.filter(function(scholarship) {
                                return scholarship.program_title.toLowerCase().includes(searchValue) ||
                                    scholarship.grantor.toLowerCase().includes(searchValue);
                            });
                            displayScholarships(filteredScholarships);
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

            $(document).on('click', '.applyScho-btn', function() {
                const programId = $(this).data('program-id');
                const programRequirements = $(this).data('program-requirements');
                const programDescription = $(this).data('program-description');

                $('#scholarshipId').val(programId);
                $('#schoApplicantId').val(applicant_id);
                $('#schoApplicantEmail').val(applicant_email);
                $('#scholarRequirements').text(programRequirements);
                $('#scholarDescription').text(programDescription);

                console.log('Job ID passed to modal:', programId);
                console.log('User ID:', applicant_id);
            });

            $('#applyScholarForm').on('submit', function(e) {
                e.preventDefault();

                let formData = new FormData(this);
                formData.append('applyScholar', true);

                // console.log(...formData);
                // return false;

                Swal.fire({
                    title: 'Processing your request',
                    text: 'Please wait...',
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                $.ajax({
                    url: '../../controllers/applicantController.php',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: 'json', // Specify that the response is expected to be JSON
                    success: function(response) {
                        Swal.close(); // Close the loading modal

                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: response.message
                            }).then(() => {
                                location.reload(); // Reload the page after success
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Submission Failed',
                                text: response.message,
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.close(); // Close the loading modal in case of error

                        Swal.fire({
                            icon: 'error',
                            title: 'Request Failed',
                            text: 'Something went wrong while submitting your application. Please try again.',
                        });
                    }
                });
            });

            $(document).on('click', '.viewAnnouncement-btn', function() {
                const announcementId = $(this).data('announcement-id');
                const announcementDescription = $(this).data('description');

                $('#scholarshipId').val(announcementId);

                // Decode and display the HTML content properly
                $('#announcementDescription').html(announcementDescription);

                console.log(announcementId);
                console.log(announcementDescription);
            });

            $.ajax({
                url: '../../controllers/adminController.php',
                type: 'POST',
                data: {
                    getAllAnnouncements: true
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response);

                    if (response.success === true) {
                        let announcements = response.announcementsData;
                        let container = $('.announcements-list');
                        container.empty();

                        function displayAnnouncements() {
                            container.empty();

                            announcements.forEach(function(announcement) {
                                // Check if the announcement status is 1 (active)
                                if (announcement.status == 1) {
                                    let createdAtFormatted = new Date(announcement.created_at).toLocaleDateString('en-US', {
                                        year: 'numeric',
                                        month: 'long',
                                        day: 'numeric'
                                    });

                                    let card = `
                            <div class="card mb-2">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="card-title mb-0 text-dark font-weight-bold">${announcement.title}</h6>
                                        <p class="mb-0 small">${createdAtFormatted}</p>
                                    </div>
                                    <button class="btn btn-primary btn-sm viewAnnouncement-btn" 
                                        data-toggle="modal" 
                                        data-target="#viewAnnouncementModal" 
                                        data-announcement-id="${announcement.id}">
                                        View More
                                    </button>
                                    <div class="hidden-description" style="display: none;">${announcement.description}</div>
                                </div>
                            </div>
                        `;

                                    container.append(card);
                                }
                            });
                        }

                        // Display announcements
                        displayAnnouncements();

                        // Handle the view button click
                        $(document).on('click', '.viewAnnouncement-btn', function() {
                            const announcementId = $(this).data('announcement-id');
                            const descriptionHTML = $(this).siblings('.hidden-description').html();

                            $('#scholarshipId').val(announcementId);
                            $('#announcementDescription').html(descriptionHTML); // Render the HTML content

                            console.log(announcementId);
                            console.log(descriptionHTML);
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


            $.ajax({
                url: '../../controllers/analyticsController.php', // Update this path to the actual PHP file location
                type: 'POST',
                data: {
                    programCount: true,
                    ownerId: null
                }, // You can specify an ownerId if needed
                dataType: 'json',
                success: function(response) {
                    console.log("Program Count:", response.programsCount);
                    // Use the count as needed, for example:
                    $('#schoCount').text(response.programsCount);
                },
                error: function(error) {
                    console.error("Error fetching program count:", error);
                }
            });

            $.ajax({
                url: '../../controllers/analyticsController.php', // Update this path to the actual PHP file location
                type: 'POST',
                data: {
                    jobsCount: true,
                    ownerId: null
                }, // You can specify an ownerId if needed
                dataType: 'json',
                success: function(response) {
                    console.log("Jobs Count:", response.jobsCount);
                    // Use the count as needed, for example:
                    $('#jobCount').text(response.jobsCount);
                },
                error: function(error) {
                    console.error("Error fetching jobs count:", error);
                }
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
                        sender_id: ownerId
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