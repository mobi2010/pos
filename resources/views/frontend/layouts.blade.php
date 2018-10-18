<!DOCTYPE html>
<!-- saved from url=(0038)http://huiyi.shougan.com.cn/home/index -->
<html lang="en" class=" js ">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>框架区块链平台</title>
    <!-- Bootstrap -->
    <link href="{{ URL::asset('css/frontend/bootstrap.min.css') }}" rel="stylesheet" />
    <!-- Boots Nav -->
    <link href="{{ URL::asset('css/frontend/bootsnav.css') }}" rel="stylesheet" />
    <!-- Themify Icons -->
    <link href="{{ URL::asset('css/frontend/themify-icons.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <link href="{{ URL::asset('css/frontend/font-awesome.min.css') }}" rel="stylesheet" />
    <!-- Animate CSS -->
    <link href="{{ URL::asset('css/frontend/animate.css') }}" rel="stylesheet" />
    <!-- Magnific Popup -->
    <link href="{{ URL::asset('css/frontend/magnific-popup.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('css/frontend/owl.carousel.css') }}" rel="stylesheet" />
    <!-- Custom Style -->
    <link href="{{ URL::asset('css/frontend/style.css') }}" rel="stylesheet" />
    <!-- Color CSS -->
    <link href="{{ URL::asset('css/frontend/color_01.css') }}" rel="stylesheet" />

    <link href="{{ URL::asset('css/frontend/docs.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('css/frontend/patch.css') }}" rel="stylesheet" />
    <style>
        .img-item img {
            padding-top: 80px;
        }

        .ptb-50 {
            padding: 100px 0px 0px 0px;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <!-- 导航-->
        <header class="header-wrapper gradient-bg polyline-bg">
            <nav class="navbar navbar-default navbar-fixed white bootsnav on no-full no-background">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                            <i class="fa fa-bars"></i>
                        </button>
                        <a class="navbar-brand" href="index.html">
                            <img src="{{ URL::asset('images/frontend/kj-logo.png') }}" class="logo logo-display" alt="">
                            <img src="{{ URL::asset('images/frontend/kj-logo.png') }}" class="logo logo-scrolled" alt="">
                        </a>
                    </div>
                    <div class="collapse navbar-collapse" id="navbar-menu">
                        <ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOutUp">
                            <li class="dropdown">
                                <a href="index.html">主页</a>
                            </li>
                            <li class="dropdown">
                                <a href="news.html">动态</a>
                            </li>
                            <li class="dropdown">
                                <a href="about.html">关于我们</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="container-fluid ">
                <div class="row banner-content">
                    <div class="banner-meta container">
                        <h1>框架区块链</h1>
                        <p class="lead">
                            区块链是一种分布式、安全、可靠、加密的数据存储技术 – 其特点是<br>去中心化、不可篡改、开放透明、可审计。<br>
                        </p>
                        <!-- <a href="files/框架区块链技术实践白皮书_V1.1_20180821.pdf">
                            <img src="{{ URL::asset('images/frontend/download.png') }}"  style="cursor:pointer;">
                        </a> -->
                    </div>
                </div>
                <div class="particle-section" id="particles">
                </div>
            </div>
            <!--<div class="particle-section" id="particles">-->
            <!--</div>-->
        </header>
        

        @section('content')
        @show



        <footer id="footer" class="light-footer" style="color: #ccc;padding-top: 24px; min-height: 88px;margin-top: 10px;background-color: #1F2126;font-size: 14px;height: 20em ">
            <div style="float: left;margin: 1em 10em">
                <h4 style="color:#FFF">框架区块链</h4>
                <div style="display: inline-block">
                   帮助与支持<br/>
                    Q&A<br/>
                    开发指南<br/> 
                </div>
                <div style="display: inline-block;margin-left: 20em">
                    联系我们<br/>
                    Email:business@framework.com<br/>
                </div>
                <hr/>
                <h4 style="color:#FFF">Framework Technology</h4>
                Copyright @2016-2018 framework.com 框架区块链版权所有
            </div>
            <div style="float: right;margin-right: 10em;padding-top: 3em">
                <div style="text-align: center;">
                <img src="{{ URL::asset('images/frontend/qr.jpeg') }}"  style="cursor:pointer;height: 12em">               
                </div>
                <div>
                    扫码关注框架区块链了解最新动态
                </div>
            </div>
        </footer><!-- End Footer -->
        <!-- jQuery -->

        <script src="{{ URL::asset('js/frontend/jquery.v2.js') }}"></script>
        <!-- Bootstrap JS -->
        <script src="{{ URL::asset('js/frontend/bootstrap.min.js') }}"></script>
        <!-- Modenizer JS -->
        <script src="{{ URL::asset('js/frontend/modernizr-custom.js') }}"></script>
        <!-- Bootsvav Menu -->
        <script src="{{ URL::asset('js/frontend/bootsnav.js') }}"></script>
        <!-- Parallax -->
        <script src="{{ URL::asset('js/frontend/paraxify.min.js') }}"></script>
        <!-- Parallax -->
        <script src="{{ URL::asset('js/frontend/jquery.particleground.min.js') }}"></script>
        <!-- Magnific Popup -->
        <script src="{{ URL::asset('js/frontend/jquery.magnific-popup.min.js') }}"></script>
        <!-- Custom JS -->
        <script src="{{ URL::asset('js/frontend/custom.js') }}"></script>
        <!-- ==============================================
                ** STYLE SWITCHER-ONLY FOR DEMO PURPOSE**
        =============================================== -->
        <!--Style Switcher Script-->
        <script src="{{ URL::asset('js/frontend/style-switcher.js') }}"></script>
        <script src="{{ URL::asset('js/frontend/jquery.counterup.min.js') }}"></script>
        <!-- Way Points -->
        <script src="{{ URL::asset('js/frontend/waypoints.min.js') }}"></script>
        <!-- Conterup -->
        <script src="{{ URL::asset('js/frontend/jquery.counterup.min.js') }}"></script>
        <!-- Magnific Popup -->
        <script src="{{ URL::asset('js/frontend/jquery.magnific-popup.min.js') }}"></script>
        <!-- Owl Carousal -->
        <script src="{{ URL::asset('js/frontend/owl.carousel.min.js') }}"></script>


        <!--End Style Switcher-->

    </div>
</body>
</html>

<script type="text/javascript">
    $(document).ready(function() {     

   })
</script> 