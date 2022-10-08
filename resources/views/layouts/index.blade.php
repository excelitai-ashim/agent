@extends('layouts.back-end.app')
@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@section('title')
    Agent -Dashboard
@endsection
@section('content')
<div style="margin-left: 10px;">
    <div class="card-body">
        <div class="row flex-between gx-2 gx-lg-3 mb-2">
            <div>
                <h4><i style="font-size: 30px" class="tio-chart-bar-4"></i>Dashboard order statistics</h4>
            </div>
            <div class="col-12 col-md-4" style="width: 20vw">
                <select class="custom-select" name="statistics_type" onchange="order_stats_update(this.value)">
                    <option value="overall">
                        Overall statistics
                    </option>
                    <option value="today">
                        Todays Statistics
                    </option>
                    <option value="this_month">
                        This Months Statistics
                    </option>
                </select>
            </div>
        </div>
        <div class="row gx-2 gx-lg-3" id="order_stats">
            <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
<!-- Card -->
<a class="card card-hover-shadow h-100" href="http://127.0.0.1:8000/admin/orders/list/pending" style="background: #FFFFFF">
<div class="card-body">
<div class="flex-between align-items-center mb-1">
    <div style="text-align: left;">
        <h6 class="card-subtitle" style="color: #F14A16!important;">Pending</h6>
        <span class="card-title h2" style="color: #F14A16!important;">
            18
        </span>
    </div>
    <div class="mt-2">
        <i class="tio-shopping-cart" style="font-size: 30px;color: #F14A16;"></i>
    </div>
</div>
<!-- End Row -->
</div>
</a>
<!-- End Card -->
</div>

<div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
<!-- Card -->
<a class="card card-hover-shadow h-100" href="http://127.0.0.1:8000/admin/orders/list/confirmed" style="background: #FFFFFF;">
<div class="card-body">
<div class="flex-between align-items-center mb-1">
    <div style="text-align: left;">
        <h6 class="card-subtitle" style="color: #F14A16!important;">Confirmed</h6>
         <span class="card-title h2" style="color: #F14A16!important;">
             6
         </span>
    </div>

    <div class="mt-2">
        <i class="tio-checkmark-circle" style="font-size: 30px;color: #F14A16"></i>
    </div>
</div>
<!-- End Row -->
</div>
</a>
<!-- End Card -->
</div>

<div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
<!-- Card -->
<a class="card card-hover-shadow h-100" href="http://127.0.0.1:8000/admin/orders/list/processing" style="background: #FFFFFF">
<div class="card-body">
<div class="flex-between align-items-center gx-2 mb-1">
    <div style="text-align: left;">
        <h6 class="card-subtitle" style="color: #F14A16!important;">Processing</h6>
        <span class="card-title h2" style="color: #F14A16!important;">
            11
        </span>
    </div>

    <div class="mt-2">
        <i class="tio-time" style="font-size: 30px;color: #F14A16"></i>
    </div>
</div>
<!-- End Row -->
</div>
</a>
<!-- End Card -->
</div>

<div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
<!-- Card -->
<a class="card card-hover-shadow h-100" href="http://127.0.0.1:8000/admin/orders/list/out_for_delivery" style="background: #FFFFFFff">
<div class="card-body">
<div class="flex-between align-items-center gx-2 mb-1">
    <div style="text-align: left;">
        <h6 class="card-subtitle" style="color: #F14A16!important;">Out for delivery</h6>
        <span class="card-title h2" style="color: #F14A16!important;">
            4
        </span>
    </div>

    <div class="mt-2">
        <i class="tio-bike" style="font-size: 30px;color: #F14A16"></i>
    </div>
</div>
<!-- End Row -->
</div>
</a>
<!-- End Card -->
</div>

<div class="col-12">
<div class="card card-body" style="background: #FFFFFF!important;">
<div class="row gx-lg-4">
<div class="col-sm-6 col-lg-3">
    <div class="media flex-between align-items-center" style="cursor: pointer" onclick="location.href='http://127.0.0.1:8000/admin/orders/list/delivered'">
        <div class="media-body" style="text-align: left;">
            <h6 class="card-subtitle">Delivered</h6>
            <span class="card-title h3">8</span>
        </div>
        <div>
            <span class="icon icon-sm icon-soft-secondary icon-circle ml-3">
                <i class="tio-checkmark-circle-outlined"></i>
            </span>
        </div>
    </div>
    <div class="d-lg-none">
        <hr>
    </div>
</div>

<div class="col-sm-6 col-lg-3 column-divider-sm">
    <div class="media flex-between align-items-center" style="cursor: pointer" onclick="location.href='http://127.0.0.1:8000/admin/orders/list/canceled'">
        <div class="media-body" style="text-align: left;">
            <h6 class="card-subtitle">Canceled</h6>
            <span class="card-title h3">2</span>
        </div>
        <span class="icon icon-sm icon-soft-secondary icon-circle ml-3">
          <i class="tio-remove-from-trash"></i>
        </span>
    </div>
    <div class="d-lg-none">
        <hr>
    </div>
</div>

<div class="col-sm-6 col-lg-3 column-divider-lg">
    <div class="media flex-between align-items-center" style="cursor: pointer" onclick="location.href='http://127.0.0.1:8000/admin/orders/list/returned'">
        <div class="media-body" style="text-align: left;">
            <h6 class="card-subtitle">Returned</h6>
            <span class="card-title h3">2</span>
        </div>
        <span class="icon icon-sm icon-soft-secondary icon-circle ml-3">
          <i class="tio-history"></i>
        </span>
    </div>
    <div class="d-lg-none">
        <hr>
    </div>
</div>

<div class="col-sm-6 col-lg-3 column-divider-sm">
    <div class="media flex-between align-items-center" style="cursor: pointer" onclick="location.href='http://127.0.0.1:8000/admin/orders/list/failed'">
        <div class="media-body" style="text-align: left;">
            <h6 class="card-subtitle">Failed</h6>
            <span class="card-title h3">3</span>
        </div>
        <span class="icon icon-sm icon-soft-secondary icon-circle ml-3">
          <i class="tio-message-failed"></i>
        </span>
    </div>
    <div class="d-lg-none">
        <hr>
    </div>
</div>
</div>
</div>
</div>
        </div>
    </div>
</div>

@endsection
