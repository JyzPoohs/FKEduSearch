@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Manage Complaint'])
    <div class="container-fluid py-4">
        <div class="row mt-4">
            <div class="col-lg-12 mb-lg-0 mb-4">
                @if (session()->has('success'))
                    <div id="alert">
                        @include('components.alert')
                    </div>
                @endif
                <form action="{{ route('complaint.search') }}" method="GET" class="mb-4">
                    <div class="input-group">
                        <div class="form-group col-md-3">
                            <select class="form-select" name="ref_complaint_type_id">
                                <option disabled selected>Search by Complaint Type</option>
                                <option value="10" {{ old('ref_complaint_type_id') === '10' ? 'selected' : '' }}>
                                    Unsatisfied Expert's Feedback</option>
                                <option value="11" {{ old('ref_complaint_type_id') === '11' ? 'selected' : '' }}>Wrongly
                                    Assigned Research Area</option>
                                <option value="12" {{ old('ref_complaint_type_id') === '12' ? 'selected' : '' }}>
                                    Inappropriate Feedback</option>
                            </select>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-success"><i class="fa fa-search"></i></button>
                            <a href="{{ route('complaint.index') }}" class="btn btn-danger"><i class="fa fa-times"></i></a>
                        </div>
                    </div>
                </form>


                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between mb-3">
                        <h6>Complaint List</h6>
                        <a href="{{ route('complaint.report') }}" class="btn btn-sm float-end mb-0"
                            style="background-color: #57cc02;color:white">Report</a>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Name
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Complaint Type
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Description
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Date
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Time
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Status
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!$datas->isEmpty())
                                        @php $counter = 0; @endphp
                                        @foreach ($datas as $data)
                                            @php $counter++; @endphp
                                            <tr>
                                                <td>
                                                    <p class="text-sm font-weight-bold mb-0 ms-3">{{ $counter }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-sm font-weight-bold mb-0">
                                                        {{ $data->user->name }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-sm font-weight-bold mb-0">
                                                        {{ $data->type->value }}
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="text-sm font-weight-bold mb-0">
                                                        {{ $data->description }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-sm font-weight-bold mb-0">
                                                        {{ $data->created_at->format('Y-m-d') }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-sm font-weight-bold mb-0">
                                                        {{ $data->created_at->format('H:i:s') }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-sm font-weight-bold mb-0">
                                                        {{ $data->status->value }}</p>
                                                </td>
                                                <td class="align-middle text-end">
                                                    <div class="d-flex px-3 py-1 justify-content-center align-items-center">
                                                        <a class="text-success me-3"
                                                            href="{{ route('complaint.show', ['complaint' => $data['id']]) }}"><i
                                                                class="fa fa-pencil-square-o fa-lg"
                                                                aria-hidden="true"></i></a>
                                                        <a class="text-danger" href="#"
                                                            onclick="deleteRecord('{{ route('complaint.destroy', ['complaint' => $data['id']]) }}')"><i
                                                                class="fa fa-trash-o fa-lg" aria-hidden="true"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="3" class="align-middle text-center">
                                                <p class="text-sm font-weight-bold mb-0">There is no complaint record
                                                    available.
                                                </p>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
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
                        'The user has been deleted.',
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
