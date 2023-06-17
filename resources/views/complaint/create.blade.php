@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'File Complaint'])
    <div class="container-fluid py-4">
        <div class="row mt-4">
            <div class="col-lg-12 mb-lg-0 mb-4">
                @if (session()->has('success'))
                    <div id="alert">
                        @include('components.alert')
                    </div>
                @endif
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between mb-3">
                        <h6>File Complaint</h6>
                        <a href="{{ route('post.index') }}" class="btn btn-primary col-sm-1">Back</a>
                    </div>
                    <div class="card-body p-3">
                        <form role="form" method="POST" action={{ route('complaint.store') }}
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Expert Name <span
                                                class="text-danger">*</span></label>
                                        <input class="form-control" type="text" disabled
                                            value="{{ $post->expert->name }}">
                                        <input type="text" hidden name="post_id" value="{{ $post->id }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="type" class="form-control-label">Complaint Type <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select" name="ref_complaint_type_id">
                                            <option disabled selected>Select Complaint Type</option>
                                            <option value="10"
                                                {{ old('ref_complaint_type_id') === '10' ? 'selected' : '' }}>Unsatisfied
                                                Expert's Feedback</option>
                                            <option value="11"
                                                {{ old('ref_complaint_type_id') === '11' ? 'selected' : '' }}>Wrongly
                                                Assigned Research Area</option>
                                            <option value="12"
                                                {{ old('ref_complaint_type_id') === '12' ? 'selected' : '' }}>Inappropriate
                                                Feedback</option>
                                        </select>
                                        @error('ref_complaint_type_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Feedback Description<span
                                                class="text-danger">*</span></label>
                                        <textarea disabled class="form-control" rows="2">{{ $post->answer }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="example-text-input" class="form-control-label">Complaint Description
                                        <span class="text-danger">*</span></label>
                                    <label class=" text-muted text-end" id="charCount">0 / 255 words</label>
                                    <textarea class="form-control" name="description" rows="2" maxlength="255">{{ old('description') }}</textarea>
                                </div>
                                <div class="text-end mt-2">
                                    <button class="btn btn-success btn-md ms-auto w-10"
                                        onclick="return confirm('Confirm to submit complaint?')">Submit</button>
                                    <a href="{{ route('post.index') }}" class="btn btn-secondary btn-md ms-auto">Back</a>
                                    <button class="btn btn-danger btn-md ms-auto" type="reset">Clear</button>
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
    <script>
        $(document).ready(function() {
            $('textarea[name="description"]').on('input', function() {
                var count = $(this).val().length;
                $('#charCount').text(count + ' / 255 characters');
            });
        });
    </script>
@endpush
