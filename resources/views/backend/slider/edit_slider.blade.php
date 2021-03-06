@extends('layouts.backend.home')
@push('css')

@endpush
@section('content')

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Edit slider Form</h3>
                </div>

                <div class="title_right">
                    <div class="pull-right">
                        <a href="{{ route('slider.index') }}" class="btn btn-outline-info btn-sm"><i class="fa fa-eye"></i> All sliders </a>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Update slider <small>Update slider Form</small></h2>
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
                            <form action="{{ route('slider.update',$slider->id) }}" method="POST" enctype="multipart/form-data" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                @csrf
                                @method('PUT')
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="title">Slider Title <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="title" name="title" class="form-control" value="{{ $slider->title }}">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="subtitle">Slider Sub-Title <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="subtitle" name="subtitle" class="form-control" value="{{ $slider->subtitle }}">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="slider_image">Slider Image <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="file" id="slider_image" name="slider_image"  class="form-control ">
                                        <img src="{{ asset('storage/images/slider').'/' }}{{$slider->slider_image}}" width="80px" height="40px">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="link_name">Slider Link Name <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="link_name" name="link_name" class="form-control" value="{{ $slider->link_name }}">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="link">Slider Link <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6">
                                        <input type="text" id="link" name="link" class="form-control" value="{{ $slider->title }}">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="status">Status <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        Visible: <input type="radio" class="flat form-control" name="status" id="status" value="1"  {{ $slider->status==1 ? 'checked' : '' }} />
                                        Hidden: <input type="radio" class="flat form-control" name="status" id="status" value="0" {{ $slider->status==0 ? 'checked' : '' }} />
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="item form-group pull-right">
                                    <div class="col-md-12 col-sm-12">
                                        <a href="{{ route('slider.index') }}" class="btn btn-secondary" type="button">Back</a>
                                        <button type="submit" name="submit" class="btn btn-success">Update Slider</button>
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
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
        tinymce.init({
            selector: '#mytextarea'
        });
    </script>
@endpush
