@extends('layouts.admin', ['page_title' => 'Packages'])
@section('content')

    <div class="nk-content nk-content-fluid">
                    <div class="container-xl wide-lg">
                        <div class="nk-content-body">
                            <div class="components-preview wide-md mx-auto">
                                 <div class="nk-block-head">
                                <div class="nk-block-between-md g-4">
                                    <div class="nk-block-head-content">
                                        <h5 class="nk-block-title fw-normal">Packages </h5>
                                        
                                    </div>
                                    <div class="nk-block-head-content">
                                        <ul class="nk-block-tools gx-3">
                                            <li class="order-md-last">
                                                   <a href="{{ route('admin.packages.add') }}" class="btn btn-primary"><i
                                                    class='uil uil-plus mr-1'></i>Add Package</a> </li>
                                       </ul>
                                    </div>
                                </div>
                            </div><!-- .nk-block-head -->
                                
                                <div class="nk-block nk-block-lg">
                                    <div class="card card-preview">
                                        <div class="card-inner">
                                            <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="true">
                                                <thead>
                                                    <tr class="nk-tb-item nk-tb-head">

                                                        <th class="nk-tb-col "><span class="sub-text">#Id</th>
                                                        <th class="nk-tb-col "><span class="sub-text">Package Name</th>
                                                       <th class="nk-tb-col "><span class="sub-text">Duration</th>
                                                        <th class="nk-tb-col "><span class="sub-text">Payment Period</th>
                                                        <th class="nk-tb-col "><span class="sub-text">Plans</th>
                                                        <th class="nk-tb-col "><span class="sub-text">Created At</th>
                                                        <th class="nk-tb-col "><span class="sub-text">Action</th>
                                                        <th class="nk-tb-col nk-tb-col-tools text-right"> 
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                              @forelse($packages as $package)
                                        <tr>
                                            
                                            <td class="nk-tb-col ">{{ $package->id }}</th>
                                            <td class="nk-tb-col ">{{ $package->name }}</td>
                                            <td class="nk-tb-col ">{{ $package->formatted_duration }}</td>
                                            <td class="nk-tb-col ">{{ $package->formatted_payment_period }}</td>
                                            <td class="nk-tb-col ">{{ $package->plans()->count() }} Plans</td>
                                            <td class="nk-tb-col ">{{ $package->created_at }}</td>
                                            <td class="nk-tb-col nk-tb-col-tools">
                                            <ul class="nk-tb-actions gx-1"> 
                                                <li>
                                                    <div class="drodown">
                                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <ul class="link-list-opt no-bdr">   
                                                            <form id="formMark" action="{{ route('admin.packages.delete', ['id' => $package->id]) }}" method="post">
                                                                @csrf
                                                                </form>
                                                                <li><a href="{{ route('admin.packages.show', ['id' => $package->id]) }}" >
                                                                <em class="icon ni ni-focus"></em><span>View</span></a></li>
                                                                <li><a href="{{ route('admin.packages.edit', ['id' => $package->id]) }}" >
                                                                <em class="icon ni ni-user-cross-fill"></em><span>Edit</span></a></li>
                                                                <li><a href="#" onclick="event.preventDefault()"><button style="border:none; background:none" onclick="deletePackage('{{ route('admin.packages.delete', ['id' => $package->id]) }}')" >
                                                                <em class="icon ni ni-na"></em><span>Delete</span></button></li></a>
                                                                   
                                                            </ul>
                                                        </div>
                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                        @empty
                                            <tr>
                                                <td><span>No Withdrawals Yet</span>
                                                <td>
                                            </tr>
                                        @endforelse


                                                </tbody>
                                            </table>
                                        </div>
                                    </div><!-- .card-preview -->
                                </div> <!-- nk-block -->
                            </div><!-- .components-preview -->
                        </div>
                    </div>
                </div>


@endsection
@section('scripts')
    <script>
        function deletePackage(url) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You wont be able to reveres this',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if(result.value) {
                    document.getElementById('formMark').submit();
                }
            })
        }
    </script>
@endsection
