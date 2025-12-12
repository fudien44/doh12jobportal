<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Gender Chart
        var genderCtx = document.getElementById('genderChart');
        if (genderCtx) {
            new Chart(genderCtx.getContext('2d'), {
                type: 'pie',
                data: {
                    labels: [
                        'Male','Female','Transgender','Two-Spirit','Cisgender',
                        'Non-binary','Genderqueer','Gender expression',
                        'Gender fluid','Gender neutral','Prefer Not to Say'
                    ],
                    datasets: [{
                        data: [
                            {{ $maleCount ?? 0 }},
                            {{ $femaleCount ?? 0 }},
                            {{ $transgenderCount ?? 0 }},
                            {{ $twoSpiritCount ?? 0 }},
                            {{ $cisgenderCount ?? 0 }},
                            {{ $nonBinaryCount ?? 0 }},
                            {{ $genderqueerCount ?? 0 }},
                            {{ $genderExpressionCount ?? 0 }},
                            {{ $genderFluidCount ?? 0 }},
                            {{ $genderNeutralCount ?? 0 }},
                            {{ $preferNotSayCount ?? 0 }}
                        ],
                        backgroundColor: [
                            '#007bff','#28a745','#ffc107','#6f42c1','#fd7e14',
                            '#20c997','#6610f2','#e83e8c','#17a2b8','#343a40','#adb5bd'
                        ]
                    }]
                },
                options: { responsive: true, plugins: { legend: { position: 'bottom' } } }
            });
        }

        // Age Chart
        var ageCtx = document.getElementById('ageChart');
        if (ageCtx) {
            new Chart(ageCtx.getContext('2d'), {
                type: 'bar',
                data: {
                    labels: ['18-24','25-29','30-34','35-39','40+'],
                    datasets: [{
                        label: 'Number of Applicants',
                        data: [
                            {{ $age1824 ?? 0 }},
                            {{ $age2529 ?? 0 }},
                            {{ $age3034 ?? 0 }},
                            {{ $age3539 ?? 0 }},
                            {{ $age40plus ?? 0 }}
                        ],
                        backgroundColor: '#17a2b8'
                    }]
                },
                options: { responsive: true, plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true } } }
            });
        }

        // Education Level
        var eduCtx = document.getElementById('educationChart');
        if (eduCtx) {
            new Chart(eduCtx.getContext('2d'), {
                type: 'bar',
                data: {
                    labels: ['N/A', 'Vocational/Trade', 'College', 'Graduate Studies'],
                    datasets: [{
                        label: 'Number of Applicants',
                        data: [
                            {{ $eduNA ?? 0 }},
                            {{ $eduVocational ?? 0 }},
                            {{ $eduCollege ?? 0 }},
                            {{ $eduGraduate ?? 0 }}
                        ],
                        backgroundColor: '#6f42c1'
                    }]
                },
                options: {
                    responsive: true,
                    plugins: { legend: { display: false } },
                    scales: { y: { beginAtZero: true } }
                }
            });
        }


        // ethnicity Chart
        var ethCtx = document.getElementById('ethnicityChart');
            if (ethCtx) {
                new Chart(ethCtx.getContext('2d'), {
                    type: 'bar',
                    data: {
                        labels: @json($ethLabels),   // top ethnicities
                        datasets: [{
                            label: 'Number of Applicants',
                            data: @json($ethData),
                            backgroundColor: ['#007bff','#28a745','#fd7e14','#6f42c1','#17a2b8'] // one color per bar
                        }]
                    },
                    options: {
                        indexAxis: 'y', // horizontal
                        responsive: true,
                        plugins: { legend: { display: false } },
                        scales: { x: { beginAtZero: true } }
                    }
                });
            }


        // PWD Chart
        var pwdCtx = document.getElementById('pwdChart');
        if (pwdCtx) {
            new Chart(pwdCtx.getContext('2d'), {
                type: 'pie',
                data: {
                    labels: ['PWD', 'Non-PWD'],
                    datasets: [{
                        data: [{{ $pwdCount ?? 0 }}, {{ $nonPwdCount ?? 0 }}],
                        backgroundColor: ['#dc3545','#6c757d']
                    }]
                },
                options: {
                    responsive: true,
                    plugins: { legend: { position: 'bottom' } }
                }
            });
        }

        // Solo Parent Chart
        var soloCtx = document.getElementById('soloChart');
        if (soloCtx) {
            new Chart(soloCtx.getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: ['Yes', 'No'],
                    datasets: [{
                        data: [{{ $soloYes ?? 0 }}, {{ $soloNo ?? 0 }}],
                        backgroundColor: ['#17a2b8','#6c757d']
                    }]
                },
                options: {
                    responsive: true,
                    plugins: { legend: { position: 'bottom' } }
                }
            });
        }

        // Religion Chart
        var ethCtx = document.getElementById('religionChart');
            if (ethCtx) {
                new Chart(ethCtx.getContext('2d'), {
                    type: 'bar',
                    data: {
                        labels: @json($relLabels),   // top religions
                        datasets: [{
                            label: 'Number of Applicants',
                            data: @json($relData),
                            backgroundColor: ['#007bff','#28a745','#fd7e14','#6f42c1','#17a2b8'] // one color per bar
                        }]
                    },
                    options: {
                        indexAxis: 'y', // horizontal
                        responsive: true,
                        plugins: { legend: { display: false } },
                        scales: { x: { beginAtZero: true } }
                    }
                });
            }

        });
</script>
