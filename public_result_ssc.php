<?php include "header.php"; ?>

<section class="public-results-section py-5">
    <div class="container">
        <h2 class="text-center section-title mb-5">ANALYSIS OF PUBLIC RESULTS</h2>
        
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white">
                <h4>Secondary School Certificate (SSC)</h4>
            </div>
            <div class="card-body">
                <!-- Summary View -->
                <div id="summary-view">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Total Statistics (2011-2025)</h5>
                            <div class="stats-box p-3 mb-3 bg-light rounded">
                                <div class="row">
                                    <div class="col-4 text-center">
                                        <div class="stat-value">1,473</div>
                                        <div class="stat-label">APPEARED</div>
                                    </div>
                                    <div class="col-4 text-center">
                                        <div class="stat-value">1,226</div>
                                        <div class="stat-label">PASSED</div>
                                    </div>
                                    <div class="col-4 text-center">
                                        <div class="stat-value">247</div>
                                        <div class="stat-label">FAILED</div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-4 text-center">
                                        <div class="stat-value">41</div>
                                        <div class="stat-label">A+</div>
                                    </div>
                                    <div class="col-4 text-center">
                                        <div class="stat-value">83.23%</div>
                                        <div class="stat-label">PASS RATE</div>
                                    </div>
                                    <div class="col-4 text-center">
                                        <div class="stat-value">2.78%</div>
                                        <div class="stat-label">A+ RATE</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5>Average Statistics (2011-2025)</h5>
                            <div class="stats-box p-3 bg-light rounded">
                                <div class="row">
                                    <div class="col-4 text-center">
                                        <div class="stat-value">98.20</div>
                                        <div class="stat-label">APPEARED</div>
                                    </div>
                                    <div class="col-4 text-center">
                                        <div class="stat-value">81.73</div>
                                        <div class="stat-label">PASSED</div>
                                    </div>
                                    <div class="col-4 text-center">
                                        <div class="stat-value">16.47</div>
                                        <div class="stat-label">FAILED</div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-4 text-center">
                                        <div class="stat-value">2.73</div>
                                        <div class="stat-label">A+</div>
                                    </div>
                                    <div class="col-4 text-center">
                                        <div class="stat-value">7,001.07</div>
                                        <div class="stat-label">NATIONAL RANK</div>
                                    </div>
                                    <div class="col-4 text-center">
                                        <div class="stat-value">1,733.13</div>
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
                                    <td>SSC</td>
                                    <td>2025</td>
                                    <td>Dhaka</td>
                                    <td>147</td>
                                    <td>115</td>
                                    <td>32</td>
                                    <td>25</td>
                                    <td>78.23%</td>
                                    <td>17.01%</td>
                                    <td>3346th</td>
                                    <td>464th</td>
                                    <td>620th</td>
                                    <td>256th</td>
                                </tr>
                                <tr>
                                    <td>SSC</td>
                                    <td>2024</td>
                                    <td>Dhaka</td>
                                    <td>81</td>
                                    <td>66</td>
                                    <td>15</td>
                                    <td>0</td>
                                    <td>81.48%</td>
                                    <td>0.00%</td>
                                    <td>9451st</td>
                                    <td>1784th</td>
                                    <td>2158th</td>
                                    <td>581st</td>
                                </tr>
                                <tr>
                                    <td>SSC</td>
                                    <td>2023</td>
                                    <td>Dhaka</td>
                                    <td>146</td>
                                    <td>133</td>
                                    <td>13</td>
                                    <td>8</td>
                                    <td>91.10%</td>
                                    <td>5.48%</td>
                                    <td>4800th</td>
                                    <td>637th</td>
                                    <td>775th</td>
                                    <td>311th</td>
                                </tr>
                                <tr>
                                    <td>SSC</td>
                                    <td>2022</td>
                                    <td>Dhaka</td>
                                    <td>68</td>
                                    <td>66</td>
                                    <td>2</td>
                                    <td>1</td>
                                    <td>97.06%</td>
                                    <td>1.47%</td>
                                    <td>6942nd</td>
                                    <td>1275th</td>
                                    <td>1448th</td>
                                    <td>441st</td>
                                </tr>
                                <tr>
                                    <td>SSC</td>
                                    <td>2021</td>
                                    <td>Dhaka</td>
                                    <td>88</td>
                                    <td>73</td>
                                    <td>15</td>
                                    <td>0</td>
                                    <td>82.95%</td>
                                    <td>0.00%</td>
                                    <td>11774th</td>
                                    <td>2615th</td>
                                    <td>3057th</td>
                                    <td>739th</td>
                                </tr>
                                <tr>
                                    <td>SSC</td>
                                    <td>2020</td>
                                    <td>Dhaka</td>
                                    <td>89</td>
                                    <td>72</td>
                                    <td>17</td>
                                    <td>0</td>
                                    <td>80.90%</td>
                                    <td>0.00%</td>
                                    <td>8905th</td>
                                    <td>1732nd</td>
                                    <td>2067th</td>
                                    <td>606th</td>
                                </tr>
                                <tr>
                                    <td>SSC</td>
                                    <td>2019</td>
                                    <td>Dhaka</td>
                                    <td>108</td>
                                    <td>73</td>
                                    <td>35</td>
                                    <td>0</td>
                                    <td>67.59%</td>
                                    <td>0.00%</td>
                                    <td>10689th</td>
                                    <td>2787th</td>
                                    <td>2586th</td>
                                    <td>685th</td>
                                </tr>
                                <tr>
                                    <td>SSC</td>
                                    <td>2018</td>
                                    <td>Dhaka</td>
                                    <td>112</td>
                                    <td>64</td>
                                    <td>48</td>
                                    <td>0</td>
                                    <td>57.14%</td>
                                    <td>0.00%</td>
                                    <td>11304th</td>
                                    <td>3453rd</td>
                                    <td>2966th</td>
                                    <td>735th</td>
                                </tr>
                                <tr>
                                    <td>SSC</td>
                                    <td>2017</td>
                                    <td>Dhaka</td>
                                    <td>95</td>
                                    <td>81</td>
                                    <td>14</td>
                                    <td>3</td>
                                    <td>85.26%</td>
                                    <td>3.16%</td>
                                    <td>5785th</td>
                                    <td>2065th</td>
                                    <td>1817th</td>
                                    <td>589th</td>
                                </tr>
                                <tr>
                                    <td>SSC</td>
                                    <td>2016</td>
                                    <td>Dhaka</td>
                                    <td>100</td>
                                    <td>94</td>
                                    <td>6</td>
                                    <td>0</td>
                                    <td>94.00%</td>
                                    <td>0.00%</td>
                                    <td>5166th</td>
                                    <td>1481st</td>
                                    <td>1299th</td>
                                    <td>429th</td>
                                </tr>
                                <tr>
                                    <td>SSC</td>
                                    <td>2015</td>
                                    <td>Dhaka</td>
                                    <td>82</td>
                                    <td>68</td>
                                    <td>14</td>
                                    <td>0</td>
                                    <td>82.93%</td>
                                    <td>0.00%</td>
                                    <td>7050th</td>
                                    <td>2209th</td>
                                    <td>2149th</td>
                                    <td>581st</td>
                                </tr>
                                <tr>
                                    <td>SSC</td>
                                    <td>2014</td>
                                    <td>Dhaka</td>
                                    <td>94</td>
                                    <td>90</td>
                                    <td>4</td>
                                    <td>3</td>
                                    <td>95.74%</td>
                                    <td>3.19%</td>
                                    <td>4684th</td>
                                    <td>1324th</td>
                                    <td>1263rd</td>
                                    <td>432nd</td>
                                </tr>
                                <tr>
                                    <td>SSC</td>
                                    <td>2013</td>
                                    <td>Dhaka</td>
                                    <td>90</td>
                                    <td>73</td>
                                    <td>17</td>
                                    <td>0</td>
                                    <td>81.11%</td>
                                    <td>0.00%</td>
                                    <td>6731st</td>
                                    <td>1940th</td>
                                    <td>1911th</td>
                                    <td>570th</td>
                                </tr>
                                <tr>
                                    <td>SSC</td>
                                    <td>2012</td>
                                    <td>Dhaka</td>
                                    <td>94</td>
                                    <td>84</td>
                                    <td>10</td>
                                    <td>0</td>
                                    <td>89.36%</td>
                                    <td>0.00%</td>
                                    <td>5009th</td>
                                    <td>1288th</td>
                                    <td>1433rd</td>
                                    <td>453rd</td>
                                </tr>
                                <tr>
                                    <td>SSC</td>
                                    <td>2011</td>
                                    <td>Dhaka</td>
                                    <td>79</td>
                                    <td>74</td>
                                    <td>5</td>
                                    <td>1</td>
                                    <td>93.67%</td>
                                    <td>1.27%</td>
                                    <td>3380th</td>
                                    <td>943rd</td>
                                    <td>1029th</td>
                                    <td>387th</td>
                                </tr>
                            </tbody>
                            <tfoot class="font-weight-bold">
                                <tr>
                                    <td colspan="3">TOTAL/AVERAGE</td>
                                    <td>1,473</td>
                                    <td>1,226</td>
                                    <td>247</td>
                                    <td>41</td>
                                    <td>83.23%</td>
                                    <td>2.78%</td>
                                    <td>7,001.07</td>
                                    <td>1,733.13</td>
                                    <td>1,771.87</td>
                                    <td>519.67</td>
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