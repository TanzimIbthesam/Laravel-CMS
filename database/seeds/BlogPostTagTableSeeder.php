<?php

use App\BlogPost;
use App\Tag;
use Illuminate\Database\Seeder;

class BlogPostTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $tagCount=Tag::all()->count();
        if( 0 === $tagCount){
            $this->command->info('no tags found,skip assigning tags to BlogPosts');
            return;
        }
        $minimum=(int)$this->command->ask('Minimum ow many tags you want on this BlogPost?',0);
        $maximum=min((int)$this->command->ask(' Maximum how many tags you want on this BlogPost?',$tagCount),$tagCount);
        BlogPost::all()->each(function (BlogPost $post) use($minimum,$maximum){
            $take=random_int($minimum,$maximum);
            $tags=Tag::inRandomOrder()->take($take)->get()->pluck('id');
            $post->tags()->sync($tags);

        });

    }
    // public function run()
    // {
    //     $tagCount = Tag::all()->count();

    //     if (0 === $tagCount) {
    //         $this->command->info('No tags found, skipping assigning tags to blog posts');
    //         return;
    //     }

    //     $howManyMin = (int)$this->command->ask('Minimum tags on blog post?', 0);
    //     $howManyMax = min((int)$this->command->ask('Maximum tags on blog post?', $tagCount), $tagCount);

    //     BlogPost::all()->each(function (BlogPost $post) use($howManyMin, $howManyMax) {
    //         $take = random_int($howManyMin, $howManyMax);
    //         $tags = Tag::inRandomOrder()->take($take)->get()->pluck('id');
    //         $post->tags()->sync($tags);
    //     });
    // }

}
