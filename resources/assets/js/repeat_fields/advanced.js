"use strict";
var KTSubscriptionsAdvanced = function () {
    var t, e, n = function () {
        t.querySelectorAll("tbody tr").forEach(((t, e) => {
            const n = t.querySelector("td:first-child input"),
                o = t.querySelector("td:nth-child(2) input"),
                a = t.querySelector("td:nth-child(2) span strong"),
                i = n.getAttribute("id"),
                r = o.getAttribute("id");
            n.setAttribute("name", i + "[" + e + "]"), o.setAttribute("name", r + "[" + e + "]"), $(a).addClass('question_answer_' + e + '_error')

            if (e === 0 && t.querySelector("td:last-child button") !== null) {
                t.querySelector("td:last-child button").remove();
            }
        }))
    };
    return {
        init: function () {
            t = document.getElementById("kt_create_new_custom_fields"),
                function () {
                    const o = document.getElementById("kt_create_new_custom_fields_add"),
                        i = t.querySelector("tbody tr td:first-child").innerHTML,
                        r = t.querySelector("tbody tr td:nth-child(2)").innerHTML,
                        c = t.querySelector("tbody tr td:last-child").innerHTML;
                    var d;
                    e = $(t).DataTable({
                        info: !1,
                        order: [],
                        ordering: !1,
                        paging: !1,
                        lengthChange: !1
                    }), o.addEventListener("click", (function (t) {
                        t.preventDefault(), d = e.row.add([i, r, c]).draw().node(), $(d).find("td").eq(2).addClass("text-end"), n()
                    }))
                }(), n(), KTUtil.on(t, '[data-kt-action="field_remove"]', "click", (function (t) {
                    t.preventDefault();
                    const n = t.target.closest("tr");
                    e.row($(n)).remove().draw();
                }))
        }
    }
}();
KTUtil.onDOMContentLoaded((function () {
    KTSubscriptionsAdvanced.init()
}));
