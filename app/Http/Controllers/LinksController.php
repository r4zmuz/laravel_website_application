<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\Admin; //impordin Admin mudeli LinksControllerisse, et saaks infot admin andmebaasist
use Illuminate\Http\Request;


class LinksController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function all()
    {
       $links = Link::latest()->paginate();

        return view('links.all',compact('links'))->with('i', (request()->input('page')));
    }
    
     public function index()
    {
       $links = Link::latest()->paginate(5);
       $data = ['LoggedUserInfo'=>Admin::where('id', '=', session('LoggedUser'))->first()]; //selle abil naen sisselogitud kasutajat
        return view('links.index', $data, compact('links'))->with('i', (request()->input('page', 1) -1) * 5); //$data et tagastada kasutaja andmed

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('links.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $regex = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/'; //voimaldab sisestada URL ilma http:// ette lisamata

         $request->validate([
            'name' => 'required',
            'url' => 'required|unique:links|regex:'.$regex, //unique abil ei lase topelt emaile lisada
            'detail' => 'required'
        ]);

        Link::create($request->all());
        return redirect()->route('links.index')->with('success','Link lisatud edukalt.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function show(Link $link)
    {
       return view('links.show',compact('link'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function edit(Link $link)
    {
        return view('links.edit',compact('link'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Link $link)
    {
        $regex = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/'; 

        $request->validate([
            'name' => 'required',
            'url' => 'required|unique:links|regex:'.$regex,
            'detail' => 'required'
        ]);

        $link->update($request->all());
        return redirect()->route('links.index')->with('success','Link muudetud edukalt');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function destroy(Link $link)
    {
        $link->delete();
        return redirect()->route('links.index')->with('success','Link kustutatud');
    }
}

