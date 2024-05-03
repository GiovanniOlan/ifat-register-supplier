<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="/dashboard_template/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="/dashboard_template/css/sb-admin-2.min.css" rel="stylesheet">

</head>
<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?= $this->render('sidebar') ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <?= $this->render('top-bar') ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <?= $content ?>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <?= $this->render('footer') ?>

            <!-- End of Footer -->

        </div>
        <?= $this->render('scroll-top-button') ?>
        <?= $this->render('logout-modal') ?>

        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->


    <!-- Bootstrap core JavaScript-->
    <!-- <script src="/dashboard_template/vendor/jquery/jquery.min.js"></script> -->
    <!-- <script src="/dashboard_template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script> -->

    <!-- Core plugin JavaScript-->
    <!-- <script src="/dashboard_template/vendor/jquery-easing/jquery.easing.min.js"></script> -->

    <!-- Custom scripts for all pages-->
    <!-- <script src="/dashboard_template/js/sb-admin-2.min.js"></script> -->
    <!-- Bootstrap core JavaScript-->
    <script src="/dashboard_template/vendor/jquery/jquery.min.js"></script>
    <script src="/dashboard_template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="/dashboard_template/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/dashboard_template/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="/dashboard_template/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="/dashboard_template/js/demo/chart-area-demo.js"></script>
    <script src="/dashboard_template/js/demo/chart-pie-demo.js"></script>
    <script>
        // Mostrar el formulario de rechazo
        $('#rejectBtn').click(function(event) {
            event.stopPropagation();
            $('#rejectFormContainer').show();
            $('#acceptFormContainer').hide();
            $('#cancelBtn').show();
        });

        // Mostrar el formulario de aceptación 
        $('#acceptBtn').click(function(event) {
            event.stopPropagation();
            $('#acceptFormContainer').show();
            $('#rejectFormContainer').hide();
            $('#cancelBtn').show();
        });

        // Ocultar los formularios 
        $('#cancelBtn').click(function(event) {
            event.stopPropagation();
            $('#acceptFormContainer, #rejectFormContainer').hide();
            $('#cancelBtn').hide();
        });

        // Prevenir que los clics dentro de los formularios oculten los forms
        $('#rejectFormContainer, #acceptFormContainer').click(function(event) {
            event.stopPropagation();
        });

        // Ocultar el botón "Cancelar" 
        $('#cancelBtn').hide();

        document.getElementById("indexDiv").addEventListener("click", function() {
            window.location.href = "index";
        });
        document.getElementById("indexDiv2").addEventListener("click", function() {
            window.location.href = "index";
        });

        document.getElementById("pendingDiv").addEventListener("click", function() {
            window.location.href = "pending-candidates";
        });
    </script>
</body>

</html>