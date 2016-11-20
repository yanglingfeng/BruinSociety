@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-success">
                    <div class="panel-heading" style="background-color: #F5F5DC; ">
                        List of All Discussions
                        <a href="{{ url('/listSocieties') }}" style="float: right">See All Societies</a>
                    </div>
                    @if(Auth::check())
                        <ul style=" list-style-type: none;
                                    margin: 0;
                                    padding: 0;
                                    overflow: hidden;
                                    background-color: 	#F8F8F8;
                            ">
                            <li style="float: left;"><a href="{{ url(action('DiscussionController@discussionCreation', ['society_id'=>$society->id])) }}"
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
                                                             ">Chat Room</a>
                            </li>
                                </li>
                                <li style="float: left;"><a href="{{ url(action('SocietyController@listSocietyMembers', ['society_id'=>$society->id])) }}"
                                                            style="display: inline-block;
                                                             color: black;
                                                             text-align: center;
                                                             padding: 14px 16px;
                                                             text-decoration: none;
                                                             ">View Members</a>
                                </li>
                            @if($inSociety==0)
                                <li style="float: left;"><a href="{{ url(action('SocietyController@join', ['society_id'=>$society->id])) }}"
                                                            style="display: inline-block;
                                                             color: black;
                                                             text-align: center;
                                                             padding: 14px 16px;
                                                             text-decoration: none;
                                                             ">Join Society</a>
                                </li>

                            @elseif($inSociety==1)
                                <li style="float: left;"><a href="{{ url(action('SocietyController@quit', ['society_id'=>$society->id])) }}"
                                                            style="display: inline-block;
                                                             color: black;
                                                             text-align: center;
                                                             padding: 14px 16px;
                                                             text-decoration: none;
                                                             ">Quit Society</a>
                                </li>
                            @endif

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
                                <th>Quarter</th>
                                <th>Year</th>
                                <th></th>
                                <th></th>
                                <th></th>

                            </tr>
                            @forelse($all_dis as $dis)
                                <tr>
                                    <td>
                                        @if($dis->quarter==0) Winter
                                        @elseif($dis->quarter==1) Spring
                                        @elseif($dis->quarter==2) Summer
                                        @elseif($dis->quarter==3) Fall
                                        @endif
                                    </td>
                                    <td>{{$dis->year}}</td>
                                    <td>
                                        <form method="get" action="{{ url('/showDiscussions') }}">
                                            <input type="hidden" name="society_id"  value="{{$society->id}}" />
                                            <input type="hidden" name="discussion_id"  value="{{$dis->id}}" />
                                            <button type="submit" style="display: flex;
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
                                                    flex: 0 0 160px;">View Posts</button>
                                        </form>
                                    </td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @empty
                                <tr>
                                    <td>No discussions exist for {{$society->name}}. Would you like to create one?</td>
                                    <td></td>
                                    <td></td>
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
                                <td></td>
                            </tr>

                            <tr style="background-color: #F8F8F8;
                                    list-style-type: none;
                                    margin: 0;
                                    padding: 0;
                                    overflow: hidden;">
                                <td style="float: left;">
                                    <a href="{{ url(action('PostController@postCreation', ['society_id'=>$society->id, 'discussion_id'=>$discussion->id]))}}" style="color:black;">Create a Post</a>
                                </td>
                                <td style="float: left;">
                                    <a href="{{ url(action('DiscussionController@show', ['discussion_id'=>$discussion->id, 'society_id'=>$society->id, 'sort'=>'filesOnly']))}}" style="color:black;">Posts with Files Only</a>
                                </td>
                                <td style="float: left;">
                                    <select id="sortOptions">
                                        <option value="">Sort by</option>
                                        <option value="{{ url(action('DiscussionController@show', ['discussion_id'=>$discussion->id, 'society_id'=>$society->id]))}}" >Newest Post</option>
                                        <option value="{{ url(action('DiscussionController@show', ['discussion_id'=>$discussion->id, 'society_id'=>$society->id, 'sort'=>'updateDesc']))}}">Newest Reply</option>
                                    </select>
                                </td>
                                <script>
                                    document.getElementById("sortOptions").onchange = function() {
                                        if (this.selectedIndex!==0) {
                                            window.location.href = this.value;
                                        }
                                    };
                                </script>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>

                                <tr>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Created at</th>
                                    <th>Last Replied at</th>
                                    <th>With file?</th>
                                </tr>
                            @foreach($posts as $post)
                                <tr>
                                    <td>
                                        <a href="{{ url(action('PostController@show', ['post_id'=>$post->post_id, 'discussion_id'=>$discussion->id, 'society_id'=>$society->id]))}}">{{$post->title}}</a>
                                    </td>
                                    <td>{{$post->user_name}}</td>
                                    <td>{{$post->created_at}}</td>
                                    <td>{{$post->updated_at}}</td>
                                    <td>
                                        @if($post->has_link==1)
                                            Yes!
                                        @endif
                                    </td>

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

