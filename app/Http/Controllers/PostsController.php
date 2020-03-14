<?php

namespace App\Http\Controllers;
use App\BlogPost;
use Illuminate\Http\Request;
use App\User;
use App\Carbon;
use App\Http\Requests\StorePost;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;


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
        // $posts=BlogPost::withCount('comment')->orderBy('created_at','desc')->get();
        // $posts=BlogPost::latest()->withCount('comment')->get();
        // $most_commented=BlogPost::mostCommented()->take(5)->get();
        // $user
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

        // return view('posts.index',['posts'=>BlogPost::withCount('comment')->get()]);
        //We put all these code in activity composer.php
        // $most_commented=Cache::remember('blog-post-commented', now()->addSeconds(30), function () {
        //     return  BlogPost::mostCommented()->take(5)->get();
        // });
        // $mostActive=Cache::remember('users-most-active', now()->addSeconds(30), function () {
        //     return  User::WithMostBlogPosts()->take(5)->get();
        // });
        // $mostActiveLastMonth=Cache::remember('users-most-active-last-month', now()->addSeconds(30), function () {
        //     return User::withMostBlogPostsLastMonth()->take(5)->get();
        // });

        return view(
            'posts.index',
            [
                 'posts'=>BlogPost::latestwithRelations()->get(),
                // 'posts' => BlogPost::latest()
                // ->withCount('comment')
                // ->with('user')
                // ->with('tags')
                // ->get(),
                // 'most_commented' => BlogPost::mostCommented()->take(5)->get(),
                // 'most_commented' =>$most_commented,
                // 'mostActive' =>$mostActive,
                //  'mostActiveLastMonth' =>$mostActiveLastMonth
            ]
        );

        // return view('posts.index',compact('posts','most_commented'));
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
        // $this->authorize('posts.create');

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

        $validateData = $request->validated();
        $validateData['user_id'] = $request->user()->id;

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
    public function show($id)
    {
        // $request->session()->reflash();
        //
        // $findid=BlogPost::find($id);
        // dd($findid);
        $blogPost=Cache::remember("blog-post-{$id}", 60, function () use($id) {
            return BlogPost::with('comment','tags','user','comment.user')->findorFail($id);




        });
        $sessionId=session()->getId();
        $counterKey="blog-post-{$id}-counter";
        $usersKey="blog-post-{$id}-users";
        $users=Cache::get($usersKey,[]);
        $usersUpdate=[];
        $difference=0;
        $now=now();
        foreach($users as $session=>$lastVisit){
            if($now->diffInMinutes($lastVisit)>=1){
                $difference--;
            }else{
                $usersUpdate[$session]=$lastVisit;
            }

        }
        // if(!array_key_exists($sessionId,$users)
        // ||$now->diffInMinutes($users[$sessionId])>=1)
        if(!array_key_exists($sessionId, $users)
            || $now->diffInMinutes($users[$sessionId]) >= 1)
        {
             $difference++;
        }
        $usersUpdate[$sessionId]=$now;


        if(!Cache::has($counterKey)){
            Cache::forever($counterKey,1);
        }else{
            Cache::increment($counterKey, $difference);
        }
        $counter=Cache::get($counterKey, $difference);
        // return view('posts.show',['posts'=>BlogPost::with('comment')->findorFail($id)]);
        return view('posts.show',[
            'posts'=>$blogPost,
            'counter'=>$counter
        ]);
        // return view('posts.show',['posts'=>BlogPost::with(['comment'=>function($query){
        //     return $query->latest();
        // }])->findorFail($id)]);
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
        // if(Gate::denies('update-post',$post)){
        //     abort(403,"You cant edit this BlogPost");
        // }
        // $this->authorize('update-post',$post);
        $this->authorize($post);
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
        // $this->authorize('posts.update',$post);
        // $this->authorize('update',$post);
        $this->authorize($post);
        // if(Gate::denies('update-post',$post)){
        //     abort(403,"You cant edit this BlogPost");
        // }

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
        // if(Gate::denies('delete-post',$post)){
        //     abort(403,"You cant delete this BlogPost");
        // }
        // $this->authorize('posts.delete',$post);
        // $this->authorize('delete',$post);
        $this->authorize($post);


        $post->delete();
        $request->session()->flash('status','Your post has been deleted');
        return redirect()->route('posts.index');
    }
}
