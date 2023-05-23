@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                @if(Session::has('message'))
                  <p>{{ Session::get('message')}}</p>
                @endif

                <div class="card-body">
                    <form method="POST" action="{{route('save_user') }}">
                        @csrf

                        <input type="hidden" name="name" value="{{$_GET['name']}}" >
                        <input type="hidden" name="email" value="{{$_GET['email']}}">
                        <input type="hidden" name="country" value="{{$_GET['country']}}">

                                                <div id="pass" >

                                                  @if($error !="")
                                                      <p style="color:black">{{$error}}</p>
                                                  @endif
                                                  <div class="row mb-3">
                                                    <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                                    <div class="col-md-6">
                                                        <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">


                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label name="confirm_password" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                                    <div class="col-md-6">
                                                        <input name="confirm_password" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                                    </div>
                                                </div>

                                                </div>




                                <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" >
                                    {{ __('register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
