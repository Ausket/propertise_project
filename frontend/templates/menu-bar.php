<style>
    .background-gradient {
        transition: all 200ms linear 0ms !important;
        background-size: 200%, 1px !important;
        background-image: linear-gradient(90deg,
                #20fdee 0%,
                #0478e9 50%,
                #20fdee) !important;
    }

    .background-gradient:hover {
        background-position: 110% !important;
    }

    .background-gradient-org {
        transition: all 200ms linear 0ms;
        background-size: 200%, 1px;
        background-image: linear-gradient(90deg,
                #ff780b 0%,
                #ee132f 50%,
                #ff780b) !important;
    }

    .background-gradient-org:hover {
        background-position: 110%;
    }

    .background-gradient-v2 {
        transition: all 200ms linear 0ms !important;
        background-size: 200%, 1px !important;
        background-image: linear-gradient(90deg,
                #31c5ff 0%,
                #0478e9 50%,
                #31c5ff) !important;
    }

    .background-gradient-v2:hover {
        background-position: 110% !important;
    }

    .background-gradient-grn {
        transition: all 200ms linear 0ms;
        background-size: 200%, 1px;
        background-image: linear-gradient(90deg,
                #70df11 0%,
                #30c677 50%,
                #70df11) !important;
    }

    .background-gradient-grn:hover {
        background-position: 110%;
    }

    .saasio-pagination.text-center.ul-li a.active {
        background-image: linear-gradient(90deg,
                #ff780b 0%,
                #ee132f 50%,
                #ff780b) !important;
    }

    .border-background {
        position: relative;
        border-radius: 10px !important;
        margin-left: 0;
        transition: all 0.3s ease-in-out;
        display: flex;
        align-items: center;
        justify-content: center;
        background: transparent;
        background-image: unset;
        border: 2px solid #0478e9;
        overflow: hidden;
        box-shadow: 0px 0px 24px 0px rgb(3 5 77 / 8%);
    }

    .border-background.active,
    .border-background:hover {
        border: 2px solid transparent !important;
        /* box-shadow: none; */
        -webkit-box-shadow: inset -3px -2px 5px 0px rgb(255 255 255 / 66%),
            inset -1px -1px 0px 0px rgb(255 255 255 / 18%),
            inset 2px 2px 7px 0px rgb(49 69 106 / 18%);
        box-shadow: inset -3px -2px 5px 0px rgb(255 255 255 / 66%),
            inset -1px -1px 0px 0px rgb(255 255 255 / 18%),
            inset 2px 2px 7px 0px rgb(49 69 106 / 18%);
        color: #fff;
        background: transparent !important;
    }

    .border-background.active i,
    .border-background:hover i {
        color: #fff !important;
    }

    .border-background:before {
        position: absolute;
        content: "";
        width: 0px;
        height: 0px;
        right: 0;
        top: 45px;
        right: 15px;
        box-shadow: 0 0 30px 31px rgb(32 190 253 / 90%);
        border-radius: 50%;
        z-index: -1;
        opacity: 0;
        visibility: hidden;
        transition: 0.3s all ease-in-out;
    }

    .border-background:after {
        height: 100%;
        width: 100%;
        position: absolute;
        content: "";
        top: -100%;
        right: 0px;
        z-index: -2;
        border-radius: 10px;
        transition: 0.3s all ease-in-out;
        background-color: #0478e9;
    }

    .border-background.active:before,
    .border-background:hover:before {
        opacity: 1;
        right: 25px;
        visibility: visible;
    }

    .border-background.active:after,
    .border-background:hover:after {
        top: 0;
    }

    .flex-center {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .flex-center-center {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .flex-center-flex-start {
        display: flex;
        align-items: center;
        justify-content: flex-start;
    }

    .flex-center-flex-start-wrap {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        flex-wrap: wrap;
    }

    .flex-center-end {
        display: flex;
        align-items: center;
        justify-content: flex-end;
    }

    .flex-center-space-between {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .flex-center-center-wrap {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-wrap: wrap;
    }

    .flex-center-space-between-wrap {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
    }
</style>
<div class="Bt-menu flex-center-center">
    <a href="dashboard.php" class="item flex-center-center-wrap">
        <div class="icon flex-center-center border-background">
            <i class="fal fa-cog"></i>
        </div>
        <div class="txt flex-center-center mt-1">
            แดชบอร์ด
        </div>
    </a>
    <a href="dashboard-add-property.php" class="item flex-center-center-wrap">
        <div class="icon flex-center-center border-background">
            <i class="fal fa-home"></i>
        </div>
        <div class="txt flex-center-center mt-1">
            ลงประกาศ
        </div>
    </a>
    <a href="dashboard-properties.php" class="item flex-center-center-wrap">
        <div class="icon flex-center-center border-background">
            <i class="fal fa-bullhorn"></i>
        </div>
        <div class="txt flex-center-center mt-1">
            ประกาศของฉัน
        </div>
    </a>
    <a href="dashboard-favourites.php" class="item flex-center-center-wrap">
        <div class="icon flex-center-center border-background">
            <i class="fal fa-heart"></i>
        </div>
        <div class="txt flex-center-center mt-1">
            รายการโปรด
        </div>
    </a>
    <a href="dashboard-my-packages.php" class="item flex-center-center-wrap">
        <div class="icon flex-center-center border-background">
            <i class="far fa-box"></i>
        </div>
        <div class="txt flex-center-center mt-1">
            แพ็คเก็จของฉัน
        </div>
    </a>
    <a href="dashboard-profiles.php" class="item flex-center-center-wrap">
        <div class="icon flex-center-center border-background">
            <i class="far fa-user"></i>
        </div>
        <div class="txt flex-center-center mt-1">
            ข้อมูลส่วนตัว
        </div>
    </a>
</div>

<script>
    const currentLocationMobile = location.href;
    const menuItemMobile = document.querySelectorAll(".Bt-menu .item");
    // console.log(menuItemMobile.length);
    const menuMobileLength = menuItemMobile.length;
    for (let i = 0; i < menuMobileLength; i++) {
        if (menuItemMobile[i].href === currentLocationMobile) {
            menuItemMobile[i].className += " active";
        }
    }
</script>

<style>
    /* Bt-menu */

    .Bt-menu {
        display: none;
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        padding: 0;
        margin: 0;
        background: #fff;
        box-shadow: 0 0 20px -10px rgb(0 0 0 / 80%);
        z-index: 99999;
        align-items: flex-end;
        height: 70px;
    }

    .Bt-menu .item {
        width: 20%;
        padding: 0.75rem 0.25rem;
        border-radius: 0 !important;
        margin: 0;
        border-color: transparent;
    }

    .Bt-menu .item .icon {
        display: flex;
        position: relative;
        width: 100%;
        font-size: 20px;
        color: #363636 !important;
        border: none;
        box-shadow: none;
    }

    .Bt-menu .item.active .icon,
    .Bt-menu .item:hover .icon {
        border: 2px solid transparent !important;
        /* box-shadow: none; */
        -webkit-box-shadow: inset -3px -2px 5px 0px rgb(255 255 255 / 66%),
            inset -1px -1px 0px 0px rgb(255 255 255 / 18%),
            inset 2px 2px 7px 0px rgb(49 69 106 / 18%);
        box-shadow: inset -3px -2px 5px 0px rgb(255 255 255 / 66%),
            inset -1px -1px 0px 0px rgb(255 255 255 / 18%),
            inset 2px 2px 7px 0px rgb(49 69 106 / 18%);
        color: #fff;
        background: transparent !important;
        width: 50px;
        height: 50px;
        border-radius: 50% !important;
        animation: scale 0.3s;
    }

    @keyframes scale {
        from {
            width: unset;
            height: unset;
        }

        to {
            width: 50px;
            height: 50px;
        }
    }

    .Bt-menu .item.active .icon i,
    .Bt-menu .item:hover .icon i {
        color: #fff !important;
    }

    .Bt-menu .item.active .icon:before,
    .Bt-menu .item:hover .icon:before {
        opacity: 1;
        right: 25px;
        visibility: visible;
    }

    .Bt-menu .item .icon:after {
        top: 200%;
    }

    .Bt-menu .item.active .icon:after,
    .Bt-menu .item:hover .icon:after {
        top: 0;
        transition-delay: 0.1s;
    }

    .Bt-menu .item .icon.s2-mobile_menu_button.s2-open_mobile_menu i {
        display: block;
    }

    .Bt-menu .item .icon.renew i {
        transform: scaleX(-1);
    }

    .Bt-menu .item .txt {
        width: 100%;
        font-size: 14px;
        font-weight: 400;
        transition: all 0.3s ease-in-out;
    }

    .Bt-menu .item.active .txt {
        font-weight: 500;
    }

    .Bt-menu .item:hover .txt {
        color: #363636 !important;
    }

    @media screen and (max-width: 600px) {

        /* Bt-menu */
        .Bt-menu {
            display: flex;
        }
    }

    @media screen and (max-width: 390px) {
        .Bt-menu .item .icon {
            font-size: 18px;
        }

        .Bt-menu .item .txt {
            font-size: 12px;
            font-weight: 300;
        }
    }

    @media screen and (max-width: 350px) {
        .Bt-menu .item .icon {
            font-size: 16px;
        }

        .Bt-menu .item .txt {
            font-size: 10px;
            font-weight: 300;
        }
    }

    @media screen and (max-width: 320px) {
        .Bt-menu .item .icon {
            font-size: 14px;
        }

        .Bt-menu .item .txt {
            font-size: 8px;
            font-weight: 300;
        }
    }
</style>