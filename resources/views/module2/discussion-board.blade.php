@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Discussion Board'])
    <div class="container-fluid py-5">
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
                        <div>
                            @if (auth()->user()->is_approved == 1)
                                <button class="btn btn-primary" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                    Add new post
                                </button>
                            @endif
                            <button class="btn btn-success" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseFilter" aria-expanded="false" aria-controls="collapseFilter">
                                Filter
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        {{-- create post --}}
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
                        {{-- filter post --}}
                        <div class="collapse mb-3" id="collapseFilter">
                            <div class="card card-frame card-body">
                                <form role="form" action="">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label">Title</label>
                                                <input class="form-control" type="text" name="title"
                                                    value="{{ $title_search }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label">Category</label>
                                                <select class="form-select" name="ref_category_id">
                                                    <option value="">Select Category</option>
                                                    @foreach ($categories as $category)
                                                        <option @if ($selected_category == $category->id) selected @endif
                                                            value="{{ $category->id }}">{{ $category->value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-end mt-2">
                                        <button class="btn btn-success btn-md ms-auto">Filter</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @include('module2._post')
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection

@push('js')
    <script>
        function deleteRecord(url) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#000080',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                preConfirm: (input) => {
                    return fetch(url, {
                            method: 'DELETE',
                            headers: {
                                'Accept': 'application/json',
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                _token: "{{ csrf_token() }}"
                            })
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(response.statusText)
                            }
                            return response.json()
                        })
                        .catch(error => {
                            Swal.showValidationMessage(
                                `Request failed: ${error}`
                            )
                        })
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Deleted!',
                        'The post has been deleted.',
                        'success'
                    )
                    setTimeout(() => {
                        document.location.reload();
                    }, 2000);
                }
            })
        }

        function closePost(url) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#000080',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                preConfirm: (input) => {
                    return fetch(url, {
                            method: 'GET',
                            headers: {
                                'Accept': 'application/json',
                                'Content-Type': 'application/json'
                            },
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(response.statusText)
                            }
                            return response.json()
                        })
                        .catch(error => {
                            Swal.showValidationMessage(
                                `Request failed: ${error}`
                            )
                        })
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Success!',
                        'The post has been completed.',
                        'success'
                    )
                    setTimeout(() => {
                        document.location.reload();
                    }, 2000);
                }
            })
        }
    </script>
@endpush
