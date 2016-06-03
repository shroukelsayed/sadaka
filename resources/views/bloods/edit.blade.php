@extends('layouts.adminlayout')
@section('css')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker.css" rel="stylesheet">
@endsection
@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-edit"></i> Bloods / Edit #{{$blood->id}}</h1>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('bloods.update', $blood->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group @if($errors->has('name')) has-error @endif">
                       <label for="name-field">Name</label>
                    <textarea class="form-control" id="name-field" rows="3" name="name">{{ $blood->person->personInfo->name }}</textarea>
                       @if($errors->has("name"))
                        <span class="help-block">{{ $errors->first("name") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('address')) has-error @endif">
                       <label for="address-field">Address</label>
                    <textarea class="form-control" id="address-field" rows="3" name="address">{{ $blood->person->personInfo->address }}</textarea>
                       @if($errors->has("address"))
                        <span class="help-block">{{ $errors->first("address") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('birthdate')) has-error @endif">
                       <label for="birthdate-field">BirthDate</label>
                    <input type="text" id="birthdate-field" name="birthdate" class="form-control" value="{{ $blood->person->personInfo->birthdate }}"/>
                       @if($errors->has("birthdate"))
                        <span class="help-block">{{ $errors->first("birthdate") }}</span>
                       @endif
                    </div>
                    <div class="form-group">
                      <label for="governorate_id_field">Governorate Name </label>
                      <select name="governorate_id" id="governorate_id_field">
                          @foreach ($governorates as $key => $value)
                              <option value="{{ $key+1 }}" selected>{{ $blood->person->personInfo->governorate->name }}</option>
                          @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="city_id_field">City Name </label>
                      <select name="city_id" id="city_id_field">
                          @foreach ($cities as $key => $value)
                              <option value="{{ $key+1 }}">{{ $blood->person->personInfo->city->name }}</option>
                          @endforeach
                      </select>
                 <div class="form-group @if($errors->has('gender')) has-error @endif">
                       <label for="gender-field">Gender</label>
                    <input type="text" id="gender-field" name="gender" class="form-control" value="{{ $blood->person->personInfo->gender }}"/>
                       @if($errors->has("gender"))
                        <span class="help-block">{{ $errors->first("gender") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('maritalstatus')) has-error @endif">
                       <label for="maritalstatus-field">Maritalstatus</label>
                    <input type="text" id="maritalstatus-field" name="maritalstatus" class="form-control" value="{{ $blood->person->personInfo->maritalstatus }}"/>
                       @if($errors->has("maritalstatus"))
                        <span class="help-block">{{ $errors->first("maritalstatus") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('phone')) has-error @endif">
                       <label for="phone-field">Phone</label>
                    <input type="text" id="phone-field" name="phone" class="form-control" value="{{ $blood->person->personInfo->phone }}"/>
                       @if($errors->has("phone"))
                        <span class="help-block">{{ $errors->first("phone") }}</span>
                       @endif
                    </div>
                <div class="form-group @if($errors->has('publishat')) has-error @endif">
                       <label for="publishat-field">Publishat</label>
                    <input type="text" id="publishat-field" name="publishat" class="form-control" value="{{ $blood->person->publishat }}" disabled/>
                       @if($errors->has("publishat"))
                        <span class="help-block">{{ $errors->first("publishat") }}</span>
                       @endif
                    </div>
                    <div class="form-group">
                      <label for="interval_type_id_field">Interval Type </label>
                      <select name="interval_type_id" id="interval_type_id_field">
                          @foreach ($interval_types as $key => $value)
                              <option value="{{ $key+1 }}">{{ $blood->person->intervalType->type }}</option>
                          @endforeach
                      </select>
                    </div>



                <div class="form-group @if($errors->has('bloodtype')) has-error @endif">
                       <label for="bloodtype-field">Bloodtype</label>
                    <input type="text" id="bloodtype-field" name="bloodtype" class="form-control" value="{{ $blood->bloodtype }}"/>
                       @if($errors->has("bloodtype"))
                        <span class="help-block">{{ $errors->first("bloodtype") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('amount')) has-error @endif">
                       <label for="amount-field">Amount</label>
                    <input type="text" id="amount-field" name="amount" class="form-control" value="{{ $blood->amount }}"/>
                       @if($errors->has("amount"))
                        <span class="help-block">{{ $errors->first("amount") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('hospital')) has-error @endif">
                       <label for="hospital-field">Hospital</label>
                    <textarea class="form-control" id="hospital-field" rows="3" name="hospital">{{ $blood->hospital }}</textarea>
                       @if($errors->has("hospital"))
                        <span class="help-block">{{ $errors->first("hospital") }}</span>
                       @endif
                    </div>
                    <div class="form-group">
                      <label for="governorate_id_field">Governorate Name </label>
                      <select name="governorate_id" id="governorate_id_field">
                          @foreach ($governorates as $key => $value)
                              <option value="{{ $key+1 }}" selected>{{ $blood->governorate->name }}</option>
                          @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="city_id_field">City Name </label>
                      <select name="city_id" id="city_id_field">
                          @foreach ($cities as $key => $value)
                              <option value="{{ $key+1 }}">{{ $blood->city->name }}</option>
                          @endforeach
                      </select>
                    <div class="form-group @if($errors->has('address')) has-error @endif">
                       <label for="address-field">Address</label>
                    <textarea class="form-control" id="address-field" rows="3" name="address">{{ $blood->address }}</textarea>
                       @if($errors->has("address"))
                        <span class="help-block">{{ $errors->first("address") }}</span>
                       @endif
                    </div>
                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a class="btn btn-link pull-right" href="{{ route('bloods.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>
                </div>
            </form>

        </div>
    </div>
@endsection
@section('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"></script>
  <script>
    $('.date-picker').datepicker({
    });
  </script>
@endsection
