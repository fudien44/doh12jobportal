@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<span id="particles-js" ></span>
<div class="content-header mt-3">
  <div class="container">
    <div class="row mb-2">
      <div class="col-sm-6">
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}<span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input type="text" oninput="this.value = this.value.toUpperCase()" class="form-control @error('fname') is-invalid @enderror" name="fname" value="{{old('fname')}}" required autocomplete="fname" autofocus>

                                @error('fname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Middle Name') }}</label>

                            <div class="col-md-6">
                                <input type="text" oninput="this.value = this.value.toUpperCase()" class="form-control @error('mname') is-invalid @enderror" value="{{old('mname')}}" name="mname" autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}<span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input type="text" oninput="this.value = this.value.toUpperCase()" class="form-control @error('lname') is-invalid @enderror" name="lname" value="{{old('lname')}}" required autocomplete="lname" autofocus>

                                @error('lname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}<span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Contact No') }}<span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input type="number" oninput="this.value = this.value.toUpperCase()" class="form-control @error('contactno') is-invalid @enderror" name="contactno" value="{{ old('contactno') }}" required placeholder="e.g(09123456789)" autofocus>

                                @error('lname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}<span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror txt-pw" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}<span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control txt-pw" name="password_confirmation" required autocomplete="new-password">
                                <div class="custom-control custom-checkbox">
                                  <input class="custom-control-input show-pw" type="checkbox" id="customCheckbox1">
                                  <label for="customCheckbox1" class="custom-control-label">Show Password</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row text-center">
                            <div class="col-md-4"></div>
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                  <span class="captcha-code">{!! captcha_img('default') !!}</span>
                                  <input type="text" class="form-control {{ $errors->has('captcha') ? ' is-invalid' : '' }}" name="captcha" required placeholder="Enter Captcha">
                                  <div class="input-group-append">
                                    <div class="input-group-text">
                                      <span class="fas fa-sync-alt btn-refresh-captcha"></span>
                                    </div>
                                  </div>
                                 @if ($errors->has('captcha'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('captcha') }}</strong>
                                  </span>
                                  @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success btn-block">
                                    {{ __('Register') }}
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
@section('js')
<script type="text/javascript">


$(".btn-refresh-captcha").click(function(){
  $.ajax({
     type:'GET',
     url:'{{secure_url("/refresh_captcha")}}',
     success:function(data){
        $(".captcha-code").html(data.captcha);
     }
  });
});
$(".show-pw").click(function(){
  if($(this).is(':checked')) {
    $('.txt-pw').attr('type','text');
  } else {
    $('.txt-pw').attr('type','password');
  }
});


</script>
@endsection
