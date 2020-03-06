<?php

namespace App\Http\Controllers;
use App\BlogPost;
use Illuminate\Http\Request;

use App\Carbon;
use App\Http\Requests\StorePost;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {

        $this->middleware('auth')
        ->only(['create','store','edit','update','destroy']);
    }
    public function index()
    {
        //  DB::connection()->enableQueryLog();

        // $posts = BlogPost::with('comment')->get();
        // dd($posts);
        // foreach ($posts as $post) {
        //     foreach ($post->comments as $comment) {
        //         echo $comment->content;
        //     }
        // }

        // dd(DB::getQueryLog());
        //
        // DB::connection()->enableQueryLog();
        //  $posts=BlogPost::all();
        //  $posts=BlogPost::has('comment')->get();
        // $posts=BlogPost::whereDoesntHave('comment',function($query){$query->where('content','like','%Test One%');})->get();

        return view('posts.index',['posts'=>BlogPost::withCount('comment')->get()]
    );
        // dd($posts);
        //Alternatively we can write
        // return view('posts.index',['posts'=> BlogPost::all()]);
        // dd(DB::getQueryLog());

         //If we want to get BlogPost with comments
        //  BlogPost::has('comment')->get();
        //if we want to add comment to a new post $comment=new Comment();
        //$comment->blog_post_id=3;
        //$comment->content='Latest Comment two';

        //$comment->save();
        //BlogPost which has comment abc
        //$posts=BlogPost::whereHas('comment',function($query){$query->where('content','like','%abc%');})->get();
        //Blogpost which does not have comment
        //$post=BlogPost::doesntHave('comment')->get();
        //We want posts which doesnt have words test one
        //$posts=BlogPost::whereDoesntHave('comment',function($query){$query->where('content','like','%Test One%');})->get();
        //How wecan get count of related models
        //if we want to get comments
        //$posts=BlogPost::withCount('comment')->get();
        //fetch count of comments blogpost and latest
        // $posts=BlogPost::withCount(['comment','comment as new_comment'=> function($query) { $query->where('created_at','>=','2020-02-24 13:00:00');}])->get();
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('posts.create');

    }
public function display()
{
    return view('posts.display');
}
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePost $request)
    {
        //
         $validateData=$request->validated();
    //    dd($validateData);
        // $blogPost = new BlogPost();
        // $blogPost->title = $request->input('title');
        // $blogPost->content = $request->input('content');
        // $blogPost->save();
        $blogPost=BlogPost::create($validateData);


        // dd($request->all());
        $request->session()->flash('status','Blog Post was created');
         return redirect()->route('posts.show', ['post' => $blogPost->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        // $request->session()->reflash();
        //
        // $findid=BlogPost::find($id);
        // dd($findid);
        // return view('posts.show',['posts'=>BlogPost::find($id)]);
        return view('posts.show',['posts'=>BlogPost::with('comment')->findorFail($id)]);
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
        $post=BlogPost::findorFail($id);
        return view('posts.edit',['post'=>$post]);
        //This line below is good for a single variable
        // return view('posts.edit',['post'=>BlogPost::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePost $request, $id)
    {
        //
        $post=BlogPost::findorFail($id);
        $validateData=$request->validated();
        $post->fill($validateData);
        $post->save();
        $request->session()->flash('status','Your post has been updated');
        return redirect()->route('posts.show',['post'=>$post->id]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        //
        $post=BlogPost::findorFail($id);
        $post->delete();
        $request->session()->flash('status','Your post has been deleted');
        return redirect()->route('posts.index');
    }
}
