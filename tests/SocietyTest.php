<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
require_once("app/Http/Controllers/SocietyWrapper.php");

class SocietyTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $society1 = factory(App\Society::class)->create([
        'id' => 2001,
        'name' => 'cs',
        'catagory' => 'Academic',
        ]);

        $society2 = factory(App\Society::class)->create([
        'id' => 2002,
        'name' => 'baseball',
        'catagory' => 'Interest',
        ]);

        $this->seeInDatabase('societies', [
        'id' => 2001]);
        $this->seeInDatabase('societies', [
        'name' => 'cs']);
        $this->seeInDatabase('societies', [
        'id' => 2002]);
        $this->seeInDatabase('societies', [
        'name' => 'baseball']);

        $test = \SocietyWrapper::getSocietyFromId(2001);
        $this->assertEquals('cs',$test->name);
        $this->assertEquals('Academic',$test->catagory);

        \SocietyWrapper::deleteSociety(2001);
        \SocietyWrapper::deleteSociety(2002);
    }

}
