@extends('layouts.admin', ['page_title' => 'Edit Package: ' . $package->id])
@section('content')
    <div class="body-content row">
        <div class="col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <form method="post" action="{{ route('admin.packages.edit', ['id' => $package->id]) }}">
                              
                                
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

