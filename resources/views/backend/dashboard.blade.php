@extends('layouts.admin.app')

@section('title','Dashboard')

@push('css')

@endpush

@section('content')
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Version 1.0</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
     <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
         <!--  <a href="{{ action('Admin\ContactController@index', ['type' => 'customer']) }}"> -->
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-android-contacts"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Customers</span>
              <span class="info-box-number">{{ count($customer) }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- </a> -->
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <!-- <a  href="{{ route('sells.index') }}"> -->
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="ion ion-android-cart"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Sales Amount</span>
              <span class="info-box-number">৳ {{ $total_sale }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
          <!-- </a> -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <!-- <a  href="{{ route('products.index') }}"> -->
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-product-hunt"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Products</span>
              <span class="info-box-number">{{ count($product) }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
          <!-- </a> -->
        </div>
        <!-- /.col -->
          <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <!-- <a  href="{{ route('categories.index') }}"> -->
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-list"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Category</span>
              <span class="info-box-number">{{ count($category) }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- </a> -->
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
       
      </div>
      <!-- /.row -->
      <div class="row">
         <div class="col-md-3 col-sm-6 col-xs-12">
          <!-- <a href="{{ action('Admin\ContactController@index', ['type' => 'supplier']) }}"> -->
          
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Supplier</span>
              <span class="info-box-number">{{ count($supplier) }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
          <!-- </a> -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <!-- <a  href="{{ route('categories.index') }}"> -->
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-cart-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Purchase</span>
              <span class="info-box-number">৳ {{ $total_purchase }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
          <!-- </a> -->
        </div>
      

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <!-- <a  href="{{ route('sells.index') }}"> -->
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-bar-chart"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Sales Count</span>
              <span class="info-box-number">{{ count($sale_count) }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- </a> -->
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <div class="col-md-3 col-sm-6 col-xs-12">
          <!-- <a  href="{{ route('brands.index') }}"> -->
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-ravelry"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Brands</span>
              <span class="info-box-number">{{ count($brand) }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
          <!-- </a> -->
        </div>
        <!-- /.col -->
      </div>
      <hr>
      <!-- /.row -->
      <div class="row">
               
          <!-- /.col -->
        <div class="col-md-6">
           <p class="text-center">
            <strong>Today Total Sales Amount</strong>
          </p>
           
          <!-- /.info-box -->
          <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i></span>

            <div class="info-box-content">
              @php
                    $dt = Carbon\Carbon::today();
              @endphp
              <span class="info-box-text">{{$dt->format('l, j, F Y') }}</span>
              <span class="info-box-number"> 
              {{ $forecast['today_sales'] }} taka</span>
              <div class="progress">
                <!-- <div class="progress-bar" style="width: 40%"></div> -->
              </div>
              <span class="progress-description">
                    Today Total Sales Amount
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- end today sales -->
          <p class="text-center">
            <strong>Sales Forecast</strong>
          </p>
           
          <!-- /.info-box -->
          <div class="info-box bg-green">
            <span class="info-box-icon"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">{{Carbon\Carbon::now()->format('M, Y')}}</span>
              <span class="info-box-number"> 
              {{ round(($forecast['one']+$forecast['two']+$forecast['three'])/3)}} taka</span>
              <div class="progress">
                <!-- <div class="progress-bar" style="width: 40%"></div> -->
              </div>
              <span class="progress-description">
                    Sales Prediction in this month
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>


          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Previous Sales Statistics</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <ul class="products-list product-list-in-box">
                 <li class="item">
                  <div class="product-info">
                    <a  class="product-title">
                     {{ 'This Month '}}
                      <span class="label lg-label label-info pull-right">{{ $forecast['thisMonth'] }} taka</span></a>
                
                  </div>
                </li>
                <li class="item">
                  <div class="product-info">
                    <a  class="product-title">
                      @php 
                        $add = Carbon\Carbon::parse($previous_months['first_day_of_month_1']);
                      @endphp
                      {{ $add->Format('M, Y')  }}
                      <span class="label lg-label label-info pull-right">{{ $forecast['one'] }} taka</span></a>
                
                  </div>
                </li>
                <li class="item">
                  <div class="product-info">
                    <a  class="product-title">
                      @php 
                        $add = Carbon\Carbon::parse($previous_months['first_day_of_month_2']);
                      @endphp
                      {{ $add->Format('M, Y')  }}
                      <span class="label lg-label label-info pull-right">{{ $forecast['two'] }} taka</span></a>
                
                  </div>
                </li>
                <li class="item">
                  <div class="product-info">
                    <a  class="product-title">
                      @php 
                        $add = Carbon\Carbon::parse($previous_months['first_day_of_month_3']);
                      @endphp
                      {{ $add->Format('M, Y')  }}
                      <span class="label lg-label label-info pull-right">{{ $forecast['three'] }} taka</span></a>
                
                  </div>
                </li>
               
              </ul>
            </div>
          
          </div>
        
          </div>
          <!-- end forecast -->

        <!-- /.col -->
        <div class="col-md-6">
          <div class="box box-default">
            <div class="box-header with-border">
                  @php
                      $dst = new Carbon\Carbon($target_data['start_date']);
                  @endphp
                   @php
                      $det = new Carbon\Carbon($target_data['end_date']);
                  @endphp

              <h3 class="box-title">Sales Target: ({{ $dst->toFormattedDateString() }} to {{ $det->toFormattedDateString() }})</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="chart-responsive">
                    <canvas id="pieChart" height="165" width="205" style="width: 205px; height: 165px;"></canvas>
                  </div>
                  <!-- ./chart-responsive -->
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                  <ul class="chart-legend clearfix">
                    <li><i class="fa fa-circle-o text-green"></i> Total Completed</li>
                    <li><i class="fa fa-circle-o text-red"></i> Remaining</li>
                    <!-- <li><i class="fa fa-circle-o text-yellow"></i> Remaining</li> -->
                  </ul>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="#">Target Amount
                  <span class="pull-right text-red">{{ $target_data['target_amount'] }} tk</span></a></li>
                </li>
                <li><a href="#">Total Completed
                  <span class="pull-right text-green">{{ $target_data['total_sales'] }} tk</span></a></li>

              </ul>
            </div>
            <!-- /.footer -->
          </div>
        </div>

     </div>

    </section>
    <!-- /.content -->

@endsection

@push('script')
<script>

  $(function () {

    'use strict';
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d');
    var pieChart       = new Chart(pieChartCanvas);
    var PieData        = [

      {
        //calculate the total completed
        value    : {{ round((100*$target_data['total_sales'])/ $target_data['target_amount'])>100 ? 100 : round((100*$target_data['total_sales'])/ $target_data['target_amount']) }},

        color    : '#00a65a',
        highlight: '#00a65a',
        label    : '% Completed'
      },
      {
        //calculate the remainging %
        value    : {{ (round((100*$target_data['total_sales'])/ $target_data['target_amount'])) > 100 ? 0 : round((100- (100*$target_data['total_sales'])/ $target_data['target_amount']))  }},

        color    : '#f56954',
        highlight: '#f56954',
        label    : '% Remaining'
      },
      
    
    ];


      var pieOptions     = {
    // Boolean - Whether we should show a stroke on each segment
    segmentShowStroke    : true,
    // String - The colour of each segment stroke
    segmentStrokeColor   : '#fff',
    // Number - The width of each segment stroke
    segmentStrokeWidth   : 1,
    // Number - The percentage of the chart that we cut out of the middle
    percentageInnerCutout: 50, // This is 0 for Pie charts
    // Number - Amount of animation steps
    animationSteps       : 100,
    // String - Animation easing effect
    animationEasing      : 'easeOutBounce',
    // Boolean - Whether we animate the rotation of the Doughnut
    animateRotate        : true,
    // Boolean - Whether we animate scaling the Doughnut from the centre
    animateScale         : false,
    // Boolean - whether to make the chart responsive to window resizing
    responsive           : true,
    // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio  : false,
    // String - A legend template
    legendTemplate       : '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<segments.length; i++){%><li><span style=\'background-color:<%=segments[i].fillColor%>\'></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>',
    // String - A tooltip template
    tooltipTemplate      : '<%=value %> <%=label%>'
  };
  // Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  pieChart.Doughnut(PieData, pieOptions);
  // -----------------
  // - END PIE CHART -
  // -----------------

  });
</script>

@endpush