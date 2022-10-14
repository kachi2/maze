@extends('layouts.admin', ['page_title' => 'Site settings'])
@section('content')
  <div class="nk-content nk-content-fluid">
                    <div class="container-xl wide-lg">
                        <div class="nk-content-body">
                            <div class="components-preview wide-md mx-auto">
                                 <div class="nk-block-head">
                                <div class="nk-block-between-md g-4">
                                    <div class="nk-block-head-content">
                                        <h5 class="nk-block-title fw-normal">Wallet Address Settings</h5>
                                        
                                    </div>
                                    <div class="nk-block-head-content">
                                        <ul class="nk-block-tools gx-3">
                                           
                                       </ul>
                                    </div>
                                </div>
                            </div>
    <div class="body-content row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{ route('admin.setting') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                        {{-- <div class="row  no-gutters mb-1">
                            <div class="col-5 col-sm-4">
                                Site Title:
                            </div><!-- col-4 -->
                            <div class="col-7 col-sm-8">
                                <input class="form-control {{ form_invalid('title') }}" type="text"
                                       name="title" placeholder="Title"
                                       value="{{ old('title', config('app.name')) }}">
                                @showError('title')
                            </div><!-- col-8 -->
                        </div><!-- row --> --}}
                        {{-- <div class="row  no-gutters mb-1">
                            <div class="col-5 col-sm-4">
                                Site Description:
                            </div><!-- col-4 -->
                            <div class="col-7 col-sm-8">
                                <input class="form-control {{ form_invalid('description') }}"
                                       type="text" name="description"
                                       placeholder="Description"
                                       value="{{ old('description', config('app.description')) }}">
                                @showError('description')
                            </div><!-- col-8 -->
                        </div><!-- row --> --}}
                        <div class="card card-preview">
                            <div class="card-inner">
                                <div class="preview-block">
                                    <span class="preview-title-lg overline-title">Application Settings</span>
                                    <div class="row gy-4">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Application Name</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control {{ form_invalid('title') }}" name="title" value="{{ old('title', config('app.name')) }}" id="default-01" placeholder="App Name">
                                                </div>
                                            </div>
                                            @showError('title')
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label" for="default-05">Application Description</label>
                                                <div class="form-control-wrap">
                                                   
                                                    <input type="text" class="form-control {{ form_invalid('description') }}" value="{{ old('description', config('app.description')) }}" id="default-05" placeholder="Enter description">
                                                </div>
                                            </div>
                                            @showError('description')
                                        </div>
                                        <hr class="preview-hr">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label" for="default-03">Enter Wallet Name</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="name" value="{{old('name')}}" class="form-control {{ form_invalid('name') }}" id="default-03" placeholder="E.g BTC">
                                                </div>
                                                @showError('name')
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" for="default-06">Upload Wallet Barcode</label>
                                                <div class="form-control-wrap">
                                                    <div class="custom-file">
                                                        <input type="file" name="barcode" class="custom-file-input" id="customFile">
                                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-6">
                                            
                                            <div class="form-group">
                                                <label class="form-label" for="default-04">Enter Wallet Address</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="address" value="{{old('address')}}" class="form-control {{ form_invalid('address') }}" id="default-04" placeholder="Wallet Address">
                                                </div>
                                                @showError('address')
                                            </div>

                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-block btn-primary mt-4">Update</button>
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
let msg = {!! json_encode(Session::get('msg')) !!};

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