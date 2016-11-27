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

        $test = \DiscussionWrapper::getSocietiesOfDiscussion(2050);
        $this->assertEquals($test->society_id, 2050);

        $test = \DiscussionWrapper::getAllSocietyDicussion(2050)->first();
        $this->assertEquals($test->id, 2050);
        $this->assertEquals($test->quarter, 'Winter');
        $this->assertEquals($test->year, 2010);

        $dicussion2 = factory(App\Discussion::class)->create([
        'id' => 2051,
        'quarter' => 'Fall',
        'society_id' => 2050,
        'year'=> 2011,
        ]);

        $test = \DiscussionWrapper::getNewestSocDiscussion(2050);
        $this->assertEquals($test->id, 2051);
        $this->assertEquals($test->quarter, 'Fall');
        $this->assertEquals($test->year, 2011);

        $test = \DiscussionWrapper::getDiscussionFromId(2051);
        $this->assertEquals($test->society_id, 2050);
        $this->assertEquals($test->quarter, 'Fall');
        $this->assertEquals($test->year, 2011);

        App\Discussion::destroy(2050);
        App\Discussion::destroy(2051);
        \SocietyWrapper::deleteSociety(2050);
    }
}
