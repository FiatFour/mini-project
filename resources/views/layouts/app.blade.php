<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>{{ config('app.name') }}</title>

    <meta name="description"
        content="Dashmix - Bootstrap 5 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
    <meta name="author" content="pixelcave">
    <meta name="robots" content="noindex, nofollow">

    <!-- Open Graph Meta -->
    <meta property="og:title" content="Dashmix - Bootstrap 5 Admin Template &amp; UI Framework">
    <meta property="og:site_name" content="Dashmix">
    <meta property="og:description"
        content="Dashmix - Bootstrap 5 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:image" content="">

    <!-- Icons -->
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <link rel="shortcut icon" href="{{ asset('assets/media/favicons/favicon.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"
        href="{{ asset('assets/media/favicons/favicon-192x192.png') }}">
    <link rel="apple-touch-icon" sizes="180x180"
        href="{{ asset('assets/media/favicons/apple-touch-icon-180x180.png') }}">
    <!-- END Icons -->

    <!-- Stylesheets -->
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet"
        href="{{ asset('assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/js/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/ion-rangeslider/css/ion.rangeSlider.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/dropzone/min/dropzone.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.css') }}">

    <!-- Fonts and Dashmix framework -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/dashmix.min.css') }}">

    @stack('custom_styles')
    <!-- You can include a specific file from css/themes/ folder to alter the default color theme of the template. eg: -->
    <!-- <link rel="stylesheet" id="css-theme" href="assets/css/themes/xwork.min.css"> -->
    <!-- END Stylesheets -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <!-- Page Container -->
    <!--
      Available classes for #page-container:

      GENERIC

        'remember-theme'                            Remembers active color theme and dark mode between pages using localStorage when set through
                                                    - Theme helper buttons [data-toggle="theme"],
                                                    - Layout helper buttons [data-toggle="layout" data-action="dark_mode_[on/off/toggle]"]
                                                    - ..and/or Dashmix.layout('dark_mode_[on/off/toggle]')

      SIDEBAR & SIDE OVERLAY

        'sidebar-r'                                 Right Sidebar and left Side Overlay (default is left Sidebar and right Side Overlay)
        'sidebar-mini'                              Mini hoverable Sidebar (screen width > 991px)
        'sidebar-o'                                 Visible Sidebar by default (screen width > 991px)
        'sidebar-o-xs'                              Visible Sidebar by default (screen width < 992px)
        'sidebar-dark'                              Dark themed sidebar

        'side-overlay-hover'                        Hoverable Side Overlay (screen width > 991px)
        'side-overlay-o'                            Visible Side Overlay by default

        'enable-page-overlay'                       Enables a visible clickable Page Overlay (closes Side Overlay on click) when Side Overlay opens

        'side-scroll'                               Enables custom scrolling on Sidebar and Side Overlay instead of native scrolling (screen width > 991px)

      HEADER

        ''                                          Static Header if no class is added
        'page-header-fixed'                         Fixed Header


      FOOTER

        ''                                          Static Footer if no class is added
        'page-footer-fixed'                         Fixed Footer (please have in mind that the footer has a specific height when is fixed)

      HEADER STYLE

        ''                                          Classic Header style if no class is added
        'page-header-dark'                          Dark themed Header
        'page-header-glass'                         Light themed Header with transparency by default
                                                    (absolute position, perfect for light images underneath - solid light background on scroll if the Header is also set as fixed)
        'page-header-glass page-header-dark'         Dark themed Header with transparency by default
                                                    (absolute position, perfect for dark images underneath - solid dark background on scroll if the Header is also set as fixed)

      MAIN CONTENT LAYOUT

        ''                                          Full width Main Content if no class is added
        'main-content-boxed'                        Full width Main Content with a specific maximum width (screen width > 1200px)
        'main-content-narrow'                       Full width Main Content with a percentage width (screen width > 1200px)

      DARK MODE

        'sidebar-dark page-header-dark dark-mode'   Enable dark mode (light sidebar/header is not supported with dark mode)
    -->
    <div id="page-container"
        class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed main-content-narrow">
        <!-- Side Overlay-->
        <aside id="side-overlay">
            <!-- Side Header -->
            <div class="bg-image" style="background-image: url('assets/media/various/bg_side_overlay_header.jpg');">
                <div class="bg-primary-op">
                    <div class="content-header">
                        <!-- User Avatar -->
                        <a class="img-link me-1" href="be_pages_generic_profile.html">
                            <img class="img-avatar img-avatar48" src="assets/media/avatars/avatar10.jpg" alt="">
                        </a>
                        <!-- END User Avatar -->

                        <!-- User Info -->
                        <div class="ms-2">
                            <a class="text-white fw-semibold" href="be_pages_generic_profile.html">George Taylor</a>
                            <div class="text-white-75 fs-sm">Full Stack Developer</div>
                        </div>
                        <!-- END User Info -->

                        <!-- Close Side Overlay -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <a class="ms-auto text-white" href="javascript:void(0)" data-toggle="layout"
                            data-action="side_overlay_close">
                            <i class="fa fa-times-circle"></i>
                        </a>
                        <!-- END Close Side Overlay -->
                    </div>
                </div>
            </div>
            <!-- END Side Header -->

            <!-- Side Content -->
            <div class="content-side">
                <!-- Side Overlay Tabs -->
                <div class="block block-transparent pull-x pull-t mb-0">
                    <ul class="nav nav-tabs nav-tabs-block nav-justified" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="so-settings-tab" data-bs-toggle="tab"
                                data-bs-target="#so-settings" role="tab" aria-controls="so-settings"
                                aria-selected="true">
                                <i class="fa fa-fw fa-cog"></i>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="so-people-tab" data-bs-toggle="tab" data-bs-target="#so-people"
                                role="tab" aria-controls="so-people" aria-selected="false">
                                <i class="far fa-fw fa-user-circle"></i>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="so-profile-tab" data-bs-toggle="tab"
                                data-bs-target="#so-profile" role="tab" aria-controls="so-profile"
                                aria-selected="false">
                                <i class="far fa-fw fa-edit"></i>
                            </button>
                        </li>
                    </ul>
                    <div class="block-content tab-content overflow-hidden">
                        <!-- Settings Tab -->
                        <div class="tab-pane pull-x fade fade-up show active" id="so-settings" role="tabpanel"
                            aria-labelledby="so-settings-tab">
                            <div class="block mb-0">
                                <!-- Color Themes -->
                                <!-- Toggle Themes functionality initialized in Template._uiHandleTheme() -->
                                <div class="block-content block-content-sm block-content-full bg-body">
                                    <span class="text-uppercase fs-sm fw-bold">Color Themes</span>
                                </div>
                                <div class="block-content block-content-full">
                                    <div class="row g-sm text-center">
                                        <div class="col-4 mb-1">
                                            <a class="d-block py-3 text-white fs-sm fw-semibold bg-default"
                                                data-toggle="theme" data-theme="default" href="#">
                                                Default
                                            </a>
                                        </div>
                                        <div class="col-4 mb-1">
                                            <a class="d-block py-3 text-white fs-sm fw-semibold bg-xwork"
                                                data-toggle="theme" data-theme="assets/css/themes/xwork.min.css"
                                                href="#">
                                                xWork
                                            </a>
                                        </div>
                                        <div class="col-4 mb-1">
                                            <a class="d-block py-3 text-white fs-sm fw-semibold bg-xmodern"
                                                data-toggle="theme" data-theme="assets/css/themes/xmodern.min.css"
                                                href="#">
                                                xModern
                                            </a>
                                        </div>
                                        <div class="col-4 mb-1">
                                            <a class="d-block py-3 text-white fs-sm fw-semibold bg-xeco"
                                                data-toggle="theme" data-theme="assets/css/themes/xeco.min.css"
                                                href="#">
                                                xEco
                                            </a>
                                        </div>
                                        <div class="col-4 mb-1">
                                            <a class="d-block py-3 text-white fs-sm fw-semibold bg-xsmooth"
                                                data-toggle="theme" data-theme="assets/css/themes/xsmooth.min.css"
                                                href="#">
                                                xSmooth
                                            </a>
                                        </div>
                                        <div class="col-4 mb-1">
                                            <a class="d-block py-3 text-white fs-sm fw-semibold bg-xinspire"
                                                data-toggle="theme" data-theme="assets/css/themes/xinspire.min.css"
                                                href="#">
                                                xInspire
                                            </a>
                                        </div>
                                        <div class="col-4 mb-1">
                                            <a class="d-block py-3 text-white fs-sm fw-semibold bg-xdream"
                                                data-toggle="theme" data-theme="assets/css/themes/xdream.min.css"
                                                href="#">
                                                xDream
                                            </a>
                                        </div>
                                        <div class="col-4 mb-1">
                                            <a class="d-block py-3 text-white fs-sm fw-semibold bg-xpro"
                                                data-toggle="theme" data-theme="assets/css/themes/xpro.min.css"
                                                href="#">
                                                xPro
                                            </a>
                                        </div>
                                        <div class="col-4 mb-1">
                                            <a class="d-block py-3 text-white fs-sm fw-semibold bg-xplay"
                                                data-toggle="theme" data-theme="assets/css/themes/xplay.min.css"
                                                href="#">
                                                xPlay
                                            </a>
                                        </div>
                                        <div class="col-12">
                                            <a class="d-block py-3 bg-body-dark fw-semibold text-dark"
                                                href="be_ui_color_themes.html">All Color Themes</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- END Color Themes -->

                                <!-- Sidebar -->
                                <div class="block-content block-content-sm block-content-full bg-body">
                                    <span class="text-uppercase fs-sm fw-bold">Sidebar</span>
                                </div>
                                <div class="block-content block-content-full">
                                    <div class="row g-sm text-center">
                                        <div class="col-6 mb-1">
                                            <a class="d-block py-3 bg-body-dark fw-semibold text-dark"
                                                data-toggle="layout" data-action="sidebar_style_dark"
                                                href="javascript:void(0)">Dark</a>
                                        </div>
                                        <div class="col-6 mb-1">
                                            <a class="d-block py-3 bg-body-dark fw-semibold text-dark"
                                                data-toggle="layout" data-action="sidebar_style_light"
                                                href="javascript:void(0)">Light</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- END Sidebar -->

                                <!-- Header -->
                                <div class="block-content block-content-sm block-content-full bg-body">
                                    <span class="text-uppercase fs-sm fw-bold">Header</span>
                                </div>
                                <div class="block-content block-content-full">
                                    <div class="row g-sm text-center mb-2">
                                        <div class="col-6 mb-1">
                                            <a class="d-block py-3 bg-body-dark fw-semibold text-dark"
                                                data-toggle="layout" data-action="header_style_dark"
                                                href="javascript:void(0)">Dark</a>
                                        </div>
                                        <div class="col-6 mb-1">
                                            <a class="d-block py-3 bg-body-dark fw-semibold text-dark"
                                                data-toggle="layout" data-action="header_style_light"
                                                href="javascript:void(0)">Light</a>
                                        </div>
                                        <div class="col-6 mb-1">
                                            <a class="d-block py-3 bg-body-dark fw-semibold text-dark"
                                                data-toggle="layout" data-action="header_mode_fixed"
                                                href="javascript:void(0)">Fixed</a>
                                        </div>
                                        <div class="col-6 mb-1">
                                            <a class="d-block py-3 bg-body-dark fw-semibold text-dark"
                                                data-toggle="layout" data-action="header_mode_static"
                                                href="javascript:void(0)">Static</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- END Header -->

                                <!-- Content -->
                                <div class="block-content block-content-sm block-content-full bg-body">
                                    <span class="text-uppercase fs-sm fw-bold">Content</span>
                                </div>
                                <div class="block-content block-content-full">
                                    <div class="row g-sm text-center">
                                        <div class="col-6 mb-1">
                                            <a class="d-block py-3 bg-body-dark fw-semibold text-dark"
                                                data-toggle="layout" data-action="content_layout_boxed"
                                                href="javascript:void(0)">Boxed</a>
                                        </div>
                                        <div class="col-6 mb-1">
                                            <a class="d-block py-3 bg-body-dark fw-semibold text-dark"
                                                data-toggle="layout" data-action="content_layout_narrow"
                                                href="javascript:void(0)">Narrow</a>
                                        </div>
                                        <div class="col-12 mb-1">
                                            <a class="d-block py-3 bg-body-dark fw-semibold text-dark"
                                                data-toggle="layout" data-action="content_layout_full_width"
                                                href="javascript:void(0)">Full Width</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- END Content -->

                                <!-- Layout API -->
                                <div class="block-content block-content-full border-top">
                                    <a class="btn w-100 btn-alt-primary" href="be_layout_api.html">
                                        <i class="fa fa-fw fa-flask me-1"></i> Layout API
                                    </a>
                                </div>
                                <!-- END Layout API -->
                            </div>
                        </div>
                        <!-- END Settings Tab -->

                        <!-- People -->
                        <div class="tab-pane pull-x fade fade-up" id="so-people" role="tabpanel"
                            aria-labelledby="so-people-tab">
                            <div class="block mb-0">
                                <!-- Online -->
                                <div class="block-content block-content-sm block-content-full bg-body">
                                    <span class="text-uppercase fs-sm fw-bold">Online</span>
                                </div>
                                <div class="block-content">
                                    <ul class="nav-items">
                                        <li>
                                            <a class="d-flex py-2" href="be_pages_generic_profile.html">
                                                <div class="flex-shrink-0 mx-3 overlay-container">
                                                    <img class="img-avatar img-avatar48"
                                                        src="assets/media/avatars/avatar1.jpg" alt="">
                                                    <span
                                                        class="overlay-item item item-tiny item-circle border border-2 border-white bg-success"></span>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="fw-semibold">Amber Harvey</div>
                                                    <div class="fs-sm text-muted">Photographer</div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="d-flex py-2" href="be_pages_generic_profile.html">
                                                <div class="flex-shrink-0 mx-3 overlay-container">
                                                    <img class="img-avatar img-avatar48"
                                                        src="assets/media/avatars/avatar9.jpg" alt="">
                                                    <span
                                                        class="overlay-item item item-tiny item-circle border border-2 border-white bg-success"></span>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="fw-semibold">Albert Ray</div>
                                                    <div class="fw-normal fs-sm text-muted">Web Designer</div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="d-flex py-2" href="be_pages_generic_profile.html">
                                                <div class="flex-shrink-0 mx-3 overlay-container">
                                                    <img class="img-avatar img-avatar48"
                                                        src="assets/media/avatars/avatar2.jpg" alt="">
                                                    <span
                                                        class="overlay-item item item-tiny item-circle border border-2 border-white bg-success"></span>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="fw-semibold">Andrea Gardner</div>
                                                    <div class="fw-normal fs-sm text-muted">Web Developer</div>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- Online -->

                                <!-- Busy -->
                                <div class="block-content block-content-sm block-content-full bg-body">
                                    <span class="text-uppercase fs-sm fw-bold">Busy</span>
                                </div>
                                <div class="block-content">
                                    <ul class="nav-items">
                                        <li>
                                            <a class="d-flex py-2" href="be_pages_generic_profile.html">
                                                <div class="flex-shrink-0 mx-3 overlay-container">
                                                    <img class="img-avatar img-avatar48"
                                                        src="assets/media/avatars/avatar5.jpg" alt="">
                                                    <span
                                                        class="overlay-item item item-tiny item-circle border border-2 border-white bg-danger"></span>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="fw-semibold">Amber Harvey</div>
                                                    <div class="fw-normal fs-sm text-muted">UI Designer</div>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- END Busy -->

                                <!-- Away -->
                                <div class="block-content block-content-sm block-content-full bg-body">
                                    <span class="text-uppercase fs-sm fw-bold">Away</span>
                                </div>
                                <div class="block-content">
                                    <ul class="nav-items">
                                        <li>
                                            <a class="d-flex py-2" href="be_pages_generic_profile.html">
                                                <div class="flex-shrink-0 mx-3 overlay-container">
                                                    <img class="img-avatar img-avatar48"
                                                        src="assets/media/avatars/avatar10.jpg" alt="">
                                                    <span
                                                        class="overlay-item item item-tiny item-circle border border-2 border-white bg-warning"></span>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="fw-semibold">Scott Young</div>
                                                    <div class="fw-normal fs-sm text-muted">Copywriter</div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="d-flex py-2" href="be_pages_generic_profile.html">
                                                <div class="flex-shrink-0 mx-3 overlay-container">
                                                    <img class="img-avatar img-avatar48"
                                                        src="assets/media/avatars/avatar7.jpg" alt="">
                                                    <span
                                                        class="overlay-item item item-tiny item-circle border border-2 border-white bg-warning"></span>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="fw-semibold">Andrea Gardner</div>
                                                    <div class="fw-normal fs-sm text-muted">Writer</div>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- END Away -->

                                <!-- Offline -->
                                <div class="block-content block-content-sm block-content-full bg-body">
                                    <span class="text-uppercase fs-sm fw-bold">Offline</span>
                                </div>
                                <div class="block-content">
                                    <ul class="nav-items">
                                        <li>
                                            <a class="d-flex py-2" href="be_pages_generic_profile.html">
                                                <div class="flex-shrink-0 mx-3 overlay-container">
                                                    <img class="img-avatar img-avatar48"
                                                        src="assets/media/avatars/avatar10.jpg" alt="">
                                                    <span
                                                        class="overlay-item item item-tiny item-circle border border-2 border-white bg-muted"></span>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="fw-semibold">Carl Wells</div>
                                                    <div class="fw-normal fs-sm text-muted">Teacher</div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="d-flex py-2" href="be_pages_generic_profile.html">
                                                <div class="flex-shrink-0 mx-3 overlay-container">
                                                    <img class="img-avatar img-avatar48"
                                                        src="assets/media/avatars/avatar1.jpg" alt="">
                                                    <span
                                                        class="overlay-item item item-tiny item-circle border border-2 border-white bg-muted"></span>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="fw-semibold">Amanda Powell</div>
                                                    <div class="fw-normal fs-sm text-muted">Photographer</div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="d-flex py-2" href="be_pages_generic_profile.html">
                                                <div class="flex-shrink-0 mx-3 overlay-container">
                                                    <img class="img-avatar img-avatar48"
                                                        src="assets/media/avatars/avatar1.jpg" alt="">
                                                    <span
                                                        class="overlay-item item item-tiny item-circle border border-2 border-white bg-muted"></span>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="fw-semibold">Amber Harvey</div>
                                                    <div class="fw-normal fs-sm text-muted">Front-end Developer</div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="d-flex py-2" href="be_pages_generic_profile.html">
                                                <div class="flex-shrink-0 mx-3 overlay-container">
                                                    <img class="img-avatar img-avatar48"
                                                        src="assets/media/avatars/avatar13.jpg" alt="">
                                                    <span
                                                        class="overlay-item item item-tiny item-circle border border-2 border-white bg-muted"></span>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="fw-semibold">Albert Ray</div>
                                                    <div class="fw-normal fs-sm text-muted">UX Specialist</div>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- END Offline -->

                                <!-- Add People -->
                                <div class="block-content block-content-full border-top">
                                    <a class="btn w-100 btn-alt-primary" href="javascript:void(0)">
                                        <i class="fa fa-fw fa-plus me-1 opacity-50"></i> Add People
                                    </a>
                                </div>
                                <!-- END Add People -->
                            </div>
                        </div>
                        <!-- END People -->

                        <!-- Profile -->
                        <div class="tab-pane pull-x fade fade-up" id="so-profile" role="tabpanel"
                            aria-labelledby="so-profile-tab">
                            <form action="be_pages_dashboard.html" method="POST" onsubmit="return false;">
                                <div class="block mb-0">
                                    <!-- Personal -->
                                    <div class="block-content block-content-sm block-content-full bg-body">
                                        <span class="text-uppercase fs-sm fw-bold">Personal</span>
                                    </div>
                                    <div class="block-content block-content-full">
                                        <div class="mb-4">
                                            <label class="form-label">Username</label>
                                            <input type="text" readonly class="form-control"
                                                id="so-profile-username-static" value="Admin">
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="so-profile-name">Name</label>
                                            <input type="text" class="form-control" id="so-profile-name"
                                                name="so-profile-name" value="George Taylor">
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="so-profile-email">Email</label>
                                            <input type="email" class="form-control" id="so-profile-email"
                                                name="so-profile-email" value="g.taylor@example.com">
                                        </div>
                                    </div>
                                    <!-- END Personal -->

                                    <!-- Password Update -->
                                    <div class="block-content block-content-sm block-content-full bg-body">
                                        <span class="text-uppercase fs-sm fw-bold">Password Update</span>
                                    </div>
                                    <div class="block-content block-content-full">
                                        <div class="mb-4">
                                            <label class="form-label" for="so-profile-password">Current
                                                Password</label>
                                            <input type="password" class="form-control" id="so-profile-password"
                                                name="so-profile-password">
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="so-profile-new-password">New
                                                Password</label>
                                            <input type="password" class="form-control" id="so-profile-new-password"
                                                name="so-profile-new-password">
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="so-profile-new-password-confirm">Confirm
                                                New Password</label>
                                            <input type="password" class="form-control"
                                                id="so-profile-new-password-confirm"
                                                name="so-profile-new-password-confirm">
                                        </div>
                                    </div>
                                    <!-- END Password Update -->

                                    <!-- Options -->
                                    <div class="block-content block-content-sm block-content-full bg-body">
                                        <span class="text-uppercase fs-sm fw-bold">Options</span>
                                    </div>
                                    <div class="block-content">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="so-settings-status" name="so-settings-status">
                                            <label class="form-check-label fw-semibold"
                                                for="so-settings-status">Online Status</label>
                                        </div>
                                        <p class="text-muted fs-sm">
                                            Make your online status visible to other users of your app
                                        </p>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="so-settings-notifications" name="so-settings-notifications">
                                            <label class="form-check-label fw-semibold"
                                                for="so-settings-notifications">Notifications</label>
                                        </div>
                                        <p class="text-muted fs-sm">
                                            Receive desktop notifications regarding your projects and sales
                                        </p>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="so-settings-updates" name="so-settings-updates">
                                            <label class="form-check-label fw-semibold" for="so-settings-updates">Auto
                                                Updates</label>
                                        </div>
                                        <p class="text-muted fs-sm">
                                            If enabled, we will keep all your applications and servers up to date with
                                            the most recent features automatically
                                        </p>
                                    </div>
                                    <!-- END Options -->

                                    <!-- Submit -->
                                    <div class="block-content block-content-full border-top">
                                        <button type="submit" class="btn w-100 btn-alt-primary">
                                            <i class="fa fa-fw fa-save me-1 opacity-50"></i> Save
                                        </button>
                                    </div>
                                    <!-- END Submit -->
                                </div>
                            </form>
                        </div>
                        <!-- END Profile -->
                    </div>
                </div>
                <!-- END Side Overlay Tabs -->
            </div>
            <!-- END Side Content -->
        </aside>
        <!-- END Side Overlay -->

        <!-- Sidebar -->
        <!--
        Sidebar Mini Mode - Display Helper classes

        Adding 'smini-hide' class to an element will make it invisible (opacity: 0) when the sidebar is in mini mode
        Adding 'smini-show' class to an element will make it visible (opacity: 1) when the sidebar is in mini mode
          If you would like to disable the transition animation, make sure to also add the 'no-transition' class to your element

        Adding 'smini-hidden' to an element will hide it when the sidebar is in mini mode
        Adding 'smini-visible' to an element will show it (display: inline-block) only when the sidebar is in mini mode
        Adding 'smini-visible-block' to an element will show it (display: block) only when the sidebar is in mini mode
      -->
        @include('layouts.sidebar')
        <!-- END Sidebar -->

        <!-- Header -->
        @include('layouts.header')
        <!-- END Header -->

        <!-- Main Container -->
        <main id="main-container">
            <!-- Page Content -->
            @yield('content')

            <!-- END Page Content -->
        </main>

        <!-- END Main Container -->

        <!-- Footer -->
        <footer id="page-footer" class="bg-body-light">
            <div class="content py-0">
                <div class="row fs-sm">
                    <div class="col-sm-6 order-sm-2 mb-1 mb-sm-0 text-center text-sm-end">
                        Crafted with <i class="fa fa-heart text-danger"></i> by <a class="fw-semibold"
                            href="https://1.envato.market/ydb" target="_blank">pixelcave</a>
                    </div>
                    <div class="col-sm-6 order-sm-1 text-center text-sm-start">
                        <a class="fw-semibold" href="https://1.envato.market/r6y" target="_blank">Dashmix 5.1</a>
                        &copy; <span data-toggle="year-copy"></span>
                    </div>
                </div>
            </div>
        </footer>
        <!-- END Footer -->
    </div>
    <!-- END Page Container -->

    <!--
      Dashmix JS

      Core libraries and functionality
      webpack is putting everything together at assets/_js/main/app.js
    -->
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script src="{{ asset('assets/js/dashmix.app.min.js') }}"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script> --}}
    <!-- jQuery (required for BS Datepicker + BS Colorpicker + BS Maxlength + Select2 + Masked Inputs + Ion Range Slider + Password Strength Meter plugins) -->
    <script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script>

    <!-- Page JS Plugins -->
    <script src="{{ asset('assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/ion-rangeslider/js/ion.rangeSlider.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/dropzone/min/dropzone.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/pwstrength-bootstrap/pwstrength-bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.js') }}"></script>

    <!-- Page JS Helpers (Flatpickr + BS Datepicker + BS Colorpicker + BS Maxlength + Select2 + Ion Range Slider + Masked Inputs + Password Strength Meter plugins) -->
    <script>
        Dashmix.helpersOnLoad(['js-flatpickr', 'jq-datepicker', 'jq-colorpicker', 'jq-maxlength', 'jq-select2',
            'jq-rangeslider', 'jq-masked-inputs', 'jq-pw-strength'
        ]);
    </script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <script>
        $(document).ready(function () {
            /* $('.db-scroll').doubleScroll({
                resetOnWindowResize: true
            }); */

            $('.table-responsive').on('show.bs.dropdown', function () {
                $('.table-responsive').css("overflow", "inherit");
            });

            $('.table-responsive').on('hide.bs.dropdown', function () {
                $('.table-responsive').css("overflow", "auto");
            })
        });

        $('.number-format').toArray().forEach(function (field) {
            new Cleave(field, {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand'
            });
        });

        $('.tel-format').toArray().forEach(function (field) {
            new Cleave(field, {
                delimiter: '-',
                blocks: [3, 3, 4],
                uppercase: true
            });
        });

        $(document).on('shown.bs.modal', function () {
            $('.modal .number-format').toArray().forEach(function (field) {
                new Cleave(field, {
                    numeral: true,
                    numeralThousandsGroupStyle: 'thousand'
                });
            });
        });

        function showLoading() {
            $('.loading-wrapper').addClass('loadingio-spinner');
        }

        function hideLoading() {
            $('.loading-wrapper').removeClass('loadingio-spinner');
        }

        function clearForm(selector) {
            $(selector).find("input[type=text], input[type=number], input[type=email], input[type=password], textarea").val("");
            $(selector).find("select").val(null).trigger('change');
            $(selector).find("input[type=radio]").prop("checked", false);
            $(selector).find("input[type=select]").prop("checked", false);
        }

        function appendHidden(selector, name, value) {
            $("<input>").attr({
                name: name,
                type: "hidden",
                value: value
            }).appendTo(selector);
        }

        function __log(item = null) {
            console.log(item)
        }

        function transaction() {
            $('#transaction').modal('show');
        }

        function number_format(number, digit = 2) {
            number = isNaN(number) ? 0 : number;
            return (new Intl.NumberFormat([], {
                minimumFractionDigits: digit,
                maximumFractionDigits: digit
            }).format(number));
        }

        function delay(callback, ms) {
            var timer = 0;
            return function () {
                var context = this,
                    args = arguments;
                clearTimeout(timer);
                timer = setTimeout(function () {
                    callback.apply(context, args);
                }, ms || 0);
            };
        }

        function disableInputs(inputs) {
            inputs.forEach(input => {
                input.setAttribute('readonly', 'true');
                input.setAttribute('disabled', 'true');
            });
        }

        function empty(data) {
            // Check if data is a number or boolean, and return false as they're never considered empty
            if (typeof data === 'number' || typeof data === 'boolean') {
                return false;
            }

            // Check if data is undefined or null, and return true as they're considered empty
            if (typeof data === 'undefined' || data === null) {
                return true;
            }

            // Check if data has a length property (e.g. strings, arrays) and return true if the length is 0
            if (typeof data.length !== 'undefined') {
                return data.length === 0;
            }

            // Check if data is an object and use Object.keys() to determine if it has any enumerable properties
            if (typeof data === 'object') {
                return Object.keys(data).length === 0;
            }

            // Return false for any other data types, as they're not considered empty
            return false;
        };

        function bind_on_change_radio(name, cb) {
            $("input[type=radio][name=" + name + "]").on("change", function () {
                var val = $("input[type=radio][name=" + name + "]:checked").val();
                cb(parseInt(val, 10));
            });
            $("input[type=radio][name=" + name + "]:checked").trigger("change");
        }

        function set_select2(selector, value, label) {
            selector.append(new Option(label, value, true, true)).trigger('change');
        }

        //     Vue Component
        Vue.component('input-number-format-vue', {
            template: '<input v-bind:name="name" class="form-control" @input="updateValue"></input>',
            props: {
                name: '',
                options: Object,
                value: null,
            },
            mounted() {
                let input = $(this.$el);
                if (this.value) {
                    input.val(this.value).trigger('change')
                }
                new Cleave(input, {
                    numeral: true,
                    numeralThousandsGroupStyle: 'thousand',
                })
            },
            methods: {
                updateValue(event) {
                    this.$emit('input', event.target.value);
                }
            }
        });

        Vue.component('input-tel-format-vue', {
            template: '<input v-bind:name="name" class="form-control" @input="updateValue">',
            props: {
                name: '',
                options: Object,
                value: null,
            },
            mounted() {
                let input = $(this.$el);
                if (this.value) {
                    input.val(this.value).trigger('change')
                }
                new Cleave(input, {
                    blocks: [3, 3, 4],
                    numericOnly: true,
                    delimiter: '-',
                })

            },
            methods: {
                updateValue(event) {
                    this.$emit('input', event.target.value);
                }
            }
        });

        Vue.component('input-citizen-format-vue', {
            template: '<input v-bind:name="name" class="form-control" @input="updateValue">',
            props: {
                name: '',
                options: Object,
                value: null,
            },
            mounted() {
                let input = $(this.$el);
                if (this.value) {
                    input.val(this.value).trigger('change')
                }
                new Cleave(input, {
                    numeral: true,
                    numeralThousandsGroupStyle: 'none'
                })

            },
            methods: {
                updateValue(event) {
                    this.$emit('input', event.target.value);
                }
            }
        });
    </script>
    @stack('scripts')
    @yield('customJs')
</body>

</html>
