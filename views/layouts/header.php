<!-- Header Start -->
<!-- <header class="header-compact header-absolute"> -->
<style>
    @media (max-width: 768px) {
        .menu-title {
            display: none;
        }

        .web-logo h2 {
            margin-bottom: 0;
        }
    }
</style>
<header class="header-compact">
    <div class="top-nav top-header sticky-header" style="background-color: #9D2449;">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="navbar-top">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="dropdown d-md-none">
                                <a class="web-logo nav-logo dropdown-toggle" href="/supplier/search" role="button" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white;">
                                    <h2 class="logo-title">tabasco.gob.mx</h2>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/supplier/search">Inicio</a>
                                    <a class="dropdown-item" href="https://transparencia.tabasco.gob.mx">Transparencia</a>
                                    <a class="dropdown-item" href="https://transparencia.tabasco.gob.mx/">Gobierno</a>
                                    <a class="dropdown-item" href="https://tabasco.gob.mx/noticias">Noticias</a>
                                    <a class="dropdown-item" href="https://tabasco.gob.mx/tramites-y-servicios">Trámites</a>
                                </div>
                            </div>
                            <a class="web-logo nav-logo d-none d-md-block" href="/supplier/search" style="color: white;">
                                <h2 class="logo-title">tabasco.gob.mx</h2>
                            </a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                        </div>
                        <div class="rightside-box">
                            <a href="https://transparencia.tabasco.gob.mx" style="margin-right: 15px; color: white;">
                                <h2 class="menu-title">Transparencia</h2>
                            </a>
                            <a href="https://transparencia.tabasco.gob.mx/" style="margin-right: 15px; color: white;">
                                <h2 class="menu-title">Gobierno</h2>
                            </a>
                            <a href="https://tabasco.gob.mx/noticias" style="margin-right: 15px; color: white;">
                                <h2 class="menu-title">Noticias</h2>
                            </a>
                            <a href="https://tabasco.gob.mx/tramites-y-servicios" style="margin-right: 15px; color: white;">
                                <h2 class="menu-title">Trámites</h2>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        function hideMenuItems() {
            if (window.innerWidth <= 768) {
                document.querySelectorAll('.rightside-box a').forEach(function(element) {
                    element.style.display = 'none';
                });
            }
        }

        hideMenuItems();
        window.addEventListener('resize', hideMenuItems);
    });
</script>




<!-- Header End -->