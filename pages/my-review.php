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

  <title>My Review</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <style>
  .table th:nth-child(1) {
    width: 10%; /* No 열의 폭을 10%로 설정 */
  }

  .table th:nth-child(2) {
    width: 25%; /* Restaurant Name 열의 폭 설정 */
  }

  .table th:nth-child(3) {
    width: 25%; /* Rating 열의 폭 설정 */
  }

  .table th:nth-child(4) {
    width: 35%; /* Content 열의 폭 설정 */
  }

  .table th:nth-child(6) {
    width: 5%; /* Delete 열의 폭 설정 */
  }

  .bi-star-fill, .bi-star-half, .bi-star {
    color: #FFC72E; /* 별점 색깔 */
  }

  .edit-color-change:hover {
    color: blue; /* Edit 버튼 마우스 올리면 빨간색 */
  }
  .delete-color-change:hover {
    color: red; /* Delete 버튼 마우스 올리면 빨간색 */
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

  <!-- jQuery 라이브러리를 추가합니다 -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

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
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Restaurant Analysis</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
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
            <a href="ambiance-analysis.php">
              <i class="bi bi-circle"></i><span>Ambiance-Centric</span>
            </a>
          </li>
        </ul>
      </li><!-- End Analytics Nav -->

      <li class="nav-item">
        <a class="nav-link" href="my-review.php">
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

    <div class="pagetitle" style="margin-bottom: 20px;">
      <h1>My Review</h1>
    </div><!-- End Page Title -->

    <div class="card">
      <div class="card-body">

        <!-- Table with stripped rows -->
        <table class="table table-striped" id="dataTable" style="margin-top: 25px; text-align: center;">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Restaurant Name</th>
              <th scope="col">Rating</th>
              <th scope="col">Comment</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row" id="no">1</th>
              <td id="restaurantName">burgerKing</td>
              <td>
                <span id="starRate"><i class="bi bi-star-fill"></i> <i class="bi bi-star-fill"></i> <i class="bi bi-star-fill"></i> <i class="bi bi-star-fill"></i> <i class="bi bi-star-fill"></i></span>
              </td>
              <td id="comment">This is Content ...</td>
              <td>
                <i class="delete-color-change bi bi-trash-fill"></i>
              </td>
            </tr>
            <tr>
              <th scope="row" id="no">2</th>
              <td id="restaurantName">Salady</td>
              <td>
                <span id="starRate"><i class="bi bi-star-fill"></i> <i class="bi bi-star-fill"></i> <i class="bi bi-star-fill"></i> <i class="bi bi-star-fill"></i> <i class="bi bi-star"></i></span>
              </td>
              <td id="comment">This is Content ...</td>
              <td>
                <i class="delete-color-change bi bi-trash-fill"></i>
              </td>
            </tr>
            <tr>
              <th scope="row" id="no">3</th>
              <td id="restaurantName">ABC sushi</td>
              <td>
                <span id="starRate"><i class="bi bi-star-fill"></i> <i class="bi bi-star-fill"></i> <i class="bi bi-star-fill"></i> <i class="bi bi-star"></i> <i class="bi bi-star"></i></span>
              </td>
              <td id="comment">This is Content ...</td>
              <td>
                <i class="delete-color-change bi bi-trash-fill"></i>
              </td>
            </tr>
          </tbody>
        </table>
        <!-- End Table with stripped rows -->

      </div>
    </div>

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

  <script> /* php에서 데이터를 가져오는 script */
  $(document).ready(function(){
    $.ajax({
      url: '../api/my-review.php', // 데이터를 가져올 PHP 파일의 경로
      type: 'GET',
      dataType: 'json',
      success: populateTable,
      error: function(jqXHR, textStatus, errorThrown) {
        console.log('Data could not be retrieved. ' + textStatus);
        console.log('Response text: ' + jqXHR.responseText);
      }
    });
  });

  function populateTable(data) {
    var tableBody = $('#dataTable tbody');
    tableBody.empty(); // 기존 테이블 내용을 비웁니다.

    $.each(data, function(i, row) {
        var tr = $('<tr>');

        // 첫 번째 열: 인덱스
        var indexTd = $('<td>').text(i + 1);
        tr.append(indexTd);

        // 두 번째 열: restaurantName
        var restaurantNameTd = $('<td>').html(row.restaurantName);
        tr.append(restaurantNameTd);

        // 세 번째 열: starRate
        var starRateTd = $('<td>').addClass('starRate');
        starRateTd.html('<i class="bi bi-star"></i>'.repeat(5)); // 빈 별로 초기화
        updateStarRating(row.starRate, starRateTd);
        tr.append(starRateTd);

        // 네 번째 열: comment
        var commentTd = $('<td>');
        var summaryText = row.comment.substring(0, 40) + '...'; // 처음 50자만 표시
        var fullTextSpan = $('<span>')
            .addClass('text-primary comment-text')
            .css('cursor', 'pointer')
            .attr('data-bs-toggle', 'modal')
            .attr('data-bs-target', '#basicModal')
            .text(summaryText)
            .on('click', function() {
              var reviewId = row.reviewId;
                $('#modalBodyText').text(row.comment); // 모달의 본문을 전체 텍스트로 설정
                $('#editTextArea').val(row.comment);
                $('#saveButton').data('reviewId', reviewId);
            });
        commentTd.append(fullTextSpan);
        tr.append(commentTd);

        // 여섯 번째 열: 삭제 아이콘
        var deleteTd = $('<td>');
        var deleteIcon = $('<i class="delete-color-change bi bi-trash-fill"></i>')
        .on('click', function() {
          if (confirm('Do you really want to DELTE this review?')) {
            deleteReview(row.reviewId);
          }
        });
        deleteTd.append(deleteIcon);
        tr.append(deleteTd);

        tableBody.append(tr); // 완성된 행을 테이블에 추가
    });
}

  // 별점을 업데이트하는 함수입니다.
  function updateStarRating(ratingValue, td) {
    td.find('i').removeClass('bi-star-fill').addClass('bi-star'); // 모든 별을 먼저 비웁니다.
    td.find('i:lt(' + ratingValue + ')').removeClass('bi-star').addClass('bi-star-fill'); // 지정된 수만큼 별을 채웁니다.
  }
  </script>

  <!-- Modal -->
  <div class="modal fade" id="basicModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Review Comment</h5>
        </div>
        <div class="modal-body">
          <p id="modalBodyText">Test comment</p>
          <textarea id="editTextArea" class="form-control" style="display:none;"></textarea>
        </div>
        <div class="modal-footer">
          <button type="button" id="editButton" class="btn btn-primary">Edit</button>
          <button type="button" id="saveButton" class="btn btn-success" style="display:none;">Save</button>
          <button type="button" id="closeButton" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div><!-- End Basic Modal-->

  <script>
  $('#editButton').on('click', function() {
    var modalText = $('#modalBodyText').text();
    $('#editTextArea').val(modalText).show();
    $('#modalBodyText').hide();
    $('#editButton').hide();
    $('#saveButton').show();
  });

  $('#saveButton').on('click', function() {
    var updatedText = $('#editTextArea').val();
    var reviewId = $(this).data('reviewId');

    $.ajax({
      url: '../api/update-review.php',
      type: 'POST',
      data: {
        reviewId: reviewId,
        comment: updatedText
      },
      success: function(response) {
        console.log('Update successful', response);
        window.location.href = 'my-review.php';
      },
      error: function(xhr, status, error) {
        console.log('Update failed', xhr,status, error);
      }
    })
  })

  $('#closeButton').on('click', function() {
    $('#editTextArea').hide();
    $('#modalBodyText').show();
    $('#editButton').show();
    $('#saveButton').hide();
  });

  function deleteReview(reviewId) {
    $.ajax({
      url: '../api/delete-review.php',
      type: 'POST',
      data: { reviewId: reviewId },
      success: function(response) {
        console.log('Update successful', response);
        window.location.href = 'my-review.php';
      },
      error: function(xhr, status, error) {
        console.log('Update failed', xhr,status, error);
      }
    });
  }
  </script>
</body>

</html>
