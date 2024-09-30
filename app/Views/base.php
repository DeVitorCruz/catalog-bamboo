<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->renderSection('title') ?></title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- noUiSlider CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.5.1/nouislider.min.css">

    <!-- noUiSider JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.5.1/nouislider.min.js"></script>


</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a href="<?= base_url('/') ?>" class="navbar-brand">My E-Commerce</a>
                <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <?php if (isset($isLoginPage) && $isLoginPage): ?>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a href="<?= base_url('auth/login'); ?>" class="nav-link">Login</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('auth/cadastre') ?>" class="nav-link">Register</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('/') ?>" class="nav-link">Home</a>
                            </li>
                        </ul>
                    </div>
                <?php else: ?>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a href="<?= base_url('auth/login'); ?>" class="nav-link">Login</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('/') ?>" class="nav-link">Home</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('product') ?>" class="nav-link">Product List</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('product/create') ?>" class="nav-link">Add Product</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a role="button" href="#" class="nav-link dropdown-toggle" id="settingsDropdown" data-bs-toggle="dropdown" aria-expanded="false">Settings</a>
                                <ul class="dropdown-menu" aria-labelledby="settingsDropdown">
                                    <li><a href="<?= base_url('settings/description') ?>" class="dropdown-item">Description</a></li>
                                    <li><a href="<?= base_url('settings/assign_attributes') ?>" class="dropdown-item">Assign Attributes</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        </nav>
    </header>

    <main class="container">
        <?= $this->renderSection('content') ?>
    </main>

    <footer class="bg-light text-center py-4">
        <p>&copy;<?= date('Y'); ?> My Ecommerce Site</p>
    </footer>

    <!-- Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>