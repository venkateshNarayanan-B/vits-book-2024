<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Vits Book | <?= $title ?></title>

  <?= $this->include("layout/backend/styles") ?>
  <?= $this->renderSection("styles") ?>
  
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
   <?= $this->include("layout/backend/topNav") ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
   <?= $this->include("layout/backend/sidebar") ?>
  

  <!-- Content Wrapper. Contains page content -->
  <?= $this->renderSection("content") ?>
  
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
   <?= $this->include("layout/backend/settings") ?>
  
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
   <?= $this->include("layout/backend/footer") ?>
  
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<?= $this->include("layout/backend/script") ?>
<?= $this->renderSection("scripts") ?>

</body>
</html>
