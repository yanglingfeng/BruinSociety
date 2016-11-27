<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
require_once("app/Http/Controllers/SocietyWrapper.php");
require_once("app/Http/Controllers/DiscussionWrapper.php");

class DiscussionTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $society1 = factory(App\Society::class)->create([
        'id' => 2050,
        'name' => 'cs118',
        'catagory' => 'Academic',
        ]);

        $dicussion1 = factory(App\Discussion::class)->create([
        'id' => 2050,
        'quarter' => 'Winter',
        'society_id' => 2050,
        'year'=> 2010,
        ]);

        $this->seeInDatabase('discussions', [
        'id' => 2050, 'quarter' => 'Winter', 'society_id' => 2050,
        'year'=> 2010]);

        App\Discussion::destroy(2050);
        \SocietyWrapper::deleteSociety(2050);
    }
}
