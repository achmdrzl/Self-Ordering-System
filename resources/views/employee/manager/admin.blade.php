
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard &mdash; Arfa</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
        integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
        crossorigin="anonymous" />

    <link rel="stylesheet" href="{{asset('employee/vendor/bootstrap/dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('employee/vendor/themify-icons/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('employee/vendor/perfect-scrollbar/css/perfect-scrollbar.css')}}">

    <!-- CSS for this page only -->
{{-- <link rel="stylesheet" href="{{asset('employee/vendor/chart.js/dist/Chart.min.css')}}">
<link href="{{asset('employee/vendor/datatables.net-dt/css/jquery.dataTables.min.css')}}" rel="stylesheet" />
<link href="{{asset('employee/vendor/datatables.net-responsive-dt/css/responsive.dataTables.min.css')}}" rel="stylesheet" /> --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>

    <!-- End CSS  -->

    <link rel="stylesheet" href="{{asset('employee/assets/css/style.min.css')}}">
    <link rel="stylesheet" href="{{asset('employee/assets/css/bootstrap-override.min.css')}}">
    <link rel="stylesheet" id="theme-color" href="{{asset('employee/assets/css/dark.min.css')}}">
</head>

<body>
    <div id="app">
        <div class="shadow-header"></div>
        <header class="header-navbar fixed">
            <div class="toggle-mobile action-toggle"><i class="fas fa-bars"></i></div>
            <div class="header-wrapper">
                <div class="header-left">
                    <div class="theme-switch-icon"></div>
                </div>
                <div class="header-content">
                    <div class="notification dropdown">
                        <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="far fa-envelope"></i>
                        </a>
                        <ul class="dropdown-menu medium">
                            <li class="menu-header">
                                <a class="dropdown-item" href="#">Message</a>
                            </li>
                            <li class="menu-content ps-menu">
                                <a href="#">
                                    <div class="message-image">
                                        <img src="../assets/images/avatar1.png" class="rounded-circle w-100" alt="user1">
                                    </div>
                                    <div class="message-content read">
                                        <div class="subject">
                                            John
                                        </div>
                                        <div class="body">
                                            Please call me at 9pm
                                        </div>
                                        <div class="time">Just now</div>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="message-image">
                                        <img src="../assets/images/avatar2.png" class="rounded-circle w-100" alt="user1">
                                    </div>
                                    <div class="message-content">
                                        <div class="subject">
                                            Michele
                                        </div>
                                        <div class="body">
                                            Please come to my party
                                        </div>
                                        <div class="time">3 hours ago</div>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="message-image">
                                        <img src="../assets/images/avatar1.png" class="rounded-circle w-100" alt="user1">
                                    </div>
                                    <div class="message-content read">
                                        <div class="subject">
                                            Brad
                                        </div>
                                        <div class="body">
                                            I have something to discuss, please call me soon
                                        </div>
                                        <div class="time">3 hours ago</div>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="message-image">
                                        <img src="../assets/images/avatar2.png" class="rounded-circle w-100" alt="user1">
                                    </div>
                                    <div class="message-content">
                                        <div class="subject">
                                            Anel
                                        </div>
                                        <div class="body">
                                            Sorry i'm late
                                        </div>
                                        <div class="time">8 hours ago</div>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="message-image">
                                        <img src="../assets/images/avatar2.png" class="rounded-circle w-100" alt="user1">
                                    </div>
                                    <div class="message-content">
                                        <div class="subject">
                                            Mary
                                        </div>
                                        <div class="body">
                                            Please answer my question last night
                                        </div>
                                        <div class="time">Last month</div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="notification dropdown">
                        <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="far fa-bell"></i>
                            <span class="badge">12</span>
                        </a>
                        <ul class="dropdown-menu medium">
                            <li class="menu-header">
                                <a class="dropdown-item" href="#">Notification</a>
                            </li>
                            <li class="menu-content ps-menu">
                                <a href="#">
                                    <div class="message-icon text-danger">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </div>
                                    <div class="message-content read">
                                        <div class="body">
                                            There's incoming event, don't miss it!!
                                        </div>
                                        <div class="time">Just now</div>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="message-icon text-info">
                                        <i class="fas fa-info"></i>
                                    </div>
                                    <div class="message-content read">
                                        <div class="body">
                                            Your licence will expired soon
                                        </div>
                                        <div class="time">3 hours ago</div>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="message-icon text-success">
                                        <i class="fas fa-check"></i>
                                    </div>
                                    <div class="message-content">
                                        <div class="body">
                                            Successfully register new user
                                        </div>
                                        <div class="time">8 hours ago</div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="dropdown dropdown-menu-end">
                        <a href="#" class="user-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="label">
                                <span></span>
                                <div>Admin</div>
                            </div>
                            <img class="img-user" src="../assets/images/avatar1.png" alt="user"srcset="">
                        </a>
                        <ul class="dropdown-menu small">
                            <!-- <li class="menu-header">
                                <a class="dropdown-item" href="#">Notifikasi</a>
                            </li> -->
                            <li class="menu-content ps-menu">
                                <a href="#">
                                    <div class="description">
                                        <i class="ti-user"></i> Profile
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="description">
                                        <i class="ti-settings"></i> Setting
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="description">
                                        <i class="ti-power-off"></i> Logout
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </header>
        <nav class="main-sidebar ps-menu">
            <div class="sidebar-toggle action-toggle">
                <a href="#">
                    <i class="fas fa-bars"></i>
                </a>
            </div>
            <div class="sidebar-opener action-toggle">
                <a href="#">
                    <i class="ti-angle-right"></i>
                </a>
            </div>
            <div class="sidebar-header">
                <div class="text">AR</div>
                <div class="close-sidebar action-toggle">
                    <i class="ti-close"></i>
                </div>
            </div>
            <div class="sidebar-content">
                <ul>
                    <li class="active">
                        <a href="index.html" class="link">
                            <i class="ti-home"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="main-menu has-dropdown">
                            <i class="ti-desktop"></i>
                            <span>UI Elements</span>
                        </a>
                        <ul class="sub-menu ">
                            <li><a href="element-ui.html" class="link"><span>Elements</span></a></li>
                            <li><a href="element-accordion.html" class="link"><span>Accordion</span></a></li>
                            <li><a href="element-tabs-collapse.html" class="link"><span>Tabs & Collapse</span></a></li>
                            <li><a href="element-card.html" class="link"><span>Card</span></a></li>
                            <li><a href="element-button.html" class="link"><span>Buttons</span></a></li>
                            <li><a href="element-alert.html" class="link"><span>Alert</span></a></li>
                            <li><a href="element-themify-icons.html" class="link"><span>Themify Icons</span></a></li>
                            <li><a href="element-modal.html" class="link"><span>Modal</span></a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="main-menu has-dropdown">
                            <i class="ti-book"></i>
                            <span>Form</span>
                        </a>
                        <ul class="sub-menu ">
                            <li><a href="form-element.html" class="link">
                                    <span>Form Element</span></a>
                            </li>
                            <li><a href="form-datepicker.html" class="link">
                                    <span>Datepicker</span></a>
                            </li>
                            <li><a href="form-select2.html" class="link">
                                    <span>Select2</span></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="main-menu has-dropdown">
                            <i class="ti-notepad"></i>
                            <span>Utilities</span>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="error-404.html" target="_blank" class="link"><span>Error 404</span></a></li>
                            <li><a href="error-403.html" target="_blank" class="link"><span>Error 403</span></a></li>
                            <li><a href="error-500.html" target="_blank" class="link"><span>Error 500</span></a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="main-menu has-dropdown">
                            <i class="ti-layers-alt"></i>
                            <span>Pages</span>
                        </a>
                        <ul class="sub-menu ">
                            <li><a href="pages-blank.html" class="link"><span>Blank</span></a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="main-menu has-dropdown">
                            <i class="ti-hummer"></i>
                            <span>Auth</span>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="auth-login.html" target="_blank" class="link"><span>Login</span></a></li>
                            <li><a href="auth-register.html" target="_blank" class="link"><span>Register</span></a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="main-menu has-dropdown">
                            <i class="ti-write"></i>
                            <span>Tables</span>
                        </a>
                        <ul class="sub-menu ">
                            <li><a href="table-basic.html" class="link"><span>Table Basic</span></a></li>
                            <li><a href="table-datatables.html" class="link"><span>DataTables</span></a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="charts.html" class="link">
                            <i class="ti-bar-chart"></i>
                            <span>Charts</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>        
<div class="main-content">
    <div class="title">
        Dashboard
    </div>
    <div class="content-wrapper">
        <div class="row same-height">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Monthly Sales</h4>
                    </div>
                    <div class="card-body">
                        {{ $dataTable->table(); }}
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

        <footer>
            Copyright © 2022 &nbsp <a href="https://www.youtube.com/c/mulaidarinull" target="_blank" class="ml-1"> Mulai Dari Null </a> <span> . All rights Reserved</span>
        </footer>
        <div class="overlay action-toggle">
        </div>
    </div>
    <script src="{{asset('employee/vendor/bootstrap/dist/js/bootstrap.bundle.js')}}"></script>
    <script src="{{asset('employee/vendor/perfect-scrollbar/dist/perfect-scrollbar.min.js')}}"></script>
  <script>
    $(document).ready( function () {
      $('#employee-table').DataTable();
    } );
  </script>
    <!-- js for this page only -->
<script src="{{asset('employee/vendor/chart.js/dist/Chart.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="{{asset('employee/assets/js/page/index.js')}}"></script>
<script src="{{asset('employee/vendor/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('employee/vendor/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('employee/vendor/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('employee/assets/js/page/datatables.js')}}"></script>
    <!-- ======= -->
    <script src="{{asset('employee/assets/js/main.js')}}"></script>
    <script>
        Main.init()
    </script>
</body>

</html>