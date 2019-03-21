<!DOCTYPE html>
<?php
  session_start();
  include ('connection.php');
  $sql = "SELECT * FROM contact_us";
  $res = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($res);

  $announcement_sql = "SELECT * FROM announcement WHERE PostDate >= CURRENT_DATE() - INTERVAL 96 DAY_HOUR AND Status = 'Active'";
  $announcement_res = mysqli_query($conn, $announcement_sql);
  $announcement_count = mysqli_num_rows($announcement_res);
  date_default_timezone_set('Asia/Manila');
?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Central Philippine University College College of Theology Library</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/mdb.css">
	<link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/animate.css">
  <link rel="stylesheet" href="css/nav_icons.css">
	<link rel="icon" href="img/logo/COT Logo.jpg">
  <link rel="stylesheet" href="css/mdb.min.css">
  <style>.links{font-size: 20px;text-decoration: none;} .img-center{ margin-left: auto; margin-right: auto; display: block; }</style>
</head>
<body class="yellow lighten-4" oncontextmenu="return false;" onselectstart="return false;">
<?php include('library/html/navbar.php'); ?>
<?php include('library/html/contactModal.php'); ?>
   <br><br>
   <div class="container">
   		<section class="team-section my-5">
        <h1 class="h1-responsive font-weight-bold text-center">Library Collections</h1>
        <div class="row ml-auto">
     <div class="col-lg-12 col-md-6 mb-lg-0 mb-5">
      <div id="circulation" class="carousel fade-carousel slide" data-ride="carousel" data-interval="4000" id="bs-carousel">
              <ol class="carousel-indicators">
                    <li data-target="#circulation" data-slide-to="0" class="active"></li>
                    <li data-target="#circulation" data-slide-to="1"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                  <div class="carousel-item active">
                    <div class="slide">
                      <img class="card-img-top" src="img/collections/circulation.jpg">
                       <a>
                          <div class="mask rgba-white-slight waves-effect waves-light"></div>
                      </a>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <div class="slide">
                      <img class="card-img-top" src="img/collections/circulation_2.jpg">
                       <a>
                          <div class="mask rgba-white-slight waves-effect waves-light"></div>
                      </a>
                    </div>
                  </div>
                </div>
                  <a class="carousel-control-prev" href="#circulation" role="button" data-slide="prev"><span class="fa fa-chevron-left arrow"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#circulation" role="button" data-slide="next"><span class="fa fa-chevron-right arrow"></span>
                    <span class="sr-only">Next</span>
                  </a>
              </div>
        <h2 class="font-weight-bold mt-4 text-uppercase mb-3 text-center">Circulation Collection</h2>
        <h4 class="text-center">This is the library's collection containing materials that can be borrowed or checked out by registered borrowers for use inside or outside the library, usually for a fixed period of time, after which prompt return is expected.</h4>
        <h4 class="font-weight-bold orange-text">Loan Policies</h4>
        <ol>
          <li class="links">Number of Books allowed for loan and the corresponding lengths of time:</li>
            <ol class="list-unstyled">
              <li class="links ml-5">Faculty and Staff - maximum of 15 books at a time, for one month.</li> 
              <li class="links ml-5">CPU Students - maximum of 8 books at a time, for one week</li>
               <li class="links ml-5">CBCP Pastors - maximum of 2 books at a time, for two weeks</li>
            </ol>
          <li class="links">There will be an overdue charge of one peso(<span class="fa fa-rub"></span>1.00) for each day per book, (exculding Sundays and Holidays)</li>
          <li class="links">Books can be renewed for another one week, if there is no demand for it by another client.</li>
          <li class="links">Faculty and Staff will not be levied any library overdue fine.</li>
          <li class="links">Patrons are notified of due dates once by Facebook or text messaging</li>
        </ol>
      </div>
     <div class="col-lg-12 col-md-6 mb-lg-0 mb-5">
      <div id="filipiniana" class="carousel fade-carousel slide" data-ride="carousel" data-interval="4000" id="bs-carousel">
              <ol class="carousel-indicators">
                    <li data-target="#filipiniana" data-slide-to="0" class="active"></li>
                    <li data-target="#filipiniana" data-slide-to="1"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                  <div class="carousel-item active">
                    <div class="slide">
                      <img class="card-img-top" src="img/collections/filipiniana.jpg">
                       <a>
                          <div class="mask rgba-white-slight waves-effect waves-light"></div>
                      </a>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <div class="slide">
                      <img class="card-img-top" src="img/collections/filipiniana_2.jpg">
                       <a>
                          <div class="mask rgba-white-slight waves-effect waves-light"></div>
                      </a>
                    </div>
                  </div>
                </div>
                  <a class="carousel-control-prev" href="#filipiniana" role="button" data-slide="prev"><span class="fa fa-chevron-left arrow"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#filipiniana" role="button" data-slide="next"><span class="fa fa-chevron-right arrow"></span>
                    <span class="sr-only">Next</span>
                  </a>
              </div>
            <h2 class="font-weight-bold mt-4 mb-3 text-center text-uppercase">Filipinana Collection</h2>
            <h5 class="text-center">This collection consists mostly of religious or theological materials written by Filipinos, whether published in the country or abroad</h5>
      </div>
      <div class="col-lg-12 col-md-6 mb-lg-0 mb-5">
      <div id="periodicals" class="carousel fade-carousel slide" data-ride="carousel" data-interval="4000" id="bs-carousel">
              <ol class="carousel-indicators">
                    <li data-target="#periodicals" data-slide-to="0" class="active"></li>
                    <li data-target="#periodicals" data-slide-to="1"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                  <div class="carousel-item active">
                    <div class="slide">
                      <img class="card-img-top" src="img/collections/periodicals.jpg">
                       <a>
                          <div class="mask rgba-white-slight waves-effect waves-light"></div>
                      </a>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <div class="slide">
                      <img class="card-img-top" src="img/collections/periodicals_2.jpg">
                       <a>
                          <div class="mask rgba-white-slight waves-effect waves-light"></div>
                      </a>
                    </div>
                  </div>
                </div>
                  <a class="carousel-control-prev" href="#periodicals" role="button" data-slide="prev"><span class="fa fa-chevron-left arrow"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#periodicals" role="button" data-slide="next"><span class="fa fa-chevron-right arrow"></span>
                    <span class="sr-only">Next</span>
                  </a>
              </div>
                <h2 class="font-weight-bold mt-4 mb-3 text-center text-uppercase">Periodical/Serial Collection</h2>
                <h5 class="text-center">This includes newspapers, magazines, and journals by subscription. Journals keep abreast with the latest developments in all field of comtemporary Christian thought and practice, including biblical studies, historical theology, systematic theology, pastoral theology, history philosophy and ethics. They connect the church, the academics,and society.</h5>
      </div>
      <div class="col-lg-12 col-md-6 mb-lg-0 mb-5">
      <div id="reserve" class="carousel fade-carousel slide" data-ride="carousel" data-interval="4000" id="bs-carousel">
              <ol class="carousel-indicators">
                    <li data-target="#reserve" data-slide-to="0" class="active"></li>
                    <li data-target="#reserve" data-slide-to="1"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                  <div class="carousel-item active">
                    <div class="slide">
                      <img class="card-img-top" src="img/collections/reserve.jpg">
                       <a>
                          <div class="mask rgba-white-slight waves-effect waves-light"></div>
                      </a>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <div class="slide">
                      <img class="card-img-top" src="img/collections/reserve_2.jpg">
                       <a>
                          <div class="mask rgba-white-slight waves-effect waves-light"></div>
                      </a>
                    </div>
                  </div>
                </div>
                  <a class="carousel-control-prev" href="#reserve" role="button" data-slide="prev"><span class="fa fa-chevron-left arrow"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#reserve" role="button" data-slide="next"><span class="fa fa-chevron-right arrow"></span>
                    <span class="sr-only">Next</span>
                  </a>
              </div>
        <h2 class="font-weight-bold mt-4 mb-3 text-uppercase text-center">Reserve Collection</h2>
        <h5 class="text-center">The Theology Library provides reserve materials services to support all areas of the seminary's curriculum. Books placed on reserve for class assignment at the request of the family members are to be used in the library reading room. This is to ensure that all the students enrolled in a course have an oppurtunity to use them. Fines charged for overdue reserve items are higher than for materials not on reserve to encourage prompt return.</h5> 
        <h4 class="font-weight-bold orange-text">Loan Policies</h4>
        <h4>Reserve books mat be borrowed during lunch time, overnight and weekend at designated hours</h4>
         <ol>
          <li class="links">These can be taken out on Lunch Break, from 12:00 noon to 1:30 p.m.</li>
          <li class="links">For overnight, reserve books can be taken out at 6:00 p.m. and must be returned at 8:30 a.m. the following school day.</li>
          <li class="links">They may be checked out for the weekend at 5:00 p.m. on Friday and must be returned at 9:00 a.m. on Monday following.</li>          <li class="links">A fine of five pesos(<span class="fa fa-rub"></span>5.00) is charged for each hour and fifthy pesos(<span class="fa fa-rub"></span>50.00) each day per book(excluding Sundays and Holidays)</li>
        </ol>
      </div>
      <div class="col-lg-12 col-md-6 mb-lg-0 mb-5">
      <div id="thesis" class="carousel fade-carousel slide" data-ride="carousel" data-interval="4000" id="bs-carousel">
          <ol class="carousel-indicators">
              <li data-target="#thesis" data-slide-to="0" class="active"></li>
              <li data-target="#thesis" data-slide-to="1"></li>
          </ol>
                <div class="carousel-inner" role="listbox">
                  <div class="carousel-item active">
                    <div class="slide">
                      <img class="card-img-top" src="img/collections/thesis.jpg">
                       <a>
                          <div class="mask rgba-white-slight waves-effect waves-light"></div>
                      </a>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <div class="slide">
                      <img class="card-img-top" src="img/collections/thesis_2.jpg">
                       <a>
                          <div class="mask rgba-white-slight waves-effect waves-light"></div>
                      </a>
                    </div>
                  </div>
                </div>
                  <a class="carousel-control-prev" href="#thesis" role="button" data-slide="prev"><span class="fa fa-chevron-left arrow"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#thesis" role="button" data-slide="next"><span class="fa fa-chevron-right arrow"></span>
                    <span class="sr-only">Next</span>
                  </a>
              </div> 
              <h2 class="font-weight-bold mt-4 mb-3 text-uppercase text-center">Theses Collection</h2>
              <h5 class="text-center">Academic dissertation is a thesis pr treatise prepared as a condition for the award of a degree or diploma. The thesis/dissertation collection of the College of Theology includes mostly the thesis or special papers of the graduates of the College of Theology with the degree of Bachelor of Theology or Master of Divinity. Some are dissertations of the alumni or seminary faculty who pursued their post-graduate degrees in other institutions here in the Philippines or abroad, such as United States, Germany and Korea.</h5>
      </div>
      <div class="col-lg-12 col-md-6 mb-lg-0 mb-5">
      <div id="reference" class="carousel fade-carousel slide" data-ride="carousel" data-interval="4000" id="bs-carousel">
          <ol class="carousel-indicators">
              <li data-target="#reference" data-slide-to="0" class="active"></li>
              <li data-target="#reference" data-slide-to="1"></li>
          </ol>
                <div class="carousel-inner" role="listbox">
                  <div class="carousel-item active">
                    <div class="slide">
                      <img class="card-img-top" src="img/collections/reference.jpg">
                       <a>
                          <div class="mask rgba-white-slight waves-effect waves-light"></div>
                      </a>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <div class="slide">
                      <img class="card-img-top" src="img/collections/reference.jpg">
                       <a>
                          <div class="mask rgba-white-slight waves-effect waves-light"></div>
                      </a>
                    </div>
                  </div>
                </div>
                  <a class="carousel-control-prev" href="#reference" role="button" data-slide="prev"><span class="fa fa-chevron-left arrow"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#reference" role="button" data-slide="next"><span class="fa fa-chevron-right arrow"></span>
                    <span class="sr-only">Next</span>
                  </a>
              </div>
              <h2 class="font-weight-bold mt-4 mb-3 text-uppercase text-center">Reference Collection</h2>
              <h5 class="text-center">Reference Books are shelved in a separate area in the library section. These are not allowed to circulate because they are needed to answer questions at the reference desk. The Theology Library holds important reference sources like encyclopedias, dictionaries, handbooks, commentaries, oncordances, almanacs, atlases, yearbooks, and manuals. Long reference works which are issued in multivolume sets are also present.</h5>
      </div>
  </div>
   		</section>
    </div>
   <?php include('library/html/footer.php'); ?>
  <!--JavaScript Libraries-->
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="js/function.js"></script>
  <script src="js/wow.min.js"></script>
  <script src="js/carousel.js"></script>
  <script src="js/nav_icons.js"></script>
  <script src="js/jquery-3.1.1.min.js"></script>
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/popper.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/mdb.min.js"></script>
  	<script>

        new WOW().init();
  	/*Night Mode*/
	$( ".night-button" ).click(function() {
  	$( "body" ).toggleClass('night-mode');
	});
  	</script>
</body>
</html>