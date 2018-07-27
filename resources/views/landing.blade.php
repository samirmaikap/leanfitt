<!DOCTYPE html>
<html lang="en">
    
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>LeanFITT™</title>
        <link rel="icon" type="image/png" href="landing/images/leanfitt/FITT/logo.png" />
        <!-- Core css -->
        <link rel="stylesheet" id="bulma" href="landing/css/main.css" />
        <link rel="stylesheet" id="bulma" href="landing/css/bulma.css" />
        <link rel="stylesheet" type="text/css" href="landing/css/core_green.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
        <!-- Plugins css -->
        <link rel="stylesheet" type="text/css" href="landing/js/slick-carousel/slick.css">
        <link rel="stylesheet" type="text/css" href="landing/js/slick-carousel/slick-theme.css">
        <link rel="stylesheet" type="text/css" href="landing/js/ggpopover/ggtooltip.css">
        <link rel="stylesheet" type="text/css" href="landing/js/chosen/chosen.css">
        <link rel="stylesheet" type="text/css" href="landing/js/ggpopover/ggpopover.css">
        <link rel="stylesheet" type="text/css" href="landing/js/highlightjs/style.css">
        <!-- Icons -->
        <link rel="stylesheet" type="text/css" href="landing/css/icons.min.css">
    </head>
    <style type="text/css">
    .margin-bottom-8 {
        margin-bottom: 8% !important;
    }

    .modal-content {
        margin-top: 3%;
    }

    .modal.is-active.modal-success .modal-background {
        background: transparent !important;
    }

    .nav-item , .font-18{
        font-size: 18px !important;
    }

    .text-align-fix {
        margin-left: 7%;
        margin-top: -6%;
    }

    .float-left {
        float: left;
    }

    .float-right-fix {
        float: right;
        margin-right: 30%;
    }

    .foorter-fix {
        margin-left: -9%;
        margin-right: -9%;
    }

    .about-details-scroll-fix {
        max-height: 192px;
        overflow: overlay;
    }
    .landing-bg-color {
        background-color: #00B289;
    }

    .theme-font-color {
        color: #00B289 !important;   
    }
        .button.btn-outlined:hover {
            background: #ee4023 !important;
            border-color: #F5F5F5;
            color: white !important;
        }

        .nav-item {
            max-height: 4.05rem !important;
        }

        .site-header-logo , .site-footer-logo {
            max-height: 6.05rem !important;
        }

        .section .title-divider {
            background: #ee4023 !important;
        }

        .max-width-fifty {
            max-width: 50%;
            text-align: center;
        }

        .button.btn-outlined.light-btn {
            background-color: transparent;
            color: #00b289;
            border-color: #00b289; 
        }

        .know-more-button {
            border-color: #fff;
            color: #fff;
        }

        .margin-both-15 {
            margin-left: 15%;
            margin-right: 15%;
        }

        .text-centered {
            text-align: -webkit-center;
        }

        .background-grey {
            background-color: #fbfbfb;
        }

        .get-started-btn {
            color: #ffffff !important;
            border-color: #ffffff !important;
        }

    </style>

    <body>
        <!-- Pageloader -->
        <div class="pageloader"></div>
        <div class="infraloader is-active"></div>

        <!-- Hero and nav -->
        <div id="landing-hero" class="hero is-theme-primary hero-waves">
            <div class="navbar-wrapper navbar-light translateDown navbar-sticky"> <!-- navbar-wrapper navbar-fade navbar-light -->
                <div class="hero-head">

                    <!-- Nav -->
                    <div class="container">
                        <nav class="nav">
                            <div class="container big">
                                <div class="nav-left" style="min-width: 80%; font-size: 16px;">
                                    <a class="nav-item" href="landing-v1.html">
                                        <img class="site-header-logo" src="landing/images/logo.png" alt="">
                                    </a>
                                    
                                  

                                    <a href="#" class="nav-item color-black is-tab nav-inner is-not-mobile">
                                        Home
                                    </a>
                                    
                                    <a href="#tools" class="nav-item color-black is-tab nav-inner is-not-mobile">
                                        Tools
                                    </a>
                                    <a href="#hiw" class="nav-item color-black is-tab nav-inner is-not-mobile">
                                        How It Works
                                    </a>
                                    <a href="#consulting" class="nav-item color-black is-tab nav-inner is-not-mobile">
                                        Consulting
                                    </a>
                                    <a href="#faqs" class="nav-item color-black is-tab nav-inner is-not-mobile">
                                        FAQs
                                    </a>
                                    <a href="#about" class="nav-item color-black is-tab nav-inner is-not-mobile">
                                        About Us
                                    </a>
                                    <a href="#price" class="nav-item color-black is-tab nav-inner is-not-mobile">
                                        Pricing
                                    </a>
                                </div>
                                <!-- Responsive toggle -->
                                <span class="nav-toggle">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </span>
                                <div class="nav-right nav-menu">

                                    <a href="landing-v1-features.html" class="nav-item is-tab nav-inner is-menu-mobile">
                                        Features
                                    </a>
                                    <a href="landing-v1-pricing.html" class="nav-item is-tab nav-inner is-menu-mobile">
                                        Pricing
                                    </a>
                                    <a href="landing-v1-login.html" class="nav-item is-tab nav-inner is-menu-mobile">
                                        Login
                                    </a>
                                    <span class="nav-item">

                                        @if(auth()->check())
                                            @if(session('organization'))
                                                <a id="signup-btn" href="{{ url( 'http://' . session('organization')->subdomain . config('session.domain') .  '/dashboard') }}" class="button button-signup btn-outlined is-bold btn-align light-btn font-18 primary-btn secondary-btn">
                                                    Home
                                                </a>
                                            @else
                                                <a id="signup-btn" href="{{ url( config('app.url') .  '/organizations/create') }}" class="button button-signup btn-outlined is-bold btn-align light-btn font-18 primary-btn secondary-btn">
                                                    Create Organization
                                                </a>
                                            @endif

                                        @else
                                        <a id="signup-btn" href="{{ url('/login') }}" class="button button-signup btn-outlined is-bold btn-align light-btn font-18 primary-btn secondary-btn">
                                            Sign Up / Login
                                        </a>
                                        @endif
                                    </span>
                                    
                                </div>
                            </div>
                        </nav>
                    </div>
                    <!-- /Nav -->

                </div>
            </div>

            <!-- Hero image -->
            <div id="main-hero" class="hero-body is-clean">
                <div class="container has-text-centered">
                    <div class="columns is-vcentered">
                        <div class="column is-5 caption-column has-text-left">
                            <h1 class="clean-title light-text">
                                Say HELLO!
                            </h1>
                            <div class="subtitle is-5 no-margin-bottom">
                                <b>to a whole new way to CONTINUOUS IMPROVEMENT LEARNING, DOING, AND SUSTAINING!</b>
                            </div>
                            <!-- <div class="cta-wrapper has-text-left">
                                <a href="#product" class="button button-cta btn-align btn-outlined is-bold light-btn">
                                    Get Started
                                </a>
                            </div> -->
                                <div class="cta-wrapper has-text-left">
                                    <a class="button button-cta btn-align btn-outlined is-bold know-more-button raised modal-trigger" data-modal="success-overlay">Know More</a>
                                </div>
                                <div id="success-overlay" class="modal modal-sm modal-success">
                                    <div class="modal-background"></div>
                                    <div class="modal-content">
                                        <div class="flex-card simple-shadow">
                                            <div class="card-body">
                                                <div class="content has-text-centered">
                                                    <h2 class=" pb-20"><i>Lean</i><b>FITT™</b></h2>
                                                    <p class="pb-20"><i>Lean</i><b>FITT™</b> is the world’s leading Lean Program Management System and breakthrough on-line program for training in, coordinating, sharing, and tracking your organization’s continuous improvement initiatives. Our 21 Continuous Improvement tools allow you to get your organization processes in the best shape ever. Visionary leaders and continuous improvement specialists trust <i>Lean</i><b>FITT™</b> to help them standardize training, assure knowledge attainment, utilize Lean tools with critical thinking skills, accelerate change, and ensure sustainability which leads to notable fiscal and cultural gains.</p>
                                                </div>
                                            </div>  
                                        </div>
                                    </div>
                                    <button class="modal-close is-large is-hidden" aria-label="close"></button>
                                </div>
                            </div>
                        <div class="column is-9 is-offset-1">
                            <figure class="image is-3by2">
                                <img class="clean-hero-mockup" src="landing/images/homescreen/macbook-app.png" alt="">
                            </figure>
                        </div>

                    </div>
                </div>
            </div>
            <!-- /Hero image -->
        </div>
        <!-- /Hero and nav -->


        <!-- Feature -->
        <section id="start-features" class="section section-feature-grey is-medium is-skewed-sm">
            <div class="container section-feature-grey is-reverse-skewed-sm" >
                <div class="section-title-wrapper has-text-centered">
                    <div class="clean-bg-symbol"><i class="fa fa-gg"></i></div>
                    <div>
                        <h2 class="clean-section-title">ABOUT <i>Lean</i><b>FITT™</b></h2>
                        <h3 class="subtitle is-5 pt-10 pb-10">
                            <i>Lean</i><b> FITT™</b> harnesses the power of continuous improvement, employee engagement, and standardized knowledge and tool usage to inspire process changes that make a big impact. <i>Lean</i><b>FITT™</b> surrounds you with the right Functional, Integrated, Technology, and Training during your journey of getting your process FITT– FOREVER!
                        </h3>
                    </div>
                </div>
                
            </div>
        </section>
        <!-- /Feature -->


        <!-- Feature -->
        <section id="start-features" class="section is-medium is-skewed-sm">
            <div class="container is-reverse-skewed-sm">
                <div class="section-title-wrapper has-text-centered">
                    <div class="clean-bg-symbol"><i class="fa fa-gg"></i></div>
                    <div>
                        <h2 class="clean-section-title"><i>Lean</i>FITT™ – Lean with Functional, Integrated, Technology, and Training (FITT)</h2>
                        <h3 class="subtitle is-5 pt-10 pb-10">
                            Lean is simply the most successful and sustainable process and business improvement methodology in the history of the world.<br/><i>Lean</i><b> FITT™</b> combines the power of Lean and Six Sigma into a simple, easy to use web-based tools that are,
                        </h3>
                    </div>
                </div>
                <div class="content-wrapper">
                    <div class="columns is-vcentered">
                        <div class="column is-4 is-offset-1">
                            <!-- Title -->
                            <div class="title quick-feature">
                                <h2 class="title is-3 clean-text">Functional</h2>
                                <div class="bg-number is-fat">1</div>
                            </div>
                            <!-- /Title -->
                            <div class="title-divider"></div>
                            <span class="section-feature-description">The functionality of <i>Lean</i><b>FITT™</b> comes from the powerful web and device based user friendly customizable tools that track and guide users through improvements.</span>
                            <div class="pt-10 pb-10">
                                <!-- <a href="#" class="button btn-align btn-more is-link color-primary">
                                    Learn more about our plans <i class="sl sl-icon-arrow-right"></i>
                                </a> -->
                            </div>
                        </div>

                        <div class="column is-6 is-offset-1">
                            <!-- Featured illustration -->
                            <img src="landing/images/FITT/green-team.svg" alt="">
                            <!-- /Featured illustration -->
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!-- /Feature -->

        <!-- Feature -->
        <section class="section section-feature-grey is-medium is-skewed-sm">
            <div class="container is-reverse-skewed-sm">

                <div class="columns is-vcentered">

                    <div class="column is-6">
                        <!-- Featured illustration -->
                        <img src="landing/images/FITT/integrated.png" alt="">
                        <!-- /Featured illustration -->
                    </div>

                    <div class="column is-4 is-offset-1">
                        <!-- Title -->
                        <div class="title quick-feature">
                            <h2 class="clean-text">Integrated</h2>
                            <div class="bg-number is-fat">2</div>
                        </div>
                        <!-- /Title -->
                        <div class="title-divider"></div>
                        <span class="section-feature-description"><i>Lean</i><b>FITT™</b> is a web-based complete Lean program management system. LeanFITT allows the complete oversight, management, and tracking of an organization’s Lean initiatives and transformation.</span>
                        <div class="pt-10 pb-10">
                            <!-- <a href="#" class="button btn-align btn-more is-link color-primary">
                                Learn more about our plans <i class="sl sl-icon-arrow-right"></i>
                            </a> -->
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- /Feature -->

        <!-- Feature -->
        <section class="section is-medium is-skewed-sm">
            <div class="container is-reverse-skewed-sm">

                <div class="columns is-vcentered">

                    <div class="column is-4 is-offset-1">
                        <!-- Title -->
                        <div class="title quick-feature">
                            <h2 class="clean-text">Training</h2>
                            <div class="bg-number is-fat">3</div>
                        </div>
                        <!-- /Title -->
                        <div class="title-divider"></div>
                        <span class="section-feature-description"><i>Lean</i><b>FITT™</b> includes training content, case studies, base and customizable interactive Lean forms and reports to support training initiatives.</span>
                        <div class="pb-10 pt-10">
                            <!-- <a href="#" class="button btn-align btn-more is-link color-primary">
                                Learn more about our plans <i class="sl sl-icon-arrow-right"></i>
                            </a> -->
                        </div>
                    </div>            

                    <div class="column is-6 is-offset-1">
                        <!-- Featured illustration -->
                        <img src="landing/images/FITT/training.png" alt="">
                        <!-- /Featured illustration -->
                    </div>

                </div>
            </div>
        </section>
        <!-- /Feature -->

        <!-- /Feature -->
        <section class="section section-feature-grey is-medium is-skewed-sm" style="padding-bottom: 15%;">
            <div class="container is-reverse-skewed-sm">

                <div class="columns is-vcentered">

                    <div class="column is-6">
                        <!-- Featured illustration -->
                        <img src="landing/images/FITT/ui.svg" alt="">
                        <!-- /Featured illustration -->
                    </div>

                    <div class="column is-4 is-offset-1">
                        <!-- Title -->
                        <div class="title quick-feature">
                            <h2 class="clean-text">Technology</h2>
                            <div class="bg-number is-fat">4</div>
                        </div>
                        <!-- /Title -->
                        <div class="title-divider"></div>
                        <span class="section-feature-description"><i>Lean</i><b>FITT™</b> is mobile, and can be accessed and used anywhere by smart phone, tablet or laptop/desktop. It makes completing improvement projects fun on your smart devices.</span>
                        <div class="pt-10 pb-10">
                            <!-- <a href="#" class="button btn-align btn-more is-link color-primary">
                                Learn more about our plans <i class="sl sl-icon-arrow-right"></i>
                            </a> -->
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- /Feature -->
    

       

        <!-- Card Section -->
        <section id="tools" class="section section-light-grey is-medium" style="transform: skew(0deg, 0deg) translate(0, -82px); padding-bottom: 15%;">
            <div class="container">
                <div class="section-title-wrapper">
                    <div class="bg-number">4</div>
                    <h2 class="title section-title has-text-centered dark-text"> <i>Lean</i><b>FITT™</b> tools </h2>
                    <div class="subtitle has-text-centered is-tablet-padded">
                        <br/>
                        <b>All <i>Lean</i><b>FITT™</b> tools have: </b>
                        <ul >
                            <li>•   Detailed content explaining its purpose and practical application</li>
                            <li>•   Sensei Tips from industry Lean Sigma experts </li>
                            <li>•   Leadership Tips for leaders at all levels to better engage employees</li>
                            <li>•   Action Items that are tracked with notifications and allow for Notes and Pictures/Photos </li>
                        </ul>

                    </div>
                </div>

                <div class="content-wrapper">
                    <div class="columns integration-cards is-minimal is-vcentered is-gapless is-multiline">
                        <!-- Card -->
                        <div class="column">
                            <div class="feature-card card-md hover-inset has-text-centered mb-20">
                                <div class="brand-logo">
                                    <img src="landing/images/leantools/5S.png" alt="">
                                </div>
                                <div class="card-title">
                                    <h4>5S</h4>
                                </div>
                                <div class="card-feature-description">
                                    <span>The means and methods to ensure areas, files, folders, etc. are systematically kept clean and organized.</span>
                                </div>
                                <div class="button btn-align primary-btn btn-outlined is-bold rounded raised" data-html="true" data-toggle="popover"
                                         data-placement="bottom"
                                         title="5S will provide:"
                                         data-trigger="hover"
                                         data-arrowcolor="#F1664E"
                                         data-title-backcolor="#F1664E"
                                         data-title-textcolor="#fff"
                                         data-content="&#9672; <div class='text-align-fix'>An overview of the importance and benefits of 5S to assist in workplace standardization and organization.</div>
                                        &#9672; <div class='text-align-fix'>Access to the 5S tool with default statements for the categories of Sort, Set-In-Order, Shine, Standardize, Sustain (and Safety).</div>
                                        &#9672; <div class='text-align-fix'>An ability to customize the 5S categories and statements.</div>
                                        &#9672; <div class='text-align-fix'>A Radar Chart displaying the 5S with the Likert scale for the statements.</div>
                                        &#9672; <div class='text-align-fix'>An ability to create the 5S report and for it to be shared.</div>">

                                    Know More
                                </div>
                            </div>
                        </div>
                        <!-- Card -->
                        <div class="column">
                            <div class="feature-card card-md hover-inset has-text-centered mb-20">
                                <div class="brand-logo">
                                    <img src="landing/images/leantools/a3projectreport.png" alt="">
                                </div>
                                <div class="card-title">
                                    <h4>A3 Project</h4>
                                </div>
                                <div class="card-feature-description">
                                    <span>The means and methods to “tell the continuous improvement story” in a logical and visual way.</span>
                                </div>
                                
                                <div class="button btn-align primary-btn btn-outlined is-bold rounded raised" data-html="true" data-toggle="popover"
                                         data-placement="bottom"
                                         title="A3 Project will provide:"
                                         data-trigger="hover"
                                         data-arrowcolor="#F1664E"
                                         data-title-backcolor="#F1664E"
                                         data-title-textcolor="#fff"
                                         data-content="&#9672; <div class='text-align-fix'>An overview of the various types of A3s and how beneficial they can be to concisely present information in a visually appealing manner</div>
                                        &#9672; <div class='text-align-fix'> Access to the A3 Project Report tool with Lean Thinking statements to ensure each section or phase is completed.</div>
                                        &#9672; <div class='text-align-fix'>An ability to create the A3 Project report (landscape) and for it to be shared</div>">
                                    Know More
                                </div>
                            </div>
                        </div>
                        <!-- Card -->
                        <div class="column">
                            <div class="feature-card card-md hover-inset has-text-centered mb-20">
                                <div class="brand-logo">
                                    <img src="landing/images/leantools/DMAIC.png" alt="">
                                </div>
                                <div class="card-title">
                                    <h4>DMAIC</h4>
                                </div>
                                <div class="card-feature-description">
                                    <span>The means and methods to use a statistical-based 5 step problem solving methodology.</span>
                                </div>
                                <!-- Modal Contents with button-->
                                <div class="button btn-align primary-btn btn-outlined is-bold rounded raised" data-html="true" data-toggle="popover"
                                         data-placement="bottom"
                                         title="DMAIC will provide:"
                                         data-trigger="hover"
                                         data-arrowcolor="#F1664E"
                                         data-title-backcolor="#F1664E"
                                         data-title-textcolor="#fff"
                                         data-content="&#9672; <div class='text-align-fix'>An overview of the powerful methodology of DMAIC.</div>
                                        &#9672; <div class='text-align-fix'>Access to the DMAIC tool with Lean Thinking statements to ensure each section or phase is completed.</div>
                                        &#9672; <div class='text-align-fix'>An ability to create the DMAIC report and for it to be shared.</div>">

                                    Know More
                                </div>
                                <!-- Modal Contents with button ends-->                                
                            </div>
                        </div>
                        <!-- Card -->
                        <div class="column">
                            <div class="feature-card card-md hover-inset has-text-centered mb-20">
                                <div class="brand-logo">
                                    <img src="landing/images/leantools/gembawalk.png" alt="">
                                </div>
                                <div class="card-title">
                                    <h4>Gemba Walk</h4>
                                </div>
                                <div class="card-feature-description">
                                    <span>The means and methods to gain a thorough understanding of the process, ask questions, and provide support and insights.</span>
                                </div>
                                <!-- Modal Contents with button-->
                                <div class="button btn-align primary-btn btn-outlined is-bold rounded raised" data-html="true" data-toggle="popover"
                                         data-placement="bottom"
                                         title="Gemba Walk will provide:"
                                         data-trigger="hover"
                                         data-arrowcolor="#F1664E"
                                         data-title-backcolor="#F1664E"
                                         data-title-textcolor="#fff"
                                         data-content="&#9672; <div class='text-align-fix'>An overview of the importance of the Gemba Walk for leaders and how it can energize an organization.</div>
                                        &#9672; <div class='text-align-fix'>Steps to conducting a Gemba Walk.</div>
                                        &#9672; <div class='text-align-fix'>Access to the Gemba Walk tool.</div>
                                        &#9672; <div class='text-align-fix'>An ability to create the Gemba Walk report and for it to be shared.</div>">

                                    Know More
                                </div>
                                <!-- Modal Contents with button ends-->                                
                            </div>
                        </div>
                        <!-- Card -->
                        <div class="column">
                            <div class="feature-card card-md hover-inset has-text-centered mb-20">
                                <div class="brand-logo">
                                    <img src="landing/images/leantools/Kaizen.png" alt="">
                                </div>
                                <div class="card-title">
                                    <h4>Kaizen Project</h4>
                                </div>
                                <div class="card-feature-description">
                                    <span>The means and methods to determine, plan, and track a Kaizen Event.</span>
                                </div>
                                <!-- Modal Contents with button-->
                                <div class="button btn-align primary-btn btn-outlined is-bold rounded raised" data-html="true" data-toggle="popover"
                                         data-placement="bottom"
                                         title="Kaizen Project will provide:"
                                         data-trigger="hover"
                                         data-arrowcolor="#F1664E"
                                         data-title-backcolor="#F1664E"
                                         data-title-textcolor="#fff"
                                         data-content="&#9672; <div class='text-align-fix'>An overview of the importance Kaizen and Kaizen Events.</div>
                                        &#9672; <div class='text-align-fix'>An overview of the various types of Kaizen Events and how they can be adapted to your improvement project.</div>
                                        &#9672; <div class='text-align-fix'>An ability to diagnosis a situation to determine the best Kaizen Event to use.</div>
                                        &#9672; <div class='text-align-fix'>Access to the Kaizen Project tool.</div>
                                        &#9672; <div class='text-align-fix'>An ability to create the Kaizen Project report and for it to be shared.</div>">

                                    Know More
                                </div>
                                <!-- Modal Contents with button ends-->                               
                            </div>
                        </div>
                        <!-- Card -->
                        <div class="column">
                            <div class="feature-card card-md hover-inset has-text-centered mb-20">
                                <div class="brand-logo">
                                    <img src="landing/images/leantools/Leadership.png" alt="">
                                </div>
                                <div class="card-title">
                                    <h4>Leadership</h4>
                                </div>
                                <div class="card-feature-description">
                                    <span>The means and methods to eliminate team issues during a Kaizen Event.</span>
                                </div>
                                <!-- Modal Contents with button-->
                                <div class="button btn-align primary-btn btn-outlined is-bold rounded raised" data-html="true" data-toggle="popover"
                                         data-placement="bottom"
                                         title="Leadership will provide:"
                                         data-trigger="hover"
                                         data-arrowcolor="#F1664E"
                                         data-title-backcolor="#F1664E"
                                         data-title-textcolor="#fff"
                                         data-content="&#9672; <div class='text-align-fix'>An overview of the importance and purpose of effective leadership.</div>
                                        &#9672; <div class='text-align-fix'>Detailed descriptions for over 20 leadership tools/practices.</div>
                                        &#9672; <div class='text-align-fix'>An ability to diagnosis a situation to determine the best leadership approach to use.</div>
                                        &#9672; <div class='text-align-fix'>Access to the Leadership tool.</div>
                                        &#9672; <div class='text-align-fix'>An ability to create the Leadership report and for it to be shared.</div>">

                                    Know More
                                </div>
                                <!-- Modal Contents with button ends-->
                            </div>
                        </div>

                        <!-- Card -->
                        <div class="column">
                            <div class="feature-card card-md hover-inset has-text-centered mb-20">
                                <div class="brand-logo">
                                    <img src="landing/images/leantools/leaoverview.png" alt="">
                                </div>
                                <div class="card-title">
                                    <h4>Lean Overview and Assessment</h4>
                                </div>
                                <div class="card-feature-description">
                                    <span>The means and methods to create a baseline for which improvement activities will address. </span>
                                </div>
                                <!-- Modal Contents with button-->
                                <div class="button btn-align primary-btn btn-outlined is-bold rounded raised" data-html="true" data-toggle="popover"
                                         data-placement="bottom"
                                         title="Lean Overview and Assessment will provide:"
                                         data-trigger="hover"
                                         data-arrowcolor="#F1664E"
                                         data-title-backcolor="#F1664E"
                                         data-title-textcolor="#fff"
                                         data-content="&#9672; <div class='text-align-fix'>An overview of Lean and Six Sigma, their history as well as the benefits.</div>
                                        &#9672; <div class='text-align-fix'>An Organizational Readiness Guide.</div>
                                        &#9672; <div class='text-align-fix'>A detailed Lean Sigma Roadmap.</div>
                                        &#9672; <div class='text-align-fix'>Access to the Lean Assessment tool with default statements for the categories of Leadership, Customer Focus, Process Management, Employee Management, and Information/Analysis.</div>
                                        &#9672; <div class='text-align-fix'>An ability to customize the Lean Assessment categories and statements.</div>
                                        &#9672; <div class='text-align-fix'>A Radar Chart displaying the Lean Assessment with the Likert scale for the statements.</div>
                                        &#9672; <div class='text-align-fix'>An ability to create the Lean Assessment report and for it to be shared.</div>">

                                    Know More
                                </div>
                                <!-- Modal Contents with button ends-->
                            </div>
                        </div>
                        <!-- Card -->
                        <div class="column">
                            <div class="feature-card card-md hover-inset has-text-centered mb-20">
                                <div class="brand-logo">
                                    <img src="landing/images/leantools/mistakeproofing.png" alt="">
                                </div>
                                <div class="card-title">
                                    <h4>Mistake Proofing</h4>
                                </div>
                                <div class="card-feature-description">
                                    <span>The means and methods to thoroughly analyze a process for potential errors.</span>
                                </div>
                                <!-- Modal Contents with button-->
                                <div class="button btn-align primary-btn btn-outlined is-bold rounded raised" data-html="true" data-toggle="popover"
                                         data-placement="bottom"
                                         title="Mistake Proofing will provide:"
                                         data-trigger="hover"
                                         data-arrowcolor="#F1664E"
                                         data-title-backcolor="#F1664E"
                                         data-title-textcolor="#fff"
                                         data-content="&#9672; <div class='text-align-fix'>An overview of the importance and benefits of Mistake Proofing to anticipate potential problems before implementing process changes.</div>
                                        &#9672; <div class='text-align-fix'>Access to the Mistake Proofing tool.</div>
                                        &#9672; <div class='text-align-fix'>A Radar Chart displaying the potential and consequence of a proposed activity going work using the Likert scale.</div>
                                        &#9672; <div class='text-align-fix'>An ability to create the Mistake Proofing report and for it to be shared</div>">

                                    Know More
                                </div>
                                <!-- Modal Contents with button ends-->
                            </div>
                        </div>
                        <!-- Card -->
                        <div class="column">
                            <div class="feature-card card-md hover-inset has-text-centered mb-20">
                                <div class="brand-logo">
                                    <img src="landing/images/leantools/PDCA.png" alt="">
                                </div>
                                <div class="card-title">
                                    <h4>PDCA</h4>
                                </div>
                                <div class="card-feature-description">
                                    <span>The means and methods to use an iterative four-step problem solving methodology. </span>
                                </div>
                                <!-- Modal Contents with button-->
                                <div class="button btn-align primary-btn btn-outlined is-bold rounded raised" data-html="true" data-toggle="popover"
                                         data-placement="bottom"
                                         title="PDCA will provide:"
                                         data-trigger="hover"
                                         data-arrowcolor="#F1664E"
                                         data-title-backcolor="#F1664E"
                                         data-title-textcolor="#fff"
                                         data-content="&#9672; <div class='text-align-fix'>An overview of the simplistic and powerful methodology of PDCA.</div>
                                        &#9672; <div class='text-align-fix'>Access to the PDCA tool with Lean Thinking statements as a guide for each phase.</div>
                                        &#9672; <div class='text-align-fix'>A sense of “learning to learn” as a systematic and logical thinking process.</div>
                                        &#9672; <div class='text-align-fix'>An ability to create the PDCA report and for it to be shared.</div>">

                                    Know More
                                </div>
                                <!-- Modal Contents with button ends-->
                            </div>
                        </div>
                        <!-- Card -->
                        <div class="column">
                            <div class="feature-card card-md hover-inset has-text-centered mb-20">
                                <div class="brand-logo">
                                    <img src="landing/images/leantools/Standard_Work.png" alt="">
                                </div>
                                <div class="card-title">
                                    <h4>Standard Work</h4>
                                </div>
                                <div class="card-feature-description">
                                    <span>The means and methods to establish and control the best way to complete a process without variation from the original intent.</span>
                                </div>
                                <!-- Modal Contents with button-->
                                <div class="button btn-align primary-btn btn-outlined is-bold rounded raised" data-html="true" data-toggle="popover"
                                         data-placement="bottom"
                                         title="Standard Work will provide:"
                                         data-trigger="hover"
                                         data-arrowcolor="#F1664E"
                                         data-title-backcolor="#F1664E"
                                         data-title-textcolor="#fff"
                                         data-content="&#9672; <div class='text-align-fix'>An overview of the four main tools of Standard Work and an overall understanding of the value of standard work.</div>
                                        &#9672; <div class='text-align-fix'>Guidelines to consider when implementing standard work.</div>
                                        &#9672; <div class='text-align-fix'>Access to the Standard Work tool with the ability to take videos.</div>
                                        &#9672; <div class='text-align-fix'>An ability to create the Standard Work report (landscape) and for it to be shared.</div>">

                                    Know More
                                </div>
                                <!-- Modal Contents with button ends-->
                            </div>
                        </div>
                        <!-- Card -->
                        <div class="column">
                            <div class="feature-card card-md hover-inset has-text-centered mb-20">
                                <div class="brand-logo">
                                    <img src="landing/images/leantools/Value_Stream_Mapping.png" alt="">
                                </div>
                                <div class="card-title">
                                    <h4>Value Stream Mapping</h4>
                                </div>
                                <div class="card-feature-description">
                                    <span>The means and methods to create a visual representation of the material and information flow as well as queue times between processes for a specific customer demand.</span>
                                </div>
                                <!-- Modal Contents with button-->
                                <div class="button btn-align primary-btn btn-outlined is-bold rounded raised" data-html="true" data-toggle="popover"
                                         data-placement="bottom"
                                         title="Value Stream Mapping will provide:"
                                         data-trigger="hover"
                                         data-arrowcolor="#F1664E"
                                         data-title-backcolor="#F1664E"
                                         data-title-textcolor="#fff"
                                         data-content="&#9672; <div class='text-align-fix'>An overview of the importance of Value Stream Mapping and the common icons used in visually presenting data and information flow for a service or product line.</div>
                                        &#9672; <div class='text-align-fix'>An overview and approach to using a SIPOC Diagram to help identify key process steps.</div>
                                        &#9672; <div class='text-align-fix'>Guidelines to consider when creating a Value Stream Map.</div>
                                        &#9672; <div class='text-align-fix'>Access to the Value Stream Mapping tool.</div>
                                        &#9672; <div class='text-align-fix'>An ability to create the Value Stream Mapping report (landscape) and for it to be shared.</div>">

                                    Know More
                                </div>
                                <!-- Modal Contents with button ends-->
                            </div>
                        </div>
                        <!-- Card -->
                        <div class="column">
                            <div class="feature-card card-md hover-inset has-text-centered mb-20">
                                <div class="brand-logo">
                                    <img src="landing/images/leantools/wastewalk.png" alt="">
                                </div>
                                <div class="card-title">
                                    <h4>Waste Walk</h4>
                                </div>
                                <div class="card-feature-description">
                                    <span>The means and methods to visit a process area being considered for improvement, ask questions, and then identify process waste.</span>
                                </div>
                                <!-- Modal Contents with button-->
                                <div class="button btn-align primary-btn btn-outlined is-bold rounded raised" data-html="true" data-toggle="popover"
                                         data-placement="bottom"
                                         title="Waste Walk will provide:"
                                         data-trigger="hover"
                                         data-arrowcolor="#F1664E"
                                         data-title-backcolor="#F1664E"
                                         data-title-textcolor="#fff"
                                         data-content="&#9672; <div class='text-align-fix'>An overview of the 12 wastes as well as questions to DETECT each waste, suggested ways to ELIMINATE each waste, and EXAMPLES of each waste.</div>
                                        &#9672; <div class='text-align-fix'>An understanding of the importance of a Waste Walk as well as the Elevator Speech.</div>
                                        &#9672; <div class='text-align-fix'>Steps to conducting a Waste Walk.</div>
                                        &#9672; <div class='text-align-fix'>Access to the Waste Walk tool to document wastes.</div>
                                        &#9672; <div class='text-align-fix'>An ability to create the Waste Walk report and for it to be shared.</div>">

                                    Know More
                                </div>
                                <!-- Modal Contents with button ends-->
                            </div>
                        </div>

                         <!-- Card -->
                        <div class="column">
                            <div class="feature-card card-md hover-inset has-text-centered mb-20">
                                <div class="brand-logo">
                                    <img src="landing/images/leantools/5_Why_Analysis.png" alt="">
                                </div>
                                <div class="card-title">
                                    <h4>5 Whys Analysis</h4>
                                </div>
                                <div class="card-feature-description">
                                    <span>The means and methods to use organized brainstorming to methodically determine the causes of a problem (i.e., effect).</span>
                                </div>
                                <!-- Modal Contents with button-->
                                <div class="button btn-align primary-btn btn-outlined is-bold rounded raised" data-html="true" data-toggle="popover"
                                         data-placement="bottom"
                                         title="5 Whys Analysis will provide:"
                                         data-trigger="hover"
                                         data-arrowcolor="#F1664E"
                                         data-title-backcolor="#F1664E"
                                         data-title-textcolor="#fff"
                                         data-content="&#9672; <div class='text-align-fix'>An overview of the importance and benefits of the 5 Whys Analysis to assist in determining the true root cause(s) of problems or issues.</div>
                                        &#9672; <div class='text-align-fix'>Access to the 5 Whys Analysis tool.</div>
                                        &#9672; <div class='text-align-fix'>An ability to create the 5 Whys Analysis report and for it to be shared.</div>">

                                    Know More
                                </div>
                                <!-- Modal Contents with button ends-->
                            </div>
                        </div>
                        <!-- Card -->
                        <div class="column">
                            <div class="feature-card card-md hover-inset has-text-centered mb-20">
                                <div class="brand-logo">
                                    <img src="landing/images/leantools/Brainstorming.png" alt="">
                                </div>
                                <div class="card-title">
                                    <h4>Brainstorming</h4>
                                </div>
                                <div class="card-feature-description">
                                    <span>The means and methods to generate a high volume of ideas that is free of criticism and judgment within a short time period.</span>
                                </div>
                                <!-- Modal Contents with button-->
                                <div class="button btn-align primary-btn btn-outlined is-bold rounded raised" data-html="true" data-toggle="popover"
                                         data-placement="bottom"
                                         title="Brainstorming will provide:"
                                         data-trigger="hover"
                                         data-arrowcolor="#F1664E"
                                         data-title-backcolor="#F1664E"
                                         data-title-textcolor="#fff"
                                         data-content="&#9672; <div class='text-align-fix'>An overview of the importance and benefits of the Brainstorming to generate a high volume of ideas with team members’ full participation.</div>
                                        &#9672; <div class='text-align-fix'>Access to the 5 Whys Analysis tool.</div>
                                        &#9672; <div class='text-align-fix'>An ability to create the 5 Whys Analysis report and for it to be shared.</div>">

                                    Know More
                                </div>
                                <!-- Modal Contents with button ends-->
                            </div>
                        </div>
                        <!-- Card -->
                        <div class="column">
                            <div class="feature-card card-md hover-inset has-text-centered mb-20">
                                <div class="brand-logo">
                                    <img src="landing/images/leantools/Fishbone.png" alt="">
                                </div>
                                <div class="card-title">
                                    <h4>Fishbone Diagram</h4>
                                </div>
                                <div class="card-feature-description">
                                    <span>The means and methods to graphically display and explore, in increasing detail, all the possible causes of a problem or issue.</span>
                                </div>
                                <!-- Modal Contents with button-->
                                <div class="button btn-align primary-btn btn-outlined is-bold rounded raised" data-html="true" data-toggle="popover"
                                         data-placement="bottom"
                                         title="Fishbone Diagram will provide:"
                                         data-trigger="hover"
                                         data-arrowcolor="#F1664E"
                                         data-title-backcolor="#F1664E"
                                         data-title-textcolor="#fff"
                                         data-content="&#9672; <div class='text-align-fix'>An overview of importance and benefits of the Cause and Effect (or Fishbone) Diagram to assist in determining the true root cause(s) of problems or issues.</div>
                                        &#9672; <div class='text-align-fix'>Access to the Fishbone Diagram tool.</div>
                                        &#9672; <div class='text-align-fix'>An ability to create the Fishbone Diagram report and for it to be shared.</div>">

                                    Know More
                                </div>
                                <!-- Modal Contents with button ends-->
                            </div>
                        </div>
                        <!-- Card -->
                        <div class="column">
                            <div class="feature-card card-md hover-inset has-text-centered mb-20">
                                <div class="brand-logo">
                                    <img src="landing/images/leantools/Histogram.png" alt="">
                                </div>
                                <div class="card-title">
                                    <h4>Histogram</h4>
                                </div>
                                <div class="card-feature-description">
                                    <span>The means and methods to collect and utilize data to display the shape and distribution.</span>
                                </div>
                                <!-- Modal Contents with button-->
                                <div class="button btn-align primary-btn btn-outlined is-bold rounded raised" data-html="true" data-toggle="popover"
                                         data-placement="bottom"
                                         title="Histogram will provide:"
                                         data-trigger="hover"
                                         data-arrowcolor="#F1664E"
                                         data-title-backcolor="#F1664E"
                                         data-title-textcolor="#fff"
                                         data-content="&#9672; <div class='text-align-fix'>An overview of the importance and benefits of the Histogram that can display many patterns in the data and terms to describe the spread of data.</div>
                                        &#9672; <div class='text-align-fix'>Access to the Histogram tool.</div>
                                        &#9672; <div class='text-align-fix'>An ability to create the Histogram report and for it to be shared.</div>">

                                    Know More
                                </div>
                                <!-- Modal Contents with button ends-->
                            </div>
                        </div>
                        <!-- Card -->
                        <div class="column">
                            <div class="feature-card card-md hover-inset has-text-centered mb-20">
                                <div class="brand-logo">
                                    <img src="landing/images/leantools/Impact_Map.png" alt="">
                                </div>
                                <div class="card-title">
                                    <h4>Impact Map</h4>
                                </div>
                                <div class="card-feature-description">
                                    <span>The means and methods to identify solutions likely to have the greatest impact on the problem with the least amount of effort.</span>
                                </div>
                                <!-- Modal Contents with button-->
                                <div class="button btn-align primary-btn btn-outlined is-bold rounded raised" data-html="true" data-toggle="popover"
                                         data-placement="bottom"
                                         title="Impact Map will provide:"
                                         data-trigger="hover"
                                         data-arrowcolor="#F1664E"
                                         data-title-backcolor="#F1664E"
                                         data-title-textcolor="#fff"
                                         data-content="&#9672; <div class='text-align-fix'>An overview of the importance and benefits of the Impact Map that can help teams identify solutions to a problem that will most likely have the greatest impact with the least amount of effort.</div>
                                        &#9672; <div class='text-align-fix'>Access to the Impact Map tool.</div>
                                        &#9672; <div class='text-align-fix'>An ability to create Impact Map report and for it to be shared.</div>">

                                    Know More
                                </div>
                                <!-- Modal Contents with button ends-->
                            </div>
                        </div>
                        <!-- Card -->
                        <div class="column">
                            <div class="feature-card card-md hover-inset has-text-centered mb-20">
                                <div class="brand-logo">
                                    <img src="landing/images/leantools/Pareto_Chart.png" alt="">
                                </div>
                                <div class="card-title">
                                    <h4>Pareto Chart</h4>
                                </div>
                                <div class="card-feature-description">
                                    <span>The means and methods to collect and display data in bar chart format representing the 80/20 Pareto principle.</span>
                                </div>
                                <!-- Modal Contents with button-->
                                <div class="button btn-align primary-btn btn-outlined is-bold rounded raised" data-html="true" data-toggle="popover"
                                         data-placement="bottom"
                                         title="Pareto Chart will provide:"
                                         data-trigger="hover"
                                         data-arrowcolor="#F1664E"
                                         data-title-backcolor="#F1664E"
                                         data-title-textcolor="#fff"
                                         data-content="&#9672; <div class='text-align-fix'>An overview of the importance and benefits of the Pareto Chart to prioritize and break down complex problems into smaller chucks.</div>
                                        &#9672; <div class='text-align-fix'>Access to the Pareto Chart tool.</div>
                                        &#9672; <div class='text-align-fix'>An ability to create the Pareto Chart report ¬¬and for it to be shared.</div>">

                                    Know More
                                </div>
                                <!-- Modal Contents with button ends-->
                            </div>
                        </div>

                        <!-- Card -->
                        <div class="column">
                            <div class="feature-card card-md hover-inset has-text-centered mb-20">
                                <div class="brand-logo">
                                    <img src="landing/images/leantools/Run_Chart.png" alt="">
                                </div>
                                <div class="card-title">
                                    <h4>Run Chart</h4>
                                </div>
                                <div class="card-feature-description">
                                    <span>The means and methods to collect and display several data points over time.</span>
                                </div>
                                <!-- Modal Contents with button-->
                                <div class="button btn-align primary-btn btn-outlined is-bold rounded raised" data-html="true" data-toggle="popover"
                                         data-placement="bottom"
                                         title="Run Chart will provide:"
                                         data-trigger="hover"
                                         data-arrowcolor="#F1664E"
                                         data-title-backcolor="#F1664E"
                                         data-title-textcolor="#fff"
                                         data-content="&#9672; <div class='text-align-fix'>An overview of the importance and benefits of the Run Chart that can serial data points over time in order see trends and monitor performance.</div>
                                        &#9672; <div class='text-align-fix'>Access to the Run Chart tool.</div>
                                        &#9672; <div class='text-align-fix'>An ability to create the Run Chart report and for it to be shared.</div>">

                                    Know More
                                </div>
                                <!-- Modal Contents with button ends-->
                            </div>
                        </div>
                        <!-- Card -->
                        <div class="column">
                            <div class="feature-card card-md hover-inset has-text-centered mb-20">
                                <div class="brand-logo">
                                    <img src="landing/images/leantools/Scatterplot.png" alt="">
                                </div>
                                <div class="card-title">
                                    <h4>Scatter Plot</h4>
                                </div>
                                <div class="card-feature-description">
                                    <span>The means and methods to collect and display data to study the possible relationship between one variable and another.</span>
                                </div>
                                <!-- Modal Contents with button-->
                                <div class="button btn-align primary-btn btn-outlined is-bold rounded raised" data-html="true" data-toggle="popover"
                                         data-placement="bottom"
                                         title="Scatter Plot will provide:"
                                         data-trigger="hover"
                                         data-arrowcolor="#F1664E"
                                         data-title-backcolor="#F1664E"
                                         data-title-textcolor="#fff"
                                         data-content="&#9672; <div class='text-align-fix'>An overview of the importance and benefits of the Scatter Plot that uses coordinates to display values that represent two variables in a set of data.</div>
                                        &#9672; <div class='text-align-fix'>Access to the Scatter Plot tool.</div>
                                        &#9672; <div class='text-align-fix'>An ability to create Scatter Plot report and for it to be shared.</div>">

                                    Know More
                                </div>
                                <!-- Modal Contents with button ends-->
                            </div>
                        </div>
                        <!-- Card -->
                        <div class="column">
                            <div class="feature-card card-md hover-inset has-text-centered mb-20">
                                <div class="brand-logo">
                                    <img src="landing/images/leantools/Stakeholder_Analysis.png" alt="">
                                </div>
                                <div class="card-title">
                                    <h4>Stakeholder Analysis</h4>
                                </div>
                                <div class="card-feature-description">
                                    <span>The means and methods to collect and help determine the key people who have to be influenced project success.</span>
                                </div>
                                <!-- Modal Contents with button-->
                                <div class="button btn-align primary-btn btn-outlined is-bold rounded raised" data-html="true" data-toggle="popover"
                                         data-placement="bottom"
                                         title="Stakeholder Analysis will provide:"
                                         data-trigger="hover"
                                         data-arrowcolor="#F1664E"
                                         data-title-backcolor="#F1664E"
                                         data-title-textcolor="#fff"
                                         data-content="&#9672; <div class='text-align-fix'>An overview of the importance and benefits of the Stakeholder Analysis that identifies.</div>
                                        &#9672; <div class='text-align-fix'>key people who have to be influenced for a project to change initiative.</div>
                                        &#9672; <div class='text-align-fix'>Access to the Stakeholder Analysis tool.</div>
                                        &#9672; <div class='text-align-fix'>An ability to create Stakeholder Analysis report and for it to be shared</div>">

                                    Know More
                                </div>
                                <!-- Modal Contents with button ends-->
                            </div>
                        </div>                       
                        

                    </div>
                    <!-- <div class="has-text-centered pt-40 pb-40">
                        <a class="button button-cta btn-align primary-btn rounded">All integrations</a>
                    </div> -->
                </div>
            </div>
        </section>
        <!-- /Card Section -->
        


        




        <section id="hiw" class="section is-medium">
            <div class="container">
                <div class="section-title-wrapper has-text-centered">
                    <div class="clean-bg-symbol"><i class="fa fa-gg"></i></div>
                    <div>
                        <h2 class="clean-section-title">How It Works</h2>
                    </div>
                </div>
                <p class="p-t-1 desc has-text-centered"><b class="theme-font-color" style="font-size: 1.5em;">4 Eye-Opening and Easy to Follow Phases</b>
            <br>
            1 Career-Changing Way to Engage Employees for Getting Processes FITT!
            <br>
            With <i>Lean</i><b>FITT™</b>, <b class="theme-font-color"><i>POSITIVE BEHAVIORS</i></b> are introduced <br> &amp; <br> reinforced day-to-day
            <br>
            ensuring a change in <b class="theme-font-color"><i>EMPLOYEE ATTITUDES</i></b> and performance; contributing
            <br>
            greatly to a <b class="theme-font-color"><i>CHANGE IN ORGANIZATONAL CULTURE</i></b>.

        </p>

                <!-- Feature -->
                <div class="columns is-vcentered pt-80 pb-80">
                    <!-- Content -->
                    <div class="column is-4 is-offset-1">
                        <div class="minimal-feature">
                            <h2 class="title is-5 minimal-title theme-font-color">Phase 1</h2>
                            <h3 class="theme-font-color"><b>GET TO KNOW YOUR PROCESSES BETTTER – IDENTIFY WASTES</b></h3>
                            <div class="feature-content">
                                <br/>
                                <div>
                                    <i class="fa fa-rocket gradient-color" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp; Regularly conduct a <b class="theme-font-color"><i>Lean Assessment</i></b>
                                    <br/>
                                    <br/>
                                </div>
                                
                                
                                    <i class="fa fa-rocket gradient-color" aria-hidden="true"></i>
                                    <div class="text-align-fix"> Review a prioritized list of <b class="theme-font-color"><i>suggested Lean and Six Sigma tools</i></b> based on your Assessment score.?????We need to see if we want to do this or not…..????</div>
                                    <br/>
                                    

                                <i class="fa fa-rocket gradient-color" aria-hidden="true"></i>&nbsp;&nbsp; Conduct a <b class="theme-font-color"><i>Waste Walk.</i></b><br/><br/>


                                <i class="fa fa-rocket gradient-color" aria-hidden="true"></i>&nbsp;&nbsp; Create a <b class="theme-font-color"><i>Value Stream Map.</i></b><br/><br/>


                                <i class="fa fa-rocket gradient-color" aria-hidden="true"></i>&nbsp;&nbsp; Your goal will be <b class="theme-font-color"><i>SPECIFIC!</i></b>
                            </div>
                        </div>
                    </div>
                    <!-- Featured image -->
                    <div class="column is-6 is-offset-1">
                        <div class="minimal-feature-image">
                            <img class="main-image" src="landing/images/how_it_works/roles.png" alt="">
                        </div>
                    </div>
                </div>
                <!-- /Feature -->
                
                <!-- Feature -->
                <div class="columns is-vcentered pt-80 pb-80">
                    <!-- Featured image -->
                    <div class="column is-6 is-offset-1">
                        <div class="minimal-feature-image">
                            <img class="main-image" src="landing/images/how_it_works/collaborate.png" alt="">
                        </div>
                    </div>
                    <!-- Content -->
                    <div class="column is-4 is-offset-1">
                        <div class="minimal-feature">
                            <h2 class="title is-5 minimal-title theme-font-color">Phase 2</h2>
                            <h4 class="theme-font-color"><b>STANDARDIZE LEARNING AND HOW TO USE THE TOOLS –ELIMINATE WASTES</b></h4>
                            <div class="feature-content">
                                <br/>

                                <i class="fa fa-rocket gradient-color" aria-hidden="true"></i>&nbsp;&nbsp;  <div class="text-align-fix">Learn and apply from the 21 tools to broaden the learner's knowledge.</div>
                                <br/>

                                <i class="fa fa-rocket gradient-color" aria-hidden="true"></i>&nbsp;&nbsp; <div class="text-align-fix">Ensure knowledge attainment by completing the <b class="theme-font-color"><i>Quizzes.</i></b></div>
                                <br/>

                                <i class="fa fa-rocket gradient-color" aria-hidden="true"></i>&nbsp;&nbsp; <div class="text-align-fix"> Embrace a standard approach to implementing a Lean tool and connecting it to a <b class="theme-font-color"><i>KPI.</i></b></div>
                                <br/>

                                <i class="fa fa-rocket gradient-color" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp; Your goal will be <b class="theme-font-color"><i>MEASURABLE!</i></b>                         
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Feature -->
                
                <!-- Feature -->
                <div class="columns is-vcentered pt-80 pb-80">
                    <!-- Content -->
                    <div class="column is-4 is-offset-1">
                        <div class="minimal-feature dark-text">
                            <h2 class="title is-5 minimal-title theme-font-color">Phase 3</h2>
                            <h4 class="theme-font-color"><b>ENERGIZE YOUR TEAM WITH ACTIVE INVOLVEMENT AND TRANSPARENCY –ELIMINATE WASTES</b></h4>
                            <div class="feature-content">
                                <br/>
                                <i class="fa fa-rocket gradient-color" aria-hidden="true"></i>&nbsp;&nbsp; Change behavior with team <b class="theme-font-color"><i>Connectivity.</i></b>
                                <br/><br/>

                                <i class="fa fa-rocket gradient-color" aria-hidden="true"></i>&nbsp;&nbsp; Visualized you and your team <b class="theme-font-color"><i>Tickets or Action Items.</i></b>
                                <br/><br/>

                                <i class="fa fa-rocket gradient-color" aria-hidden="true"></i>&nbsp;&nbsp; Communicate with team members via <b class="theme-font-color"><i>Notifications</b></i>.
                                <br/><br/>
                                
                                <i class="fa fa-rocket gradient-color" aria-hidden="true"></i>&nbsp;&nbsp; Your goal will be <b class="theme-font-color"><i>ASSIGNABLE!</i></b>                         
                            </div>
                        </div>
                    </div>
                    <!-- Featured image -->
                    <div class="column is-6 is-offset-1">
                        <div class="minimal-feature-image">
                            <img class="main-image" src="landing/images/how_it_works/integrate.png" alt="">
                        </div>
                    </div>
                </div>
                <!-- /Feature -->

                <!-- Feature -->
                <div class="columns is-vcentered pt-80 pb-80">
                    <!-- Featured image -->
                    <div class="column is-6 is-offset-1">
                        <div class="minimal-feature-image">
                            <img class="main-image" src="landing/images/how_it_works/collaborate.png" alt="">
                        </div>
                    </div>
                    <!-- Content -->
                    <div class="column is-4 is-offset-1">
                        <div class="minimal-feature">
                            <h2 class="title is-5 minimal-title theme-font-color">Phase 4</h2>
                            <h4 class="theme-font-color"><b>MAKE IT ROUTINE, TRACK PROGRESS, AND BE REWARDED - ELIMINATE WASTES FOREVER!</b></h4>
                            <div class="feature-content">
                                <br/>
                                <i class="fa fa-rocket gradient-color" aria-hidden="true"></i>&nbsp;&nbsp; <div class="text-align-fix">Receive feeds from the <b class="theme-font-color"><i>Awards and Notifications</i></b> on a regular basis.</div>
                                <br/>

                                <i class="fa fa-rocket gradient-color" aria-hidden="true"></i>&nbsp;&nbsp; Track team’s progress with the <b class="theme-font-color"><i>Action Item Board.</i></b>
                                <br/><br/>

                                <i class="fa fa-rocket gradient-color" aria-hidden="true"></i>&nbsp;&nbsp; <div class="text-align-fix">Continually adjust and monitor your activities to meet everyday issues – making <i><i>Lean</i><b>FITT™</b></i> relevant.</div>
                                <br/>

                                <i class="fa fa-rocket gradient-color" aria-hidden="true"></i>&nbsp;&nbsp; Your goal will be <b class="theme-font-color"><i>REALISTIC AND TIMELY!</i></b>               
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Feature -->

            </div>
        </section>    


        





        

        <!-- Phone scroller section 1 -->
        <section id="first-feature" class="section no-margin has-border-top">
            <div class="container">
                <div class="columns is-gapless is-vcentered mt-80 mb-80">
                    <!-- Smartphone -->
                    <div class="column is-7 is-hidden-touch">
                        <div class="phone-slide is-first">
                        </div>
                    </div>
                    <!-- Content -->
                    <div class="column slide-description">
                        <div class="icon-subtitle">
                            <img src="http://web.leanfitt.com/wp-content/uploads/2017/03/Tools-and-Training-.png" class="img-responsive">
                        </div>
                        <div class="title quick-feature is-handwritten text-bold">
                            <h2>Tools and Training</h2>
                            <!-- <div class="bg-number">1</div> -->
                        </div>
                        <div class="title-divider is-small"></div>
                        <span class="section-feature-description">When it comes to reaching organization goals, <i>Lean</i><b>FITT™</b> is just the beginning. <i>Lean</i><b>FITT™</b> tracks every part of your continuous improvement journey to help you and your organization get “fit.” Stay motivated to see how small steps make a big impact. Allow <i>Lean</i><b>FITT™</b> to train employees on over 20 continuous improvement tools, track KPIs, action items, and ROIs (Lean Savings), as well as provide immediate access to implementation and deployment.</span>
                        <div class="pt-10 pb-10">
                            <a href="#second-feature" class="button button-cta btn-align btn-outlined is-bold raised light-btn rounded is-hidden-touch">
                                Next feature
                            </a>
                        </div>   
                    </div>

                </div>
            </div>
        </section>
        <!-- /Phone scroller section 1 -->

        <!-- Phone scroller section 2 -->
        <section id="second-feature" class="section section-feature-grey no-margin">
            <div class="container">

                <div class="columns is-gapless is-vcentered mt-80 mb-80">
                    <div class="column is-7 is-hidden-touch">
                        <div class="phone-slide is-second">
                        </div>
                    </div>

                    <div class="column slide-description">
                        <div class="icon-subtitle">
                            <img src="http://web.leanfitt.com/wp-content/uploads/2017/01/Strengthen-Leaders.png" class="img-responsive">
                        </div>
                        <div class="title quick-feature is-handwritten text-bold">
                            <h2>Strengthen Leaders</h2>
                           <!--  <div class="bg-number">2</div> -->
                        </div>
                        <div class="title-divider is-small"></div>
                        <span class="section-feature-description">Today’s Lean Leader must use a different set of skills to effectively engage employees in continuous improvement efforts. Lean, Six Sigma, and continuous improvement tools on smart devices will challenge and engage your employees to continually improve process anywhere and anytime. Allow <i>Lean</i><b>FITT™</b> to “strengthen” your ability to lead others in the continuous improvement journey.</span>
                        <div class="pt-10 pb-10">
                            <a href="#third-feature" class="button button-cta btn-align btn-outlined is-bold raised light-btn rounded is-hidden-touch">
                                Next feature
                            </a>
                        </div> 
                    </div>

                </div>
            </div>
        </section>
        <!-- /Phone scroller section 2 -->

        <!-- Phone scroller section 3 -->
        <section id="third-feature" class="section no-margin">
            <div class="container">

                <div class="columns is-gapless is-vcentered mt-80 mb-80">
                    <div class="column is-7 is-hidden-touch">
                        <div class="phone-slide is-third">
                        </div>
                    </div>

                    <div class="column slide-description">
                        <div class="icon-subtitle">
                            <img src="http://web.leanfitt.com/wp-content/uploads/2017/03/success_icon.png" class="img-responsive">
                        </div>
                        <div class="title quick-feature is-handwritten text-bold">
                            <h2>Success</h2>
                         <!--    <div class="bg-number">3</div> -->
                        </div>
                        <div class="title-divider is-small"></div>
                        <span class="section-feature-description">Employees over the years have seen many types of continuous improvement models introduced. Lean and Six Sigma (or Lean Sigma) has been found to be more than the flavor of the month. Lean and Six Sigma successes have been widely documented in every industry type. Allow <i>Lean</i><b>FITT™</b> to spread continuous improvement success throughout your organization.</span>
                        <div class="pt-10 pb-10">
                            <a href="#fourth-feature" class="button button-cta btn-align btn-outlined is-bold raised light-btn rounded is-hidden-touch">
                                Next feature
                            </a>
                        </div>   
                    </div>

                </div>
            </div>
        </section>
        <!-- /Phone scroller section 3 -->

        <!-- Phone scroller section 4 -->
        <section id="fourth-feature" class="section section-feature-grey no-margin">
            <div class="container">

                <div class="columns is-gapless is-vcentered mt-80 mb-80">
                    <div class="column is-7 is-hidden-touch">
                        <div class="phone-slide is-fourth">
                        </div>
                    </div>

                    <div class="column slide-description">
                        <div class="icon-subtitle">
                            <img src="http://web.leanfitt.com/wp-content/uploads/2017/01/Specialized-Content.png" class="img-responsive">
                        </div>
                        <div class="title quick-feature is-handwritten text-bold">
                            <h2>Customized Content</h2>
                        <!--     <div class="bg-number">4</div> -->
                        </div>
                        <div class="title-divider is-small"></div>
                        <span class="section-feature-description">Everyone’s approach to continuous improvement is different. One-size-fits-all doesn’t always fit you. With the Gold subscription, you can add your case studies, logos, colors, president’s message, etc. Allow <i>Lean</i><b>FITT™</b> the freedom to fit exactly your organization’s culture and uniqueness.</span>
                        <div class="pt-10 pb-10">
                            <a href="#fourth-feature" class="button button-cta btn-align btn-outlined is-bold raised light-btn rounded is-hidden-touch">
                                Next feature
                            </a>
                        </div> 
                    </div>

                </div>
            </div>
        </section>
        <!-- /Phone scroller section 4 -->


        <!-- Phone scroller section 5 -->
        <section id="fifth-feature" class="section no-margin">
            <div class="container">

                <div class="columns is-gapless is-vcentered mt-80 mb-80">
                    <div class="column is-7 is-hidden-touch">
                        <div class="phone-slide is-first">
                        </div>
                    </div>

                    <div class="column slide-description">
                        <div class="icon-subtitle">
                            <img src="http://web.leanfitt.com/wp-content/uploads/2017/01/Sustain-Your-Improvements.png" class="img-responsive">
                        </div>
                        <div class="title quick-feature is-handwritten text-bold">
                            <h2>Sustain Improvements</h2>
                        <!--     <div class="bg-number">4</div> -->
                        </div>
                        <div class="title-divider is-small"></div>
                        <span class="section-feature-description">No project is truly successful unless continuous improvements are sustained.  This can only be accomplished by engaging your employee throughout the improvement process.  Allow <i>Lean</i><b>FITT™</b> to be your visual management system for all phases of continuous improvement projects.</span>
                        <div class="pt-10 pb-10">
                            <a href="#fourth-feature" class="button button-cta btn-align btn-outlined is-bold raised light-btn rounded is-hidden-touch">
                                Next feature
                            </a>
                        </div> 
                    </div>

                </div>
            </div>
        </section>
        <!-- /Phone scroller section 5 -->

        <!-- Phone scroller section 6 -->
        <section id="sixth-feature" class="section section-feature-grey no-margin">
            <div class="container">

                <div class="columns is-gapless is-vcentered mt-80 mb-80">
                    <div class="column is-7 is-hidden-touch">
                        <div class="phone-slide is-second">
                        </div>
                    </div>

                    <div class="column slide-description">
                        <div class="icon-subtitle">
                            <img src="http://web.leanfitt.com/wp-content/uploads/2017/01/Inspire-Employees.png" class="img-responsive">
                        </div>
                        <div class="title quick-feature is-handwritten text-bold">
                            <h2>Inspire Employees</h2>
                        <!--     <div class="bg-number">4</div> -->
                        </div>
                        <div class="title-divider is-small"></div>
                        <span class="section-feature-description">Encourage employees join the continuous improvement journey.  Employees desire their work to be of the highest quality as well as for it to flow smoothly. Allow <i>Lean</i><b>FITT™</b> to intensively engage your employees at all levels of the organization.</span>
                        <div class="pt-10 pb-10">
                            <a href="#fifth-feature" class="button button-cta btn-align btn-outlined is-bold raised light-btn rounded is-hidden-touch">
                                Next feature
                            </a>
                        </div> 
                    </div>

                </div>
            </div>
        </section>
        <!-- /Phone scroller section 6 -->

        <!-- Phone scroller section 7 -->
        <section id="fourth-feature" class="section no-margin">
            <div class="container">

                <div class="columns is-gapless is-vcentered mt-80 mb-80">
                    <div class="column is-7 is-hidden-touch">
                        <div class="phone-slide is-third">
                        </div>
                    </div>

                    <div class="column slide-description">
                        <div class="icon-subtitle">
                            <img src="http://web.leanfitt.com/wp-content/uploads/2017/01/Track-Performance-Improvements-Real-Time.png" class="img-responsive">
                        </div>
                        <div class="title quick-feature is-handwritten text-bold">
                            <h2>Real-Time Tracking</h2>
                        <!--     <div class="bg-number">4</div> -->
                        </div>
                        <div class="title-divider is-small"></div>
                        <span class="section-feature-description">Stay on track with online and mobile tools that show your progress with real-time charts and graphs on the on your organizations Fitness Dashboard. Reach your goals by seeing progress notifications. Allow <i>Lean</i><b>FITT™</b> to track improvements real-time.</span>
                        <div class="pt-10 pb-10">
                            <a href="#sixth-feature" class="button button-cta btn-align btn-outlined is-bold raised light-btn rounded is-hidden-touch">
                                Next feature
                            </a>
                        </div> 
                    </div>

                </div>
            </div>
        </section>
        <!-- /Phone scroller section 7 -->





        <!-- Feature Matrix -->
        <section id="feature-matrix" class="section section-light-grey is-medium is-skewed-sm" style="margin-top: 4%;">
            <div class="container has-text-centered is-reverse-skewed-sm">
                <div class="section-title-wrapper has-text-centered">
                    <div class="clean-bg-symbol"><i class="fa fa-gg"></i></div>
                    <div>
                        <h2 class="clean-section-title">Also look at these.</h2>
                        <h3 class="subtitle is-5 pt-10 pb-10">
                            Access integrations and new features in a matter of seconds
                        </h3>
                    </div>
                </div>

                <div class="content-wrapper">
                    <div class="columns is-flex-mobile is-vcentered is-multiline has-text-centered">
                        <!-- Icon box -->
                        <div class="column is-3 is-half-mobile">
                            <div class="icon-box primary">
                                <div class="box-icon is-icon-reveal">
                                    <i class="im im-icon-Credit-Card2"></i>
                                </div>
                                <div class="box-title clean-text">
                                    Secured payments
                                </div>
                                <div class="box-text is-tablet-padded">
                                    Lorem ipsum dolor sit amet, usu no ancillae verterem partiendo, mea ea.
                                </div>
                            </div>
                        </div>
                        <!-- /Icon box -->
                        <!-- Icon box -->
                        <div class="column is-3 is-half-mobile">
                            <div class="icon-box">
                                <div class="box-icon is-icon-reveal">
                                    <i class="im im-icon-Calendar-4"></i>
                                </div>
                                <div class="box-title clean-text">
                                    Scheduled payments
                                </div>
                                <div class="box-text is-tablet-padded">
                                    Lorem ipsum dolor sit amet, usu no ancillae verterem partiendo, mea ea.
                                </div>
                            </div>
                        </div>
                        <!-- /Icon box -->
                        <!-- Icon box -->
                        <div class="column is-3 is-half-mobile">
                            <div class="icon-box secondary">
                                <div class="box-icon is-icon-reveal">
                                    <i class="im im-icon-Watch"></i>
                                </div>
                                <div class="box-title clean-text">
                                    Product catalog
                                </div>
                                <div class="box-text is-tablet-padded">
                                    Lorem ipsum dolor sit amet, usu no ancillae verterem partiendo, mea ea.
                                </div>
                            </div>
                        </div>
                        <!-- /Icon box -->
                        <!-- Icon box -->
                        <div class="column is-3 is-half-mobile">
                            <div class="icon-box">
                                <div class="box-icon is-icon-reveal">
                                    <i class="im im-icon-Cloud-Lock"></i>
                                </div>
                                <div class="box-title clean-text">
                                    Secured storage
                                </div>
                                <div class="box-text is-tablet-padded">
                                    Lorem ipsum dolor sit amet, usu no ancillae verterem partiendo, mea ea.
                                </div>
                            </div>
                        </div>
                        <div class="column is-3 is-half-mobile">
                            <div class="icon-box">
                                <div class="box-icon is-icon-reveal">
                                    <i class="im im-icon-Speach-Bubble2"></i>
                                </div>
                                <div class="box-title clean-text">
                                    Collaboration
                                </div>
                                <div class="box-text is-tablet-padded">
                                    Lorem ipsum dolor sit amet, usu no ancillae verterem partiendo, mea ea.
                                </div>
                            </div>
                        </div>
                        <!-- /Icon box -->
                        <!-- Icon box -->
                        <div class="column is-3 is-half-mobile">
                            <div class="icon-box secondary">
                                <div class="box-icon is-icon-reveal">
                                    <i class="im im-icon-Conference"></i>
                                </div>
                                <div class="box-title clean-text">
                                    Client management
                                </div>
                                <div class="box-text is-tablet-padded">
                                    Lorem ipsum dolor sit amet, usu no ancillae verterem partiendo, mea ea.
                                </div>
                            </div>
                        </div>
                        <!-- /Icon box -->
                        <!-- Icon box -->
                        <div class="column is-3 is-half-mobile">
                            <div class="icon-box secondary">
                                <div class="box-icon is-icon-reveal">
                                    <i class="im im-icon-Testimonal"></i>
                                </div>
                                <div class="box-title clean-text">
                                    Invoice templates
                                </div>
                                <div class="box-text is-tablet-padded">
                                    Lorem ipsum dolor sit amet, usu no ancillae verterem partiendo, mea ea.
                                </div>
                            </div>
                        </div>
                        <!-- /Icon box -->
                        <!-- Icon box -->
                        <div class="column is-3 is-half-mobile">
                            <div class="icon-box">
                                <div class="box-icon is-icon-reveal">
                                    <i class="im im-icon-Synchronize-2"></i>
                                </div>
                                <div class="box-title clean-text">
                                    Recurring payments
                                </div>
                                <div class="box-text is-tablet-padded">
                                    Lorem ipsum dolor sit amet, usu no ancillae verterem partiendo, mea ea.
                                </div>
                            </div>
                        </div>
                        <div class="column is-3 is-half-mobile">
                            <div class="icon-box">
                                <div class="box-icon is-icon-reveal">
                                    <i class="im im-icon-Statistic"></i>
                                </div>
                                <div class="box-title clean-text">
                                    Custom reports
                                </div>
                                <div class="box-text is-tablet-padded">
                                    Lorem ipsum dolor sit amet, usu no ancillae verterem partiendo, mea ea.
                                </div>
                            </div>
                        </div>
                        <!-- /Icon box -->
                        <!-- Icon box -->
                        <div class="column is-3 is-half-mobile">
                            <div class="icon-box">
                                <div class="box-icon is-icon-reveal">
                                    <i class="im im-icon-Email"></i>
                                </div>
                                <div class="box-title clean-text">
                                    Email processing
                                </div>
                                <div class="box-text is-tablet-padded">
                                    Lorem ipsum dolor sit amet, usu no ancillae verterem partiendo, mea ea.
                                </div>
                            </div>
                        </div>
                        <!-- /Icon box -->
                        <!-- Icon box -->
                        <div class="column is-3 is-half-mobile">
                            <div class="icon-box">
                                <div class="box-icon is-icon-reveal">
                                    <i class="im im-icon-Receipt-2"></i>
                                </div>
                                <div class="box-title clean-text">
                                    Automatic receipts
                                </div>
                                <div class="box-text is-tablet-padded">
                                    Lorem ipsum dolor sit amet, usu no ancillae verterem partiendo, mea ea.
                                </div>
                            </div>
                        </div>
                        <!-- /Icon box -->
                        <!-- Icon box -->
                        <div class="column is-3 is-half-mobile">
                            <div class="icon-box primary">
                                <div class="box-icon is-icon-reveal">
                                    <i class="im im-icon-Money-Bag"></i>
                                </div>
                                <div class="box-title clean-text">
                                    Tax management
                                </div>
                                <div class="box-text is-tablet-padded">
                                    Lorem ipsum dolor sit amet, usu no ancillae verterem partiendo, mea ea.
                                </div>
                            </div>
                        </div>
                        <!-- /Icon box -->
                    </div>
                   <!--  <div class="is-title-reveal pt-40 pb-40">
                        <a href="landing-v1-signup.html" class="button button-cta btn-align primary-btn raised">Start your Free trial</a>
                    </div> -->
                </div>
            </div>
        </section>
        <!-- /Feature Matrix -->






        <!-- Team section -->
        <section id="consulting" class="section is-medium no-padding-bottom">
            <div class="container">
                <!-- Title -->
                <!-- <div class="section-title-wrapper">
                    <div class="bg-number">4</div>
                    <h2 class="title section-title has-text-centered dark-text"> Our team rocks</h2>
                    <div class="subtitle has-text-centered is-tablet-padded">
                        Our team is made of IT professionnals and business specialists, the perfect recipe for success and collaboration.
                    </div>
                </div> -->

                <div class="content-wrapper">
                    <div class="columns">
                        <!-- Image -->
                        <div class="column is-7">
                            <img class="is-block" src="landing/images/consulting/team.png" alt="">
                        </div>
                        <!-- Content -->
                        <div class="column is-4 is-offset-1 pt-60 pb-80 mobile-padding-20">
                            <div class="icon-subtitle"><i class="im im-icon-Reload-3"></i></div>
                            <h2 class="title section-subtitle dark-text text-bold s-2">
                                Consulting 
                            </h2>
                            <span class="section-feature-description">
                                <i>Lean</i><b>FITT™</b> offers training and consulting services in the areas listed below. Rates vary depending on project and duration. Please contact us for a detailed proposal.<br/>
                                REMEMBER, your training or consulting is only as good as the person who delivers it! Don’t be fooled by the big name training and consulting firms. Make sure you find the right fit for your organization. It pays to investigate.<br/>
                                Make sure you have the trainer or consultant that has proven themselves with practical materials, delivery, and RESULTS. At <i>Lean</i><b>FITT™</b>, we pride ourselves on connecting with people, and achieving a high level of commitment, buy-in, and RESULTS!

                                <i>Lean</i><b>FITT™</b>also has expert trainers and strategists to help organizations with Lean Sigma transformations or initiatives.
                            </span>
                            <!-- <div class="pt-10 pb-10">
                                <a href="#" class="button btn-align btn-more is-link color-primary is-title-reveal">
                                    Learn more about us <i class="sl sl-icon-arrow-right"></i>
                                </a>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Team section -->



        <!-- Image carousel -->
        <section id="testimonials" class="section is-medium section-feature-grey">
            <div class="container">
                <!-- Title -->
                <div class="section-title-wrapper has-text-centered">
                    <div class="clean-bg-symbol"><i class="fa fa-gg"></i></div>
                    <div>
                        <h2 class="clean-section-title title section-subtitle clean-text color-primary has-text-centered is-2 dark-text">
                            <b>Testimonials</b>
                        </h2>
                    </div>
                </div>
                <!-- /Title -->

                <div class="content-wrapper">
                    <div class="columns is-vcentered">
                        <div class="column is-10 is-offset-1">
                            <!-- Testimonials -->
                            <div class="flat-testimonials">
                                <!-- Testimonial item -->
                                <div class="flat-testimonial-item accent">
                                    <div class="columns is-vcentered">
                                        <div class="column is-7">
                                            <div class="image-container">
                                                <img src="landing/images/testimonials/adam_bradley.jpg" alt="">
                                                <div class="skewed-overlay"></div>
                                            </div>
                                        </div>
                                        <div class="column is-5">
                                            <div class="testimonial-text">
                                                <i class="fa fa-quote-left fa-3x"></i>
                                                <p class="quoted-text">Lorem ipsum dolor sit amet, his insolens antiopam cu. Vim integre deserunt elaboraret et, qui dicant reprehendunt id, modus dignissim ne sea.</p>
                                                <p class="client-name">Adam Bradley</p>
                                                <p class="client-position">Project Manager</p>
                                                <img class="company" src="landing/images/testimonials/tribe.svg" alt="">
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                                <!-- /Testimonial item -->

                                <!-- Testimonial item -->
                                <div class="flat-testimonial-item accent">
                                    <div class="columns is-vcentered">
                                        <div class="column is-7">
                                            <div class="image-container">
                                                <img src="landing/images/testimonials/evelyne_dwyers.jpg" alt="">
                                                <div class="skewed-overlay"></div>
                                            </div>
                                        </div>
                                        <div class="column is-5">
                                            <div class="testimonial-text">
                                                <i class="fa fa-quote-left fa-3x"></i>
                                                <p class="quoted-text">Lorem ipsum dolor sit amet, his insolens antiopam cu. Vim integre deserunt elaboraret et, qui dicant reprehendunt id, modus dignissim ne sea.</p>
                                                <p class="client-name">Evelyn Dwyers</p>
                                                <p class="client-position">Software Engineer</p>
                                                <img class="company" src="landing/images/testimonials/covenant.svg" alt="">
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                                <!-- /Testimonial item -->

                                <!-- Testimonial item -->
                                <div class="flat-testimonial-item accent">
                                    <div class="columns is-vcentered">
                                        <div class="column is-7">
                                            <div class="image-container">
                                                <img src="landing/images/testimonials/joel_zimmerman.jpg" alt="">
                                                <div class="skewed-overlay"></div>
                                            </div>
                                        </div>
                                        <div class="column is-5">
                                            <div class="testimonial-text">
                                                <i class="fa fa-quote-left fa-3x"></i>
                                                <p class="quoted-text">Lorem ipsum dolor sit amet, his insolens antiopam cu. Vim integre deserunt elaboraret et, qui dicant reprehendunt id, modus dignissim ne sea.</p>
                                                <p class="client-name">Joel Zimmerman</p>
                                                <p class="client-position">Head of Sales</p>
                                                <img class="company" src="landing/images/testimonials/gutwork.svg" alt="">
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                                <!-- /Testimonial item -->

                            </div>
                            <!-- /Testimonials -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Image carousel -->



        <section id="faqs" class="section section-light-grey is-medium">
            <div class="container">
                <div id="multi-toggle" class="section-title-wrapper has-text-centered">
                    <div class="bg-number">2</div>
                    <h2 class="title section-title has-text-centered dark-text text-bold">
                        FAQs
                    </h2>
                </div>
                <br/>
                <br/>
                <!-- Multi toggles -->

                <div class="columns is-vcentered">
                    <div class="column is-6 is-offset-3">
                        <div class="multi-toggle-wrapper">
                            <div class="mt-item">
                                <input id="mt-item-1" class="mt-item-input" type="checkbox" name="mt1">
                                <label for="mt-item-1" class="mt-item-label"><span>What is <i>Lean</i><b>FITT™</b> ?</span></label>
                                <div class="mt-item-content">
                                    <p><i>Lean</i><b>FITT™</b> is a cloud-based continuous improvement platform that revolutionizes how continuous improvement is learned, applied, communicated, and sustained using today’s smart devices and web-based portals.  <i>Lean</i><b>FITT™</b> harnesses the power of continuous improvement, employee engagement, and standardized knowledge and tool usage that inspires the necessary critical thinking skills to obtain sustained process improvements throughout your organization.<br/><br/>
                                    We have combined the experience of Lean, Six Sigma, Quality Improvement Tools, and Six Sigma with today’s technology so you can easily and readily focus on improving processes with you and your team that actually stick.<br/><br/>
                                    <i>Lean</i><b>FITT™</b> surrounds you with the right learnings, tools, and technology during your journey of making your processes FITT– FOREVER!
                                    </p>
                                </div>
                            </div>
                            <div class="mt-item">
                                <input id="mt-item-2" class="mt-item-input" type="checkbox" name="mt2">
                                <label for="mt-item-2" class="mt-item-label"><span>How long with this program last ?</span></label>
                                <div class="mt-item-content">
                                    <p><i>Lean</i><b>FITT™</b>is meant to change behaviors and the way you and your team interact over time. A manager or team member will constantly face new issues and challenges as time goes on. It is expected once your experience the ease-of-use and practicality of <i>Lean</i><b>FITT™</b>it will become your main avenue for all continuous improvement activities, now and in the future. We have priced <i>Lean</i><b>FITT™</b>as such.</p>
                                </div>
                            </div>
                            <div class="mt-item">
                                <input id="mt-item-3" class="mt-item-input" type="checkbox" name="mt3">
                                <label for="mt-item-3" class="mt-item-label"><span>How much time should I spend each day with <i>Lean</i><b>FITT™</b> ?</span></label>
                                <div class="mt-item-content">
                                    <p><i>Lean</i><b>FITT™</b>is meant for incremental learning and applying the skill set to effectively manage and sustain process improvements. Each Learning Module is approximately 15 – 20 minutes of readings and quiz taking. Subsequent application of the tool application, creating a Project, etc. and assigning of Tickets/Action Items as well as completing Ticket activities, would be minutes per day.  <i>Lean</i><b>FITT™</b>was meant to optimize you and your team’s time in all aspects possible allowing access to <i>Lean</i><b>FITT™</b> on any device and time – just need that WIFI connection!</p>
                                </div>
                            </div>
                            <div class="mt-item">
                                <input id="mt-item-4" class="mt-item-input" type="checkbox" name="mt4">
                                <label for="mt-item-4" class="mt-item-label"><span>Will I receive a discount by adding additional Users/Learners ?</span></label>
                                <div class="mt-item-content">
                                    <p>Yes. Please see the Pricing section for this information.</p>
                                </div>
                            </div>
                            <div class="mt-item">
                                <input id="mt-item-5" class="mt-item-input" type="checkbox" name="mt5">
                                <label for="mt-item-5" class="mt-item-label"><span>How do I get started ?</span></label>
                                <div class="mt-item-content">
                                    <p>1. Sign-up (2 minutes).<br/><br/>
                                        2. Determine if you are a single Learner (1 License) or you are signing up as an Organizational Administrator (multiple Licenses). (1-5 minutes) 
                                        Note: If you sign-up as an single Learner, you will have the option at any time to upgrade to an Organizational Administrator and subsequently add Learners/Users/Licenses.<br/><br/>
                                        3. Set up your account. If single Learner, (less than 5 minutes), if signing up as an Organizational Administrator, allow 1-2 minutes per Learner license.<br/><br/>
                                        Each Learner/Licensed users will then receive an email notification welcoming them to <i>Lean</i><b>FITT™</b> and requesting them to log-in and change their password.<br/><br/>
                                        Then, your <i>Lean</i><b>FITT™</b> journey begins!
                                    </p>
                                </div>
                            </div>
                            <div class="mt-item">
                                <input id="mt-item-6" class="mt-item-input" type="checkbox" name="mt6">
                                <label for="mt-item-6" class="mt-item-label"><span>What if I want to cancel my subscription ?</span></label>
                                <div class="mt-item-content">
                                    <p>We really think you’ll like our program, but we understand that is may not be for everyone, and some may not want to fully commit. If you would like to cancel, go to your account as a Learner/User (single license) or Organizational Administrator and simply unsubscribe.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                <!-- /Multi toggles -->
            </div>
        </section>


        <!-- Pricing Section -->
        <section id="price" class="section is-medium parallax is-relative" data-background="landing/images/bg/tech-pattern.png" data-color="#000" data-color-opacity="0">
            <div class="container">
                <div class="section-title-wrapper">
                    <div class="bg-number">5</div>
                    <h2 class="title section-title has-text-centered dark-text"> Pick your Plan</h2>
                    <div class="subtitle has-text-centered is-tablet-padded">
                        Our plans are affordable and suit every business size. Choose the one that suits you the most.
                    </div>
                </div>

                <div class="content-wrapper">
                    <div class="classic-pricing">
                        <div class="pricing-table">
                            <!-- Pricing Plan -->
                            <div class="pricing-plan">
                                <div class="plan-header">Newcomer</div>
                                <div class="plan-price"><span class="plan-price-amount"><span class="plan-price-currency">$</span>0</span>/month</div>
                                <div class="plan-items">
                                    <div class="plan-item">Forever Free</div>
                                    <div class="plan-item">1 data stream</div>
                                    <div class="plan-item">1 team member</div>
                                    <div class="plan-item">-</div>
                                </div>
                                <div class="plan-footer">
                                    <button class="button btn-align primary-btn rounded raised is-fullwidth btn-outlined is-bold">Get started</button>
                                </div>
                            </div>
                            <!-- /Pricing Plan -->
                            <!-- Pricing Plan -->
                            <div class="pricing-plan is-primary">
                                <div class="plan-header">Starter</div>
                                <div class="plan-price"><span class="plan-price-amount"><span class="plan-price-currency">$</span>40</span>/month</div>
                                <div class="plan-items">
                                    <div class="plan-item">5 data streams</div>
                                    <div class="plan-item">5 team members</div>
                                    <div class="plan-item">Custom widgets</div>
                                    <div class="plan-item">-</div>
                                </div>
                                <div class="plan-footer">
                                    <button class="button btn-align primary-btn rounded raised is-fullwidth btn-outlined is-bold">Sign up</button>
                                </div>
                            </div>
                            <!-- /Pricing Plan -->
                            <!-- Pricing Plan -->
                            <div class="pricing-plan is-primary">
                                <div class="plan-header">Business</div>
                                <div class="plan-price"><span class="plan-price-amount"><span class="plan-price-currency">$</span>60</span>/month</div>
                                <div class="plan-items">
                                    <div class="plan-item">25 data streams</div>
                                    <div class="plan-item">10 team members</div>
                                    <div class="plan-item">Custom widgets</div>
                                    <div class="plan-item">Integration connector</div>
                                </div>
                                <div class="plan-footer">
                                    <button class="button btn-align primary-btn rounded raised is-fullwidth btn-outlined is-bold">Sign up</button>
                                </div>
                            </div>
                            <!-- /Pricing Plan -->
                            <!-- Pricing Plan -->
                            <div class="pricing-plan is-secondary is-active">
                                <div class="plan-header">Enterprise</div>
                                <div class="plan-price"><span class="plan-price-amount"><span class="plan-price-currency">$</span>100</span>/month</div>
                                <div class="plan-items">
                                    <div class="plan-item">50 data streams</div>
                                    <div class="plan-item">Unlimited members</div>
                                    <div class="plan-item">Custom widgets</div>
                                    <div class="plan-item">3 Free integrations</div>
                                </div>
                                <div class="plan-footer">
                                    <button class="button btn-align secondary-btn rounded raised is-fullwidth btn-outlined is-bold">Sign up</button>
                                </div>
                            </div>
                            <!-- /Pricing Plan -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Pricing Section -->


        <!-- FAQ -->
        <section id="about" class="section section-feature-grey is-medium">
            <div class="container">
                <div class="section-title-wrapper has-text-centered">
                    <div class="clean-bg-symbol"><i class="fa fa-gg"></i></div>
                    <div>
                        <h2 class="clean-section-title title section-subtitle clean-text color-primary has-text-centered is-2 dark-text">
                            <b>About Us</b>
                        </h2>
                    </div>
                </div>
               
                <div class="content-wrapper margin-both-15">
                    <div class="col-md-3"></div>
                    <div class="col-md-6 text-centered">    
                            <div class="content">
                                <p class="text-bold color-primary dark-text"> The <i>Lean</i><b>FITT™</b> team and concept was forged over many years of listening to and working with clients and collaborating to improve our ability to meet their needs. Our team’s experiences are from a variety industries such as healthcare, manufacturing, service, and sales, and in diverse areas such as quality, operations, and support functions. Our client’s needs have ranged from basic Lean training to total Lean transformations, to customized methods and tools. We’ve tried to listen and meet their needs in every case.</p>
                            </div>
                            <div class="content">
                                <p class="text-bold color-primary dark-text"> Our <i>Lean</i><b>FITT™</b> team has collaborated since 2001 to author over 50 books and learning tools and materials, and yet our clients were looking for more. More tools, simpler approaches, better use of technologies, and improving more quickly and sustainably; simply put continuous improvement in our continuous improvement methods, tools, and techniques.</p>
                            </div>
                            <div class="content">
                                <p class="text-bold color-primary dark-text"> To help meet our client’s dynamic needs, Lean apps were developed in 2014, and made available in iOS, and Android formats. While these apps were powerful, and streamlined many Lean methods and tools, they lacked connectivity between users. Our clients wanted a more collaborative approach within their organization. This need gave birth to <i>Lean</i><b>FITT™</b>.</p>
                            </div>
                            <div class="content">
                                <p class="text-bold color-primary dark-text"> <i>Lean</i><b>FITT™</b> is our most recent adaptation to our client’s needs. <i>Lean</i><b>FITT™</b> facilitates Lean team collaboration, and can generate clear and compelling payback for your Lean program. One client has said, “<i>Lean</i><b>FITT™</b> is like Sharepoint for our Lean program, but with specific, custom Lean tools provided.” Client reactions and feedback like this is what drives us to the next level. No doubt there will be new and evolving Lean needs, and we expect to be there to achieve them.</p>
                            </div>
                            <div class="content">
                                <p class="text-bold color-primary dark-text"> We are customer driven, and results focused. Our methods, tools, and techniques are designed to improve your processes, your people, and your profits.</p>
                            </div>                                                                                                    
                    </div>    
                    <div class="col-md-3"></div>

                </div>

                <br/>
                <br/>                
                <br/>
                <br/>
                <div class="section-title-wrapper">
                    <div class="bg-number"><i class="fa fa-users" aria-hidden="true"></i></div>
                    <h2 class="title section-title has-text-centered dark-text">Our Team</h2>
                </div>
                <br/>
                <br/>


                <div class="columns is-vcentered">
                    <div class="column is-5 is-offset-1">
                        <!-- Demo section -->
                        <div class="demo">
                            <div class="testimonial-item">
                                <div class="flex-card card-overflow raised mb-40">
                                    <div class="testimonial-avatar">
                                        <img src="landing/images/about_us/about_us_1.png" alt="">
                                    </div>
                                    <div class="testimonial-name">
                                        <h3>Rob Ptacek</h3>
                                        <span>Lorem ipsum dolor sit amet</span>
                                    </div>
                                    <div class="testimonial-content about-details-scroll-fix">
                                        <p>Rob Ptacek is a Partner in the Global Lean Institute and President and CEO of Competitive Edge Training and Consulting, a firm specializing in leader and organizational development, and Lean Enterprise transformations.  Rob holds a BS in Metallurgical Engineering from Michigan Technological University and a Masters of Management from Aquinas College.  Rob has held leadership positions in Quality, Sales, and Operations Management, and has over 25 years of practical experience implementing continuous improvements in a variety of industries.  Rob can be contacted at ptacek@i2k.com.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Demo section -->
                    </div>
                    <div class="column is-5">
                        <!-- Demo section -->
                        <div class="demo">
                            <div class="testimonial-item">
                                <div class="flex-card card-overflow raised mb-40">
                                    <div class="testimonial-avatar">
                                        <img src="landing/images/about_us/about_us_3.png" alt="">
                                    </div>
                                    <div class="testimonial-name">
                                        <h3>Deborah Salimi</h3>
                                        <span>Project Management Professional (PMP), PhD</span>
                                    </div>
                                    <div class="testimonial-content about-details-scroll-fix">
                                        <p>Deborah brings a practical approach to Lean, based on applied learning.  Her experience spans three continents in manufacturing, project management, logistics, not for profit health care and higher education. She co-founded and is a key leader at the Lean Gulf Institute, spreading Lean awareness, professional development and empowerment through process improvement activities.  She holds an Engineering degree from Boston University, an MBA and PhD. Deborah can be contacted at deb@leangulf.org or visit www.leangulf.org.</p>
                                    </div>                           
                                </div>
                            </div>
                        </div>
                        <!-- /Demo section -->
                    </div>
                </div>

                <div class="columns is-vcentered">
                    <div class="column is-5 is-offset-1">
                        <!-- Demo section -->
                        <div class="demo">
                            <div class="testimonial-item">
                                <div class="flex-card card-overflow raised mb-40">
                                    <div class="testimonial-avatar">
                                        <img src="landing/images/about_us/about_us_2.png" alt="">
                                    </div>
                                    <div class="testimonial-name">
                                        <h3>Todd Sperl</h3>
                                        <span>Lorem ipsum dolor sit amet</span>
                                    </div>
                                    <div class="testimonial-content about-details-scroll-fix">
                                        <p>Todd Sperl is an enthusiastic, creative speaker and process improvement expert who looks beyond today’s problems to find tomorrow’s solutions. As Owner and Managing Partner of Lean Fox Solutions, Todd’s vision is to improve the patient care experience from one healthcare touch point to the next.  As a Master Black Belt and Lean Sensei, Todd’s exceptional track record of process improvement has been based on his philosophy of total enterprise engagement in change.  Todd received his BS in Psychology from the University of Wisconsin-River Falls and an MS in Industrial-Organizational Psychology from St. Mary’s University in San Antonio, Texas.  Todd can be contacted at tsperl@leanfoxsolutions.com or visit www.leanfoxsolutions.com.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Demo section -->
                    </div>
                    <div class="column is-5">
                        <!-- Demo section -->
                        <div class="demo">
                            <div class="testimonial-item">
                                <div class="flex-card card-overflow raised mb-40">
                                    <div class="testimonial-avatar">
                                        <img src="http://ec2-54-245-205-243.us-west-2.compute.amazonaws.com/assets/img/about_us/team3.jpg" alt="">
                                    </div>
                                    <div class="testimonial-name">
                                        <h3>Don Tapping</h3>
                                        <span>Publisher &amp; Author</span>
                                    </div>
                                    <div class="testimonial-content about-details-scroll-fix">
                                        <p>Don Tapping graduated from The University of Michigan in 1976. He spent the next four years as a Lieutenant in the United States Marine Corps in various positions during his tour. After completing his Corps duties, Don worked in the medical technology, education, and aerospace industries for the next 20 years. Don authored the best-selling book, Value Stream Management for the Lean Office (Productivity Press 2003), Lean Office Demystified (II), Who Hollered Fore?, and over 50 other books and apps on business performance - setting the bar for continuous improvements. He continues to enlighten organizations with his ability to design step-by-step implementation methodologies identifying processes that require improvement, and then introducing proactive steps to improve or redesign them - reducing costs, boosting performance, and increasing customer (patient) satisfaction. Don today is using his experience in developing apps on how Lean can be applied using smart devices. Don also received his MBA from The University of Notre Dame.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Demo section -->
                    </div>
                </div>



            </div>
        </section>
        <!-- /FAQ -->


        


    <div class="foorter-fix">            
        <!-- Ribbon -->
        <section class="section is-theme-primary">
            <div class="container">
                <div class="content content-flex">
                    <h2 class="light-text">Get an immediate -20% by signing up now</h2>
                    <!-- <a class="button button-cta btn-align light-btn btn-outlined is-bold ml-auto">Get started</a> -->
                    <a class="button button-cta btn-align light-btn btn-outlined is-bold ml-auto get-started-btn">Get started</a>
                    
                </div>
            </div> 
        </section>
        <!-- /Ribbon -->

        <!-- Footer -->
        <!-- <footer class="footer footer-light-left">
            <div class="container">
                <div class="columns is-vcentered">
                    
                    <div class="column is-6">
                        <div class="mb-20">
                            <img class="site-footer-logo" src="landing/images/logo.png" alt="">
                        </div>
                        <div>
                            
                            <nav class="level is-mobile mt-20">
                                <div class="level-left level-social">
                                    <a class="level-item">
                                        <span class="icon"><i class="fa fa-facebook"></i></span>
                                    </a>
                                    <a class="level-item">
                                        <span class="icon"><i class="fa fa-twitter"></i></span>
                                    </a>
                                    <a class="level-item">
                                        <span class="icon"><i class="fa fa-linkedin"></i></span>
                                    </a>
                                    <a class="level-item">
                                        <span class="icon"><i class="fa fa-dribbble"></i></span>
                                    </a>
                                    <a class="level-item">
                                        <span class="icon"><i class="fa fa-github"></i></span>
                                    </a>
                                </div>
                            </nav>
                        </div>
                    </div>
                    
                    <div class="column">
                        <div class="footer-nav-right">
                            <a class="footer-nav-link" href="landing-v1.html">Home</a>
                            <a class="footer-nav-link" href="landing-v1-features.html">Features</a>
                            <a class="footer-nav-link" href="landing-v1-pricing.html">Pricing</a>
                            <a class="footer-nav-link" href="landing-v1-login.html">Log in</a>
                            <a class="footer-nav-link" href="landing-v1-signup.html">Sign up</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer> -->
        <!-- /Footer -->
    </div>

        


        <!-- Back To Top Button -->
        <div id="backtotop"><a href="#"></a></div>

        <!-- Core js -->
        <script src="landing/js/core/jquery.min.js"></script>
        <script src="landing/js/core/modernizr.min.js"></script>
        <!-- Plugins js -->
        <script src="landing/js/slick-carousel/slick.min.js"></script>
        <script src="landing/js/ggpopover/ggpopover.min.js"></script>
        <script src="landing/js/ggpopover/ggtooltip.js"></script>   
        <script src="landing/js/scrollreveal/scrollreveal.min.js"></script>

     
        <!-- Bulkit js -->
        <script src="landing/js/main.js"></script>
        <!-- Page specific JS -->
        <script src="landing/js/pages/landingv1.js"></script>
        <script src="landing/js/pages/components-accordion.js"></script>
        <script src="landing/js/pages/components-modals.js"></script>
        <script src="landing/js/pages/demo.js"></script>
        <script type="text/javascript">
            $('.tool-modal').on('click', function(){
                console.log("hello jy");
                $("html").css('overflow', 'hidden');    
                $(".navbar-wrapper").css('display', 'none');
            });
            $('.modal-close').on('click', function(){
                console.log("hello jy");
                $("html").css('overflow', 'scroll');    
                $(".navbar-wrapper").css('display', 'block');
            });
            
        </script>

    </body>

<!-- Mirrored from bulkit.cssninja.io/landing-v1-features.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 28 Mar 2018 14:35:32 GMT -->
</html>