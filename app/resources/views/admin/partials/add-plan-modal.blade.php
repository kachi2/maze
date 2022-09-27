
<!-- REPORT MODAL -->
<div id="add-plan-modal" class="modal fade">
    <div class="modal-dialog modal-dialog-vertical-center" role="document">
        <div class="modal-content bd-0 tx-14">
            <div class="modal-header pd-y-20 pd-x-25">
                <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">
                    Add plan
                </h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pd-25">
                <form method="post" action="{{ route('admin.plans.add') }}">
                    @csrf

                    <input id="input-add-plan-package" type="hidden" name="package" value="{{ old('package') }}">

                    <div class="form-group">
                        <label for="inputName">Plan Name</label>
                        <input type="text" name="name"
                               value="{{ old('name', 'Plan 1') }}"
                               class="form-control {{ form_invalid('name') }}" id="inputName" placeholder="Enter your package name">
                        @showError('name')
                    </div>

                    <div class="form-group">
                        <label for="inputMinDeposit">Min. Deposit</label>
                        <input type="number" name="min_deposit"
                               step="any"
                               value="{{ old('min_deposit', 100) }}"
                               class="form-control {{ form_invalid('min_deposit') }}" id="inputMinDeposit" placeholder="Enter min deposit">
                        @showError('min_deposit')
                    </div>

                    <div class="form-group">
                        <label for="inputMaxDeposit">Max Deposit</label>
                        <input type="number" name="max_deposit"
                               step="any"
                               value="{{ old('max_deposit', 200) }}"
                               class="form-control {{ form_invalid('max_deposit') }}" id="inputMaxDeposit" placeholder="Enter max deposit">
                        @showError('max_deposit')
                    </div>

                    <div class="form-group">
                        <label for="inputProfitRate">Profit Rate</label>
                        <input type="number" name="profit_rate"
                               step="any"
                               value="{{ old('profit_rate') }}"
                               class="form-control {{ form_invalid('profit_rate') }}" id="inputProfitRate" placeholder="Enter profit rate">
                        @showError('profit_rate')
                    </div>

                    <button type="submit" class="btn btn-block btn-success">Add Plan</button>
                </form>
            </div>
        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->

@push('scripts')
    <script>
        function addPlan(packageId) {
            $('#input-add-plan-package').attr('value', packageId)
            $('#add-plan-modal').modal('show');
        }

        @if($errors->count() > 0 && session('is-adding-plan'))
            $(function () {
                $('#add-plan-modal').modal('show');
            });
        @endif
    </script>
@endpush

