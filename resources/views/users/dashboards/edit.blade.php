@extends('users.layouts.app-dashboard')

@section('title', 'Dashboard | Account Information')

@section('content')
<nav class="breadcrumb">
    <a class="breadcrumb-item" href="{{ route('dashboard') }}">Dashboard</a>
    <a class="breadcrumb-item" href="{{ route('dashboard.user',auth()->user()->id) }}">Account Information</a>
    <span class="breadcrumb-item">Edit Profile</span>
</nav>

<div class="card">
  <div class="card-header">
    Edit Profile
  </div>
  <div class="card-body">
    <div class="form-group">
      <label for="name">Name</label>
      <input type="text" class="form-control" name="name" id="name" min="1" autocomplete="off" value="{{ auth()->user()->name }}" required>
      @if ($errors->has('name'))
      <span class="help-block error">
          <strong>{{ $errors->first('name') }}</strong>
      </span>
      @endif
    </div>

    <div class="form-group">
      <label for="phone_number">Phone Number</label>
      <input type="number" class="form-control" name="phone_number" id="phone_number" min="1" autocomplete="off" value="{{ auth()->user()->phone_number }}" required>
      @if ($errors->has('phone_number'))
      <span class="help-block error">
          <strong>{{ $errors->first('phone_number') }}</strong>
      </span>
      @endif
    </div>

    <div class="form-group">
      <label for="lot_block" class="col-form-label">Lot/Blk No.<small class="text-info"><strong>*Optional</strong></small></label>
      <input id="lot_block" type="text" class="form-control" name="lot_block" value="{{ auth()->user()->lot_block }}" autofocus>
    </div>

    <div class="form-group {{ $errors->has('street') ? 'has-error' : '' }}">
      <label for="street" class="col-form-label">Street</label>
      <input id="street" type="text" class="form-control" name="street" value="{{ auth()->user()->street }}" autofocus>
      @if ($errors->has('street'))
      <span class="help-block error">
          <strong>{{ $errors->first('street') }}</strong>
      </span>
      @endif
    </div>


    <div class="form-group {{ $errors->has('subdivision_barangay') ? 'has-error' : '' }}">
      <label for="subdivision_barangay" class="col-form-label">Subdivision / Barangay</label>
      <input id="subdivision_barangay" type="text" class="form-control" name="subdivision_barangay" value="{{ auth()->user()->subdivision_barangay }}" autofocus>
      @if ($errors->has('subdivision_barangay'))
      <span class="help-block error">
          <strong>{{ $errors->first('subdivision_barangay') }}</strong>
      </span>
      @endif
    </div>

    <div class="form-group {{ $errors->has('city_municipality') ? 'has-error' : '' }}">
      <label for="city_/_municipality" class="col-form-label">City / Municipality</label>
      <input id="city_municipality" type="text" class="form-control" name="city_municipality" value="{{ auth()->user()->city_municipality }}" autofocus>
      @if ($errors->has('city_municipality'))
      <span class="help-block error">
          <strong>{{ $errors->first('city_municipality') }}</strong>
      </span>
      @endif
    </div>

    <div class="form-group{{ $errors->has('province') ? 'has-error' : '' }}">
      <label for="province" class="col-form-label">Province</label>
      <input id="province" type="text" class="form-control" name="province" value="{{ auth()->user()->province }}" autofocus>
      @if ($errors->has('province'))
      <span class="help-block error">
          <strong>{{ $errors->first('province') }}</strong>
      </span>
      @endif
    </div>

    <div class="form-group {{ $errors->has('zip_code') ? 'has-error' : '' }}">
      <label for="zip_code" class="col-form-label">Zip Code</label>
      <input id="zip_code" type="number" class="form-control" name="zip_code" value="{{ auth()->user()->zip_code }}" autofocus>
      @if ($errors->has('zip_code'))
      <span class="help-block error">
          <strong>{{ $errors->first('zip_code') }}</strong>
      </span>
      @endif
    </div>
  </div>
  <div class="card-footer">
    <button type="submit" class="btn add-to-cart-button anp-btn float-right" style="cursor: pointer;">Save Changes</button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal" style="cursor: pointer;">Close</button>
  </div>
</div>





@endsection
