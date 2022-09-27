@extends('layouts.admin', ['page_title' => 'Send User Message'])
@section('content')
<div class="nk-content nk-content-fluid">
                    <div class="container-xl wide-lg">
                        <div class="nk-content-body">
                            <div class="components-preview wide-md mx-auto">
                                 <div class="nk-block-head">
                                <div class="nk-block-between-md g-4">
                                    <div class="nk-block-head-content">
                                        <h5 class="nk-block-title fw-normal">Send Bonus</h5>
                                        
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
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="text-center mt-3">
                        <img src="{{ $user->photo_url }}" alt="{{ $user->username }}"
                             class="img-thumbnail" />
                        <h5 class="mt-2 mb-0">{{ $user->name }}</h5>
                        <h6 class="text-muted font-weight-normal mt-1 mb-0">{{ '@' }}{{ $user->username }}</h6>
                        <h6 class="text-muted font-weight-normal mt-2 mb-4">{{ $user->location }}</h6>
                        <a href="{{ route('admin.users.send_bonus', ['id' => $user->id]) }}" class="btn btn-primary btn-sm mr-1 pr-3">Send Bonus </a>
                        <a href="{{ route('admin.users.edit', ['id' => $user->id]) }}" class="btn btn-primary btn-sm mr-1">Edit</a>
                    </div>

                    <!-- profile  -->
                    <div class="mt-5 pt-2 border-top">
                        <h4 class="mb-3 font-size-15">About</h4>
                        <p class="text-muted mb-4">{{ $user->about }}</p>
                    </div>
                    <div class="mt-3 pt-2 border-top">
                        <h4 class="mb-3 font-size-15">Contact Information</h4>
                        <div class="table-responsive">
                            <table class="table table-borderless mb-0 text-muted">
                                <tbody>
                                <tr>
                                    <th scope="row">Email</th>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Phone</th>
                                    <td>{{ $user->phone }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Address</th>
                                    <td>{{ $user->location }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Registered At</th>
                                    <td>{{ $user->created_at }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="mb-xl-5"></div>
                </div>
            </div>
            <!-- end card -->
        </div>
        <div class="col-lg-9">
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div class="col-sm-12">
                            <form method="post" action="{{ route('admin.users.send_message', ['id' => $user->id]) }}">
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
                            </div>
                 </div>
                                </div>
                            <
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
