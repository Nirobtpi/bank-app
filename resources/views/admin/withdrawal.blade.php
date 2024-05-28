@extends('admin.layout.app')

@section('content')
    <div class="col-12">
        <div class="card top-selling p-3 overflow-auto">
            @if (Session('success'))
                <div class="alert text-center alert-success">
                    {{ Session('success') }}
                </div>
            @endif
            <div class="filter p-3 d-flex justify-content-end">
                <a href="{{ url('/admin/withdraw') }}">Withdraw Money</a>
            </div>
            <div class="card-body pb-0">
                <h5 class="card-title">All Withdrawal</h5>

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
                        @forelse ($withdraw as $draw)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td><a href="#" class="text-primary fw-bold">{{ $draw->adminName->name }}</a></td>
                                <td>{{ $draw->ammount }}</td>
                                <td class="fw-bold">{{ $draw->withdraw_date }}</td>
                                <td>{{ $draw->fee ? $draw->fee : 'No Charge' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="12">
                                    <h2 class="text-center text-danger">No Data Found</h2>
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>

            </div>

        </div>
    </div><!-- End Top Selling -->
@endsection
