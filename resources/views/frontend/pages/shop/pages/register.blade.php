@extends('frontend.pages.shop.master.template')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb breadcrumb2">
        <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
        <li class="breadcrumb-item">Register</li>
      </ol>
    </nav>
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="text-center mb-4 mt-4">
          <h2>New <span class="orang">Account</span></h2>
        </div>
      </div>
      <form method="POST" action="{{ route('register') }}">
        @csrf
      <div class="col-lg-8 col-md-12 mb-5">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label class="form-label">Email Address</label>
              <input type="text" class="form-control" id="email" name="email">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label class="form-label">First Name</label>
              <input type="text" class="form-control" id="firstname" name="firstname">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label class="form-label">Last Name</label>
              <input type="text" class="form-control" id="lastname" name="lastname">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label class="form-label">Address</label>
              <input type="text" class="form-control" id="address" name="address">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label class="form-label">Contact Number</label>
              <input type="text" class="form-control" id="contact_number" name="contact_number">
            </div>
          </div>
          <div class="form-group col-md-12">
            <label for="inputState">City</label>
            <select id="city_id" name="city_id" class="form-control" required> 
                @foreach ($cities as $city)
                    <option value="{{$city->id}}">{{$city->city_name}}</option>
                @endforeach
            </select>
          </div>
         
          </div>
          <div class="col-md-8 col-12">
            <div class="form-group">
              <input type="submit" class="add-to-cart2 btn mt-31" value="Create Account">
              <a type="button" class="add-to-cart2 btn mt-31" href="{{('/shop/login')}}">Login</a>
            </div>
          </div>
        </div>
      </form>
      </div>
    </div>
  </div>
@endsection