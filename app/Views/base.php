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

    <!-- Font awesome 6.1.2 -->
    <script src="https://kit.fontawesome.com/5f0a932aad.js" crossorigin="anonymous"></script>

    <style>
        .cart-hidde {
            display: none;
        }

        @media only screen and (max-width: 991px) {
            .free-shipping-text {
                display: none !important;
            }

            .cart-hidde {
                display: flex;
            }
        }
    </style>


</head>

<body>

    <header>

        <?php if ($this->renderSection('announcementBar')): ?>
            <?= $this->renderSection('announcementBar') ?>
        <?php endif; ?>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <div class="row">
                    <div class="container-fluid">
                        <div class="col-md-12">
                            <a href="<?= base_url('/') ?>" class="navbar-brand">
                                <img src="https://new-ella-demo.myshopify.com/cdn/shop/files/ella-logo-black-compressor.png?v=1629858814&width=300" alt="" width="90" height="41" class="d-inline-block align-text-top">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="container-fluid">
                                <div class="collapse navbar-collapse justify-content-end">
                                    <div class="col-md-4">
                                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-flex justify-content-end">
                                            <li class="nav-item">
                                                <span class="fs-6 text nav-link">Customer Service 091 234-ELLA</span>
                                            </li>
                                            <li class="nav-item dropdown">
                                                <a class="fs-6 text nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    END
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                                    <li>
                                                        <hr class="dropdown-divider">
                                                    </li>
                                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                                </ul>
                                            </li>
                                            <li class="fs-6 text nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    USD
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                                    <li>
                                                        <hr class="dropdown-divider">
                                                    </li>
                                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-2">
                                        <form class="d-flex" role="search">
                                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                                            <button class="btn btn-outline-success" type="submit">Search</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-end">
                        <div class="col-md-6">
                            <div class="container-fluid">
                                <h6 class="free-shipping-text d-flex justify-content-end">Free shipping on All Orders. No Minimum Purchase</h6>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <div class="cart-hidde col-md-6 col-sm-6">
                            <div class="container-fluid">
                                <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbar_main-content" aria-controls="navbar_main-content" aria-expanded="false" aria-label="Toggle navigation">
                                    <i class="fa-solid fa-user"></i>
                                </button>
                                <div class="collapse navbar-collapse justify-content-end" id="navbar_main-content">
                                    <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="margin-right: 0px !important;">
                                        <?php if (isset($isLoginPage) && $isLoginPage): ?>
                                            <li class="nav-item">
                                                <a href="<?= base_url('/') ?>" class="nav-link">Home</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="<?= base_url('auth/login'); ?>" class="nav-link">Login</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="<?= base_url('auth/register') ?>" class="nav-link">Register</a>
                                            </li>
                                        <?php else: ?>
                                            <?php if (session()->get('user_id')): ?>
                                                <li class="nav-item dropdown">
                                                    <a role="button" href="#" class="nav-link dropdown-toggle" id="settingsDropdown" data-bs-toggle="dropdown" aria-expanded="false">My profile</a>
                                                    <ul class="dropdown-menu" aria-labelledby="settingsDropdown">
                                                        <li class="list-group-item"><a href="<?= base_url('/profile') ?>">Edit Profile</a></li>
                                                        <li class="list-group-item"><a href="<?= base_url('orders/history') ?>">Order History</a></li>
                                                        <li class="list-group-item"><a href="<?= base_url('wishlist') ?>">Wishlist</a></li>
                                                        <li class="list-group-item"><a href="<?= base_url('profile/updatePassword') ?>">Change Password</a></li>
                                                        <li class="list-group-item"><a href="<?= base_url('logout') ?>">Logout</a></li>
                                                    </ul>
                                                </li>
                                                <li class="nav-item dropdown">
                                                    <a role="button" href="#" class="nav-link dropdown-toggle" id="settingsDropdown" data-bs-toggle="dropdown" aria-expanded="false">Settings</a>
                                                    <ul class="dropdown-menu" aria-labelledby="settingsDropdown">
                                                        <li><a href="<?= base_url('settings/description') ?>" class="dropdown-item">Description</a></li>
                                                        <li><a href="<?= base_url('settings/assign_attributes') ?>" class="dropdown-item">Assign Attributes</a></li>
                                                    </ul>
                                                </li>
                                            <?php else: ?>
                                                <li class="nav-item">
                                                    <a href="<?= base_url('/') ?>" class="nav-link">Shopping Cart</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="<?= base_url('/') ?>" class="nav-link">My favorite</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="<?= base_url('auth/login'); ?>" class="nav-link">Sign in or Create an account</a>
                                                </li>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="container-fluid">
                                <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbar_main-content" aria-controls="navbar_main-content" aria-expanded="false" aria-label="Toggle navigation">
                                    <i class="fa-solid fa-user"></i>
                                </button>
                                <div class="collapse navbar-collapse justify-content-end" id="navbar_main-content">
                                    <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="margin-right: 0px !important;">
                                        <?php if (isset($isLoginPage) && $isLoginPage): ?>
                                            <li class="nav-item">
                                                <a href="<?= base_url('/') ?>" class="nav-link">Home</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="<?= base_url('auth/login'); ?>" class="nav-link">Login</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="<?= base_url('auth/register') ?>" class="nav-link">Register</a>
                                            </li>
                                        <?php else: ?>
                                            <?php if (session()->get('user_id')): ?>
                                                <li class="nav-item dropdown">
                                                    <a role="button" href="#" class="nav-link dropdown-toggle" id="settingsDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="color: black;">My profile</a>
                                                    <ul class="dropdown-menu" aria-labelledby="settingsDropdown">
                                                        <li class="list-group-item"><a href="<?= base_url('/profile') ?>">Edit Profile</a></li>
                                                        <li class="list-group-item"><a href="<?= base_url('profile/dashboard') ?>">General Manager</a></li>
                                                        <li class="list-group-item"><a href="<?= base_url('orders/history') ?>">Order History</a></li>
                                                        <li class="list-group-item"><a href="<?= base_url('wishlist') ?>">Wishlist</a></li>
                                                        <li class="list-group-item"><a href="<?= base_url('profile/updatePassword') ?>">Change Password</a></li>
                                                        <li class="list-group-item"><a href="<?= base_url('logout') ?>">Logout</a></li>
                                                    </ul>
                                                </li>
                                                <li class="nav-item dropdown">
                                                    <a role="button" href="#" class="nav-link dropdown-toggle" id="settingsDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="color: black;">Settings</a>
                                                    <ul class="dropdown-menu" aria-labelledby="settingsDropdown">
                                                        <li><a href="<?= base_url('settings/description') ?>" class="dropdown-item">Description</a></li>
                                                        <li><a href="<?= base_url('settings/assign_attributes') ?>" class="dropdown-item">Assign Attributes</a></li>
                                                    </ul>
                                                </li>
                                            <?php else: ?>
                                                <li class="nav-item">
                                                    <a href="<?= base_url('/') ?>" class="nav-link">Shopping Cart</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="<?= base_url('/') ?>" class="nav-link">My favorite</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="<?= base_url('auth/login'); ?>" class="nav-link">Sign in or Create an account</a>
                                                </li>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <div class="row bg-black">
            <ul class="nav justify-content-center">
                <li class="nav-item">
                    <a class="nav-link text-white active" aria-current="page" href="#">Active</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white disabled" aria-disabled="true">Disabled</a>
                </li>
            </ul>
        </div>

        <?php if ($this->renderSection('banner') !== null): ?>
            <?= $this->renderSection('banner'); ?>
        <?php endif; ?>

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