<?php include "header.php"; ?>

<section class="public-results-section py-5">
    <div class="container">
        <h2 class="text-center section-title mb-5">ANALYSIS OF PUBLIC RESULTS</h2>
        
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white">
                <h4>Junior School Certificate (JSC)</h4>
            </div>
            <div class="card-body">
                <!-- Summary View -->
                <div id="summary-view">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Total Statistics (2010-2019)</h5>
                            <div class="stats-box p-3 mb-3 bg-light rounded">
                                <div class="row">
                                    <div class="col-4 text-center">
                                        <div class="stat-value">1,381</div>
                                        <div class="stat-label">APPEARED</div>
                                    </div>
                                    <div class="col-4 text-center">
                                        <div class="stat-value">1,030</div>
                                        <div class="stat-label">PASSED</div>
                                    </div>
                                    <div class="col-4 text-center">
                                        <div class="stat-value">351</div>
                                        <div class="stat-label">FAILED</div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-4 text-center">
                                        <div class="stat-value">10</div>
                                        <div class="stat-label">A+</div>
                                    </div>
                                    <div class="col-4 text-center">
                                        <div class="stat-value">74.58%</div>
                                        <div class="stat-label">PASS RATE</div>
                                    </div>
                                    <div class="col-4 text-center">
                                        <div class="stat-value">0.72%</div>
                                        <div class="stat-label">A+ RATE</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5>Average Statistics (2010-2019)</h5>
                            <div class="stats-box p-3 bg-light rounded">
                                <div class="row">
                                    <div class="col-4 text-center">
                                        <div class="stat-value">138.10</div>
                                        <div class="stat-label">APPEARED</div>
                                    </div>
                                    <div class="col-4 text-center">
                                        <div class="stat-value">103.00</div>
                                        <div class="stat-label">PASSED</div>
                                    </div>
                                    <div class="col-4 text-center">
                                        <div class="stat-value">35.10</div>
                                        <div class="stat-label">FAILED</div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-4 text-center">
                                        <div class="stat-value">1.00</div>
                                        <div class="stat-label">A+</div>
                                    </div>
                                    <div class="col-4 text-center">
                                        <div class="stat-value">8,764.40</div>
                                        <div class="stat-label">NATIONAL RANK</div>
                                    </div>
                                    <div class="col-4 text-center">
                                        <div class="stat-value">2,684.40</div>
                                        <div class="stat-label">BOARD RANK</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button id="show-details-btn" class="btn btn-primary">Show Details +</button>
                    </div>
                </div>
                
                <!-- Detailed View (initially hidden) -->
                <div id="detailed-view" style="display: none;">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>EXAM</th>
                                    <th>YEAR</th>
                                    <th>BOARD</th>
                                    <th>APPEARED</th>
                                    <th>PASSED</th>
                                    <th>FAILED</th>
                                    <th>A+</th>
                                    <th>PASS %</th>
                                    <th>A+ %</th>
                                    <th>NATIONAL RANK</th>
                                    <th>BOARD RANK</th>
                                    <th>DIVISION RANK</th>
                                    <th>DISTRICT RANK</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>JSC</td>
                                    <td>2019</td>
                                    <td>Dhaka</td>
                                    <td>107</td>
                                    <td>80</td>
                                    <td>27</td>
                                    <td>1</td>
                                    <td>74.77%</td>
                                    <td>0.93%</td>
                                    <td>10011th</td>
                                    <td>2325th</td>
                                    <td>2565th</td>
                                    <td>703rd</td>
                                </tr>
                                <tr>
                                    <td>JSC</td>
                                    <td>2018</td>
                                    <td>Dhaka</td>
                                    <td>157</td>
                                    <td>80</td>
                                    <td>77</td>
                                    <td>0</td>
                                    <td>50.96%</td>
                                    <td>0.00%</td>
                                    <td>11814th</td>
                                    <td>4084th</td>
                                    <td>3474th</td>
                                    <td>787th</td>
                                </tr>
                                <tr>
                                    <td>JSC</td>
                                    <td>2017</td>
                                    <td>Dhaka</td>
                                    <td>140</td>
                                    <td>93</td>
                                    <td>47</td>
                                    <td>2</td>
                                    <td>66.43%</td>
                                    <td>1.43%</td>
                                    <td>12278th</td>
                                    <td>3647th</td>
                                    <td>3196th</td>
                                    <td>745th</td>
                                </tr>
                                <tr>
                                    <td>JSC</td>
                                    <td>2016</td>
                                    <td>Dhaka</td>
                                    <td>172</td>
                                    <td>154</td>
                                    <td>18</td>
                                    <td>2</td>
                                    <td>89.53%</td>
                                    <td>1.16%</td>
                                    <td>9660th</td>
                                    <td>2885th</td>
                                    <td>2455th</td>
                                    <td>648th</td>
                                </tr>
                                <tr>
                                    <td>JSC</td>
                                    <td>2015</td>
                                    <td>Dhaka</td>
                                    <td>160</td>
                                    <td>121</td>
                                    <td>39</td>
                                    <td>1</td>
                                    <td>75.63%</td>
                                    <td>0.63%</td>
                                    <td>11426th</td>
                                    <td>3682nd</td>
                                    <td>3118th</td>
                                    <td>733rd</td>
                                </tr>
                                <tr>
                                    <td>JSC</td>
                                    <td>2014</td>
                                    <td>Dhaka</td>
                                    <td>160</td>
                                    <td>119</td>
                                    <td>41</td>
                                    <td>1</td>
                                    <td>74.38%</td>
                                    <td>0.63%</td>
                                    <td>10203rd</td>
                                    <td>2890th</td>
                                    <td>2737th</td>
                                    <td>639th</td>
                                </tr>
                                <tr>
                                    <td>JSC</td>
                                    <td>2013</td>
                                    <td>Dhaka</td>
                                    <td>107</td>
                                    <td>97</td>
                                    <td>10</td>
                                    <td>3</td>
                                    <td>90.65%</td>
                                    <td>2.80%</td>
                                    <td>7451st</td>
                                    <td>1932nd</td>
                                    <td>1821st</td>
                                    <td>514th</td>
                                </tr>
                                <tr>
                                    <td>JSC</td>
                                    <td>2012</td>
                                    <td>Dhaka</td>
                                    <td>117</td>
                                    <td>100</td>
                                    <td>17</td>
                                    <td>0</td>
                                    <td>85.47%</td>
                                    <td>0.00%</td>
                                    <td>5324th</td>
                                    <td>1737th</td>
                                    <td>1632nd</td>
                                    <td>517th</td>
                                </tr>
                                <tr>
                                    <td>JSC</td>
                                    <td>2011</td>
                                    <td>Dhaka</td>
                                    <td>156</td>
                                    <td>99</td>
                                    <td>57</td>
                                    <td>0</td>
                                    <td>63.46%</td>
                                    <td>0.00%</td>
                                    <td>7093rd</td>
                                    <td>2552nd</td>
                                    <td>2306th</td>
                                    <td>630th</td>
                                </tr>
                                <tr>
                                    <td>JSC</td>
                                    <td>2010</td>
                                    <td>Dhaka</td>
                                    <td>105</td>
                                    <td>87</td>
                                    <td>18</td>
                                    <td>0</td>
                                    <td>82.86%</td>
                                    <td>0.00%</td>
                                    <td>2384th</td>
                                    <td>1110th</td>
                                    <td>1079th</td>
                                    <td>433rd</td>
                                </tr>
                            </tbody>
                            <tfoot class="font-weight-bold">
                                <tr>
                                    <td colspan="3">TOTAL/AVERAGE</td>
                                    <td>1,381</td>
                                    <td>1,030</td>
                                    <td>351</td>
                                    <td>10</td>
                                    <td>74.58%</td>
                                    <td>0.72%</td>
                                    <td>8,764.40</td>
                                    <td>2,684.40</td>
                                    <td>2,438.30</td>
                                    <td>634.90</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="text-center mt-3">
                        <button id="hide-details-btn" class="btn btn-primary">Hide Details</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const showDetailsBtn = document.getElementById('show-details-btn');
    const hideDetailsBtn = document.getElementById('hide-details-btn');
    const summaryView = document.getElementById('summary-view');
    const detailedView = document.getElementById('detailed-view');
    
    showDetailsBtn.addEventListener('click', function() {
        summaryView.style.display = 'none';
        detailedView.style.display = 'block';
    });
    
    hideDetailsBtn.addEventListener('click', function() {
        detailedView.style.display = 'none';
        summaryView.style.display = 'block';
    });
});
</script>

<?php include "footer.php"; ?>