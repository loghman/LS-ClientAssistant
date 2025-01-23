<style>
    .progress {
        text-align: center;
        font-size: 11px;
        padding-left: 11px;
        line-height: 20px;
        height: 20px;
        margin-left: 15px;
        width: 100%;
    }

    .progress span {
        z-index: 99999;
        position: absolute;
        text-align: center;
        color: var(--primary-50);
    }

    .fasl {
        color: var(--primary);
    }

    .truncate {
        width: 320px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .completed .picon {
        color: var(--primary);
    }

    .playerbox {
        max-width: 100%;
        position: relative;
        width: 100%;
        padding-top: 56.25%;
        height: 0;
        overflow: hidden;
        z-index: 5;
    }

    .playerbox::after {
        content: 'کمی صبر کنید ...';
        position: absolute;
        top: 50%;
        left: 50%;
        color: var(--primary-70);
        font-size: 18px;
        transform: translate(-50%, -50%);
    }

    .playerbox iframe,
    .playerbox video {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: 0;
        z-index: 50;
        border-radius: 10px;
    }
    .nextitem:hover {
        background: var(--primary-15);
    }

    .nextitem {
        display: flex;
        flex-direction: column;
        line-height: 1.7;
        margin: 10px 0;
        background: #fff;
        border:1px solid var(--primary-20);
        padding: 12px 17px;
        border-radius: 10px;
        min-width: 40%;
    }
    .nextitem small {
        color:var(--primary-90);
        font-size: 14px;
        padding-bottom:5px;
    }
    .nextitem span {}

    @media (max-width:640px) {
        .signal-box {
            display: block;
            text-align: right;
        }
        .nextitem {
            margin-top:10px;
        }
        .signal-box>* {
            width: 100%;
        }
    }

    .overlay{
        display: none;
        position: fixed;
        background-color: rgba(0,0,0,0.9);
        left:0;
        right:0;
        top:0;
        bottom:0;
        overflow-y: scroll;
        z-index: 9999999;
    }
    .overlay .close{
        float: left;
        font-size: 20px;
        cursor: pointer;
        color: #777;
        padding: 0 7px;
    }
    .overlay .close:hover{
        color: #333;
    }

    .overlay-panel{
        background-color: rgba(255,255,255);
        margin: 7%;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 64px -20px #ffffff;
    }
    @media screen and (min-width:800px) {
        .overlay-panel{
            max-width: 50%;
            margin: 7% auto;
        }
    }
    .overlay-panel .erow i{
        font-size: 24px;
        vertical-align: -4px;
        margin-left: 5px;
    }
    .overlay-panel .erow{
        display: block;
        background-color: #f7f7f7;
        padding: 10px 15px;
        border-radius: var(--card-radius);
        margin-top: 10px;
        font-size: 20px;
        transition: all ease-in-out .1s;
    }
    .overlay-panel .erow:hover{
        cursor: pointer;
        background-color:rgb(235, 235, 235);
    }

    .longtextwrap *{
        line-height: 32px;
    }
    .longtextwrap{
        padding: 10px !important;
    }
</style>