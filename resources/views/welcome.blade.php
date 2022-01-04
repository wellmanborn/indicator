@extends('layouts.carbon')

@section("breadcrumb")
    <div class="breadcrumb-item">{{ __("Gateway Transactions") }}</div>
@endsection

@section('content')
    <div class="page-title">
        <h3>{{ __("Gateway Transactions") }}</h3>
        {{--<a class="btn btn-default" href="/my/account">
            <i class="fa fa-database"></i> {{ __("My Accounts") }}</a>--}}
    </div>
    <div class="row">
        <div class="col-md-12">
        </div>
    </div>
@endsection
