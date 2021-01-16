<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.21/datatables.min.css" />
  <style>
    .article__media>img {
      /* Memberikan ukuran maksimal gambar di dalam Modal Details Article  */
      max-width: 790px;
    }
  </style>
  <title>RSS Reader | Ismail Habibi Herman</title>
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h3 class="text-center font-weight-normal my-3">RSS Reader</h3>
        <h4 class="text-center font-weight-normal my-3">programming-test-1</h4>
        <h5 class="text-center font-weight-normal my-3">Created by <a href="https://github.com/ismlhbb">Ismail Habibi Herman</a></h5>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6">
        <h4 class="mt-2">All Articles</h4>
      </div>
    </div>
    <hr class="my-1">
    <div class="row">
      <div class="col-lg-12">
        <div class="table-responsive" id="showArticle">
          <h3 class="text-center" style="margin-top:150px;">Loading...</h3>
        </div>
      </div>
    </div>
  </div>

  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- Popper JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <!-- Datatables -->
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.21/datatables.min.js"></script>
  <!-- Sweetalert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <!-- Scripts -->
  <!-- Datatable script -->
  <script type="text/javascript">
    $(document).ready(function() {
      showAllArticles();

      function showAllArticles() {
        $.ajax({
          url: "action.php",
          type: "POST",
          data: {
            action: "view"
          },
          success: function(response) {
            $("#showArticle").html(response);
            $("table").DataTable({
              order: [0, 'desc']
            });
          }
        });
      }
      // Show Article details Modal
      $("body").on("click", ".infoBtn", function(e) {
        e.preventDefault();
        info_id = $(this).attr('id');
        $.ajax({
          url: "action.php",
          type: "POST",
          data: {
            info_id: info_id
          },
          success: function(response) {
            data = JSON.parse(response); // Convert json to javascript object
            Swal.fire({
              // Menampilkan Details Article
              title: '<strong>Article Detail: ID(' + data.id + ')</strong>',
              icon: 'info',
              html: '<b>URL: </b>' + data.url +
                '<br><b>Judul: </b>' + data.title +
                '<br><b> Waktu Tayang: </b>' + data.published_date +
                '<br><b>Konten Lengkap: </b>' + data.content,
              showCancelButton: false,
              width: '900px',
            })
          }
        });
      });
      // End of show Article details
    });
  </script>
</body>

</html>