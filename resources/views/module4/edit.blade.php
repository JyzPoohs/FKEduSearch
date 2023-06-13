@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Edit Report'])
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
                        <h6>Edit Report</h6>
                    </div>
                    <div class="card-body p-3">
                        <form role="form" method="POST" action={{ route('report.update', ['report' => $data['id']]) }}
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Classification</label>
                                        <br>
                                        <div class="form-check mb-3 form-check-inline">
                                            <input class="form-check-input" type="radio" name="classification"
                                                id="customRadio1" value="1" disabled
                                                @if ($data->classification == 1) checked @endif>
                                            <label class="custom-control-label" for="customRadio1">Error</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="classification"
                                                id="customRadio2" value="2" disabled
                                                @if ($data->classification == 2) checked @endif>
                                            <label class="custom-control-label" for="customRadio2">Improvement</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Severity</label>
                                        <select class="form-select" name="severity" disabled>
                                            <option value="">Select option</option>
                                            <option @if ($data->severity == 1) selected @endif value="1">Minor
                                            </option>
                                            <option @if ($data->severity == 2) selected @endif value="2">
                                                Moderate</option>
                                            <option @if ($data->severity == 3) selected @endif value="3">Major
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Describe the
                                            issue*</label>
                                        <textarea disabled class="form-control" placeholder="The more information, the better." cols="30" rows="5"
                                            name="description">{{ $data->description }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Status*</label>
                                        <select class="form-select" name="status">
                                            <option value="">Select option</option>
                                            <option @if($data->status == 1) selected @endif value="1">On hold</option>
                                            <option @if($data->status == 2) selected @endif value="2">In investigation</option>
                                            <option @if($data->status == 3) selected @endif value="3">Resolved</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="text-end mt-2">
                                <a href="{{ route('report.index') }}" class="btn btn-secondary btn-md ms-auto">Back</a>
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
