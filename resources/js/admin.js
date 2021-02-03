import common from "./common";

require('./bootstrap');
window.jQuery = require("jquery");
jQuery.noConflict();
window.$ = jQuery;
window.$jquery = jQuery;
require("jquery-pjax");
window.NProgress = require("nprogress");

$.pjax.defaults.timeout = 10000;
$(document).pjax('a', '#pjax-container')
NProgress.configure({minimum: 0.25});
if ($.support.pjax) {
    $(document).on('click', 'a[data-pjax]', function (event) {
        console.log(333);
        var container = $(this).closest('[data-pjax-container]')
        $.pjax.click(event, {container: container})
    })
    $(document).on('pjax:start', function () {
        console.log('start');
        NProgress.inc();
        NProgress.start();
    })
    $(document).on('pjax:end', function () {
        console.log('end');
        NProgress.done();
    });
    $(document).on('pjax:complete', function () {
        // window.location.hash = window.location.hash + '?='+Math.random()
    });
}

if ($("#nav-menu").length) {
    //切换菜单的时候，选中
    $("#nav-menu a").click(function () {
        $("#nav-menu li").removeClass('cu')
        $(this).parent('li').addClass('cu');
    })
}
import commonFun from './common';
window.$common = commonFun;

// user = require('./admin/user');
// console.log(user);
