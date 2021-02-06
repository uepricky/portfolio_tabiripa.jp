<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

        <title>タビリパ</title>

        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
        <script src="http://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        {{-- <link href="https://fonts.googleapis.com/css?family=Sawarabi+Gothic" rel="stylesheet"> --}}
        
        {{-- jQuery --}}
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>         
        
        {{-- lightbox(showの写真一覧機能) --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js" type="text/javascript"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.css" rel="stylesheet">

        {{-- fontawesome --}}
        <script src="https://kit.fontawesome.com/382d09cdb7.js" crossorigin="anonymous"></script>

        <!-- Styles -->
        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */
            html{line-height:1.15;-webkit-text-size-adjust:100%}a{background-color:transparent}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-t{border-top-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}

            body {
                font-family: 'Nunito';
                color: rgba(0,0,0,0.7);
                /* font-family: "Sawarabi Gothic"; */
                padding: 0;
                margin: 0;
            }
            
            /* PC用 */
            @media(min-width: 600px){
                #between_layout_contant{
                    padding-top: 10rem;
                }
                .nav-icon{
                    padding-top: 1rem;
                    color: rgba(0,0,0,0.2);
                }
                .nav-icon:hover {
                    opacity: 0.7;
                    color: rgba(0,0,0,0.2);
                }
                #nav{
                    /* position: fixed; */
                    width: 100%;
                }
                .navbar-bg {
                    background-color: #c691a5;
                    width:100%;
                    height:2.6rem;
                }
                .navbar-bottom {
                    border-bottom: solid 1px rgba(0,0,0,0.2);
                    height: 4.6rem;
                    width: 100%;
                }
                .title-font {
                    color: rgba(0,0,0,0.5);
                    line-height: 4.6rem;
                    font-size: 2.1rem;
                    font-family: Sawarabi Gothic;
                }
                .navbar-flex {
                    display: flex;
                    justify-content: space-evenly;
                }
            }
            /* スマホ用 */
            @media (max-width: 599px) {
                #between_layout_contant{
                    padding-top: 5rem;
                }
            }
        </style>
    </head>

    <body class="antialiased">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 px-0">
                    <div class="navbar-bg"></div>
                    <div class="navbar-bottom">
                        <div class="row no-gutters">
                            <div class="col-md-4 px-0">
                                <span style="width: 100%"><span>
                            </div>
                            <div class="col-md-4 px-0">
                                <div style="text-align: center;">
                                    <a href="/" style="text-decoration: none;">
                                        <h1 class="title-font">Tabiripa</h1>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-3 px-0" id="nav-logo">
                                <div class="navbar-flex">
                                    @if (Route::has('login'))
                                        <a href="{{ route('postCreate') }}" class="nav-icon" id="create">
                                            <span class="fas fa-pen fa-2x"></span>
                                        </a>
                                        <a href="{{ route('postSearch') }}" class="nav-icon" id="find">
                                            <span class="fas fa-search fa-2x"></span>
                                        </a>
                                        @auth
                                        <div class="btn-group" role="group">
                                            <button id="btnGroupDrop1" type="button" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <img src="{{Auth::user()->profile_photo_url}}" alt="" style="width: 2.5rem; height: 2.5rem; border-radius: 50%;">
                                            </button>
                                            
                                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                <small class="dropdown-item-text text-xs text-gray-400">アカウント管理</small>
                                                <a class="dropdown-item" href="{{ url('/user/profile') }}">プロフィール</a>

                                                <form method="POST" action="{{ route('logout') }}">
                                                    @csrf
                                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                                        onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                                        ログアウト
                                                    </a>
                                                </form>
                                            </div>
                                        </div>

                                        @else
                                            <a href="{{ route('login') }}" class="nav-icon" id="login">
                                                <span class="fas fa-house-user fa-2x"></span>
                                            </a>
                                            <!-- @if (Route::has('register'))
                                                <a href="{{ route('register') }}" class="nav-icon" id="register">
                                                    <span class="fas fa-user-plus fa-2x"></span>
                                                </a>
                                            @endif -->
                                        @endauth
                                    @endif
                                </div>
                            <div>
                            <div class="col-md-1 px-0"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div id="between_layout_contant" class='container-fluid no-gutters px-0'>
            @yield('content')
        </div>

            {{-- <div class="container-fluid px-0">
                <div class="row no-gutters">
                    <div class="col-md-12">
                        <div id="sNav-button" class="row">
                            @if (Route::has('login'))
                                <div class="col-3" id="sCreate">
                                    <a href="{{ route('postCreate') }}" class="">投稿</a>
                                </div>
                                <div class="col-3" style="" id="sFind">
                                    <a href="#" class="">検索</a>
                                </div>
                                @auth
                                    <div class="col-3">
                                        <a href="{{ url('/user/profile') }}" class="" id="">
                                            <img src="{{asset('storage/'.Auth::user()->profile_photo_path)}}" alt="" style="width: 2.5rem; height: 2.5rem; border-radius: 50%;">
                                        </a>
                                    </div>
                                @else
                                    <div class="col-3" id="sLogin">
                                        <a href="{{ route('login') }}" class="">ログイン</a>
                                    </div>
                                    @if (Route::has('register'))
                                        <div class="col-3" id="sRegister">
                                            <a href="{{ route('register') }}" class="">登録</a>
                                        </div>
                                    @endif     
                                @endauth
                            @endif
                        <div>
                    </div>
                </div>
            </div> --}}
        
        <footer>
            @include('post.footer')
        </footer>
    </body>    
</html>
