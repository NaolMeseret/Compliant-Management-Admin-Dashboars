<?php
// require("header.php"); 
?>
<!-- Link to custom CSS -->
<link rel="stylesheet" href="../CSS/footer.css">

<!-- Custom Modal Styles -->
<style>
  /* Modal appearance */
  .modal-content {
    border-radius: 1rem;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    border: none;
  }

  .modal-header {
    background-color: #f8f9fc;
    border-bottom: 1px solid #e3e6f0;
    color: #4e73df;
  }

  .modal-title {
    font-weight: 600;
  }

  .modal-body {
    font-size: 1rem;
    color: #5a5c69;
  }

  .modal-footer {
    border-top: 1px solid #e3e6f0;
  }

  .btn-primary {
    background-color: #4e73df;
    border: none;
    border-radius: 0.5rem;
  }

  .btn-primary:hover {
    background-color: #2e59d9;
  }

  .btn-secondary {
    background-color: #858796;
    border: none;
    border-radius: 0.5rem;
  }

  .btn-secondary:hover {
    background-color: #6c757d;
  }

  /* Close button styling */
  .modal-header .close {
    background: none;
    border: none;
    font-size: 1.4rem;
  }
</style>

<!-- Logout Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
        <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Select "Logout" below if you are ready to end your current session.
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
        <a class="btn btn-primary" href="logout.php">Logout</a>
      </div>
    </div>
  </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="../JavaScript/script.js"></script>
</body>

</html>