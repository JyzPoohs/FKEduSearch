@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @if (auth()->user()->ref_role_id === 8)
        @include('layouts.navbars.auth.topnav', ['title' => 'View Complaint'])
    @elseif (auth()->user()->ref_role_id === 10)
        @include('layouts.navbars.auth.topnav', ['title' => 'Edit Complaint'])
    @endif
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
                        <form role="form" method="POST"
                            action={{ route('complaint.update', ['complaint' => $data['id']]) }}
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name" class="form-control-label">User Name <span
                                                class="text-danger">*</span></label>
                                        <input class="form-control" type="text" disabled value="{{ $data->user->name }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name" class="form-control-label">Expert Name <span
                                                class="text-danger">*</span></label>
                                        <input class="form-control" type="text" disabled
                                            value="{{ $data->post->expert->name }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="description" class="form-control-label">Complaint Description
                                            <span class="text-danger">*</span></label>
                                        <textarea disabled class="form-control" name="description" id="" rows="2">{{ $data->description }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="feedback" class="form-control-label">Feedback Description
                                            <span class="text-danger">*</span></label>
                                        <textarea disabled class="form-control" id="" rows="2">{{ $data->post->description }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="type" class="form-control-label">Complaint Type <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select" name="ref_complaint_type_id"
                                            @if (auth()->user()->ref_role_id === 8) disabled @endif>
                                            <option disabled selected>Select Complaint Type</option>
                                            <option value="11" @if ($data->type->value == 'Unsatisfied Expert Feedback') selected @endif>
                                                Unsatisfied Expert's
                                                Feedback</option>
                                            <option value="12" @if ($data->type->value == 'Wrongly Assigned Research Area') selected @endif>Wrongly
                                                Assigned Research
                                                Area</option>
                                            <option value="13" @if ($data->type->value == 'Inapproriate Feedback') selected @endif>
                                                Inapproriate Feedback
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status" class="form-control-label">Complaint Status <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select" name="ref_complaint_status_id"
                                            @if (auth()->user()->ref_role_id === 8) disabled @endif>
                                            <option disabled selected>Select Complaint Status</option>
                                            <option value="14" @if ($data->status->value == 'In Investigation') selected @endif>In
                                                Investigation</option>
                                            <option value="15" @if ($data->status->value == 'On Hold') selected @endif>On
                                                Hold</option>
                                            <option value="16" @if ($data->status->value == 'Resolved') selected @endif>
                                                Resolved</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Date <span
                                                class="text-danger">*</span></label>
                                        <input disabled class="form-control" type="text"
                                            value="{{ $data['created_at']->format('Y/m/d') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Time <span
                                                class="text-danger">*</span></label>
                                        <input disabled class="form-control" type="text"
                                            value="{{ $data['created_at']->format('h:i:s A') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="text-end mt-2">
                                @if (auth()->user()->ref_role_id === 10)
                                    <button class="btn btn-success btn-md ms-auto">Save</button>
                                @endif
                                <a href="{{ route('complaint.index') }}" class="btn btn-secondary btn-md ms-auto">Back</a>
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
