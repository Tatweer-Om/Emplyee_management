<!doctype html>
<html lang="en">

    
<!-- Mirrored from themesbrand.com/minia/layouts/ui-buttons.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 05 Aug 2024 05:37:17 GMT -->
<head>
        
        <meta charset="utf-8" />
        <title>Buttons | Minia - Minimal Admin & Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- preloader css -->
        <link rel="stylesheet" href="assets/css/preloader.min.css" type="text/css" />

        <!-- Bootstrap Css -->
        <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    </head>

    <body>

    <!-- <body data-layout="horizontal"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">

            
            <header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                            <a href="index.html" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="assets/images/logo-sm.svg" alt="" height="24">
                                </span>
                                <span class="logo-lg">
                                    <img src="assets/images/logo-sm.svg" alt="" height="24"> <span class="logo-txt">Minia</span>
                                </span>
                            </a>

                            <a href="index.html" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="assets/images/logo-sm.svg" alt="" height="24">
                                </span>
                                <span class="logo-lg">
                                    <img src="assets/images/logo-sm.svg" alt="" height="24"> <span class="logo-txt">Minia</span>
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-16 header-item" id="vertical-menu-btn">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>

                        <!-- App Search-->
                        <form class="app-search d-none d-lg-block">
                            <div class="position-relative">
                                <input type="text" class="form-control" placeholder="Search...">
                                <button class="btn btn-primary" type="button"><i class="bx bx-search-alt align-middle"></i></button>
                            </div>
                        </form>
                    </div>

                    <div class="d-flex">

                        <div class="dropdown d-inline-block d-lg-none ms-2">
                            <button type="button" class="btn header-item" id="page-header-search-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i data-feather="search" class="icon-lg"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                                aria-labelledby="page-header-search-dropdown">
        
                                <form class="p-3">
                                    <div class="form-group m-0">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search ..." aria-label="Search Result">

                                            <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="dropdown d-none d-sm-inline-block">
                            <button type="button" class="btn header-item"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img id="header-lang-img" src="assets/images/flags/us.jpg" alt="Header Language" height="16">
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="en">
                                    <img src="assets/images/flags/us.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">English</span>
                                </a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="sp">
                                    <img src="assets/images/flags/spain.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">Spanish</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="gr">
                                    <img src="assets/images/flags/germany.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">German</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="it">
                                    <img src="assets/images/flags/italy.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">Italian</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="ru">
                                    <img src="assets/images/flags/russia.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">Russian</span>
                                </a>
                            </div>
                        </div>

                        <div class="dropdown d-none d-sm-inline-block">
                            <button type="button" class="btn header-item" id="mode-setting-btn">
                                <i data-feather="moon" class="icon-lg layout-mode-dark"></i>
                                <i data-feather="sun" class="icon-lg layout-mode-light"></i>
                            </button>
                        </div>

                        <div class="dropdown d-none d-lg-inline-block ms-1">
                            <button type="button" class="btn header-item"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i data-feather="grid" class="icon-lg"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                                <div class="p-2">
                                    <div class="row g-0">
                                        <div class="col">
                                            <a class="dropdown-icon-item" href="#">
                                                <img src="assets/images/brands/github.png" alt="Github">
                                                <span>GitHub</span>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a class="dropdown-icon-item" href="#">
                                                <img src="assets/images/brands/bitbucket.png" alt="bitbucket">
                                                <span>Bitbucket</span>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a class="dropdown-icon-item" href="#">
                                                <img src="assets/images/brands/dribbble.png" alt="dribbble">
                                                <span>Dribbble</span>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="row g-0">
                                        <div class="col">
                                            <a class="dropdown-icon-item" href="#">
                                                <img src="assets/images/brands/dropbox.png" alt="dropbox">
                                                <span>Dropbox</span>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a class="dropdown-icon-item" href="#">
                                                <img src="assets/images/brands/mail_chimp.png" alt="mail_chimp">
                                                <span>Mail Chimp</span>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a class="dropdown-icon-item" href="#">
                                                <img src="assets/images/brands/slack.png" alt="slack">
                                                <span>Slack</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item noti-icon position-relative" id="page-header-notifications-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i data-feather="bell" class="icon-lg"></i>
                                <span class="badge bg-danger rounded-pill">5</span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                                aria-labelledby="page-header-notifications-dropdown">
                                <div class="p-3">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-0"> Notifications </h6>
                                        </div>
                                        <div class="col-auto">
                                            <a href="#!" class="small text-reset text-decoration-underline"> Unread (3)</a>
                                        </div>
                                    </div>
                                </div>
                                <div data-simplebar style="max-height: 230px;">
                                    <a href="#!" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-3">
                                                <img src="assets/images/users/avatar-3.jpg" class="rounded-circle avatar-sm" alt="user-pic">
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">James Lemire</h6>
                                                <div class="font-size-13 text-muted">
                                                    <p class="mb-1">It will seem like simplified English.</p>
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>1 hour ago</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#!" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 avatar-sm me-3">
                                                <span class="avatar-title bg-primary rounded-circle font-size-16">
                                                    <i class="bx bx-cart"></i>
                                                </span>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">Your order is placed</h6>
                                                <div class="font-size-13 text-muted">
                                                    <p class="mb-1">If several languages coalesce the grammar</p>
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>3 min ago</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#!" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 avatar-sm me-3">
                                                <span class="avatar-title bg-success rounded-circle font-size-16">
                                                    <i class="bx bx-badge-check"></i>
                                                </span>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">Your item is shipped</h6>
                                                <div class="font-size-13 text-muted">
                                                    <p class="mb-1">If several languages coalesce the grammar</p>
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>3 min ago</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                    <a href="#!" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-3">
                                                <img src="assets/images/users/avatar-6.jpg" class="rounded-circle avatar-sm" alt="user-pic">
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">Salena Layfield</h6>
                                                <div class="font-size-13 text-muted">
                                                    <p class="mb-1">As a skeptical Cambridge friend of mine occidental.</p>
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>1 hour ago</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="p-2 border-top d-grid">
                                    <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                                        <i class="mdi mdi-arrow-right-circle me-1"></i> <span>View More..</span> 
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item right-bar-toggle me-2">
                                <i data-feather="settings" class="icon-lg"></i>
                            </button>
                        </div>

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item bg-light-subtle border-start border-end" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded-circle header-profile-user" src="assets/images/users/avatar-1.jpg"
                                    alt="Header Avatar">
                                <span class="d-none d-xl-inline-block ms-1 fw-medium">Shawn L.</span>
                                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a class="dropdown-item" href="apps-contacts-profile.html"><i class="mdi mdi mdi-face-man font-size-16 align-middle me-1"></i> Profile</a>
                                <a class="dropdown-item" href="auth-lock-screen.html"><i class="mdi mdi-lock font-size-16 align-middle me-1"></i> Lock Screen</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="auth-logout.html"><i class="mdi mdi-logout font-size-16 align-middle me-1"></i> Logout</a>
                            </div>
                        </div>

                    </div>
                </div>
            </header>

            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">

                <div data-simplebar class="h-100">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <li class="menu-title" data-key="t-menu">Menu</li>

                            <li>
                                <a href="index.html">
                                    <i data-feather="home"></i>
                                    <span data-key="t-dashboard">Dashboard</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i data-feather="grid"></i>
                                    <span data-key="t-apps">Apps</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li>
                                        <a href="apps-calendar.html">
                                            <span data-key="t-calendar">Calendar</span>
                                        </a>
                                    </li>
        
                                    <li>
                                        <a href="apps-chat.html">
                                            <span data-key="t-chat">Chat</span>
                                        </a>
                                    </li>
        
                                    <li>
                                        <a href="javascript: void(0);" class="has-arrow">
                                            <span data-key="t-email">Email</span>
                                        </a>
                                        <ul class="sub-menu" aria-expanded="false">
                                            <li><a href="apps-email-inbox.html" data-key="t-inbox">Inbox</a></li>
                                            <li><a href="apps-email-read.html" data-key="t-read-email">Read Email</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="javascript: void(0);" class="has-arrow">
                                            <span data-key="t-invoices">Invoices</span>
                                        </a>
                                        <ul class="sub-menu" aria-expanded="false">
                                            <li><a href="apps-invoices-list.html" data-key="t-invoice-list">Invoice List</a></li>
                                            <li><a href="apps-invoices-detail.html" data-key="t-invoice-detail">Invoice Detail</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="javascript: void(0);" class="has-arrow">
                                            <span data-key="t-contacts">Contacts</span>
                                        </a>
                                        <ul class="sub-menu" aria-expanded="false">
                                            <li><a href="apps-contacts-grid.html" data-key="t-user-grid">User Grid</a></li>
                                            <li><a href="apps-contacts-list.html" data-key="t-user-list">User List</a></li>
                                            <li><a href="apps-contacts-profile.html" data-key="t-profile">Profile</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="javascript: void(0);" class="">
                                            <span data-key="t-blog">Blog</span>
                                            <span class="badge rounded-pill badge-soft-danger float-end" key="t-new">New</span>
                                        </a>
                                        <ul class="sub-menu" aria-expanded="false">
                                            <li><a href="apps-blog-grid.html" data-key="t-blog-grid">Blog Grid</a></li>
                                            <li><a href="apps-blog-list.html" data-key="t-blog-list">Blog List</a></li>
                                            <li><a href="apps-blog-detail.html" data-key="t-blog-details">Blog Details</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i data-feather="users"></i>
                                    <span data-key="t-authentication">Authentication</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="auth-login.html" data-key="t-login">Login</a></li>
                                    <li><a href="auth-register.html" data-key="t-register">Register</a></li>
                                    <li><a href="auth-recoverpw.html" data-key="t-recover-password">Recover Password</a></li>
                                    <li><a href="auth-lock-screen.html" data-key="t-lock-screen">Lock Screen</a></li>
                                    <li><a href="auth-logout.html" data-key="t-logout">Log Out</a></li>
                                    <li><a href="auth-confirm-mail.html" data-key="t-confirm-mail">Confirm Mail</a></li>
                                    <li><a href="auth-email-verification.html" data-key="t-email-verification">Email Verification</a></li>
                                    <li><a href="auth-two-step-verification.html" data-key="t-two-step-verification">Two Step Verification</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i data-feather="file-text"></i>
                                    <span data-key="t-pages">Pages</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="pages-starter.html" data-key="t-starter-page">Starter Page</a></li>
                                    <li><a href="pages-maintenance.html" data-key="t-maintenance">Maintenance</a></li>
                                    <li><a href="pages-comingsoon.html" data-key="t-coming-soon">Coming Soon</a></li>
                                    <li><a href="pages-timeline.html" data-key="t-timeline">Timeline</a></li>
                                    <li><a href="pages-faqs.html" data-key="t-faqs">FAQs</a></li>
                                    <li><a href="pages-pricing.html" data-key="t-pricing">Pricing</a></li>
                                    <li><a href="pages-404.html" data-key="t-error-404">Error 404</a></li>
                                    <li><a href="pages-500.html" data-key="t-error-500">Error 500</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="layouts-horizontal.html">
                                    <i data-feather="layout"></i>
                                    <span data-key="t-horizontal">Horizontal</span>
                                </a>
                            </li>

                            <li class="menu-title mt-2" data-key="t-components">Elements</li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i data-feather="briefcase"></i>
                                    <span data-key="t-components">Components</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="ui-alerts.html" data-key="t-alerts">Alerts</a></li>
                                    <li><a href="ui-buttons.html" data-key="t-buttons">Buttons</a></li>
                                    <li><a href="ui-cards.html" data-key="t-cards">Cards</a></li>
                                    <li><a href="ui-carousel.html" data-key="t-carousel">Carousel</a></li>
                                    <li><a href="ui-dropdowns.html" data-key="t-dropdowns">Dropdowns</a></li>
                                    <li><a href="ui-grid.html" data-key="t-grid">Grid</a></li>
                                    <li><a href="ui-images.html" data-key="t-images">Images</a></li>
                                    <li><a href="ui-modals.html" data-key="t-modals">Modals</a></li>
                                    <li><a href="ui-offcanvas.html" data-key="t-offcanvas">Offcanvas</a></li>
                                    <li><a href="ui-progressbars.html" data-key="t-progress-bars">Progress Bars</a></li>
                                    <li><a href="ui-placeholders.html" data-key="t-progress-bars">Placeholders</a></li>
                                    <li><a href="ui-tabs-accordions.html" data-key="t-tabs-accordions">Tabs & Accordions</a></li>
                                    <li><a href="ui-typography.html" data-key="t-typography">Typography</a></li>
                                    <li><a href="ui-toasts.html" data-key="t-typography">Toasts</a></li>
                                    <li><a href="ui-video.html" data-key="t-video">Video</a></li>
                                    <li><a href="ui-general.html" data-key="t-general">General</a></li>
                                    <li><a href="ui-colors.html" data-key="t-colors">Colors</a></li>
                                    <li><a href="ui-utilities.html" data-key="t-colors">Utilities</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i data-feather="gift"></i>
                                    <span data-key="t-ui-elements">Extended</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="extended-lightbox.html" data-key="t-lightbox">Lightbox</a></li>
                                    <li><a href="extended-rangeslider.html" data-key="t-range-slider">Range Slider</a></li>
                                    <li><a href="extended-sweet-alert.html" data-key="t-sweet-alert">SweetAlert 2</a></li>
                                    <li><a href="extended-session-timeout.html" data-key="t-session-timeout">Session Timeout</a></li>
                                    <li><a href="extended-rating.html" data-key="t-rating">Rating</a></li>
                                    <li><a href="extended-notifications.html" data-key="t-notifications">Notifications</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);">
                                    <i data-feather="box"></i>
                                    <span class="badge rounded-pill badge-soft-danger  text-danger float-end">7</span>
                                    <span data-key="t-forms">Forms</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="form-elements.html" data-key="t-form-elements">Basic Elements</a></li>
                                    <li><a href="form-validation.html" data-key="t-form-validation">Validation</a></li>
                                    <li><a href="form-advanced.html" data-key="t-form-advanced">Advanced Plugins</a></li>
                                    <li><a href="form-editors.html" data-key="t-form-editors">Editors</a></li>
                                    <li><a href="form-uploads.html" data-key="t-form-upload">File Upload</a></li>
                                    <li><a href="form-wizard.html" data-key="t-form-wizard">Wizard</a></li>
                                    <li><a href="form-mask.html" data-key="t-form-mask">Mask</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i data-feather="sliders"></i>
                                    <span data-key="t-tables">Tables</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="tables-basic.html" data-key="t-basic-tables">Bootstrap Basic</a></li>
                                    <li><a href="tables-datatable.html" data-key="t-data-tables">DataTables</a></li>
                                    <li><a href="tables-responsive.html" data-key="t-responsive-table">Responsive</a></li>
                                    <li><a href="tables-editable.html" data-key="t-editable-table">Editable</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i data-feather="pie-chart"></i>
                                    <span data-key="t-charts">Charts</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="charts-apex.html" data-key="t-apex-charts">Apexcharts</a></li>
                                    <li><a href="charts-echart.html" data-key="t-e-charts">Echarts</a></li>
                                    <li><a href="charts-chartjs.html" data-key="t-chartjs-charts">Chartjs</a></li>
                                    <li><a href="charts-knob.html" data-key="t-knob-charts">Jquery Knob</a></li>
                                    <li><a href="charts-sparkline.html" data-key="t-sparkline-charts">Sparkline</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i data-feather="cpu"></i>
                                    <span data-key="t-icons">Icons</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="icons-boxicons.html" data-key="t-boxicons">Boxicons</a></li>
                                    <li><a href="icons-materialdesign.html" data-key="t-material-design">Material Design</a></li>
                                    <li><a href="icons-dripicons.html" data-key="t-dripicons">Dripicons</a></li>
                                    <li><a href="icons-fontawesome.html" data-key="t-font-awesome">Font Awesome 5</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i data-feather="map"></i>
                                    <span data-key="t-maps">Maps</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="maps-google.html" data-key="t-g-maps">Google</a></li>
                                    <li><a href="maps-vector.html" data-key="t-v-maps">Vector</a></li>
                                    <li><a href="maps-leaflet.html" data-key="t-l-maps">Leaflet</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i data-feather="share-2"></i>
                                    <span data-key="t-multi-level">Multi Level</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="true">
                                    <li><a href="javascript: void(0);" data-key="t-level-1-1">Level 1.1</a></li>
                                    <li>
                                        <a href="javascript: void(0);" class="has-arrow" data-key="t-level-1-2">Level 1.2</a>
                                        <ul class="sub-menu" aria-expanded="true">
                                            <li><a href="javascript: void(0);" data-key="t-level-2-1">Level 2.1</a></li>
                                            <li><a href="javascript: void(0);" data-key="t-level-2-2">Level 2.2</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>

                        </ul>

                        <div class="card sidebar-alert border-0 text-center mx-4 mb-0 mt-5">
                            <div class="card-body">
                                <img src="assets/images/giftbox.png" alt="">
                                <div class="mt-4">
                                    <h5 class="alertcard-title font-size-16">Unlimited Access</h5>
                                    <p class="font-size-13">Upgrade your plan from a Free trial, to select ‘Business Plan’.</p>
                                    <a href="#!" class="btn btn-primary mt-2">Upgrade Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->

            

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Buttons</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Components</a></li>
                                            <li class="breadcrumb-item active">Buttons</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Default Buttons</h4>
                                        <p class="card-title-desc">Bootstrap includes six predefined button styles, each serving its own semantic purpose.</p>
                                    </div><!-- end card header -->

                                    <div class="card-body">
                                        <div class="d-flex flex-wrap gap-2">
                                            <button type="button" class="btn btn-primary waves-effect waves-light">Primary</button>
                                            <button type="button" class="btn btn-secondary waves-effect waves-light">Secondary</button>
                                            <button type="button" class="btn btn-success waves-effect waves-light">Success</button>
                                            <button type="button" class="btn btn-info waves-effect waves-light">Info</button>
                                            <button type="button" class="btn btn-warning waves-effect waves-light">Warning</button>
                                            <button type="button" class="btn btn-danger waves-effect waves-light">Danger</button>
                                            <button type="button" class="btn btn-dark waves-effect waves-light">Dark</button>
                                            <button type="button" class="btn btn-link waves-effect">Link</button>
                                            <button type="button" class="btn btn-light waves-effect">Light</button>
                                        </div>
                                    </div><!-- end card-body -->
                                </div><!-- end card -->
                            </div><!-- end col -->

                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Outline Buttons</h4>
                                        <p class="card-title-desc">Replace the default modifier classes with the <code
                                                class="highlighter-rouge">.btn-outline-*</code> ones to remove all background images and colors on any
                                            button.
                                        </p>
                                    </div><!-- end card header -->

                                    <div class="card-body">
                                        <div class="d-flex flex-wrap gap-2">
                                            <button type="button" class="btn btn-outline-primary waves-effect waves-light">Primary</button>
                                            <button type="button" class="btn btn-outline-secondary waves-effect">Secondary</button>
                                            <button type="button" class="btn btn-outline-success waves-effect waves-light">Success</button>
                                            <button type="button" class="btn btn-outline-info waves-effect waves-light">Info</button>
                                            <button type="button" class="btn btn-outline-warning waves-effect waves-light">Warning</button>
                                            <button type="button" class="btn btn-outline-danger waves-effect waves-light">Danger</button>
                                            <button type="button" class="btn btn-outline-dark waves-effect waves-light">Dark</button>
                                            <button type="button" class="btn btn-outline-light waves-effect">Light</button>
                                        </div>
                                    </div><!-- end card-body -->
                                </div><!-- end card -->
                            </div><!-- end col -->
                        </div><!-- end row -->

                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Rounded Buttons</h4>
                                        <p class="card-title-desc">Use class <code>.btn-rounded</code> for button round border.</p>
                                    </div><!-- end card header -->

                                    <div class="card-body">
                                        <div class="d-flex flex-wrap gap-2">
                                            <button type="button" class="btn btn-primary btn-rounded waves-effect waves-light">Primary</button>
                                            <button type="button" class="btn btn-secondary btn-rounded waves-effect waves-light">Secondary</button>
                                            <button type="button" class="btn btn-success btn-rounded waves-effect waves-light">Success</button>
                                            <button type="button" class="btn btn-info btn-rounded waves-effect waves-light">Info</button>
                                            <button type="button" class="btn btn-warning btn-rounded waves-effect waves-light">Warning</button>
                                            <button type="button" class="btn btn-danger btn-rounded waves-effect waves-light">Danger</button>
                                            <button type="button" class="btn btn-dark btn-rounded waves-effect waves-light">Dark</button>
                                            <button type="button" class="btn btn-link btn-rounded waves-effect">Link</button>
                                            <button type="button" class="btn btn-light btn-rounded waves-effect">Light</button>
                                        </div>
                                    </div><!-- end card-body -->
                                </div><!-- end card -->
                            </div><!-- end col -->

                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Buttons With Icon</h4>
                                        <p class="card-title-desc">Add icon in button.</p>
                                    </div><!-- end card header -->

                                    <div class="card-body">
                                        <div class="d-flex flex-wrap gap-2">
                                            <button type="button" class="btn btn-primary waves-effect waves-light">
                                                <i class="bx bx-smile font-size-16 align-middle me-2"></i> Primary
                                            </button>
                                            <button type="button" class="btn btn-success waves-effect waves-light">
                                                <i class="bx bx-check-double font-size-16 align-middle me-2"></i> Success
                                            </button>
                                            <button type="button" class="btn btn-warning waves-effect waves-light">
                                                <i class="bx bx-error font-size-16 align-middle me-2"></i> Warning
                                            </button>
                                            <button type="button" class="btn btn-danger waves-effect waves-light">
                                                <i class="bx bx-block font-size-16 align-middle me-2"></i> Danger
                                            </button>
                                            <button type="button" class="btn btn-dark waves-effect waves-light">
                                                <i class="bx bx-loader bx-spin font-size-16 align-middle me-2"></i> Loading
                                            </button>
                                            <button type="button" class="btn btn-light waves-effect">
                                                <i class="bx bx-hourglass bx-spin font-size-16 align-middle me-2"></i> Loading
                                            </button>
                                        </div>
                                    </div><!-- end card-body -->
                                </div><!-- end card -->
                            </div><!-- end col -->
                        </div><!-- end row -->

                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Soft Buttons</h4>
                                        <p class="card-title-desc">Soft buttons</p>
                                    </div><!-- end card header -->

                                    <div class="card-body">
                                        <div class="d-flex flex-wrap gap-2">
                                            <button type="button" class="btn btn-soft-primary waves-effect waves-light">Primary</button>
                                            <button type="button" class="btn btn-soft-secondary waves-effect waves-light">Secondary</button>
                                            <button type="button" class="btn btn-soft-success waves-effect waves-light">Success</button>
                                            <button type="button" class="btn btn-soft-info waves-effect waves-light">Info</button>
                                            <button type="button" class="btn btn-soft-warning waves-effect waves-light">Warning</button>
                                            <button type="button" class="btn btn-soft-danger waves-effect waves-light">Danger</button>
                                            <button type="button" class="btn btn-soft-dark waves-effect waves-light">Dark</button>
                                            <button type="button" class="btn btn-soft-link waves-effect">Link</button>
                                            <button type="button" class="btn btn-soft-light waves-effect">Light</button>
                                        </div>
                                    </div><!-- end card-body -->
                                </div><!-- end card -->
                            </div><!-- end col -->

                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Soft Icon Buttons</h4>
                                        <p class="card-title-desc">Use class <code>btn-soft-*</code> for button round border.</p>
                                    </div><!-- end card header -->

                                    <div class="card-body">
                                        <div class="d-flex flex-wrap gap-2">
                                            <button type="button" class="btn btn-soft-primary waves-effect waves-light"><i class="bx bx-smile font-size-16 align-middle"></i></button>
                                            <button type="button" class="btn btn-soft-success waves-effect waves-light"><i class="bx bx-check-double font-size-16 align-middle"></i></button>
                                            <button type="button" class="btn btn-soft-warning waves-effect waves-light"><i class="bx bx-error font-size-16 align-middle"></i></button>
                                            <button type="button" class="btn btn-soft-danger waves-effect waves-light"><i class="bx bx-block font-size-16 align-middle"></i></button>
                                            <button type="button" class="btn btn-soft-dark waves-effect waves-light"><i class="bx bx-loader font-size-16 align-middle"></i></button>
                                            <button type="button" class="btn btn-soft-light waves-effect waves-light"><i class="bx bx-hourglass font-size-16 align-middle"></i></button>
                                        </div>
                                    </div><!-- end card-body -->
                                </div><!-- end card -->
                            </div><!-- end col -->
                        </div><!-- end row -->

                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Disable Buttons</h4>
                                        <p class="card-title-desc">Make buttons look inactive by adding the <code>disabled</code> boolean attribute to any <code>&lt;button&gt;</code> element. Disabled buttons have <code>pointer-events: none</code> applied to, preventing hover and active states from triggering.</p>
                                    </div><!-- end card header -->

                                    <div class="card-body">
                                        <div class="d-flex flex-wrap gap-3">
                                            <button type="button" class="btn btn-lg btn-primary" disabled>Primary button</button>
                                            <button type="button" class="btn btn-secondary btn-lg" disabled>Button</button>
                                        </div>
                                    </div><!-- end card-body -->
                                </div><!-- end card -->
                            </div><!-- end col -->

                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Link Functionality Caveat Disable Buttons</h4>
                                        <p class="card-title-desc"><code>&lt;a&gt;</code>s don’t support the <code>disabled</code> attribute, so you must add the <code>.disabled</code> class and <code>aria-disabled="true"</code> to make it visually appear disabled. also include a <code>tabindex="-1"</code> attribute.</p>
                                    </div><!-- end card header -->

                                    <div class="card-body">
                                        <div class="d-flex flex-wrap gap-2">
                                            <a class="btn btn-primary btn-lg disabled" role="button" aria-disabled="true">Primary link</a>
                                            <a href="#" class="btn btn-secondary btn-lg disabled" tabindex="-1" role="button" aria-disabled="true">Link</a>
                                        </div>
                                    </div><!-- end card-body -->
                                </div><!-- end card -->
                            </div><!-- end col -->
                        </div><!-- end row -->


                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Snip Buttons</h4>
                                        <p class="card-title-desc">Example of Snip Buttons</p>
                                    </div><!-- end card header -->

                                    <div class="card-body">
                                        <div class="row g-4">
                                            <div class="col-xl-4">
                                                <h5 class="font-size-15 mb-3">Example 1</h5>
                                                <div class="btn-group btn-group-example mb-3" role="group">
                                                    <button type="button" class="btn btn-outline-primary w-sm">Left</button>
                                                    <button type="button" class="btn btn-outline-primary w-sm">Middle</button>
                                                    <button type="button" class="btn btn-outline-primary w-sm">Right</button>
                                                </div>

                                                <div>
                                                    <div class="btn-group btn-group-example mb-3" role="group">
                                                        <button type="button" class="btn btn-primary w-xs"><i class="mdi mdi-thumb-up"></i></button>
                                                        <button type="button" class="btn btn-danger w-xs"><i class="mdi mdi-thumb-down"></i></button>
                                                    </div>
                                                </div>

                                                <div>
                                                    <div class="btn-group btn-group-example" role="group">
                                                        <button type="button" class="btn btn-outline-secondary w-xs"><i class="bx bx-menu-alt-right"></i></button>
                                                        <button type="button" class="btn btn-outline-secondary w-xs"><i class="bx bx-menu"></i></button>
                                                        <button type="button" class="btn btn-outline-secondary w-xs"><i class="bx bx-menu-alt-left"></i></button>
                                                    </div>
                                                </div>
                                            </div><!-- end col -->

                                            <div class="col-xl-4">
                                                <h5 class="font-size-15 mb-3">Example 2</h5>
                                                <div class="d-flex flex-wrap gap-2">
                                                    <button type="button" class="btn btn-primary waves-effect btn-label waves-light"><i class="bx bx-smile label-icon"></i> Primary</button>
                                                    <button type="button" class="btn btn-success waves-effect btn-label waves-light"><i class="bx bx-check-double label-icon"></i> Success</button>
                                                    <button type="button" class="btn btn-warning waves-effect btn-label waves-light"><i class="bx bx-error label-icon"></i> Warning</button>
                                                    <button type="button" class="btn btn-danger waves-effect btn-label waves-light"><i class="bx bx-block label-icon"></i> Danger</button>
                                                    <button type="button" class="btn btn-dark waves-effect btn-label waves-light"><i class="bx bx-loader label-icon"></i> Dark</button>
                                                    <button type="button" class="btn btn-light waves-effect btn-label waves-light"><i class="bx bx-hourglass label-icon"></i> Light</button>
                                                </div>
                                            </div><!-- end col -->

                                            <div class="col-xl-4">
                                                <h5 class="font-size-15 mb-3">Example 3</h5>
                                                <div class="d-flex flex-wrap gap-2">
                                                    <button type="button" class="btn btn-primary waves-effect waves-light w-sm">
                                                        <i class="mdi mdi-download d-block font-size-16"></i> Download
                                                    </button>
                                                    <button type="button" class="btn btn-light waves-effect waves-light w-sm">
                                                        <i class="mdi mdi-upload d-block font-size-16"></i> Upload
                                                    </button>
                                                    <button type="button" class="btn btn-success waves-effect waves-light w-sm">
                                                        <i class="mdi mdi-pencil d-block font-size-16"></i> Edit
                                                    </button>
                                                    <button type="button" class="btn btn-danger waves-effect waves-light w-sm">
                                                        <i class="mdi mdi-trash-can d-block font-size-16"></i> Delete
                                                    </button>
                                                </div>
                                            </div><!-- end col -->
                                        </div><!-- end row -->
                                    </div><!-- end card-body -->
                                </div><!-- end card -->
                            </div><!-- end col -->
                        </div><!-- end row -->

                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Buttons Sizes</h4>
                                        <p class="card-title-desc">Add <code>.btn-lg</code> or <code>.btn-sm</code> for additional sizes.</p>
                                    </div><!-- end card header -->

                                    <div class="card-body">
                                        <div class="d-flex flex-wrap gap-3 align-items-center">
                                            <button type="button" class="btn btn-primary btn-lg waves-effect waves-light">Large button</button>
                                            <button type="button" class="btn btn-secondary btn-lg waves-effect waves-light">Large button</button>
                                            <button type="button" class="btn btn-primary btn-sm waves-effect waves-light">Small button</button>
                                            <button type="button" class="btn btn-secondary btn-sm waves-effect waves-light">Small button</button>
                                        </div>
                                    </div><!-- end card-body -->
                                </div><!-- end card -->
                            </div><!-- end col -->

                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Buttons Width</h4>
                                        <p class="card-title-desc">Add <code>.w-xs</code>, <code>.w-sm</code>, <code>.w-md</code> and <code> .w-lg</code> class for additional buttons width.</p>
                                    </div><!-- end card header -->

                                    <div class="card-body">
                                        <div class="d-flex flex-wrap gap-2">
                                            <button type="button" class="btn btn-primary w-xs waves-effect waves-light">Xs</button>
                                            <button type="button" class="btn btn-danger w-sm waves-effect waves-light">Small</button>
                                            <button type="button" class="btn btn-warning w-md waves-effect waves-light">Medium</button>
                                            <button type="button" class="btn btn-success w-lg waves-effect waves-light">Large</button>
                                        </div>
                                    </div><!-- end card-body -->
                                </div><!-- end card -->
                            </div><!-- end col -->
                        </div><!-- end row -->

                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Button Tags</h4>
                                        <p class="card-title-desc">
                                            The <code class="highlighter-rouge">.btn</code>
                                            classes are designed to be used with the <code
                                                    class="highlighter-rouge">&lt;button&gt;</code> element.
                                            However, you can also use these classes on <code
                                                    class="highlighter-rouge">&lt;a&gt;</code> or <code
                                                    class="highlighter-rouge">&lt;input&gt;</code> elements (though
                                            some browsers may apply a slightly different rendering).
                                        </p>
                                    </div><!-- end card header -->

                                    <div class="card-body">
                                        <div class="d-flex flex-wrap gap-3 align-items-center">
                                            <a class="btn btn-primary waves-effect waves-light" href="#" role="button">Link</a>
                                            <button class="btn btn-success waves-effect waves-light" type="submit">Button</button>
                                            <input class="btn btn-info" type="button" value="Input">
                                            <input class="btn btn-danger" type="submit" value="Submit">
                                            <input class="btn btn-warning" type="reset" value="Reset">
                                        </div>
                                    </div><!-- end card-body -->
                                </div><!-- end card -->
                            </div><!-- end col -->

                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Toggle States</h4>
                                        <p class="card-title-desc">Add <code>data-bs-toggle="button"</code> to toggle a button’s <code>active</code> state. If you’re pre-toggling a button, you must manually add the <code>.active</code> class <strong>and</strong> <code>aria-pressed="true"</code> to ensure that it is conveyed appropriately to assistive technologies.</p>
                                    </div><!-- end card header -->

                                    <div class="card-body">
                                        <div class="d-flex flex-wrap gap-2">
                                            <!-- Toggle States Button -->
                                            <button type="button" class="btn btn-primary" data-bs-toggle="button" autocomplete="off">Toggle button</button>
                                            <button type="button" class="btn btn-primary active" data-bs-toggle="button" autocomplete="off" aria-pressed="true">Active toggle button</button>
                                            <button type="button" class="btn btn-primary" disabled data-bs-toggle="button" autocomplete="off">Disabled toggle button</button>

                                            <!-- Toggle States Link -->
                                            <a href="#" class="btn btn-primary" role="button" data-bs-toggle="button">Toggle link</a>
                                            <a href="#" class="btn btn-primary active" role="button" data-bs-toggle="button" aria-pressed="true">Active toggle link</a>
                                            <a class="btn btn-primary disabled" aria-disabled="true" role="button" data-bs-toggle="button">Disabled toggle link</a>
                                        </div>
                                    </div><!-- end card-body -->
                                </div><!-- end card -->
                            </div><!-- end col -->
                        </div><!-- end row -->

                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Block Buttons</h4>
                                        <p class="card-title-desc">Add <code>.d-grid</code>. class in parent div for block buttons</p>
                                    </div><!-- end card header -->

                                    <div class="card-body">
                                        <div class="d-grid gap-2">
                                            <button type="button" class="btn btn-primary btn-lg waves-effect waves-light">Block level button</button>
                                            <button type="button" class="btn btn-secondary btn-sm waves-effect waves-light">Block level button</button>
                                        </div>
                                    </div><!-- end card-body -->
                                </div><!-- end card -->
                            </div><!-- end col -->

                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Checkbox & Radio Buttons</h4>
                                        <p class="card-title-desc">Create button-like checkboxes and radio buttons by using <code>.btn</code> styles rather than 
                                            <code>.form-check-label</code> on the <code>&lt;label&gt;</code> elements.
                                        </p>
                                    </div><!-- end card header -->

                                    <div class="card-body">
                                        <div class="row g-2">
                                            <div class="col-xl-6">
                                                <div class="d-flex flex-wrap gap-3">
                                                    <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                                                    
                                                        <input type="checkbox" class="btn-check" id="btncheck1" autocomplete="off" checked>
                                                        <label class="btn btn-primary" for="btncheck1">Checkbox 1</label>
    
                                                        <input type="checkbox" class="btn-check" id="btncheck2" autocomplete="off">
                                                        <label class="btn btn-primary" for="btncheck2">Checkbox 2</label>
    
                                                        <input type="checkbox" class="btn-check" id="btncheck3" autocomplete="off">
                                                        <label class="btn btn-primary" for="btncheck3">Checkbox 3</label>
                                                    </div>
    
                                                    <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                                                        <input type="checkbox" class="btn-check" id="btncheck4" autocomplete="off" checked>
                                                        <label class="btn btn-outline-primary" for="btncheck4">Checkbox 4</label>
    
                                                        <input type="checkbox" class="btn-check" id="btncheck5" autocomplete="off">
                                                        <label class="btn btn-outline-primary" for="btncheck5">Checkbox 5</label>
    
                                                        <input type="checkbox" class="btn-check" id="btncheck6" autocomplete="off">
                                                        <label class="btn btn-outline-primary" for="btncheck6">Checkbox 6</label>
                                                    </div>
                                                </div>
                                            </div><!-- end col -->

                                            <div class="col-xl-6">
                                                <div class="d-flex flex-wrap gap-3">
                                                    <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                                        <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
                                                        <label class="btn btn-secondary" for="btnradio1">Radio 1</label>
                                                      
                                                        <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
                                                        <label class="btn btn-secondary" for="btnradio2">Radio 2</label>
                                                      
                                                        <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off">
                                                        <label class="btn btn-secondary" for="btnradio3">Radio 3</label>
                                                    </div>
    
                                                    <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                                        <input type="radio" class="btn-check" name="btnradio" id="btnradio4" autocomplete="off" checked>
                                                        <label class="btn btn-outline-secondary" for="btnradio4">Radio 4</label>
                                                      
                                                        <input type="radio" class="btn-check" name="btnradio" id="btnradio5" autocomplete="off">
                                                        <label class="btn btn-outline-secondary" for="btnradio5">Radio 5</label>
                                                      
                                                        <input type="radio" class="btn-check" name="btnradio" id="btnradio6" autocomplete="off">
                                                        <label class="btn btn-outline-secondary" for="btnradio6">Radio 6</label>
                                                    </div>
                                                </div>
                                            </div><!-- end col -->
                                        </div><!-- end row -->
                                    </div><!-- end card-body -->
                                </div><!-- end card -->
                            </div><!-- end col -->
                        </div><!-- end row -->

                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Button Group</h4>
                                        <p class="card-title-desc">Wrap a series of buttons with <code
                                            class="highlighter-rouge">.btn</code> in <code
                                            class="highlighter-rouge">.btn-group</code>.
                                        </p>
                                    </div><!-- end card header -->

                                    <div class="card-body">
                                        <div class="row g-4">
                                            <div class="d-flex flex-wrap gap-3">
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <button type="button" class="btn btn-primary">Left</button>
                                                    <button type="button" class="btn btn-primary">Middle</button>
                                                    <button type="button" class="btn btn-primary">Right</button>
                                                </div>
                                            
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <button type="button" class="btn btn-outline-primary">Left</button>
                                                    <button type="button" class="btn btn-outline-primary">Middle</button>
                                                    <button type="button" class="btn btn-outline-primary">Right</button>
                                                </div>

                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <button type="button" class="btn btn-secondary"><i class="bx bx-menu-alt-right"></i></button>
                                                    <button type="button" class="btn btn-secondary"><i class="bx bx-menu"></i></button>
                                                    <button type="button" class="btn btn-secondary"><i class="bx bx-menu-alt-left"></i></button>
                                                </div>
                                            </div>
                                        </div>                                            
                                    </div><!-- end card-body -->
                                </div><!-- end card -->
                            </div><!-- end col -->

                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Button Toolbar</h4>
                                        <p class="card-title-desc">Combine sets of button groups into
                                            button toolbars for more complex components. Use utility classes as
                                            needed to space out groups, buttons, and more.
                                        </p>
                                    </div><!-- end card header -->

                                    <div class="card-body">
                                        <div class="btn-toolbar gap-2" role="toolbar" aria-label="Toolbar with button groups">
                                            <div class="btn-group" role="group" aria-label="First group">
                                                <button type="button" class="btn btn-secondary">1</button>
                                                <button type="button" class="btn btn-secondary">2</button>
                                                <button type="button" class="btn btn-secondary">3</button>
                                                <button type="button" class="btn btn-secondary">4</button>
                                            </div>
                                            <div class="btn-group" role="group" aria-label="Second group">
                                                <button type="button" class="btn btn-secondary">5</button>
                                                <button type="button" class="btn btn-secondary">6</button>
                                                <button type="button" class="btn btn-secondary">7</button>
                                            </div>
                                            <div class="btn-group" role="group" aria-label="Third group">
                                                <button type="button" class="btn btn-secondary">8</button>
                                            </div>
                                        </div>
                                    </div><!-- end card-body -->
                                </div><!-- end card -->
                            </div><!-- end col -->
                        </div><!-- end row -->

                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Sizing</h4>
                                        <p class="card-title-desc">Instead of applying button sizing
                                            classes to every button in a group, just add <code
                                                    class="highlighter-rouge">.btn-group-*</code> to each <code
                                                    class="highlighter-rouge">.btn-group</code>, including each one
                                            when nesting multiple groups.
                                        </p>
                                    </div><!-- end card header -->

                                    <div class="card-body">
                                        <div class="d-flex flex-wrap gap-3">
                                            <div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
                                                <button type="button" class="btn btn-primary">Left</button>
                                                <button type="button" class="btn btn-primary">Middle</button>
                                                <button type="button" class="btn btn-primary">Right</button>
                                            </div>

                                            <div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
                                                <button type="button" class="btn btn-outline-primary">Left</button>
                                                <button type="button" class="btn btn-outline-primary">Middle</button>
                                                <button type="button" class="btn btn-outline-primary">Right</button>
                                            </div>
                                        </div>
                                        
        
                                        <div class="d-flex flex-wrap gap-3 my-3">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <button type="button" class="btn btn-secondary">Left</button>
                                                <button type="button" class="btn btn-secondary">Middle</button>
                                                <button type="button" class="btn btn-secondary">Right</button>
                                            </div>

                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <button type="button" class="btn btn-outline-secondary">Left</button>
                                                <button type="button" class="btn btn-outline-secondary">Middle</button>
                                                <button type="button" class="btn btn-outline-secondary">Right</button>
                                            </div>
                                        </div>

                                       <div class="d-flex flex-wrap gap-3">
                                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                                <button type="button" class="btn btn-danger">Left</button>
                                                <button type="button" class="btn btn-danger">Middle</button>
                                                <button type="button" class="btn btn-danger">Right</button>
                                            </div>

                                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                                <button type="button" class="btn btn-outline-danger">Left</button>
                                                <button type="button" class="btn btn-outline-danger">Middle</button>
                                                <button type="button" class="btn btn-outline-danger">Right</button>
                                            </div>
                                       </div>
        
                                    </div><!-- end card-body -->
                                </div><!-- end card -->
                            </div><!-- end col -->

                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Vertical Variation</h4>
                                        <p class="card-title-desc">Make a set of buttons appear vertically
                                            stacked rather than horizontally. Split button dropdowns are not
                                            supported here.
                                        </p>
                                    </div><!-- end card header -->

                                    <div class="card-body">
                                        <div class="d-flex flex-wrap gap-4 align-items-start">
                                            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                                <button type="button" class="btn btn-primary">1</button>
                                                <button type="button" class="btn btn-primary">2</button>
                                        
                                                <div class="btn-group" role="group">
                                                    <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        Dropdown <i class="mdi mdi-chevron-down"></i>
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                        <li><a class="dropdown-item" href="#">Dropdown link</a></li>
                                                        <li><a class="dropdown-item" href="#">Dropdown link</a></li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="btn-group-vertical" role="group" aria-label="Vertical button group">
                                                <button type="button" class="btn btn-secondary">Button</button>
                                                <div class="btn-group" role="group">
                                                    <button id="btnGroupVerticalDrop1" type="button" class="btn btn-secondary dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Dropdown <i class="mdi mdi-chevron-down"></i>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1">
                                                        <a class="dropdown-item" href="#">Dropdown link</a>
                                                        <a class="dropdown-item" href="#">Dropdown link</a>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-secondary">Button</button>
                                                <button type="button" class="btn btn-secondary">Button</button>
                                            </div>

                                            <div class="btn-group-vertical" role="group" aria-label="Vertical radio toggle button group">
                                                <input type="radio" class="btn-check" name="vbtn-radio" id="vbtn-radio1" autocomplete="off" checked="">
                                                <label class="btn btn-outline-danger" for="vbtn-radio1">Radio 1</label>
                                                <input type="radio" class="btn-check" name="vbtn-radio" id="vbtn-radio2" autocomplete="off">
                                                <label class="btn btn-outline-danger" for="vbtn-radio2">Radio 2</label>
                                                <input type="radio" class="btn-check" name="vbtn-radio" id="vbtn-radio3" autocomplete="off">
                                                <label class="btn btn-outline-danger" for="vbtn-radio3">Radio 3</label>
                                            </div>
                                        </div>
                                    </div><!-- end card-body -->
                                </div><!-- end card -->
                            </div><!-- end col -->
                        </div><!-- end row -->

                    </div>
                    <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <script>document.write(new Date().getFullYear())</script> © Minia.
                            </div>
                            <div class="col-sm-6">
                                <div class="text-sm-end d-none d-sm-block">
                                    Design & Develop by <a href="#!" class="text-decoration-underline">Themesbrand</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
                
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        
        <!-- Right Sidebar -->
        <div class="right-bar">
            <div data-simplebar class="h-100">
                <div class="rightbar-title d-flex align-items-center p-3">

                    <h5 class="m-0 me-2">Theme Customizer</h5>

                    <a href="javascript:void(0);" class="right-bar-toggle ms-auto">
                        <i class="mdi mdi-close noti-icon"></i>
                    </a>
                </div>

                <!-- Settings -->
                <hr class="m-0" />

                <div class="p-4">
                    <h6 class="mb-3">Layout</h6>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout"
                            id="layout-vertical" value="vertical">
                        <label class="form-check-label" for="layout-vertical">Vertical</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout"
                            id="layout-horizontal" value="horizontal">
                        <label class="form-check-label" for="layout-horizontal">Horizontal</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2">Layout Mode</h6>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-mode"
                            id="layout-mode-light" value="light">
                        <label class="form-check-label" for="layout-mode-light">Light</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-mode"
                            id="layout-mode-dark" value="dark">
                        <label class="form-check-label" for="layout-mode-dark">Dark</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2">Layout Width</h6>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-width"
                            id="layout-width-fuild" value="fuild" onchange="document.body.setAttribute('data-layout-size', 'fluid')">
                        <label class="form-check-label" for="layout-width-fuild">Fluid</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-width"
                            id="layout-width-boxed" value="boxed" onchange="document.body.setAttribute('data-layout-size', 'boxed')">
                        <label class="form-check-label" for="layout-width-boxed">Boxed</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2">Layout Position</h6>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-position"
                            id="layout-position-fixed" value="fixed" onchange="document.body.setAttribute('data-layout-scrollable', 'false')">
                        <label class="form-check-label" for="layout-position-fixed">Fixed</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-position"
                            id="layout-position-scrollable" value="scrollable" onchange="document.body.setAttribute('data-layout-scrollable', 'true')">
                        <label class="form-check-label" for="layout-position-scrollable">Scrollable</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2">Topbar Color</h6>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="topbar-color"
                            id="topbar-color-light" value="light" onchange="document.body.setAttribute('data-topbar', 'light')">
                        <label class="form-check-label" for="topbar-color-light">Light</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="topbar-color"
                            id="topbar-color-dark" value="dark" onchange="document.body.setAttribute('data-topbar', 'dark')">
                        <label class="form-check-label" for="topbar-color-dark">Dark</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2 sidebar-setting">Sidebar Size</h6>

                    <div class="form-check sidebar-setting">
                        <input class="form-check-input" type="radio" name="sidebar-size"
                            id="sidebar-size-default" value="default" onchange="document.body.setAttribute('data-sidebar-size', 'lg')">
                        <label class="form-check-label" for="sidebar-size-default">Default</label>
                    </div>
                    <div class="form-check sidebar-setting">
                        <input class="form-check-input" type="radio" name="sidebar-size"
                            id="sidebar-size-compact" value="compact" onchange="document.body.setAttribute('data-sidebar-size', 'md')">
                        <label class="form-check-label" for="sidebar-size-compact">Compact</label>
                    </div>
                    <div class="form-check sidebar-setting">
                        <input class="form-check-input" type="radio" name="sidebar-size"
                            id="sidebar-size-small" value="small" onchange="document.body.setAttribute('data-sidebar-size', 'sm')">
                        <label class="form-check-label" for="sidebar-size-small">Small (Icon View)</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2 sidebar-setting">Sidebar Color</h6>

                    <div class="form-check sidebar-setting">
                        <input class="form-check-input" type="radio" name="sidebar-color"
                            id="sidebar-color-light" value="light" onchange="document.body.setAttribute('data-sidebar', 'light')">
                        <label class="form-check-label" for="sidebar-color-light">Light</label>
                    </div>
                    <div class="form-check sidebar-setting">
                        <input class="form-check-input" type="radio" name="sidebar-color"
                            id="sidebar-color-dark" value="dark" onchange="document.body.setAttribute('data-sidebar', 'dark')">
                        <label class="form-check-label" for="sidebar-color-dark">Dark</label>
                    </div>
                    <div class="form-check sidebar-setting">
                        <input class="form-check-input" type="radio" name="sidebar-color"
                            id="sidebar-color-brand" value="brand" onchange="document.body.setAttribute('data-sidebar', 'brand')">
                        <label class="form-check-label" for="sidebar-color-brand">Brand</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2">Direction</h6>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-direction"
                            id="layout-direction-ltr" value="ltr">
                        <label class="form-check-label" for="layout-direction-ltr">LTR</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-direction"
                            id="layout-direction-rtl" value="rtl">
                        <label class="form-check-label" for="layout-direction-rtl">RTL</label>
                    </div>

                </div>

            </div> <!-- end slimscroll-menu-->
        </div>
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>
        <script src="assets/libs/feather-icons/feather.min.js"></script>
        <!-- pace js -->
        <script src="assets/libs/pace-js/pace.min.js"></script>

        <script src="assets/js/app.js"></script>

    </body>

<!-- Mirrored from themesbrand.com/minia/layouts/ui-buttons.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 05 Aug 2024 05:37:17 GMT -->
</html>
