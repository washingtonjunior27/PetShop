<!-- MOBILE SIDENAV -->
<div class="offcanvas offcanvas-start main-bg" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
    <div class="offcanvas-header border-bottom border-white border-5">
        <h5 class="offcanvas-title text-light" id="sidebarMenuLabel">
            <i class="fa-solid fa-paw me-2"></i>PetShop
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="sidenav-links d-flex flex-column gap-4">
            <?php require "Sidenav.php" ?>
        </div>
    </div>
</div>