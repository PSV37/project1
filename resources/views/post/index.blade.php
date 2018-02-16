@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Post Records</div>

                <div class="panel-body">
                  <table class="table">
                      <thead>
                        <tr>
                          <th>Title</th>
                          <th>Body</th>
                          <th>Created_by</th>
                        </tr>
                      </thead>
                      <tbody>
                       @foreach($posts as $post)
                          <tr>
                            <td>{{$post->title}}</td>
                            <td>{{$post->body}}</td>
                            <td><a href="#">{{$post->user->name}}</a></td>
                          </tr>
                       @endforeach
                      </tbody>
                  </table> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
