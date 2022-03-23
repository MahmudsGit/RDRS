@extends('layouts.backend.home')
@push('css')

@endpush
@section('content')

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Page Form</h3>
                </div>

                <div class="title_right">
                    <div class="pull-right">
                        <a href="{{ route('page.index') }}" class="btn btn-outline-info btn-sm"><i class="fa fa-eye"></i> All Pages </a>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Create New Page <small>New Page Form</small></h2>
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
                            <form action="{{ route('page.store') }}" method="POST" enctype="multipart/form-data" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                @csrf
                                <div class="item form-group">
                                    <label class="col-form-label col-md-2 col-sm-2 label-align" for="name">Page Name <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-9 ">
                                        <input type="text" id="name" name="name" class="form-control ">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-form-label col-md-2 col-sm-2 label-align" for="details">Page Details <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-9 ">
                                        <textarea id="mytextarea" name="details" class="form-control" placeholder="Page Description (Browser May doesn't Support Direct Access to Clipboard / Ctrl+V Keyboard Shortcuts instead.)"></textarea>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-form-label col-md-2 col-sm-2 label-align" for="page_image">Page Image <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-9 ">
                                        <input type="file" id="page_image" name="page_image"  class="form-control ">
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="item form-group pull-right">
                                    <div class="col-md-12 col-sm-12">
                                        <a href="{{ route('page.index') }}" class="btn btn-secondary" type="button">Back</a>
                                        <button class="btn btn-primary" type="reset">Reset</button>
                                        <button type="submit" name="submit" class="btn btn-success">Save Page</button>
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
    <script src="https://cdn.tiny.cloud/1/biwmgrfmxy8b3t7jcor3p8tv6kmin5vzka4yi9b770ruvrje/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#mytextarea'
        });
    </script>
@endpush
