@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Đăng nhập/Login</div>
        <div class="panel-body">
          <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            @if(!empty(LANGUAGE_NAMES))
            @php($languageName = unserialize(LANGUAGE_NAMES))
            @endif
            @if(!empty(LANGUAGES))
            @php($languageSetting = unserialize(LANGUAGES))
            @if(!empty($languageSetting))
            <div class="form-group">
              <label for="email" class="col-md-4" style="text-align: right;line-height: 1.2;">Chọn phiên bản cần chỉnh sửa:<br><span style="font-weight: normal;font-size: 12px;font-style: italic;">Choose version to manage</span></label>
              <div class="col-md-8">
                <p style="margin-bottom: 0px">
                  @foreach($languageSetting as $l=>$k)
                  @if(isset($languageName[$k]))
                  <a href="//{!!$l!!}/admin" style="margin-right: 10px">{!!$languageName[$k]['title'] or ''!!}</a>
                  @endif
                  @endforeach
                </p>
              </div>
            </div>
            @endif
            @endif

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
              <label for="email" class="col-md-4 control-label" style="line-height: 1.2;">Tài khoản<br><span style="font-weight: normal;font-size: 12px;font-style: italic;">Account</span></label>
              <div class="col-md-6">
                <input id="email" type="text" class="form-control" name="email" {{-- value="admin@website.com" --}} required autofocus>

                @if ($errors->has('email'))
                <span class="help-block">
                  <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
              <label for="password" class="col-md-4 control-label" style="line-height: 1.2;">Mật khẩu<br><span style="font-weight: normal;font-size: 12px;font-style: italic;">Password</span></label>
              <div class="col-md-6">
                <input id="password" type="password" class="form-control" name="password" required>
                @if ($errors->has('password'))
                <span class="help-block">
                  <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <div class="checkbox">
                  <label style="line-height: 1.2;">
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Ghi nhớ đăng nhập<br><span style="font-weight: normal;font-size: 12px;font-style: italic;">Remember login</span>
                  </label>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-8 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                  Đăng nhập/Login
                </button>

                                {{-- <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Bạn quên mật khẩu?
                                  </a> --}}
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endsection
