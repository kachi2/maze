@extends('layouts.admin', ['page_title' => 'Package: ' . $package->id])
@section('content')
    <div class="body-content row">
        <div class="col-xl-3">
            <div class="card">
                <div class="card-body">
                    <dl class="row mb-4 mt-3">
                        <dt class="col-sm-8 font-weight-bold">Package Name :</dt>
                        <dd class="col-sm-4 font-weight-normal">{{ $package->name }}</dd>

                        <dt class="col-sm-8 font-weight-bold">Duration :</dt>
                        <dd class="col-sm-4 font-weight-normal">{{ $package->formatted_duration }}</dd>

                        <dt class="col-sm-8 font-weight-bold">Payment Period :</dt>
                        <dd class="col-sm-4 font-weight-normal">{{ $package->formatted_payment_period }}</dd>

                        <dt class="col-sm-8 font-weight-bold">Plans :</dt>
                        <dd class="col-sm-4 font-weight-normal">{{ $package->plans()->count() }}</dd>

                        <dt class="col-sm-8 col-xl-6 font-weight-bold">Created At :</dt>
                        <dd class="col-sm-4 col-xl-6 font-weight-normal">{{ $package->created_at }}</dd>

                        <dt class="col-sm-8 col-xl-7 font-weight-bold">Action :</dt>
                        <dd class="col-sm-4 col-xl-5 font-weight-normal"><a href="{{ route('admin.packages.edit', ['id' => $package->id]) }}" class="btn btn-sm btn-danger">
                                <i class='uil uil-edit'></i>
                            </a>
                            <button class="btn btn-sm btn-danger" onclick="deletePackage('{{ route('admin.packages.delete', ['id' => $package->id]) }}')">
                                <i class='uil uil-trash'></i>
                            </button>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="col-xl-9">
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div class="col-sm-4">
                            <h5>Rates</h5>
                        </div>
                        <div class="col-sm-8">
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
        function deletePackage(url) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You wont be able to reveres this',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if(result.value) {
                    postDummy(url)
                }
            })
        }
    </script>
@endpush

