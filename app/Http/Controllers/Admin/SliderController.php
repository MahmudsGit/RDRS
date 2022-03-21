<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Image;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders  = Slider::latest()->get();
        return view('backend.slider.all_slider',compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.slider.create_slider');
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
           'title'=>'required',
           'subtitle'=>'required',
           'slider_image'=>'required|mimes:jpg,png,jpeg,bmp',
           'link'=>'required',
           'link_name'=>'required',
           'status'=>'required'
        ]);

        $slider_image = $request->file('slider_image');
        $slider_slug = Str::slug($request->title);
        if (isset($slider_image)){
            $image_name = $slider_slug.'-'.uniqid().'-'.uniqid().'.'.$slider_image->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('images/slider')){
                Storage::disk('public')->makeDirectory('images/slider');
            }
            $slider_image_make = Image::make($slider_image)->resize(1600,1000)->save($image_name);
            Storage::disk('public')->put('images/slider/'.$image_name,$slider_image_make);
        }else{
            $image_name = 'default_slider.png';
        }

        $slider = new Slider();
        $slider->title = $request->title;
        $slider->subtitle = $request->subtitle;
        $slider->slider_image = $image_name;
        $slider->link = $request->link;
        $slider->link_name = $request->link_name;
        $slider->status = $request->status;
        $slider->save();

        Toastr::success('Slider Save Success','Success');
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
        $slider = Slider::find($id);
        return view('backend.slider.edit_slider',compact('slider'));
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
        $this->validate($request, [
            'title'=>'required',
            'subtitle'=>'required',
            'slider_image'=>'mimes:jpg,png,jpeg,bmp',
            'link'=>'required',
            'link_name'=>'required',
            'status'=>'required'
        ]);

        $slider = Slider::find($id);
        $slider_image = $request->file('slider_image');
        $slider_slug = Str::slug($request->title);
        if (isset($slider_image)){
            $image_name = $slider_slug.'-'.uniqid().'-'.uniqid().'.'.$slider_image->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('images/slider')){
                Storage::disk('public')->makeDirectory('images/slider');
            }
            if (Storage::disk('public')->exists('images/slider/'.$slider->slider_image)){
                Storage::disk('public')->delete('images/slider/'.$slider->slider_image);
            }
            $slider_image_make = Image::make($slider_image)->resize(1600,1000)->save($image_name);
            Storage::disk('public')->put('images/slider/'.$image_name,$slider_image_make);
        }else{
            $image_name = $slider->slider_image;
        }


        $slider->title = $request->title;
        $slider->subtitle = $request->subtitle;
        $slider->slider_image = $image_name;
        $slider->link = $request->link;
        $slider->link_name = $request->link_name;
        $slider->status = $request->status;
        $slider->save();

        Toastr::success('Slider Updated Success','Success');
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
        $slider = Slider::find($id);

        if (Storage::disk('public')->exists('images/slider/'.$slider->slider_image)){
            Storage::disk('public')->delete('images/slider/'.$slider->slider_image);
        }
        $slider->delete();

        Toastr::success('Slider Deleted Success','Success');
        return redirect()->back();
    }
}
