window.rootPath = (function (src) {
    src = document.scripts[document.scripts.length - 1].src;
    return src.substring(0, src.lastIndexOf("/") + 1);
})();

layui.config({
    base: rootPath + "lay-module/",
    version: true
}).extend({
    systemGui: 'gui/systemGui', //  系统自定义扩展方法
    treetable: 'treetable-lay/treetable', //  系统自定义扩展方法
});
