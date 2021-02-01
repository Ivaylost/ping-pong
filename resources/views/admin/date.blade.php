@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <form method="GET" action="{{route('edit_table',$id)}}">
                    @csrf
                    <div class="panel">
                        <label for="start">Start date:</label>

                        <div class="panel-title">
                            <input type="date" id="start" name="date" value="start" required autocomplete="date" autofocus>
                        </div>
                    </div>
                    <div class="">
                        <button class="btn btn-primary" type="submit">{{__("Update")}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
