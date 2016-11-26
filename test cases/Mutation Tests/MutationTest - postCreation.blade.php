@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-weight: bold;">Create a new post for {{$society->name}}, @if($discussion->quarter==0) Winter
                        @elseif($discussion->quarter==1) Spring
                        @elseif($discussion->quarter==2) Summer
                        @elseif($discussion->quarter==3) Fall
                        @endif {{$discussion->year}}</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data" action="{{ url('/createPost') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="title" class="col-md-4 control-label">Title</label>

                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>

                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                                <label for="content" class="col-md-4 control-label">Content</label>

                                <div class="col-md-6">
                                    <textarea id="content" type="text" class="form-control" name="content" value="{{ old('content') }}" required autofocus rows="15"> </textarea>

                                    @if ($errors->has('content'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="myFile" class="col-md-4 control-label">File</label>
                                <div class="col-md-6">
                                    <input type="file" id="myFile" name="myFile" value="{{ old('myFile')}}">
                                </div>
                            </div>
<!--
                            <input type="hidden" name="discussion_id"  value="{{$discussion->id}}" />
                            <input type="hidden" name="society_id" value="{{$society->id}}" />
-->
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Create!
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection