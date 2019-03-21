<!DOCTYPE html>
<?php
	include('connection.php');
	$sql = "SELECT * FROM contact_us";
	$res = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($res);
?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0">
  <meta name="author" content="College of Theology Library">
  <meta name="description"  content="Web Application for College of Theology">
  <meta name="twitter:card" value="summary">
  <title>Central Philippine University College of Theology Library</title>
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/mdb.min.css">
  <link rel="stylesheet" href="css/mdb.css">
  <link rel="stylesheet" href="css/animate.css">
  <link rel="stylesheet" href="css/nav_icons.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="icon" href="img/logo/cot2.jpg">
  <style>.links{font-size: 20px;text-decoration: none;} .img-center{ margin-left: auto; margin-right: auto; display: block; }</style>
</head>
<body class="yellow lighten-4" oncontextmenu="return false;" onselectstart="return false;">
	   <?php include ('library/html/navbar.php'); ?><br><br>
		<?php include('library/html/contactModal.php'); ?>

<div class="container">
	<section class="team-section my-5">
		<h1 class="h1-responsive text-center font-weight-bold my-5">Special Collections</h1>
    <h3 class="text-center">These are the special collections in the Theology Library</h3>
		<hr>
	<div class="row">
		<div class="col-lg-6 col-md-6 mb-1">
   					<div class="card view overlay zoom">
						<div id="women" class="carousel fade-carousel slide" data-ride="carousel" data-interval="4000" id="bs-carousel">
							<ol class="carousel-indicators">
      							<li data-target="#women" data-slide-to="0" class="active"></li>
      							<li data-target="#women" data-slide-to="1"></li>
    						</ol>
    						<div class="carousel-inner" role="listbox">
    							<div class="carousel-item active">
    								<div class="slide">
    									<img class="card-img-top" src="img/collections/womens.jpg">
    									 <a>
      										<div class="mask rgba-white-slight waves-effect waves-light"></div>
   						 				</a>
    								</div>
    							</div>
    							<div class="carousel-item">
    								<div class="slide">
    									<img class="card-img-top" src="img/collections/womens_2.jpg">
    									 <a>
      										<div class="mask rgba-white-slight waves-effect waves-light"></div>
   						 				</a>
    								</div>
    							</div>
    						</div>
    						  <a class="carousel-control-prev" href="#women" role="button" data-slide="prev"><span class="fa fa-chevron-left arrow"></span>
    								<span class="sr-only">Previous</span>
  								</a>
  								<a class="carousel-control-next" href="#women" role="button" data-slide="next"><span class="fa fa-chevron-right arrow"></span>
    								<span class="sr-only">Next</span>
  								</a>
    					</div>
    					<div class="card-body text-center">
    						<h4 class="card-title"><span class="fa fa-book"></span> Women's Collection</h4>
    						<p class="card-text black-text">Current gender issues, especially on feminism and feminist theology, broughout into existence the Women's Studies Collection. This collection is supports the women in church ministry, especially the ordained women ministers of the Convention of Philippine Baptist Churches(CPCP).</p>
  						</div>
					</div>
				</div>
		  <div class="col-lg-6 col-md-6 mb-1">
            <div class="card view overlay zoom">
            <div id="diesto" class="carousel fade-carousel slide" data-ride="carousel" data-interval="4000" id="bs-carousel">
              <ol class="carousel-indicators">
                    <li data-target="#diesto" data-slide-to="0" class="active"></li>
                    <li data-target="#diesto" data-slide-to="1"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                  <div class="carousel-item active">
                    <div class="slide">
                      <img class="card-img-top" src="img/collections/diesto.jpg">
                       <a>
                          <div class="mask rgba-white-slight waves-effect waves-light"></div>
                      </a>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <div class="slide">
                      <img class="card-img-top" src="img/collections/diesto_2.jpg">
                       <a>
                          <div class="mask rgba-white-slight waves-effect waves-light"></div>
                      </a>
                    </div>
                  </div>
                </div>
                  <a class="carousel-control-prev" href="#diesto" role="button" data-slide="prev"><span class="fa fa-chevron-left arrow"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#diesto" role="button" data-slide="next"><span class="fa fa-chevron-right arrow"></span>
                    <span class="sr-only">Next</span>
                  </a>
              </div>
              <div class="card-body text-center">
                <h4 class="card-title"><span class="fa fa-book"></span> Genaro "Totik" Diesto, Jr. Collections</h4>
                <p class="card-text black-text">Genaro Diesto, Jr. known to his family and friends as "Totik", was born on March 30, 1952 in Iloilo City. He was the youngest son of the late Rev. Genaro Diesto, Sr. the "Prince of Visayan Evangelists" and the late Ruth Depakakibo Diesto, a graduate of the Baptist Missionary Training School, now the College of Theology Library of Central Philippine University.<br>Totik, a true-blooeded Centralian, finished his elementary, high school and college education at Central Philippine University. Prior to his Theological trainign at the College of Theology, he enrolled in the Bachelor of Arts major in Political Science.<br>Dr. Genardo Diesto, Jr. is already gone, but his memories linger. He will always be remembered for his geniune love and concern by those whom he had encountered during his lifetime</p>
              </div>
          </div>
        </div>
      <div class="col-lg-6 col-md-6 mb-1">
          <div class="card view overlay zoom">
            <div id="agape" class="carousel fade-carousel slide" data-ride="carousel" data-interval="4000" id="bs-carousel">
              <ol class="carousel-indicators">
                    <li data-target="#agape" data-slide-to="0" class="active"></li>
                    <li data-target="#agape" data-slide-to="1"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                  <div class="carousel-item active">
                    <div class="slide">
                      <img class="card-img-top" src="img/collections/agape.jpg">
                       <a>
                          <div class="mask rgba-white-slight waves-effect waves-light"></div>
                      </a>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <div class="slide">
                      <img class="card-img-top" src="img/collections/agape_2.jpg">
                       <a>
                          <div class="mask rgba-white-slight waves-effect waves-light"></div>
                      </a>
                    </div>
                  </div>
                </div>
                  <a class="carousel-control-prev" href="#agape" role="button" data-slide="prev"><span class="fa fa-chevron-left arrow"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#agape" role="button" data-slide="next"><span class="fa fa-chevron-right arrow"></span>
                    <span class="sr-only">Next</span>
                  </a>
              </div>
              <div class="card-body text-center">
                <h4 class="card-title"><span class="fa fa-book"></span> Agape Collection</h4>
                <p class="card-text black-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat.</p>
              </div>
          </div>
        </div>
    <div class="col-lg-6 col-md-6 mb-1">
            <div class="card view overlay zoom">
            <div id="music" class="carousel fade-carousel slide" data-ride="carousel" data-interval="4000" id="bs-carousel">
              <ol class="carousel-indicators">
                    <li data-target="#music" data-slide-to="0" class="active"></li>
                    <li data-target="#music" data-slide-to="1"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                  <div class="carousel-item active">
                    <div class="slide">
                      <img class="card-img-top" src="img/collections/music.jpg">
                       <a>
                          <div class="mask rgba-white-slight waves-effect waves-light"></div>
                      </a>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <div class="slide">
                      <img class="card-img-top" src="img/collections/music_2.jpg">
                       <a>
                          <div class="mask rgba-white-slight waves-effect waves-light"></div>
                      </a>
                    </div>
                  </div>
                </div>
                  <a class="carousel-control-prev" href="#music" role="button" data-slide="prev"><span class="fa fa-chevron-left arrow"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#music" role="button" data-slide="next"><span class="fa fa-chevron-right arrow"></span>
                    <span class="sr-only">Next</span>
                  </a>
              </div>
              <div class="card-body text-center">
                <h4 class="card-title"><span class="fa fa-music"></span> Elizabeth W. Knox  Scared Music Collection</h4>
                <p class="card-text black-text">A musical composition in printed or written form. arrangement, musical arrangement. a piece of music that has been adapted for performance by a particular set of voices or instruments. realisation, realization. a musical composition that has been completed or enriched by someone other than the composer.</p>
              </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-6 mb-1">
            <div class="card view overlay zoom">
            <div id="elliot" class="carousel fade-carousel slide" data-ride="carousel" data-interval="4000" id="bs-carousel">
              <ol class="carousel-indicators">
                    <li data-target="#elliot" data-slide-to="0" class="active"></li>
                    <li data-target="#elliot" data-slide-to="1"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                  <div class="carousel-item active">
                    <div class="slide">
                      <img class="card-img-top" src="img/collections/elliot.jpg">
                       <a>
                          <div class="mask rgba-white-slight waves-effect waves-light"></div>
                      </a>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <div class="slide">
                      <img class="card-img-top" src="img/collections/elliot_2.jpg">
                       <a>
                          <div class="mask rgba-white-slight waves-effect waves-light"></div>
                      </a>
                    </div>
                  </div>
                </div>
                  <a class="carousel-control-prev" href="#elliot" role="button" data-slide="prev"><span class="fa fa-chevron-left arrow"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#elliot" role="button" data-slide="next"><span class="fa fa-chevron-right arrow"></span>
                    <span class="sr-only">Next</span>
                  </a>
              </div>
              <div class="card-body text-center">
                <h4 class="card-title"><span class="fa fa-music"></span> Elliott Books Collection</h4>
                <p class="card-text black-text">The <span class="font-weight-bold">Elliot Books</span> were personally owned by the Rev. Dr. Ralph H. Elliott. About 1,500 Elliott books came to us this May 2008. They are being processed now, along with the other hundreds of books given by other generous donors.</p>
              </div>
          </div>
        </div>
	</div>
	</section>
</div>
<hr>
<?php include('library/html/footer.php'); ?>

  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="js/carousel.js"></script>
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/popper.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <script src="js/function.js"></script>
  <script src="js/wow.min.js"></script>
  <script src="js/nav_icons.js"></script>
  <script src="js/jquery-3.1.1.min.js"></script>
  	<script>

  	 new WOW().init();
  	/*Night Mode*/
	$( ".night-button" ).click(function() {
  	$( "body" ).toggleClass('night-mode');
	});
  	</script>
</body>
</html>