@extends('layouts.admin', ['page_title' => 'Edit Package: ' . $package->id])
@section('content')
    <div class="body-content row">
        <div class="col-xl-3">
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div class="col-sm-12">

                            <form method="post" action="{{ route('admin.packages.edit', ['id' => $package->id]) }}">
                                @csrf
                                <div class="form-group">
                                    <label for="inputName">Package Name</label>
                                    <input type="text" name="name"
                                           value="{{ old('name', $package->name) }}"
                                           class="form-control {{ form_invalid('name') }}" id="inputName" placeholder="Enter your package name">
                                    @showError('name')
                                </div>

                                <div class="form-group">
                                    <label for="inputPaymentPeriod">Payment Period</label>
                                    <select name="payment_period"
                                            class="form-control {{ form_invalid('payment_period') }}" id="inputPaymentPeriod">
                                        @foreach(get_payment_periods() as $period => $periodName)
                                            <option  {{ old('payment_period', $package->payment_period) == $period ? 'selected' : '' }} value="{{ $period }}">{{ $periodName }}</option>
                                        @endforeach
                                    </select>
                                    @showError('payment_period')
                                </div>

                                <div class="form-group">
                                    <label for="inputDuration">Package Duration</label>
                                    <input type="number" name="duration"
                                           value="{{ old('duration', $package->duration) }}"
                                           class="form-control {{ form_invalid('duration') }}" id="inputDuration" placeholder="Enter package duration">
                                    @showError('duration')
                                </div>

                                <div class="form-group">
                                    <label for="inputDescription">Description</label>
                                    <textarea type="text" name="desc"
                                              class="form-control {{ form_invalid('desc') }}" id="inputDescription">{{ old('desc', $package->desc) }}</textarea>
                                    @showError('desc')
                                </div>

                                <button type="submit" class="btn btn-primary">Update Package</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-9">
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div class="col-sm-3">
                            <h5>Rates</h5>
                        </div>
                        <div class="col-sm-9">
                            <div class="float-sm-right mt-3 mt-sm-0">
                                <button onclick="addPlan({{ $package->id }})" class="btn btn-primary"><i
                                        class='uil uil-plus mr-1'></i>Add Plan</button>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead class="thead-light">
                                    <tr>
                                        <th scope="col">#Id</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Min. Deposit</th>
                                        <th scope="col">Max. deposit</th>
                                        <th scope="col">Percent</th>
                                        <th scope="col">Active Trades</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($package->plans as $plan)
                                        <tr>
                                            <th scope="row">{{ $plan->id }}</th>
                                            <td>{{ $plan->name }}</td>
                                            <td>{{ moneyFormat($plan->min_deposit, 'USD') }}</td>
                                            <td>{{ moneyFormat($plan->max_deposit, 'USD') }}</td>
                                            <td>{{ $plan->profit_rate }}%</td>
                                            <td>{{ $plan->activeTrades()->count() }} Trades</td>
                                            <td>{{ $plan->created_at }}</td>
                                            <td>
                                                <a href="{{ route('admin.plans.show', ['id' => $plan->id]) }}" class="btn btn-sm btn-danger">
                                                    <i class='uil uil-eye'></i>
                                                </a>
                                                <button  onclick="editPlan('{{ route('admin.plans.edit', ['id' => $plan->id]) }}', '{{ $plan->name }}', {{ $plan->min_deposit }}, {{ $plan->max_deposit }}, {{ $plan->profit_rate }})" class="btn btn-sm btn-danger">
                                                    <i class='uil uil-edit'></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger" onclick="deletePlan('{{ route('admin.plans.delete', ['id' => $plan->id]) }}')">
                                                    <i class='uil uil-trash'></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td><span>No Plans Yet</span>
                                            <td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @include('admin.partials.add-plan-modal')
    @include('admin.partials.edit-plan-modal')
@endsection
@push('scripts')
    <script>
        function deletePlan(url) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!'
            }).then(function (result) {
                if (result.value) {
                    this.postDummy(url)
                }
            });
        }
    </script>
@endpush

