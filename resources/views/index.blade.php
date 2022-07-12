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
          <td>Genre Name</td>
          <td colspan="2">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($genres as $genre)
        <tr>
            <td>{{$genre->id}}</td>
            <td>{{$genre->name_of_genre}}</td>
            <td><a href="{{ route('genres.edit', $genre->id)}}" class="btn btn-primary">Edit</a></td>
            <td>
                <form action="{{ route('genres.destroy', $genre->id)}}" method="post">
                  @csrf
                  
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
@endsection