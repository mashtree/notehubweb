@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div><b>{{strtoupper($note[0]->note_title)}}</b></div>
                    <div>{{$note[0]->description}}</div>
                    <div><a href='{{URL::to("download/".$note[0]->id)}}'>download</a></div>
                </div>

                <div class="panel-body">
                    <iframe src="{{$file}}" 
                        name="targetframe" allowTransparency="true" 
                        scrolling="yes" frameborder="0"
                        width="800" height="600">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection