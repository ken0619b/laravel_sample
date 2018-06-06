@extends('layouts.app')

@section('content')
  <div class="panel panel-default">
      <!-- <div class="panel-heading">
        Trips
      </div> -->
      <div class="panel-body">
        <div class="row" style="padding: 0; margin-bottom: 10px;">
        <!--  search -->
          <div class="col-md-4">
            <!-- <form class="form-inline" action="POST"> -->
            <form action="/trips/search" method="POST">
              {{ csrf_field() }}
              <input type="text" name="q" value="" class="form-control" placeholder="キーワードで絞り込んで下さい。例：「オーストラリア」「モスク」「クラックデシュバリエ」">
          </div>
          <div class="col-md-1 col-md-offset-2">
              <input type="submit" value="Search" class="btn btn-outline-success">
            </div>
          </form>
        @if (Auth::user())
        <div class="col-md-1">
          <a href='{{ url("/trips/create") }}' class="btn btn-outline-primary pull-right">Add</a>
        </div>
        @endif
      </div>
  </div>

    <!-- 現在のtrip -->
    @if (count($trips) > 0)
    <!-- <div class="container-fluid"> -->
    <div class="grid">
      <!-- <div class="card-group"> -->
        @foreach ($trips as $trip)
          <div class="card" style="width:400px">
            <a href='trips/{{$trip->id}}'><img class="card-img-top" src="{{ $trip->hero_image_path }}" alt="{{ $trip->title }}"></a>
            <div class="card-body">
              <h4 class="card-title">{{ $trip->title }}</h4>
              <h6 class="card-subtitle mb-2 text-muted">{{ $trip->destination->area }}</h6>
              <p class="card-text">{{ str_limit($trip->description, $limit = 50, $end = '…') }}</p>
              @if (Auth::user())
                <form action="trips/{{ $trip -> id}}" method="POST">
                  {{ csrf_field() }}
                  {{ method_field('delete') }}
                  <input type="submit" value="Delete" class="btn btn-outline-danger">
                </form>
              @endif
            </div>
          </div>
        @endforeach
      </div>
    <!-- </div> -->
    @endif
  </div>
@endsection
