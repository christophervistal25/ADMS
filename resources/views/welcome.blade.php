<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="https://res.cloudinary.com/dpcxcsdiw/image/upload/v1569302118/adms/tooth.png">
   <title>{{ config('app.name', 'Apit Subiri Dental Information System ') }}</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ URL::asset('css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/flaticon.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" integrity="sha256-+N4/V/SbAFiW1MPBCXnfnP9QSN3+Keu+NlB+0ev/YKQ=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/assets/owl.carousel.min.css" integrity="sha256-AWqwvQ3kg5aA5KcXpX25sYKowsX97sTCTbeo33Yfyk0=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.1/animate.min.css" integrity="sha256-1hIhSlowg4vqaFZ/bikPMfEGwSgM0FtIs7mx1PADHCk=" crossorigin="anonymous" />
    <!-- main css -->
    <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/responsive.css') }}">
</head>
<body>

    <!--================Header Menu Area =================-->
    <header class="header_area">
        <div class="top_menu row m0">
            <div class="container">
                <div class="float-left">
                    <a class="dn_btn text-primary" ><i class="ti-email"></i>apitdentalclinic@gmail.com</a>
                    <a href="https://foursquare.com/v/apitsuberi-dental-clinic/5230158811d21b934791aea5"><span class="text-primary"> <i class="ti-location-pin"></i>Apit-Suberi dental clinic Abarca Street (Near Diony's Watch Shop) 8311 Bislig Surigao del Sur Philippines</span></a>
                </div>
                <div class="float-right">
                    <ul class="list header_social">
                        <li><a href="https://www.facebook.com/pages/Apit-Dental-Clinic/843953378952555"><i class="ti-facebook"></i></a></li>
                    </ul> 
                </div>
            </div>  
        </div>  
        <div class="main_menu">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <a class="navbar-brand logo_h" href="/"><img src="https://res.cloudinary.com/dpcxcsdiw/image/upload/v1569310486/adms/logo-2.png" alt=""></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav ml-auto">
                            {{-- <li class="nav-item submenu dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a class="nav-link" href="blog.html">Login</a></li>
                                    <li class="nav-item"><a class="nav-link" href="single-blog.html">Blog Details</a></li>
                                    <li class="nav-item"><a class="nav-link" href="element.html">element</a></li>
                                </ul>
                            </li>  --}}
                            <li class="nav-item"><a class="nav-link" href="{{ route('patient.auth.login') }}">Sign in</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('patient.auth.register') }}">Sign Up</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <!--================Header Menu Area =================-->

    <!--================Home Banner Area =================-->

    <section class="banner-area d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <h1>Making Health<br>
                    Care Better Together</h1>
                    <p>Also you dry creeping beast multiply fourth abundantly our itsel signs bring our. Won form living. Whose dry you seasons divide given gathering great in whose you'll greater let livein form beast  sinthete
                    better together these place absolute right.</p>
                    <a href="{{ route('patient.auth.register') }}" class="main_btn">Make an Appointment</a>
                </div>
            </div>
        </div>
    </section>

    <!--================End Home Banner Area =================-->


    <!--================ Feature section start =================-->      
    <section class="feature-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-feature text-center text-lg-left">

                            <h3 class="card-feature__title"><span class="card-feature__icon">
                                <i class="ti-layers"></i>
                            </span>Primary Care</h3>
                            <p class="card-feature__subtitle">An so vulgar to on points wanted rapture ous resolving continued household </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-feature text-center text-lg-left">

                            <h3 class="card-feature__title"><span class="card-feature__icon">
                                <i class="ti-heart-broken"></i>
                            </span>Emergency Cases</h3>
                            <p class="card-feature__subtitle">An so vulgar to on points wanted rapture ous resolving continued household </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-feature text-center text-lg-left">

                            <h3 class="card-feature__title"><span class="card-feature__icon">
                                <i class="ti-headphone-alt"></i>
                            </span>Online Appointment</h3>
                            <p class="card-feature__subtitle">An so vulgar to on points wanted rapture ous resolving continued household </p>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!--================ Feature section end =================-->  

    <!--================ Service section start =================-->  

    <div class="service-area area-padding-top">
        <div class="container">
            <div class="area-heading row">
                <div class="col-md-5 col-xl-4">
                    <h3>Awesome<br>
                    Health Service</h3>
                </div>
                <div class="col-md-7 col-xl-8">
                    <p>Land meat winged called subdue without very light in all years sea appear midst forth image him third there set. Land meat winged called subdue without very light in all years sea appear</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <div class="card-service text-center text-lg-left mb-4 mb-lg-0">
                        <span class="card-service__icon">
                            <i class="flaticon-brain"></i>
                        </span>
                        <h3 class="card-service__title">Neurology Service</h3>
                        <p class="card-service__subtitle">Land meat winged called subdue without a very light in all years sea appear Lesser bring fly first land set female best perform.</p>
                        <a class="card-service__link" href="#">Learn More</a>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="card-service text-center text-lg-left mb-4 mb-lg-0">
                        <span class="card-service__icon">
                            <i class="flaticon-tooth"></i>
                        </span>
                        <h3 class="card-service__title">Dental Clinic</h3>
                        <p class="card-service__subtitle">Land meat winged called subdue without a very light in all years sea appear Lesser bring fly first land set female best perform</p>
                        <a class="card-service__link" href="#">Learn More</a>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="card-service text-center text-lg-left mb-4 mb-lg-0">
                        <span class="card-service__icon">
                            <i class="flaticon-face"></i>
                        </span>
                        <h3 class="card-service__title">Plastic Surgery</h3>
                        <p class="card-service__subtitle">Land meat winged called subdue without a very light in all years sea appear Lesser bring fly first land set female best perform</p>
                        <a class="card-service__link" href="#">Learn More</a>
                    </div>
                </div>


            </div>
        </div>
    </div>    
    <!--================ Service section end =================-->      


    <!--================About  Area =================-->
    <section class="about-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-10 offset-md-1 col-lg-6 offset-lg-6 offset-xl-7 col-xl-5">
                    <div class="about-content">
                        <h4>Second Abundantly<br>
                            Move That Cattle Perform<br>
                        Appen Land</h4>
                        <h6>Give their their without moving were stars called so divide in female be moving night may fish him</h6>
                        <p>Give their their without moving were stars called so divide female be moving night may fish him own male vreated great Give their their without moving were. Stars called so divide female moving night may fish him own male created great opportunity deal.</p>

                        <a class="link_one" href="#">learn more</a>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================About Area End =================-->

    <!--================ Team section start =================-->  
    <section class="team-area area-padding">
        <div class="container">
            <div class="area-heading row">
                <div class="col-md-5 col-xl-4">
                    <h3>Medcare<br>
                    Experience Doctors</h3>
                </div>
                <div class="col-md-7 col-xl-8">
                    <p>Land meat winged called subdue without very light in all years sea appear midst forth image him third there set. Land meat winged called subdue without very light in all years sea appear</p>
                </div>
            </div>

            <div class="row">

                <div class="col-12 col-md-6 col-lg-4 offset-4">
                    <div class="card card-team">
                        <img class="card-img rounded-0" src="https://res.cloudinary.com/dpcxcsdiw/image/upload/v1569310991/adms/2.jpg" alt="">
                        <div class="card-team__body text-center">
                            <h3><a href="#">Dr Blian Judge</a></h3>
                            <p>Dentists</p>
                            <div class="team-footer d-flex justify-content-between">
                                <a class="dn_btn" href=""><i class="ti-mobile"></i>+7 235 365 2365</a>
                                <ul class="card-team__social">
                                    <li><a href="#"><i class="ti-facebook"></i></a></li>
                                    <li><a href="#"><i class="ti-twitter-alt"></i></a></li>
                                    <!-- <li><a href="#"><i class="ti-instagram"></i></a></li>
                                    <li><a href="#"><i class="ti-skype"></i></a></li> -->
                                </ul> 
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!--================ Team section end =================-->  





    <!-- ================ Hotline Area Starts ================= -->  
    <section class="hotline-area text-center area-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Emergency hotline</h2>
                    <span>(Landline Number)</span>
                    <p class="pt-3">We provide customer support. Please feel free to contact us <br>for emergency case.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ Hotline Area End ================= -->  




    <!-- start footer Area -->
    <footer class="footer-area area-padding-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-sm-6 single-footer-widget">
                    <h4>Top Products</h4>
                    <ul>
                        <li><a href="#">Managed Website</a></li>
                        <li><a href="#">Manage Reputation</a></li>
                        <li><a href="#">Power Tools</a></li>
                        <li><a href="#">Marketing Service</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-sm-6 single-footer-widget">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="#">Jobs</a></li>
                        <li><a href="#">Brand Assets</a></li>
                        <li><a href="#">Investor Relations</a></li>
                        <li><a href="#">Terms of Service</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-sm-6 single-footer-widget">
                    <h4>Features</h4>
                    <ul>
                        <li><a href="#">Jobs</a></li>
                        <li><a href="#">Brand Assets</a></li>
                        <li><a href="#">Investor Relations</a></li>
                        <li><a href="#">Terms of Service</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-sm-6 single-footer-widget">
                    <h4>Resources</h4>
                    <ul>
                        <li><a href="#">Guides</a></li>
                        <li><a href="#">Research</a></li>
                        <li><a href="#">Experts</a></li>
                        <li><a href="#">Agencies</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-6 single-footer-widget">
                    <h4>Newsletter</h4>
                    <p>You can trust us. we only send promo offers,</p>
                    <div class="form-wrap" id="mc_embed_signup">
                        <form target="_blank" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
                        method="get" class="form-inline">
                        <input class="form-control" name="EMAIL" placeholder="Your Email Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your Email Address'"
                        required="" type="email" />
                        <button class="click-btn btn btn-default">
                            <i class="ti-arrow-right"></i>
                        </button>
                        <div style="position: absolute; left: -5000px;">
                            <input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text" />
                        </div>

                        <div class="info"></div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row footer-bottom d-flex justify-content-between">
            <p class="col-lg-8 col-sm-12 footer-text m-0">
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </p>
            <div class="col-lg-4 col-sm-12 footer-social">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-dribbble"></i></a>
                <a href="#"><i class="fab fa-linkedin"></i></a>
            </div>
        </div>
    </div>
</footer>
<!-- End footer Area -->






<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="{{ URL::asset('js/stellar.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.min.js" integrity="sha256-s5TTOyp+xlSmsDfr/aZhg0Gz+JejYr5iTJI8JxG1SkM=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js" integrity="sha256-oP3taRrtdn+FEBHNMYW5KGGSmKIaD72tSAip6ItJCDM=" crossorigin="anonymous"></script>
<script src="{{ URL::asset('js/theme.js') }}"></script>
</body>
</html>