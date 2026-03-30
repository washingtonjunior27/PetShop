<!-- MOBILE SIDENAV -->
<div class="offcanvas offcanvas-start main-bg" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
    <div class="offcanvas-header border-bottom border-white border-5">
        <h5 class="offcanvas-title text-light" id="sidebarMenuLabel">
            <i class="fa-solid fa-paw me-2"></i>PetShop
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
    </div>
    <div class="offcanvas-body d-flex flex-column">
        <div id="sidenavMobileAccordion" class="sidenav-links d-flex flex-column gap-4 flex-grow-1">
            <?php
            $sidenavParent = "sidenavMobileAccordion";
            require "Sidenav.php";
            ?>
        </div>

        <div class="sidenav-item w-100 ps-5 border-5 border-top border-light py-4">
            <a href="<?= BASE_URL ?>/logout" class="nav-link d-flex align-items-center gap-3">
                <i class="fa-solid fa-arrow-right-from-bracket text-light fs-2"></i>
                <span class="text-light fs-6 fw-semibold">Logout</span>
            </a>
        </div>
    </div>
</div>