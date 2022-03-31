<?php

namespace App\Http\Controllers;
use  App\Http\Middleware\userCheckLogin;


use Illuminate\Http\Request;

use App\Models\File;
use Carbon\Carbon;


class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = File ::join('users','users.id','=','blogs.addedBy')->select('blogs.*','users.name as username')->where('addedBy',auth()->user()->id)->get();

        return view('blogs.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

         $title = "Blog|Create";

         return View('blogs.create',compact('title'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      $data = $this->validate($request , [
          'title'   => "required",
          "content" => "required|min:100",
          "start_date" => "required|date|after:yesterday",
           "end_date"    => "required|date|after:today",
          "image"   => "required|image|mimes:png,jpg"
      ]);

      $FileName = time().rand().'.'.$request->image->extension();
      if($request->image->move(public_path('blogs'),$FileName)){
            // code .....

            $data['image'] = $FileName;
            $data['addedBy'] = auth()->user()->id;
            $data['start_date']  = strtotime($data['start_date']);
            $data['end_date']  = strtotime($data['end_date']);

            $op =  File :: create($data);

            if($op){
                $message = "Raw Inserted";
            }else{
                $message = "Error Try Again";
            }


         }else{
             $Message = "Error In Uploading Image Try Again";
         }

         session()->flash('Message',$message);
         return redirect(url('/Blog'));

    }

    /*
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
            echo 'show';
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

         $data = File::find($id);

         return view('blogs.edit',compact('data'));
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

        $data = $this->validate($request , [
            'title'   => "required",
            "content" => "required|min:100",
            "start_date"    => "required|date|after:yesterday",
            "end_date"    => "required|date|after:today",

            "image"   => "nullable|image|mimes:png,jpg,jpeg"
        ]);

         # Fetch Data
         $Raw = File::find($id);

          if($request->hasFile('image')){

            $FileName = time().rand().'.'.$request->image->extension();
            if($request->image->move(public_path('blogs'),$FileName)){

                unlink(public_path('blogs/'.$Raw->image));
            }

           $data['image'] =  $FileName;

          }else{
           $data['image'] = $Raw->image;
          }


          $data['start_date']   = strtotime($data['start_date']);
          $data['end_date']    = strtotime($data['end_date']);

         $op =  File :: where('id',$id)->update($data);

         if($op){
             $message = "Raw Updated";
         }else{

            $message = "Error Try Again";
        }

        session()->flash('Message',$message);

        return redirect(url('/Blog'));


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $data = File::find($id);

                $op = File::where('id',$id)->delete();

                if($op){
                    unlink(public_path('blogs/'.$data->image));
                    $message = "Raw Removed";
                }else{
                    $message = "Error Try Again";
                }

                 session()->flash('Message',$message);

                 return redirect(url('/Blog'));


    }
}
