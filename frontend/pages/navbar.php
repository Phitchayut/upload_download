<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <!-- Container wrapper -->
  <div class="container">


    <!-- Toggle button -->
    <button
      class="navbar-toggler"
      type="button"
      data-mdb-toggle="collapse"
      data-mdb-target="#navbarButtonsExample"
      aria-controls="navbarButtonsExample"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <i class="fas fa-bars"></i>
    </button>

    <!-- Collapsible wrapper -->
    <div class="collapse navbar-collapse" id="navbarButtonsExample">
      <!-- Left links -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="#">ดูข้อมูลผู้ดาวน์โหลดเอกสาร</a>
        </li>
      </ul>
      <!-- Left links -->

      <div class="d-flex align-items-center">
        <div class="me-3">
          สวัสดี,<?= $row['username'] ?>
        </div>
        <a
          class="btn btn-danger px-3"
          href="../auth/logout.php"
          role="button"
          ><i class="fa-solid fa-right-from-bracket"></i></a>
      </div>
    </div>
    <!-- Collapsible wrapper -->
  </div>
  <!-- Container wrapper -->
</nav>
<!-- Navbar -->