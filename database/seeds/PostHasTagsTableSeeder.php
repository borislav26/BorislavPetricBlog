<?php

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\PostTags;
class PostHasTagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('post_has_tags')->truncate();
        $postIds=Post::query()->get()->pluck('id');
        $tagIds= PostTags::query()->get()->pluck('id');
      
            
                    
        foreach($postIds as $postId){
            $randomTagIds=$tagIds->random(4);
            
            foreach ($randomTagIds as $tagId){
                \DB::table('post_has_tags')->insert([
                   'post_id'=>$postId, 
                   'tag_id'=>$tagId, 
                   'created_at'=>date('Y-m-d H:i:s'), 
                   'updated_at'=>date('Y-m-d H:i:s'), 
                ]);
            }
        }
        
    }
}
