<style>
    .cookies {
        display: flex;
        justify-content: center;
    }

    .wrapper-two {
        position: fixed;
        bottom: 10px;
        width: 98%;
        background: #fff;
        padding: 20px;
        border-radius: 15px;
        box-shadow: 10px 10px 10px 10px rgba(0, 0, 0, 0.15);
        text-align: center;
        z-index: 999;
    }

    .wrapper-two.hide {
        opacity: 0;
        pointer-events: none;
        transform: scale(0.8);
        transition: all 0.3s ease;
    }

    ::selection {
        color: #fff;
        background: #FCBA7F;
    }

    .wrapper-two img {
        width: 46px;
        margin-right: 15px;
    }

    .content {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-wrap: wrap;
        width: 100%;
    }

    .content header {
        font-size: 26px;
        font-weight: 600;
        color: #1a1a1a;
        margin-right: 10px;
    }

    .content p {
        font-size: 14px;
        font-weight: 400;
        color: #1a1a1a;
        margin-top: 20px;
    }

    .content .buttons {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 5px;
    }

    .buttons button {
        padding: 10px 20px;
        border: none;
        outline: none;
        color: #fff;
        font-size: 16px;
        font-weight: 500;
        border-radius: 5px;
        background: #0ec6d5;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .buttons button:hover {
        transform: scale(0.97);
    }

    .buttons .item {
        margin: 0 10px;
    }

    .buttons a {
        color: #0ec6d5;
    }

    .close {
        position: absolute;
        color: #ffffff;
        top: 10px;
        right: 15px;
        cursor: pointer;
    }

    @media screen and (max-width: 1000px) {
        .content header {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            line-height: 2rem;
            margin-top: 10px;
            margin-right: 0px;
        }

        .content p {
            display: flex;
            justify-content: center;
            width: 100%;
            margin-top: 10px;
        }

        .buttons {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
        }

        .buttons a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
        }

    }
</style>
<div class="cookies">
    <div class="wrapper-two bg-secondary" id="cookies">
        <div class="close" onclick="closeCookies()">
            <i class="fas fa-times"></i>
        </div>
        <div class="content">
            <header class="text-white"> Home ID </header>
            <p class="text-white mr-2">ใช้คุกกี้เพื่อให้แน่ใจว่าคุณได้รับประสบการณ์ที่ดีที่สุดบนเว็บไซต์ของเรา</p>
            <div class="buttons">
                <a class="mr-2" href="<?php echo $linkcook ?>" class="item"> นโยบายการใช้คุกกี้ </a>
                <p class="text-white" style="margin-top: 15px;"> และ </p>
                <a href="<?php echo $linkpri ?>" class="item"> นโยบายความเป็นส่วนตัว </a>
                <button class="item"> ยินยอม </button>
            </div>
        </div>
    </div>

</div>


<script>
    const cookieBox = document.querySelector(".wrapper-two"),
        acceptBtn = cookieBox.querySelector("button");

    acceptBtn.onclick = () => {
        //ตั้งค่าคุกกี้เป็นเวลา 1 เดือน หลังจากหนึ่งเดือนจะหมดอายุโดยอัตโนมัติ
        document.cookie = "CookieBy=Accept01; max-age=" + 60 * 60 * 24 * 30;
        if (document.cookie) { //ถ้าคุกกี้ถูกตั้งค่า
            cookieBox.classList.add("hide"); //ซ่อนกล่องคุกกี้
        } else { //หากไม่ได้ตั้งค่าคุกกี้ให้แจ้งเตือนข้อผิดพลาด
            alert("Cookie can't be set! Please unblock this site from the cookie setting of your browser.");
        }
    }
    let checkCookie = document.cookie.indexOf("CookieBy=Accept01"); //ตรวจสอบคุกกี้ของเรา
    //หากตั้งค่าคุกกี้แล้วซ่อนกล่องคุกกี้อื่นให้แสดง
    checkCookie != -1 ? cookieBox.classList.add("hide") : cookieBox.classList.remove("hide");

    function closeCookies() {
        document.getElementById("cookies").style.left = "-500px";
        document.getElementById("cookies").style.display = "none";
    }
</script>