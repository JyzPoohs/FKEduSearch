@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Edit Publication'])
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
                        <h6>Edit Publication</h6>
                    </div>
                    <div class="card-body p-3">
                        <form role="form" method="POST" action={{ route('publication.update', ['publication' => $data['id']]) }}
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Title <span
                                                class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="title"
                                            value="{{ $data->title }}" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Description <span
                                                class="text-danger">*</span></label>
                                        <textarea class="form-control" cols="30" rows="5" name="description" required>{{ $data->description }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="text-end mt-2">
                                <a href="{{ route('publication.index') }}" class="btn btn-secondary btn-md ms-auto">Back</a>
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
