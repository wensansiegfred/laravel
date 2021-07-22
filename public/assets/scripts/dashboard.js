$(function () {
    //Start the monthly logic
    $('input[name="daterange"]').daterangepicker(
        {
            opens: "right",
            dateLimit: { days: 6 },
        },
        function (start, end, label) {
            start_date = start.format("YYYY-MM-DD");
            end_date = end.format("YYYY-MM-DD");

            drawgraph(start_date, end_date);
        }
    );
    function drawgraph(start_date, end_date) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            url: APP_URL + "/loadDashboardData",
            type: "POST",
            data: {
                start_date: start_date,
                end_date: end_date,
            },
            success: function (result) {
                //Adding the Active empliyee || Total Employee || Inactive Employee
                $(".week_total_employee_register").html("");
                $(".week_total_employee_register").html(
                    result.total_register_user
                );
                $(".week_total_employee_active").html("");
                $(".week_total_employee_active").html(
                    result.user_activitiy_active
                );

                $(".week_total_employee_inactive").html("");
                $(".week_total_employee_inactive").html(
                    result.user_activitiy_inactive
                );

                var labels = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"];
                var series = [];

                var labels = [];
                for (var i = 0; i < result.graph_data.length; i++) {
                    series.push(result.graph_data[i].completedusercount);
                    labels.push(result.graph_data[i].date);
                }
                var data, options;
                data = {
                    labels: labels,
                    series: [series],
                };
                options = {
                    height: 170,
                    axisX: {
                        showGrid: false,
                    },
                    low: 0,
                    high: result.total_register_user,
                };
                new Chartist.Bar("#visits-chart", data, options);

                // Resting the table$('.week_employee_tables').html('');
                loadweektabledata(result.dates, result.user_table_data);
            },
        });
    }
    drawgraph(start_date, end_date);

    function loadweektabledata2(dates, user_table_data) {
        $(".week_employee_tables").empty();
    }

    function activityData(user, date) {
        const hasActivity = user.users_activities.filter(function (activity) {
            return date;
        });
        return `
            <td>
                <center>
                    <i class='fa fa-check' style='font-size:13px !important ;border-radius: 16px;background: #58b400; color: white; padding: 3px;'>
                    </i>
                    <br> 
                    ${user.users_activities}
                </center>
            </td>
        `;
    }
    function showActivityNotCompleted() {
        return "<td><center> <i class='fa fa-close xroseicon' ></i> <br>Not Completed</center></td>";
    }
    function showActivityCompleted(value) {
        return `
            <td>
                <center> 
                    <i class='fa fa-check' 
                    style='font-size:13px !important; border-radius: 16px;background: #58b400; color: white; padding: 3px;'></i>
                    <br>
                    ${value} 
                </center>
            </td>
        `;
    }
    function loadweektabledata(dates, user_table_data) {
        $(".week_employee_tables").html("");
        //Are used to display the table
        var table_head = "<thead><tr>";
        table_head += "<th>Employee Name</th>";
        for (var date = 0; date < dates.length; date++) {
            table_head += "<th><center>" + dates[date] + "</center></th>";
        }
        table_head += "</tr></thead>";
        $(".week_employee_tables").html(table_head);
        var table_body = "";
        user_table_data.forEach(function (user) {
            table_body += "<tr>";
            user.forEach(function (data, dataIndex) {
                if (dataIndex == 0) {
                    table_body += `<td>${data}</td>`;
                } else {
                    table_body +=
                        data == "0"
                            ? showActivityNotCompleted()
                            : showActivityCompleted(data);
                }
            });
            table_body += "</tr>";
        });
        $(".week_employee_tables").append(table_body);
    }
    $("#clearsearch").on("click", function () {
        drawgraph(start_date, end_date);
    });
    $("#searchmembersbyweek").on("click", function () {
        var searchmembersbyweektext = $(".searchmembersbyweek").val();
        if (searchmembersbyweektext === "") {
            alert("Please fill out the search box first");
        } else {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            });
            $.ajax({
                url: APP_URL + "/loadDashboardDataByUserSearch",
                type: "POST",
                data: {
                    start_date: start_date,
                    end_date: end_date,
                    searchmembersbyweektext: searchmembersbyweektext,
                },
                success: function (result) {
                    loadweektabledata(result.dates, result.user_table_data);
                },
            });
        }
    });

    //End Montthly logics

    //Start Weekly Logic
    var start_date_daily = moment().format("YYYY-MM-DD");

    $('input[name="daily"]').daterangepicker(
        {
            singleDatePicker: true,
            showDropdowns: true,
            minYear: 1901,
            maxYear: parseInt(moment().format("YYYY"), 10),
        },
        function (start, end, label) {
            start_date_daily = start.format("YYYY-MM-DD");

            loadDailyData(start_date_daily, end_date);
        }
    );
    //End weekly logic
    $("#showbyday").on("click", function () {
        $(this).css("background-color", "#1a2a66 ");
        $(this).css("color", "white");
        $("#showbyweek").css("background-color", "#f1f1f1");
        $("#showbyweek").css("color", "black");
        $(".weekly").hide();
        $(".daily").show();
    });
    $("#showbyweek").on("click", function () {
        $(this).css("background-color", "#1a2a66 ");
        $(this).css("color", "white");
        $("#showbyday").css("background-color", "#f1f1f1");
        $("#showbyday").css("color", "black");
        $(".weekly").show();
        $(".daily").hide();
    });
    loadDailyData(start_date_daily);
    var sysLoad = $("#system-load").easyPieChart({
        size: 130,
        barColor: function (percent) {
            return "#58b400";
        },
        trackColor: "rgba(245, 245, 245, 0.8)",
        scaleColor: false,
        lineWidth: 25,
        lineCap: "square",
        animate: 800,
    });
    // real-time pie chart
    function loadDailyData(start_date_daily) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            url: APP_URL + "/loadDailyData",
            type: "POST",
            data: {
                date: start_date_daily,
            },
            success: function (result) {
                $("#system-load").attr(
                    "data-percent",
                    result.toal_percentage_active
                );
                $(".daily-pie-active").html(result.user_activitiy_active);
                $(".daily-pie-total").html(" / " + result.toal_registertoday);

                $(".daily_total_employee_register").html(
                    result.toal_registertoday
                );
                $(".daily_total_employee_active").html(
                    result.user_activitiy_active
                );
                $(".daily_total_employee_inactive").html(
                    result.user_activitiy_inactive
                );

                sysLoad
                    .data("easyPieChart")
                    .update(result.toal_percentage_active);
                sysLoad.find(".percent").text(result.toal_percentage_active);
                loadindthedataofdaily(result.user_activitiy_data);
                // Resting the table$('.week_employee_tables').html('');
            },
        });
    }
    $("#searchmembersdaily").on("click", function () {
        var searchmembersbydaily = $(".searchmembersbydaily").val();
        if (searchmembersbydaily === "") {
            alert("Please fill out the search box first");
        } else {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            });
            $.ajax({
                url: APP_URL + "/loadDashboardDataByDailyUserSearch",
                type: "POST",
                data: {
                    start_date_daily: start_date_daily,
                    searchmembersbydaily: searchmembersbydaily,
                },
                success: function (result) {
                    loadindthedataofdaily(result.user_activitiy_data);
                },
            });
        }
    });
    function loadindthedataofdaily(user_activitiy_data) {
        $(".daily_employee_tables").html();
        var table_html_data = "";
        for (var i = 0; i < user_activitiy_data.length; i++) {
            table_html_data += "<tr>";
            if (user_activitiy_data[i].user_data) {
                table_html_data +=
                    "<td>" +
                    user_activitiy_data[i].user_data.first_name +
                    "</td>";
                table_html_data +=
                    "<td>" + user_activitiy_data[i].user_data.email + "</td>";
            }
            if (user_activitiy_data[i].status == 1) {
                table_html_data +=
                    "<td><span class='label label-success'  style='border-radius: 9px;'> <i class='fa fa-check ' ></i> Completed</span> </td>";
                var end_date = user_activitiy_data[i].activitie_start_endtime;
                table_html_data +=
                    "<td>" + moment(end_date, "YYYY-MM-DD").format("LLL");
                +"</td>";
            } else {
                table_html_data +=
                    "<td><span class='label label-danger'  style='border-radius: 9px;'> <i class='fa fa-close ' ></i> Not Completed</span></td>";
                table_html_data += "<td>N/A</td>";
            }

            table_html_data +=
                "<td><a href=" +
                APP_URL +
                "/editmember/" +
                user_activitiy_data[i].user_id +
                " target='_blank' style='color:#f27c02'> View profile </a></td>";
            table_html_data += "</tr>";
        }
        $(".daily_employee_tables").html(table_html_data);
    }
    $("#clearsearchdaily").on("click", function () {
        $(".searchmembersbydaily").val("");
        loadDailyData(start_date_daily);
    });
});
