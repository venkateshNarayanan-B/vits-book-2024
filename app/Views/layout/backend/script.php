<!-- jQuery -->
<script src="<?= base_url("assets/plugins/jquery/jquery.min.js") ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url("assets/plugins/bootstrap/js/bootstrap.bundle.min.js") ?>"></script>
<!-- AdminLTE App -->
<script src="<?= base_url("assets/dist/js/adminlte.min.js") ?>"></script>
<!-- SweetAlert2 -->
<script src="<?= base_url("assets") ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="<?= base_url("assets") ?>/plugins/toastr/toastr.min.js"></script>
<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script>
  $(function () {
    // Initialize Select2 for any dropdown with class 'select2'
    $('.select2').select2({
        theme: 'bootstrap4'  // Optional: to match AdminLTE's theme
    });

    <?php if (session()->getFlashdata('swal_success')): ?>
      Swal.fire({
        icon: 'success',
        title: 'Success',
        text: '<?= session()->getFlashdata('swal_success'); ?>',
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });
    <?php endif; ?>

    <?php if (session()->getFlashdata('swal_error')): ?>
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: '<?= session()->getFlashdata('swal_error'); ?>',
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });
    <?php endif; ?>
  });
</script>
