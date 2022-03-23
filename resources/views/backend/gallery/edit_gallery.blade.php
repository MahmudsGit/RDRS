@extends('layouts.backend.home')
@push('css')

@endpush
@section('content')

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Gallery Form</h3>
                </div>
                <div class="title_right">
                    <div class="pull-right">
                        <a href="{{ route('gallery.index') }}" class="btn btn-outline-info btn-sm"><i class="fa fa-eye"></i> All Galleries </a>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Update New Gallery <small>Update Gallery Image Form</small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a class="dropdown-item" href="#">Settings 1</a></li>
                                        <li><a class="dropdown-item" href="#">Settings 2</a></li>
                                    </ul>
                                </li>
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br />
                            <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

                                @csrf
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="gallery_name">Gallery Name <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="gallery_name" name="gallery_name" class="form-control" value="{{ $gallery->gallery_name }}">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="gallery_title">Gallery Title <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="gallery_title" name="gallery_title" class="form-control" value="{{ $gallery->gallery_title }}">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="image">Images <small>(Multiple) </small><span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="file" id="image" name="image[]"  class="form-control" multiple>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="image">Previous Gallery<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <?php
                                        $images =  (array)json_decode($gallery->image)
                                        ?>
                                        @foreach($images as $image)
                                            <div class="col-md-2 col-sm-2 view-first">
                                                <img src="{{ asset('storage/images/gallery').'/'.$image }}" height="50px" width="80px"  alt="image" />
                                            </div>

                                        @endforeach
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="item form-group pull-right">
                                    <div class="col-md-12 col-sm-12">
                                        <a href="{{ route('gallery.index') }}" class="btn btn-secondary" type="button">Back</a>
                                        <button type="submit" name="submit" class="btn btn-success">Update Gallery</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('js')

@endpush
