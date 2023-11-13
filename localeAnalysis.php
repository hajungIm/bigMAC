<?php
session_start();

// 로그인 상태 확인
if (!isset($_SESSION['memberId'])) {
    // 로그인되지 않았다면 로그인 페이지로 리디렉션
    header('Location: login_form.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Locale Centric Analysis</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <style>
  .container {
    display: flex;
    justify-content: space-around;
  }

  .graph-container {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 250px;
    width: 100%;
    border-bottom: 2px solid #e0e0e0;
    position: relative;
    margin-bottom: 20px;
  }

  .graph {
    width: 15px;
    height: 100%;
    background-color: #e0e0e0;
    border-radius: 4px;
    position: relative;
    text-align: center;
  }

  .bar {
    width: 100%;
    background-color: #1E88E5;
    border-radius: 4px;
    position: absolute;
    bottom: 0;
  }

  .count {
    position: absolute;
    top: -24px;
    width: 100%;
    text-align: center;
    font-weight: 530;
    color: #444444: 
  }

  .avenue {
    position: absolute;
    bottom: -27px;
    width: 100%;
    text-align: center;
    font-weight: 530;
    color: #444444: 
  }
  </style>

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <i class="ri-apple-fill" style="vertical-align: middle; font-size: 35px;"></i>
        <span class="d-none d-lg-block">bigMAC</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn" style="vertical-align: middle;"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-person-fill"></i>
            <span class="d-none d-md-block dropdown-toggle ps-2">
              <?php echo isset($_SESSION['memberName']) ? $_SESSION['memberName'] : 'Guest'; ?>
            </span>          
          </a>

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="index.html">
          <i class="bi bi-grid"></i>
          <span>Home</span>
        </a>
      </li><!-- End Home Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Restaurant Analytics</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="components-alerts.html">
              <i class="bi bi-circle"></i><span>Age-Centric</span>
            </a>
          </li>
          <li>
            <a href="components-accordion.html">
              <i class="bi bi-circle"></i><span>Locale-Centric</span>
            </a>
          </li>
          <li>
            <a href="components-badges.html">
              <i class="bi bi-circle"></i><span>Ambiance-Centric</span>
            </a>
          </li>
        </ul>
      </li><!-- End Analytics Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-register.html">
          <i class="bi bi-card-list"></i>
          <span>My Review</span>
        </a>
      </li><!-- End My Review Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-login.html">
          <i class="bi bi-journal-text"></i>
          <span>Review Form</span>
        </a>
      </li><!-- End Review Form Page Nav -->

    </ul>

  </aside>
  <!-- End Sidebar-->

  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Locale-Centric Analysis of Restaurant Count</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Restaurant Analysis </li>
          <li class="breadcrumb-item active"> Locale-Centric Analysis</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-6"> 
          <div class="card" style="padding-bottom: 10px;">
            <div class="card-body">
              <h5 class="card-title" style="padding-bottom: 35px;">Results <span>| Restaurant Count by Avenue</span></h5>
              <div class="col-lg-12">
                <div class="container" id="container"></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Short Report <span>| </span></h5>
              <!-- 분석 추가 -->
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script>
    $.ajax({
      url: 'getLocaleAnalysis.php',
      dataType: 'json',
      success: function(data) {
        data.forEach(function(item, index) {
          var graphId = 'graph' + (index + 1);
          var barHeight = (item.restaurant_count / 10) * 100;
          var graphHtml = '<div class="graph-container" id="' + graphId + '"><div class="graph"><div class="bar" style="height: ' + barHeight + '%;"></div><div class="count">' + item.restaurant_count + '</div></div><div class="avenue">' + item.avenue + '</div></div>';
          $('#container').append(graphHtml);
        });
      }
    });
  </script>
  </body>
</html>