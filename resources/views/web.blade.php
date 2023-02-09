<!-- <!DOCTYPE html> -->
<html>
<head>
<title>{{$data->title}}</title>
<link id="favicon" rel="icon" href="https://hyperdev.com/favicon-app.ico" type="image/x-icon">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
<link href="http://fonts.googleapis.com/css?family=Cookie" rel="stylesheet" type="text/css">

<style type="text/css">

/* Box Model Hack */
* {
  -moz-box-sizing: border-box; /* Firexfox */
  -webkit-box-sizing: border-box; /* Safari/Chrome/iOS/Android */
  box-sizing: border-box; /* IE */
}

body {
  overflow-x: hidden;
  background-color: @if($data->bg_color!=""){{$data->bg_color}} @else #ffffff @endif;
}
html {
  width: 100%;
  height: 100%;
}
h1,h2,h3,h4,h5,h6 {
  margin: 0 0 35px;
  text-transform: uppercase;
  font-family: 'Montserrat', sans-serif;
  font-weight: ;
  letter-spacing:1.5px;
  }
p {
  margin: 0 0 25px;
  font-size: 18px;
}
a:hover, a:focus, a:active  {
  outline: none;
}
.img {
  max-width: 180px;
  height: auto;
}
.btn {
  background: transparent;
  color: #fff;
  width: 150px;
  height: 35px;
  border-style: solid;
  border-radius: 0;
  font-family: Roboto;
  font-size: 15px;
  text-transform: uppercase;
}
.btn:hover {
  background-color: white;
  transition-duration: 0.5s;
  color: #0083AE;
  outline: none;
}

/*NAVIGATION*/

.navbar-default .navbar-nav > .active > a,
.navbar-default .navbar-nav > .active > a:hover,
.navbar-default .navbar-nav > .active > a:focus {
  color: white;
  background-color: @if($data->btn_color!=""){{$data->btn_color}} @else #0083AE @endif;
}
.navbar-default .navbar-brand {
  color: {{$data->btn_color}};
}
.navbar-default .navbar-nav > li > a {
  color: @if($data->btn_color!=""){{$data->btn_txt_color}} @else #5E5E5E @endif ;
}
.navbar-default .navbar-nav > li > a:hover {
  color: #0083AE;
}
.navbar-default .navbar-brand:hover, .navbar-default .navbar-brand:focus {
  color: grey;
}
.navbar-default  a.navbar-brand:visited {
  color: ;
}
.navbar {
  padding: 5px;
  border-bottom-color: #7F919B;
  background-color: @if($data->header_color!=""){{$data->header_color}} @else #ffffff @endif;
}
.navbar-brand {
  text-transform: uppercase;
  font-family: 'Montserrat', sans-serif;
  font-size: 25px;
  letter-spacing: 1px;
}
.navbar li {
  font-family: 'Montserrat', sans-serif;
  font-weight: 400;
  font-size: 18px;
  letter-spacing: 0.5px;
  text-transform: uppercase;
}

/*Header*/

.intro {
  background: #0083AE;
  background-position: center;
  background-repeat: no-repeat;
  display: table;
  width: 100%;
  height: auto;
  margin-top: -18px;
 /*padding: 180px 0;*/
  text-align: center;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  background-size: cover;
  -o-background-size: cover;
}
.intro .intro-body {
  display: table-cell;
  vertical-align: middle;
}
.intro .intro-body .intro-heading {
  font-family: 'Roboto', sans-serif;
  font-weight: 700px;
  font-size: 80px;
  color: #fff;
  margin-top: 80px;
}
.intro .intro-text {
  margin-top: -30px;
  font-size: 23px;
  font-family: 'Roboto', sans-serif;
  font-weight: 700px;
  color: #fff;
}

/*LAYOUT*/

section {
  padding: 100px;
}
.section-heading {
  color: {{$data->heading_color}};
}
section h2.section-heading {
  margin-top: 0;
  margin-bottom: 15px;
  font-family: 'Montserrat', sans-serif;
  font-size: 50px;
  font-weight: 300;
  color: #2A2D2F;
  line-height: 1;
  letter-spacing: -1px;
}

/* Portfolio */
.portfolio-item {
  margin-top: 20px;
}
#portfolio .portfolio-item {
  right: 0;
  margin: 0 0 15px;
}
#portfolio .portfolio-item .portfolio-link {
  display: block;
  position: relative;
  margin: 0 auto;
  max-width: 350px
}
.portfolio-item .img-responsive {
  margin: 0 auto;
}
#portfolio .portfolio-item .caption-content {
  margin: 0 auto;
  text-align: center;
}

/* Portfolio Modal*/
.portfolio-modal .modal-content {
  padding: 100px 0;
  min-height: 100%;
  border: 0;
  border-radius: 0;
  text-align: center;
  background-clip: border-box;
  -webkit-box-shadow: none;
  box-shadow: none;
}
.portfolio-modal .modal-content h2 {
  margin: 0;
  font-size: 3em;
}

.portfolio-modal .modal-content img {
  margin: 0 auto;
}
.portfolio-modal .close-modal {
  position: absolute;
  top: 25px;
  right: 25px;
  width: 75px;
  height: 75px;
  background-color: transparent;
  cursor: pointer;
}
.portfolio-modal .close-modal:hover {
  opacity: .3;
}
.portfolio-modal .close-modal .lr {
  z-index: 1051;
  width: 1px;
  height: 75px;
  margin-left: 35px;
  background-color: #2c3e50;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}
.portfolio-modal .close-modal .lr .rl {
  z-index: 1052;
  width: 1px;
  height: 75px;
  background-color: #2c3e50;
  -webkit-transform: rotate(90deg);
  -ms-transform: rotate(90deg);
  transform: rotate(90deg);
}
.portfolio-modal .modal-backdrop {
  display: none;
  opacity: 0;
}

/*#about {
  padding: 200px 50px 200px 50px;
}*/
#contact {
  padding: 150px 50px 120px 50px;
}
#footer {
  padding: 50px 50px 10px 50px;
}

/*SOCIAL BUTTONS*/

.social {
  margin: 0;
  padding: 0;
}
.social ul {
  margin: 0;
  padding: 5px;
}
.social ul li {
  margin: 5px;
  list-style: none outside none;
  display: inline-block;
}

/*MEDIA QUERIES*/

@media(min-width:769px) {
.intro .intro-body .intro-heading {
  font-size: 80px;
}
.intro .intro-body .intro-text {
  font-size: 23px;
}
section h2.section-heading {
  font-size: 55px;
}
p {
  margin: 0 0 35px;
  font-size: 20px;
  line-height: 1.6;
}}
@media(max-width:768px) {
.intro .intro-body .intro-heading {
  font-size: 60px;
}
.intro .intro-body .intro-text {
  font-size: 18px;
}
section h2.section-heading {
  font-size: 35px;
}
section {
  padding: 100px 0;
  margin: auto;
}}
@media(max-width:360px) {
.intro .intro-body .intro-heading {
  font-size: 45px;
}
.intro .intro-body .intro-text {
  font-size: 18px;
}}
p{
  margin-left: 0px !important;
  margin-right: 0px !important;
}

/* Set the size of the div element that contains the map */
#map {
  height: 400px;
  /* The height is 400 pixels */
  width: 100%;
  /* The width is the width of the web page */
}
.footer-distributed {
  box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.12);
  box-sizing: border-box;
  width: 100%;
  text-align: left;
  font: bold 16px sans-serif;
  padding: 55px 50px;
  margin-top: 80px;
  background-color: {{$data->footer_bgcolor}};
}
.footer-distributed .footer-left,
.footer-distributed .footer-center,
.footer-distributed .footer-right {
  display: inline-block;
  vertical-align: top;
}
/* Footer left */
.footer-distributed .footer-left {
  width: 40%;
}
/* The company logo */
.footer-distributed h3 {
  color: #ffffff;
  font: normal 36px "Cookie", cursive;
  margin: 0;
}
.footer-distributed h3 span {
  color: #5383d3;
}
/* Footer links */
.footer-distributed .footer-links {
  margin: 20px 0 12px;
  padding: 0;
  color: {{$data->footer_txt_color}};
}
.footer-distributed .footer-links a {
  display: inline-block;
  line-height: 1.8;
  text-decoration: none;
  color: inherit;
}
.footer-distributed .footer-company-name {
  color: #8f9296;
  font-size: 14px;
  font-weight: normal;
  margin: 0;
}

/* Footer Center */
.footer-distributed .footer-center {
  width: 30%;
}
.footer-distributed .footer-center i {
  background-color: #33383b;
  font-size: 25px;
  width: 38px;
  height: 38px;
  border-radius: 50%;
  text-align: center;
  line-height: 42px;
  margin: 10px 15px;
  vertical-align: middle;
  color: {{$data->footer_txt_color}};
}
.footer-distributed .footer-center i.fa-envelope {
  font-size: 17px;
  line-height: 38px;
}
.footer-distributed .footer-center p {
  display: inline-block;
  vertical-align: middle;
  margin: 0;
  color: {{$data->footer_txt_color}};
}
.footer-distributed .footer-center p span {
  display: block;
  font-weight: normal;
  font-size: 14px;
  line-height: 2;
}
.footer-distributed .footer-center p a {
  color: #fff;
  text-decoration: none;
}

/* Footer Right */
.footer-distributed .footer-right {
  width: 27%;
}
.footer-distributed .footer-company-about {
  line-height: 20px;
  color: #92999f;
  font-size: 13px;
  font-weight: normal;
  margin: 0;
}
.footer-distributed .footer-company-about span {
  display: block;
  font-size: 14px;
  font-weight: bold;
  margin-bottom: 20px;
  color: {{$data->footer_txt_color}};
}
.footer-distributed .footer-icons {
  margin-top: 25px;
}
.footer-distributed .footer-icons a {
  display: inline-block;
  width: 35px;
  height: 35px;
  cursor: pointer;
  background-color: #33383b;
  border-radius: 2px;
  font-size: 20px;
  color: #ffffff;
  text-align: center;
  line-height: 35px;
  margin-right: 3px;
  margin-bottom: 5px;
}

/* If you don't want the footer to be responsive, remove these media queries */
@media (max-width: 880px) {
  .footer-distributed {
  font: bold 14px sans-serif;
}
  .footer-distributed .footer-left,
  .footer-distributed .footer-center,
  .footer-distributed .footer-right {
    display: block;
    width: 100%;
    margin-bottom: 40px;
    text-align: center;
  }
  .footer-distributed .footer-center i {
    margin-left: 0;
  }
}
</style>
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
  <!-- NAVIGATION -->
  <div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand page-scroll" href="#page-top">{{$data->title}}</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="navbar-collapse collapse" id="navbar">
        <ul class="nav navbar-nav navbar-right">
          <li class="hidden">
            <a href="#page-top"></a>
          </li>
            <li><a href="#about">Home</a></li>
            <li><a href="#portfolio">Gallery</a></li>
            <li><a href="#nearby">Nearby</a></li>
          <li><a href="#contacts">Contact</a></li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container -->
  </div><!-- /.navbar -->

    <!-- HEADER -->
  <header class="intro" >
    <div class="intro-body" style="display: none;">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-offset-2 text-center">
            <h1 class="intro-heading">Simplified</h1>
            <p class="intro-text">A Simple, One-Page Portfolio Template</p>
            <a href="#about" class="btn btn-default page-scroll">Find Out More</a>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- ABOUT SECTION -->
  <section id="about">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12" style="padding-top: 15px">
          {!!$data->home!!}
        </div>
      </div>
    </div>
  </section>


  <!-- PORTFOLIO SECTION -->
  <section id="portfolio">
    <div class="container-fluid">
        @if(!empty($gallery->chunk(3)))
      <div class="row">
        <div class="col-md-12 col-offset-2 text-center">
          <h3 class="section-heading">Gallery</h3>
        </div>
      </div>
@endif
       <!-- Portfolio -->
        @if(!empty($gallery->chunk(3)))
      @foreach($gallery->chunk(3) as $level)
      <div class="row">
        @foreach($level as $item)
        <div class="col-md-4 col-sm-6 portfolio-item">
          <a href="#portfolioModal-1" class="project-link">
            <img src="{{$item->image}}" class="img-responsive" media="(max-width:400px)" style="width:auto;" alt="">
          </a>
        </div>
        @endforeach
      </div>
      @endforeach
            @endif
    </div>
  </section>

  <!-- Nearby SECTION -->
  <section id="nearby">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-offset-2 text-center">
          <h3 class="section-heading">Nearby Places</h3>
          <!-- Social Media Contact-->
          <div id="googleMap" style="width:100%;height:400px;"></div>
        </div>
      </div>
    </div>
  </section>

  <!-- CONTACT SECTION -->
  <footer class="footer-distributed" id="contacts">
      <div class="footer-left">
        <h1>{{$data->title}}</h1>
        <p class="footer-links">
          <a href="#about">Home</a> ·
          <a href="#portfolio">Gallery</a> ·
          <a href="#nearby">Nearby</a>
        </p>
        <p class="footer-company-name">{{$data->title}} &copy; <span id="copyright">
        <script>document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))</script></span></p>
      </div>

      @if($data->fb_link=="" || $data->fb_link==null && $data->twitter_link=="" || $data->twitter_link==null && $data->insta_link=="" || $data->insta_link==null)
      <div class="footer-right">
        <p class="footer-company-about"><span><font size="4"></font></span></p>
        <div class="footer-icons">
        </div>
      </div>
      @else

      <div class="footer-right">
        <p class="footer-company-about"><span><font size="4">Follow us</font></span></p>
        <div class="footer-icons">
          @if($data->fb_link)
          <a href="{{$data->fb_link}}" style="padding: 7px"><i class="fa fa-facebook"></i></a>
          @endif
          @if($data->twitter_link)
          <a href="{{$data->twitter_link}}" style="padding: 7px"><i class="fa fa-twitter"></i></a>
          @endif
          @if($data->insta_link)
          <a href="{{$data->insta_link}}" style="padding: 7px"><i class="fa fa-instagram"></i></a>
          @endif
        </div>
      </div>
      @endif

      <div class="footer-center">
        <p class="footer-company-about"><span><b><font size="4">Contact us</font></b></span></p>
        <div>
          <i class="fa fa-phone"></i>
          <p>{{$data->phone}}</p>
        </div>
        <div>
          <i class="fa fa-envelope"></i>
          <p><a href="mailto:{{$data->email}}">{{$data->email}}</a></p>
        </div>
      </div>
    </footer>

    <!-- Portfolio Modals -->
    <div class="portfolio-modal modal fade" id="portfolioModal-1" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
          <div class="lr">
            <div class="rl">
            </div>
          </div>
        </div>
        <div class="container">
          <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
              <div class="modal-body">
                <h2>Project Title 1</h2>
                <img src="http://placehold.it/650x450" class="img-responsive img-centered" alt="">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="portfolio-modal modal fade" id="portfolioModal-2" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
          <div class="lr">
            <div class="rl">
            </div>
          </div>
        </div>
        <div class="container">
          <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
              <div class="modal-body">
                <h2>Project Title 2</h2>
                <img src="http://placehold.it/650x450" class="img-responsive img-centered" alt="">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="portfolio-modal modal fade" id="portfolioModal-3" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
          <div class="lr">
            <div class="rl">
            </div>
          </div>
        </div>
        <div class="container">
          <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
              <div class="modal-body">
                <h2>Project Title 3</h2>
                <img src="http://placehold.it/650x450" class="img-responsive img-centered" alt="">
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="portfolio-modal modal fade" id="portfolioModal-4" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
          <div class="lr">
            <div class="rl">
            </div>
          </div>
        </div>
        <div class="container">
          <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
              <div class="modal-body">
                <h2>Project Title 4</h2>
                <img src="http://placehold.it/650x450" class="img-responsive img-centered" alt="">
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="portfolio-modal modal fade" id="portfolioModal-5" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
          <div class="lr">
            <div class="rl">
            </div>
          </div>
        </div>
        <div class="container">
          <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
              <div class="modal-body">
                <h2>Project Title 5</h2>
                <img src="http://placehold.it/650x450" class="img-responsive img-centered" alt="">
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="portfolio-modal modal fade" id="portfolioModal-6" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
          <div class="lr">
            <div class="rl">
            </div>
          </div>
        </div>
        <div class="container">
          <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
              <div class="modal-body">
                <h2>Project Title 6</h2>
                <img src="http://placehold.it/650x450" class="img-responsive img-centered" alt="">
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
    <!-- /Project Modals -->
</body>

<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

<script>

function myMap() {
  lat =  {{$data->latitude}};
  lng =  {{$data->longitude}};

var mapProp= {
  center:new google.maps.LatLng(lat,lng),
  zoom:16,
};
var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
var marker = new google.maps.Marker({
  position: new google.maps.LatLng(lat,lng),
  map: map
  });
}

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAzf7KnzVx3iLASRh25OP_bYgTpUD-dIW8&callback=myMap">
</script>

<script type="text/javascript">

$(document).ready(function(){
  $('.nav li a').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'')
    && location.hostname == this.hostname) {
      var $target = $(this.hash);
      $target = $target.length && $target
      || $('[name=' + this.hash.slice(1) +']');
      if ($target.length) {
        var targetOffset = $target.offset().top;
        $('html,body')
        .animate({scrollTop: targetOffset}, 1000);
       return false;
      }
    }
  });
});

$(document).ready(function() { 

  $('a.page-scroll').click(function() {  
    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')   && location.hostname == this.hostname) {   
      var $target = $(this.hash);   
      $target = $target.length && $target    || $('[name=' + this.hash.slice(1) + ']');   
      if ($target.length) {    
        var targetOffset = $target.offset().top;    
        $('html,body')    .animate({
          scrollTop: targetOffset
        }, 1000);    
        return false;   
      }  
    } 
  });
});
</script>
</html>
