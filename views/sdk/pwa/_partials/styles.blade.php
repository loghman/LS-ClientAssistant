<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<style>
    body{
        max-width: 100%;
    }
    .h100{
        height: 100px;
    }
    .h200{
        height: 200px;
    }
    
    .navbar {
        background: #fff;
        flex-direction: row;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 99999 !important;
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
        box-shadow: 0px -20px 50px rgba(0, 0, 0, 0.17);
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
        background: rgba(255, 255, 255, 0.7);
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
        margin: 8px auto;
        right: 17px;
    }
    
    .loader {
        width: 48px;
        height: 48px;
        border: 3px dotted #777;
        border-style: solid solid dotted dotted;
        border-radius: 50%;
        display: block;
        margin: 20px auto;
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
}

</style>



<script>
    // add service worker
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', function() {
            navigator.serviceWorker.register('/service-worker.js')
                .then(function(registration) {
                    console.log('Service Worker registered with scope:', registration.scope);
                }, function(error) {
                    console.log('Service Worker registration failed:', error);
                });
        });
    }
</script>