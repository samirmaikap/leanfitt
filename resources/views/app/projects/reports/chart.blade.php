<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <canvas id="line-chart" height="500"></canvas>
        </div>
    </div>
</div>
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <canvas id="pareto-chart" height="500"></canvas>
        </div>
    </div>
</div>
<script>
    window.onload=function(){
        var data=[30, 25, 35, 23];
        lineChart('line-chart',data,'');
        paretoChart('pareto-chart')
    }
</script>