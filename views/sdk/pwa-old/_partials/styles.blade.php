<style>
    body {
        max-width: 100%;
        background: var(--primary);
        box-shadow: 0 0 50px #00000037;
    }

    body .base-content {
        background: #f3f3f3;
    }

    .navbar {
        box-shadow: 0 3px 3px #0000000d;
        background: #fff;
        flex-direction: row;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 99999 !important;
    }

    .navgap {
        height: 70px;
    }

    .navbar .navlogo {
        min-width: 60%;
    }
    .navbar .navlogo>img {
        display: inline-block;
        max-height: 36px;
        vertical-align: middle;
    }

    .navbar .navlogo>span {
        font-size: 16px;
        line-height: 34px;
        font-weight: 700;
        margin-right: 5px;
    }

    .h100 {
        height: 100px;
    }

    .h200 {
        height: 200px;
    }


    .wpad {
        padding-left: 5% !important;
        padding-right: 5% !important;
    }

    .tpad5 {
        padding-top: 5px !important;
    }

    .tpad10 {
        padding-top: 10px !important;
    }

    .tpad20 {
        padding-top: 20px;
    }

    .title-row {
        display: flex;
        justify-content: space-between;
        margin: 16px 0 0 0;
    }

    .title-row .title {
        font-size: 16px;
        margin-right: 3px;
        font-weight: 500;
        color: #333;
    }

    .title-row .stat {
        font-size: 14px;
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
        border-radius: 20px 20px 0 0;
        flex-direction: row-reverse;
        z-index: 99999;
    }

    .bottom-nav>a:first-child {
        border-radius: 20px 0 0 0;
    }

    .bottom-nav>a:last-child {
        border-radius: 0 20px 0 0;
    }

    .bottom-nav a.active,.sidebar a.active {
        color: var(--primary);
    }

    .bottom-nav>a {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        width: 100%;
        font-size: 24px;
        color: #333;
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

    button:hover,
    .btn:hover {
        opacity: 0.8;
        background: var(--primary) !important;
        border-color: var(--primary) !important;
    }

    .card-product.my-course {
        padding: 20px 20px 20px 12px;
        border: 1px solid #ccc !important;
        background-position: center !important;
    }

    .card-product {
        border-radius: 10px;
        margin: 7px 0;
        padding: 12px 16px 12px 5px;
        background-size: cover !important;
        background: linear-gradient(180deg, var(--primary-50), rgb(255 255 255 / 70%));
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
        font-size: 14px;
        line-height: 28px;
        text-align: justify;
        margin: 10px 0 0 0;
    }

    .longtext *,.alltext * {
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
        display: block;
        margin: 2px auto 0 auto !important;
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

    .waiting>.loader {
        position: absolute;
        top: 30px;
        left: 45%;
    }

    .loader {
        width: 48px;
        height: 48px;
        border: 3px dotted #777;
        border-style: solid solid dotted dotted;
        border-radius: 50%;
        display: block;
        margin: 0 auto;
        position: relative;
        box-sizing: border-box;
        animation: rotation 2s linear infinite;
        z-index: 99999;
    }

    .loader::after {
        content: '';
        box-sizing: border-box;
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        margin: auto;
        border: 3px dotted var(--primary);
        border-style: solid solid dotted;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        animation: rotationBack 1s linear infinite;
        transform-origin: center center;
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
        left: 7px;
        top: 16px;
        color: #777;
        background: #f1f1f1;
        padding: 5px 15px !important;
        height: 40px;
        line-height: 30px;
        border-radius: 10px;
    }

    .findwrap .inbtn {
        left: 7% !important;
        top: 27px !important;
        padding: 5px 10px 5px 15px !important;
    }

    .findwrap small i {
        vertical-align: middle;
        margin-right: 5px;
    }

    input#find {
        margin-top: 10px;
        margin-bottom: 5px;
        border-radius: 10px !important;
    }

    input#find::placeholder {
        font-weight: 300;
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

    .stats-row i {
        margin-left: 3px;
    }

    .stats-row {
        display: flex;
        justify-content: space-between;
        font-size: 13px;
        font-weight: 300;
        padding: 5px 20px;
        background-color: #f7f7f7;
        color: #555;
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
        justify-content: space-between;
        gap: 1%;
        margin-top: 10px;
    }

    .content-footer i {
        padding-left: 5px;
    }

    .content-footer a {
        background-color: rgba(255, 255, 255, 0.7);
        width: 96%;
        text-align: center;
        padding: 5px;
    }

    img {
        max-width: 100%;
        margin: 10px auto;
        border-radius: 10px;
    }

    .latest-posts {
        margin: 5px;
    }

    .latest-posts .card-post {
        display: flex;
        background-color: #fff;
        margin: 15px 0;
        padding: 10px;
        min-height: 80px;
        border-radius: 7px;
    }

    .latest-posts .card-post::after {
        content: "";
        clear: both;
        display: table;
    }

    .right {
        float: right;
    }

    .thumb-sm {
        width: 64px;
        height: 64px;
        border-radius: 5px;
        margin-left: 10px;
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
    }

    /* Desktop */
    @media (max-width: 1200px) {
        .sidebar {
            display: none
        }
    }

    @media (min-width: 1000px) {

        html,
        .navbar,
        .bottom-nav,
        #pageloader,
        .rMaxW {
            max-width: 1200px !important;
            margin: 0 auto !important;
        }

        .sidebar {
            float: right;
            padding-top: 80px;
            width: 240px;
            /* min-height: 600px; */
            background: #fff;
        }

        a.homelink {
            margin: -37px 0px -3px;
        }

        .sidebar a.homelink img {
            width: 24px;
            display: inline-block;
            vertical-align: middle;
            margin: 0 0 0 2px;
        }
        .sidebar .sidelinks {
            position: fixed;
            display: flex;
            flex-direction: column;
            width: 240px;
            min-height: 100%;
            padding: 65px 0 0 0;
            background: #ffffff;
            bottom: 0;
        }

        .sidebar a {
            display: block;
            padding: 7px 25px;
            font-size: 17px;
            border-bottom: 1px solid #f7f7f7;
        }
        .sidebar a:hover {
            background: #f7f7f7;
        }
        .sidebar a i {
            padding-left: 10px;
            vertical-align: middle;
            font-size: 18px;
        }

        .bottom-nav {
            display: none
        }
    }
    h2.pay-title{
        text-align:center !important;
        font-size:24px !important;
        font-weight:600 !important;
        margin-bottom:20px;
    }
    .heading {
        margin-top: 20px;
        color: rgba(0, 0, 0, 0.15);
        font-size: 18px;
    }
</style>
