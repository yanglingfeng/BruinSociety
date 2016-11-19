@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-weight: bold;">Creating a discussion for</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/createDis') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="quarter" class="col-md-4 control-label">Quarter</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="quarter">
                                        <option value="0">Winter</option>
                                        <option value="1">Spring</option>
                                        <option value="2">Summer</option>
                                        <option value="3">Fall</option>
                                    </select>
                                    @if ($errors->has('quarter'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('quarter') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('year') ? ' has-error' : '' }}">
                                <label for="year" class="col-md-4 control-label">Year</label>

                                <div class="col-md-6">
                                    <input id="year" type="text" class="form-control" name="year" value="{{ old('year') }}" required autofocus>

                                    @if ($errors->has('year'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('year') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <input type="hidden" name="discussion_id"  value="{{$discussion_id}}" />

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