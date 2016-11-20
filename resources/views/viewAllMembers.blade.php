@extends('layouts.app')

@section('content')


    <div class="container">

        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-success">
                <div class="panel-heading" style="background-color: #F5F5DC; ">View All Members of {{$society->name}}</div>
            @if(Auth::check())
                <!-- Make a horizontal menu here -->
                    <ul style=" list-style-type: none;
                                    margin: 0;
                                    padding: 0;
                                    overflow: hidden;
                                    background-color: 	#F8F8F8;
">
                        <li style="float: left;"><a href="{{ url(action('DiscussionController@show', ['society_id'=>$society->id]))}}"
                                                    style="display: inline-block;
                                                             color: black;
                                                             text-align: center;
                                                             padding: 14px 16px;
                                                             text-decoration: none;
                                                             ">Back to {{$society->name}}</a>
                        </li>
                    </ul>
                    <!-- Table -->
                    <table class="table" >
                        <tr>
                            <th>Name</th>
                            <th>University Year</th>
                            <th>Registered at</th>
                        </tr>
                        @foreach($members as $member)
                            <tr>
                                <td>{{$member->name}}</td>
                                <td>{{$member->university_year}}</td>
                                <td>{{$member->created_at}}</td>
                                <td>
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

