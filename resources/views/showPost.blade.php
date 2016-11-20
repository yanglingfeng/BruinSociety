@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-success">
                    <div class="panel-heading" style="font-weight: bold;
                    background-color: white; ">
                            {{$post->title}} by {{$post->user_name}}
                        <a style="float: right" href="{{ url(action('DiscussionController@show', ['discussion_id'=>$discussion->id, 'society_id'=>$society->id]))}}">Back to Discussion Page</a>
                    </div>

                @if(Auth::check())
                    <!-- Table -->
                        <table class="table">
                            <tr>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Posted at</th>
                                <th>Last Replied at</th>
                            </tr>

                            <tr>
                                <td>{{$post->title}}</td>
                                <td>{{$post->user_name}}</td>
                                <td>{{$post->created_at}}</td>
                                <td>{{$post->updated_at}}</td>
                            </tr>

                            @if($post->has_link==1)
                            <tr>
                                <td>
                                    <a href="{{url($file_url)}}">Click here to download the appended file</a>
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            @endif

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
                        <p style="text-align: justify; margin: 10px">
                            @php
                            $content = $post->content;
                            echo nl2br($content);
                            @endphp
                        </p>
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
                    <div class="panel-heading">Replies</div>

                @if(Auth::check())
                    <!-- Table -->
                        <table class="table">

                            <tr>
                                <th>Content</th>
                                <th>Author</th>
                                <th>Posted at</th>
                            </tr>

                            @foreach($comments as $comment)
                                <tr>
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
    <!-- Reply form -->
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-weight: bold;">Reply</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/postComment') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                                <label for="content" class="col-md-4 control-label">Content</label>

                                <div class="col-md-6">
                                    <textarea id="content" type="text" class="form-control" name="content" value="{{ old('content') }}" required autofocus rows="5"> </textarea>

                                    @if ($errors->has('content'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <input type="hidden" name="discussion_id"  value="{{$discussion->id}}" />
                            <input type="hidden" name="society_id" value="{{$society->id}}" />
                            <input type="hidden" name="post_id" value="{{$post->post_id}}" />

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Post
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of reply form -->
@endsection
