<?php

namespace App\Http\Controllers;

use App\Models\post;
use App\Models\kasus;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use DB;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function aa(Request $a){  

        // Mengubah data ke dalam array dipisahkan di setiap koma
        $c =explode(',',$a->title);
        // Mengubah array ke text
        $v= implode(',',$c);
        print_r($v);
                echo "<br><br>" ;
        print_r($c);

                        echo "<br><br>" ;

        foreach ($c as $key) {
        echo "$a->title";
    }
                    echo "<br><br>" ;
        $aaa;
        echo "<br><br>" ;
        foreach ($c as $key) {
        echo "<br>$key";
    }




        // $c=explode(',',$post->title);
        // $a=implode(',',$c),
        // $a->validate([
        //     'title'=>'url'
        // ]);
        // Post::create([
        //     'title'=>$v
        // ]);
        // return view('welcome');
    
}

    public function index2()
    {
        //Mengambil data dari model

        // $a=implode(',',$post);
        // var_dump($a);

        return view('welcome');
    }

    
    public function index()
    {      

        $post=Post::get('title');
        
        //ubah data ke array dengan koma sebagai pemisah antar data
        $c=explode(',',$post);
        //ubah dari array ke text dengan koma sebagai pemisah
        $d=implode(',',$c);

        $array=json_decode($d,true);
        $title = $array[0]['title'];
        $values = explode(',', $title);
        // $d=implode('[{',$c);



        // return view('post',[
        //     'data'=>$values,
        //     'posts'=>$posts,
        //     'gambar'=>$d
        // ]);
        $posts = Post::latest()->get();
          return view('post',[
            'posts'=>$posts,
        ]);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function ac()
    {

        return view('grafik');
    }
    public function ad(Request $request)
    {
        

         $users = Post::select(DB::raw("COUNT(*) as count"),DB::raw('MONTHNAME(created_at) as month_name'))
        ->whereYear('created_at',date('Y'))
        ->groupBy('month_name')
        ->orderBy('created_at','asc')
        ->pluck('count','month_name');

        $labels=$users->keys();
        $data=$users->values();

        $data = DB::table('posts')
                ->select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') as tanggal"), DB::raw('COUNT(*) as jumlah'))
                ->where('created_at',$request->bulantahun)
                ->groupBy('tanggal')
                ->orderBy('tanggal')
                ->get();

            // $aa = Post::get();
                $aa=Post::select()->get();

        return response()->json([
            'success'=>true,
            'pesan'=>'halo',
            'data'=>$labels,
            'data2'=>$data,
            ],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function storea(Request $request)
    {
        $pesan = [
            // 'title.required'=>'Title harus di isi'
            'required'=>':attribute harus di isi'];
        
        //define validation rules
        $validator = Validator::make($request->all(), [
            'title'     => 'required',
            'content'   => 'required',
        ],$pesan);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create post
        $post = Post::create([
            'title'     => $request->title, 
            'content'   => $request->content
        ]);

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data'    => $post  
        ]);
    }

    public function store(Request $request)
    {
        $pesan = [
            // 'title.required'=>'Title harus di isi'
            'required'=>':attribute harus di isi'
            //sama seperti title.required yang mana pesan yg akan tampil 'Title harus diisi' tapi attribute akan otomatis diganti menjadi nama field table
        ];

        $validator = Validator::make($request->all(),[
            'title'=>'required',
            'content'=>'required',
        ],$pesan);

        //Cek validasi error
        if($validator->fails()){
            return response()->json($validator->errors(),422);
        }



        $post=Post::create([
            'title'     =>$request->title,
            'content'   =>$request->content
        ]);

        //return response
        return response()->json([
            'success'=>true,
            'message' =>'Data berhasil disimpan',
            'data'=>$post
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(post $post)
    {
        return response()->json([
            'success'=>true,
            'message'=> 'Detail Data Post',
            'data'=>$post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, post $post){
        //define validation rules
        $validator = Validator::make($request->all(), [
            'title'     => 'required',
            'content'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create post
        $post->update([
            'title'     => $request->title, 
            'content'   => $request->content
        ]);

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Diudapte!',
            'data'    => $post  
        ]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        post::destroy($id);

        return response()->json([
            'success'=>true,
            'message'=>'Data berhasil dihapus'
        ]);
    }
}
