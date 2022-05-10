@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <form action="{{ route('teacher.update',\Illuminate\Support\Facades\Crypt::encrypt($teacher->id)) }}" method="post" enctype="multipart/form-data"> {{ method_field('PUT') }} @csrf
                        <div class="card-header bg-primary text-white">{{ __('Update Teacher') }}</div>

                        <div class="card-body">

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="first_name" class="form-label">First Name</label>
                                        <input type="text" name="first_name" value="{{ old('first_name',$teacher->first_name) }}" required class="form-control @error('first_name') is-invalid @enderror " id="first_name" placeholder="Enter first name">
                                        @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="last_name" class="form-label">Last Name</label>
                                        <input class="form-control @error('last_name') is-invalid @enderror " value="{{ old('last_name', $teacher->last_name ) }}" required name="last_name" id="last_name" placeholder="Enter last name">
                                        @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" required name="email" value="{{ old('email', $teacher->email ) }}" class="form-control @error('email') is-invalid @enderror " id="email" placeholder="Enter email">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="mobile" class="form-label">Mobile Number</label>
                                        <input type="text" value="{{ old('mobile', $teacher->mobile ) }}" onkeypress="return isNumber(event)" required maxlength="10" name="mobile" id="mobile" class="form-control @error('mobile') is-invalid @enderror"  placeholder="Enter mobile number">
                                        @error('mobile')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Gender</label> <br/>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input"  required type="radio" name="gender" id="male" value="male" {{ ($teacher->gender=="male")? "checked" : "" }}>
                                            <label class="form-check-label" for="male">Male</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" required type="radio" name="gender" id="female" value="female" {{ ($teacher->gender=="female")? "checked" : "" }} >
                                            <label class="form-check-label" for="female">Female</label>
                                        </div>
                                        @error('gender')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="mobile" class="form-label">Profile Image</label>
                                        <input type="file"   accept="image/*" class="form-control @error('profile_image') is-invalid @enderror " name="profile_image" id="profile_image" >
                                        @error('profile_image')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <input type="submit" class="btn btn-primary" value="Save">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
