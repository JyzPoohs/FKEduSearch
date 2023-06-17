@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Complaint Report'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body p-3 d-flex flex-column justify-content-between">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Complaint</p>
                                    <h5 class="font-weight-bolder">
                                        {{ $report['Total Complaint'] }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow-success text-center rounded-circle">
                                    <i class="fas fa-chart-bar" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body p-3 d-flex flex-column justify-content-between">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Unsatisfied Expert Feedback</p>
                                    <h5 class="font-weight-bolder">
                                        {{ $report['Unsatisfied Complaints'] }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                    <i class="far fa-thumbs-down" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body p-3 d-flex flex-column justify-content-between">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Wrongly Assigned Research Area
                                    </p>
                                    <h5 class="font-weight-bolder">
                                        {{ $report['Wrongly Assigned Complaints'] }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                    <i class="fas fa-exclamation-circle" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body p-3 d-flex flex-column justify-content-between">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Inapproriate Complaint</p>
                                    <h5 class="font-weight-bolder">
                                        {{ $report['Inappropriate Complaints'] }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                    <i class="fas fa-flag" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-md-12">
                <div class="card h-100">
                    <div class="card-body p-3 d-flex flex-column justify-content-between">
                        <div class="row">
                            <div class="col-md-12 d-flex justify-content-center">
                                <canvas style="max-width: 300px; max-height: 300px" id="complaintStatusChart"></canvas>
                                <canvas style="max-width: 300px; max-height: 300px; margin-left:50px"
                                    id="complaintsChart"></canvas>
                            </div>
                        </div>
                       
                    </div>
                     <!-- Display the number of unresolved complaints -->
                     <p class="text-danger p-3">Total Unresolved Complaints: {{ $report['Unresolved Complaints'] }}</p>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-12 mb-lg-0 mb-4">
                @if (session()->has('success'))
                    <div id="alert">
                        @include('components.alert')
                    </div>
                @endif
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between mb-3">
                        <h6>Complaint List</h6>
                        <a class="btn btn-primary col-sm-1 offset-md-9" href="{{ route('complaint.index') }}">Back</a>
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
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Date
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Time
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!$complaints->isEmpty())
                                        @php $counter = 0; @endphp
                                        @foreach ($complaints as $complaint)
                                            @php $counter++; @endphp
                                            <tr>
                                                <td>
                                                    <p class="text-sm font-weight-bold mb-0 ms-3">{{ $counter }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-sm font-weight-bold mb-0">
                                                        {{ $complaint->user->name }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-sm font-weight-bold mb-0">
                                                        {{ $complaint->type->value }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-sm font-weight-bold mb-0 ">
                                                        {{ $complaint->description }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-sm font-weight-bold mb-0">
                                                        {{ $complaint->created_at->format('Y/m/d') }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-sm font-weight-bold mb-0">
                                                        {{ $complaint->created_at->format('h:i:s A') }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-sm font-weight-bold mb-0">
                                                        {{ $complaint->status->value }}</p>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="3" class="align-middle text-center">
                                                <p class="text-sm font-weight-bold mb-0">There is no property
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

    </div>
    @include('layouts.footers.auth.footer')
@endsection

@push('js')
    <script>
        //Script to generate pie chart for complaint status

        // Get the inputs values from the PHP variables
        var investigateComplaints = {{ $report['In Investigation Complaints'] }};
        var holdComplaints = {{ $report['On Hold Complaints'] }};
        var resolvedComplaints = {{ $report['Resolved Complaints'] }};

        // Define an array of colors for each segment
        var segmentColors = ['#FF6384', '#36A2EB', '#FFCE56'];

        // Create a pie chart
        var ctx = document.getElementById('complaintStatusChart').getContext('2d');
        var complaintStatusChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Investigation', 'On Hold', 'Resolved'],
                datasets: [{
                    data: [investigateComplaints, holdComplaints, resolvedComplaints],
                    backgroundColor: segmentColors,
                    borderColor: '#fff',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Current Complaint Status Count',
                        font: {
                            size: 16,
                            weight: 'bold'
                        }
                    },
                    legend: {
                        display: true,
                        position: 'bottom'
                    }
                }
            }
        });
    </script>

    <script>
        //Script to generate bar chart for complaint type

        // Get the inputs values from the PHP variables
        var unsatisfiedComplaints = {{ $report['Unsatisfied Complaints'] }};
        var wronglyAssignedComplaints = {{ $report['Wrongly Assigned Complaints'] }};
        var inappropriateComplaints = {{ $report['Inappropriate Complaints'] }};

        // Define an array of colors for each bar
        var barColors = ['#235391', '#57CC02', '#1D7A85'];

        // Create a bar chart
        var ctx = document.getElementById('complaintsChart').getContext('2d');
        var complaintsChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Unsatisfied', 'Wrongly Assigned', 'Inappropriate'],
                datasets: [{
                    label: 'Complaint Type',
                    data: [unsatisfiedComplaints, wronglyAssignedComplaints, inappropriateComplaints],
                    backgroundColor: barColors,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Complaint Type in 30 Days',
                        font: {
                            size: 16,
                            weight: 'bold'
                        }
                    }
                }
            }
        });
    </script>

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
