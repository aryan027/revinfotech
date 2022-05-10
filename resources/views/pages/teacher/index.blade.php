@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header bg-primary text-white">{{ __('Dashboard') }} <span class="float-end"><a href="{{ route('teacher.create') }}" class="btn btn-primary">Create</a></span></div>

                    <div class="card-body">
                       <table class=" table table-hover">
                           <thead>
                                <tr>
                                    <th>S. no</th>
                                    <th>profile</th>
                                    <th> First Name</th>
                                    <th>Last Name</th>
                                    <th>Gender</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Action</th>
                                </tr>
                           </thead>
                           <tbody>
                            @if(count($teachers)>0)
                                @forelse($teachers as $key=>$teacher)
                                    <tr>
                                        <th>{{ $key+1 }}</th>
                                        <th> <img src="{{ asset('/uploads/teacher/'.$teacher->profile_image)  }}" height="50px" width="50px"> </th>
                                        <th> {{ $teacher->first_name  }}</th>
                                        <th>{{ $teacher->last_name  }}</th>
                                        <th> {{ $teacher->gender  }} </th>
                                        <th>{{ $teacher->email }}</th>
                                        <th> {{ $teacher->mobile }}</th>
                                        <th><a class="btn btn-primary" href="{{ route('teacher.edit',\Illuminate\Support\Facades\Crypt::encrypt($teacher->id)) }}"> edit</a>

                                            <a class="text-white btn btn-danger "  onclick="event.preventDefault();
                                                     document.getElementById('logout-form{{$key}}').submit();">
                                                {{ __('delete') }}
                                            </a>

                                            <form id="logout-form{{$key}}" action="{{ route('teacher.destroy',\Illuminate\Support\Facades\Crypt::encrypt($teacher->id)) }}" method="post"  class="d-none">
                                                @csrf {{ method_field('DELETE') }}
                                            </form>

                                            <a class="btn btn-primary" href="{{ route('teacher.show',\Illuminate\Support\Facades\Crypt::encrypt($teacher->id)) }}"> student</a>
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
                            {!! $teachers->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
