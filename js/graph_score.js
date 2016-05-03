$(function () {
	$('#score').highcharts({
		chart: {
			type: 'bar'
		},
		title: {
			text: 'ผลการทดสอบสมรรถภาพ'
		},
		subtitle: {
			text: 'ปี 2559'
		},
		xAxis: {
			categories: ['Africa', 'America', 'Asia', 'Europe', 'Oceania'],
			title: {
				text: null
			}
		},
		yAxis: {
			min: 0,
			title: {
				text: 'ค่าที่ได้ (หน่วย)',
				align: 'high'
			},
			labels: {
				overflow: 'justify'
			}
		},
		tooltip: {
			valueSuffix: ' หน่วย'
		},
		plotOptions: {
			bar: {
				dataLabels: {
					enabled: true
				}
			}
		},
		legend: {
			layout: 'vertical',
			align: 'right',
			verticalAlign: 'top',
			x: -40,
			y: 80,
			floating: true,
			borderWidth: 1,
			backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
			shadow: true
		},
		credits: {
			enabled: false
		},
		series: [{
			name: 'คะแนนที่ทำได้',
			data: [107, 31, 635, 203, 20]
		}, {
			name: 'คะแนนเฉลี่ย',
			data: [133, 156, 947, 408, 116]
		}]
	});
});