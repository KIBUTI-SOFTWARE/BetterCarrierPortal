(() => {
    (function () {
        "use strict";
        if ($(".line-chart").length) {
            let t = $(".line-chart")[0].getContext("2d"), a = new Chart(t, {
                type: "line",
                data: {
                    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                    datasets: [{
                        label: "Html Template",
                        data: [0, 200, 250, 200, 500, 450, 850, 1050, 950, 1100, 900, 1200],
                        borderWidth: 2,
                        borderColor: () => getColor("primary"),
                        backgroundColor: "transparent",
                        pointBorderColor: "transparent",
                        tension: .4
                    }, {
                        label: "VueJs Template",
                        data: [0, 300, 400, 560, 320, 600, 720, 850, 690, 805, 1200, 1010],
                        borderWidth: 2,
                        borderDash: [2, 2],
                        borderColor: () => $("html").hasClass("dark") ? getColor("slate.400", .6) : getColor("slate.400"),
                        backgroundColor: "transparent",
                        pointBorderColor: "transparent",
                        tension: .4
                    }]
                },
                options: {
                    maintainAspectRatio: !1,
                    plugins: {legend: {labels: {color: getColor("slate.500", .8)}}},
                    scales: {
                        x: {
                            ticks: {font: {size: "12"}, color: getColor("slate.500", .8)},
                            grid: {display: !1},
                            border: {display: !1}
                        },
                        y: {
                            ticks: {
                                font: {size: "12"}, color: getColor("slate.500", .8), callback: function (e, r, l) {
                                    return "" + e
                                }
                            },
                            grid: {color: () => $("html").hasClass("dark") ? getColor("slate.500", .3) : getColor("slate.300")},
                            border: {dash: [2, 2], display: !1}
                        }
                    }
                }
            });
            helper.watchClassNameChanges($("html")[0], e => {
                a.update()
            })
        }
    })();
})();
