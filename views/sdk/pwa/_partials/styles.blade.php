<style>
    :root {
        --sidebar-w: 260px;
        --base-gap: 34px;
        --base-radius: 20px;
        --base-padding: calc(var(--base-gap) * 1.15);
        --card-radius: calc(var(--base-radius) / 2);
        --aspect-ratio: 56.25%;
        --swiper-pagination-bullet-width: 16px;
        --swiper-pagination-bullet-height: 16px;
        --swiper-pagination-color: var(--primary);
    }

    .mt-auto {
        margin-top: auto;
    }

    body {
        max-width: 100%;
        background: var(--primary-15);
        padding: var(--base-gap) 0;
        box-shadow: none;
    }

    .base-container {
        display: flex;
        gap: var(--base-gap);
    }


    body .base-content {
        background: var(--primary-5);
        width: calc(100% - (var(--sidebar-w) + var(--base-gap)));
        border-radius: var(--base-radius);
        overflow: hidden;
        min-height: calc(100vh - ((var(--base-gap)) * 2));
    }

    .navbar {
        background: #fff;
        flex-direction: row;
        width: 100%;
        padding: 14px var(--base-padding) !important;
        height: inherit !important;
        justify-content: start !important;
    }

    .navbar>.title {
        font-size: 20px;
        line-height: 34px;
        font-weight: 800;
    }

    .navbar>.icon {
        width: 40px;
        margin: unset;
    }

    .h100 {
        height: 100px;
    }

    .h200 {
        height: 200px;
    }

    .lmargin-neg {
        margin-left: calc(var(--base-padding) * -1) !important;
    }


    .wpad {
        padding-left: var(--base-padding) !important;
        padding-right: var(--base-padding) !important;
    }

    .rpad {
        padding-right: var(--base-padding) !important;
    }

    .lpad {
        padding-left: var(--base-padding) !important;
    }

    .tpad {
        padding-top: var(--base-padding) !important;
    }

    .bpad {
        padding-bottom: var(--base-padding) !important;
    }







    .wpad-half {
        padding-left: calc(var(--base-padding) / 2) !important;
        padding-right: calc(var(--base-padding) / 2) !important;
    }

    .rpad-half {
        padding-right: calc(var(--base-padding) / 2) !important;
    }

    .lpad-half {
        padding-left: calc(var(--base-padding) / 2) !important;
    }

    .tpad-half {
        padding-top: calc(var(--base-padding) / 2) !important;
    }

    .bpad-half {
        padding-bottom: calc(var(--base-padding) / 2) !important;
    }




    .tpad5 {
        padding-top: 5px !important;
    }

    .tpad10 {
        padding-top: 10px !important;
    }

    .tpad15 {
        padding-top: 15px !important;
    }

    .tpad20 {
        padding-top: 20px;
    }

    .title-row {
        display: flex;
        justify-content: space-between;
    }

    .title-row .title {
        font-size: 16px;
        font-weight: 700;
        color: #333;
    }

    .title-row .stat {
        font-size: 14px;
        font-weight: 500;
        color: #777;
        margin-left: 5px;
    }

    .accordion .time {
        min-width: 60px;
        text-align: left;
    }

    .bottom-nav {
        display: flex;
        position: fixed;
        justify-content: space-around;
        background: #ffffff;
        bottom: 0;
        height: 75px;
        width: 100%;
        max-width: 100%;
        box-shadow: 0px -10px 20px rgba(0, 0, 0, 0.1);
        flex-direction: row-reverse;
        z-index: 99999;
        padding: 0 var(--base-padding);

    }

    .bottom-nav>a:first-child {
        border-radius: 20px 0 0 0;
    }

    .bottom-nav>a:last-child {
        border-radius: 0 20px 0 0;
    }

    .bottom-nav a.active {
        color: var(--primary);
    }

    .bottom-nav a.active:before {
        position: absolute;
        content: "";
        bottom: 0;
        width: 100%;
        height: 6px;
        border-radius: 3px 3px 0 0;
        background: var(--primary);
    }

    .bottom-nav a.active i {
        font-weight: 900;
    }

    .bottom-nav>a {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        font-size: 24px;
        color: #333;
        position: relative;
        flex: 1;
    }

    .bottom-nav>a:hover {
        background: #f7f7f7;
    }

    .bottom-nav>a>i {
        font-size: 20px;
    }

    .bottom-nav>a>span {
        font-size: 10px;
        height: 20px;
        color: #777;
    }

    .card-product.my-course {
        padding: 20px 20px 20px 12px;
        background-position: center !important;
    }

    .card-product {
        border-radius: 10px;
        padding: 12px 16px 12px 5px;
        background-size: cover !important;
        background: linear-gradient(180deg, var(--primary-50), var(--primary-20));
    }

    .card-product:hover {
        opacity: 0.8;
    }

    .card-product .content .icon {
        margin-top: 7px;
    }

    .card-product .content {
        align-items: flex-start;
    }


    .card-product .progress-circle {
        height: 32px;
    }

    .progress {
        text-align: center;
        font-size: 9px;
        padding-left: 11px;
        line-height: 13px;
    }

    .progress span {
        z-index: 99999;
        position: absolute;
        text-align: center;
        color: var(--primary-50);
    }

    .cpbadge {
        background-color: var(--primary-15);
        color: var(--primary);
        padding: 3px 7px;
        font-size: 10px;
        margin-right: 5px;
        border-radius: 3px;
    }

    /* Show More Button */
    .longtextwrap {
        position: relative;
        padding: 10px;
    }

    .longtext,
    .alltext {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        max-height: 7em;
        transition: max-height 0.5s ease;
        font-size: 15px;
        line-height: 30px;
        text-align: justify;
    }

    .longtext *,
    .alltext * {
        font-family: iranyekanx, tahoma !important;
    }

    .singline {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .longtextwrap.expanded .longtext {
        -webkit-line-clamp: unset;
        max-height: none;
        overflow: visible;
    }

    .longtextwrap .moretext {
        display: flex;
        align-items: end;
        cursor: pointer;
        padding: 0;
        color: var(--primary);
        font-size: 14px;
    }

    .longtextwrap .moretext:hover {
        opacity: 0.7;
    }

    .waiting:after {
        background: rgba(255, 255, 255, 0.77);
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        content: "";
        color: var(--primary);
        position: absolute;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .loader {
        position: absolute;
        inset: 0;
        z-index: 9999;
        background: rgba(0, 0, 0, .5);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 6;
    }

    .loader:after {
        position: absolute;
        content: "";
        --sipnner-w: 54px;
        width: var(--sipnner-w);
        height: var(--sipnner-w);
        border: 5px solid #ffffff;
        border-top-color: transparent;
        border-radius: 50%;
        animation: loader 0.7s linear infinite;
    }

    @keyframes loader {
        from {}

        to {
            transform: rotate(360deg);
        }
    }

    @keyframes rotation {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    @keyframes rotationBack {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(-360deg);
        }
    }


    #pageloader {
        display: none;
        justify-content: center;
        align-items: center;
        position: fixed;
        background: rgba(255, 255, 255, 0.95);
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        flex-direction: column;
        z-index: 999;
    }

    #pageloader div {
        color: #333;
        font-size: 16px;
    }

    #pageloader img {
        max-width: 64px;
        animation: opa37 1s infinite ease-in-out;
        margin-bottom: 30px;
    }

    #pageloader.show {
        display: flex;
    }

    @keyframes opa37 {
        0% {
            /* transform: scale(1); */
            opacity: 1;
        }

        50% {
            /* transform: scale(1.1); */
            opacity: 0.37;

        }

        100% {
            /* transform: scale(1); */
            opacity: 1;

        }
    }

    .findwrap {
        position: relative;
    }

    .findwrap small {
        position: absolute;
        left: 6px;
        top: 6px;
        color: #777;
        background: #f1f1f1;
        padding: 5px 15px !important;
        height: 40px;
        line-height: 30px;
        font-weight: 600;
        border-radius: var(--card-radius);
    }

    .findwrap .inbtn {
        left: 6px !important;
        top: 6px !important;
        padding: 5px 10px 5px 15px !important;
    }

    .findwrap small i {
        vertical-align: middle;
        margin-right: 5px;
    }

    input#find {
        border-radius: var(--card-radius);
        border: none !important;
        font-weight: 400 !important;
    }

    .hide {
        display: none !important;

    }

    .find-result {
        display: none;
        padding: 30px 10px;
        text-align: center;
        color: #555;
    }

    .find-result span {
        color: var(--primary);
    }

    strong.smatch {
        color: var(--primary);
    }



    span.badge-light {
        background: rgba(255, 255, 255, 0.5);
        font-size: 11px;
        padding: 3px 7px;
        border-radius: 10px;
    }

    .stats-row {
        display: flex;
        font-size: 13px;
        font-weight: 300;
        color: #555;
        gap: var(--base-gap);
    }

    .stats-row>* {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .stats-row.white {
        color: white;
    }


    .content h1,
    .content h2,
    .content h3 {
        text-align: right !important;
        padding-top: 20px;
    }

    .content h1 {
        font-size: 22px;
        display: none;
    }

    .content h2 {
        font-size: 19px;
    }

    .content h3 {
        font-size: 16px;
    }

    .content ol,
    .content li {
        margin-right: 10px;
    }

    .content-footer {
        display: flex;
        justify-content: center;
        gap: var(--base-gap);
    }

    .btn,
    button {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        padding: 6px 16px;
        background: var(--primary);
        color: white;
        font-size: 16px;
        font-weight: 600;
        border-radius: var(--card-radius);
        transition: all ease-in-out .1s !important;
    }

    button:hover,
    .btn:hover {
        opacity: 0.8;
        background: var(--primary) !important;
        border-color: var(--primary) !important;
    }

    .btn.light,
    button.light {
        background: var(--primary-20);
        border-color: var(--primary-20);
        color: black;
    }

    .btn.light:hover,
    button.light:hover {
        background: var(--primary-30) !important;
        border-color: var(--primary-30) !important;
        color: black !important;
    }

    .btn i,
    button i {
        font-size: 16px;
    }

    .btn.danger,
    button.danger {
        background: var(--danger);
        border-color: var(--danger);
    }

    .btn.danger:hover,
    button.danger:hover {
        background: var(--danger) !important;
        border-color: var(--danger) !important;
    }

    img {
        max-width: 100%;
        margin: 10px auto;
        border-radius: 10px;
    }

    .latest-posts>* {
        margin-bottom: 10px;
    }

    .right {
        float: right;
    }

    .thumb-sm {
        width: 64px;
        height: 64px;
        border-radius: var(--card-radius);
    }

    .ptitle {
        font-weight: 600;
        font-size: 15px;
    }

    .pdate {
        font-weight: 300;
        font-size: 11px;
        color: #999;
    }

    .shadow-sm {
        box-shadow: 0 3px 3px #0000000d;
    }

    .bgcover {
        background-size: cover !important;
        background-position: center !important;
    }

    .square50 {
        width: 50px;
        height: 50px;
    }

    /* Tablets */
    @media (min-width: 800px) {

        html,
        .navbar,
        .bottom-nav,
        #pageloader,
        .rMaxW {
            max-width: 800px !important;
            margin: 0 auto !important;
        }

        .bottom-nav {
            border-radius: var(--base-radius) var(--base-radius) 0 0;
        }
    }

    @media (max-width: 800px) {

        :root {
            --base-gap: 18px;
            --base-radius: 18px;
        }

        body {
            padding: 0;
        }

        body .base-content {
            border-radius: 0;
        }
    }

    /* Desktop */
    @media (max-width: 1200px) {
        .sidebar {
            display: none !important;
        }

        body .base-content {
            width: 100%;
            padding-bottom: 200px !important;
        }
    }

    @media (min-width: 1200px) {

        .navbar>.icon {
            display: none;
        }

        html,
        .navbar,
        .bottom-nav,
        #pageloader,
        .rMaxW {
            max-width: 1200px !important;
            margin: 0 auto !important;
        }

        .sidebar {
            position: sticky;
            top: var(--base-gap);
            float: right;
            width: var(--sidebar-w);
            /* min-height: 600px; */
            background: #fff;
            height: calc(100vh - ((var(--base-gap)) * 2));
            border-radius: var(--base-radius);
            overflow: hidden;
            padding: calc(var(--base-gap) / 2);
            display: flex;
            flex-direction: column;
        }

        .sidebar a.homelink {
            display: flex !important;
            flex-direction: column;
            align-items: center;
            text-align: center;
            font-weight: 800;
            font-size: 20px;
            margin-bottom: var(--base-gap);
            gap: 0;
            line-height: 1.75;
            padding: calc(var(--base-gap) / 2);
        }

        .sidebar a.homelink small {
            font-weight: 400;
            font-size: 14px;
            opacity: .5;
        }

        .sidebar a.homelink img {
            width: 70px;
            display: inline-block;
            vertical-align: middle;
            margin-bottom: 8px;
        }

        .sidebar .sidelinks {
            display: flex;
            flex-direction: column;
            width: 100%;
            background: #ffffff;
            gap: calc(var(--base-gap) / 5);
            flex: 1;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            gap: calc(var(--base-gap) / 2);
            padding: 5px calc(var(--base-gap) / 2);
            font-size: 16px;
            font-weight: 500;
            border-radius: var(--card-radius);
            position: relative;
        }

        .sidebar a:hover {
            background: #f7f7f7;
        }

        .sidebar a.active {
            background: var(--primary-30);
        }

        .sidebar a.active:before {
            position: absolute;
            content: "";
            right: 0;
            top: 20%;
            bottom: 20%;
            background: var(--primary);
            width: 6px;
            border-radius: 3px 0 0 3px;
        }

        .sidebar a.active i {
            opacity: 1;
            font-weight: 900;
        }

        .sidebar a i {
            vertical-align: middle;
            font-size: 18px;
            opacity: .35;
            width: 18px;
            height: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .bottom-nav {
            display: none
        }
    }

    h2.pay-title {
        text-align: center !important;
        font-size: 24px !important;
        font-weight: 600 !important;
        margin-bottom: 20px;
    }

    .heading {
        margin-top: 20px;
        color: rgba(0, 0, 0, 0.15);
        font-size: 18px;
    }

    .swiper {
        margin-right: inherit;
    }

    .swiper-pagination-bullets {
        display: flex;
        width: fit-content !important;
        margin: auto;
        right: 0;
        bottom: 20px !important;
        padding: 10px;
        background: rgba(0, 0, 0, .4);
        border-radius: var(--card-radius);
    }

    .m-0 {
        margin: 0;
    }

    .w-50 {
        width: 50%;
    }

    /* card-simple */
    .card-simple {
        display: flex;
        flex-direction: column;
        align-items: stretch;
        background: white;
        border-radius: var(--base-radius);
        padding: calc(var(--base-padding) * 1.5) var(--base-padding);
        gap: var(--base-gap);
    }

    .card-simple .icon {
        font-size: 54px;
        color: var(--primary);
    }

    .card-simple .title {
        font-size: 20px;
        line-height: 36px;
        font-weight: 800;
    }

    /* card-type-a */
    .card-type-a {
        width: 100%;
        display: flex;
        position: relative;
        border-radius: var(--card-radius);
        overflow: hidden;
        padding-bottom: var(--aspect-ratio);
    }

    .card-type-a:before {
        position: absolute;
        content: "";
        inset: 0;
        background: rgb(0, 0, 0);
        opacity: .2;
        z-index: 2;
        transition: all ease-in-out .15s;
    }

    .card-type-a .hover-show-btn {
        position: absolute;
        left: 15px;
        top: 15px;
        opacity: 0;
        z-index: 4;
        transform: scale(.75);
        transform-origin: top left;
    }

    .card-type-a .img {
        position: absolute;
        inset: 0;
        object-fit: cover;
        margin: 0;
        width: 100%;
        height: 100%;
        background-position: center;
        border-radius: 0;
        z-index: 1;
    }

    .card-type-a .overlay {
        display: flex;
        flex-direction: column;
        justify-content: end;
        align-items: center;
        padding: 30px;
        inset: 0;
        text-align: center;
        z-index: 3;
        position: absolute;
        background: linear-gradient(0deg, #000, transparent 100%, rgba(0, 0, 0, 0.4) 100%);
        color: white;
        transition: all ease-in-out .15s;
    }

    a.card-type-a:hover:before {
        opacity: .5;
    }

    a.card-type-a:hover .hover-show-btn {
        opacity: 1;
    }

    a.card-type-a:hover .hover-show-btn:hover {
        opacity: .75;
    }

    a.card-type-a:hover .overlay {
        padding-bottom: 40px;
    }

    .card-type-a .title {
        font-weight: 800;
        font-size: 20px;
        line-height: 1.75;
    }

    .card-type-a .subtitle {
        font-weight: 500;
        font-size: 13px;
        opacity: .5;
        color: white;
    }

    .card-type-a .subtitle.lg {
        font-weight: 500;
        font-size: 16px;
    }

    .card-type-a .absolute {
        position: absolute;
        top: 15px;
        z-index: 4;
    }

    .card-type-a .absolute-l {
        left: 15px;
    }

    /* card-info */
    .card-info {
        display: flex;
        position: relative;
        flex-direction: column;
        background-color: white;
        padding: 10px 20px;
        height: 80px;
        border-radius: var(--card-radius);
        line-height: 30px;
    }

    .card-info .title {
        font-weight: 700;
        font-size: 16px;
        position: relative;
        z-index: 1;
    }

    .card-info .subtitle {
        font-weight: 400;
        font-size: 14px;
        position: relative;
        z-index: 1;
    }

    .card-info .icon {
        font-size: 50px;
        position: absolute;
        left: 20px;
        top: calc(50% - 25px);
        color: var(--primary-15);
    }

    @media (max-width: 576px) {

        .card-info .icon {
            font-size: 36px;
            top: calc(50% - 18px);
        }
    }

    /* card-micro */
    .card-micro {
        display: flex;
        align-items: center;
        background-color: #fff;
        padding: 10px;
        border-radius: var(--card-radius);
        gap: 20px;
        --card-icon: "\f1ea"
    }

    .card-micro .img {
        position: relative;
        border-radius: var(--card-radius);
        overflow: hidden;
    }

    .card-micro .img:before {
        position: absolute;
        content: "";
        inset: 0;
        background: var(--primary);
        opacity: 0;
        transition: all ease-in-out .1s;
    }

    .card-micro .img:after {
        position: absolute;
        content: var(--card-icon);
        inset: 0;
        opacity: 0;
        transition: all ease-in-out .1s;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 400;
        font-family: "Font Awesome 6 Pro";
        font-size: 24px;
    }

    .card-micro .content {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .card-micro .title {
        font-size: 16px;
        font-weight: 700;
        line-height: 1.75;
        transition: all ease-in-out .1s;
    }

    .card-micro .microtitle {
        font-size: 12px;
        opacity: .5;
        line-height: 1;
    }

    a.card-micro:hover .title {
        color: var(--primary);
    }

    a.card-micro:hover .img:before {
        opacity: .65;
    }

    a.card-micro:hover .img:after {
        opacity: 1;
    }

    .opacity-100 {
        opacity: 1 !important;
    }

    .opacity-75 {
        opacity: .75 !important;
    }

    .opacity-50 {
        opacity: .5 !important;
    }

    .avatar-big {
        position: relative;
        border-radius: 50%;
        border: solid 6px white;
        width: fit-content !important;
        box-shadow: 0 0 10px rgba(0, 0, 0, .1);
    }

    .avatar-big img {
        border-radius: 50%;
        margin: 0;
    }

    .mx-auto {
        margin-right: auto;
        margin-left: auto;
    }

    /* .bghead */
    .bghead {
        display: flex;
        flex-direction: column;
        justify-content: end;
        gap: calc(var(--base-gap) / 2);
        position: relative;
        padding: 200px var(--base-padding) calc(var(--base-padding) / 2) !important;
        background-size: cover !important;
        background: linear-gradient(0deg, var(--primary-70), rgba(0, 0, 0, 0.3)), var(--bg);
        color: white;
    }

    .bghead.sm {
        padding: 120px var(--base-padding) calc(var(--base-padding) / 2) !important;
    }

    .bghead.without-bg {
        background: linear-gradient(0deg, var(--primary-50), rgba(0, 0, 0, 0.4));
    }

    .bghead.filter-a {
        background: linear-gradient(0deg, var(--primary-70), var(--primary-50), rgba(0, 0, 0, 0.4));
    }

    .bghead.filter-a:after {
        background: var(--bg);
        position: absolute;
        content: "";
        inset: 0;
        background-size: cover;
        mix-blend-mode: luminosity;
        z-index: 1;
        opacity: .1;
    }

    .bghead.filter-b {
        background: var(--bg);
    }

    .bghead.filter-b:after {
        background: rgba(0,0,0,.6);
        position: absolute;
        content: "";
        inset: 0;
        z-index: 1;
    }

    .bghead:before {
        position: absolute;
        content: "";
        inset: 0;
        background: rgba(0, 0, 0, .4);
    }

    .bghead>* {
        position: relative;
        z-index: 2;
    }

    .bghead .title {
        font-size: 28px;
        font-weight: 700;
    }

    .bghead .subtitle {
        font-size: 16px;
        font-weight: 500;
    }

    .bghead .icon {
        width: 60px;
        height: 60px;
    }

    .bghead.flex-center {
        align-items: center;
        text-align: center;
    }

    .bghead.padding-reverse {

        padding: calc(var(--base-padding) / 2) var(--base-padding) 200px !important;
    }

    .bghead.padding-reverse.sm {

        padding: calc(var(--base-padding) / 2) var(--base-padding) 120px !important;
    }

    @media (max-width: 800px) {
        .bghead {
            padding: 80px var(--base-padding) var(--base-padding) !important;
        }

        .bghead .title {
            font-size: 24px;
        }
    }

    .bghead .pbar {
        position: absolute;
        top: 20px;
        left: 20px;
    }

    /* .accordions */
    .accordions,
    .list-accordions {
        display: flex;
        flex-direction: column;
        align-items: stretch;
        gap: 5px;
    }

    .accordions .accordion,
    .list-accordions>* {
        border: 1px solid var(--primary-15) !important;
        border-radius: var(--card-radius) !important;
        padding: 0 12px;
        background-color: white;
    }

    .accordions .accordion:hover,
    .list-accordions>*:hover {
        border-color: var(--primary) !important;
        background: var(--primary-5);
    }

    .accordions .accordion:hover .picon,
    .list-accordions>*:hover .picon {
        color: var(--primary);
    }

    .accordions .accordion .header,
    .list-accordions>* {
        cursor: pointer;
        display: flex;
        align-items: center;
        padding: calc(var(--base-gutter) * .75) 0;
        transition: .05s, font-weight .2s ease-in-out;
        position: relative;
    }

    .list-accordions>* {
        padding: calc(var(--base-gutter) * .75) 12px;
    }

    .accordions .accordion .header:after,
    .list-accordions>*:after {
        font-family: "Font Awesome 6 Pro" !important;
        font-weight: 400;
        content: "\f053";
        color: var(--secondary-20);
        transition: all ease-in-out .05s;

    }

    .accordions .accordion .header .picon,
    .list-accordions>* .picon {
        font-size: 18px;
    }

    .accordions .accordion .header .time,
    .list-accordions>* .time {
        font-size: 11px;
        font-weight: 300;
        opacity: 0.7;
    }

    .accordions .accordion .header .copy {
        font-size: 11px;
        opacity: 0.5;
        padding: 7px 7px 7px 3px;
    }

    .accordions .accordion .header .copy:hover {
        opacity: 1;
    }

    .accordions .accordion .header {
        background: none !important;
        gap: 7px;
    }

    .list-accordions>* {
        gap: 7px;
    }

    .accordions .accordion .header:after,
    .list-accordions>*:after {
        margin-right: 10px;
        font-size: 12px;
    }

    .accordions .accordion .header .title,
    .list-accordions>* .title {
        font-size: 15px;
        font-weight: 400;
    }

    .accordions .accordion .header .bold,
    .list-accordions>* .bold {
        font-weight: 600;
    }

    .accordions .accordion .content {
        padding: 0 !important;
        position: relative;
        border-radius: var(--card-radius);
    }

    .accordions .accordion.expanded {
        z-index: 1;
        border-color: var(--primary-30) !important;
        background: var(--primary-15);
    }

    .accordions .accordion.expanded:not(.link) {
        padding: 0 12px 15px 12px;
    }

    .accordions .accordion .content {
        background: none !important;
    }

    .accordions .accordion .header .copy {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 7px;
        border-radius: 4px;
    }

    .accordions .accordion .header .copy i {
        font-size: 11px;
        opacity: 0.5;
    }

    .accordions .accordion .header .copy:hover {
        background: var(--primary-40);
    }

    .accordions .accordion .header .copy:hover i {
        opacity: 1;
    }

    .accordions.type-white .accordion.expanded {
        background: white;
    }

    .attachments {
        display: flex;
        flex-direction: column;
        align-items: stretch;
        gap: 10px;
        padding-top: var(--base-padding);
    }

    .attachments>* {
        width: 100%;
    }

    .font-base,
    span.fasl {
        font-family: var(--base-font-family);
    }

    /* list-simple */
    .list-simple {
        display: flex;
        flex-direction: column;
        align-items: stretch;
    }

    .list-simple>* {
        padding: 6px 0;
    }

    .list-simple>*,
    .list-simple .flex {
        font-size: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .list-simple .icon {
        font-size: 20px;
    }

    .list-simple .title {
        font-size: 15px;
    }

    .list-simple .subtitle {
        font-size: 12px;
    }

    .list-simple .bold {
        font-weight: 600;
    }

    .list-simple a:hover .icon {
        color: var(--primary);
    }

    .badge-light {
        display: flex;
        align-items: center;
        border-radius: var(--card-radius) !important;
        padding: 4px 14px !important;
        background: var(--primary-15);
        width: fit-content;
    }

    .flex-col {
        flex-direction: column;
    }

    .items-center {
        align-items: center;
    }

    .items-start {
        align-items: start;
    }

    .justify-start {
        justify-content: start;
    }

    .justify-center {
        justify-content: center;
    }

    .flex {
        display: flex;
    }

    .flex-wrap {
        flex-wrap: wrap;
    }

    .flex-grow-1 {
        flex-grow: 1;
    }

    .gap-base {
        gap: var(--base-gap);
    }

    .gap-base-half {
        gap: calc(var(--base-gap) / 2);
    }

    .text-primary {
        color: var(--primary);
    }

    .flex-1 {
        flex: 1;
    }

    .w-20 {
        width: 20%;
    }

    .playerbox {
        background: var(--primary-20);
        position:relative;
        overflow:hidden;
    }
    .ext {
        color: #ffffff;
        padding: 2px 7px;
        border: 0;
        border-radius: 3px;
    }
    .ext.pdf {
        background: #ee232b;
    }
    .ext.ppt,.ext.ppsx,.ext.pptx {
        background: #d78b03;
    }
    .ext.xls,.ext.xlsx{
        background: #178048;
    }
    .ext.doc,.ext.docx {
        background: #1f5fbf;
    }
    .ext.zip,.ext.rar {
        background: #680579;
    }
    .ext.png,.ext.gif,.ext.jpg,.ext.svg {
        background: #df487c;
    }
    .ext.txt,.ext.md {
        background: #777777;
    }
    .atlink i{
        margin-left: 5px;
    }
</style>