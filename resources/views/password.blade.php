@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-success">
                <div class="panel-heading">Here's your email and password</div>

                    @if(Auth::check())
                      <!-- Table -->
                      <table class="table">

                          <tr>
                          
                              <td>{{$email}}</td> <td>{{$password}}</td> <td>{{$my_year}} </td>
                            </tr>
                      </table>
                    @endif

                <a href="{{ url('/lout') }}"> click to log out</a>

            </div>
            @if(Auth::guest())
              <a href="{{ url('/login') }}" class="btn btn-info"> You need to login to see your password 😜😜 >></a>
            @endif
        </div>
    </div>
</div>
@endsection