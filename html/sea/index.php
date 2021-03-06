<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <title>SU-Ours</title>
    <!-- 引入 echarts.js -->
    <script src="https://cdn.bootcss.com/echarts/4.4.0-rc.1/echarts-en.common.js"></script>

    <style>
    @font-face {
        font-family: fz;
        src: url('https://su-ours.oss-cn-hangzhou.aliyuncs.com/src/fz.ttf');
    }
    .btn-success:hover{
        background-color: #39e;
        box-shadow: 0 0 5px 3px #ddd;
    }
    .btn-warning:hover{
      background-color: #fd3;
        box-shadow: 0 0 5px 3px #ddd;
    }
    .btn-danger:hover{
        background-color: #f8b;
        box-shadow: 0 0 5px 3px #ddd;
    }
    .btn-primary:hover{
        background-color: #39e;
        box-shadow: 0 0 5px 3px #ddd;
    }
    .btn{
        outline:none;
        border:none;
        transition:all 0.5s ease-in-out;
    }

    .badge-dark:hover{
        background-color: #def;
        color:#000;
    }
    .badge{
        outline:none;
        border:none;
        transition:all 0.5s ease-in-out;
    }

    .navbar-brand:hover{
      transition:all 0.5s ease-in-out;
      text-shadow: 0px 0px 5px  #fee;
    }

    [aria-expanded=true]{
      border-color: #f99 !important;
    }

    body{
        font-family: fz;
    }
    
    img:hover{
        box-shadow: 0 0 5px 3px #bbb;
    }
    img{
        transition:all 0.3s ease-in-out
    }
    .alert{
        outline:none;
        border:none;
        transition:all 0.5s ease-in-out;
    }
    .alert:hover{
        color:#369;
        background-color: #adf;
        box-shadow: 0 0 5px 3px #ddd;
    }
</style>
</head>
<body>
<?php require("../pack/head.php")?>


    <div class='container'>
    <div class='card'>
        
    <div class='card-body'>
        <del><h2 class='text-center'>学海水温侦测系统</h2></del>
        <h1 class='text-center'>天气之子</h1>
        <a id="nowt" class="btn btn-block btn-light"></a>
        <a id="nowtmp0" class='btn btn-block btn-primary' href="#main0">
        </a>

        <a id="nowtmp2" class='btn btn-block btn-success' href="#main1">
        </a>


        <a id="nowpres" class='btn btn-block btn-warning' href="#main1">
        </a>

        <a id="nowhumi" class='btn btn-block btn-danger' href="#main2">
        </a>

        
    </div>
    </div>
    </div>



    <!-- 为ECharts准备一个具备大小（宽高）的Dom -->
    <div id="main0" style="height:500px;"></div>
    <!-- 为ECharts准备一个具备大小（宽高）的Dom -->
    <div id="main1" style="height:500px;"></div>
     <!-- 为ECharts准备一个具备大小（宽高）的Dom -->
     <div id="main2" style="height:500px;"></div>
    <script>
        axios.get("./data.js?t="+new Date())
        .then(function(r){
            data=r.data;

            document.getElementById("nowt").innerHTML="时间："+data.date[data.date.length-1];
            document.getElementById("nowtmp0").innerHTML="水温："+data.tmp0[data.tmp0.length-1][1]+"℃";
            document.getElementById("nowtmp2").innerHTML="气温："+data.tmp2[data.tmp2.length-1][1]+"℃";
            document.getElementById("nowhumi").innerHTML="湿度："+data.humi[data.humi.length-1][1]+"%";
            document.getElementById("nowpres").innerHTML="气压："+data.pres[data.pres.length-1][1]+"Pa";
        // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('main0'));

        // 指定图表的配置项和数据
        


option0 = {
    tooltip: {
        trigger: 'axis',
        position: function (pt) {
            return [pt[0], '10%'];
        }
    },
    title: {
        left: 'center',
        text: '学海水温',
    },
    toolbox: {
        feature: {
            dataZoom: {
                yAxisIndex: 'none'
            },
            restore: {},
            saveAsImage: {}
        }
    },
    xAxis: {
        type: 'time',
        boundaryGap: false,
    },
    yAxis: [
        {
            name: '水温(℃)',
            type: 'value',
        }
    ],
    dataZoom: [{
        type: 'inside',
        start: 90,
        end: 100
    }, {
        start: 0,
        end: 10,
        handleIcon: 'M10.7,11.9v-1.3H9.3v1.3c-4.9,0.3-8.8,4.4-8.8,9.4c0,5,3.9,9.1,8.8,9.4v1.3h1.3v-1.3c4.9-0.3,8.8-4.4,8.8-9.4C19.5,16.3,15.6,12.2,10.7,11.9z M13.3,24.4H6.7V23h6.6V24.4z M13.3,19.6H6.7v-1.4h6.6V19.6z',
        handleSize: '80%',
        handleStyle: {
            color: '#fff',
            shadowBlur: 3,
            shadowColor: 'rgba(0, 0, 0, 0.6)',
            shadowOffsetX: 2,
            shadowOffsetY: 2
        }
    }],
    series: [
        {
            name:'水温',
            type:'line',
            smooth:true,
            sampling: 'average',
            itemStyle: {
                color: 'rgb(255, 70, 131)'
            },
            data: data.tmp0
        }
    ]
};


        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option0);
        window.onresize = myChart.resize;


        // 基于准备好的dom，初始化echarts实例
        var myChart1 = echarts.init(document.getElementById('main1'));

        // 指定图表的配置项和数据
        


option1 = {
    tooltip: {
        trigger: 'axis',
        position: function (pt) {
            return [pt[0], '10%'];
        }
    },
    title: {
        left: 'center',
        text: '气温气压',
    },
    toolbox: {
        feature: {
            dataZoom: {
                yAxisIndex: 'none'
            },
            restore: {},
            saveAsImage: {}
        }
    },
    xAxis: {
        type: 'time',
        boundaryGap: false,
    },
    yAxis: [
        {
            name: '温度(℃)',
            type: 'value',
        },
        {
            name: '气压(Pa)',
            scale: true,
            type: 'value',
        }
    ],
    dataZoom: [{
        type: 'inside',
        start: 90,
        end: 100
    }, {
        start: 0,
        end: 10,
        handleIcon: 'M10.7,11.9v-1.3H9.3v1.3c-4.9,0.3-8.8,4.4-8.8,9.4c0,5,3.9,9.1,8.8,9.4v1.3h1.3v-1.3c4.9-0.3,8.8-4.4,8.8-9.4C19.5,16.3,15.6,12.2,10.7,11.9z M13.3,24.4H6.7V23h6.6V24.4z M13.3,19.6H6.7v-1.4h6.6V19.6z',
        handleSize: '80%',
        handleStyle: {
            color: '#fff',
            shadowBlur: 3,
            shadowColor: 'rgba(0, 0, 0, 0.6)',
            shadowOffsetX: 2,
            shadowOffsetY: 2
        }
    }],
    series: [
        {
            name:'气温',
            type:'line',
            smooth:true,
            sampling: 'average',
            itemStyle: {
                color: 'rgb(255, 70, 131)'
            },
            data: data.tmp2
        },
        {
            name:'气压',
            type:'line',
            yAxisIndex:1,
            smooth:true,
            sampling: 'average',
            itemStyle: {
                color: 'rgb(70, 131, 255)'
            },
            data: data.pres
        }
    ]
};


        // 使用刚指定的配置项和数据显示图表。
        myChart1.setOption(option1);
        window.onresize = myChart.resize;

   
        // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('main2'));

        // 指定图表的配置项和数据
        


option2 = {
    tooltip: {
        trigger: 'axis',
        position: function (pt) {
            return [pt[0], '10%'];
        }
    },
    title: {
        left: 'center',
        text: '气温湿度',
    },
    toolbox: {
        feature: {
            dataZoom: {
                yAxisIndex: 'none'
            },
            restore: {},
            saveAsImage: {}
        }
    },
    xAxis: {
        type: 'time',
        boundaryGap: false,
    },
    yAxis: [
        {
            name: '气温(℃)',
            type: 'value',
        },
        {
            name: '湿度(%)',
            type: 'value',
        }
    ],
    dataZoom: [{
        type: 'inside',
        start: 90,
        end: 100
    }, {
        start: 0,
        end: 10,
        handleIcon: 'M10.7,11.9v-1.3H9.3v1.3c-4.9,0.3-8.8,4.4-8.8,9.4c0,5,3.9,9.1,8.8,9.4v1.3h1.3v-1.3c4.9-0.3,8.8-4.4,8.8-9.4C19.5,16.3,15.6,12.2,10.7,11.9z M13.3,24.4H6.7V23h6.6V24.4z M13.3,19.6H6.7v-1.4h6.6V19.6z',
        handleSize: '80%',
        handleStyle: {
            color: '#fff',
            shadowBlur: 3,
            shadowColor: 'rgba(0, 0, 0, 0.6)',
            shadowOffsetX: 2,
            shadowOffsetY: 2
        }
    }],
    series: [
        {
            name:'气温',
            type:'line',
            smooth:true,
            sampling: 'average',
            itemStyle: {
                color: 'rgb(255, 70, 131)'
            },
            data: data.tmp1
        },
        {
            name:'湿度',
            type:'line',
            yAxisIndex:1,
            smooth:true,
            sampling: 'average',
            itemStyle: {
                color: 'rgb(70, 131, 255)'
            },
            data: data.humi
        }
    ]
};


        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option2);
        window.onresize = myChart.resize;


    });
    </script>


</body>
</html>