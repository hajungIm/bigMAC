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

  <title>Age Centric Analysis</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <style>
  .table th:nth-child(1) {
    width: 25%; /* Restaurant Name 열의 폭을 10%로 설정 */
  }

  .table th:nth-child(2) {
    width: 25%; /* Like Count 열의 폭 설정 */
  }

  .table th:nth-child(3) {
    width: 50%; /* Price Range 열의 폭 설정 */
  }

  .range {
    style="width: 100%;
    background-color: #e0e0e0;
    height: 14px;
    position: relative;
    border-radius: 10px;
  }
  .rangeBar {

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
              <a class="dropdown-item d-flex align-items-center" href="logout.php">
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

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Age-Centric Analysis of Likes and Price</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Restaurant Analysis</a></li>
          <li class="breadcrumb-item active">Age-Centric</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-8">
          <div class="row">

            <!-- Teenagers -->
            <div class="col-12">
              <div class="card top-selling overflow-auto">

                <div class="card-body pb-0">
                  <h5 class="card-title">Teenagers <span>| ages 13 to 19</span></h5>

                  <table id="teen" class="table" style="text-align: center;">
                    <thead>
                      <tr>
                        <th scope="col">Restaurant Name</th>
                        <th scope="col">Like Count</th>
                        <th scope="col">Price Range</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td id="restaurantName">burgerKing</td>
                        <td id="likeCount">30</td>
                        <td id="priceRange">
                          <div class="range" style="width: 100%; background-color: #e0e0e0; height: 14px; position: relative; border-radius: 10px;">
                            <div class="rangeBar" style="background-color: #1E88E5; height: 100%; position: absolute; width: 50%; margin-left: 25%; border-radius: 10px;"></div>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>

                </div>

              </div>
            </div><!-- End Teenagers -->

            <!-- Young Adults -->
            <div class="col-12">
              <div class="card top-selling overflow-auto">

                <div class="card-body pb-0">
                  <h5 class="card-title">Young Adults <span>| ages 20 to 39</span></h5>

                  <table id="young" class="table" style="text-align: center;">
                    <thead>
                      <tr>
                        <th scope="col">Restaurant Name</th>
                        <th scope="col">Like Count</th>
                        <th scope="col">Price Range</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td id="restaurantName">burgerKing</td>
                        <td id="likeCount">30</td>
                        <td id="priceRange">
                          <div class="range" style="width: 100%; background-color: #e0e0e0; height: 14px; position: relative; border-radius: 10px;">
                            <div class="rangeBar" style="background-color: #1E88E5; height: 100%; position: absolute; width: 50%; margin-left: 25%; border-radius: 10px;"></div>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>

                </div>

              </div>
            </div><!-- End Young Adults -->

            <!-- Middle Aged -->
            <div class="col-12">
              <div class="card top-selling overflow-auto">

                <div class="card-body pb-0">
                  <h5 class="card-title">Middle Aged <span>| ages 40 to 59</span></h5>

                  <table id="middle" class="table" style="text-align: center;">
                    <thead>
                      <tr>
                        <th scope="col">Restaurant Name</th>
                        <th scope="col">Like Count</th>
                        <th scope="col">Price Range</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td id="restaurantName">burgerKing</td>
                        <td id="likeCount">30</td>
                        <td id="priceRange">
                          <div class="range" style="width: 100%; background-color: #e0e0e0; height: 14px; position: relative; border-radius: 10px;">
                            <div class="rangeBar" style="background-color: #1E88E5; height: 100%; position: absolute; width: 50%; margin-left: 25%; border-radius: 10px;"></div>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>

                </div>

              </div>
            </div><!-- End Middle Aged -->

          </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-4">

          <!-- Teenagers Report -->
          <div class="card">

            <div class="card-body">
              <h5 class="card-title">Short Report <span>| Teenagers</span></h5>

              <p>
                This is Teenagers Report Content ...
              </p>

            </div>
          </div><!-- End Teenagers Report -->

          <!-- Young Adults Report -->
          <div class="card">

            <div class="card-body">
              <h5 class="card-title">Short Report <span>| Young Adults</span></h5>

              <p>
                This is Young Adults Report Content ...
              </p>

            </div>
          </div><!-- End Young Adults Report -->

          <!-- Middle Aged Report -->
          <div class="card">

            <div class="card-body">
              <h5 class="card-title">Short Report <span>| Middle Aged</span></h5>

              <p>
                This is Middle Aged Report Content ...
              </p>

            </div>
          </div><!-- End Middle Aged Report -->

        </div><!-- End Right side columns -->

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

  <script>
  // PHP 스크립트에서 JSON 데이터를 가져옴
  fetch('get_age_analysis.php')
  .then(response => response.json())
  .then(data => {
    // 'teen' 데이터를 처리합니다.
    processAgeGroupData(data['teen'], 'teen');

    // 'young' 데이터를 처리합니다.
    processAgeGroupData(data['young'], 'young');

    // 'middle' 데이터를 처리합니다.
    processAgeGroupData(data['middle'], 'middle');
  });

  function processAgeGroupData(ageGroupData, tableId) {
    const tbody = document.querySelector(`#${tableId} tbody`);

    // 기존 테이블 내용을 비웁니다.
    tbody.innerHTML = '';

    // 데이터를 테이블에 추가합니다.
    ageGroupData.forEach(restaurant => {
      const tr = document.createElement('tr');
      const progressBarWidth = (restaurant.maxPrice - restaurant.minPrice) / 40 * 100;
      const progressBarMargin = restaurant.minPrice / 40 * 100;
      tr.innerHTML = `
      <td>${restaurant.restaurantName}</td>
      <td>${restaurant.likeCount}</td>
      <td colspan="2">
      <div class="progress" style="height: 13px; border-radius: 6.5px;">
      <div class="progress-bar" role="progressbar" style="width: ${progressBarWidth}%; margin-left: ${progressBarMargin}%; background-color: #1E88E5; border-radius: 6.5px;"></div>
      </div>
      </td>`;
      tbody.appendChild(tr);
    });
  }
</script>


</body>

</html>
