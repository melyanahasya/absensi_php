<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        
        .be-top-header .be-navbar-header .navbar-brand {
            background-image: url("https://res.cloudinary.com/studiokonkon/image/upload/v1543962008/website/konkon-header-300x76-ova.png");
        }

        .be-color-header .be-top-header .be-navbar-header .navbar-brand {
            background-image: url("https://res.cloudinary.com/studiokonkon/image/upload/v1543962008/website/konkon-header-300x76-ova.png");
        }

        

        .be-left-sidebar,
        .left-sidebar-scroll {
            overscroll-behavior: contain !important;
        }


        /** Scrollbars Style **/

        .left-sidebar-scroll {
            overflow-y: auto !important;

            &::-webkit-scrollbar {
                display: block;
                width: 10px;
                height: 100%;
                transition: background-color .2s linear, opacity .2s linear;
                -webkit-transition: background-color .2s linear, opacity .2s linear;
                background-color: transparent;
            }

            &::-webkit-scrollbar-track-piece {
                background-color: #eee;
            }

            &::-webkit-scrollbar-thumb {
                background-color: #aaa;
                background-clip: padding-box;
                border: solid 2px transparent;
                border-radius: 6px;
            }
        }
    </style>
</head>

<body>
   

    <body class="bg-light">
        <div class="be-wrapper be-offcanvas-menu be-fixed-sidebar">

            <!-- <nav class="navbar navbar-expand fixed-top be-top-header">
                <div class="container-fluid">

                    <div class="be-navbar-header">
                        <a class="nav-link be-toggle-left-sidebar" href="#" id="left-sidebar-toggle"><span
                                class="icon zmdi zmdi-menu"></span></a>
                        <a class="navbar-brand" href="/app"></a>
                    </div>

                    <div class="page-title"><span>App Studio KonKon</span></div>

                    <div class="be-right-navbar">
                        <ul class="nav navbar-nav menu-end be-icons-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle d-none d-sm-block" href="#" data-bs-toggle="dropdown"
                                    role="button" aria-expanded="false">
                                    <span class="icon zmdi zmdi-settings"></span>
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">
                                        Action
                                        <span class="badge badge-success float-right">34</span>
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        Another action
                                        <span class="badge badge-pill badge-info float-right">16</span>
                                    </a>
                                    <a class="dropdown-item disabled" href="#">Something else here</a>
                                    <div class="dropdown-divider"></div>
                                    <h6 class="dropdown-header">Dropdown header</h6>
                                    <a class="dropdown-item active" href="#">
                                        <i class="icon zmdi zmdi-help"></i> With icon
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="icon zmdi zmdi-settings"></i> Last action
                                    </a>
                                    <div class="dropdown-tools">
                                        <div class="btn-group mt-1 mb-2">
                                            <button class="btn btn-secondary" data-bs-toggle="modal"
                                                data-bs-target="#mod-warning" type="button">
                                                <span class="zmdi zmdi-power"></span>
                                            </button>
                                            <button class="btn btn-secondary active" data-bs-toggle="modal"
                                                data-bs-target="#mod-warning" type="button">
                                                <span class="zmdi zmdi-wrench"></span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle d-none d-sm-block" href="#" data-bs-toggle="dropdown"
                                    role="button" aria-expanded="false">
                                    <span class="icon zmdi zmdi-apps"></span>
                                </a>
                                <div class="dropdown-menu be-apps">
                                    <div class="skk-anc">
                                        <ul class="skk-ang">
                                            <li class="skk-ani">
                                                <a href="#">
                                                    <img src="https://via.placeholder.com/128/fe669e/fff.png"
                                                        class="rounded-circle" alt="Avatar" />
                                                    <span>Account</span>
                                                </a>
                                            </li>
                                            <li class="skk-ani">
                                                <a href="#">
                                                    <i class="icon zmdi zmdi-settings"></i>
                                                    <span>Settings</span>
                                                </a>
                                            </li>
                                            <li class="skk-ani">
                                                <a href="#">
                                                    <i class="icon zmdi zmdi-youtube" style="color:#ea4335;"></i>
                                                    <span>YouTube</span>
                                                </a>
                                            </li>
                                            <li class="skk-ani">
                                                <a href="#">
                                                    <i class="icon zmdi zmdi-codepen" style="color:#333;"></i>
                                                    <span>CodePen</span>
                                                </a>
                                            </li>
                                            <li class="skk-ani">
                                                <a href="#">
                                                    <i class="icon zmdi zmdi-dropbox" style="color:#007EE5;"></i>
                                                    <span>CodePen</span>
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="skk-ans"></div>
                                        <ul class="skk-ang">
                                            <li class="skk-ani">
                                                <a href="#">
                                                    <i class="icon zmdi zmdi-stackoverflow" style="color:#ef8236;"></i>
                                                    <span>StackOverflow</span>
                                                </a>
                                            </li>
                                            <li class="skk-ani">
                                                <a href="#">
                                                    <i class="icon zmdi zmdi-windows" style="color:#50bff5;"></i>
                                                    <span>Windows</span>
                                                </a>
                                            </li>
                                            <li class="skk-ani">
                                                <a href="#">
                                                    <i class="icon zmdi zmdi-twitch" style="color:#6441a5;"></i>
                                                    <span>Twitch</span>
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="skk-anb">
                                            <a href="#" class="btn btn-outline-info">More from KonKon</a>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle d-none d-sm-block" href="#" id="user_n_messages_bell"
                                    data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button"
                                    aria-expanded="false">
                                    <span class="icon zmdi zmdi-notifications-none"></span>
                                </a>
                                <div class="dropdown-menu be-notifications">
                                    <div class="skk-nc">
                                        <div class="skk-nh">
                                            <div class="skk-nhi skk-nhi-close">
                                                <a href="#">
                                                    <i class="zmdi zmdi-close"></i>
                                                </a>
                                            </div>
                                            <h2 class="skk-nht">Notifications</h2>
                                            <div class="skk-nhi">
                                                <a href="#">
                                                    <i class="zmdi zmdi-settings"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="skk-nb skk-nbe">

                                            <div class="skk-nbe-icon">
                                                <i class="zmdi zmdi-notifications"></i>
                                            </div>
                                            <div class="skk-nbe-msg">
                                                <div class="skk-nbe-title">Your notifications live here</div>
                                                <div class="skk-nbe-text">Follow accounts to get notified about their
                                                    latest content.</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle d-none d-sm-block" href="#" id="user_n_messages_bell"
                                    data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button"
                                    aria-expanded="false">
                                    <span class="icon zmdi zmdi-notifications"></span>
                                    <span class="indicator"></span>
                                </a>
                                <div class="dropdown-menu be-notifications">
                                    <div class="skk-nc">
                                        <div class="skk-nh">
                                            <div class="skk-nhi skk-nhi-close">
                                                <a href="#">
                                                    <i class="zmdi zmdi-close"></i>
                                                </a>
                                            </div>
                                            <h2 class="skk-nht">Notifications</h2>
                                            <div class="skk-nhi">
                                                <a href="#"><i class="zmdi zmdi-settings"></i></a>
                                            </div>
                                        </div>
                                        <ul class="skk-nb skk-nl">

                                            <li class="skk-nli skk-nli-unread">
                                                <a href="#">
                                                    <div class="skk-nli-new"></div>
                                                    <div class="skk-nli-img">
                                                        <img src="https://via.placeholder.com/256/fe669e/fff.png"
                                                            alt="Avatar" />
                                                    </div>
                                                    <div class="skk-nli-text">
                                                        <div class="skk-nli-msg"><b>Studio KonKon</b> commented: "Sed do
                                                            eiusmod tempor incididunt ut labore et dolore magna aliqua."
                                                        </div>
                                                        <div class="skk-nli-metadata">3 days ago</div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="skk-nli skk-nli-unread">
                                                <a href="#">
                                                    <div class="skk-nli-new"></div>
                                                    <div class="skk-nli-img">
                                                        <img src="https://via.placeholder.com/256/4285f4/fff.png"
                                                            alt="Avatar" />
                                                    </div>
                                                    <div class="skk-nli-text">
                                                        <div class="skk-nli-msg"><b>Omnis Iste</b> commented: "Magni
                                                            dolores eos qui."</div>
                                                        <div class="skk-nli-metadata">5 days ago</div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="skk-nli">
                                                <a href="#">
                                                    <div class="skk-nli-new"></div>
                                                    <div class="skk-nli-img">
                                                        <img src="https://via.placeholder.com/256/ff9f00/fff.png"
                                                            alt="Avatar" />
                                                    </div>
                                                    <div class="skk-nli-text">
                                                        <div class="skk-nli-msg"><b>Mario Santoria</b> commented:
                                                            "Nostrum exercitationem ullam corporis suscipit laboriosam,
                                                            nisi ut aliquid ex ea commodi consequatur?"</div>
                                                        <div class="skk-nli-metadata">8 days ago</div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="skk-nli">
                                                <a href="#">
                                                    <div class="skk-nli-new"></div>
                                                    <div class="skk-nli-img">
                                                        <img src="https://via.placeholder.com/256/34a853/fff.png"
                                                            alt="Avatar" />
                                                    </div>
                                                    <div class="skk-nli-text">
                                                        <div class="skk-nli-msg"><b>Serena Chaku</b> commented: "Quis
                                                            autem vel eum iure reprehenderit qui in ea voluptate velit
                                                            esse quam nihil molestiae consequatur."</div>
                                                        <div class="skk-nli-metadata">14 days ago</div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="skk-nli">
                                                <a href="#">
                                                    <div class="skk-nli-new"></div>
                                                    <div class="skk-nli-img">
                                                        <img src="https://via.placeholder.com/256/6ba4ff/fff.png"
                                                            alt="Avatar" />
                                                    </div>
                                                    <div class="skk-nli-text">
                                                        <div class="skk-nli-msg"><b>Shinobu KonKon</b> commented: "Qui
                                                            in ea voluptate velit esse ka?"</div>
                                                        <div class="skk-nli-metadata">20 days ago</div>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav menu-end be-user-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                    data-bs-auto-close="outside" role="button" aria-expanded="false">
                                    <img id="user_image" src="https://via.placeholder.com/256/fe669e/fff.png"
                                        alt="Avatar" />
                                    <span class="user-name">Studio KonKon</span>
                                </a>
                                <div class="dropdown-menu" role="menu">
                                    <div class="skk-nvh">
                                        <div class="skk-nvh-img">
                                            <img src="https://via.placeholder.com/256/fe669e/fff.png" alt="Avatar" />
                                        </div>
                                        <div class="skk-nvh-info">
                                            <div class="skk-nvh-name">Studio KonKon</div>
                                            <div class="skk-nvh-email">username@example.com</div>
                                            <a class="btn btn-rounded btn-secondary" href="#">Manage Your Account</a>
                                        </div>
                                    </div>
                                    <div class="skk-nva">
                                        <a href="#">
                                            <div class="skk-nva-icon">
                                                <img src="https://via.placeholder.com/256/4285f4/fff.png"
                                                    alt="Avatar" />
                                            </div>
                                            <div class="skk-nva-account">
                                                <div class="skk-nva-name">Studio KonKon</div>
                                                <div class="skk-nva-email">username@example.com</div>
                                            </div>
                                            <div class="skk-nva-check">
                                                <i class="zmdi zmdi-check"></i>
                                            </div>
                                        </a>
                                        <a href="#">
                                            <div class="skk-nva-icon">
                                                <img src="https://via.placeholder.com/256/6ba4ff/fff.png"
                                                    alt="Avatar" />
                                            </div>
                                            <div class="skk-nva-account">
                                                <div class="skk-nva-name">Shinobu KonKon</div>
                                                <div class="skk-nva-email">username@example.com</div>
                                            </div>
                                        </a>
                                        <a href="#">
                                            <div class="skk-nva-icon">
                                                <img src="https://via.placeholder.com/256/34a853/fff.png"
                                                    alt="Avatar" />
                                            </div>
                                            <div class="skk-nva-account">
                                                <div class="skk-nva-name">Mario Santoria</div>
                                                <div class="skk-nva-email">username@example.com</div>
                                            </div>
                                        </a>
                                        <a href="#">
                                            <div class="skk-nva-icon">
                                                <img src="https://via.placeholder.com/256/ff9f00/fff.png"
                                                    alt="Avatar" />
                                            </div>
                                            <div class="skk-nva-account">
                                                <div class="skk-nva-name">Serena Chaku</div>
                                                <div class="skk-nva-email">username@example.com</div>
                                            </div>
                                        </a>
                                    </div>
                                    <ul class="skk-nvl">
                                        <li class="skk-nvl-item">
                                            <a href="#">
                                                <div class="skk-nvli-icon"><i class="zmdi zmdi-accounts-add"></i></div>
                                                <div class="skk-nvli-label">Add another account</div>
                                            </a>
                                        </li>
                                        <li class="skk-nvl-item">
                                            <a href="#">
                                                <div class="skk-nvli-icon"><i class="zmdi zmdi-translate"></i></div>
                                                <div class="skk-nvli-label">Language: English</div>
                                                <div class="skk-nvli-subtitle"></div>
                                                <div class="skk-nvli-icon"><i class="zmdi zmdi-chevron-right"></i></div>
                                            </a>
                                        </li>
                                        <li class="skk-nvl-item">
                                            <a href="#">
                                                <div class="skk-nvli-icon"><i class="zmdi zmdi-globe-alt"></i></div>
                                                <div class="skk-nvli-label">Location: United Kingdom</div>
                                                <div class="skk-nvli-subtitle"></div>
                                                <div class="skk-nvli-icon"><i class="zmdi zmdi-chevron-right"></i></div>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="skk-nv-btn">
                                        <a class="btn btn-secondary" href="#">Sign out of all accounts</a>
                                    </div>
                                    <div class="skk-nvf">
                                        <a href="#">Privacy Policy</a>
                                        <span class="seperator">•</span>
                                        <a href="#">Terms of Service</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>

                </div>
            </nav> -->


            <!-- <div class="be-left-sidebar" id="left-sidebar">
                <div class="left-sidebar-wrapper">
                    <a class="left-sidebar-toggle" href="#">Studio KonKon</a>
                    <div class="left-sidebar-spacer">
                        <div class="left-sidebar-scroll">
                            <div class="left-sidebar-content">

                                <ul class="sidebar-elements">
                                    <li class="divider">Studio KonKon: Theme 2020</li>
                                    <li>
                                        <a href="#"><i class="icon zmdi zmdi-home"></i><span
                                                class="text">Home</span></a>
                                    </li>
                                    <li class="divider">Theme Documents</li>
                                    <li>
                                        <a href="#home"><i class="icon zmdi zmdi-view-dashboard"></i><span
                                                class="text">Dashboard</span></a>
                                    </li>
                                    <li class="parent">
                                        <a href="#">
                                            <i class="icon zmdi zmdi-layers"></i>
                                            <span class="text">Content</span>
                                        </a>
                                        <ul class="sub-menu">
                                            <li><a href="#"><span class="text">Code</span></a></li>
                                            <li><a href="#"><span class="text">Images</span></a></li>
                                            <li><a href="#"><span class="text">Typography</span></a></li>
                                            <li><a href="#"><span class="text">Grid</span></a></li>
                                        </ul>
                                    </li>
                                    <li class="parent">
                                        <a href="#">
                                            <i class="icon zmdi zmdi-folder"></i>
                                            <span class="text">Menu Levels</span>
                                        </a>
                                        <ul class="sub-menu">
                                            <li class="parent level-a1">
                                                <a href="#"><span class="text">Level 1</span></a>
                                                <ul class="sub-menu">
                                                    <li><a href="#"><span class="text">Level 2</span></a></li>
                                                    <li class="parent level-a2">
                                                        <a href="#"><span class="text">Level 2</span></a>
                                                        <ul class="sub-menu">
                                                            <li class="active"><a href="#"><span class="text">Level
                                                                        3</span></a></li>
                                                            <li class="parent level-a3">
                                                                <a href="#"><span class="text">Level 3</span></a>
                                                                <ul class="sub-menu">
                                                                    <li><a href="#"><span class="text">Level
                                                                                4</span></a></li>
                                                                    <li><a href="#"><span class="text">Level
                                                                                4</span></a></li>
                                                                </ul>
                                                            </li>
                                                            <li class="parent level-a4">
                                                                <a href="#"><span class="text">Level 3</span></a>
                                                                <ul class="sub-menu">
                                                                    <li><a href="#"><span class="text">Level
                                                                                4</span></a></li>
                                                                    <li><a href="#"><span class="text">Level
                                                                                4</span></a></li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="parent level-b1">
                                                <a href="#"><span class="text">Level 1</span></a>
                                                <ul class="sub-menu">
                                                    <li><a href="#"><span class="text">Level 2</span></a></li>
                                                    <li class="parent level-b2">
                                                        <a href="#"><span class="text">Level 2</span></a>
                                                        <ul class="sub-menu">
                                                            <li><a href="#"><span class="text">Level 3</span></a></li>
                                                            <li class="parent level-b3">
                                                                <a href="#"><span class="text">Level 3</span></a>
                                                                <ul class="sub-menu">
                                                                    <li><a href="#"><span class="text">Level
                                                                                4</span></a></li>
                                                                    <li><a href="#"><span class="text">Level
                                                                                4</span></a></li>
                                                                </ul>
                                                            </li>
                                                            <li class="parent level-b4">
                                                                <a href="#"><span class="text">Level 3</span></a>
                                                                <ul class="sub-menu">
                                                                    <li><a href="#"><span class="text">Level
                                                                                4</span></a></li>
                                                                    <li><a href="#"><span class="text">Level
                                                                                4</span></a></li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="divider">Help &amp; Support</li>
                                    <li>
                                        <a href="#"><i class="icon zmdi zmdi-settings"></i><span
                                                class="text">Settings</span></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="icon zmdi zmdi-info"></i><span
                                                class="text">About</span></a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="#"><span class="text">Exit App</span></a>
                                    </li>
                                </ul>

                            </div>
                        </div>
                    </div>
                    <div class="progress-widget" id="user_progress">
                        <div class="progress-data"><span class="progress-value">1645 / 2000</span><span
                                class="name">Level 3</span></div>
                        <div class="progress">
                            <div class="progress-bar" style="width:80%;"></div>
                        </div>
                    </div>
                </div>
            </div> -->

            <div class="be-content">
                <div class="main-content container">
                    <div class="m-auto py-4 email-template">
                        <div class="card card-border-color card-border-color-konkon">
                            <div class="card-header">
                                <img class="logo-img"
                                    src="https://res.cloudinary.com/studiokonkon/image/upload/v1543962008/website/konkon-header-300x76-ova.png"
                                    alt="logo" width="auto" height="50">
                            </div>
                            <div class="card-body">
                                <span class="badge badge-konkon">SERVICE MESSAGE</span>
                                <h3 class="pt-4 mb-6">An Important Notice</h3>
                                <p><b>Last updated: </b> 13th November 2021</p>
                                <p>This pen is a personal project I used for testing while away from home on a
                                    smartphone.</p>
                                <p>It's a theme I am building for myself, for my own applications and website. A live
                                    demo can be seen here at <span style="color:#fe669e;">play.studiokonkon.com</span>
                                </p>
                                <p>I am currently now upgrading to Bootstrap 5 and removing jQuery. You can see the
                                    project at: <span
                                        style="color:#fe669e;">https://github.com/StudioKonKon/bootstrap-konkon</span>
                                </p>
                                <p>As already mentioned, this is a personal project and I cannot guarantee regular
                                    updates. Unfortunetly, I don't get paid for this and have other paid work that takes
                                    away the time I need. During the pandemic of 2020, I had lots of free time but now,
                                    I no longer have that opportunity to work on this everyday.</p>
                                <p>As a personal project, I intend to use this as a theme for my own website(s) but it
                                    is available for others to use if they wish either for their own content or for
                                    educational purposes.</p>
                                <hr />
                                <p><b>Last updated:</b> 2020</p>
                                <p>As I spend a lot of time working and away from home, I've began to use CodePen as a
                                    base for coding on my smartphone during work breaks.</p>
                                <p>Unfortunately, as a self-employed music teacher, I don't earn much and cannot afford
                                    paying for PRO subscriptions. Any code you find here you use freely knowning there
                                    will be a lot of bugs or missing features.</p>
                                <p>I can't say when it will be complete, however, this pen will be constantly revised
                                    and updated until I am satisfied with what I have.</p>
                                <p>The final product will eventually be posted on GitHub as OpenSource.</p>
                                <p>Why am I doing this...? There are a few projects I've got on such as a Japanese
                                    Learning course I'd like to implement this template in, I think it would be good.
                                    Also, I plan to use it on my own website, integrating it as a WordPress Theme for
                                    personal use.</p>
                                <br />
                                <p><b>Studio KonKon</b><br /><i>Web Developer & Music Teacher</i><br /><a
                                        href="https://studiokonkon.com/" target="_blank"
                                        style="color:#fe669e;font-size:1rem;">https://studiokonkon.com/</a></p>
                            </div>
                        </div>
                        <p class="mt-5 text-center small text-muted">
                            <span>Powered by <a href="https://codepen.io/" target="_blank">codepen.io</a></span>
                            <br />
                            <span>Images hosted by <a
                                    href="https://cloudinary.com/invites/lpov9zyyucivvxsnalc5/jt1c11zcpsjpusygprd7"
                                    target="_blank">Cloudinary</a></span>
                        </p>
                    </div>

                </div>
            </div>

        </div>
    </body>
</body>

</html>