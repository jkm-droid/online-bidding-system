
<div class="row">
    <section class="col-lg-6">

        <div class="card shadow mb-4 myPieChart">
            <canvas id="myPieChart"></canvas>
        </div>

    </section>

    <section class="col-lg-6">

        <div class="card shadow mb-4 memberPieChart">
            <canvas id="memberPieChart"></canvas>
        </div>

    </section>

</div>

<section class="card shadow mb-4 col-md-12">
    <canvas id="groupChart"></canvas>
</section>

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

<script>
    const ctx = document.getElementById('myPieChart').getContext('2d');

    const chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'pie',
        // The data for our dataset
        data: {
            labels: ['Balance', 'Fine', 'Contributions', 'Advance'],
            datasets: [
                {
                    label: 'Certified',
                    data: [{{ $myBalance }}, {{ $myFine }}, {{ $myContribution }}, {{ $myAdvance }}],
                    backgroundColor: [
                        'rgba(241,41,69,0.8)',
                        'rgba(205,19,234,0.8)',
                        'rgba(11,182,65,0.8)',
                        'rgba(159,98,106,0.8)',
                    ],
                }
            ],
        },
        // Configuration options go here
        options: {
            title: {
                display: true,
                text: 'My Statistics',
            },
            legend: {
                labels: {
                    // This more specific font property overrides the global property
                    fontColor: '#122C4B',
                    fontFamily: "'Muli', sans-serif",
                    padding: 25,
                    boxWidth: 25,
                    fontSize: 14,
                }
            },
            layout: {
                padding: {
                    left: 10,
                    right: 10,
                    top: 0,
                    bottom: 10
                }
            }
        }
    });
</script>

<script>
    const memberContext = document.getElementById('memberPieChart').getContext('2d');

    const memberChart = new Chart(memberContext, {
        // The type of chart we want to create
        type: 'pie',
        // The data for our dataset
        data: {
            labels: ['Contributions', 'Balance'],
            datasets: [
                {
                    label: 'Certified',
                    data: [{{ $totalContributions }}, {{ $totalBalances }}],
                    backgroundColor: [
                        'rgba(11,182,65,0.8)',
                        'rgba(241,41,69,0.8)',
                    ],
                }
            ],
        },
        // Configuration options go here
        options: {
            title: {
                display: true,
                text: 'Group Statistics',
            },
            legend: {
                labels: {
                    // This more specific font property overrides the global property
                    fontColor: '#122C4B',
                    fontFamily: "'Muli', sans-serif",
                    padding: 25,
                    boxWidth: 25,
                    fontSize: 14,
                }
            },
            layout: {
                padding: {
                    left: 10,
                    right: 10,
                    top: 0,
                    bottom: 10
                }
            }
        }
    });
</script>

<script>
    var year  = new Date().getFullYear();
    var groupContext = document.getElementById('groupChart').getContext('2d');
    var groupChart = new Chart(groupContext, {
        // The type of chart we want to create
        type: 'bar',
        // The data for our dataset
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul','Aug','Sept','Oct','Nov','Dec'],
            datasets: [
                {
                    label: 'Contributions',
                    backgroundColor:  'rgba(11,182,65,0.8)' ,
                    data:  {!! json_encode($monthlyContributions) !!} ,
                },
                {
                    label: 'Balances',
                    backgroundColor:  'rgba(241,41,69,0.8)' ,
                    data:  {!! json_encode($monthlyBalances) !!} ,
                },
                {
                    label: 'Advances',
                    backgroundColor:  'rgba(218,225,10,0.8)' ,
                    data:  {!! json_encode($monthlyAdvances) !!} ,
                },
                {
                    label: 'Fines',
                    backgroundColor:  'rgba(98,21,232,0.8)' ,
                    data:  {!! json_encode($monthlyFines) !!} ,
                },

            ],
        },
        // Configuration options go here
        options: {
            title: {
                display: true,
                text: 'Group Yearly('+year+') Statistics',
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        callback: function(value) {if (value % 1 === 0) {return value;}}
                    },
                    scaleLabel: {
                        display: false
                    }
                }]
            },
            legend: {
                labels: {
                    // This more specific font property overrides the global property
                    fontColor: '#122C4B',
                    fontFamily: "'Muli', sans-serif",
                    padding: 25,
                    boxWidth: 25,
                    fontSize: 14,
                }
            },
            layout: {
                padding: {
                    left: 10,
                    right: 10,
                    top: 0,
                    bottom: 10
                }
            }
        }
    });
</script>
