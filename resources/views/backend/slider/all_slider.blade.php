@extends('layouts.backend.home')
@push('css')

@endpush
@section('content')

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>All Slider <small>Listing All Sliders</small></h3>
                </div>

                <div class="title_right">
                    <div class="pull-right">
                        <a href="{{ route('slider.create') }}" class="btn btn-outline-info btn-sm"><i class="fa fa-plus"></i> Create New Slider </a>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Sliders</h2>
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

                            <p>Slider table with Slider listing with Delete and editing options</p>

                            <!-- start project list -->
                            <table class="table table-striped projects">
                                <thead>
                                <tr>
                                    <th style="width: 1%">Serial</th>
                                    <th>Slider Title</th>
                                    <th style="width: 20%">Slider Sub-Title</th>
                                    <th>Slider Image</th>
                                    <th>Link Name</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th style="width: 20%">Edit</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sliders as $key=>$slider)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        <a href="#">{{ $slider->title }}</a>
                                        <br />
                                        <small>Created by Admin</small>
                                    </td>
                                    <td>
                                        <a href="#">{!! Str::limit($slider->subtitle, 30, '...') !!}</a>
                                    </td>
                                    <td>
                                        <img src="{{ asset('storage/images/slider').'/' }}{{$slider->slider_image}}" width="80px" height="40px">
                                    </td>
                                    <td>
                                        <span>{{ $slider->link_name }}</span>
                                    </td>
                                    <td>
                                        @if($slider->status == 1)
                                            <span  class="btn btn-outline-info btn-sm">Visible</span>
                                        @else
                                            <span  class="btn btn-outline-secondary btn-sm">Hidden</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span  class="bg-light">{{ $slider->created_at->toFormattedDateString() }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('slider.edit',$slider->id ) }}" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i> Edit </a>
                                        <button type="button" onclick="deleteSlider({{ $slider->id }})" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> Delete </button>
                                        <form id="delete-form-{{$slider->id}}" action="{{ route('slider.destroy',$slider->id ) }}" method="POST">
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
        function deleteSlider(id) {
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
