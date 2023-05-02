<div class="container">
    <canvas id="myChart"></canvas>
</div>

<script>
    const ctx = document.getElementById('myChart');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Present', 'Absent', 'WithPermit', 'No Permit'],
            datasets: [{
                label: '# No of Students',
                data: [12, 19, 3, 5],
                borderWidth: 1,
                backgroundColor: [
                    'rgba(255, 99, 132)',
                    'rgba(255, 159, 64)',
                    'rgba(255, 205, 8)',
                    'rgba(75, 192, 192)'
                ]
            },
            ] ,
        },
        options: {
            // indexAxis: 'y',
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
