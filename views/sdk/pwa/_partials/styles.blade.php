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

</style>
