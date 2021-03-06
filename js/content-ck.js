$(document).ready(function() {
    var e = $(window),
        t = e.width(),
        n = $("#menu"),
        r = !1;
    e.resize(function() {
        t = e.width();
        if (t > 1024 && r == 0) {
            n.wrapAll("<div></div>");
            $parent = n.parent();
            $parent.attr("id", "menu-sticky-wrapper");
            n.css("display", "block");
            r = !0
        } else if (t < 1024 && r == 1 && n.parent().is("div#menu-sticky-wrapper")) {
            n.css("display", "none");
            n.unwrap();
            r = !1
        }
    });
    if (t > 1024 && r == 0) {
        $("#menu").sticky({
            topSpacing: 0
        });
        r = !0
    }
    $("#header").parallax({
        speed: 2
    });
    $("#burgerbutton").bind("click", function() {
        $("#menu").slideToggle()
    })
});