<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::latest()->get();
        return view('backend.page.all_page',compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.page.create_page');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
           'name'=>'required',
           'details'=>'required',
           'page_image'=>'required|mimes:jpg,png,jpeg,bmp'
        ]);

        $page_image = $request->file('page_image');
        $slug = Str::slug($request->name);
        if (isset($page_image)){
            $current_date = Carbon::now()->toDateString();
            $image_name = $slug.'-'.$current_date.'-'.uniqid().'.'.$page_image->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('images/page')){
                Storage::disk('public')->makeDirectory('images/page');
            }
            $page_image_make = Image::make($page_image)->resize(600,400)->save($image_name);
            Storage::disk('public')->put('images/page/'.$image_name,$page_image_make);
        }else{
            $image_name = 'default_page.png';
        }

        $page = new Page();
        $page->name = $request->name;
        $page->slug = Str::slug($request->name);
        $page->details = $request->details;
        $page->page_image = $image_name;
        $page->save();
        Toastr::success('Page Save Success','Success');
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pages = Page::latest()->get();
        $single_page = Page::find($id);
        return view('backend.page.attribute_page',compact('pages','single_page'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = Page::find($id);
        return view('backend.page.edit_page',compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'=>'required',
            'details'=>'required',
            'page_image'=>'mimes:jpg,png,jpeg,bmp'
        ]);

        $page = Page::find($id);

        $page_image = $request->file('page_image');
        $slug = Str::slug($request->name);
        if (isset($page_image)){
            $current_date = Carbon::now()->toDateString();
            $image_name = $slug.'-'.$current_date.'-'.uniqid().'.'.$page_image->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('images/page')){
                Storage::disk('public')->makeDirectory('images/page');
            }
            if (Storage::disk('public')->exists('images/page'.'/'.$page->page_image)){
                Storage::disk('public')->delete('images/page'.'/'.$page->page_image);
            }
            $page_image_make = Image::make($page_image)->resize(600,400)->save($image_name);
            Storage::disk('public')->put('images/page/'.$image_name,$page_image_make);
        }else{
            $image_name = $page->page_image;
        }

        $page->name = $request->name;
        $page->slug = $slug;
        $page->details = $request->details;
        $page->page_image = $image_name;
        $page->save();

        Toastr::success('Page Updeted Success','Success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Page::find($id);
        if (Storage::disk('public')->exists('images/page'.'/'.$page->page_image)){
            Storage::disk('public')->delete('images/page'.'/'.$page->page_image);
        }
        $page->delete();

        Toastr::success('Page Deleted Success','Success');
        return redirect()->back();

    }

}
