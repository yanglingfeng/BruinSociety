<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $user1 = factory(App\User::class)->create([
        'id' => 2006,
        'name' => 'Wil',
        'email' => 'aab@yahoo.com',
        ]);

        $this->seeInDatabase('users', [
        'id' => 2006]);
        $this->seeInDatabase('users', [
        'name' => 'Wil']);
        $this->seeInDatabase('users', [
        'email' => 'aab@yahoo.com']);
        App\User::destroy(2006);

    }
}
