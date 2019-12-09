(function(e) {
    var t = e(window),
        n = t.height(),
        r = t.width();
    e.fn.parallax = function(i) {
        function l() {
            var t = document.createElement("link");
            t.rel = "stylesheet";
            t.href = e("body").attr("basepath") + "css/parallax.css";
            var n = document.getElementsByTagName("link")[0];
            n.parentNode.insertBefore(t, n)
        }

        function c() {
            var i = t.scrollTop();
            if (o.bgParallax == 1 && r > 1024) u.each(function() {
                var t = e(this),
                    r = t.offset().top,
                    s = t.outerHeight();
                if (r + s < i || r > i + n) return;
                var a = Math.round((f - i) * o.speedFactor);
                u.css("background-position", o.xpos + " " + a + "px")
            });
            else {
                var s = 640 + Math.round((f - i) * o.speedFactor * 8);
                u.find("img").each(function() {
                    e(this).css("margin-top", "-" + s + "px")
                })
            }
        }

        function h() {
            var e;
            if (o.bgParallax == 1) {
                r <= 800 ? e = u.attr("data_image_800") : r <= 1280 ? e = u.attr("data_image_1280") : r <= 1440 ? e = u.attr("data_image_1440") : e = u.attr("data_image_1920");
                u.css("background", "url(" + e + ")")
            } else console.log("no bg image")
        }
        var s = {
                bgParallax: !0,
                xpos: "50%",
                speedFactor: .2,
                outerHeight: !0,
                paddingTop: 0
            },
            o = e.extend({}, s, i),
            u = e(this),
            a, f;
        u.each(function() {
            f = u.offset().top
        });
        t.resize(function() {
            n = t.height();
            r = t.width();
            h();
            c()
        });
        t.bind("scroll", c);
        l();
        h();
        c()
    }
})(jQuery);