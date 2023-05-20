@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Edit Complaint'])
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
                        <h6>Edit Complaint</h6>
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
                                            value="{{-- {{ $data['name'] }}--}}"> 
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Complaint Type <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select" name="ref_complaint_type__id">
                                            <option>Select Type</option>
                                            <option value="">Unsatisfied Expert's Feedback</option>
                                            {{-- @foreach ($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->value }}</option>
                                            @endforeach --}}
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Complaint Description <span
                                                class="text-danger">*</span></label>
                                        <input class="form-control" type="email" name="email"
                                            value="{{--{{ $data['email'] }}--}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Complaint Status <span
                                                class="text-danger">*</span></label>
                                                <select class="form-select" name="ref_complaint_type__id">
                                                    <option>Select Status</option>
                                                    <option value="">In Investigation</option>
                                                    {{-- @foreach ($roles as $role)
                                                        <option value="{{ $role->id }}">{{ $role->value }}</option>
                                                    @endforeach --}}
                                                </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Date <span
                                                class="text-danger">*</span></label>
                                        <input class="form-control" type="email" name="email"
                                            value="{{--{{ $data['email'] }}--}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Time <span
                                                class="text-danger">*</span></label>
                                        <input class="form-control" type="email" name="email"
                                            value="{{--{{ $data['email'] }}--}}">
                                    </div>
                                </div>
                            </div>
                            <div class="text-end mt-2">
                                <button onclick="history.back()" class="btn btn-secondary btn-md ms-auto">Back</button>
                                <button class="btn btn-success btn-md ms-auto">Save</button>
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
