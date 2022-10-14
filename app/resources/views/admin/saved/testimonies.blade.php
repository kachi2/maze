@extends('layouts.admin', ['page_title' => 'Testimonies'])
@section('content')
       <div class="nk-content nk-content-fluid">
                     <div class="nk-content-body">
                            <div class="nk-block-head">
                                <div class="nk-block-between-md g-4">
                                    <div class="nk-block-head-content">
                                        <h5 class="nk-block-title fw-normal">Testimony</h5>
                                        
                                    </div>
                                    <div class="nk-block-head-content">
                                        <ul class="nk-block-tools gx-3">
                                            <li class="order-md-last">
                                                 <a href="{{ route('admin.testimonies.add') }}" class="btn btn-primary"><i
                                    class='uil uil-plus mr-1'></i>Submit New Testimony</a>
                       
                                            </li>
                                       </ul>
                                    </div>
                                </div>
                            </div><!-- .nk-block-head -->
                        <div class="components-preview wide-md mx-auto">
                         <div class="nk-block nk-block-lg"> 
                                    <div class="card card-preview">
                                        <div class="card-inner">
                                            <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                                                <thead>
                                                    <tr class="nk-tb-item nk-tb-head">
                                                       
                                                     
                                                              <th class="nk-tb-col"><span class="sub-text">User</th>
                                                            <th class="nk-tb-col"><span class="sub-text">Message</th>
                                                            <th class="nk-tb-col"><span class="sub-text">Status</th>
                                                            <th class="nk-tb-col"><span class="sub-text">Date</th>
                                                            <th class="nk-tb-col"><span class="sub-text">Action</th>
                                                            
                                                        
                                                    </tr>
                                                </thead>
                                          
                                                 <tbody>
                                    @forelse($testimonies as $testimony)
                                        <tr>
                                            <td  class="nk-tb-col"> {{ $testimony->user_name }}</p> </td>
                                            <td  class="nk-tb-col">{{ $testimony->message }}</p> </td>
                                            <td  class="nk-tb-col">
                                                @if( $testimony->status == 1)
                                                    <span class="badge badge-pill badge-success">Approved</span>
                                                @else
                                                    <span class="badge badge-pill badge-warning">Pending</span>
                                                @endif
                                            </td>
                                             <td  class="nk-tb-col">{{ $testimony->created_at }}</td>
                              <td class="nk-tb-col nk-tb-col-tools">
                                            <ul class="nk-tb-actions gx-1"> 
                                                <li>
                                                    <div class="drodown">
                                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <ul class="link-list-opt no-bdr">   
                                                            <form id="formApprove" action="{{ route('admin.testimonies.approve', ['id' => $testimony->id]) }}" method="post">
                                                                @csrf
                                                                </form>
                                                                 <form id="formDisapprove" action="{{ route('admin.testimonies.disapprove', ['id' => $testimony->id]) }}" method="post">
                                                                @csrf
                                                                </form>
                                                                 <form id="formDelete" action="{{ route('admin.testimonies.delete', ['id' => $testimony->id]) }}" method="post">
                                                                @csrf
                                                                </form>
                                                                @if( $testimony->status == 0)
                                                                <li><a href="" onclick="markApproved(); event.preventDefault()" >
                                                                <em class="icon ni ni-focus"></em><span>Approve</span></a></li>
                                                                @else
                                                                <li><a href="" onclick="markDisapproved(); event.preventDefault()">
                                                                <em class="icon ni ni-focus"></em><span>Disapprove</span></a></li></a> </li>
                                                                @endif
                                                                <li><a href="{{ route('admin.testimonies.edit', ['id' => $testimony->id]) }}">
                                                                 <em class="icon ni ni-focus"></em><span>Edit</span></a></li> </a> </li>
                                                               <li><a href="" onclick="deleteTestimony(); event.preventDefault()">
                                                                <em class="icon ni ni-focus"></em><span>Delete</span></a></li> </a> </li>
                                                            </ul>
                                                        </div>
                                                                 </div>
                                                                </li>
                                                            </ul>
                                                        </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td><span>No Testimony Yet!</span>
                                            <td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                            </table>
                                        </div>
                                    </div><!-- .card-preview -->
                                </div> 
                                </div>
                         



                        </div>
                    </div>
               
@endsection
@section('scripts')
    <script>
         function markApproved(url) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, mark approved!',
                cancelButtonText: 'No, cancel!'
            }).then(function (result) {
                if (result.value) {
                    document.getElementById('formApprove').submit();
                }
            });
        }

        function markDisapproved(url) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, mark disapproved!',
                cancelButtonText: 'No, cancel!'
            }).then(function (result) {
                if (result.value) {
                     document.getElementById('formDisapprove').submit();
                }
            });
        }

        function deleteTestimony(url) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Delete!',
                cancelButtonText: 'No, cancel!'
            }).then(function (result) {
                if (result.value) {
                      document.getElementById('formDelete').submit();
                }
            });
        }

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
