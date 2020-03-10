<?php

use App\Tag;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // $tags=collect(['sports','politics','technology','international']);
        // $tags->each(function($tagName){
        //  $tag=new Tag();
        //  $tag->name=$tagName;
        //  $tag->save();

        // });
        $tags = collect(['Science', 'Sport', 'Politics', 'Entartainment', 'Economy']);

        $tags->each(function ($tagName) {
            $tag = new Tag();
            $tag->name = $tagName;
            $tag->save();
        });
    }
}
