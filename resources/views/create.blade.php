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
                    <input type="text" name="trip_title" id="trip-title" class="form-control">
                  </div>
                  <div class="form-group">
                    {!! Form::label('description', '詳細:') !!}
                    <input type="text" name="trip_description" id="trip-description" class="form-control">
                  </div>
                  <div class="form-group">
                    {!! Form::label('destination', '地域:') !!}
                    {!! Form::select('destination', $plucked_destinations, $plucked_destinations[1], ['class' => 'form-control', 'name' => 'trip_destination']) !!}
                    <div class="form-group">
                      {!! Form::label('hero_image_path', '画像URL:') !!}
                      <input type="text" name="trip_hero" id="trip-hero" class="form-control">
                </div>
            </div>

            <!-- trip追加ボタン -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-outline-primary">
                        <i class="fa fa-plus"></i> Create
                    </button>
                </div>
            </div>
          </div>
        </form>
      </div>

@endsection
