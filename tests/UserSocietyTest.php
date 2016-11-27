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
        \SocietyWrapper::quitSociety(2005,2005);

        App\User::destroy(2005);
        \SocietyWrapper::deleteSociety(2005);
    }
}
