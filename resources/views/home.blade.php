@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @if(isset($contributor))
                        CONTRIBUTOR
                    @else
                        NOTES
                    @endif
                </div>

                <div class="panel-body">
                @if(isset($contributor))
                    <div><a href='{{URL::to("/contributor")}}'>< back</a></div>
                    <div>{{$contributor[0]->name}} | {{$contributor[0]->email}}</div>
                @else
                    <div><a href='{{URL::to("/contributor")}}'>< list of contributors</a></div>
                @endif
                <br/>
                <div>
                    <form class="form-inline" role="form" method="POST" action="{{ url('/searchn/') }}">
                    {{ csrf_field() }}
                      <div class="form-group">
                        <label for="keyword">Find notes:</label>
                        <input type="text" class="form-control" id="keyword" name="keyword">
                      </div>
                      <button type="submit" class="btn btn-default"><i class="fa fa-btn fa-search"></i> Search Note</button>
                    </form>
                </div><br/>
                @if(isset($keyword))
                <div>
                    keyword : <b>{{$keyword}}</b> 
                </div>
                @endif
                    <table class='table table-hover'>
                        <thead>
                            <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($notes as $note)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>{{$note->note_title}}</td>
                                    <td>{{$note->description}}</td>
                                    <td><a href='{{URL::to("/view/".$note->id)}}'>view</a> | 
                                    <a href='{{URL::to("/download/".$note->id)}}'>download</a></td>
                                </tr>
                            @endforeach()
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
