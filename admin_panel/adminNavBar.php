<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link rel="stylesheet" href="../bootstrap_files/bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="anim.css">
    <link rel="shortcut icon" href="../resourcesofwebsiteimg/icon.svg" type="image/x-icon">
    <!-- CSS -->

    <!-- icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- icons -->
</head>

<body data-bs-theme="light">


    <div class="container-fluid">

        <div class="row">

            <nav class="navbar navbar-expand-md bg-body-tertiary">
                <div class="container-fluid d-flex align-items-center">
                    <div class="col-1 col-lg-1 logo" style="height: 60px;"></div>
                    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                        <div class="offcanvas-header">
                            <div class="col-2 col-lg-1 logo" style="height: 60px;"></div>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <ul class="navbar-nav ms-auto gap-md-3">
                                <li class="nav-item">
                                    <a class="nav-link" href="adminDashboard.php">Dashboard</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="adminReportUser.php">User Management</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="adminReportSeller.php">Seller Management</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="adminReportProduct.php">Product Management</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="addproduct.php">Add Product</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="adminManagement.php">Management</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="status.php">Update Product status</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link link-danger fw-bold" href="#" onclick="admin_signout();">Sign Out <i class="bi bi-box-arrow-right"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Digital Clock -->
                    <div class="ms-auto me-4 " id="clock" style="font-size: 1rem;"></div>
                    <!-- Digital Clock -->
                </div>
            </nav>

        </div>

    </div>

    <!-- js -->
    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
    <!-- js -->

    <!-- js sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- js sweetalert -->

    <!-- Clock Script -->
    <script>
        function updateClock() {
            const clockElement = document.getElementById('clock');
            const now = new Date();
            const hours = now.getHours().toString().padStart(2, '0');
            const minutes = now.getMinutes().toString().padStart(2, '0');
            const seconds = now.getSeconds().toString().padStart(2, '0');
            clockElement.textContent = `${hours}:${minutes}:${seconds}`;
        }

        setInterval(updateClock, 1000); // Update clock every second
        updateClock(); // Initial call to display clock immediately
    </script>
    <!-- Clock Script -->
</body>

</html>
