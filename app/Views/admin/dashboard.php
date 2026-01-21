<?= $this->extend('base'); ?>
<?= $this->section('title') ?>
Dashboard
<?= $this->endSection() ?>
<?= $this->section('content') ?>

<style>
    /* Sidebar styles */

    #sidebar {
        min-height: 100vh;
        background-color: #343a40;
    }

    #sidebar .nav-link {
        color: white;
    }

    #sidebar .nav-link:hover {
        background-color: #495057;
    }

    #content {
        padding: 2rem; 
    }

    .navbar {
        background-color: #6c757d; 
    }

    .navbar .navbar-brand, .navbar .nav-link {
        color: white;
    }

</style>

<div class="container-fluid">
    <div class="row">
        <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar">
            <div class="position-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="#" class="nav-link active">
                            <i class="bi bi-speedometer2"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-box-seam"></i>
                            Products
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('profile/dashboard/design')?>" class="nav-link">
                            <i class="bi bi-brush"></i>
                            Design Customization
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-graph-up"></i>
                            SEO Tools
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-person"></i>
                            User Management
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main Content Area -->

        <div id="content" class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <!-- Top Navbar -->
            <nav class="navbar navbar-expand-lg navbar-dark">
                <div class="container-fluid">
                    <a href="#" class="navbar-brand">Owner Dashboard</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a href="#" class="nav-link">Profile</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Dashboard Main Content -->

            <div class="container mt-4">
                <h2>Welcome, Owner!</h2>
                <p>Select an option from the sidebar to manage your ecommerce platform.</p>
            </div>

        </div>

    </div>
</div>

<?= $this->endSection() ?>