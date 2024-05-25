@extends('admin.layout.app')

@section('content')
<section class="section">
    <div class="row">
        <div class="col-lg-8 offset-2">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Withdraw Money</h5>
                    @if (Session('success'))
                    <div class="alert alert-success">
                        {{ Session('success') }}
                    </div>
                    @endif
                    <form class="row g-3" method="post"
                        action="{{ url('admin/add-withdraw') }}/{{ Auth::user()->id }}">
                        @csrf
                        <div class="col-12">
                            <label for="inputPassword4" class="form-label">Ammount</label>
                            <input type="text" name="ammount" class="form-control" id="inputPassword4">
                            @error('ammount')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="inputAddress" class="form-label">Deposit Date</label>
                            <input type="date" name="date" class="form-control" id="inputAddress"
                                placeholder="1234 Main St">
                            @error('date')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <select id="inputState" name="transation_type" class="form-select">
                                <option selected="" disabled>Choose...</option>
                                <option value="withdraw">Withdraw</option>
                            </select>
                            @error('transation_type')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form><!-- Vertical Form -->

                </div>
            </div>
        </div>
    </div>
</section>
@endsection
