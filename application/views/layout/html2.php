<!DOCTYPE html>
<html lang="en">

<?php include 'head.php'; ?>

<body class="nav-md" onload="initialize()">
    <div class="container body">
        <div class="main_container">

            <?php include 'sidebar.php'; ?>

            <!-- page content -->
            <div class="right_col" role="main">
                <?= $menara; ?>
            </div>
            <!-- /page content -->

            <?php include 'footer.php'; ?>

        </div>
    </div>

    <?php include 'javascript.php'; ?>

</body>

</html>