<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;


class ListController extends Controller
{
    public function show()
    {
       $characters = [
         'Daenerys Targaryen' => 'Emilia Clarke',
         'Jon Snow'           => 'Kit Harington',
         'Arya Stark'         => 'Maisie Williams',
         'Melisandre'         => 'Carice van Houten',
         'Khal Drogo'         => 'Jason Momoa',
         'Tyrion Lannister'   => 'Peter Dinklage',
         'Ramsay Bolton'      => 'Iwan Rheon',
         'Petyr Baelish'      => 'Aidan Gillen',
         'Brienne of Tarth'   => 'Gwendoline Christie',
         'Lord Varys'         => 'Conleth Hill'
       ];

       return view('welcome')->withCharacters($characters);
    }

    public function showUserInfo() 
    {
      $user = Auth::user();
      $my_password = $user->password;
      $my_email = $user->email;
      $my_year = $user->university_year;
      return view('password', ['password'=>$my_password, 'email'=>$my_email,'my_year'=>$my_year]);
    }
}