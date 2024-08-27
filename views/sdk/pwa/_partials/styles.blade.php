<style>
    body{
        max-width: 100%;
    }
    body .base-content{
        background: #f3f3f3;
    }
    @media (min-width: 900px) {
        html,.navbar,.bottom-nav,#pageloader {
            max-width: 800px !important;
            margin:0 auto !important;
        }
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
    .navgap{
        height:70px;
    }
    .navbar .navlogo {
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

    .h100{
        height: 100px;
    }
    .h200{
        height: 200px;
    }
    

    .wpad{
        padding-left: 5%;
        padding-right: 5%;
    }
    .tpad5{
        padding-top:5px;
    }
    .tpad10{
        padding-top:10px;
    }
    .tpad20{
        padding-top:20px;
    }

    .title-row{
        display: flex;
        justify-content: space-between;
        margin: 16px 0 0 0;
    }
    .title-row .title{
        font-size: 16px;
        margin-right: 3px;
        font-weight: 500;
        color: #333;
    }
    .title-row .stat{
        font-size: 14px;
        color: #777;
        margin-left: 5px;
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

    .bottom-nav > a:first-child {
        border-radius: 20px 0 0 0;
    }
    .bottom-nav > a:last-child {
        border-radius: 0 20px 0 0;
    }

    .bottom-nav > a.active {
        color:var(--primary);
    }
    .bottom-nav > a {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        width: 100%;
        font-size: 24px;
        color: #333;
    }
    .bottom-nav > a:hover {
        background: #f7f7f7;
    }

    .bottom-nav > a > i {
        font-size: 20px;
    }
    
    .bottom-nav > a > span {
        font-size: 10px;
        height: 20px;
        color:#777;
    }

    button:hover, .btn:hover {
            opacity: 0.8;
            background: var(--primary) !important;
            border-color: var(--primary) !important;
        }
        .card-product {
            border: 1px solid var(--primary-70) !important;
            border-radius: 10px;
            margin: 7px 0;
            padding: 12px 16px 12px 5px;
            background-size: cover !important;
            background: linear-gradient(180deg, var(--primary-50), rgb(255 255 255 / 70%));
        }
        .card-product:hover {
            background: linear-gradient(180deg, var(--primary-50), rgb(255 255 255 / 70%)) !important;
            opacity: 0.8;
        }

        .card-product .content .icon {
            margin-top: 7px;
        }
        .card-product .content {
            align-items: flex-start;
        }


        .card-product .progress-circle{
            height: 32px;
        }
        .progress{
            text-align: center;
            font-size: 9px;
            padding-left: 11px;
            line-height: 13px;
        }
        .progress span{
            z-index: 99999;
            position: absolute;
            text-align: center;
            color:var(--primary-50);
        }
        .cpbadge{
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

    .longtext , .alltext{
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
        color:var(--primary);
        position: absolute;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .waiting>.loader {
        position: absolute;
        top: 30px;
        left:45%;
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


    #pageloader{
        display: none;
        justify-content: center;
        align-items: center;
        position: fixed;
        background: rgba(255,255,255,0.95);
        left:0;
        right:0;
        top:0;
        bottom:0;
        flex-direction: column;
        z-index: 999;
    }
    
    #pageloader div{
        color: #333;
        font-size: 16px;
    }
    #pageloader img{
        max-width: 64px;
        animation: opa37 1s infinite ease-in-out;
        margin-bottom: 30px;
    }
    #pageloader.show{
        display: flex;
    }
    @keyframes opa37 {
        0% {
            /* transform: scale(1); */
            opacity:1;
        }
        50% {
            /* transform: scale(1.1); */
            opacity:0.37; 

        }
        100% { 
            /* transform: scale(1); */
            opacity:1;

        }
    }
</style>



<script>
    // add service worker
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', function() {
            navigator.serviceWorker.register('/service-worker.js')
                .then(function(registration) {
                    console.log('Service Worker registered:', registration.scope);
                }, function(error) {
                    console.log('Service Worker failed:', error);
                });
        });
    }
    function typeWriter(text, elementId, speed) {
        let i = 0;
        const element = document.getElementById(elementId);
        if(element.innerHTML.length > 0)
            return;
        element.innerHTML = "";
        function type() {
            if (i < text.length) {
            element.innerHTML += text.charAt(i++);
            setTimeout(type, speed);
            }
        }
        type();
    }

</script>
