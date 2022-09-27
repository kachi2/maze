@extends('layouts.settings', ['page_title' => 'Profile Settings'])
@section('form')
    <form method="post" action="{{ route('setting.profile') }}" enctype="multipart/form-data">
        @csrf

        <div style="margin-top: 100px"></div>
        <input type="file" name="photo" id="mediaFile" />
        <div id="profile"  style="background-image: url('{{ $user->photo_url }}')" class="{{ form_invalid('photo') }}">
            <div class="dashes"></div>
            <label>Click to browse or drag an image here</label>
        </div>

        @error('photo')
        <div class="alert alert-danger mt-2">{{ $message }}</div>
        @enderror

        <div class="form-group mt-5">
            <label for="inputUsername">Username</label>
            <input type="text" disabled name="username"
                   value="{{ $user->username }}"
                   class="form-control" id="inputUsername">
        </div>

        <div class="form-group">
            <label for="inputFirstName">First Name</label>
            <input type="text" name="first_name"
                   value="{{ old('first_name', $user->first_name) }}"
                   class="form-control {{ form_invalid('first_name') }}" id="inputFirstName" placeholder="Enter your first name">
            @showError('first_name')
        </div>

        <div class="form-group">
            <label for="inputLastName">Last Name</label>
            <input type="text" name="last_name"
                   value="{{ old('last_name', $user->last_name) }}"
                   class="form-control {{ form_invalid('last_name') }}" id="inputLastName" placeholder="Enter your last name">
            @showError('last_name')
        </div>

        <div class="form-group">
            <label for="inputCountry">Country</label>
            <input type="text" name="country"
                   value="{{ old('country', $user->country) }}"
                   class="form-control {{ form_invalid('country') }}" id="inputCountry" placeholder="Enter country name">
            @showError('country')
        </div>

        <div class="form-group">
            <label for="inputState">State</label>
            <input type="text" name="state"
                   value="{{ old('state', $user->state) }}"
                   class="form-control {{ form_invalid('state') }}" id="inputState" placeholder="Enter state name">
            @showError('state')
        </div>

        <div class="form-group">
            <label for="inputCity">City</label>
            <input type="text" name="city"
                   value="{{ old('city', $user->city) }}"
                   class="form-control {{ form_invalid('city') }}" id="inputCity" placeholder="Enter city name">
            @showError('city')
        </div>

        <div class="form-group">
            <label for="inputPhone">Phone Number</label>
            <input type="text" name="phone"
                   value="{{ old('phone', $user->phone) }}"
                   class="form-control {{ form_invalid('phone') }}" id="inputPhone" placeholder="Enter phone number">
            @showError('phone')
        </div>

        <div class="form-group">
            <label for="inputEmail">Email</label>
            <input type="text" name="email"
                   value="{{ old('email', $user->email) }}"
                   class="form-control {{ form_invalid('email') }}" id="inputEmail" placeholder="Enter email address">
            @showError('email')
        </div>
        <div class="form-group">
            <label for="inputBTC">BTC</label>
            <input type="text" name="btc"
                   value="{{ old('btc', $user->btc) }}"
                   class="form-control {{ form_invalid('btc') }}" id="inputBTC" placeholder="Enter BTC address">
            @showError('btc')
        </div>
        <div class="form-group">
            <label for="inputETH">ETH</label>
            <input type="text" name="eth"
                   value="{{ old('eth', $user->eth) }}"
                   class="form-control {{ form_invalid('eth') }}" id="inputETH" placeholder="Enter ETH address">
            @showError('eth')
        </div>
        <div class="form-group">
            <label for="inputDGE">DGE</label>
            <input type="text" name="dge"
                   value="{{ old('dge', $user->dge) }}"
                   class="form-control {{ form_invalid('dge') }}" id="inputDGE" placeholder="Enter DGE address">
            @showError('dge')
        </div>
        <div class="form-group">
            <label for="inputLTC">LTC</label>
            <input type="text" name="ltc"
                   value="{{ old('ltc', $user->ltc) }}"
                   class="form-control {{ form_invalid('ltc') }}" id="inputLTC" placeholder="Enter LTC address">
            @showError('ltc')
        </div>
        <div class="form-group">
            <label for="inputBCH">BCH</label>
            <input type="text" name="bch"
                   value="{{ old('bch', $user->bch) }}"
                   class="form-control {{ form_invalid('bch') }}" id="inputBCH" placeholder="Enter BCH address">
            @showError('bch')
        </div>

        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
    <style>
        #mediaFile {
            position: absolute;
            top: -1000px;
        }

        #profile {
            border-radius: 100%;
            width: 150px;
            height: 150px;
            margin: 0 auto;
            position: relative;
            top: -80px;
            margin-bottom: -80px;
            cursor: pointer;
            background: #f4f4f4;
            display: table;
            background-size: cover;
            background-position: center center;
            box-shadow: 0 5px 8px rgba(0, 0, 0, 0.35);
        }

        #profile.is-invalid {
            border: 4px solid red;
        }
        #profile .dashes {
            position: absolute;
            top: 0;
            left: 0;
            border-radius: 100%;
            width: 100%;
            height: 100%;
            border: 4px dashed #ddd;
            opacity: 1;
        }
        #profile label {
            display: table-cell;
            vertical-align: middle;
            text-align: center;
            padding: 0 30px;
            color: grey;
            opacity: 1;
        }
        #profile.dragging {
            background-image: none !important;
        }
        #profile.dragging .dashes {
            -webkit-animation-duration: 10s;
            animation-duration: 10s;
            -webkit-animation-name: spin;
            animation-name: spin;
            -webkit-animation-iteration-count: infinite;
            animation-iteration-count: infinite;
            -webkit-animation-timing-function: linear;
            animation-timing-function: linear;
            opacity: 1 !important;
        }
        #profile.dragging label {
            opacity: 0.5 !important;
        }
        #profile.hasImage .dashes, #profile.hasImage label {
            opacity: 0;
            pointer-events: none;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

    </style>
@endsection

@push('scripts')
    <script>
        // ----- On render -----
        $(function() {

            $('#profile').addClass('dragging').removeClass('dragging');
        });

        $('#profile').on('dragover', function() {
            $('#profile').addClass('dragging')
        }).on('dragleave', function() {
            $('#profile').removeClass('dragging')
        }).on('drop', function(e) {
            $('#profile').removeClass('dragging hasImage');

            if (e.originalEvent) {
                var file = e.originalEvent.dataTransfer.files[0];
                console.log(file);

                var reader = new FileReader();

                //attach event handlers here...

                reader.readAsDataURL(file);
                reader.onload = function(e) {
                    console.log(reader.result);
                    $('#profile').css('background-image', 'url(' + reader.result + ')').addClass('hasImage');

                }

            }
        })
        $('#profile').on('click', function(e) {
            console.log('clicked')
            $('#mediaFile').click();
        });
        window.addEventListener("dragover", function(e) {
            e = e || event;
            e.preventDefault();
        }, false);
        window.addEventListener("drop", function(e) {
            e = e || event;
            e.preventDefault();
        }, false);
        $('#mediaFile').change(function(e) {

            var input = e.target;
            if (input.files && input.files[0]) {
                var file = input.files[0];

                var reader = new FileReader();

                reader.readAsDataURL(file);
                reader.onload = function(e) {
                    console.log(reader.result);
                    $('#profile').css('background-image', 'url(' + reader.result + ')').addClass('hasImage');
                }
            }
        })
    </script>
@endpush

