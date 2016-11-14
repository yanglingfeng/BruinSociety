@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-success">
                    <div class="panel-heading">Post content and replies</div>

                @if(Auth::check())
                    <!-- Table -->
                        <table class="table">
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Content</th>
                                <th>Author</th>
                                <th>Posted at</th>
                            </tr>

                            <tr>
                                <td>{{$post->post_id}}</td>
                                <td>{{$post->title}}</td>
                                <td>{{$post->content}}</td>
                                <td>{{$post->user_name}}</td>
                                <td>{{$post->created_at}}</td>
                            </tr>

                            <tr>
                                <td>Here are the replies.</td>
                            </tr>

                            <tr>
                                <th>ID</th>
                                <th>Content</th>
                                <th>Author</th>
                                <th>Posted at</th>
                            </tr>

                            @foreach($comments as $comment)
                                <tr>
                                    <td>{{$comment->id}}</td>
                                    <td>{{$comment->content}}</td>
                                    <td>{{$comment->commenter_name}}</td>
                                    <td>{{$comment->created_at}}</td>
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
