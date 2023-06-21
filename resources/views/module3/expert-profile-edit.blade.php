@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Your Profile'])
    <div class="card shadow-lg mx-4 card-profile-bottom">
        <div class="card-body p-3">
            <div class="row gx-4">
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                        <div>
                            <label for="file-input"
                                class="btn btn-sm btn-icon-only bg-gradient-light position-absolute bottom-0 end-0 mb-n2 me-n2">
                                <i class="fa fa-pen top-0" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                    aria-hidden="true" data-bs-original-title="Edit Image" aria-label="Edit Image"></i>
                                <span class="sr-only">Edit Image</span>
                            </label>
                            <span class="h-12 w-12 rounded-full overflow-hidden bg-gray-100">
                                @php
                                    $default = 'https://argon-dashboard-pro-laravel.creative-tim.com/avatars/team-1.jpg';
                                    $img = auth()->user()->avatar != null ? env('APP_URL') . '/uploads/' . auth()->user()->avatar : $default;
                                @endphp
                                <img src="{{ $img }}" alt="avatar" class="w-100 border-radius-lg shadow-sm"
                                    id="avatar">
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            {{ auth()->user()->name }} @if (auth()->user()->is_approved == 1)
                                <i class="fa fa-check-circle fa-sm" aria-hidden="true"></i>
                            @endif
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            {{ ucfirst(auth()->user()->role->value) }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (session()->has('success'))
        <div id="alert">
            @include('components.alert')
        </div>
    @endif
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <form role="form" method="POST" action={{ route('user.profile-update') }}
                        enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="avatar_upload" id="file-input" accept="image/*" class="d-none">
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center">
                                <p class="mb-0">Edit Profile</p>
                                <button type="submit" class="btn btn-primary btn-sm ms-auto">Save</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="text-uppercase text-sm">User Information</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Name</label>
                                        <input class="form-control" type="text" name="name"
                                            value="{{ old('name', auth()->user()->name) }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Email address</label>
                                        <input class="form-control" type="email" name="email"
                                            value="{{ old('email', auth()->user()->email) }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <hr class="horizontal dark">
                            <p class="text-uppercase text-sm">Academic Information</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Current Academic
                                            Status</label>
                                        <input class="form-control" type="text" name="current_academic_status"
                                            value="{{ old('current_academic_status', auth()->user()->current_academic_status) }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Field Category</label>
                                        <select class="form-select" name="expert[ref_category_id]">
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                <option @if (auth()->user()->expert->ref_category_id == $category->id) selected @endif
                                                    value="{{ $category->id }}">{{ $category->value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">CV Upload</label>
                                        <input class="form-control" type="file" name="cv">
                                    </div>
                                </div>
                                @if (auth()->user()->expert->cv_upload)
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Uploaded CV</label>
                                            <br>
                                            <a
                                                href="{{ route('upload.download-file', ['filename' => auth()->user()->expert->cv_upload]) }}"><i
                                                    class="fa fa-download me-2 mt-2" aria-hidden="true"></i>
                                                {{ auth()->user()->expert->cv_upload ?? '-' }}
                                            </a>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Area Of Research</label>
                                        <textarea class="form-control" name="area_of_research">{{ old('area_of_research', auth()->user()->area_of_research) }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <hr class="horizontal dark">
                            <p class="text-uppercase text-sm">Social Media</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Facebook</label>
                                        <input class="form-control" type="url" name="fb_acc"
                                            value="{{ old('fb_acc', auth()->user()->fb_acc) }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">LinkedIn</label>
                                        <input class="form-control" type="url" name="linkedin_acc"
                                            value="{{ old('linkedin_acc', auth()->user()->linkedin_acc) }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Post Answered</p>
                                    <h5 class="font-weight-bolder">
                                        {{ auth()->user()->expert->answeredPosts->count() }}
                                    </h5>
                                    <p class="mb-0">
                                        @if (auth()->user()->expert->answeredPosts->count() > 0)
                                            Last post answered on
                                            <span
                                                class="text-primary text-sm font-weight-bolder">{{ auth()->user()->expert->answeredPosts->last()->created_at }}.</span>
                                        @else
                                            No answered post yet.
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                    <i class="ni ni-single-copy-04 text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Publication</p>
                                    <h5 class="font-weight-bolder">
                                        {{ auth()->user()->expert->publications->count() }}
                                    </h5>
                                    <p class="mb-0">
                                        @if (auth()->user()->expert->publications->count() > 0)
                                            Last publication added on
                                            <span
                                                class="text-primary text-sm font-weight-bolder">{{ auth()->user()->expert->publications->last()->created_at }}.</span>
                                        @else
                                            No publication added yet.
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                    <i class="ni ni-book-bookmark text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
@push('js')
    <script>
        var readURL = function(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#avatar').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#file-input").on('change', function() {
            readURL(this);
        });
    </script>
@endpush
