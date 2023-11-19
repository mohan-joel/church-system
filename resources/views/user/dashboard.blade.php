@extends('user.layouts.app')
@section('content')
<div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Dashboard {{ Auth::user()->church_name }}
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                  </li>
                </ul>
              </nav>
            </div>
            <div class="row">
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                  <div class="card-body">
                    <img src="{{ asset('assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3 text-dark">Total Youths<i class="mdi mdi-church mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5 text-dark">{{ $totalYouth }}</h2>
                    <!-- <h6 class="card-text">Increased by 60%</h6> -->
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                  <div class="card-body">
                    <img src="{{ asset('assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3 text-dark">Total Fellowships<i class="mdi mdi-church mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5 text-dark">{{ $totalFellowship }}</h2>
                    <!-- <h6 class="card-text">Decreased by 10%</h6> -->
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                  <div class="card-body">
                    <img src="{{ asset('assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3 text-dark">Total Notices<i class="mdi mdi-church mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5 text-dark">{{ $totalNotice }}</h2>
                    <!-- <h6 class="card-text">Increased by 5%</h6> -->
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-primary card-img-holder text-white">
                  <div class="card-body">
                    <img src="{{ asset('assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3 text-dark">Total Incomes<i class="mdi mdi-church mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5 text-dark">{{ $totalIncome }}</h2>
                    <!-- <h6 class="card-text">Increased by 5%</h6> -->
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-secondary card-img-holder text-white">
                  <div class="card-body">
                    <img src="{{ asset('assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3 text-dark">Total Expenditure<i class="mdi mdi-church mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5 text-dark">{{ $totalExpenditure }}</h2>
                    <!-- <h6 class="card-text">Increased by 5%</h6> -->
                  </div>
                </div>
              </div>
            </div>
           

@endsection