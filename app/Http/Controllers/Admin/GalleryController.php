<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.gallery.all_gallery');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.gallery.create_gallery');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
           'gallery_name'=>'required',
           'gallery_title'=>'required',
           'image.*'=>'required|mimes:jpg,png,jpeg,bmp|'
        ]);

        $images=[];
        if ($request->hasFile('image')){
            $i = 0;
            foreach ($request->file('image') as $ImageFile){
                $current_date = Carbon::now()->toDateString();
                $image_name = $i.'-'.$current_date.'-'.uniqid().'.'.$ImageFile->getClientOriginalExtension();
                if (!Storage::disk('public')->exists('images/gallery')){
                    Storage::disk('public')->makeDirectory('images/gallery');
                }
                Image::make($ImageFile)->resize(600,400)->save('storage/images/gallery/'.$image_name);

                $images[]=$image_name;
                $i++;
            }
        }else{
            $images = 'default_gallery.png';
        }
        $gallery = new Gallery();
        $gallery->gallery_name = $request->gallery_name;
        $gallery->gallery_title = $request->gallery_title;
        $gallery->image = json_encode($images);
        $gallery->save();

        Toastr::success('Gallery Save Success','Success');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
