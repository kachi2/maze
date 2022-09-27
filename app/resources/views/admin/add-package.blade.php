@extends('layouts.admin', ['page_title' => 'Add Package'])
@section('content')
<div class="nk-content nk-content-fluid">
                    <div class="container-xl wide-lg">
                        <div class="nk-content-body">
                            <div class="components-preview wide-md mx-auto">
                                 <div class="nk-block-head">
                                <div class="nk-block-between-md g-4">
                                    <div class="nk-block-head-content">
                                        <h5 class="nk-block-title fw-normal">Add Package</h5>
                                        
                                    </div>
                                    <div class="nk-block-head-content">
                                        <ul class="nk-block-tools gx-3">
                                            <li class="order-md-last">
                                                   <a href="{{ route('admin.packages') }}" class="btn btn-primary"><i
                                                    class='uil uil-plus mr-1'></i>Package</a> </li>
                                       </ul>
                                    </div>
                                </div>
                            </div>
    <form method="post" action="{{ route('admin.packages.add') }}">
        <div class="body-content row">
            <div class="col-xl-3">
                <div class="card h-100">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-sm-12">

                                @csrf
                                <div class="form-group">
                                    <label for="inputName">Package Name</label>
                                    <input type="text" name="name"
                                           value="{{ old('name') }}"
                                           class="form-control {{ form_invalid('name') }}" id="inputName"
                                           placeholder="Enter your package name">
                                    @showError('name')
                                </div>

                                <div class="form-group">
                                    <label for="inputPaymentPeriod">Payment Period</label>
                                    <select name="payment_period"
                                            class="form-control {{ form_invalid('payment_period') }}"
                                            id="inputPaymentPeriod">
                                        @foreach(get_payment_periods() as $period => $periodName)
                                            <option
                                                {{ old('payment_period') == $period ? 'selected' : '' }} value="{{ $period }}">{{ $periodName }}</option>
                                        @endforeach
                                    </select>
                                    @showError('payment_period')
                                </div>

                                <div class="form-group">
                                    <label for="inputDuration">Package Duration</label>
                                    <input type="number" name="duration"
                                           value="{{ old('duration', 360) }}"
                                           class="form-control {{ form_invalid('duration') }}" id="inputDuration"
                                           placeholder="Enter package duration">
                                    @showError('duration')
                                </div>

                                <div class="form-group">
                                    <label for="inputDescription">Description</label>
                                    <textarea type="text" name="desc"
                                              class="form-control {{ form_invalid('desc') }}"
                                              id="inputDescription">{{ old('desc') }}</textarea>
                                    @showError('desc')
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9">
                <div class="card h-100">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-sm-3">
                                <h5>Rates</h5>
                            </div>
                            <div class="col-sm-9">

                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col">
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Min. Deposit</th>
                                            <th scope="col">Max. deposit</th>
                                            <th scope="col">Percent</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach(range(0, 4) as $plan)
                                            <tr>
                                                <td><input name="plans[{{$plan}}][name]" type="text"
                                                           value="{{ old("plans.$plan.name", $plan == 0 ? 'Plan 1' : '') }}"
                                                           class="form-control form-control-sm {{ form_invalid("plans.$plan.name") }}"></td>
                                                <td><input name="plans[{{$plan}}][min_deposit]" type="number" step="any"
                                                           value="{{ old("plans.$plan.min_deposit", $plan == 0 ? 100 : '') }}"
                                                           class="form-control form-control-sm {{ form_invalid("plans.$plan.min_deposit") }}"></td>
                                                <td><input name="plans[{{$plan}}][max_deposit]" type="number" step="any"
                                                           value="{{ old("plans.$plan.max_deposit", $plan == 0 ? 200 : '') }}"
                                                           class="form-control form-control-sm {{ form_invalid("plans.$plan.max_deposit") }}"></td>
                                                <td><input name="plans[{{$plan}}][profit_rate]" type="number" step="any"
                                                           value="{{ old("plans.$plan.profit_rate", $plan == 0 ? 3.5 : '') }}"
                                                           class="form-control form-control-sm {{ form_invalid("plans.$plan.profit_rate") }}"></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-12 mt-4">
                <button type="submit" class="btn btn-primary float-right">Add Package</button>
            </div>
        </div>

    </form>
        </div>
                        </div>

                    </div>
                </div>
@endsection
