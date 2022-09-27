    @extends('layouts.employee')

    @section('content')

        @include('layouts.partials.sidebar')

        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button class="close" type="button" data-dismiss="alert">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 grid-margin stretch-card">
                                        <div class="card">
                                            <div class="card-body">
                                                <p class="card-title">Create product</p>
                                                <p class="card-description">
                                                    Complete the following form!
                                                </p>
                                                <form class="forms-sample" action="{{ route('employeeData.update', $user->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('put')
                                                    <div class="form-group">
                                                        <label for="name_product">Name</label>
                                                        <input type="text" class="form-control" name="name"
                                                            id="name" placeholder="Input Name"
                                                            value="{{ $user->name }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="name_product">Email</label>
                                                        <input type="text" class="form-control" name="email"
                                                            id="email" placeholder="Input Email"
                                                            value="{{ $user->email }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="name_product">Password</label>
                                                        <input type="text" class="form-control" name="password"
                                                            id="password" placeholder="Password"
                                                            value="{{ old('password') }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="name_product">Confirm Password</label>
                                                        <input type="text" class="form-control" name="confirm-password"
                                                            id="password_confirmation"
                                                            placeholder="Password Confirmation"
                                                            value="{{ old('password_confirmation') }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="category">Select Role</label>
                                                        {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple')) !!}
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                                        <a href="{{ route('employeeData.index') }}"
                                                            class="btn btn-light">Cancel</a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->

        @endsection
