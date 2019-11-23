<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
	<?= $this->Html->link('<i class="fas fa-download fa-sm text-white-50"></i> Generate Report', ['action' => 'download', '_ext' => 'csv'], ['class' => 'd-none d-sm-inline-block btn btn-sm btn-primary shadow-sm', 'escape' => false]) ?>
</div>
<div class="row">
	<div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      	<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Sales</div>
                      	<div class="h5 mb-0 font-weight-bold text-gray-800">PHP <?= number_format($total_sales, 2) ?></div>
                    </div>
                    <div class="col-auto">
                      	<i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      	<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Instagram Followers</div>
                      	<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $followers ?></div>
                    </div>
                    <div class="col-auto">
                      	<i class="fab fa-instagram fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      	<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pending Orders</div>
                      	<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $pending_orders ?></div>
                    </div>
                    <div class="col-auto">
                      	<i class="fas fa-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
	<div class="col-xl-12 col-lg-12">
		<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
			<h6 class="m-0 font-weight-bold text-primary">Sales Graph</h6>
				<div class="dropdown no-arrow">
					<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
					</a>
				<div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
					<div class="dropdown-header">Sory By:</div>
					<a class="dropdown-item graph-sort" href="#" data-sort="month">Monthly</a>
					<a class="dropdown-item graph-sort" href="#" data-sort="year">Annualy</a>
				</div>
			</div>
		</div>
		<div class="card-body">
	        <div class="chart-area">
	        	<canvas id="salesGraphChart"></canvas>
	        </div>
        </div>
	</div>
</div>
<input type="hidden" name="sorting" value="month" id="sorting">
<?= $this->Html->script('Chart.min.js') ?>
<script type="text/javascript">
	var chart = null;
	function number_format(number, decimals, dec_point, thousands_sep) {
		// *     example: number_format(1234.56, 2, ',', ' ');
		// *     return: '1 234,56'
		number = (number + '').replace(',', '').replace(' ', '');
		var n = !isFinite(+number) ? 0 : +number,
		prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
		sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
		dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
		s = '',
		toFixedFix = function(n, prec) {
		  var k = Math.pow(10, prec);
		  return '' + Math.round(n * k) / k;
		};
		// Fix for IE parseFloat(0.55).toFixed(0) = 0;
		s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
		if (s[0].length > 3) {
			s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
		}
		if ((s[1] || '').length < prec) {
			s[1] = s[1] || '';
			s[1] += new Array(prec - s[1].length + 1).join('0');
		}
		return s.join(dec);
	}
	function createChart() {
		var ctx = document.getElementById("salesGraphChart");
		chart = new Chart(ctx, {
		  type: 'bar',
		  data: {
		    labels: [],
		    datasets: [{
		      label: "Sales",
		      backgroundColor: "rgb(14, 194, 230)",
		      data: [],
		    }],
		  },
		  options: {
		    maintainAspectRatio: false,
		    layout: {
		      padding: {
		        left: 10,
		        right: 25,
		        top: 25,
		        bottom: 0
		      }
		    },
		    scales: {
		      xAxes: [{
		        time: {
		          unit: 'date'
		        },
		        gridLines: {
		          display: false,
		          drawBorder: false
		        },
		        ticks: {
		          maxTicksLimit: 7
		        }
		      }],
		      yAxes: [{
		        ticks: {
		          maxTicksLimit: 5,
		          padding: 10,
		          // Include a dollar sign in the ticks
		          callback: function(value, index, values) {
		            return 'P ' + number_format(value);
		          }
		        },
		        gridLines: {
		          color: "rgb(234, 236, 244)",
		          zeroLineColor: "rgb(234, 236, 244)",
		          drawBorder: false,
		          borderDash: [2],
		          zeroLineBorderDash: [2]
		        }
		      }],
		    },
		    legend: {
		      display: false
		    },
		    tooltips: {
		      backgroundColor: "rgb(255,255,255)",
		      bodyFontColor: "#858796",
		      titleMarginBottom: 10,
		      titleFontColor: '#6e707e',
		      titleFontSize: 14,
		      borderColor: '#dddfeb',
		      borderWidth: 1,
		      xPadding: 15,
		      yPadding: 15,
		      displayColors: false,
		      intersect: false,
		      mode: 'index',
		      caretPadding: 10,
		      callbacks: {
		        label: function(tooltipItem, chart) {
		          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
		          return datasetLabel + ': P ' + number_format(tooltipItem.yLabel);
		        }
		      }
		    }
		  }
		});
	}
	function populateChart () {
		$.ajax({
			headers: {
        		'X-CSRF-Token': csrfToken
    		},
			type: 'post',
			url: url + 'admin/getSalesData',
			data: {
				sort: $('#sorting').val()
			},
			dataType: 'json',
			beforeSend: function () {
				$('.chart-area').hide();
			},
			success: function (data) {
				var labels = [];
				var totals = [];
				$.each(data, function (i, e) {
					labels.push(e.label);
					totals.push(e.total);
				});
				chart.data.labels = labels;
				chart.data.datasets[0].data = totals;
				chart.update();
				$('.chart-area').show();
			},
			error: function (err) {
				console.log(err.responseText);
			}
		})
	}
	$(document).ready(function () {
		$('.chart-area').hide();
		createChart();
		$('.graph-sort').on('click', function () {
			var sort = $(this).data('sort');
			$('#sorting').val(sort);
			populateChart();
		});
		$('.graph-sort').eq(0).trigger('click');
	});
</script>