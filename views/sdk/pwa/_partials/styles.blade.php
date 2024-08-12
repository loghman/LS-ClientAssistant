<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<style>
    body{
        max-width: 100%;
    }
    .bottom-nav {
        display: flex;
        position: fixed;
        justify-content: space-around;
        background: #ffffff;
        bottom: 0;
        height: 70px;
        width: 100%;
        max-width: 100%;
        box-shadow: 0px -20px 50px rgba(0, 0, 0, 0.17);
        border-radius: 20px 20px 0 0;
        flex-direction: row-reverse;
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
        justify-content: center;
        align-items: center;
        width: 100%;
        font-size: 24px;
        color: #333;
    }
    .bottom-nav > a:hover {
        background: #f7f7f7;
    }

    .bottom-nav > a > img {
        width: 30px;
    }

</style>