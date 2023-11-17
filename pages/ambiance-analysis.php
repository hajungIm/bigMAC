<?php
session_start();

// 로그인 상태 확인
if (!isset($_SESSION['memberId'])) {
    // 로그인되지 않았다면 로그인 페이지로 리디렉션
    header('Location: ../pages/login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Ambiance Centric Analysis</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

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
      <a href="../pages/index.php" class="logo d-flex align-items-center">
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
              <a class="dropdown-item d-flex align-items-center" href="../api/logout.php">
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
        <a class="nav-link collapsed" href="index.php">
          <i class="bi bi-grid"></i>
          <span>Home</span>
        </a>
      </li><!-- End Home Nav -->

      <li class="nav-item">
        <a class="nav-link" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Restaurant Analysis</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
          <li>
            <a href="age-analysis.php">
              <i class="bi bi-circle"></i><span>Age-Centric</span>
            </a>
          </li>
          <li>
            <a href="locale-analysis.php">
              <i class="bi bi-circle"></i><span>Locale-Centric</span>
            </a>
          </li>
          <li>
            <a href="ambiance-analysis.php" class="active">
              <i class="bi bi-circle"></i><span>Ambiance-Centric</span>
            </a>
          </li>
        </ul>
      </li><!-- End Analytics Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="my-review.php">
          <i class="bi bi-card-list"></i>
          <span>My Review</span>
        </a>
      </li><!-- End My Review Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="review-form.php">
          <i class="bi bi-journal-text"></i>
          <span>Review Form</span>
        </a>
      </li><!-- End Review Form Page Nav -->

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Ambiance-Centric Analysis of Price and Satisfaction</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Restaurant Analysis </li>
          <li class="breadcrumb-item active"> Ambiance-Centric</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Results <span>| Average Price and Rating of Restaurants by Ambiance</span></h5>
              <div class="col-lg-12">
                <div id="tables-container"></div>
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
  </main><!-- End #main -->

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

  <!-- AJAX -->
  <script>
  $(document).ready(function(){
   $.ajax({
     url: '../api/ambiance-analysis.php',
     type: 'post',
     dataType: 'json',
     success: function(data) {
      var tableData = [
      { atmosphere: 'Upscale', avg_Price: data['expensive_expensive_res']['avg_price'], rating: data['expensive_expensive_res']['rating'] },
      { atmosphere: 'Upscale', avg_Price: data['cheap_expensive_res']['avg_price'], rating: data['cheap_expensive_res']['rating'] },
      { atmosphere: 'Casual', avg_Price: data['expensive_casual_res']['avg_price'], rating: data['expensive_casual_res']['rating'] },
      { atmosphere: 'Casual', avg_Price: data['cheap_casual_res']['avg_price'], rating: data['cheap_casual_res']['rating'] }
      ];
       var table = $('<table></table>').addClass('table datatable').appendTo('#tables-container');

       // 테이블 헤더 생성
       var thead = $('<thead></thead>').appendTo(table);
       var headerRow = $('<tr></tr>').appendTo(thead);
       $('<th></th>').text('Atmosphere').appendTo(headerRow);
       $('<th></th>').text('Average Price').appendTo(headerRow);
       $('<th></th>').text('Average Rating').appendTo(headerRow);

       var tbody = $('<tbody></tbody>').appendTo(table);

       $.each(tableData, function(index, value){
          var row = $('<tr></tr>').appendTo(tbody);
          $('<td></td>').text(value.atmosphere).appendTo(row);
          $('<td></td>').text(value.avg_Price + '$').appendTo(row);
          $('<td></td>').text(value.rating).appendTo(row);
      });

      // css
       $('.datatable').css('width', '100%'); // 테이블 전체 너비를 100%로 설정
       $('.datatable th').css('width', '33.33%'); // 각 <th> 태그의 너비를 테이블 너비의 1/3로 설정
       $('.datatable td').css({
         // 'border-right': '1px solid #ddd',
         'text-align': 'center',
         'vertical-align': 'middle'
       });
       $('.datatable th').css({
         // 'border-right': '1px solid #ddd',
         'text-align': 'center',
         'vertical-align': 'middle'
       });
      // $('.datatable td:last-child, .datatable th:last-child').css('border-right', 'none');
     }
   });
  });
  </script>
</body>
</html>
