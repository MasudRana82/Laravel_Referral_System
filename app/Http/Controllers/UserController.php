<?php

namespace App\Http\Controllers;

use App\Models\Network;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Termwind\Components\Dd;

class UserController extends Controller
{
    public function loadregister(){
        return view('register');

    }

    
    public function linechart(){
        $dateLavels=[];
        $dateData=[];


        for($i=30;$i>=0;$i--){
            $dateLavels[]= Carbon::now()->subdays($i)->format('d:m:Y');
           
            $dateData[]= Network::whereDate('created_at', Carbon::now()->subdays($i)->format('Y:m:d'))->count();
          

          

        }
        $dateLavels = json_encode($dateLavels);
        $dateData = json_encode($dateData);
        // print_r($dateData);
     
        
        return view('dashboard',compact(['dateLavels','dateData']));

    }


    public function registered(Request $req){
   
        $req->validate([
            'name'=>'required|string|min:1',
            'email'=>'required|email|string|max:100|unique:users',
            'password'=>'required|min:2|confirmed',
            

           
            ]);

            $referral_code=Str::random(10);

            if(isset($req->referral_code))
            {
                $userdata=User::where('referral_code', $req->referral_code)->first();
              
                if(!empty($userdata)) //count() use only for array. and empty() use for single data
                {
                    $user_id = User::insertGetId([
                    'name' => $req->name,
                    'email' => $req->email,
                    'referral_code' => $referral_code,
                    'password' => Hash::make($req->password)
                    ]);

                    Network::insert([
                        'referral_code'=> $req->referral_code,
                        'user_id'=>$user_id,
                        'parent_id'=> $userdata->id,
                    ]);

                }

                else{

                return back()->with('error', 'Invalid referral code');
                }

            }
            else{
                User::insert([
                    'name'=>$req->name,
                    'email'=>$req->email,
                    'referral_code'=>$referral_code,
                    'password'=>Hash::make($req->password)
                ]);
            }

            //referral link create
            $domain = URL::to('/'); // this line give you the current domain name
            $url = $domain.'/register?ref='.$referral_code;
            //  dd($url);
            return back()->with('success','Registration successfull');


    }
}
