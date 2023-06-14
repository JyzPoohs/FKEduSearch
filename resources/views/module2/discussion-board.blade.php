@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Discussion Board'])
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
                                        <button class="btn btn-primary btn-md ms-auto">Post</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @if (!$datas->isEmpty())
                            @foreach ($datas as $data)
                                <div class="card card-frame mb-3">
                                    <div class="card-header d-flex justify-content-between">
                                        <h6>{{ $data['title'] }}</h6>
                                        <small class="mb-0 text-small text-bold">
                                            #{{ $data['category']['value'] }} | <a
                                                href="{{ route('user.profile-view', ['id' => $data['user_id']]) }}">{{ $data['user']['name'] }}</a>
                                            |
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
                                                        <a href="{{ route('complaint.create') }}">
                                                            <i class="fa fa-flag" aria-hidden="true"></i>
                                                        </a>
                                                        {{ $data['expert']['name'] }}
                                                    </small>
                                                </div>
                                                {{ $data['answer'] }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="card-footer">
                                        <div class="d-flex justify-content-end">
                                            <span class="me-2 text-bold"
                                                style="font-size: 14px">{{ $data->likes->count() }}</span>
                                            <a
                                                @if (auth()->user()->id != $data['user_id']) href="{{ route('like.index', ['post_id' => $data['id']]) }}" @endif>
                                                <i class="ni ni-favourite-28 text-primary text-lg opacity-10"></i>
                                            </a>
                                            &nbsp;&nbsp;&nbsp;
                                            <span class="me-2 text-bold"
                                                style="font-size: 14px">{{ $data->comments->count() }}</span>
                                            <i class="ni ni-chat-round text-primary text-lg opacity-10"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#collapseComment-{{ $data['id'] }}"></i>
                                        </div>
                                        <div class="collapse mb-3" id="collapseComment-{{ $data['id'] }}">
                                            <hr class="horizontal dark">
                                            <h6 class="mb-3">Comments</h6>
                                            @foreach ($data->comments as $comment)
                                                <div class="mb-3">
                                                    <div class="d-flex justify-content-between">
                                                        <label for="example-text-input"
                                                            class="form-control-label">{{ $comment->user->name }}</label>
                                                        <small class="mb-0 text-small text-bold">
                                                            {{ $comment->created_at }}
                                                        </small>
                                                    </div>
                                                    <span class="text-bold text-sm ms-1">{{ $comment->comment }}</span>
                                                    <hr>
                                                </div>
                                            @endforeach
                                            <form role="form" method="POST" action={{ route('comment.store') }}
                                                enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="post_id" value="{{ $data['id'] }}">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="example-text-input" class="form-control-label">Add a
                                                                comment</label>
                                                            <textarea class="form-control" cols="30" rows="3" name="comment"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-end mt-2">
                                                    <button class="btn btn-primary btn-sm ms-auto">Send</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <h6 class="ms-3">There is no posts available.</h6>
                            <h6 class="ms-3 text-secondary">Please check again later.</h6>
                        @endif
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
