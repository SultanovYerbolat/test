<!-- create.blade.php -->

@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Add Films Data
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('films.store') }}" enctype="multipart/form-data">
          <div class="form-group">
              @csrf
              <label for="name_of_film">Film's name:</label>
              <input type="text" class="form-control" name="name_of_film"/>
          </div>
          <div class="image">
              <label for="image">Film's image:</label>
              <input type="file" class="form-control" name="image"/>
          </div>
          
          <div class="form-group">
            <label>Films's Genre</label>
            <select class="form-control" name="genres_id">
                  @foreach ($genres as $genre) {
                      echo "<option value='{{ $genre->id }}'>{{ $genre->name_of_genre }}</option>";
                    }
                  @endforeach
            </select>
          </div>

          <button type="submit" class="btn btn-primary">Add Film</button>
      </form>
  </div>
</div>
@endsection