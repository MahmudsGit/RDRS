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
                                            <option>-- None --</option>
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
                                            <option>-- None --</option>
                                            <option>Gallery one</option>
                                            <option>Gallery two</option>
                                            <option>Gallery three</option>
                                            <option>Gallery four</option>
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

@endpush
