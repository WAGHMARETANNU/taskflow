@extends('layouts.Guest')
@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <header class="hero">
                    <h1 class="text-center">Change User Profile</h1>
                </header>
                <div class="container">
                    <div class="row p">
                        <div class="col-lg-6 offset-lg-3 p-3" style="border: solid white; border-radius: 20px;">
                            <div class="row">
                                @php
                                    $edu = explode(',', $userdata->edu);
                                @endphp
                                <!-- Left Column: Profile Image & Edit Button -->
                                <form action="{{ URL::to('/') }}/userEditProfile" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="mb-3">
                                        <label class="form-label">Full Name</label>
                                        <input type="text" class="form-control @error('fname') is-invalid @enderror"
                                            placeholder="Enter your full name" name="fname"
                                            value="{{ $userdata->fname }}">
                                        @error('fname')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Gender</label>
                                        <select class="form-control @error('gender') is-invalid @enderror" name="gender">
                                            <option value="">Select Gender</option>
                                            <option value="male" @if ($userdata->gender == 'male') selected @endif>Male
                                            </option>
                                            <option value="female" @if ($userdata->gender == 'female') selected @endif>Female
                                            </option>
                                            <option value="other" @if ($userdata->gender == 'other') selected @endif>Other
                                            </option>
                                        </select>
                                        @error('gender')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label ">Mobile Number</label>
                                        <input type="tel" class="form-control @error('mobile') is-invalid @enderror"
                                            placeholder="Enter your mobile number" name="mobile"
                                            value="{{ $userdata->mobile }}">
                                        @error('mobile')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Educational Qualification</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="diploma"
                                                        name="edu[]" value="Diploma"
                                                        @if (in_array('Diploma', $edu)) checked @endif>
                                                    <label class="form-check-label " for="diploma">Diploma</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="postGraduate"
                                                        name="edu[]" value="Graduate"
                                                        @if (in_array('Graduate', $edu)) checked @endif>
                                                    <label class="form-check-label " for="postGraduate">Graduate</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="doctorate"
                                                        name="edu[]" value="Post Graduate"
                                                        @if (in_array('Post Graduate', $edu)) checked @endif>
                                                    <label class="form-check-label" for="doctorate">Post
                                                        Graduate</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="Doctorate"
                                                        name="edu[]" value="Doctorate"
                                                        @if (in_array('Doctorate', $edu)) checked @endif>
                                                    <label class="form-check-label" for="Doctorate">Doctorate</label>
                                                </div>
                                            </div>

                                        </div>
                                        @error('edu')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3 text-center">
                                        <button type="submit" class="btn btn-custom btn-lg text-center">Change
                                            Profile</button>
                                    </div>
                                </form>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
