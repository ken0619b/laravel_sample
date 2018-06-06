@extends('layouts.app')

@section('content')
    <!-- Bootstrapの定形コード… -->
    <div class="panel-body">
      <h3>asasasa</h3>
        <!-- バリデーションエラーの表示 -->
        @include('common.errors')

        <!-- 新tripフォーム -->
        <form action="/trips" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <!-- trip名 -->
            <div class="form-group">
                <label for="task" class="col-sm-3 control-label">Trips</label>

                <div class="col-sm-6">
                  <div class="form-group">
                    {!! Form::label('title', '目的地:') !!}
                    {!! Form::label('title', $trip->title) !!}
                  </div>
                  <div class="form-group">
                    {!! Form::label('description', '詳細:') !!}
                    {!! Form::label('title', $trip->description) !!}
                  </div>
                  <div class="form-group">
                    {!! Form::label('destination', '地域:') !!}
                    {!! Form::select('destination', $plucked_destinations, $trip->destination_id, ['class' => 'form-control', 'name' => 'trip_destination']) !!}
                    <div class="form-group">
                      <img src="{{$trip->hero_image_path}}"/>
                </div>
            </div>
          </div>
        </form>
        <a href='{{ url("/trips") }}' class="btn btn-outline-primary pull-right">Back</a>
      </div>

@endsection
