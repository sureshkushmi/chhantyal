<div class="container-fluid nav-bar p-0">
    <nav class="navbar navbar-expand-lg navbar-light bg-white px-4 px-lg-5 py-3 py-lg-0">
        <a href="<?php echo home_url(); ?>" class="navbar-brand p-0 d-flex align-items-center">
            <h1 class="display-5 text-secondary m-0 d-flex align-items-center">
                <img src="<?php echo get_template_directory_uri(); ?>/img/brand-logo.png" class="img-fluid me-2" alt="">
                छन्त्याल संघ
            </h1>
            <img src="<?php echo get_template_directory_uri(); ?>/img/flag.png" alt="Logo" class="ms-2" style="height: 83px; width: auto;">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="fa fa-bars"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">
            <?php
            wp_nav_menu([
                'theme_location'    => 'primary', // must match functions.php
                'depth'             => 3, // number of submenu levels
                'menu_class'        => 'navbar-nav ms-auto py-0',
                'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
                'walker'            => new WP_Bootstrap_Navwalker(),
            ]);
            ?>

            <button class="btn btn-primary btn-md-square border-secondary mb-3 mb-md-3 mb-lg-0 me-3" data-bs-toggle="modal" data-bs-target="#searchModal">
                <i class="fas fa-search"></i>
            </button>
            <a href="" class="btn btn-primary border-secondary rounded-pill py-2 px-4 px-lg-3 mb-3 mb-md-3 mb-lg-0">Donate</a>
        </div>
    </nav>
</div>
