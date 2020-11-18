@extends('main')

@section('top_nav_page_name')
  <h1 class="page-title">HOME</h1>
@endsection

@section('body')
<div class="section-body mt-4">
  <div class="container-fluid">
    <!-- ==============================    Admin Dashboard    ============================== -->
    @if(Session::get('user_is_administrator')==1)
      <div class="row clearfix row-deck">
        <div class="col-xl-9 col-lg-8 col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Admin Dashboard</h3>
            </div>
            <div class="card-body">
              <div class="d-md-flex">
                <div class="card mr-1">
                  <div class="card-body">
                    <div class="text">Administrator</div>
                    <h5 class="counter">{{number_format($admin_dashboard['admin_num'])}}</h5>
                  </div>
                </div>
                <div class="card">
                  <div class="card-body">
                    <div class="text">Deputy</div>
                    <h5 class="counter">{{number_format($admin_dashboard['deputy_num'])}}</h5>
                  </div>
                </div>
                <div class="card mr-1">
                  <div class="card-body">
                    <div class="text">Coordinators</div>
                    <h5 class="counter">{{number_format($admin_dashboard['coordinator_num'])}}</h5>
                  </div>
                </div>
                <div class="card mr-1">
                  <div class="card-body">
                    <div class="text">Casual Academics</div>
                    <h5 class="counter">{{number_format($admin_dashboard['tutor_num'])}}</h5>
                  </div>
                </div>
              </div>
              <div id="echart-Customized_Pie" style="height: 400px;"></div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-12">
          <div class="row clearfix">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                <h6>Semester</h6>
                <h3 class="pt-1 counter">{{number_format($admin_dashboard['semester_num'])}}</h3>
                <span>{{date('Y-m-d')}}</span>
                </div>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                <h6>Unit of Study</h6>
                <h3 class="pt-1 counter">{{number_format($admin_dashboard['uos_num'])}}</h3>
                <span>{{date('Y-m-d')}}</span>
                </div>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                <h6>Tutorial</h6>
                <h3 class="pt-1 counter">{{number_format($admin_dashboard['tutorial_num'])}}</h3>
                <span>{{date('Y-m-d')}}</span>
                </div>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                <h6>Schedule</h6>
                <h3 class="pt-1 counter">{{number_format($admin_dashboard['schedule_num'])}}</h3>
                <span>{{date('Y-m-d')}}</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endif
    <!-- ==============================    Deputy Dashboard    ============================== -->
    @if(Session::get('user_is_deputy_hos')==3)
      <div class="row clearfix row-deck">
        <div class="col-xl-9 col-lg-8 col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Admin Dashboard</h3>
            </div>
            <div class="card-body">
              <div class="d-md-flex">
                <div class="card mr-1">
                  <div class="card-body">
                    <div class="text">Total Users</div>
                    <h5 class="counter">{{number_format($admin_dashboard['user_num'])}}</h5>
                  </div>
                </div>
                <div class="card">
                  <div class="card-body">
                    <div class="text">Deputy</div>
                    <h5 class="counter">{{number_format($admin_dashboard['deputy_num'])}}</h5>
                  </div>
                </div>
                <div class="card mr-1">
                  <div class="card-body">
                    <div class="text">Coordinators</div>
                    <h5 class="counter">{{number_format($admin_dashboard['coordinator_num'])}}</h5>
                  </div>
                </div>
                <div class="card mr-1">
                  <div class="card-body">
                    <div class="text">Casual Academics</div>
                    <h5 class="counter">{{number_format($admin_dashboard['tutor_num'])}}</h5>
                  </div>
                </div>
              </div>
              <div id="echart-Customized_Pie" style="height: 400px;"></div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-12">
          <div class="row clearfix">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                <h6>Semester</h6>
                <h3 class="pt-1 counter">{{number_format($admin_dashboard['semester_num'])}}</h3>
                <span>{{date('Y-m-d')}}</span>
                </div>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                <h6>Unit of Study</h6>
                <h3 class="pt-1 counter">{{number_format($admin_dashboard['uos_num'])}}</h3>
                <span>{{date('Y-m-d')}}</span>
                </div>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                <h6>Tutorial</h6>
                <h3 class="pt-1 counter">{{number_format($admin_dashboard['tutorial_num'])}}</h3>
                <span>{{date('Y-m-d')}}</span>
                </div>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                <h6>Schedule</h6>
                <h3 class="pt-1 counter">{{number_format($admin_dashboard['schedule_num'])}}</h3>
                <span>{{date('Y-m-d')}}</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endif
    <!-- ==============================    Coordinator Dashboard    ============================== -->
    @if(Session::get('user_is_uos_coordinator')==1)
      <div class="row ">
        <div class="col-xl-3 col-lg-4 col-md-12">
          <div class="card">
            <div class="card-body">
              <h3 class="card-title">Unit of Study</h3>
            </div>
            <hr>
            <div class="table-responsive">
              <table class="table card-table">
                <tbody>
                  @foreach($coordinator_dashboard['uoses'] as $uos)
                    <tr>
                      <td>
                        {{$uos->uos_code}} <br> {{$uos->uos_name}}
                      </td>
                      <td class="text-right"><span class="text-muted pt-2"><a href="/coordinator/uos/page?id={{$uos->uos_id}}" class="btn btn-primary" role="button">View</a></span></td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="col-xl-9 col-lg-8 col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Coordinator Dashboard</h3>
            </div>
            <div class="card-body">
              <div class="d-md-flex">
                <div class="card mr-1">
                  <div class="card-body">
                    <div class="text">Unit of Study</div>
                    <h5 class="counter">{{number_format($coordinator_dashboard['uos_num'])}}</h5>
                  </div>
                </div>
                <div class="card mr-1">
                  <div class="card-body">
                    <div class="text">Tutorial</div>
                    <h5 class="counter">{{number_format($coordinator_dashboard['tutorial_num'])}}</h5>
                  </div>
                </div>
                <div class="card">
                  <div class="card-body">
                    <div class="text">Casual Academic</div>
                    <h5 class="counter">{{number_format($coordinator_dashboard['tutor_num'])}}</h5>
                  </div>
                </div>
              </div>
              <div id="theme-default-bar"></div>
            </div>
          </div>
        </div>
      </div>
    @endif
    <!-- ==============================    Casual Academic Dashboard    ============================== -->
    @if(Session::get('user_is_casual_academic')==1)
      <div class="row clearfix row-deck">
        <div class="col-xl-4 col-lg-6 col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Tutorial</h3>
            </div>
            <div class="card-body">
              <div class="table-responsive" style="height:400px;">
                <table class="table card-table">
                  <tbody>
                    <tr>
                      <th>UOS</th>
                      <th>Tutorial</th>
                      <th>Time</th>
                    </tr>
                    @foreach($tutor_dashboard['tutorials'] as $tutorial)
                      <tr>
                        <td>{{$tutorial->uos_code}}</td>
                        <td>{{$tutorial->tutorial_name}}</td>
                        <td>{{$tutorial->tutorial_start_time}}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">ToDo List</h3>
            </div>
            <div class="card-body">
              <div class="table-responsive" style="height:400px;">
                <table class="table card-table">
                  <tbody>
                    <tr>
                      <th>Schedule</th>
                      <th>Due</th>
                    </tr>
                    @foreach($tutor_dashboard['schedules'] as $schedule)
                      <tr>
                        <td>{{$schedule->schedule_name}}</td>
                        <td>{{$schedule->schedule_due_date}}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-lg-12">
          <div class="card">
            <div class="card-body">
              <h3 class="card-title">Performance</h3>
            </div>
            <hr>
            <div class="table-responsive" style="height:400px;">
              <table class="table card-table">
                <tbody>
                  @foreach($tutor_dashboard['uoses'] as $uos)
                    <tr>
                      <td>
                        {{$uos['uos_code']}}
                        {{$uos['uos_name']}}
                        <div class="progress progress-xs mt-2">
                          <div class="progress-bar" style="width: {{$uos['claimed_rate']}}%"></div>
                        </div>
                      </td>
                      <td class="text-right"><span class="text-muted">{{$uos['claimed_hours']}} / {{$uos['allocated_hours']}}</span></td>
                    </tr>
                  @endforeach()
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    @endif
  </div>
</div>
@endsection

@section('script')
<script>
// Customized Pie
$(function() {
    var dom = document.getElementById("echart-Customized_Pie");
    var myChart = echarts.init(dom);
    var app = {};
    option = null;
    option = {
        backgroundColor: '#ffffff',
        title: {
            text: 'System Users',
            left: 'center',
            top: 20,
            textStyle: {
                color: anchor.colors["gray-200"],
            }
        },
        tooltip : {
            trigger: 'item',
            formatter: "{a} <br/>{b} : {c} ({d}%)"
        },
        visualMap: {
            show: false,
            min: 80,
            max: 600,
            inRange: {
                colorLightness: [0, 1]
            }
        },
        series : [
            {
                name:'System Users',
                type:'pie',
                radius : '55%',
                center: ['50%', '50%'],
                data:[
                    {value:{{$admin_dashboard['admin_num']}}, name:'Administrators'},
                    {value:{{$admin_dashboard['deputy_num']}}, name:'Deputy of HoS'},
                    {value:{{$admin_dashboard['coordinator_num']}}, name:'Coordinators'},
                    {value:{{$admin_dashboard['tutor_num']}}, name:'Casual Academics'},
                ].sort(function (a, b) { return a.value - b.value; }),
                roseType: 'radius',
                label: {
                    normal: {
                        textStyle: {
                            color: anchor.colors["pink"],
                        }
                    }
                },
                labelLine: {
                    normal: {
                        lineStyle: {
                            color: anchor.colors["pink"],
                        },
                        smooth: 0.2,
                        length: 10,
                        length2: 20
                    }
                },
                itemStyle: {
                    normal: {
                        color: ['rgba(119, 174, 184)'],
                        shadowBlur: 0,
                        shadowColor: 'rgba(200, 100, 50, 0.5)'
                    }
                },
                animationType: 'scale',
                animationEasing: 'elasticOut',
                animationDelay: function (idx) {
                    return Math.random() * 300;
                },
            }
        ]
    };;
    if (option && typeof option === "object") {
        myChart.setOption(option, true);
    }
});


// ACCOUNT RETENTION
$(document).ready(function() {

    var optionsBar = {
        chart: {
            type: 'bar',
            height: 410,
            width: '100%',
            stacked: true,
            foreColor: '#999'
        },
        plotOptions: {
            bar: {
                dataLabels: {
                enabled: false
                },
                columnWidth: '75%',
                endingShape: 'rounded'
            }
        },
        colors: ["#00C5A4", '#F3F2FC'],
        series: [{
            name: "Claimed",
            data: [25, 26, 24, 28, 26, 22, 25, 14, 16, 8, 9, 10, 8],
        }, {
            name: "Unclaimed",
            data: [0,0,0,0,2,0,0,5,7,15,17,14,22,25],
        }],
        labels: ["11.05","11.06","11.07","11.08","11.09","11.10","11.11","11.12","11.13","11.14","11.15","11.16","11.17","11.18"],
        xaxis: {
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false
            },
            crosshairs: {
                show: false
            },
            labels: {
                show: false,
                style: {
                    fontSize: '14px'
                }
            },
        },
        grid: {
            xaxis: {
                lines: {
                show: false
                },
            },
            yaxis: {
                lines: {
                show: false
                },
            }
        },
        yaxis: {
            axisBorder: {
                show: false
            },
            labels: {
                show: false
            },
        },
        tooltip: {
            shared: true
        }
    }

    var chartBar = new ApexCharts(document.querySelector('#theme-default-bar'), optionsBar);
    chartBar.render();

});
</script>
@endsection
