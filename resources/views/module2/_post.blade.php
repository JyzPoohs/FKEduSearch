@if (!$datas->isEmpty())
    @foreach ($datas as $data)
        <div class="card card-frame mb-3">
            <div class="card-header">
                <div class="row">
                    <div class="col-7">
                        <h6>{{ $data['title'] }}</h6>
                    </div>
                    <div class="col d-flex d-flex justify-content-end">
                        <small class="mb-0 text-small text-bold">
                            #{{ $data['category']['value'] }} | <a
                                href="{{ route('user.profile-view', ['id' => $data['user_id']]) }}">{{ $data['user']['name'] }}</a>
                            |
                            {{ $data['created_at'] }}
                            |
                            <span class="text-primary">{{ $data['status']['value'] }}</span>
                        </small>
                    </div>
                </div>
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
                                @if ($data->status->code == 2)
                                    <a href="{{ route('complaint.create', ['post_id' => $data->id]) }}">
                                        <i class="fa fa-flag" aria-hidden="true"></i>
                                    </a>
                                @endif
                                <a
                                    href="{{ route('expert.profile-view', ['id' => $data['expert']['id']]) }}">{{ $data['expert']['name'] }}</a>
                            </small>
                        </div>
                        {{ $data['answer'] }}
                    </div>
                @endif
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-end">
                    @if ($data->accepted_by)
                        <span class="me-2 text-bold" style="font-size: 14px">{{ $data->likes->count() }}</span>
                        <a
                            @if (auth()->user()->id != $data['user_id']) href="{{ route('like.index', ['post_id' => $data['id']]) }}" @endif>
                            <i class="ni ni-favourite-28 text-primary text-lg opacity-10"></i>
                        </a>
                        &nbsp;&nbsp;&nbsp;
                        <span class="me-2 text-bold" style="font-size: 14px">{{ $data->comments->count() }}</span>
                        <i class="ni ni-chat-round text-primary text-lg opacity-10" data-bs-toggle="collapse"
                            data-bs-target="#collapseComment-{{ $data['id'] }}"></i>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                    @endif
                    @if (auth()->user()->id == $data->user_id || $data->status->code == 3)
                        <a class="text-danger" href="#" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Delete Post"
                            onclick="deleteRecord('{{ route('post.destroy', ['post' => $data['id']]) }}')"><i
                                class="ni ni-fat-delete text-primary text-lg opacity-10"></i></a>
                        @if ($data->status->code != 3)
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <a class="text-danger" href="#" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="Complete Post"
                                onclick="closePost('{{ route('post.close', ['post' => $data['id']]) }}')"><i
                                    class="ni ni-check-bold text-primary text-lg opacity-10"></i></a>
                        @endif
                    @endif
                    @if ($data->status->code == 3 && !$data->feedback)
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <div data-bs-toggle="tooltip" data-bs-placement="top" title="Give Feedback">
                            <a data-bs-toggle="modal" data-bs-target="#modal-form"><i
                                    class="ni ni-like-2 text-primary text-lg opacity-10"></i></a>
                        </div>
                        @include('module2._feedback')
                    @endif
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
    <h6 class="ms-2">There are currently no posts available.</h6>
@endif
