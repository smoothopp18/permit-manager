$(document).ready(function () {
  // Handle nav link clicks for main content using event delegation
  $(document).on('click', '.nav-link', function (e) {
    e.preventDefault();
    let pageUrl = $(this).attr('href');
    $('.main-content').load(pageUrl);
  });

  // Handle clicks on the link with ID viewDocs using event delegation
  $(document).on('click', '#viewDocs', function (e) {
    e.preventDefault();
    let pageUrl = $(this).attr('href');
    $('.main-content').load(pageUrl);
  });

  // Handle clicks on the link with ID forward-to-ceo-link using event delegation
  $(document).ready(function () {
    $('#forward-to-ceo-link').on('click', function (e) {
      e.preventDefault();
      $('#main-content').load('fordward-to-ceo.php');
    });
  });

  // Validate phone number field using event delegation for dynamically added elements
  $(document).on('blur', '#phone-number', function () {
    let phoneNumber = $(this).val();
    let regex = /^[0-9]{10}$/; // Simple regex for 10-digit phone number

    if (!regex.test(phoneNumber)) {
      alert('Please enter a valid 10-digit phone number');
    }
  });
});

//user analytics data 
var chartDom = document.getElementById('echart_donut');
var myChart = echarts.init(chartDom);
var option;

option = {
  tooltip: {
    trigger: 'item'
  },
  legend: {
    top: '5%',
    left: 'center'
  },
  series: [
    {
      name: 'Access From',
      type: 'pie',
      radius: ['40%', '70%'],
      avoidLabelOverlap: false,
      itemStyle: {
        borderRadius: 10,
        borderColor: '#fff',
        borderWidth: 2
      },
      label: {
        show: false,
        position: 'center'
      },
      emphasis: {
        label: {
          show: true,
          fontSize: '40',
          fontWeight: 'bold'
        }
      },
      labelLine: {
        show: false
      },
      data: [
        { value: 1048, name: 'Search Engine' },
        { value: 735, name: 'Direct' },
        { value: 580, name: 'Email' },
        { value: 484, name: 'Union Ads' },
        { value: 300, name: 'Video Ads' }
      ]
    }
  ]
};

option && myChart.setOption(option);