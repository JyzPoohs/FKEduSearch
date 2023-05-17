@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Create User'])
    <div class="container-fluid py-4">
        <div class="row mt-4">
            <div class="col-lg-12 mb-lg-0 mb-4">
                @if (session()->has('success'))
                    <div id="alert">
                        @include('components.alert')
                    </div>
                @endif
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between">
                        <h5>Discussion Board</h5>
                        <button class="btn btn-primary" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                            Add new post
                        </button>
                    </div>
                    <div class="card-body p-3">
                        <div class="collapse mb-3" id="collapseExample">
                            <div class="card card-frame card-body">
                                <form role="form" method="POST" action={{ route('post.store') }}
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label">Title <span
                                                        class="text-danger">*</span></label>
                                                <input class="form-control" type="text" name="title">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label">Category <span
                                                        class="text-danger">*</span></label>
                                                <select class="form-select" name="ref_category_id">
                                                    <option>Select Category</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label">Question</label>
                                                <textarea class="form-control" cols="30" rows="5" name="description"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-end mt-2">
                                        <button class="btn btn-success btn-md ms-auto">Post</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @foreach ($datas as $data)
                            <div class="card card-frame mb-3">
                                <div class="card-header d-flex justify-content-between">
                                    <h6>{{ $data['title'] }}</h6>
                                    <small class="mb-0 text-small text-bold">
                                        #{{ $data['category']['value'] }} | {{ $data['user']['name'] }} |
                                        {{ $data['created_at'] }}
                                    </small>
                                </div>
                                <div class="card-body pt-0">
                                    <h6>Question</h6>
                                    {{ $data['description'] }}
                                    @if ($data->answer != null)
                                        <div class="mt-4">
                                            <hr class="mb-4">
                                            <div class="d-flex justify-content-between">
                                                <h6>Answer</h6>
                                                <small class="mb-0 text-small text-bold">
                                                    {{ $data['expert']['name'] }}
                                                </small>
                                            </div>
                                            {{ $data['answer'] }}
                                        </div>
                                    @endif
                                </div>
                                <div class="card-footer d-flex justify-content-end">
                                    <span class="me-2 text-bold" style="font-size: 14px">{{ $data->likes->count() }}</span>
                                    <a href="{{ route('like.store', ['post_id' => $data['id']]) }}">
                                        <i class="ni ni-favourite-28 text-primary text-lg opacity-10"></i>
                                    </a>
                                    &nbsp;&nbsp;&nbsp;
                                    <i class="ni ni-chat-round text-primary text-lg opacity-10"></i>
                                </div>
                            </div>
                        @endforeach
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
