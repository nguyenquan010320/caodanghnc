<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Phần mềm quản lý website</title>

  <!-- Styles -->
  <link href="https://cdn.ihappy.vn/css/app.css" rel="stylesheet">

  <!-- Scripts -->
  <script>
    window.Laravel = {!! json_encode([
      'csrfToken' => csrf_token(),
      ]) !!};
    </script>
    @if(substr($_SERVER['HTTP_HOST'], -2,2) != '.l')
    <script type="text/javascript">
      if (location.protocol != 'https:'){
        location.href = 'https:' + window.location.href.substring(window.location.protocol.length);
      }
    </script>
    @endif
  </head>
  <body>
    <div id="app">
      <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
          <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
              <span class="sr-only">Toggle Navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="/admin">Phần mềm quản lý website</a>
          </div>
          <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
              &nbsp;
            </ul>

            <!-- Right Side Of Navbar -->
                    {{-- <ul class="nav navbar-nav navbar-right">
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Đăng nhập</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Đăng xuất
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                      </ul> --}}
                    </div>
                  </div>
                  @if(empty(env('CUSTOM_AGENCY')))
                  <footer class="main-footer" style="margin-left: 0px;position: fixed;bottom: 0px;width: 100%;background: #fff;padding: 15px;color: #444;border-top: 1px solid #d2d6de;text-align: center;">
                    Website sử dụng phần mềm iHappyCMS - Điện thoại/Zalo hỗ trợ: <a href="tel:84936388025" target="_top">0936 388 025</a> - Email: <a href="mailto:ihappy.asia@gmail.com" target="_top">ihappy.asia@gmail.com</a>
                  </footer>
                  @endif
                </nav>

                @yield('content')
              </div>
              <!-- Scripts -->
              {{-- <script src="js/app.js"></script> --}}
            </body>
            </html>
