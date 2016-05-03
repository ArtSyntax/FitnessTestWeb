$(function () {
	$('#queue').highcharts({
		chart: {
			type: 'column'
		},
		title: {
			text: 'จำนวนผู้เข้าทดสอบในแต่ละฐานทดสอบ'
		},
		xAxis: {
			categories: ['Apples', 'Oranges', 'Pears', 'Grapes', 'Bananas']
		},
		yAxis: {
			min: 0,
			title: {
				text: 'จำนวนผู้เข้าทดสอบ'
			}
		},
		tooltip: {
			pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
			shared: true
		},
		plotOptions: {
			column: {
				stacking: 'percent'
			}
		},
		series: [{
			name: 'ผู้ที่ยังไม่ได้ทดสอบ',
			data: [5, 3, 4, 7, 2]
		}, {
			name: 'ผู้ที่ทดสอบแล้ว',
			data: [2, 2, 3, 2, 1]
		}]
	});
});