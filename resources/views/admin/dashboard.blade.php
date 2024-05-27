@extends('admin.layout.app')

@section('content')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">

                    <!-- Sales Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                        class="bi bi-three-dots"></i></a>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Total Ammount</span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-currency-dollar"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ Auth::user()->blance }}</h6>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Revenue Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card revenue-card">
                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                        class="bi bi-three-dots"></i></a>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Total Transation</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-currency-dollar"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $trangsion }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Revenue Card -->

                    <!-- Top Selling -->
                    <div class="col-12">
                        <div class="card top-selling overflow-auto">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                        class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>

                            <div class="card-body pb-0">
                                <h5 class="card-title">All Transation </h5>

                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th scope="col">Sl No</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Transation Date</th>
                                            <th scope="col">Transation Type</th>
                                            <th scope="col">Fee</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($allTrangsion as $trns)
                                            <tr>
                                                <td>{{ $loop->index +1 }}</td>
                                            <td><a href="#" class="text-primary fw-bold">{{ $trns->adminName->name }}</a></td>
                                            <td>{{ $trns->ammount }}</td>
                                            <td class="fw-bold">{{ $trns->withdraw_date }}</td>
                                            <td class="fw-bold">{{ $trns->transation_type }}</td>
                                            <td>{{ $trns->fee ? $trns->fee : 'No Charge' }}</td>
                                        </tr>
                                        @empty
                                            <tr><td colspan="12"><h2 class="text-center text-danger">No Data Found</h2></td></tr>
                                        @endforelse
                                        
                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div><!-- End Top Selling -->

                </div>
            </div>
        </div>
    </section>
@endsection
