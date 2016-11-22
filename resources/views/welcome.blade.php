@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-9 col-md-offset-1">
            <div class="panel panel-success">
                <div class="panel-heading" style="background-color: #F5F5DC; ">Societies You are in!</div>
                    @if(Auth::check())
                        <!-- Make a horizontal menu here -->
                        <ul style=" list-style-type: none;
                                    margin: 0;
                                    padding: 0;
                                    overflow: hidden;
                                    background-color: 	#F8F8F8;
">
                            <li style="float: left;"><a href="{{ url('/listSocieties') }}"
                                                        style="display: inline-block;
                                                             color: black;
                                                             text-align: center;
                                                             padding: 14px 16px;
                                                             text-decoration: none;
                                                             ">See All Societies</a>
                            </li>
                            <li style="float: left;"><a href="{{ url('/createSociety') }}"
                                                        style="display: inline-block;
                                                             color: black;
                                                             text-align: center;
                                                             padding: 14px 16px;
                                                             text-decoration: none;
                                                             ">Create a Society</a>
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
                        <!-- Table -->
                        <table class="table" >
                            <tr>
                                <th>Name</th>
                                <th>Category</th>
                            </tr>
                            @foreach($societies as $society)
                            <tr>
                                <td>{{$society->name}}</td>
                                <td>{{$society->catagory}}</td>
                                <td>
                                    <form method="get" action="{{ url('/showDiscussions') }}">
                                        <input type="hidden" name="society_id"  value="{{$society->id}}" />
                                        <button type="submit" style=" display: flex;
  overflow: hidden;
  width:100px;

  cursor: pointer;
  user-select: none;
  transition: all 60ms ease-in-out;
  text-align: center;
  white-space: nowrap;
  text-decoration: none !important;
  text-transform: none;
  text-transform: capitalize;

  color: #fff;
  border: 0 none;
  border-radius: 4px;

  font-size: 14px;
  font-weight: 500;
  line-height: 1.3;

  -webkit-appearance: none;
  -moz-appearance:    none;
  appearance:         none;

  justify-content: center;
  align-items: center;
  flex: 0 0 160px;">Discussions</button>
                                    </form>
                                </td>
                                <td>
                                    <form method="get" action="{{ url('/quit') }}">
                                        <input type="hidden" name="society_id"  value="{{$society->id}}" />
                                        <button type="submit" style=" display: flex;
  overflow: hidden;
  width:50px;

  cursor: pointer;
  user-select: none;
  transition: all 60ms ease-in-out;
  text-align: center;
  white-space: nowrap;
  text-decoration: none !important;
  text-transform: none;
  text-transform: capitalize;

  color: #fff;
  border: 0 none;
  border-radius: 4px;

  font-size: 14px;
  font-weight: 500;
  line-height: 1.3;

  -webkit-appearance: none;
  -moz-appearance:    none;
  appearance:         none;

  justify-content: center;
  align-items: center;
  flex: 0 0 160px;">Quit</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach

                        </table>
                        @endif
            </div>
            @if(Auth::guest())
              <a href="{{ url('/login') }}" class="btn btn-info">Sign in to see your societies</a>
            @endif
        </div>

        @if(Auth::check())
        <div class="col-md-9 col-md-offset-1">
            <div class="panel panel-success">
                <div class="panel-heading">Your Posts</div>

            @if(Auth::check())
                <!-- Table -->
                    <table class="table">

                        <tr>
                            <th>Title</th>
                            <th>Society</th>
                            <th>Created at</th>
                            <th>Last Replied at</th>
                        </tr>
                        @foreach($posts as $post)
                            <tr>
                                <td>
                                    <a href="{{ url(action('PostController@show', ['post_id'=>$post['id'], 'discussion_id'=>$post['discussion_id'], 'society_id'=>$post['society_id']]))}}">{{$post['title']}}</a>
                                </td>
                                <td>{{$post['society_name']}}</td>
                                <td>{{$post['created_at']}}</td>
                                <td>{{$post['replied_at']}}</td>
                            </tr>
                        @endforeach

                    </table>
                @endif


            </div>
            @if(Auth::guest())
            @endif
        </div>
        </div>
    </div>
@endif

</div>

@endsection

