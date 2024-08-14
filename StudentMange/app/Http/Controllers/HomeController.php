<?php

namespace App\Http\Controllers;

use App\Models\Home;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Str;
use thiagoalessio\TesseractOCR\TesseractOCR;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function view_blade()
    {
        $all_infos=Home::all();
        $all_count=Home::all()->count();
        return view('view',['all_count'=>$all_count,'all_infos'=>$all_infos]);
    }
    public function insert_blade()
    {
        return view('insert');
    }
    public function this_person_info($id)
    {
        $info_this=Home::find($id);
        return view('this_person_info',['info_this'=>$info_this]);
    }
    public function edit_blade($id)
    {
        $info_this_edit=Home::find($id);
        return view('edit_blade',['info_this_edit'=>$info_this_edit]);
    }
    function insert_information(Request $request)
    {
        // $imagePath = $request->image;
        // $tesseract = new TesseractOCR($imagePath);
        // $tesseract->lang('eng');
        // $text = $tesseract->run();
        
        // echo $text;
        $image_name = str_replace('', '-', str::lower($request->name)) . '-' . rand(1000000, 99999999);
        $upload_file = $request->image;
        $extension = $upload_file->getClientOriginalExtension();
        $manager = new ImageManager(new Driver());
        $new_name = $image_name . "." . $extension;
        $img = $manager->read($upload_file);
        $img->tojpeg(200)->save(base_path('public/student_image/' . $new_name));
        Home::insert([
            'auth_name' => $request->auth_name,
            'name' => $request->name,
            'email' => $request->email,
            'f_name' => $request->f_name,
            'm_name' => $request->m_name,
            'address' => $request->address,
            'subject' => $request->subject,
            'tuition_fee' => $request->tuition_fee,
            'contact' => $request->contact,
            'image' => $new_name,
            'created_at' => now(),

        ]);
      
        return back();
       
    }
    function edit_information(Request $request)
    {
        $image_delete = Home::where('id', $request->id)->first()->image;
        $delete_for_file = public_path('student_image/' . $image_delete );
      unlink($delete_for_file);
        $image_name = str_replace('', '-', str::lower($request->name)) . '-' . rand(1000000, 99999999);
        $upload_file = $request->image;
        $extension = $upload_file->getClientOriginalExtension();
        $manager = new ImageManager(new Driver());
        $new_name = $image_name . "." . $extension;
        $img = $manager->read($upload_file);
        $img->tojpeg(200)->save(base_path('public/student_image/' . $new_name));
        Home::find($request->id)->update([
            'auth_name' => $request->auth_name,
            'name' => $request->name,
            'email' => $request->email,
            'f_name' => $request->f_name,
            'm_name' => $request->m_name,
            'address' => $request->address,
            'subject' => $request->subject,
            'tuition_fee' => $request->tuition_fee,
            'contact' => $request->contact,
            'image' => $new_name,
            'updated_at' => now(),

        ]);
      
        return back();
       
    }
    function delete_blade($id)
    {
        $image_delete = Home::where('id', $id)->first()->image;
        $delete_for_file = public_path('student_image/' . $image_delete );
        unlink($delete_for_file);
        Home::find($id)->delete();
        return back();
       
    }
}
