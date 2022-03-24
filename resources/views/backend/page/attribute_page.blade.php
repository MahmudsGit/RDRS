@extends('layouts.backend.home')
@push('css')

@endpush
@section('content')

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Page Attribute</h3>
                </div>

                <div class="title_right">
                    <div class="pull-right">
                        <a href="{{ route('page.index') }}" class="btn btn-outline-info btn-sm"><i class="fa fa-eye"></i> Pages </a>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Select Page Attribute<small>Page Attribute Form</small></h2>
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
                            <form action="" method="POST" enctype="multipart/form-data" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                @csrf
                                @method('PUT')
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Select Page <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <select class="form-control text-center">
                                            @foreach($pages as $page)
                                            <option value="{{ $page->id }}" {{ $page->id == $single_page->id ? 'selected' : '' }} >{{ $page->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="status">Visible Slider <span class="required">?</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        Checked: <input type="radio" class="flat form-control" name="status" id="status" value="1"  />
                                        Unchecked: <input type="radio" class="flat form-control" name="status" id="status" value="0" checked="" required />
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Select Gallery <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <select class="form-control text-center">
                                            @foreach($galleries as $gallery)
                                                <option value="{{ $gallery->id }}" }} >{{ $gallery->gallery_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="ln_solid"></div>
                                <div class="item form-group">
                                    <div class="col-md-6 col-sm-6 offset-md-3">
                                        <a href="{{ route('page.index') }}" class="btn btn-secondary" type="button">Back</a>
                                        <button type="submit" name="submit" class="btn btn-success">Set Attribute</button>
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
