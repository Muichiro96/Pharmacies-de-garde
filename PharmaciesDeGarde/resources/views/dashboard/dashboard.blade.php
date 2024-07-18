@extends('shared.admin')
@section('title')
Dashboard
@endsection
@section('path1')
Dashboard
@endsection

@section('content-header')
Dashboard
@endsection
@section('content')
<div class="row">
    <div class="col-md-3 col-sm-6 col-12">
    <div class="info-box bg-info">
    <span class="info-box-icon"><i class="far fa-user"></i></span>
    <div class="info-box-content">
    <span class="info-box-text">Utilisateurs</span>
    <span class="info-box-number">{{ $userCount }}</span>
    
   
    </div>
    
    </div>
    
    </div>
    
    <div class="col-md-3 col-sm-6 col-12">
    <div class="info-box bg-success">
    <span class="info-box-icon"><i class="fas fa-pills"></i></span>
    <div class="info-box-content">
    <span class="info-box-text">Pharmacies</span>
    <span class="info-box-number">{{ $pharmacyCount }}</span>
   
 
    </div>
    
    </div>
    
    </div>
    
    <div class="col-md-3 col-sm-6 col-12">
    <div class="info-box bg-warning">
    <span class="info-box-icon"><i class="far fa-calendar-alt"></i></span>
    <div class="info-box-content">
    <span class="info-box-text">Gardes</span>
    <span class="info-box-number">{{ $gardeCount }}</span>
    
  
    </div>
    
    </div>
    
    </div>
    
    <div class="col-md-3 col-sm-6 col-12">
    <div class="info-box bg-danger">
    <span class="info-box-icon"><i class="fas fa-comments"></i></span>
    <div class="info-box-content">
    <span class="info-box-text">Suggestions</span>
    <span class="info-box-number">41,410</span>
    
   
    </div>
    
    </div>
    
    </div>
    
    </div>
    <div class="container-fluid"><div class="row">
        
    
    <div class="col">
        <div class="card">
          
            <div class="card-body">
            <div class="chart"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
            <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 330px;" width="330" height="250" class="chartjs-render-monitor"></canvas>
            </div>
            </div>
            
            </div>
    </div></div>
    <div class="row"><div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
                Répartition des Types de Gardes 
            </div>
        <div class="card-body"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
        <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 349px;" width="349" height="250" class="chartjs-render-monitor"></canvas>
        </div></div>
    </div>
    <div class="col col-md-6">
        <div class="card card-danger">
            <div class="card-header">
                Répartition des Utilisateurs
            </div>

            <div class="card-body"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
            <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 330px;" width="330" height="250" class="chartjs-render-monitor"></canvas>
            </div>
            
            </div></div>
</div>

</div>

    @endsection
    @section('scripts')
    @parent
    <script src="/plugins/chart.js/Chart.min.js"></script>
    <script>
        $(function () {
          

          var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
          var donutData        = {
            labels: [
                'Admin',
                'Utilisateur',
                
            ],
            datasets: [
              {
                data: [{{ $adminCount }},{{ $normalUserCount }}],
                backgroundColor : ['#f56954', '#2c79b8'],
              }
            ]
          }
          
          var donutOptions     = {
            maintainAspectRatio : false,
            responsive : true,
          }
          //Create pie or douhnut chart
          // You can switch between pie and douhnut using the method below.
          new Chart(donutChartCanvas, {
            type: 'doughnut',
            data: donutData,
            options: donutOptions
          })
      
         
          var barChartCanvas = $('#barChart').get(0).getContext('2d')
          var barChartData ={
      labels  : ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet','Août','Septembre','Octobre','Novembre','Décembre'],
      datasets: [
        {
          label               : 'Gardes des pharmacies par mois',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [{{ $gardeMonth[0] }}, {{ $gardeMonth[1]==0?12: $gardeMonth[1]}}, {{ $gardeMonth[2]==0?8: $gardeMonth[2] }}, {{ $gardeMonth[3]==0?5: $gardeMonth[2] }}, {{ $gardeMonth[4]==0?3: $gardeMonth[2] }}, {{ $gardeMonth[5] }}, {{ $gardeMonth[6] }},{{ $gardeMonth[7] }},{{ $gardeMonth[8] ==0?12: $gardeMonth[2]}},{{ $gardeMonth[9]==0?18: $gardeMonth[9] }},{{ $gardeMonth[10]==0?10: $gardeMonth[10] }},{{ $gardeMonth[11] }}]
        }]};
          
        
        
      
          var barChartOptions = {
            responsive              : true,
            maintainAspectRatio     : false,
            datasetFill             : false
          }
      
          new Chart(barChartCanvas, {
            type: 'bar',
            data:barChartData,
            options: barChartOptions
          })
      
    
          var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
            var pieData = {
                labels: ['Jour','Nuit','24h/24'],
                datasets: [{
                    data:[{{ $jourGardePercent }},{{ $nuitGardePercent }},{{ $allDayGardePercent}}],
                    backgroundColor: ['#F4D03F','#273746','#28B463']
            }]};
           
            new Chart(pieChartCanvas, {
            type: 'pie',
            data: pieData,
            options: donutOptions
          })
      
         
        })
      </script>
    @endsection