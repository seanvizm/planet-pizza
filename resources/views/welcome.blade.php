@extends('layouts.app')

@section('content')

    <div class="Appcontainer overflow-auto">

    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text align-items-center" data-scrollax-parent="true">
                    <div class="col-md-6 col-sm-12 ftco-animate text-justify">
                        <h3 class="subheading text-primary" style="text-shadow: 0.2px 0.2px #000000;">Welcome!</h3>
                        <h1 class="mb-4">Explore our delicious selection of handcrafted pizzas. </h1>
                        <p class="mb-4 mb-md-5 text-light">Choose from our signature classics.</p>
                        <p><a href="/pizzas/menu" class="btn btn-primary p-3 px-xl-4 py-xl-3">Order Now</a></p>
                    </div>
                    <div class="col-md-6 ftco-animate mt-4 mb-4">
                        <img src="images/pizza-1.jpg" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
            </div>
            <div class="carousel-item">
            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text align-items-center" data-scrollax-parent="true">
                    <div class="col-md-6 col-sm-12 order-md-last ftco-animate text-justify">
                        <h3 class="subheading text-primary" style="text-shadow: 0.2px 0.2px #000000;">Welcome!</h3>
                        <h1 class="mb-4">Create your own masterpiece with up to 4 toppings </h1>
                        <p class="mb-4 mb-md-5 text-light">Every pizza is made fresh to order with premium ingredients.</p>
                        <p><a href="/pizzas/menu" class="btn btn-primary p-3 px-xl-4 py-xl-3">Order Now</a></p>
                    </div>
                    <div class="col-md-6 ftco-animate mt-4 mb-4">
                        <img src="images/pizza-5.jpg" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>

    <div class="ftco-section pizza-services">
        <div class="overlay"></div>
        <div class="container">
            <div class="row justify-content-center mt-4 mb-1 pb-2">
                <div class="col-md-7 heading-section ftco-animate text-center">
                    <h2 class="mb-2">Our Services</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 ftco-animate">
                    <div class="media d-block text-center block-6 services">
                        <div class="icon d-flex justify-content-center align-items-center mb-5">
                            <span class="flaticon-diet"></span>
                        </div>
                        <div class="media-body">
                            <h3 class="heading">Healthy Foods</h3>
                            <p>Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 ftco-animate">
                    <div class="media d-block text-center block-6 services">
                        <div class="icon d-flex justify-content-center align-items-center mb-5">
                            <span class="flaticon-bicycle"></span>
                        </div>
                        <div class="media-body">
                            <h3 class="heading">Fastest Delivery</h3>
                            <p>Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 ftco-animate">
                    <div class="media d-block text-center block-6 services">
                        <div class="icon d-flex justify-content-center align-items-center mb-5"><span
                                class="flaticon-pizza-1"></span></div>
                        <div class="media-body">
                            <h3 class="heading">Original Recipes</h3>
                            <p>Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="ftco-about d-md-flex">
        <div class="one-half img" style="background-image: url(images/pizzastore.jpg);"></div>
        <div class="one-half ftco-animate">
            <div class="heading-section ftco-animate ">
                <h2 class="mb-4">Our store</h2>
            </div>
            <div>
                <p>Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.</p>
            </div>
        </div>
    </div>

    <div class="ftco-intro">
        <div class="container-wrap">
            <div class="wrap d-md-flex">
                <div class="info">
                    <div class="row no-gutters">
                        <div class="col-md-4 d-flex ftco-animate">
                            <div class="icon"><span class="icon-phone"></span></div>
                            <div class="text">
                                <h3>Have a question?</h3>
                                <p>000 (123) 456 7890</p>
                            </div>
                        </div>
                        <div class="col-md-4 d-flex ftco-animate">
                            <div class="icon"><span class="icon-my_location"></span></div>
                            <div class="text">
                                <h3>Our Store</h3>
                                <p>Pizza St. Golden City</p>
                            </div>
                        </div>
                        <div class="col-md-4 d-flex ftco-animate">
                            <div class="icon"><span class="icon-clock-o"></span></div>
                            <div class="text">
                                <h3>Open Monday-Sunday</h3>
                                <p>7:00am - 11:00pm</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="social d-md-flex pl-md-5 p-4 align-items-center">
                    <ul class="social-icon">
                        <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                        <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                        <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="ftco-gallery">
        <div class="container-wrap">
            <div class="row no-gutters">
                <div class="col-md-3 ftco-animate">
                    <a href="#" class="gallery img d-flex align-items-center"
                        style="background-image: url(images/gallery-1.jpg);">
                        <div class="icon mb-4 d-flex align-items-center justify-content-center">
                            <span class="icon-search"></span>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 ftco-animate">
                    <a href="#" class="gallery img d-flex align-items-center"
                        style="background-image: url(images/gallery-2.jpg);">
                        <div class="icon mb-4 d-flex align-items-center justify-content-center">
                            <span class="icon-search"></span>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 ftco-animate">
                    <a href="#" class="gallery img d-flex align-items-center"
                        style="background-image: url(images/gallery-3.jpg);">
                        <div class="icon mb-4 d-flex align-items-center justify-content-center">
                            <span class="icon-search"></span>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 ftco-animate">
                    <a href="#" class="gallery img d-flex align-items-center"
                        style="background-image: url(images/gallery-4.jpg);">
                        <div class="icon mb-4 d-flex align-items-center justify-content-center">
                            <span class="icon-search"></span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div> --}}


    <div class="ftco-counter ftco-bg-dark img" id="section-counter"
        data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">
                            <div class="block-18 text-center">
                                <div class="text">
                                    <div class="icon"><span class="flaticon-pizza-1"></span></div>
                                    <strong class="number" data-number="8">0</strong>
                                    <span>Pizza Branches</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">
                            <div class="block-18 text-center">
                                <div class="text">
                                    <div class="icon"><span class="flaticon-medal"></span></div>
                                    <strong class="number" data-number="12">0</strong>
                                    <span>Number of Awards</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">
                            <div class="block-18 text-center">
                                <div class="text">
                                    <div class="icon"><span class="flaticon-laugh"></span></div>
                                    <strong class="number" data-number="22408">0</strong>
                                    <span>Happy Customers</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">
                            <div class="block-18 text-center">
                                <div class="text">
                                    <div class="icon"><span class="flaticon-chef"></span></div>
                                    <strong class="number" data-number="68">0</strong>
                                    <span>Staff</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <p class="mssg">{{ session('mssg') }}</p>
    </div>

    <style>
        /* Services section minimal margins */
        .ftco-section.pizza-services {
            padding-top: 1rem;
            padding-bottom: 1rem;
            margin-top: 0.5rem;
            margin-bottom: 0.5rem;
        }

        [data-theme="light"] .pizza-services .overlay {
            background: rgba(255, 255, 255, 0.95) !important;
        }

        /* Carousel theme styles */
        .carousel-item .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }

        [data-theme="light"] .carousel-item .overlay {
            background: rgba(255, 255, 255, 0.9);
        }

        .carousel-item .container {
            position: relative;
            z-index: 2;
        }

        [data-theme="light"] .carousel-item h1,
        [data-theme="light"] .carousel-item h3 {
            color: #212529 !important;
            text-shadow: none !important;
        }

        [data-theme="light"] .carousel-item p {
            color: #495057 !important;
        }

        [data-theme="light"] .carousel-inner {
            background-color: #f8f9fa !important;
        }

        /* Info section light theme */
        [data-theme="light"] .ftco-intro .info {
            background-color: #ffffff;
        }

        [data-theme="light"] .ftco-intro .info h3 {
            color: #212529;
        }

        [data-theme="light"] .ftco-intro .info p {
            color: #6c757d;
        }

        /* About section light theme */
        [data-theme="light"] .ftco-about .one-half {
            background-color: #ffffff;
        }

        [data-theme="light"] .ftco-about h2,
        [data-theme="light"] .ftco-about p {
            color: #212529;
        }

        /* Gallery light theme */
        [data-theme="light"] .ftco-gallery {
            background-color: #f8f9fa;
        }

        /* Counter section light theme */
        [data-theme="light"] .ftco-counter {
            background-color: #ffffff !important;
        }

        [data-theme="light"] .ftco-counter .overlay {
            background: rgba(255, 255, 255, 0.95) !important;
        }

        [data-theme="light"] .ftco-counter .number,
        [data-theme="light"] .ftco-counter span,
        [data-theme="light"] .ftco-counter .icon span {
            color: #212529 !important;
        }

        /* Contact section light theme */
        [data-theme="light"] .ftco-appointment .appointment {
            background-color: #ffffff;
        }

        [data-theme="light"] .ftco-appointment h3 {
            color: #212529;
        }

        [data-theme="light"] .form-control {
            background-color: #ffffff;
            border-color: #ced4da;
            color: #495057;
        }
    </style>

@endsection
