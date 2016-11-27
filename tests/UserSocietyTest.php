<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
require_once("app/Http/Controllers/SocietyWrapper.php");

class UserSocietyTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $society1 = factory(App\Society::class)->create([
        'id' => 2005,
        'name' => 'cs',
        'catagory' => 'Academic',
        ]);

        $user1 = factory(App\User::class)->create([
        'id' => 2005,
        'name' => 'Wil',
        'email' => 'aaa@yahoo.com',
        ]);

        \SocietyWrapper::joinSociety(2005,2005);
        $testinsoc = \SocietyWrapper::isInSociety(2005,2005);
        $this->assertEquals(1,$testinsoc);

        $test = \SocietyWrapper::getSocietiesForUser(2005)->first();
        $this->assertEquals(2005,$test->society_id);

        $test = \SocietyWrapper::getAllSocietyMembers(2005);
        $this->assertEquals(2005,$test[0]->id);
        $this->assertEquals('Wil',$test[0]->name);
        $this->assertEquals('aaa@yahoo.com',$test[0]->email);

        \SocietyWrapper::quitSociety(2005,2005);

        App\User::destroy(2005);
        \SocietyWrapper::deleteSociety(2005);
    }
}
