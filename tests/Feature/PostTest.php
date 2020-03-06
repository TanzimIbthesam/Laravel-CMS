<?php

namespace Tests\Feature;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\BlogPost;
use App\Comment;

// use Illuminate\Foundation\Testing\WithFaker;


class PostTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function testNoBlogPostsWhenNothingInDatabase()
    {
        $response = $this->get('/posts');

        $response->assertSeeText('No Blog Post Yet!');
    }

    public function testSee1BlogPostWhenThereIs1WithNoComments()
    {
        //Arrange

        $post=new BlogPost();
        $post->title = 'New title';
        $post->content = 'Content of the blog post';
        $post->save();
        // Act
        $response = $this->get('/posts');
        // Assert
        $response->assertSeeText('New title');
        $this->assertDatabaseHas('blog_posts', [
            'title' => 'New title'
        ]);
    }
    public function testSee1BlogPostWithComments()
    {
        // Arrange
        $post = $this->createDummyBlogPost();
        factory(Comment::class, 4)->create([
            'blog_post_id' => $post->id
        ]);

        $response = $this->get('/posts');

        $response->assertSeeText('4 comments');
    }
    public function testStoreValid(){

        $params=[
            'title'=>'Valid Title',
            'content'=>'Atleast 10 characters'
        ];
        $this->actingAs($this->user())
        ->post('/posts', $params)
        ->assertStatus(302)
        ->assertSessionHas('status');
        $this->assertEquals(session('status'),'Blog Post was created');

    }
     public function testStoreFail(){
        $params=[
            'title'=>'x',
            'content'=>'x'
        ];

        $this->actingAs($this->user())
            ->post('/posts', $params)
            ->assertStatus(302)
            ->assertSessionHas('errors');

        $messages=session('errors')->getMessages();
        //  dd($messages->getMessages());
        // $this->assertEquals(session('errors'),'Blog Post was created');
        $this->assertEquals($messages['title'][0], 'The title must be at least 5 characters.');
        $this->assertEquals($messages['content'][0], 'The content must be at least 10 characters.');

    }
   public function testUpdateValid(){
           //Arrange

        // $post=new BlogPost();
        // $post->title = 'New title';
        // $post->content = 'Content of the blog post';
        // $post->save();
        $post = $this->createDummyBlogPost();

        $this->assertDatabaseHas('blog_posts', $post->toArray());
        $params=[
            'title'=>'A new named title',
            'content'=>'Content was changed'
        ];

        $this->actingAs($this->user())
            ->put("/posts/{$post->id}", $params)
            ->assertStatus(302)
            ->assertSessionHas('status');
         $this->assertEquals(session('status'),'Your post has been updated');
        $this->assertDatabaseMissing('blog_posts',$post->toArray());
         $this->assertDatabaseHas('blog_posts', [
            'title' => 'A new named title'
        ]);
   }
   public function testDelete(){
    $post = $this->createDummyBlogPost();
    $this->assertDatabaseHas('blog_posts', $post->toArray());

    $this->actingAs($this->user())
        ->delete("/posts/{$post->id}")
        ->assertStatus(302)
        ->assertSessionHas('status');

    $this->assertEquals(session('status'), 'Blog post was deleted!');
    $this->assertDatabaseMissing('blog_posts', $post->toArray());
   }
   private function createDummyBlogPost():BlogPost{
    //    $post=new BlogPost;
    //    $post->title='New Title';
    //    $post->content='Content of the BlogPost';
    //    $post->save();
       //This code when tried in tinker will replace the title and content of factory but we must use factory('App\BlogPost') in place of BlogPost::class
       //factory('App\BlogPost')->states('new-title')->create();

       return factory(BlogPost::class)->states('new-title')->create();
    //    return $post;


   }

}
