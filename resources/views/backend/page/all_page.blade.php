@extends('layouts.backend.home')
@push('css')

@endpush
@section('content')

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>All Page <small>Listing All Pages</small></h3>
                </div>

                <div class="title_right">
                    <div class="pull-right">
                        <a href="{{ route('page.create') }}" class="btn btn-outline-info btn-sm"><i class="fa fa-plus"></i> Create New Page </a>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Pages</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#">Settings 1</a>
                                        <a class="dropdown-item" href="#">Settings 2</a>
                                    </div>
                                </li>
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">

                            <p>Page table with Page listing with Delete, View and editing options</p>

                            <!-- start project list -->
                            <table class="table table-striped projects">
                                <thead>
                                <tr>
                                    <th style="width: 1%">Serial</th>
                                    <th>Page Name</th>
                                    <th style="width: 20%">Page Details</th>
                                    <th>Page Image</th>
                                    <th>Created At</th>
                                    <th>Page Attribute</th>
                                    <th style="width: 20%">Edit</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($pages as $key=>$page)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        <a href="#">{{ $page->name }}</a>
                                        <br />
                                        <small>Created by Admin</small>
                                    </td>
                                    <td>
                                        <a href="#">{!! Str::limit($page->details, 60, '...') !!}</a>
                                    </td>
                                    <td>
                                        <img src="{{ asset('storage/images/page').'/' }}{{$page->page_image}}" width="80px" height="40px">
                                    </td>
                                    <td>
                                        <span  class="bg-light">{{ $page->created_at->toFormattedDateString() }}</span>
                                    </td>
                                    <td>
                                        <span>{{ $page->name }} Page Attribute</span>
                                            <br />
                                            <a href="{{ route('page.show',$page->id) }}" class="btn btn-outline-success btn-sm"><small><i class="fa fa-pencil"></i> Edit Attribute</small>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('page.edit',$page->id ) }}" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i> Edit </a>
                                        <button type="button" onclick="deletePage({{ $page->id }})" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> Delete </button>
                                        <form id="delete-form-{{$page->id}}" action="{{ route('page.destroy',$page->id ) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <!-- end project list -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('js')
    <script src="{{ asset('backend/build/js/sweetalert2.js') }}"></script>
    <script type="text/javascript">
        function deletePage(id) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it !',
                cancelButtonText: 'No, cancel !',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    event.preventDefault();
                    document.getElementById('delete-form-'+id).submit();

                    swalWithBootstrapButtons.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )

                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your file is safe :)',
                        'error'
                    )
                }
            })
        }
    </script>
@endpush
