<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Role;
use App\Models\User;
use Hash;
use Bouncer;
use Session;
use Auth;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 

      Controller::has_ability('View_User');
      $data['users']=User::all();
      $data['spaces']=Role::all();
      return view('users.index',$data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Controller::has_ability('Create_User');

            if(Auth::user()->can('Create_Role')){
                $data['roles']=Role::all();  
            }else{
                $data['roles']=Role::where('id','<>',1)->get();  
            }
     


        return view('users.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Controller::has_ability('Create_User');
        $this->validate($request,[           
            'name' => 'required|string|max:255',
            'role_id' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            
        ]);

         $password = Str::random(10);
         $request->merge(['password' => Hash::make($password)]);
         $user= User::create($request->all());

     
       $role=Bouncer::role()->find($request->role_id);

      
        Bouncer::assign($role)->to($user);

        $msg="Your registration was successful. Your password is ".$password.".You may have to change your password to one that you can remember.";

      

         Session::flash('alert-success', 'User has been created but password could not be sent via email. The password is '.$password);



       return redirect('users'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
         Controller::has_ability('View_User');
  

        $data['user']=$user;

        return view('users.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        Controller::has_ability('Edit_User');
        $user=User::find($id);
        $data['roles']=Role::all();

        if(Auth::user()->can('Create_Role')){
                $data['roles']=Role::all();  
            }else{
                $data['roles']=Role::where('id','<>',1)->get();  
            }

        $data['user']=$user;

        return view('users.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       Controller::has_ability('Edit_User');
        $user=User::find($id); 

        $this->validate($request,[           
            'name' => 'required|string|max:255',
            'role_id' => 'required',
            'email' => 'required|string|email|max:255',
            
        ]);


        $user->update($request->all());

        $user->roles()->detach();

        $role=Bouncer::role()->find($request->role_id);

        Bouncer::assign($role)->to($user);

        Session::flash('alert-success', 'User has been updated');

        return redirect('users'); 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Controller::has_ability('Delete_User');
         $user=User::find($id);
         $user->delete();

        Session::flash('alert-danger', 'User has been deleted');

         return redirect('users');
   
    }


    public function profile()
    {

        $data['user']=Auth::user();

        return view('users.profile',$data);
        
      
    }

    public function profile_edit()
    {
        
        $data['user']=Auth::user();

        return view('users.profile_edit',$data);
    }

    public function profile_update(Request $request)
    {
        $user=Auth::user();

        $user->update($request->all());

        return redirect('users/profile');
      
    }

    public function password_edit()
    {
        $data['user']=Auth::user();

        return view('users.password_edit',$data);;
      
    }

    public function password_update(Request $request)
    {
        $user=Auth::user();
         $this->validate($request,[
            'password' => 'required|string|min:6|confirmed',
        ]);

         


     if (Hash::check($request->current_password, $user->password)) { 
                  
         $user->update(['password' => bcrypt($request->password)]);

               Session::flash('alert-success','Password changed');
                return redirect('home');

            } else {
        
                Session::flash('alert-warning','Password does not match');
               return redirect('users/password-edit');
            }


    }

    public function password_reset($email,$id)
    {         
       Controller::has_ability('Edit_User');
        
       $user=User::find($id);

      
       $password = Str::random(10);

       $user->update(['password'=>Hash::make($password)]);



        $msg="Your password has been reset. Your  new password is ".$password.".You may have to change your password to one that you can remember.";

       
           
       Session::flash('alert-success', 'Password has been reset . The new password is '.$password);

     
      

     return redirect('users'); 
    }

    public function switch_user(Request $request)
    {   

        Controller::has_ability('Edit_User');
        $user = User::where('email','=',$request->as_username)->first();
          
          if(!is_null($user)){

                Auth::logout();
                Auth::login($user);      
               return redirect('home'); 
          }else{

            Session::flash('alert-danger', 'There is no user with that email');

            return redirect()->back();

          }
       
    }

     /*TOTAL USERS*/
        public function users_count()
        {

            return User::count();

        }
    /*END*/


}
