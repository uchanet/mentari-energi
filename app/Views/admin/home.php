
					<link rel="stylesheet" href="<?=site_url()?>assets/plugins/apex/apexcharts.css">

					<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-6 layout-spacing">
						<div class="widget-one bg-dark">
							<div class="widget-content">
								<a href="<?=site_url()?>admin/post">
									<div class="w-numeric-value" style="position: relative;display: inline-flex;">
										<div class="w-icon">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
										</div>
										<div class="w-content">
											<span class="w-value"><?=$totalpost?></span>
											<span class="w-numeric-title">Total Post</span>
										</div>
									</div>
								</a>
							</div>
						</div>
					</div>

					<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-6 layout-spacing">
						<div class="widget-one bg-dark">
							<div class="widget-content">
								<a href="<?=site_url()?>admin/category">
									<div class="w-numeric-value" style="position: relative;display: inline-flex;">
										<div class="w-icon">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
										</div>
										<div class="w-content">
											<span class="w-value"><?=$totalcategory?></span>
											<span class="w-numeric-title">Total Category</span>
										</div>
									</div>
								</a>
							</div>
						</div>
					</div>

					<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-6 layout-spacing">
						<div class="widget-one bg-dark">
							<div class="widget-content">
								<a href="<?=site_url()?>admin/comment">
									<div class="w-numeric-value" style="position: relative;display: inline-flex;">
										<div class="w-icon">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
										</div>
										<div class="w-content">
											<span class="w-value"><?=$totalcomment?></span>
											<span class="w-numeric-title">Total Comment</span>
										</div>
									</div>
								</a>
							</div>
						</div>
					</div>
					<?php
						if ($this->session->userrole == 1){
					?>
					<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-6 layout-spacing">
						<div class="widget-one bg-dark">
							<div class="widget-content">
								<a href="<?=site_url()?>admin/user">
									<div class="w-numeric-value" style="position: relative;display: inline-flex;">
										<div class="w-icon">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
										</div>
										<div class="w-content">
											<span class="w-value"><?=$totaluser?></span>
											<span class="w-numeric-title">Total User</span>
										</div>
									</div>
								</a>
							</div>
						</div>
					</div>

					<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-6 layout-spacing">
						<div class="widget-one bg-dark">
							<div class="widget-content">
								<a href="<?=site_url()?>admin/page">
									<div class="w-numeric-value" style="position: relative;display: inline-flex;">
										<div class="w-icon">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>
										</div>
										<div class="w-content">
											<span class="w-value"><?=$totalpage?></span>
											<span class="w-numeric-title">Total Page</span>
										</div>
									</div>
								</a>
							</div>
						</div>
					</div>

					<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-6 layout-spacing">
						<div class="widget-one bg-dark">
							<div class="widget-content">
								<a href="<?=site_url()?>admin/contact">
									<div class="w-numeric-value" style="position: relative;display: inline-flex;">
										<div class="w-icon">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
										</div>
										<div class="w-content">
											<span class="w-value"><?=$totalmessage?></span>
											<span class="w-numeric-title">Total Message</span>
										</div>
									</div>
								</a>
							</div>
						</div>
					</div>
					<?php
						}
					?>
					<div class="col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
						<div class="widget widget-chart-one">
							<div class="widget-heading">
								<h5 class="">Visitor</h5>
								<ul class="tabs tab-pills">
									<li><a href="javascript:void(0);" id="tb_1" class="tabmenu">Last 7 Days</a></li>
								</ul>
							</div>

							<div class="widget-content">
								<div class="tabs tab-content">
									<div id="content_1" class="tabcontent">
										<div id="revenueMonthly"></div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
						<div class="widget widget-table-two">

							<div class="widget-heading">
								<h5 class="">Recent Login</h5>
							</div>

							<div class="widget-content">
								<div class="table-responsive">
									<table class="table">
										<thead>
											<tr>
												<th><div class="th-content">Name</div></th>
												<th><div class="th-content">Login</div></th>
												<th><div class="th-content">Role</div></th>
											</tr>
										</thead>
										<tbody>
										<?php
											$traffic = $this->db->table('user')->join('role', 'role.id = user.role', 'left')->where('lastlogin >= DATE_ADD(NOW(), INTERVAL -7 DAY)')->get();
											foreach($traffic->getResult() as $row){
										?>
											<tr>
												<td><div class="td-content"><img src="<?=site_url()?>assets/images/profile/<?=$row->picture?>" alt="avatar"><?=$row->username?></div></td>
												<td><div class="td-content"><span class=""><?=date("d M Y H:i", strtotime($row->lastlogin))?></span></div></td>
												<td><div class="td-content"><span class="badge outline-badge-primary"><?=$row->title?></span></div></td>
											</tr>
										<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>

					<script src="<?=site_url()?>assets/plugins/apex/apexcharts.min.js"></script>

<script>
try {

/*
    ==============================
    |    @Options Charts Script   |
    ==============================
*/

/*
    =============================
        Daily Sales | Options
    =============================
*/
var d_2options1 = {
  chart: {
        height: 160,
        type: 'bar',
        stacked: true,
        stackType: '100%',
        toolbar: {
          show: false,
        }
    },
    dataLabels: {
        enabled: false,
    },
    stroke: {
        show: true,
        width: 1,
    },
    colors: ['#e2a03f', '#e0e6ed'],
    responsive: [{
        breakpoint: 480,
        options: {
            legend: {
                position: 'bottom',
                offsetX: -10,
                offsetY: 0
            }
        }
    }],
    series: [{
        name: 'Sales',
        data: [44, 55, 41, 67, 22, 43, 21]
    },{
        name: 'Last Week',
        data: [13, 23, 20, 8, 13, 27, 33]
    }],
    xaxis: {
        labels: {
            show: false,
        },
        categories: ['Sun', 'Mon', 'Tue', 'Wed', 'Thur', 'Fri', 'Sat'],
    },
    yaxis: {
        show: false
    },
    fill: {
        opacity: 1
    },
    plotOptions: {
        bar: {
            horizontal: false,
            endingShape: 'rounded',
            columnWidth: '25%',
        }
    },
    legend: {
        show: false,
    },
    grid: {
        show: false,
        xaxis: {
            lines: {
                show: false
            }
        },
        padding: {
          top: 10,
          right: 0,
          bottom: -40,
          left: 0
        }, 
    },
}

/*
    =============================
        Total Orders | Options
    =============================
*/
var d_2options2 = {
  chart: {
    id: 'sparkline1',
    group: 'sparklines',
    type: 'area',
    height: 280,
    sparkline: {
      enabled: true
    },
  },
  stroke: {
      curve: 'smooth',
      width: 2
  },
  fill: {
    opacity: 1,
  },
  series: [{
    name: 'Sales',
    data: [28, 40, 36, 52, 38, 60, 38, 52, 36, 40]
  }],
  labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10'],
  yaxis: {
    min: 0
  },
  grid: {
    padding: {
      top: 125,
      right: 0,
      bottom: 36,
      left: 0
    }, 
  },
  fill: {
      type:"gradient",
      gradient: {
          type: "vertical",
          shadeIntensity: 1,
          inverseColors: !1,
          opacityFrom: .40,
          opacityTo: .05,
          stops: [45, 100]
      }
  },
  tooltip: {
    x: {
      show: false,
    },
    theme: 'dark'
  },
  colors: ['#fff']
}

/*
    =================================
        Revenue Monthly | Options
    =================================
*/
var options1 = {
  chart: {
    fontFamily: 'Nunito, sans-serif',
    height: 365,
    type: 'area',
    zoom: {
        enabled: false
    },
    dropShadow: {
      enabled: true,
      opacity: 0.3,
      blur: 5,
      left: -7,
      top: 22
    },
    toolbar: {
      show: false
    },
    events: {
      mounted: function(ctx, config) {
        const highest1 = ctx.getHighestValueInSeries(0);
        const highest2 = ctx.getHighestValueInSeries(1);

        ctx.addPointAnnotation({
          x: new Date(ctx.w.globals.seriesX[0][ctx.w.globals.series[0].indexOf(highest1)]).getTime(),
          y: highest1,
          label: {
            style: {
              cssClass: 'd-none'
            }
          },
          customSVG: {
              SVG: '<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="#1b55e2" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg>',
              cssClass: undefined,
              offsetX: -8,
              offsetY: 5
          }
        })

        ctx.addPointAnnotation({
          x: new Date(ctx.w.globals.seriesX[1][ctx.w.globals.series[1].indexOf(highest2)]).getTime(),
          y: highest2,
          label: {
            style: {
              cssClass: 'd-none'
            }
          },
          customSVG: {
              SVG: '<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="#e7515a" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg>',
              cssClass: undefined,
              offsetX: -8,
              offsetY: 5
          }
        })
      },
    }
  },
  colors: ['#1b55e2', '#e7515a'],
  dataLabels: {
      enabled: false
  },
  markers: {
    discrete: [{
    seriesIndex: 0,
    dataPointIndex: 7,
    fillColor: '#000',
    strokeColor: '#000',
    size: 5
  }, {
    seriesIndex: 2,
    dataPointIndex: 11,
    fillColor: '#000',
    strokeColor: '#000',
    size: 4
  }]
  },
  subtitle: {
    text: 'Total Visitor',
    align: 'left',
    margin: 0,
    offsetX: -10,
    offsetY: 35,
    floating: false,
    style: {
      fontSize: '14px',
      color:  '#888ea8'
    }
  },
  title: {
    text: <?=$totalvisitor?>,
    align: 'left',
    margin: 0,
    offsetX: -10,
    offsetY: 0,
    floating: false,
    style: {
      fontSize: '25px',
      color:  '#0e1726'
    },
  },
  stroke: {
      show: true,
      curve: 'smooth',
      width: 2,
      lineCap: 'square'
  },
  series: [{
      name: 'Visitor',
      data: <?=$countvisitor?>
  }, {
      name: 'Impression',
      data: <?=$sumvisitor?>
  }],
  labels: <?=$labelvisitor?>,
  xaxis: {
    axisBorder: {
      show: false
    },
    axisTicks: {
      show: false
    },
    crosshairs: {
      show: true
    },
    labels: {
      offsetX: 0,
      offsetY: 5,
      style: {
          fontSize: '12px',
          fontFamily: 'Nunito, sans-serif',
          cssClass: 'apexcharts-xaxis-title',
      },
    }
  },
  yaxis: {
    labels: {
      formatter: function(value, index) {
        return value
      },
      offsetX: -22,
      offsetY: 0,
      style: {
          fontSize: '12px',
          fontFamily: 'Nunito, sans-serif',
          cssClass: 'apexcharts-yaxis-title',
      },
    }
  },
  grid: {
    borderColor: '#e0e6ed',
    strokeDashArray: 5,
    xaxis: {
        lines: {
            show: true
        }
    },   
    yaxis: {
        lines: {
            show: false,
        }
    },
    padding: {
      top: 0,
      right: 0,
      bottom: 0,
      left: -10
    }, 
  }, 
  legend: {
    position: 'top',
    horizontalAlign: 'right',
    offsetY: -50,
    fontSize: '16px',
    fontFamily: 'Nunito, sans-serif',
    markers: {
      width: 10,
      height: 10,
      strokeWidth: 0,
      strokeColor: '#fff',
      fillColors: undefined,
      radius: 12,
      onClick: undefined,
      offsetX: 0,
      offsetY: 0
    },    
    itemMargin: {
      horizontal: 0,
      vertical: 20
    }
  },
  tooltip: {
    theme: 'dark',
    marker: {
      show: true,
    },
    x: {
      show: false,
    }
  },
  fill: {
      type:"gradient",
      gradient: {
          type: "vertical",
          shadeIntensity: 1,
          inverseColors: !1,
          opacityFrom: .28,
          opacityTo: .05,
          stops: [45, 100]
      }
  },
  responsive: [{
    breakpoint: 575,
    options: {
      legend: {
          offsetY: -30,
      },
    },
  }]
}

/*
    ==============================
    |    @Render Charts Script    |
    ==============================
*/


/*
    ============================
        Daily Sales | Render
    ============================
*/
var d_2C_1 = new ApexCharts(document.querySelector("#daily-sales"), d_2options1);
d_2C_1.render();

/*
    ============================
        Total Orders | Render
    ============================
*/
var d_2C_2 = new ApexCharts(document.querySelector("#total-orders"), d_2options2);
d_2C_2.render();

/*
    ================================
        Revenue Monthly | Render
    ================================
*/
var chart1 = new ApexCharts(
    document.querySelector("#revenueMonthly"),
    options1
);

chart1.render();

} catch(e) {
    console.log(e);
}
</script>
