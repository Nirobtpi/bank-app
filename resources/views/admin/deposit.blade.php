@extends('admin.layout.app')

@section('content')
                        <div class="col-12">
                        <div class="card top-selling overflow-auto">

                            <div class="filter p-3 d-flex justify-content-end">
                               <a href="{{ url('/admin/add-deposit') }}">Add Now</a>
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
                                            <th scope="col">Fee</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($allDeposit as $deposit)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                            <td><a href="#" class="text-primary fw-bold">{{ $deposit->adminName->name }}</a></td>
                                            <td>{{ $deposit->ammount }}</td>
                                            <td class="fw-bold">{{ $deposit->withdraw_date }}</td>
                                            <td>{{ $deposit->fee }}</td>
                                        </tr>
                                        @empty
                                            <tr><td colspan="12"><h2 class="text-center text-danger">No Data Found</h2></td></tr>
                                        @endforelse
                                        
                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div><!-- End Top Selling -->
@endsection