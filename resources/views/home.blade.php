@extends('layouts.app')
@section('css')
@endsection
@section('content')
 <?php
      $hour = date('H');
      $dayTerm = ($hour >= 6 && $hour <= 11) ? "Good Morning" : (($hour > 11 && $hour <= 16) ? "Good Afternoon" : (($hour > 16 && $hour <= 23) ? "Good Evening" : "Hello" ) );
    ?>
  <div class="row mb-1">
      <div class="col-lg-6 col-md-6 d-none d-md-block">
          <h4>{{ $dayTerm }}, {{ Auth::user()->name }}</h4>
      </div>
      <div class="col-lg-6 col-md-6">
      </div>
  </div>

  <div class="row">
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <div class="card">
        <div class="card-statistic-4">
          <div class="align-items-center justify-content-between">
            <div class="row ">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                <div class="card-content">
                  <h5 class="font-15">Total Users</h5>
                  <h2 class="mb-3 font-18">12</h2>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                <div class="banner-img">
                  <img src="{{ asset('public/assets/img/banner/3.png') }}" alt="">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <div class="card">
        <div class="card-statistic-4">
          <div class="align-items-center justify-content-between">
            <div class="row ">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                <div class="card-content">
                  <h5 class="font-15"> Total Shops</h5>
                  <h2 class="mb-3 font-18">12</h2>
                  <a href="{{ url('/holiday-list') }}" class="mb-0"><span class="col-green">View Shops</span></a>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                <div class="banner-img">
                  <img src="{{ asset('public/assets/img/banner/2.png') }}" alt="">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('script')
@endsection