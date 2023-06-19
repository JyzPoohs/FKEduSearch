@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'View Profile'])
    <div class="card shadow-lg mx-4 card-profile-bottom">
        <div class="card-body p-3">
            <div class="row gx-4">
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                        <div>
                            <span class="h-12 w-12 rounded-full overflow-hidden bg-gray-100">
                                @php
                                    $default = 'https://argon-dashboard-pro-laravel.creative-tim.com/avatars/team-1.jpg';
                                    $img = $user->avatar != null ? env('APP_URL') . '/uploads/' . $user->avatar : $default;
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
                            {{ $user->name }} @if ($user->is_approved == 1)
                                <i class="fa fa-check-circle fa-sm" aria-hidden="true"></i>
                            @endif
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            {{ ucfirst($user->role->value) }}
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
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">View Expert Profile</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="text-uppercase text-sm">User Information</p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Name</label>
                                    <br>
                                    <span class="text-bold text-sm ms-1">{{ $user->name ?? '-' }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Email Address</label>
                                    <br>
                                    <span class="text-bold text-sm ms-1">{{ $user->email ?? '-' }}</span>
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
                                    <br>
                                    <span class="text-bold text-sm ms-1">{{ $user->current_academic_status ?? '-' }}</span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Area Of Research</label>
                                    <br>
                                    <span class="text-bold text-sm ms-1">{{ $user->area_of_research ?? '-' }}</span>
                                </div>
                            </div>
                        </div>
                        <hr class="horizontal dark">
                        <p class="text-uppercase text-sm">Social Media</p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Facebook</label>
                                    <br>
                                    <span class="text-bold text-sm ms-1">{{ $user->fb_acc ?? '-' }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">LinkedIn</label>
                                    <br>
                                    <span class="text-bold text-sm ms-1">{{ $user->linkedin_acc ?? '-' }}</span>
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
                                        {{ $user->expert->answeredPosts->count() }}
                                    </h5>
                                    <p class="mb-0">
                                        @if ($user->expert->answeredPosts->count() > 0)
                                            Last post answered on
                                            <span
                                                class="text-primary text-sm font-weight-bolder">{{ $user->expert->answeredPosts->last()->created_at }}.</span>
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
                                        {{ $user->expert->publications->count() }}
                                    </h5>
                                    <p class="mb-0">
                                        @if ($user->expert->publications->count() > 0)
                                            Last publication added on
                                            <span
                                                class="text-primary text-sm font-weight-bolder">{{ $user->expert->publications->last()->created_at }}.</span>
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
            <div class="col-md-8 mt-3">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">Publications</p>
                        </div>
                    </div>
                    <div class="card-body">
                        @foreach ($user->expert->publications as $publication)
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Title</label>
                                        <br>
                                        <span class="text-bold text-sm ms-1">{{ $publication->title ?? '-' }}</span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Description</label>
                                        <br>
                                        <span class="text-bold text-sm ms-1">{{ $publication->description ?? '-' }}</span>
                                    </div>
                                </div>
                            </div>
                            <hr class="horizontal dark">
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
