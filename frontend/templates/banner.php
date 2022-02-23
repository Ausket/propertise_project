<style>
    .box-one {
        margin-top: 36px;
    }

    .text-gradient {
        font-size: 48px;
        background: linear-gradient(to right, #1e1d85, #0ec6d5);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .text-all {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        flex-wrap: wrap;
        margin-top: 40px;
    }

    .text-one {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        width: 100%;
        font-size: 18px;
        line-height: 3rem;
        color: #444444;
    }

    .itext {
        font-size: 36px;
        color: #1e1d85;
        margin-right: 10px;
    }

    .slider {
        display: flex;
        align-items: center;
        width: 100%;
    }

    .slider:hover .owl-prev,
    .slider:hover .owl-next {
        display: unset;
    }

    .card-two {
        width: 98%;
        height: 350px;
        border: none;
    }

    .img-one {
        height: 350px;
        border: none;
        border-radius: 15px;
    }

    .wrapper {
        width: 100%;
    }

    .wrapper .carousel {
        width: 100%;
        position: relative;
        margin: auto;
    }

    .owl-prev,
    .owl-next {
        display: none;
        position: absolute;
        top: 45%;
        transform: translate(-50%, -50%);
    }

    .owl-prev {
        left: 20px;
    }

    .owl-next {
        right: -20px;
    }

    .fa-chevron-left,
    .fa-chevron-right {
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        color: #808080;
        background-color: #ffffff;
        padding: 20px 14px;
        border: none;
        transition: all 0.2s;
    }

    .fa-chevron-left:hover,
    .fa-chevron-right:hover {
        color: #ffffff;
        background-color: #1ea69e;
        transition: .2s;
    }

    @media screen and (max-width: 1000px) {
        .row {
            display: flex !important;
            align-items: center !important;
            flex-wrap: wrap !important;
            width: 100% !important;
        }

        .box-one {
            display: flex !important;
            flex-wrap: wrap;
            width: 100% !important;
            flex: none;
            max-width: none;
            margin-top: 0px;
        }

        .box-two {
            display: flex !important;
            flex-wrap: wrap;
            width: 100% !important;
            flex: none;
            max-width: none;
            margin: 30px 10px;
        }

        .card-two {
            height: 180px;
        }

        .img-one {
            width: 100%;
            height: 180px;
        }

        .text-gradient {
            width: 100%;
        }
    }
</style>
<div class="row">
    <div class="col-5 box-one">
        <h1><span class="text-gradient"> ทำไมต้องโฆษณากับเรา ? </span></h1>
        <div class="text-all fs-18 text-dark font-weight-400 ">
            Home ID ตอบโจทย์ความต้องการเช่า-ขาย อสังหาฯ โฆษณากับเรา ช่วยให้คุณประหยัดงบประมาณการทำการตลาด ไม่ต้องสร้างเว็บไซต์โฆษณาขายเอง ลูกค้าดูเว็บไวต์เยอะ หาบ้านที่คุณต้องการขายเจอง่ายๆ รอรับสายลูกค้าที่บ้านได้เลย ประหยัด คุ้ม ดี ที่นี่ Home ID เพื่อนคู่คิด ธุรกิจอสังหาฯ
        </div>
    </div>
    <div class="col-7 box-two">
        <div class="slider">
            <div class="wrapper">
                <div class="carousel owl-carousel">
                    <div class="card-two" id="c1">
                        <img class="img-one" src="images/new0.png" alt="">
                    </div>
                    <div class="card-two" id="c2">
                        <img class="img-one" src="images/new1.png" alt="">
                    </div>
                    <div class="card-two" id="c3">
                        <img class="img-one" src="images/new2.png" alt="">
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(".carousel").owlCarousel({
                loop: true,
                autoplay: true,
                autoplayTimeout: 8000,
                autoplayHoverPause: true,
                nav: true,
                navText: ["<i class='fas fa-chevron-left'></i>", "<i class='fas fa-chevron-right'></i>"],
                responsive: {
                    0: {
                        items: 1.1,
                    },
                }
            })
        </script>
    </div>
</div>