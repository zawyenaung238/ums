@extends('layouts.master')
@section('content')
    <div class="page-wrapper" style="min-height: 706px;">
        <div class="content container-fluid">
            <div class="page-header mt-5">
                <div class="row">
                    <div class="col">
                        <h3 class="page-title">Profile</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="profile-header">
                        <div class="row align-items-center">
                            <div class="col-auto profile-image">
                                <a href="#"> <img class="" alt="User Image"
                                        src="{{ asset('assets/img/placeholder.jpg') }}"> </a>
                            </div>
                            <div class="col ml-md-n2 profile-user-info">
                                <h4 class="user-name mb-3">{{ auth()->user()->name }}</h4>
                                <h6 class="text-muted mt-1">{{ auth()->user()->role->name }}</h6>
                                <div class="user-Location mt-1"><i class="fas fa-map-marker-alt"></i> {{ auth()->user()->address }}
                                </div>
                            </div>
                            <div class="col-auto profile-btn"> <a href="" class="btn btn-primary">
                                    Message
                                </a> <a href="edit-profile.html" class="btn btn-primary">
                                    Edit
                                </a> </div>
                        </div>
                    </div>
                    <div class="profile-menu">
                        <ul class="nav nav-tabs nav-tabs-solid">
                            <li class="nav-item"> <a class="nav-link active" data-toggle="tab"
                                    href="#per_details_tab">About</a> </li>
                        </ul>
                    </div>
                    <div class="tab-content profile-tab-cont">
                        <div class="tab-pane fade show active" id="per_details_tab">
                            <div class="row">
                                <div class="col-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title d-flex justify-content-between">
                                                <span>Personal Details</span>
                                                <a class="edit-link" data-toggle="modal" href="#edit_personal_details"><i
                                                        class="fa fa-edit mr-1"></i>Edit</a>
                                            </h5>
                                            <div class="row mt-5">
                                                <p class="col-sm-3 text-sm-right mb-0 mb-sm-3">Name</p>
                                                <p class="col-sm-9">{{ auth()->user()->name }}</p>
                                            </div>
                                            <div class="row">
                                                <p class="col-sm-3 text-sm-right mb-0 mb-sm-3">Date of Birth</p>
                                                <p class="col-sm-9">24 Jul 1983</p>
                                            </div>
                                            <div class="row">
                                                <p class="col-sm-3 text-sm-right mb-0 mb-sm-3">Email ID </p>
                                                <p class="col-sm-9">{{ auth()->user()->email }}
                                                </p>
                                            </div>
                                            <div class="row">
                                                <p class="col-sm-3 text-sm-right mb-0 mb-sm-3">Mobile</p>
                                                <p class="col-sm-9">{{ auth()->user()->phone }}</p>
                                            </div>
                                            <div class="row">
                                                <p class="col-sm-3 text-sm-right mb-0">Address</p>
                                                <p class="col-sm-9 mb-0">{{ auth()->user()->address }}
                                                </p>
                                            </div>
                                        </div>
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
