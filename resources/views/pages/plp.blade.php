@extends('layouts.app-public')
@section('title', 'Shop')
@section('content')

<div class="site-wrapper-reveal">
    
    {{-- Product Area --}}
    <div class="product-wrapper section-space--ptb_90 border-bottom pb-5 mb-5">
        <div class="container">

            {{-- Product filter by Vendor --}}
            <div class="row">
                <div class="col-lg-3 col-md-3 order-md-1 order-2 small-mt__40">
                    <div class="shop-widget widget-shop-publisher mt-3">
                        <div class="product-filter">
                            <h6 class="mb-20">Vendors</h6>
                            <select name="_vendor" id="vendor-filter" onchange="getData()" class="_filter form-select form-select-sm">
                                {{-- Integrate with API --}}
                                <option value="" selected>All</option>
                            </select>
                        </div>
                    </div>

                    {{-- Product filter by Price --}}
                    <div class="shop-widget">
                        <div class="product-filter widget-price">
                            <h6 class="mb-20">Price</h6>
                            <ul class="widget-nav-list" id="price-filter">
                                <li><a href="#">Under IDR 1.000.000</a></li>
                                <li><a href="#">IDR 1.000.000 - 5.000.000</a></li>
                                <li><a href="#">Above IDR 5.000.000</a></li>
                            </ul>
                        </div>
                    </div>

                    {{-- Product filter by Category --}}
                    <div class="shop-widget">
                        <div class="product-filter">
                            <h6 class="mb-20">Category</h6>
                            <div class="blog-tagcloud" id="category-filter">
                                    {{-- Integrate with API --}}
                            </div>
                        </div>
                    </div>

                </div>

                {{-- Product filter --}}
                <div class="col-lg-9 col-md-9 order-md-2 order-1">
                    <div class="row mb-5">
                        <div class="col-lg-6 col-md-8">
                            <div class="shop-toolbar__items shop-toolbar__item--left">
                                <div class="shop-toolbar__item shop-toolbar__item--result">
                                    <p class="result-count">
                                        Showing <span id="products_count_start"></span> - <span id="products_count_end"></span> of <span id="products_count_total"></span>
                                    </p>
                                </div>
                                <div class="shop-toolbar__item">
                                    <select name="_sort_by" id="product-filter" class="_filter form-select form-select-sm">
                                        {{-- Integrate with API! --}}
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-4">
                            <div class="header-right-search">
                                <div class="header-search-box">
                                    <input type="text" name="_search" class="_filter search-field" placeholder="Search by name or category" onkeypress="getDataOnEnter(event)">
                                    <button class="search-icon"><i class="icon-magnifier"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="row" id="product-list"></div>
                        <div class="row">
                            <div class="col-12">
                                <ul class="page-pagination text-center mt-40" id="product-list-pagination"></ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('adition_css')
@endsection
@section('addition_script')
    <script src="{{asset('pages/js/plp.js')}}"></script>
@endsection