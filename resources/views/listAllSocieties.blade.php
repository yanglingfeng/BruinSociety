@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-success">
                    <div class="panel-heading">List of all societies</div>

                @if(Auth::check())
                    <!-- Table -->
                        <table class="table">
                            <tr>
                                <th>Character</th>
                                <th>Real Name</th>
                                <th>Whatever</th>
                            </tr>
                            @foreach($societies as $society)
                                <tr>

                                    <td>{{$society->id}}</td><td>{{$society->name}}</td><td>{{$society->catagory}}</td>
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

