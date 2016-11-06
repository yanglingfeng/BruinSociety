@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-success">
                <div class="panel-heading">Societies You are in!</div>
                    @if(Auth::check())
                        <!-- Make a horizontal menu here -->
                        <a href="{{ url('/listSocieties') }}">See All Societies</a>
                        <!-- Table -->
                        <table class="table">
                            <tr>
                                <th>id</th>
                                <th>name</th>
                                <th>catagory</th>
                            </tr>
                            @foreach($societies as $society)
                            <tr>
                                <td>{{$society->id}}</td>
                                <td>{{$society->name}}</td>
                                <td>{{$society->catagory}}</td>
                            </tr>
                            @endforeach
                        </table>
                    @endif
            </div>
            @if(Auth::guest())
              <a href="{{ url('/login') }}" class="btn btn-info"> You need to login to see the list 😜😜 >></a>
            @endif
        </div>
    </div>
</div>
@endsection

