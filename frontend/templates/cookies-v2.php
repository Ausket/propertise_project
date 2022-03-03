<style>
    .wrapper-two {
        position: fixed;
        bottom: 30px;
        left: 30px;
        max-width: 365px;
        background: #fff;
        padding: 25px 25px 30px 25px;
        border-radius: 15px;
        box-shadow: 1px 7px 14px -5px rgba(0, 0, 0, 0.15);
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
        max-width: 90px;
    }

    .content header {
        font-size: 25px;
        font-weight: 600;
    }

    .content {
        margin-top: 10px;
    }

    .content p {
        color: #858585;
        margin: 5px 0 20px 0;
    }

    .content .buttons {
        display: flex;
        align-items: center;
        justify-content: center;
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
</style>

<div class="wrapper-two" id="cookies">
    <img src="images/cookie.png">
    <div class="content">
        <header> Home ID </header>
        <p>ใช้คุกกี้เพื่อให้แน่ใจว่าคุณได้รับประสบการณ์ที่ดีที่สุดบนเว็บไซต์ของเรา</p>
        <div class="buttons">
            <button class="item">ยอมรับ</button>
            <a href="#" class="item">อ่านเพิ่มเติม</a>
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
</script>