@extends('layout.app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-8">
      <form class="control" action="index.html" method="get">
        <input type="text" name="longitude" value="" placeholder="longitude here">
        <input type="text" name="latitude" value="" placeholder="latitude here">
        <input type="text" name="radius" value=""  placeholder="radius here">
      </form>

    </div>
  </div>
</div>
@endsection
