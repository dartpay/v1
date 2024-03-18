@extends($activeTemplate.'layouts.master')


@section('content')
<div class="container mt-5 mb-5">
    <form class="register py-3 pe-3 ps-3 ps-md-0" action="" method="post"  enctype="multipart/form-data">
        <div class="row" style="padding: 0 36px;">
            @csrf
            <div class="col-4 border-radius custom--card" style="background: #fff;">
                <div class="user-thumb user-thumb--edit">
                    <div class="custom-file text-center">
                        <div class="" data-provides="fileinput">
                            <input accept="image/jpeg,image/png" class="d-none custom-file__input" id="photo" type="file" name="image" accept="image/*">
                            <label class="custom-file__label mt-4" data-trigger="fileinput" style="position: relative;" for="photo">
                                <img style="width: 6rem;height: 6rem;" alt="" class="thumb--lg rounded-circle fileinput-new thumbnail" src="{{ getImage('assets/images/user/profile/'. $user->image) }}">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </label>
                        </div>
                    </div>
                </div>
                <ul class="list-group mt-4 list-group-flush bg--light h-100 p-3">
                    <li class="list-group-item d-flex flex-column justify-content-between border-0 bg-transparent">
                        <span class="fw-bold text-muted">{{$user->username}}</span>
                        <small class="text-muted"> <i class="la la-user"></i> @lang('Username')</small>
                    </li>

                    <li class="list-group-item d-flex flex-column justify-content-between border-0 bg-transparent">
                        <span class="fw-bold text-muted">{{$user->email}}</span>
                        <small class="text-muted"><i class="la la-envelope"></i> @lang('Email')</small>
                    </li>

                    <li class="list-group-item d-flex flex-column justify-content-between border-0 bg-transparent">
                        <span class="fw-bold text-muted">{{$user->mobile}}</span>
                        <small class="text-muted"><i class="la la-mobile"></i> @lang('Mobile')</small>
                    </li>

                    <li class="list-group-item d-flex flex-column justify-content-between border-0 bg-transparent">
                        <span class="fw-bold text-muted">{{$user->address->country}}</span>
                        <small class="text-muted"><i class="la la-globe"></i> @lang('Country')</small>
                    </li>

                    <li class="list-group-item d-flex flex-column justify-content-between border-0 bg-transparent">
                        <span class="fw-bold text-muted">{{$user->address->city}}</span>
                        <small class="text-muted"><i class="la la-map-marked"></i>@lang('Address')</small>
                    </li>
                </ul>
            </div>

            <div class="col-md-12 ml-5 col-lg-7  border-radius custom--card" style="background: #fff;">
                    <h5 class="mt-4 mb-5">Update Profile</h5>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label required" for="InputFirstname">@lang('First Name')</label>
                                <input type="text" class="form-control" id="InputFirstname" name="firstname"
                                           placeholder="@lang('First Name')" value="{{$user->firstname}}" required="">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label required" for="lastname">@lang('Last Name')</label>
                                <input type="text" class="form-control" id="lastname" name="lastname"
                                           placeholder="@lang('Last Name')" value="{{$user->lastname}}" required="">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label required" for="address">@lang('Address:')</label>
                                <input type="text" class="form-control" id="address" name="address"
                                           placeholder="@lang('Address')" value="{{$user->address->address}}" required="">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label required" for="state">@lang('State:')</label>
                                <input type="text" class="form-control" id="state" name="state"
                                           placeholder="@lang('state')" value="{{$user->address->state}}" required="">
                            </div>
                        </div>
                        
                        <div class="form-group col-sm-12">
                            <label for="email" class="col-form-label">@lang('Country')</label>
                            <input type="text" name="country" id="country" class="form-control" value="{{$user->address->country}}" readonly>

                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label required" for="zip">@lang('Zip Code')</label>
                                <input type="text" class="form-control" id="zip" name="zip"
                                           placeholder="@lang('Zip Code')" value="{{$user->address->zip}}" required="">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label required" for="city">@lang('City')</label>
                                <input type="text" class="form-control" id="city" name="city"
                                           placeholder="@lang('city')" value="{{$user->address->city}}" required="">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">@lang('Update Profile')</button>
            </div>
        </div>
    </form>
</div>
@endsection


@push('script')

@endpush

@push('style')
    <style>
        .custom-file__input {
    height: 1px;
    opacity: 0;
    position: absolute;
    visibility: hidden;
    width: 1px;
}
.custom-file__label:before {
    background: #fdfdfd url("data:image/svg+xml;charset=utf-8,%3Csvg width=%2724%27 height=%2724%27 fill=%27none%27 xmlns=%27http://www.w3.org/2000/svg%27%3E%3Cpath fill-rule=%27evenodd%27 clip-rule=%27evenodd%27 d=%27M9.558 1H14.442a3 3 0 0 1 2.999 2.162l.008.022c.046.139.056.168.065.189a1 1 0 0 0 .867.625c.023.002.057.002.213.002h.056c.315 0 .547 0 .744.02a4 4 0 0 1 3.587 3.586c.02.197.02.42.019.72v7.915c0 .805 0 1.47-.044 2.01-.046.563-.145 1.08-.392 1.565a4 4 0 0 1-1.748 1.748c-.485.247-1.002.346-1.564.392-.541.044-1.206.044-2.01.044H6.758c-.805 0-1.47 0-2.01-.044-.563-.046-1.08-.145-1.565-.392a4 4 0 0 1-1.748-1.748c-.247-.485-.346-1.002-.392-1.564C1 17.71 1 17.046 1 16.242V8.324c0-.3 0-.522.02-.72A4 4 0 0 1 4.606 4.02C4.804 4 5.035 4 5.35 4h.056c.156 0 .19 0 .213-.002a1 1 0 0 0 .867-.625 4.16 4.16 0 0 0 .065-.19l.008-.021c.035-.105.065-.196.099-.281A3 3 0 0 1 9.26 1.005C9.352 1 9.448 1 9.558 1Zm.023 2c-.147 0-.177 0-.2.002a1 1 0 0 0-.867.625 4.16 4.16 0 0 0-.073.211c-.035.105-.065.196-.099.281A3 3 0 0 1 5.74 5.995C5.648 6 5.548 6 5.43 6h-.025c-.395 0-.518.001-.603.01A2 2 0 0 0 3.01 7.803c-.009.086-.01.2-.01.574V16.2c0 .857 0 1.439.038 1.889.035.438.1.663.18.819a2 2 0 0 0 .874.874c.156.08.38.145.82.18C5.361 20 5.942 20 6.8 20h10.4c.857 0 1.439 0 1.889-.038.438-.035.663-.1.819-.18a2 2 0 0 0 .874-.874c.08-.156.145-.38.18-.819.037-.45.038-1.032.038-1.889V8.377a7.07 7.07 0 0 0-.01-.574 2 2 0 0 0-1.793-1.793 7.666 7.666 0 0 0-.603-.01h-.025c-.117 0-.217 0-.309-.005a3 3 0 0 1-2.701-2.157l-.008-.022a4.104 4.104 0 0 0-.065-.189 1 1 0 0 0-.867-.625 4.144 4.144 0 0 0-.2-.002H9.58ZM12 9.5a3 3 0 1 0 0 6 3 3 0 0 0 0-6Zm-5 3a5 5 0 1 1 10 0 5 5 0 0 1-10 0Z%27 fill=%27%23050505%27/%3E%3C/svg%3E") no-repeat 50%;
    background-size: 1.5rem auto;
    border: 2px solid #488af7;
    border-radius: 100%;
    bottom: 0;
    box-shadow: 0 6px 6px -3px rgba(0,0,0,.2),0 10px 14px 1px rgba(0,0,0,.14),0 4px 18px 3px rgba(0,0,0,.12);
    content: "";
    height: 2.5rem;
    position: absolute;
    cursor: pointer;
    right: 0;
    text-align: center;
    transition: all .15s ease-in-out;
    width: 2.5rem;
    z-index: 20
}
.fw-bold{font-weight: 700}
.register .form-group label{
    font-weight: 600;
    font-size: 15px;
}
.register input{
    height: calc(2em + 0.75rem + 2px);
    padding: 0.375rem 0.75rem;
}
.register button{
    min-width: 150px;
    padding: 8px 30px;
    font-weight: 600;
}
.register button:focus, .register button:hover {
  color: #ffffff;
  -webkit-box-shadow: 0 10px 20px rgba(114, 62, 235, 0.4);
          box-shadow: 0 10px 20px rgba(114, 62, 235, 0.4);
}
.border-radius{
    border-radius: 10px;
}
.thumbnail img{
    width: 6rem;
    height: 6rem;
    border-radius: 50% !important;
}
    
    </style>    
@endpush