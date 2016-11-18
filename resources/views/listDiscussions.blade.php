@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-success">
                    <div class="panel-heading" style="background-color: #F5F5DC; ">List of All Discussions</div>


                    @if(Auth::check())
                        <ul style=" list-style-type: none;
                                    margin: 0;
                                    padding: 0;
                                    overflow: hidden;
                                    background-color: 	#F8F8F8;
                            ">

                            <li style="float: left;"><a href="{{ url('/createSociety') }}"
                                                        style="display: inline-block;
                                                             color: black;
                                                             text-align: center;
                                                             padding: 14px 16px;
                                                             text-decoration: none;
                                                             ">Create a Discussion</a>
                            </li>
                            <li style="float: left;"><a href="{{ url('/listSocieties') }}"
                                                        style="display: inline-block;
                                                             color: black;
                                                             text-align: center;
                                                             padding: 14px 16px;
                                                             text-decoration: none;
                                                             ">Chat Rooms</a>
                            </li>
                        </ul>
                        @if(!$all_dis)
                            <td>Sorry, there's no discussions!</td>
                        @else
                        <!-- Table -->
                        <table class="table">
                            <tr>
                                <td style="font-weight: bold;">Discussions for {{$society->name}}</td>
                            </tr>
                            <tr>
                                <th>ID</th>
                                <th>Quarter</th>
                                <th>Year</th>
                                <th></th>
                            </tr>
                            @forelse($all_dis as $dis)
                                <tr>
                                    <td>{{$dis->id}}</td>
                                    <td>
                                        @if($dis->quarter==0) Winter
                                        @elseif($dis->quarter==1) Spring
                                        @elseif($dis->quarter==2) Summer
                                        @elseif($dis->quarter==3) Fall
                                        @endif
                                    </td>
                                    <td>{{$dis->year}}</td>
                                    <td>{{$dis->year}}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td>No discussions exist for {{$society->name}}. Would you like to create one?</td>
                                </tr>
                            @endforelse
                            @if(!empty($discussion))
                            <tr>
                                <td style="font-weight: bold;">Posts for @if($discussion->quarter==0) Winter
                                    @elseif($discussion->quarter==1) Spring
                                    @elseif($discussion->quarter==2) Summer
                                    @elseif($discussion->quarter==3) Fall
                                    @endif
                                    {{$discussion->year}}
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            @foreach($posts as $post)
                                <tr>
                                    <td>{{$post->post_id}}</td><td>{{$post->title}}</td><td>{{$post->content}}</td>
                                </tr>
                            @endforeach
                            @endif
                        </table>
                        @endif
                    @endif


                </div>
                @if(Auth::guest())
                    <a href="{{ url('/login') }}" class="btn btn-info"> You need to login to see the list 😜😜 >></a>
                @endif
            </div>
        </div>
    </div>
@endsection

