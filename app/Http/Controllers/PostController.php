<?php

namespace App\Http\Controllers;

use App\Course;
use App\FirstSuggest1;
use App\FirstSuggest2;
use App\Http\Requests\PostRequest;
use App\Post;
use App\Year;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id','DESC')->paginate(10);
        $year = Year::orderBy('id','DESC')
            ->first();
        $data = [
            'posts'=>$posts,
            'year'=>$year,
        ];
        return view('admin.posts.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //不得超過5120KB=5MB
        $request->validate([
            'title'=>'required',
            'files.*' => 'nullable|max:5120',
        ]);
        $att['title'] = $request->input('title');
        $att['content'] = $request->input('content');
        $att['user_id'] = auth()->user()->id;
        $att['views'] = 0;

        $post = Post::create($att);

        //處理檔案上傳
        $folder = 'posts/'.$post->id;
        if ($request->hasFile('files')) {
            $files = $request->file('files');
            foreach($files as $file){
                $file->storeAs('public/' . $folder, $file->getClientOriginalName());
            }
        }

        return redirect()->route('index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {

        $s_key = "pv".$post->id;
        if(!session($s_key)){
            $att['views'] = $post->views+1;
            $post->update($att);
        }
        session([$s_key => '1']);

        //有無附件
        $files = get_files(storage_path('app/public/posts/'.$post->id));


        $data = [
            'post'=>$post,
            'files'=>$files,
        ];

        return view('admin.posts.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if(auth()->user()->id != $post->user_id){
            return back();
        }

        //有無附件
        $files = get_files(storage_path('app/public/posts/'.$post->id));

        $data = [
            'post'=>$post,
            'files'=>$files,
        ];

     return view('admin.posts.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Post $post)
    {
        if(auth()->user()->id != $post->user_id){
            return back();
        }
        //不得超過5120KB=5MB
        $request->validate([
            'title'=>'required',
            'files.*' => 'nullable|max:5120',
        ]);

        $att['title'] = $request->input('title');
        $att['content'] = $request->input('content');

        $post->update($att);

        //處理檔案上傳
        $folder = 'posts/'.$post->id;
        if ($request->hasFile('files')) {
            $files = $request->file('files');
            foreach($files as $file){
                $file->storeAs('public/' . $folder, $file->getClientOriginalName());
            }
        }


        return redirect()->route('posts.show',$post->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if(auth()->user()->id != $post->user_id){
            return back();
        }

        //刪除整個該post上傳目錄
        $folder = storage_path('app/public/posts/'.$post->id);
        if (is_dir($folder)) {
            del_folder($folder);
        }

        //刪除該post
        $post->delete();

        return redirect()->route('index');

    }

    public function fileDel($file)
    {
        $file_array = explode('&',$file);

        $post = Post::where('id',$file_array[1])->first();
        if($post->user_id != auth()->user()->id){
            return back();
        }

        $file = str_replace('&','/',$file);
        $file = storage_path('app/public/'.$file);
        if(file_exists($file)){
            unlink($file);
        }

        return redirect()->route('posts.edit',$file_array[1]);
    }



}
