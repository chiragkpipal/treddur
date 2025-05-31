/**
    * Modal_Right
    * datePicker
    * dashboardChart
 */

(function ($) {
    "use strict";

    var Modal_Right = function () {
        const dashboard = $(".sidebar-dashboard");
        var adminbar = $("#wpadminbar").height();
        $(".sidebar-dashboard").css({ top: adminbar });

        if (dashboard.length) {
            const open = function () {
                dashboard.addClass("active");
                $(".dashboard-overlay").addClass("active");
            };
            const close = function () {
                dashboard.removeClass("active");
                $(".dashboard-overlay").removeClass("active");
            };

            $(".dashboard-toggle").on("click", function () {
                open();
            });
            $(".dashboard-overlay, .btn-menu").on(
                "click",
                function () {
                    close();
                }
            );

        }
    };
    
    /* Datepicker  
  -------------------------------------------------------------------------------------*/
  var datePicker = function () {
    if ($(".hasDatepicker").length > 0) {
      $(".hasDatepicker").datepicker({
        firstDay: 1,
        dateFormat: "dd/mm/yy",
      });
    }
  };

var dashboardChart = function () {
        if ($(".tfcl-page-insight").length) {
            // diagram
            var ctx = document.getElementById('lineChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                height: 50,
                backgroundColor: 'linear-gradient(180deg, rgba(255, 169, 32, 0.2) 0.26%, rgba(255, 169, 32, 0) 100%)',
                data: {
                    labels: ['Mar 21', 'Mar 22', 'Mar 23', 'Mar 24', 'Mar 25', 'Mar 26', 'Mar 27', 'Mar 28', 'Mar 29', 'Mar 30', 'Mar 31'],
                    datasets: [{
                        label: '# of Votes',
                        data: [50, 100,15, 150, 25, 50, 100,15, 50, 25,75],
                        backgroundColor: [
                            'rgba(255, 169, 32, 1)'
            
                        ],
                        // background: linear-gradient(180deg, rgba(255, 169, 32, 0.2) 0.26%, rgba(255, 169, 32, 0) 100%),
            
                        borderColor: [
                            'rgba(255, 169, 32, 1)',
                        ],
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                        }
                    }
                }
            });
            }
        }

    // Dom Ready
    $(function () {
        Modal_Right();
        dashboardChart();
        datePicker();
    });
})(jQuery);
