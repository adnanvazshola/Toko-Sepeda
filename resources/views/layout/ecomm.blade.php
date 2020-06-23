<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link href="apple-touch-icon.png" rel="apple-touch-icon">
    <link href="{{ asset('img/favicon.png') }}" rel="icon">
    <meta name="author" content="Nghia Minh Luong">
    <meta name="keywords" content="Default Description">
    <meta name="description" content="Default keyword">
    @yield('title')
    <!-- Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Archivo+Narrow:300,400,700%7CMontserrat:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('Skytheme/plugins/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Skytheme/plugins/ps-icon/style.css') }}">
    <!-- CSS Library-->
    <link rel="stylesheet" href="{{ asset('Skytheme/plugins/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Skytheme/plugins/owl-carousel/assets/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('Skytheme/plugins/jquery-bar-rating/dist/themes/fontawesome-stars.css') }}">
    <link rel="stylesheet" href="{{ asset('Skytheme/plugins/slick/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('Skytheme/plugins/bootstrap-select/dist/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Skytheme/plugins/Magnific-Popup/dist/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('Skytheme/plugins/jquery-ui/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Skytheme/plugins/revolution/css/settings.css') }}">
    <link rel="stylesheet" href="{{ asset('Skytheme/plugins/revolution/css/layers.css') }}">
    <link rel="stylesheet" href="{{ asset('Skytheme/plugins/revolution/css/navigation.css') }}">
    <!-- Custom-->
    <link rel="stylesheet" href="{{ asset('Skytheme/css/style.css') }}">
    @yield('css')
  </head>
  <body class="ps-loading">
    <div class="header--sidebar"></div>
    <header class="header">
      <div class="header__top">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-6 col-md-8 col-sm-6 col-xs-12 ">
              <p>Jalan Nusa Indah No. 13, Depok, Sleman  -  Hotline: 081-238-844-944</p>
            </div>
            <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12 ">
              @if (auth()->guard('pelanggan')->check())
                <div class="header__actions">
                  <div class="btn-group ps-dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Account<i class="fa fa-angle-down"></i></a>
                    <ul class="dropdown-menu">
                      <li><a href="{{ route('pelanggan.dashboard') }}">Dashboard</a></li>
                      <li><a href="{{ route('pelanggan.logout') }}">Logout</a></li>
                    </ul>
                  </div>
              @else
                  <div class="header__actions"><a href="{{ route('pelanggan.login') }}">Login</a>
              @endif
                    {{-- <div class="btn-group ps-dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">IDR<i class="fa fa-angle-down"></i></a>
                      <ul class="dropdown-menu">
                        <li><a href="#"><img src="{{ asset('Skytheme/img/flag/singapore.svg') }}" alt=""> IDR</a></li>
                        <li><a href="#"><img src="{{ asset('Skytheme/img/flag/usa.svg') }}" alt=""> USD</a></li>
                        <li><a href="#"><img src="{{ asset('Skytheme/img/flag/japan.svg') }}" alt=""> JPN</a></li>
                      </ul>
                    </div> --}}
                    {{-- <div class="btn-group ps-dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Language<i class="fa fa-angle-down"></i></a>
                      <ul class="dropdown-menu">
                        <li><a href="#">Indonesia</a></li>
                        <li><a href="#">English</a></li>
                        <li><a href="#">Japanese</a></li>
                      </ul>
                    </div> --}}
                  </div>
                </div>
          </div>
        </div>
      </div>
      <nav class="navigation">
        <div class="container-fluid">
          <div class="navigation__column left">
            <div class="header__logo"><a class="ps-logo" href="{{ route('front.index') }}"><img src="{{ asset('img/Logo.png') }}" alt=""></a></div>
          </div>
          <div class="navigation__column center">
            <ul class="main-menu menu">
              <li class="menu-item"><a href="{{ route('front.index') }}">Home</a></li>
              <li class="menu-item"><a href="{{ route('front.produk') }}">Produk</a></li>
              {{-- <li class="menu-item menu-item-has-children dropdown"><a href="#">Kategori</a>
                <ul class="sub-menu">
                  <li class="menu-item menu-item-has-children dropdown"><a href="blog-grid.html">Sepeda</a>
                    <ul class="sub-menu">
                      <li class="menu-item"><a href="blog-grid.html">Roadbike</a></li>
                      <li class="menu-item"><a href="blog-grid-2.html">Mountain Bike</a></li>
                    </ul>
                  </li>
                  <li class="menu-item"><a href="blog-list.html">Jersey</a></li>
                </ul>
              </li> --}}
              {{-- <li class="menu-item menu-item-has-children dropdown"><a href="#">Merk</a>
                <ul class="sub-menu">
                  <li class="menu-item"><a href="contact-us.html">Abus</a></li>
                  <li class="menu-item"><a href="contact-us.html">Avelio</a></li>
                </ul>
              </li> --}}
              <li class="menu-item"><a href="#">Blog</a></li>
            </ul>
          </div>
          <div class="navigation__column right">
            <form class="ps-search--header" action="do_action" method="post">
              <input class="form-control" type="text" placeholder="Search Product…">
              <button><i class="ps-icon-search"></i></button>
            </form>
            <div class="ps-cart"><a class="ps-cart__toggle" href="{{ route('front.list_cart') }}"><i class="ps-icon-shopping-cart"></i></a>
            </div>
            <div class="menu-toggle"><span></span></div>
          </div>
        </div>
      </nav>
    </header>
    {{-- <div class="header-services">
      <div class="ps-services owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="7000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="false" data-owl-item="1" data-owl-item-xs="1" data-owl-item-sm="1" data-owl-item-md="1" data-owl-item-lg="1" data-owl-duration="1000" data-owl-mousedrag="on">
        <p class="ps-service"><i class="ps-icon-delivery"></i><strong>Free delivery</strong>: Get free standard delivery on every order with All Bike</p>
        <p class="ps-service"><i class="ps-icon-delivery"></i><strong>Free delivery</strong>: Get free standard delivery on every order with All Bike</p>
        <p class="ps-service"><i class="ps-icon-delivery"></i><strong>Free service</strong>: Get free standard service on every order with All Bike</p>
      </div>
    </div> --}}
    <main class="ps-main">
      @yield('content')
      {{-- <div class="ps-subscribe">
        <div class="ps-container">
          <div class="row">
                <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12 ">
                  <h3><i class="fa fa-envelope"></i>Sign up to Newsletter</h3>
                </div>
                <div class="col-lg-5 col-md-7 col-sm-12 col-xs-12 ">
                  <form class="ps-subscribe__form" action="do_action" method="post">
                    <input class="form-control" type="text" placeholder="">
                    <button>Sign up now</button>
                  </form>
                </div>
                <div class="col-lg-4 col-md-5 col-sm-12 col-xs-12 ">
                  <p>...and receive  <span>$20</span>  coupon for first shopping.</p>
                </div>
          </div>
        </div>
      </div> --}}
      <div class="ps-footer bg--cover" data-background="{{ asset('img/parallax.svg') }}">
        <div class="ps-footer__content">
          <div class="ps-container">
            <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
                    <aside class="ps-widget--footer ps-widget--info">
                      <header><a class="ps-logo" href="index.html"><img src="{{ asset('img/AllBike_Putih.svg') }}" alt=""></a>
                        <h3 class="ps-widget__title">Alamat Kantor</h3>
                      </header>
                      <footer>
                        <p><strong>Jalan Nusa Indah No. 13, Depok, Sleman</strong></p>
                        <p>Email: <a href='mailto:support@store.com'>AllBike@store.com</a></p>
                        <p>Phone: 081-238-844-944</p>
                      </footer>
                    </aside>
                  </div>
                  {{-- <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 ">
                    <aside class="ps-widget--footer ps-widget--link">
                      <header>
                        <h3 class="ps-widget__title">Find Our store</h3>
                      </header>
                      <footer>
                        <ul class="ps-list--link">
                          <li><a href="#">Coupon Code</a></li>
                          <li><a href="#">SignUp For Email</a></li>
                          <li><a href="#">Site Feedback</a></li>
                          <li><a href="#">Careers</a></li>
                        </ul>
                      </footer>
                    </aside>
                  </div> --}}
                  {{-- <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 ">
                    <aside class="ps-widget--footer ps-widget--link">
                      <header>
                        <h3 class="ps-widget__title">Get Help</h3>
                      </header>
                      <footer>
                        <ul class="ps-list--line">
                          <li><a href="#">Order Status</a></li>
                          <li><a href="#">Shipping and Delivery</a></li>
                          <li><a href="#">Returns</a></li>
                          <li><a href="#">Payment Options</a></li>
                          <li><a href="#">Contact Us</a></li>
                        </ul>
                      </footer>
                    </aside>
                  </div> --}}
                  {{-- <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 ">
                    <aside class="ps-widget--footer ps-widget--link">
                      <header>
                        <h3 class="ps-widget__title">Products</h3>
                      </header>
                      <footer>
                        <ul class="ps-list--line">
                          <li><a href="#">Shoes</a></li>
                          <li><a href="#">Clothing</a></li>
                          <li><a href="#">Accessries</a></li>
                          <li><a href="#">Football Boots</a></li>
                        </ul>
                      </footer>
                    </aside>
                  </div> --}}
            </div>
          </div>
        </div>
        <div class="ps-footer__copyright">
          <div class="ps-container">
            <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                    <p>&copy; <a href="#">Allbike</a>, Inc. All rights Reserved. Didesain oleh<a href="#"> Kelompok Laravel</a></p>
                  </div>
                  {{-- <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                    <ul class="ps-social">
                      <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                      <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                      <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                      <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                    </ul>
                  </div> --}}
            </div>
          </div>
        </div>
      </div>
    </main>
    <!-- JS Library-->
    
    <script type="text/javascript" src="{{ asset('Skytheme/plugins/jquery/dist/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('Skytheme/plugins/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('Skytheme/plugins/jquery-bar-rating/dist/jquery.barrating.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('Skytheme/plugins/owl-carousel/owl.carousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('Skytheme/plugins/gmap3.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('Skytheme/plugins/imagesloaded.pkgd.js') }}"></script>
    <script type="text/javascript" src="{{ asset('Skytheme/plugins/isotope.pkgd.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('Skytheme/plugins/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('Skytheme/plugins/jquery.matchHeight-min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('Skytheme/plugins/slick/slick/slick.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('Skytheme/plugins/elevatezoom/jquery.elevatezoom.js') }}"></script>
    <script type="text/javascript" src="{{ asset('Skytheme/plugins/Magnific-Popup/dist/jquery.magnific-popup.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('Skytheme/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAx39JFH5nhxze1ZydH-Kl8xXM3OK4fvcg&amp;region=GB"></script>
    <script type="text/javascript" src="{{ asset('Skytheme/plugins/revolution/js/jquery.themepunch.tools.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('Skytheme/plugins/revolution/js/jquery.themepunch.revolution.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('Skytheme/plugins/revolution/js/extensions/revolution.extension.video.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('Skytheme/plugins/revolution/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('Skytheme/plugins/revolution/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('Skytheme/plugins/revolution/js/extensions/revolution.extension.navigation.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('Skytheme/plugins/revolution/js/extensions/revolution.extension.parallax.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('Skytheme/plugins/revolution/js/extensions/revolution.extension.actions.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('Skytheme/plugins/revolution/js/extensions/revolution.extension.kenburn.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('Skytheme/plugins/revolution/js/extensions/revolution.extension.migration.min.js') }}"></script>
      <!-- Custom scripts-->
    <script type="text/javascript" src="{{ asset('Skytheme/js/main.js') }}"></script>
    @yield('js')
  </body>
</html>
