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
                        <form action="{{ route('update.profile', $user->id) }}" class="checkout-form" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="pull-left text-center" href="#!">
                                <img id="avatar-img" class="media-object user-img"
                                    src="{{ asset('storage/avatar/' . Auth::user()->avatar) }}" alt="Image"
                                    style="margin-bottom: 20px">
                                <label for="avatar-input" class="btn btn-default btn-file">
                                    <i class="fa fa-camera"></i> Change Photo
                                </label>
                                <input id="avatar-input" name="avatar" type="file" class="form-control-file"
                                    style="display: none;" value="{{ $user->avatar }}">
                            </div>
                            <div class="media-body">
                                <ul class="user-profile-list">

                                    <li>
                                        <div class="form-group">
                                            <label for="name">Full Name : </label>
                                            <input type="text" name="name" class="form-control"
                                                value="{{ $user->name }}">
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-group">
                                            <label for="name">Email : </label>
                                            <input type="text" name="email" class="form-control"
                                                value="{{ $user->email }}" readonly>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-group">
                                            <label for="name">Username : </label>
                                            <input type="text" name="username" class="form-control"
                                                value="{{ $user->username }}" readonly>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-group">
                                            <label for="name">Phone : </label>
                                            <input type="text" name="phone" class="form-control"
                                                value="{{ $user->phone }}">
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-group">
                                            <label for="name">Address : </label>
                                            <input type="text" name="address" class="form-control"
                                                value="{{ $user->address }}">
                                        </div>
                                    </li>
                                    <button type="submit" class="btn btn-main">Edit</button>
                        </form>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
        </div>
    </section>
    <script>
        // get the input element and the image element
        const avatarInput = document.querySelector('#avatar-input');
        const avatarImg = document.querySelector('#avatar-img');

        // add event listener to the input element
        avatarInput.addEventListener('change', function() {
            // check if the file is selected
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // set the image source to the uploaded file
                    avatarImg.src = e.target.result;
                };
                reader.readAsDataURL(this.files[0]);
            }
        });
    </script>
@endsection
