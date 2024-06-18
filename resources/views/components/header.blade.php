<div class="header-area header-area--default bg-white">
    {{-- Header Bottom Wrap Start --}}
    <header class="header-area header-sticky">
        <div class="container-fluid container-fluid--cp-100">
            <div class="row">
                <div class="col-lg-12 d-none d-md-block">
                    <div class="top-logo-area">
                        <div class="logo text-md-center">
                            <a href="{{route('home')}}">
                                <img src="{{asset('assets/images/logo/logo-transparent-1-2.png')}}" alt="logo" style="width:30%">
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row align-items-center">
                
                <div class="col-lg-3 col-6">
                    <div class="header-right-items content__hidden d-none d-md-block">
                        <span class="phone-number font-lg-p" title="Contact us">
                            <a href="#cfd">
                                <i class="icon-telephone"></i>
                                &nbsp;&nbsp;
                                <small class="text-color-primary">
                                    <b>+(62) 851-2345-6789</b>
                                </small>
                            </a>
                        </span>
                    </div>
                    <div class="logo__hidden text-start">
                        <a href="{{route('home')}}">
                            <img src="{{asset('assets/images/logo/logo-transparent-1-2.png')}}" alt="logo" style="width:40%">
                        </a>
                    </div>
                </div>

                <div class="col-lg-6 d-none d-lg-block">
                    <div class="header__navigation d-none d-lg-block">
                        <nav class="navigation-menu">
                            <ul class="justify-content-center">
                                <li>
                                    <a href="{{route('home')}}"><span>Home</span></a>
                                </li>
                                <li>
                                    <a href="{{route('plp')}}"><span>Shop</span></a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="header-right-side text-end">

                        <div class="header-right-items d-none d-md-block">
                            <a href="#wishlist" class="header-cart">
                                <i class="icon-heart"></i>
                                <span class="item-counter">5</span>
                            </a>
                        </div>

                        <div class="header-right-items">
                            <a href="#minicart" class="header-cart">
                                <i class="icon-bag2"></i>
                                <span class="item-counter">1</span>
                            </a>
                        </div>

                        <div class="header-right-items d-none d-md-block">
                            @if (@$_COOKIE['ut'])
                                <div class="dropdown">
                                    <a class="dropdown-toggle" role="button" href="#" data-bs-toggle="dropdown">
                                        Hello, {{ucwords(substr($_COOKIE['ue'], 0, 4))}}
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="#my-profile">
                                                <span>My profile</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" id="logout-btn">
                                                <span>Logout</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            @else
                                <a href="#" type="button" data-bs-toggle="modal" data-bs-target="#authModal">
                                    <i class="icon-user"></i>
                                </a>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </header>
</div>
{{-- Header Bottom Wrap End --}}

@php
    // echo "<pre>"; print_r($_COOKIE); echo "</pre>"
@endphp

<div class="header-login-register-wrapper modal fade" id="authModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-box-wrapper">
                <div class="helendo-tabs">
                    <ul class="nav" role="tablist">
                        <li class="tab__item nav-item active">
                            <a class="nav-link active" data-bs-toggle="tab" href="#tab_list_06" role="tab">Login</a>
                        </li>
                        <li class="tab__item nav-item active">
                            <a class="nav-link" data-bs-toggle="tab" href="#tab_list_07" role="tab">Register</a>
                        </li>
                    </ul>
                </div>

                <div class="tab-content content-modal-box">

                    <div class="tab-pane fade show active" id="tab_list_06" role="tabpanel">
                        <form class="account-form-box" id="form-login">
                            <h6 class="mb-3">Login your account</h6>
                            <b id="form-login-error" class="text-red"></b>
                            <div class="single-input">
                                <input type="text" name="email" placeholder="Email" required>
                            </div>
                            <div class="single-input">
                                <input type="password" name="password" placeholder="Password" required>
                            </div>
                            <div class="checkbox-wrap mt-10">
                                <label class="label-for-checkbox inline mt-15">
                                    <input type="checkbox" name="rememberme" class="input-checkbox" id="rememberme" value="forever">
                                    <span>Remember me</span>
                                </label>
                                <a href="#" class="mt-10">Forget your password?</a>
                            </div>
                            <div class="button-box mt25">
                                <a href="#" class="btn brn--full btn--black" id="form-login-btn">Log in</a>
                            </div>
                        </form>
                        <div id="form-login-loading" style="text-align:center; display:none">
                            <img src="{{asset('assets/images/bg/loading.gif')}}" style="width:300px">
                        </div>
                    </div>
                
                    <div class="tab-pane fade" id="tab_list_07" role="tabpanel">
                        <form class="account-form-box" id="form-register">
                            <h6 class="mb-3">Login your account</h6>
                            <b id="form-register-error" class="text-red"></b>
                            <div class="single-input">
                                <input type="text" name="name" placeholder="Name" required>
                            </div>
                            <div class="single-input">
                                <input type="text" name="email" placeholder="Email Address" required>
                            </div>
                            <div class="single-input">
                                <input type="password" name="password" placeholder="Password" required>
                            </div>
                            <div class="single-input">
                                <input type="password" name="password_confirmation" placeholder="Confirm password" required>
                            </div>
                            <p class="mt-15">
                                Your personal data will be used to support your experience throughout this website,
                                to manage access to your account, and for other purposes described in our
                                <a href="#" class="text-color-primary" target="_blank">Privacy Policy</a>.
                            </p>
                            <div class="button-box mt25">
                                <a href="#" class="btn brn--full btn--black" id="form-register-btn">Register</a>
                            </div>
                        </form>
                        <div id="form-login-loading" style="text-align:center; display:none">
                            <img src="{{asset('assets/images/bg/loading.gif')}}" style="width:300px">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>