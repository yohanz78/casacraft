@extends('layouts.app-public')
@section('title', 'Home')
@section('content')
    <div class="site-wrapper-reveal">
        
        {{-- Hero Section --}}
        <div class="hero-box-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="hero-area" id="product-preview"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="abour-us-area section-space--ptb_120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="about-us-content_6 text-center">
                            <h2>Casa Craft.&nbsp;&nbsp;Store</h2>
                            <p>
                                <small>
                                    Casa Craft is the best place for home furniture that combines comfort, high quality, and beauty in design. We offer a variety of products from comfortable sofas to stylish dining tables, all made with special care and using environmentally friendly materials, with the vision to create elegant and functional living spaces. We are confident that every CasaCraft product will not only last a long time and beautify your home, but will also help the community. With Casa Craft, you can find the best in comfort and aesthetics.
                                </small>
                            </p>
                            <p class="mt-5">
                                Elevating your home with 
                                <span class="text-color-primary">Timeless Elegance and Comfort.</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Video Banner Section --}}
        <div class="banner-video-area overflow-hidden">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="banner-video-box">
                            <img src="https://images.unsplash.com/photo-1513694203232-719a280e022f?q=80&w=2069&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="banner-image">
                            <div class="video-icon">
                                <a href="https://youtu.be/UELVSZC06BE?si=SeDjUQM_7uRMZZ6y" class="popup-youtube">
                                    <i class="linear-ic-play"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Partners Area --}}
        <div class="our-brand-area section-space--pb_90">
            <div class="container"> 
                <div class="brand-slider-active">
                    @php
                        $partner_count = 5
                    @endphp
                    @for ($i = 1; $i < $partner_count; $i++)
                        <div class="col-lg-12">
                            <div class="single-brand-item">
                                <a href="#"><img src="assets/images/partners/partnerb{{$i}}.jpg" class="img-fluid" alt="partner-images"></a>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
        
        {{-- Member Area --}}
        <div class="our-member-area section-space--pb_120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="member--box">
                            <div class="row align-items-center">
                                <div class="col-lg-5 col-md-4">
                                    <div class="section-title small-mb__40 tablet-mb__40">
                                        <h4 class="section-title">Join member!</h4>
                                        <p>Become our member and get discount 25% off</p>
                                    </div>
                                </div>
                                <div class="col-lg-7 col-md-8">
                                    <div class="member-wrap">
                                        <form action="#" class="member--two">
                                            <input type="text" class="input-box" placeholder="Your email address">
                                            <button class="submit-btn"><i class="icon-arrow-right"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('addition_css')
@endsection
@section('addition_script')
    <script src="{{asset('pages/js/home.js')}}"></script>
@endsection
