<!-- index.blade.php -->

@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="uper">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif
  <table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>Film's Name</td>
          <td>Poster</td>
          <td>Film's Genre</td>
          <td colspan="3">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($films as $film)
        <tr>
            <td>{{$film->id}}</td>
            <td>{{$film->name_of_film}}</td>
            <td><img src="{{ URL::asset('image/'.$film->link_to_poster) }}"  style="height: 100px; width: 150px;"></td>
            <td>{{$film->name_of_genre}}</td>
            <td><a href="{{ route('films.edit', $film->id)}}" class="btn btn-primary">Edit</a></td>
            <td>
                <form action="{{ route('films.destroy', $film->id)}}" method="post">
                  @csrf
                  
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
            <td>
                <form action="{{ route('films.publish', $film->id)}}" method="post">
                  @csrf
                  
                  <button class="btn btn-success" type="submit">Publish</button>
                </form>
            </td> 
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
@endsection