<style>
    button:hover,
    .btn:hover {
        opacity: 0.8;
        background: var(--primary) !important;
        border-color: var(--primary) !important;
    }

    .card-product .title {
        font-size: 22px;
        padding-bottom: 8px;
    }

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

    .accordions .accordion .header .picon {
        font-size: 18px;
    }

    .completed .picon {
        color: var(--primary);
    }

    .accordions .accordion .header .time {
        font-size: 11px;
        font-weight: 300;
        opacity: 0.7;
    }

    .accordions .accordion .header {
        background: none !important;
        gap: 7px;
    }

    .accordions .accordion .header:after {
        margin-right: 10px;
        font-size: 12px;
    }

    .accordions .accordion .content {
        padding: 0 !important;
    }

    .accordions {
        margin-top: 10px;
    }

    .accordions .accordion {
        border: 1px solid #e7e7e7 !important;
        border-radius: 5px;
        border-top-right-radius: 5px !important;
        border-top-left-radius: 5px !important;
        padding: 0 12px;
        background-color: var(--primary-1);
        margin-bottom: 5px;
    }

    .accordions .accordion.expanded {
        z-index: 1;
        border: 0 !important;
        background: none;
        padding: 0;
    }

    .accordions .accordion .content {
        background: none !important;
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


    .signal-box {
        display: flex;
        flex-direction: row-reverse;
        align-items: center;
        padding: 30px 0 10px 0;
        margin: -20px 0 0 0;
        font-size: 14px;
        border-radius: 15px;
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

    .signal-box button {
        padding: 0px 20px;
        border-radius: 7px;
        font-size: 14px;
    }

    .attachments {
        padding: 10px 0;
    }

    a.atlink small {
        display: inline-block;
        font-size: 10px;
        background: var(--primary);
        color: #fff;
        padding: 0 7px !important;
        line-height: 18px;
        border-radius: 3px;
        vertical-align: middle;
        opacity: 0.9;
    }
    a.atlink:hover small {
        opacity: 1;
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

    a.atlink i {
        font-style: normal;
        margin-left: 5px;
    }

    a.atlink {
        display: flex;
        background: #fff;
        border-radius: 5px;
        margin: 5px auto;
        padding: 5px 15px;
        font-size: 14px;
    }

    a.atlink .size {
        font-size: 9px;
    }

    .bghead {
        position: relative;
        align-items: center;
        box-shadow: none;
        min-height: 100%;
        padding-top: 40px !important;
        padding-bottom: 100px !important;
        background-size: cover !important;
        background: linear-gradient(0deg, var(--primary-50), rgba(255, 255, 255, 1));
    }

    /* .bghead{
            padding-top: 160px !important;
            padding-bottom: 30px !important;
            background-size: cover !important;
            background: linear-gradient(0deg, #f3f3f3, rgba(0,0,0,0.3)), url(<?= $course['banner']['url'] ?? '' ?>);
        } */

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
        padding: 20px 20px 30px 20px;
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
        border:1px solid #f7f7f7;
        padding: 10px 15px;
        border-radius: 5px;
        margin-top: 10px;
        font-size: 20px;
    }
    .overlay-panel .erow:hover{
        cursor: pointer;
        background-color: #f2f2f2;
        border:1px solid #ccc;
    }

    .longtextwrap *{
        line-height: 32px;
    }
    .longtextwrap{
        padding: 10px !important;
    }
</style>