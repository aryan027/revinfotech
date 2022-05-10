@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header ">{{ __('Student List') }} <span class="float-end"><a href="{{ route('student.create') }}" class="btn btn-primary">Create</a></span></div>

                    <div class="card-body">
                        <table class=" table table-hover">
                            <thead>
                            <tr>
                                <th>S. no</th>
                                <th>profile</th>
                                <th> First Name</th>
                                <th>Last Name</th>
                                <th>Teacher</th>
                                <th>Gender</th>
                                <th>Email</th>
                                <th>Date of Birth</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($students)>0)
                                @forelse($students as $key=>$student)
                                    <tr>
                                        <th>{{ $key+1 }}</th>
                                        <th> <img src="{{ asset('/uploads/student/'.$student->profile_image)  }}" height="50px" width="50px"> </th>
                                        <th> {{ $student->first_name  }}</th>
                                        <th>{{ $student->last_name  }}</th>
                                        <th>{{ $student->teacher->first_name.' '. $student->teacher->last_name }}</th>
                                        <th> {{ $student->gender  }} </th>
                                        <th>{{ $student->email }}</th>
                                        <th> {{ $student->dob }}</th>
                                        <th><a class="btn btn-primary" href="{{ route('student.edit',\Illuminate\Support\Facades\Crypt::encrypt($student->id)) }}"> edit</a>

                                            <a class="text-white btn btn-danger "  onclick="event.preventDefault();
                                                document.getElementById('logout-form{{$key}}').submit();">
                                                {{ __('delete') }}
                                            </a>

                                            <form id="logout-form{{$key}}" action="{{ route('student.destroy',\Illuminate\Support\Facades\Crypt::encrypt($student->id)) }}" method="post"  class="d-none">
                                                @csrf {{ method_field('DELETE') }}
                                            </form>
                                        </th>
                                        <th>

                                        </th>

                                    </tr>
                                @empty
                                    <tr >
                                        <td colspan="7" class="text-danger text-center"> No record Found ...</td>
                                    </tr>
                                @endforelse
                            @endif
                            </tbody>
                        </table>
                        <div class="d-flex">
                            {!! $students->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
