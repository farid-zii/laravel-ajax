<?php

namespace App\Http\Controllers;

use App\Models\post;
use App\Models\kasus;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class KasusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('/kasus',['datas'=>kasus::get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {      
        $aa=$r->url_blog;

        //ubah data ke dalam array
        $x=explode(',',$r->url_gambar);

        //perulangan dari sebanyak array data
        foreach ($x as $a) {
            kasus::create([
                'url_gambar'=>$a,
                'url_blog'=>$aa
            ]);
        }


     return view('kasus');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\kasus  $kasus
     * @return \Illuminate\Http\Response
     */
    public function show(kasus $kasus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\kasus  $kasus
     * @return \Illuminate\Http\Response
     */
    public function edit(kasus $kasus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\kasus  $kasus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, kasus $kasus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\kasus  $kasus
     * @return \Illuminate\Http\Response
     */
    public function destroy(kasus $kasus)
    {
        //
    }
}
