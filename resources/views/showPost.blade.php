@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-success">
                    <div class="panel-heading" style="font-weight: bold;
                    background-color: white; ">{{$post->title}} --- {{$post->user_name}}</div>

                @if(Auth::check())
                    <!-- Table -->
                        <table class="table">
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Posted at</th>
                                <th>Last Replied at</th>
                            </tr>

                            <tr>
                                <td>{{$post->post_id}}</td>
                                <td>{{$post->title}}</td>
                                <td>{{$post->user_name}}</td>
                                <td>{{$post->created_at}}</td>
                                <td>{{$post->updated_at}}</td>
                            </tr>

                        </table>

                    @endif


                </div>
                @if(Auth::guest())
                    <a href="{{ url('/login') }}" class="btn btn-info"> You need to login to see the list 😜😜 >></a>
                @endif
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-success">
                    <div class="panel-heading" style="background-color: white; font-weight: bold;">Post Content</div>

                @if(Auth::check())
                        <p class="text-info" style="text-align: justify; margin: 10px">
                            {{$post->content}}
                            fdsaffdsaffdsaffdsaffdsaffdsaffdsaffdsaffdsaf
                            fdsaffdsaffdsaffdsaffdsaffdsaffdsaffdsaffdsaffdsaffdsaffdsaffdsaf
                            fdsaffdsaffdsaffdsaffdsaffdsaffdsaf
                        </p>
                @endif


                </div>
                @if(Auth::guest())
                    <a href="{{ url('/login') }}" class="btn btn-info"> You need to login to see the list 😜😜 >></a>
                @endif
            </div>
        </div>
    </div>
@endsection
