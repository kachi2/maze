@extends('layouts.admin', ['page_title' => 'Message Users'])
@section('content')
    <div class="body-content row">
        <div class="col-lg-5">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{ route('admin.tokens.add') }}">
                    {{ csrf_field() }}
                    <div class="form-group mb-3">
                        <label for="basic-url">Token *</label>
                        <input type="text" name="token" value="{{ old('token') }}"
                               class="form-control {{ form_invalid('token') }}">
                        @showError('token')
                    </div>

                    <div class="form-group mb-3">
                        <label for="inputType">Type *</label>
                        <select class="form-control {{ form_invalid('type') }}"
                                name="type" id="inputType">
                            <option {{ old('type') == \App\Models\Token::TYPE_BITWALLET ? 'selected' : '' }} value="{{ \App\Models\Token::TYPE_BITWALLET }}">Bitwallet</option>
                            <option {{ old('type') == \App\Models\Token::TYPE_MYCELIUM ? 'selected' : '' }} value="{{ \App\Models\Token::TYPE_MYCELIUM }}">Mycelium</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-block btn-success">Add Token</button>
                </form>
                </div>
            </div>
        </div>
    </div>
@endsection
