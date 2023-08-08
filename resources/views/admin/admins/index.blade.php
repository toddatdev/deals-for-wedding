@extends('admin.layouts.app')

@section('title', 'Admin')

@push('customCSS')

@endpush

@section('content')


    <div class="main-panel">
        <div class="content">
            <div class="container-fluid">
                <h4 class="page-title">Admin Section</h4>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
{{--                            @include('flash-message')--}}
                            <div class="card-header">
                                <div class="card-title">Admin List <b>( {{count($adminDetails)}} )</b></div>
                                <a href="" style="float: right;margin-top: -20px;" class="btn btn-danger"
                                   title="add users"
                                   data-toggle="modal" data-target="#addNewAdminModal"
                                >Add New Admin</a>
                            </div>

                            @if (session()->has('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="userList">
                                        <thead>
                                        <tr>
                                            <th><strong>ID</strong></th>
                                            <th><strong>Admin Name</strong></th>
                                            <th><strong>Email</strong></th>
                                            <th><strong>Role</strong></th>
                                            <th><strong>Status</strong></th>
                                            <th><strong>Actions</strong></th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @if(!empty($adminDetails))
                                            @foreach($adminDetails as $key => $admin)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{ $admin->fname }} {{ $admin->lname }}</td>
                                                    <td>
                                                        <a class="text-dark" href="mailto:{{$admin->email}}">
                                                            {{$admin->email}}
                                                        </a>
                                                    </td>
                                                    <td class="font-weight-bold">Admin</td>
                                                    <td>
                                                    <span class="badge badge-{{ (($admin->status == 1) ? 'success' : 'danger') }}">
                                                        {{ (($admin->status == 1) ? 'Active' : 'Inactive') }}
                                                    </span>
                                                    </td>
                                                    <td width="28%">

                                                        <form action="{{ route('admin.delete-admin',$admin->id) }}"
                                                              method="POST">
                                                            @csrf
                                                            @method('DELETE')

                                                            <a href="{{route('admin.edit-user',$admin->id)}}"
                                                               data-toggle="modal" data-target="#update{{$admin->id}}Admin"
                                                               title="Edit">
                                                                <i class="la la-edit btn btn-success action-cons"
                                                                   aria-hidden="true"></i>
                                                            </a>

                                                            <a href="{{route('admin.delete-admin',$admin->id)}}"
                                                               onclick="return confirm('Are you sure you want to delete this?')"
                                                               title="Delete">
                                                                <i class="la la-trash-o  btn btn-danger action-cons"
                                                                   aria-hidden="true"></i>
                                                            </a>

                                                        </form>
                                                    </td>

                                                    <!-- Update Admin Modal -->
                                                    <div class="modal fade" id="update{{$admin->id}}Admin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                         aria-hidden="true">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <form action="{{route('admin.update-admin',$admin->id)}}" enctype="multipart/form-data" method="post">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Update {{$admin->fname}}  {{$admin->lname}} Admin Info</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col-md-6 mb-3">
                                                                                <label for="fname" class="form-label"><strong>First Name</strong></label>
                                                                                <input type="text" value="{{$admin->fname}}" class="form-control @error('fname') is-invalid @enderror"
                                                                                       id="fname" name="fname" placeholder="First Name">
                                                                                @error('fname')
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                                @enderror
                                                                            </div>

                                                                            <div class="col-md-6 mb-3">
                                                                                <label for="lname" class="form-label"><strong>Last Name</strong></label>
                                                                                <input type="text" value="{{$admin->lname}}" class="form-control @error('lname') is-invalid @enderror"
                                                                                       id="lname" name="lname" placeholder="Last Name">
                                                                            </div>

                                                                            @error('lname')
                                                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                                            @enderror


                                                                            <div class="col-md-6 mb-3">
                                                                                <label for="email" class="form-label"><strong>Email Address</strong></label>
                                                                                <input type="email" value="{{$admin->email}}" class="form-control @error('email') is-invalid @enderror"
                                                                                       id="email" name="email" placeholder="Email Address">
                                                                                @error('email')
                                                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                                                @enderror
                                                                            </div>

                                                                            <div class="col-md-6 mb-3">
                                                                                <label for="password" class="form-label"><strong>Password</strong></label>
                                                                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                                                                       id="password" name="password" placeholder="Password..">
                                                                            </div>

                                                                            <div class="col-md-6 mb-3">
                                                                                <label for="role" class="form-label"><strong>Role</strong></label>
                                                                                <select class="form-control @error('role') is-invalid @enderror" id="role"
                                                                                        name="role">
                                                                                    <option value="1">Admin</option>
                                                                                </select>
                                                                                @error('role')
                                                                                <span class="invalid-feedback" role="alert">
                                                                                        <strong>{{ $message }}</strong>
                                                                                    </span>
                                                                                @enderror
                                                                            </div>

                                                                            <div class="col-md-6 mb-3">
                                                                                <label for="status" class="form-label"><strong>Status</strong></label>
                                                                                <select class="form-control @error('status') is-invalid @enderror" id="status"
                                                                                        name="status">
                                                                                    <option {{old('status',$admin->status)==0? 'selected':''}} value="0">Inactive</option>
                                                                                    <option {{old('status',$admin->status)==1? 'selected':''}} value="1">Active</option>
                                                                                </select>
                                                                                @error('status')
                                                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                                                @enderror
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit" class="btn btn-success">Update Admin</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add New Admin Modal -->
        <div class="modal fade" id="addNewAdminModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <form action="{{route('admin.adminRegisterPost')}}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Create New Admin</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="fname" class="form-label"><strong>First Name</strong></label>
                                    <input type="text" class="form-control @error('fname') is-invalid @enderror"
                                           id="fname" name="fname" placeholder="First Name">
                                    @error('fname')
                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}
                                                    </strong>
                                                </span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="lname" class="form-label"><strong>Last Name</strong></label>
                                    <input type="text" class="form-control @error('lname') is-invalid @enderror"
                                           id="lname" name="lname" placeholder="Last Name">
                                    @error('lname')
                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}
                                                    </strong>
                                                </span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label"><strong>Email Address</strong></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                           id="email" name="email" placeholder="Email Address">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}
                                                    </strong>
                                                </span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label"><strong>Password</strong></label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                           id="password" name="password" placeholder="Password..">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}
                                                    </strong>
                                                </span>
                                    @enderror
                                </div>

{{--                                <div class="col-md-6 mb-3">--}}
{{--                                    <label for="password_confirmation" class="form-label"><strong>Confirm--}}
{{--                                            Password</strong></label>--}}
{{--                                    <input type="password"--}}
{{--                                           class="form-control @error('password_confirmation') is-invalid @enderror"--}}
{{--                                           id="password_confirmation" name="password_confirmation"--}}
{{--                                           placeholder="Password..">--}}
{{--                                </div>--}}


                                <div class="col-md-6 mb-3">
                                    <label for="role" class="form-label"><strong>Role</strong></label>
                                    <select class="form-control @error('role') is-invalid @enderror" id="role"
                                            name="role">
                                        <option value="1">Admin</option>
                                    </select>
                                    @error('role')
                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="status" class="form-label"><strong>Status</strong></label>
                                    <select class="form-control @error('status') is-invalid @enderror" id="status"
                                            name="status">
                                        <option value="0">Inactive</option>
                                        <option value="1">Active</option>
                                    </select>
                                    @error('status')
                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                    @enderror
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Create Admin</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>

@endsection

@push('customJs')
    <script type="text/javascript">
        @if (count($errors) > 0)
        $('#addNewAdminModal').modal('show');
        @endif
    </script>
@endpush