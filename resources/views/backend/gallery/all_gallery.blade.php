@extends('layouts.backend.home')
@push('css')

@endpush
@section('content')

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3> Media Gallery <small> All gallery </small> </h3>
                </div>

                <div class="title_right">
                    <div class="pull-right">
                        <a href="{{ route('gallery.create') }}" class="btn btn-outline-info btn-sm"><i class="fa fa-plus"></i> Create New Gallery </a>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>
            @foreach($galleries as $gallery)
            <div class="row">
                <div class="col-md-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>{{ $gallery->gallery_name }} Gallery <small> {{ $gallery->gallery_title }}</small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li>
                                    <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li>
                                    <a href="{{ route('gallery.edit',$gallery->id ) }}" class="#"><i class="fa fa-pencil"></i></a>
                                </li>
                                <li>
                                    <a onclick="deleteGallery({{ $gallery->id }})" class=""><i class="fa fa-close"></i></a>
                                    <form id="delete-form-{{$gallery->id}}" action="{{ route('gallery.destroy',$gallery->id ) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="row">
                                <?php
                                $images =  (array)json_decode($gallery->image)
                                ?>
                                @foreach($images as $image)
                                <div class="col-md-55">
                                    <div class="thumbnail">
                                        <div class="image view view-first">
                                            <img style="width: 100%; display: block;" src="{{ asset('storage/images/gallery').'/'.$image }}" alt="image" />
                                            <div class="mask">
                                                <p>{{ $gallery->gallery_title }}</p>
                                                <div class="tools tools-bottom">
                                                    <a href="#"><i class="fa fa-search-plus"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

@endsection
@push('js')
    <script src="{{ asset('backend/build/js/sweetalert2.js') }}"></script>
    <script type="text/javascript">
        function deleteGallery(id) {
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
