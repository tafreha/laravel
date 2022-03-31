<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rules\Password;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\File;


class userController extends Controller
{


    public function index(){
        // code .....



        $data = User :: get();

        return view('user.index',['data' => $data]);


    }


#############################################################################################################



   public function Create(){
       return view('user.create');
   }


#############################################################################################################

   public function Store(Request $request){
       // code ......

       $data = $this->validate($request,[
          "name"   => "required|min:3",
          "email"  => "required|email|unique:users",
          "password" => ["required",Password::min(6)->letters()]
       ]);


       $data['password'] = bcrypt($data['password']);

      $op =   user :: create($data);

      if($op){
          $message = 'Raw Inserted';
      }else{
          $message = 'Error Try Again';
      }


    // session()->put('Message2',"test Message 2 ");    // $_SESSION['Message'] = $message;

    session()->flash('Message',$message);

    return redirect(url('/user/'));

   }


#############################################################################################################


  public function edit($id){

        $data = user  :: find($id);  // dd($data->name);

     return view('user.edit',['data' => $data]);
  }


#############################################################################################################


  public function update (Request $request,$id){

     // code ......

      $data = $this->validate($request,[
          "name" => "required",
          "email" => "required|email"
      ]);


       $op = user :: where('id',$id)->update($data);

       if($op){
          $message = "Raw Updated";
       }else{
           $message = "Error Try Again";
       }


       session()->flash('Message',$message);

    return redirect(url('/user/'));

  }

#############################################################################################################



   public function delete($id){
       // code ...
   // delete from users where id = 1

   $op = user :: where('id',$id)->delete();


   if($op){
     $message = 'Raw Removed';
   }else{
      $message = 'Error Try Again';
   }


   session()->flash('Message',$message);

    return redirect(url('/user/'));



   }

#############################################################################################################

public function login(){
    return view('user.login');
}

#############################################################################################################

public function doLogin(Request $request){

      // code ....

      $data = $this->validate($request,[
        "email"  => "required|email",
        "password" => ["required",Password::min(6)->letters()]
     ]);


     if(auth()->attempt($data)){

        return  redirect(url('/user/'));
     }else{
         session()->flash('Message','Error IN yOUR Cred Try Again');
         return  redirect(url('/Login/'));
     }


}

#############################################################################################################
public function logOut(){
    // code ....

       auth()->logout();
       return  redirect(url('/Login/'));

}


}
