<?php

namespace App\Http\Controllers;
use App\BlogPost;
use Illuminate\Http\Request;
use App\User;
use App\Carbon;
use App\Http\Requests\StorePost;
use App\Image;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

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

        return view(
            'posts.index',
            [
                 'posts'=>BlogPost::latestwithRelations()->get(),

            ]
        );


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
        $blogPost=BlogPost::create($validateData);


        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('thumbnails','public');
            $blogPost->image()->save(
                // Image::create(['thumbnail' => $path])
                Image::make(['thumbnail' => $path])
            );
        }


        $request->session()->flash('status', 'Blog post was created!');

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
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('thumbnails','public');
            if($post->image){
                Storage::delete($post->image->thumbnail);
                $post->image->thumbnail=$path;
                $post->image->save();
            }else{
                $post->image()->save(
                    Image::create(['thumbnail' => $path])
                    // Image::make(['thumbnail' => $path])
                );
            }
            }

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
