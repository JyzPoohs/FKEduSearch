@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Edit User'])
    <div class="container-fluid py-4">
        <div class="row mt-4">
            <div class="col-lg-12 mb-lg-0 mb-4">
                @if (session()->has('success'))
                    <div id="alert">
                        @include('components.alert')
                    </div>
                @endif
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Edit User</h6>
                    </div>
                    <div class="card-body p-3">
                        <form role="form" method="POST" action={{ route('user.update', ['user' => $data['id']]) }}
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Name <span
                                                class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="name"
                                            value="{{ $data['name'] }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Email <span
                                                class="text-danger">*</span></label>
                                        <input class="form-control" type="email" name="email"
                                            value="{{ $data['email'] }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Academic Status <span
                                                class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="current_academic_status"
                                            value="{{ $data['current_academic_status'] }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Facebook
                                            {{-- <span class="text-danger">*</span> --}}
                                        </label>
                                        <input class="form-control" type="text" name="fb_acc"
                                            value="{{ $data['fb_acc'] }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Linkedin
                                            {{-- <span    class="text-danger">*</span> --}}
                                        </label>
                                        <input class="form-control" type="text" name="linkedin_acc"
                                            value="{{ $data['linkedin_acc'] }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Area of Research
                                            <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="area_of_research"
                                            value="{{ $data['area_of_research'] }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                {{-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Password <span
                                                class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="password"
                                            value="{{ $data['password'] }}">
                                    </div> --}}
                                {{-- </div> --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Role
                                            {{-- <span class="text-danger">*</span> --}}
                                        </label>
                                        <input class="form-control" type="text" name="ref_role_id"
                                            value="{{ $role->first()->value }}" disabled>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="text-end mt-2">
                        <a href="{{ route('user.index') }}" class="btn btn-secondary btn-md ms-auto">Back</a>
                        <button type="submit" class="btn btn-success btn-md ms-auto">Save</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth.footer')
    </div>
@endsection

@push('js')
    <script></script>
@endpush
