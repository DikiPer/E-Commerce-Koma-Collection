@extends('layouts.app')
@section('content')
    <section class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="content">
                        <h1 class="page-name">Profile</h1>
                        <ol class="breadcrumb">
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li class="active">Profile account</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="user-dashboard page-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12" style="margin-top: -50px">
                    <div class="dashboard-wrapper dashboard-user-profile">
                        <div class="media">
                            <div class="pull-left text-center" href="#!">
                                <img class="media-object user-img"
                                    src="{{ asset('storage/avatar/' . Auth::user()->avatar) }}" alt="Image">

                            </div>
                            <div class="media-body">
                                <ul class="user-profile-list">

                                    <li><span>Full Name:</span>{{ $user->name }}</li>
                                    <li><span>Username:</span>{{ $user->username }}</li>
                                    <li><span>Email:</span>{{ $user->email }}</li>
                                    <li><span>Phone:</span>{{ $user->phone }}</li>
                                    <li><span>Address:</span>{{ $user->address }}</li>

                                </ul>
                            </div>
                            <a href="{{ url('/edit_user', $user->id) }}" class="btn btn-main mt-20">Edit Profile</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
