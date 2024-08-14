<!doctype html>
<html lang="en">

    
<!-- Mirrored from themesbrand.com/minia/layouts/form-elements.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 05 Aug 2024 05:37:28 GMT -->
<head>
        
        <meta charset="utf-8" />
        <title>Basic Elements | Minia - Minimal Admin & Dashboard Template</title>
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
                                    <h4 class="mb-sm-0 font-size-18">Basic Elements</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                                            <li class="breadcrumb-item active">Basic Elements</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Textual inputs</h4>
                                        <p class="card-title-desc">Here are examples of <code>.form-control</code> applied to each
                                            textual HTML5 <code>&lt;input&gt;</code> <code>type</code>.</p>
                                    </div>
                                    <div class="card-body p-4">
        
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div>
                                                    <div class="mb-3">
                                                        <label for="example-text-input" class="form-label">Text</label>
                                                        <input class="form-control" type="text" value="Artisanal kale" id="example-text-input">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="example-search-input" class="form-label">Search</label>
                                                        <input class="form-control" type="search" value="How do I shoot web" id="example-search-input">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="example-email-input" class="form-label">Email</label>
                                                        <input class="form-control" type="email" value="bootstrap@example.com" id="example-email-input">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="example-url-input" class="form-label">URL</label>
                                                        <input class="form-control" type="url" value="https://getbootstrap.com" id="example-url-input">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="example-tel-input" class="form-label">Telephone</label>
                                                        <input class="form-control" type="tel" value="1-(555)-555-5555" id="example-tel-input">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="example-password-input" class="form-label">Password</label>
                                                        <input class="form-control" type="password" value="hunter2" id="example-password-input">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="example-number-input" class="form-label">Number</label>
                                                        <input class="form-control" type="number" value="42" id="example-number-input">
                                                    </div>
                                                    <div>
                                                        <label for="example-datetime-local-input" class="form-label">Date and time</label>
                                                        <input class="form-control" type="datetime-local" value="2019-08-19T13:45:00" id="example-datetime-local-input">
                                                    </div>
                                                    
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mt-3 mt-lg-0">
                                                    <div class="mb-3">
                                                        <label for="example-date-input" class="form-label">Date</label>
                                                        <input class="form-control" type="date" value="2019-08-19" id="example-date-input">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="example-month-input" class="form-label">Month</label>
                                                        <input class="form-control" type="month" value="2019-08" id="example-month-input">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="example-week-input" class="form-label">Week</label>
                                                        <input class="form-control" type="week" value="2019-W33" id="example-week-input">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="example-time-input" class="form-label">Time</label>
                                                        <input class="form-control" type="time" value="13:45:00" id="example-time-input">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="example-color-input" class="form-label">Color picker</label>
                                                        <input type="color" class="form-control form-control-color mw-100" id="example-color-input" value="#5156be" title="Choose your color">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Select</label>
                                                        <select class="form-select">
                                                            <option>Select</option>
                                                            <option>Large select</option>
                                                            <option>Small select</option>
                                                        </select>
                                                    </div>
            
                                                    <div>
                                                        <label for="exampleDataList" class="form-label">Datalists</label>
                                                        <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Type to search...">
                                                        <datalist id="datalistOptions">
                                                            <option value="San Francisco">
                                                            <option value="New York">
                                                            <option value="Seattle">
                                                            <option value="Los Angeles">
                                                            <option value="Chicago">
                                                        </datalist>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                        <!-- Start row -->
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Sizing</h4>
                                        <p class="card-title-desc">Set heights using classes like <code>.form-control-lg</code> and <code>.form-control-sm</code>.</p>
                                    </div>
                                    <div class="card-body">
                                        <form>
                                            <div class="mb-4">
                                                <label class="form-label" for="default-input">Default input</label>
                                                <input class="form-control" type="text" id="default-input" placeholder="Default input">
                                            </div>
                                            <div class="mb-4">
                                                <label class="form-label" for="form-sm-input">Form Small input</label>
                                                <input class="form-control form-control-sm" type="text" id="form-sm-input" placeholder=".form-control-sm">
                                            </div>
                                            <div>
                                                <label class="form-label" for="form-lg-input">Form Large input</label>
                                                <input class="form-control form-control-lg" type="text" id="form-lg-input" placeholder=".form-control-lg">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Range Inputs</h4>
                                        <p class="card-title-desc">Create custom <code>&lt;input type="range"&gt;</code>
                                            controls with <code>.form-range</code>.</p>
                                    </div>
                                    <div class="card-body">
                                        

                                        <div class="mb-3">
                                            <label for="customRange1" class="form-label">Example range</label>
                                            <input type="range" class="form-range" id="customRange1">
                                        </div>

                                        <div class="mb-4">
                                            <h5 class="font-size-14 mb-1">Min and max</h5>
                                            <p class="card-title-desc mb-2">Range inputs have implicit values for min and
                                                max—0 and 100, respectively.</p>
                                            <input type="range" class="form-range" min="0" max="5" id="customRange2">
                                        </div>

                                        <div>
                                            <h5 class="font-size-14 mb-1">Steps</h5>
                                            <p class="card-title-desc mb-2">By default, range inputs “snap” to integer
                                                values. To change this, you can specify a <code>step</code> value.</p>
                                            <input type="range" class="form-range" min="0" max="5" id="customRange3">
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- End row -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Form layouts</h4>
                                        <p class="card-title-desc">Form layout options : from inline, horizontal & custom grid implementations</p>
                                    </div>
                                    <div class="card-body p-4">
                                        
                                        <div class="row">
                                            <div class="col-lg-5">
                                                <div>
                                                    <h5 class="font-size-14 mb-4"><i class="mdi mdi-arrow-right text-primary me-1"></i> Form groups</h5>
                                                    <form>
                                                        <div class="mb-3">
                                                            <label class="form-label" for="formrow-firstname-input">First name</label>
                                                            <input type="text" class="form-control" id="formrow-firstname-input" placeholder="Enter Name">
                                                        </div>
            
                                                        <div class="row">                                                            
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="formrow-email-input">Email</label>
                                                                    <input type="email" class="form-control" id="formrow-email-input" placeholder="Enter your Email">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="formrow-password-input">Password</label>
                                                                    <input type="password" class="form-control" id="formrow-password-input" placeholder="Enter your password">
                                                                </div>
                                                            </div>
                                                        </div>
            
            
                                                        <div class="form-group">
                                                            
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input" id="formrow-customCheck">
                                                                <label class="form-check-label" for="formrow-customCheck">Check me out</label>
                                                            </div>
                                                        </div>
                                                        <div class="mt-4">
                                                            <button type="submit" class="btn btn-primary w-md">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 ms-lg-auto">
                                                <div class="mt-4 mt-lg-0">
                                                    <h5 class="font-size-14 mb-4"><i class="mdi mdi-arrow-right text-primary me-1"></i> Horizontal form</h5>
                                                    
                                                    <form>
                                                        <div class="row mb-4">
                                                            <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">First name</label>
                                                            <div class="col-sm-9">
                                                              <input type="text" class="form-control" id="horizontal-firstname-input" placeholder="Enter your First Name">
                                                            </div>
                                                        </div>
                                                        <div class="row mb-4">
                                                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Email</label>
                                                            <div class="col-sm-9">
                                                                <input type="email" class="form-control" id="horizontal-email-input" placeholder="Enter your Email">
                                                            </div>
                                                        </div>
                                                        <div class="row mb-4">
                                                            <label for="horizontal-password-input" class="col-sm-3 col-form-label">Password</label>
                                                            <div class="col-sm-9">
                                                              <input type="password" class="form-control" id="horizontal-password-input" placeholder="Enter your password">
                                                            </div>
                                                        </div>
            
                                                        <div class="row justify-content-end">
                                                            <div class="col-sm-9">
                                                                <div class="form-check mb-4">
                                                                    <input type="checkbox" class="form-check-input" id="horizontal-customCheck">
                                                                    <label class="form-check-label" for="horizontal-customCheck">Remember me</label>
                                                                </div>
            
                                                                <div>
                                                                    <button type="submit" class="btn btn-primary w-md">Submit</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-4">
                                            <div class="col-lg-6">
                                                <h5 class="font-size-14 mb-4"><i class="mdi mdi-arrow-right text-primary me-1"></i> Inline forms layout</h5>
                                        
                                                <form class="row gx-3 gy-2 align-items-center mb-4 mb-lg-0">
                                                    <div class="col-sm-4">
                                                        <label class="visually-hidden" for="specificSizeInputName">Name</label>
                                                        <input type="text" class="form-control" id="specificSizeInputName" placeholder="Enter Name">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label class="visually-hidden" for="specificSizeInputGroupUsername">Username</label>
                                                        <div class="input-group">
                                                            <div class="input-group-text">@</div>
                                                            <input type="text" class="form-control" id="specificSizeInputGroupUsername" placeholder="Username">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-auto">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" id="autoSizingCheck2">
                                                            <label class="form-check-label" for="autoSizingCheck2">
                                                                Remember me
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-auto">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </form>
                                            </div>

                                            <div class="col-lg-6">
                                                <h5 class="font-size-14 mb-4"><i class="mdi mdi-arrow-right text-primary me-1"></i> Floating Label</h5>

                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-floating mb-3 mb-lg-0">
                                                            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                                                            <label for="floatingInput">Email address</label>
                                                        </div>                                                        
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-floating">
                                                            <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                                                            <label for="floatingPassword">Password</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-4">
                                            <div class="col-lg-6">
                                                <h5 class="font-size-14 mb-4"><i class="mdi mdi-arrow-right text-primary me-1"></i> Inline forms layout used by hstack</h5>
                                                <form class="row gx-3 gy-2 align-items-center">
                                                    <div class="hstack gap-3">
                                                        <input class="form-control me-auto" type="text" placeholder="Add your item here...">
                                                        <button type="button" class="btn btn-secondary">Submit</button>
                                                        <div class="vr"></div>
                                                        <button type="reset" class="btn btn-outline-danger">Reset</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Form Layout -->

                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title mb-0">Checkboxes</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">

                                                <div >
                                                    <h5 class="font-size-14 mb-3"><i class="mdi mdi-arrow-right text-primary me-1"></i> Form Checkboxes
                                                    </h5>
                                                    <div class="form-check mb-3">
                                                        <input class="form-check-input" type="checkbox" id="formCheck1">
                                                        <label class="form-check-label" for="formCheck1">
                                                            Form Checkbox
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="formCheck2" checked>
                                                        <label class="form-check-label" for="formCheck2">
                                                            Form Checkbox checked
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">

                                                <div class="mt-4 mt-md-0">
                                                    <h5 class="font-size-14 mb-3"><i class="mdi mdi-arrow-right text-primary me-1"></i> Form Checkboxes
                                                        Right</h5>
                                                    <div>
                                                        <div class="form-check form-check-right mb-3">
                                                            <input class="form-check-input" type="checkbox" id="formCheckRight1">
                                                            <label class="form-check-label" for="formCheckRight1">
                                                                Form Checkbox Right
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="form-check form-check-right">
                                                            <input class="form-check-input" type="checkbox" id="formCheckRight2"
                                                                checked>
                                                            <label class="form-check-label" for="formCheckRight2">
                                                                Form Checkbox Right checked
                                                            </label>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title mb-0">Radios</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div>
                                                    <h5 class="font-size-14 mb-3"><i class="mdi mdi-arrow-right text-primary me-1"></i>Form Radios</h5>
                                                    <div class="form-check mb-3">
                                                        <input class="form-check-input" type="radio" name="formRadios"
                                                            id="formRadios1" checked>
                                                        <label class="form-check-label" for="formRadios1">
                                                            Form Radio
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="formRadios"
                                                            id="formRadios2">
                                                        <label class="form-check-label" for="formRadios2">
                                                            Form Radio checked
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mt-4 mt-md-0">
                                                    <h5 class="font-size-14 mb-3"><i class="mdi mdi-arrow-right text-primary me-1"></i>Form Radios Right</h5>
                                                    <div>
                                                        <div class="form-check form-check-right mb-3">
                                                            <input class="form-check-input" type="radio" name="formRadiosRight"
                                                                id="formRadiosRight1" checked>
                                                            <label class="form-check-label" for="formRadiosRight1">
                                                                Form Radio Right
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div>
                                                        <div class="form-check form-check-right">
                                                            <input class="form-check-input" type="radio" name="formRadiosRight"
                                                                id="formRadiosRight2">
                                                            <label class="form-check-label" for="formRadiosRight2">
                                                                Form Radio Right checked
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Switches</h4>
                                        <p class="card-title-desc">A switch has the markup of a custom checkbox but uses the <code>.form-switch</code> class to render a toggle switch. Switches also support the <code>disabled</code> attribute.</p>
                                    </div>
                                    <div class="card-body">
                                        

                                        <div class="row">

                                            <div class="col-md-6">
                                                <div>
                                                    <h5 class="font-size-14 mb-3"><i class="mdi mdi-arrow-right text-primary me-1"></i>Switch examples</h5>


                                                    <div class="form-check form-switch mb-3" dir="ltr">
                                                        <input type="checkbox" class="form-check-input" id="customSwitch1" checked>
                                                        <label class="form-check-label" for="customSwitch1">Toggle this switch element</label>
                                                    </div>
                                                    <div class="form-check form-switch" dir="ltr">
                                                        <input type="checkbox" class="form-check-input" disabled id="customSwitch2">
                                                        <label class="form-check-label" for="customSwitch2">Disabled switch element</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mt-4 mt-md-0">
                                                    <h5 class="font-size-14 mb-3"><i class="mdi mdi-arrow-right text-primary me-1"></i>Switch sizes</h5>
        
                                                    <div class="form-check form-switch mb-3" dir="ltr">
                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizesm" checked>
                                                        <label class="form-check-label" for="customSwitchsizesm">Small Size Switch</label>
                                                    </div>
        
                                                    <div class="form-check form-switch form-switch-md mb-3" dir="ltr">
                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizemd">
                                                        <label class="form-check-label" for="customSwitchsizemd">Medium Size Switch</label>
                                                    </div>
        
                                                    <div class="form-check form-switch form-switch-lg mb-3" dir="ltr">
                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg" checked>
                                                        <label class="form-check-label" for="customSwitchsizelg">Large Size Switch</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                    </div> <!-- container-fluid -->
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

<!-- Mirrored from themesbrand.com/minia/layouts/form-elements.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 05 Aug 2024 05:37:29 GMT -->
</html>
