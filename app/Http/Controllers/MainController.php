<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash; //impordin parooli katmiseks hash


class MainController extends Controller
{
    function login(){
        return view ('auth.login');
    }

    function register(){
        return view ('auth.register');
        
    }

    function save(Request $request){ //Request klassi ja $request kasutades saame suhelda andmebaasiga
        //return $request->input(); //saab kontrollida kas sisestatud andmed jouavad kuhugile
        //esimesena valideerin sisestatud andmed
        $request ->validate([
            'name'=> 'required',
            'email'=> 'required|email|unique:admins',
            'password'=> 'required|min:5|max:12'
        ]);

        //andmebaasi andmete lisamine 
        $admin = new Admin;
        $admin->name=$request->name;
        $admin->email=$request->email;
        $admin->password=Hash::make($request->password); //katan parooli selle make funktsiooniga
        $save=$admin->save();
            //loome teavitus sonumid
        if($save){
            return redirect('/auth/login')->with('success', 'Kasutaja on edukalt loodud');
        }
        else {
            return back()->with('fail', 'Midagi läks valesti');
        }
    }
    function checking(Request $request){ //check funktsiooniga kontrollin andmebaasist kasutajaid !! check nimi peab olema muudetud checking muidu viskab errori
        //return $request->input(); //katsetan kas toimib sisestatud andmed

        //valideerin sisestatuid andmeid
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:5|max:12'
        ]);

        $userInfo = Admin::where('email', '=', $request->email)->first(); // selle reaga saab admini andmebaasist katte emaili mis klapib sisestatud emailiga
    
            if(!$userInfo){ // teeme teavitus sonumid !kui userInfo EI OLE oige
                return back()->with('fail', 'Sisestatud email on vale'); 
            }
            else {
                
                if(Hash::check($request->password, $userInfo->password)){
                        $request->session()->put('LoggedUser', $userInfo->id); //kui parool oige siis lisame sisselogitud kasutaja sessiooni
                        return redirect('links'); // see jarel suuname kasutaja dashboard lehele
                    }
                else {
                    return back()->with('fail', 'Sisestatud parool on vale');
                }
            }
    }

    function logout(){
        if(session()->has('LoggedUser')){
            session()->pull('LoggedUser'); //tombab funktsiooniga votab LoggedUser sessioonist maha ehk lopetab tegevuse
            return redirect('/auth/login')->with('success', 'Olete välja logitud'); //suunan tagasi login lehele ning lisan success sõnumi
        }
    }
}


