<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
require_once("app/Http/Controllers/PostWrapper.php");

class PostTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $society1 = factory(App\Society::class)->create([
        'id' => 2100,
        'name' => 'cs118',
        'catagory' => 'Academic',
        ]);

        $dicussion1 = factory(App\Discussion::class)->create([
        'id' => 2100,
        'quarter' => 'Winter',
        'society_id' => 2100,
        'year'=> 2010,
        ]);
        
        $user1 = factory(App\User::class)->create([
        'id' => 2100,
        'name' => 'Wil',
        'email' => 'aaad@yahoo.com',
        ]);

        \SocietyWrapper::joinSociety(2100,2100);

        $post1 = factory(App\Post::class)->create([
        'post_id' => 2100,
        'title' => 'help',
        'content' => 'so Hard!',
        'has_link' => false,
        'link' => '',
        'discussion_id' => 2100,
        'user_id' => 2100,
        'user_name' => 'Wil',
        ]);

        $this->seeInDatabase('posts', [
        'post_id' => 2100]);
        $this->seeInDatabase('posts', [
        'title' => 'help']);
        $this->seeInDatabase('posts', [
        'content' => 'so Hard!']);
       
        $test = \PostWrapper::getPostFromId(2100);
        $this->assertEquals($test->title, 'help');
        $this->assertEquals($test->content, 'so Hard!');
        $this->assertEquals($test->has_link, false);
        $this->assertEquals($test->discussion_id, 2100);
        $this->assertEquals($test->user_name, 'Wil');

        $test = \PostWrapper::getPostsForUser(2100)->first();
        $this->assertEquals($test->title, 'help');
        $this->assertEquals($test->content, 'so Hard!');
        $this->assertEquals($test->has_link, false);
        $this->assertEquals($test->discussion_id, 2100);
        $this->assertEquals($test->user_name, 'Wil');

        App\Post::where('post_id', '=', 2100)->delete();
        App\Post::where('post_id', '=', 2101)->delete();
        \SocietyWrapper::quitSociety(2100,2100);
        App\User::destroy(2100);
        App\Discussion::destroy(2100);
        App\Society::destroy(2100);
        
    }
}
