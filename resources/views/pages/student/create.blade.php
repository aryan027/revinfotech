@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <form action="{{ route('student.store') }}" method="post" enctype="multipart/form-data"> @csrf
                        <div class="card-header bg-primary text-white">{{ __('Create Student') }}</div>

                        <div class="card-body">

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="teacher" class="form-label"> Teacher</label>
                                            <select class="form-select @error('teacher_id') is-invalid @enderror" required name="teacher_id">
                                                <option value="">select teacher</option>

                                                    @forelse($teachers as $key => $teacher)
                                                        <option value="{{ $teacher->id }}">{{ $teacher->first_name .' '. $teacher->last_name }}</option>
                                                 @empty
                                                @endforelse

                                            </select>
                                        @error('teacher_id')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="first_name" class="form-label">First Name</label>
                                        <input type="text" name="first_name" required class="form-control @error('first_name') is-invalid @enderror " id="first_name" placeholder="Enter first name">
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
                                        <input class="form-control @error('last_name') is-invalid @enderror " required name="last_name" id="last_name" placeholder="Enter last name">
                                        @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" required name="email" class="form-control @error('email') is-invalid @enderror " id="email" placeholder="Enter email">
                                        @error('email')
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
                                        <label for="dob" class="form-label">Date of birth</label>
                                        <input type="date" required  name="dob" id="dob" class="form-control @error('dob') is-invalid @enderror"  placeholder="Enter date of birth number">
                                        @error('dob')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Gender</label> <br/>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" required type="radio" name="gender" id="male" value="male">
                                            <label class="form-check-label" for="male">Male</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" required type="radio" name="gender" id="female" value="female">
                                            <label class="form-check-label" for="female">Female</label>
                                        </div>
                                        @error('gender')
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
                                        <label for="mobile" class="form-label">Profile Image</label>
                                        <input type="file" required accept="image/*" class="form-control @error('profile_image') is-invalid @enderror " name="profile_image" id="profile_image" >
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
