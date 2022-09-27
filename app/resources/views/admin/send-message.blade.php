@extends('layouts.admin', ['page_title' => 'Message Users'])
@section('content')
<div class="nk-content nk-content-fluid">
                    <div class="container-xl wide-lg">
                        <div class="nk-content-body">
                            <div class="components-preview wide-md mx-auto">
                                 <div class="nk-block-head">
                                <div class="nk-block-between-md g-4">
                                    <div class="nk-block-head-content">
                                        <h5 class="nk-block-title fw-normal">Send Message</h5>
                                        
                                    </div>
                                    <div class="nk-block-head-content">
                                        <ul class="nk-block-tools gx-3">
                                            <li class="order-md-last">
                                                   <a href="{{ route('admin.users') }}" class="btn btn-primary"><i
                                                    class='uil uil-plus mr-1'></i>User List</a> </li>
                                       </ul>
                                    </div>
                                </div>
                            </div>
    <div class="body-content row">
        <div class="col-lg-5">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{ route('admin.message_users') }}">
                        @csrf
                        <div class="form-group">
                            <label for="inputSubject">Subject</label>
                            <input type="text" name="subject"
                                   value="{{ old('subject') }}"
                                   class="form-control {{ form_invalid('subject') }}" id="inputSubject"
                                   placeholder="Enter message subject">
                            @showError('subject')
                        </div>

                        <div class="form-group">
                            <label for="inputMessage">Message</label>
                            <textarea name="message"
                                   class="form-control {{ form_invalid('message') }}" id="inputMessage"
                                      placeholder="Enter user name" cols="10"
                                      rows="10">{{ old('message') }}</textarea>
                            @showError('message')
                        </div>

                        <div class="form-group">
                            <label for="inputRecipients">Recipients</label>
                            <select name="recipients" id="inputRecipients" class="form-control {{ form_invalid('recipients') }}"
                                    style="border-radius: 0 !important;">

                                <option value="all" {{ old('recipients') == 'all' ? 'selected' : ''}}>All Users</option>
                                <option value="admins" {{ old('recipients') == 'admins' ? 'selected' : ''}}>All Admins</option>
                                <option value="deposited" {{ old('recipients') == 'deposited' ? 'selected' : ''}}>
                                    Deposited Users
                                </option>
                                <option
                                    value="non-deposited" {{ old('recipients') == 'non-deposited' ? 'selected' : ''}}>
                                    Non-Deposited Users
                                </option>

                            </select>
                            @showError('recipients')
                        </div>

                        <button type="submit" class="btn btn-primary">Send message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
         </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
 

let message = {!! json_encode(Session::get('message')) !!};
let msg = {!! json_encode(Session::get('alert')) !!};

//alert(msg);
if(message != null){
toastr.clear();
    NioApp.Toast(message , msg, {
      position: 'top-right',
        timeOut: 5000,
    });
}

</script>
@endsection