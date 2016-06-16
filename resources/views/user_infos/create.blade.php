@extends('layouts.layout')
@section('css')

@endsection
@section('header')
 
<script src="/Admin/jquery-1.11.3.min.js" type="text/javascript"></script>
<script src="/Admin/jquery-ui.min.js" type="text/javascript"></script>
 <script src="/assets/js/user_validation.js"></script>
 <script src="/Admin/vaildregister.js"></script>
 
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-plus"></i> Register </h1>
    </div>
     <script>

$(document).ready(function($) {

  $('#governorate').on('change',function(e){

    console.log(e);
    var governrate_id =e.target.value;

    //Ajax

  $.get('/ajax-governrate?governorate_id='+ governrate_id,function(data){
         $('#city').empty();
        console.log(data);
        $.each(data,function(index,cityobj){

          $('#city').append('<option value="'+cityobj.id+'">'+cityobj.name+'</option>');

          });
      });
  });

     
      $("#datetimepicker").keydown(function(event){
          event.preventDefault();          
      }); 

      $("#datetimepicker").datepicker({
          dateFormat: 'yy/mm/dd'
      }); 

});



</script>
    
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-8 col-lg-push-2">

            <form action="{{ route('user_infos.store') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group @if($errors->has('firstName')) has-error @endif">
                       <label for="firstName-field">First Name</label>
                    <input type="text" id="firstName" name="firstName" class="form-control" value="{{ old("firstName") }}" required/>
                       @if($errors->has("firstName"))
                        <span class="help-block">{{ $errors->first("firstName") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('lastName')) has-error @endif">
                       <label for="lastName-field">Last Name</label>
                    <input type="text" id="lastName" name="lastName" class="form-control" value="{{ old("lastName") }}" required/>
                       @if($errors->has("lastName"))
                        <span class="help-block">{{ $errors->first("lastName") }}</span>
                       @endif
                    </div>
                 <div class="form-group @if($errors->has('name')) has-error @endif">
                       <label for="name-field">Username</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ old("name") }}" required/>
                       <span id="uspan" class="help-block"></span>
                       @if($errors->has("name"))
                        <span class="help-block">{{ $errors->first("name") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('password')) has-error @endif">
                       <label for="password-field">Password</label>
                    <input type="password" id="password" name="password" class="form-control" value="{{ old("password") }}" required/>
                       @if($errors->has("password"))
                        <span class="help-block">{{ $errors->first("password") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('cpassword')) has-error @endif">
                       <label for="password-field">Confirm Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" class="form-control" value="{{ old("cpassword") }}" required/>
                       @if($errors->has("cpassword"))
                        <span class="help-block">{{ $errors->first("cpassword") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('email')) has-error @endif">
                       <label for="email-field">Email</label>
                    <input type="text" id="email" name="email" class="form-control" value="{{ old("email") }}" required/>
                      <span id="upan" class="help-block"></span>
                       @if($errors->has("email"))
                        <span class="help-block">{{ $errors->first("email") }}</span>
                       @endif
                    </div>
                      <div class="form-group @if($errors->has('name')) has-error @endif">
                       <label for="governorate-field">Select Your Governorate</label>
                         <select class="form-control" name="level" id="governorate" required>
                          @foreach ($governrate as $key => $value)
                              <option value="{{ $value['id'] }}">{{ $value['name'] }}</option>
                          @endforeach
                      </select>
                   
                    </div>
                    <div class="form-group @if($errors->has('name')) has-error @endif">
                       <label for="governorate-field">Select Your City</label>
                         <select class="form-control" name="city" id="city" required> 
                      </select>
                   
                    </div>
                <div class="form-group @if($errors->has('nationalid')) has-error @endif">
                       <label for="nationalid-field">Nationalid</label>
                    <input type="text" id="nationalid" name="nationalid" class="form-control" value="{{ old("nationalid") }}" required/>
                    <span id="idspan" class="help-block"></span>
                       @if($errors->has("nationalid"))
                        <span class="help-block">{{ $errors->first("nationalid") }}</span>
                       @endif
                    </div>
                    
                    <div class="form-group @if($errors->has('address')) has-error @endif">
                       <label for="address-field">Address</label>
                    <textarea class="form-control" id="address-field" rows="3" name="address" style="resize:none" required>{{ old("address") }}</textarea>
                       @if($errors->has("address"))
                        <span class="help-block">{{ $errors->first("address") }}</span>
                       @endif
                    </div>


                    <div class="form-group @if($errors->has('phone')) has-error @endif">
                         <label for="phone-field">BirthDate</label>
                      <input type="text" class="form-control" id="datetimepicker" rows="3" name="birthdate" required>{{ old("birthdate") }}</textarea>
                         @if($errors->has("birthdate"))
                          <span class="help-block">{{ $errors->first("birthdate") }}</span>
                         @endif
                    </div>


                


                    <div class="form-group @if($errors->has('phone')) has-error @endif">
                       <label for="phone-field">Phone</label>
                    <input type="text" class="form-control" id="phone-field" rows="3" name="phone" required>{{ old("phone") }}</textarea>
                       @if($errors->has("phone"))
                        <span class="help-block">{{ $errors->first("phone") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('gender')) has-error @endif">
                       <label for="gender-field">Gender</label>
                    <select class="form-control" required 
                            name="gender">
                        <option value="">Select</option>
                        <option value="male">male</option>
                        <option value="female">female</option>
                    </select>
                       @if($errors->has("gender"))
                        <span class="help-block">{{ $errors->first("gender") }}</span>
                       @endif
                    </div>
                    
                   <input type="hidden" name="type" value="{{ $type }}"></input>
                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a class="btn btn-link pull-right" href="{{URL::to('/register')}}"><i class="glyphicon glyphicon-backward"></i> Back</a>
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
