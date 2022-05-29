<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Project;
use Devfaysal\BangladeshGeocode\Models\Division;
use Devfaysal\BangladeshGeocode\Models\District;
use Devfaysal\BangladeshGeocode\Models\Upazila;
use Devfaysal\BangladeshGeocode\Models\Union;
use Illuminate\Support\Facades\Auth;
use Redirect;
use Session;

class UserController extends Controller
{
    public function loginRegister(){
        return view('auth.login-register');
    }

    public function loginCheck(Request $request){
       $user = User::where('email','=', $request->loginEmail)->first();

       if(!$user){
           return back()->with('fail','We do not recognize your email address');
       }else{
           //check password
           if(Hash::check($request->loginPassword, $user->password)){
               auth()->login($user);
               return redirect('dashboard')->with('success',"You have logged in successfully");
           }else{
               return back()->with('fail','Incorrect password');
           }
       }
    }

    public function loginfromoutside(){
        // dd(request()->query('url'));
        if(!Auth::check()) {
            return Redirect::route('login.register');
        }
        return Redirect::route('clientAuthorize');
    }

    public function store(Request $request){

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        auth()->login($user);

        return redirect('dashboard');
    }

    public function logout(){
        auth()->logout();
        return redirect('/');
    }

    public function dashboard(){
        $user = auth()->user();
        $divisions = Division::all();
        $districts = District::where('division_id',$user->division)->get();
        $upazilas = Upazila::where('district_id',$user->district)->get();
        $unions = Union::where('upazila_id',$user->upazila)->get();
        return view('dashboard',compact('divisions','districts','upazilas','unions','user'));
    }

    public function getDistrict($id){
        $district = District::where('division_id',$id)->orderBy('name','ASC')->get();
        return response($district);
    }

    public function getUpazila($id){
        $upazila = Upazila::where('district_id',$id)->orderBy('name','ASC')->get();
        return response($upazila);
    }

    public function getUnion($id){
        $union = Union::where('upazila_id',$id)->orderBy('name','ASC')->get();
        return response($union);
    }

    public function profileUpdate(Request $request){

        $division = Division::find($request->division);
        $district = District::where([
                        ['id',$request->district],
                        ['division_id',$request->division]])
                        ->first();

        $upazila = Upazila::where([
                        ['id',$request->upazila],
                        ['district_id',$request->district]])
                        ->first();

        $union = Union::where([
                        ['id',$request->union],
                        ['upazila_id',$request->upazila]])
                        ->first();

        $user = User::find(auth()->user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->phone =$request->phone;
        if($request->image){
            if (isset($user->avatar) && file_exists('uploads/'.$user->avatar)) {
                unlink('uploads/'.$user->avatar);
            }
            $imageName = rand(1, 1000) . time() . '.' . $request->image->extension();
            $request->image->move('uploads/', $imageName);
            $user->avatar = 'uploads/'.$imageName;
        }

        $user->nid = $request->nid;
        if($division){
            $user->division = $request->division;
        }
        if($district){
            $user->district = $request->district;
        }
        if($upazila){
            $user->upazila = $request->upazila;
        }
        if($union){
            $user->union =$request->union;
        }
        $user->village = $request->village;
        $user->update();

        return back()->with('success','your profile updated successfully');
    }

    public function authCheck(Request $request){
        Auth::loginUsingId(2);
        return Auth()->user();
        $project = Project::where([
            ['token',$request->token],
            ['status',1]]
            )->first();
            return $project;

        if(!$project){
            return response("project is not registered");
        }else{
            if(!Auth::check()) {
                return response("unauthenticated");
            }else{
                return response(Auth::user());
            }
        }
    }

    public function clientAuthorize(){
        return view('authorize');
    }

    public function test(Request $request){
        $user = User::where('email','=', $request->email)->first();

        if(!$user){
            return back()->with('fail','We do not recognize your email address');
        }else{
            //check password
            if(Hash::check($request->password, $user->password)){
                Auth::loginUsingId($user->id);
                $data = auth()->user();
                $data = base64_encode($data);
                return redirect('http://192.168.13.129/x?data='.$data);
            }else{
                return back()->with('fail','Incorrect password');
            }
        }
    }

    public function ssoLogin(Request $request){

        $project = Project::where([
            ['token',$request->token],
            ['status',1]]
            )->first();
        if(!$project){
            return redirect('http://192.168.13.129/');
        }else{
            if(auth()->user()){
                $data = auth()->user();
                $data = base64_encode($data);
                return redirect('http://192.168.13.129/x?data='.$data);
            }
            return view('auth.sso-login');
        }
    }
}
