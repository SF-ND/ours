﻿<!DOCTYPE html>
<html>
<head>
  <title>SU-Ours</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js"></script>
  <script src="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>

  <script>
  
  var imgid=0,probnum='';

function get_prob(tmpid)
{
  imgid=tmpid;
  
  var xmlhttp; xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function()
    {
      if (xmlhttp.readyState==4 && xmlhttp.status==200)
      {
        list=JSON.parse(xmlhttp.responseText);
        for(var i=0;i<=4;i++)
        {document.getElementById("ques"+String(i)).innerHTML=list[i];}
        probnum=list[5];
      }
    }
    xmlhttp.open("GET","./get_prob.php",true);
    xmlhttp.send();
}

function showinfo(info)
{
  document.getElementById("mdinfo").innerHTML=info;
  $('#myModal2').modal('show');
  setTimeout(function(){
            $("#myModal2").modal("hide")
        },1200);
}

  function vote(out)
  {
    var xmlhttp; xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function()
    {
      if (xmlhttp.readyState==4 && xmlhttp.status==200)
      {
        showinfo(xmlhttp.responseText);
        if(xmlhttp.responseText[0]=="成")
        {
          s=document.getElementById("img"+imgid).innerHTML;
          document.getElementById("img"+imgid).innerHTML="赞"+String(Number(s.slice(1))+1);
        }
      }
    }
    out=document.getElementById(out).innerHTML;
    xmlhttp.open("GET","./check.php?probnum="+probnum+"&out="+out+"&imgid="+String(imgid),true);
    xmlhttp.send();
  }

  </script>

</head>

<style>
    @font-face {
        font-family: fz;
        src: url('https://su-ours.oss-cn-hangzhou.aliyuncs.com/src/fz.ttf');
    }
    .btn-primary:hover{
        background-color: #39e;
        box-shadow: 0 0 5px 3px #ddd;
    }
    .btn-warning:hover{
        background-color: #fd3;
        box-shadow: 0 0 5px 3px #ddd;
    }
    .btn{
        outline:none;
        border:none;
        transition:all 0.5s ease-in-out;
    }

    .badge{
        outline:none;
        border:none;
        transition:all 0.5s ease-in-out;
    }
    .badge-primary:hover{
        background-color: #39e;
        box-shadow: 0 0 5px 3px #ddd;
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
        height:100%;
    }

    .card{
      transition:all 0.3s ease-in-out;
    }
    .card:hover{
      box-shadow: 0 0 5px 3px #ddd;
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

<body>

<?php require("../pack/head.php")?>

<div class='container-fluid'>
<?php require("../pack/headcard_img.php")?>

<h2 class="alert alert-info text-center">体育节摄影大赛专区</h2>
  </br>

<div class="card">
  <div class="card-body">
    <h4 class="card-title">海螺湾</h4>
    <div class="text-center">
      <div class="btn-group">
        <a href="./group.php?by=tag" class="btn btn-primary">标签</a>
        <a href="./group.php?by=name" class="btn btn-warning">同学</a>
        <a href="./group.php?by=date" class="btn btn-primary">时光</a>
        <a href="./group.php?by=class" class="btn btn-warning">班级</a>
      </div>
    </div>
  </div>
</div>


<?php
$gametag='体育节2019';

$by=$order='id';
$up='0';
$key='';
$exact='0';
$page=1;

if(!empty($_GET["by"]))$by=$_GET["by"];
if(!empty($_GET["order"]))$order=$_GET["order"];
if(!empty($_GET["key"]))$key=$_GET["key"];
if(!empty($_GET["up"]))$up=$_GET["up"];
if(!empty($_GET["exact"]))$exact=$_GET["exact"];
if(!empty($_GET["page"]) && preg_match("/^[0-9]*$/",$_GET["page"]))$page=(int)$_GET["page"];

?>

<div class="card">
  <div class="card-body">
    <h4 class="card-title" data-toggle="collapse" href="#collapse0">神奇海螺(点我)</h4>
    <form method="get" class="collapse" id="collapse0" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
      <div class="input-group">
        <div class="input-group-append">
            <span class="input-group-text">海螺品种</span>
        </div>
        <select class="form-control" name="by">
            <option value="id" <?php echo $by=="id"?"selected":"";?>>编号</option>
            <option value="title" <?php echo $by=="title"?"selected":"";?>>标题</option>
            <option value="tag" <?php echo $by=="tag"?"selected":"";?>>标签</option>
            <option value="name" <?php echo $by=="name"?"selected":"";?>>同学</option>
            <option value="grade" <?php echo $by=="grade"?"selected":"";?>>届</option>
            <option value="class" <?php echo $by=="class"?"selected":"";?>>班</option>
            <option value="date" <?php echo $by=="date"?"selected":"";?>>时间</option>
        </select>
      </div>
      
      <div class="input-group">
        <div class="input-group-append">
            <span class="input-group-text">海螺名称</span>
        </div>
        <input type="text" class="form-control" placeholder="如:1" name="key" value="<?php echo $key;?>">
      </div>

      <div class="input-group">
        <div class="input-group-append">
            <span class="input-group-text">模糊搜索</span>
        </div>
        <select class="form-control" name="exact">
            <option value="0" <?php echo $exact=="0"?"selected":"";?>>是</option>
            <option value="1" <?php echo $exact=="1"?"selected":"";?>>否</option>
        </select>
        </div>

        <div class="input-group">
        <div class="input-group-append">
            <span class="input-group-text">排队依据</span>
        </div>
        <select class="form-control" name="order">
            <option value="id" <?php echo $order=="id"?"selected":"";?>>编号</option>
            <option value="title" <?php echo $order=="title"?"selected":"";?>>标题</option>
            <option value="name" <?php echo $order=="name"?"selected":"";?>>同学</option>
            <option value="grade" <?php echo $order=="grade"?"selected":"";?>>届</option>
            <option value="class" <?php echo $order=="class"?"selected":"";?>>班</option>
            <option value="date" <?php echo $order=="date"?"selected":"";?>>时间</option>
        </select>
      </div>

        <div class="input-group">
        <div class="input-group-append">
            <span class="input-group-text">排队顺序</span>
        </div>
        <select class="form-control" name="up">
            <option value="1" <?php echo $up=="1"?"selected":"";?>>升序</option>
            <option value="0" <?php echo $up=="0"?"selected":"";?>>降序</option>
        </select>
      </div>

      <div class="input-group">
        <div class="input-group-append">
            <span class="input-group-text">第几页呀</span>
        </div>
        <input type="text" class="form-control" placeholder="如:1" name="page" value="<?php echo $page;?>">
      </div>
      <div class="input-group">
        <input type="submit" class="btn btn-block btn-primary" value="你为什么不问问神奇海螺呢？" name="submit" id="submit">
      </div>
    </form>

  </div>
</div>
<br>

<?php
$key=addslashes($key);
if($by=='tag')
{
  if($exact=='1')$key="%\r\n".$key."\r\n%";
  else $key="%".$key."%";
  $exact='0';
}
elseif($by=='class')
{
  $by="grade";
  $key=str_replace("高一","N",$key);
  $key=str_replace("文","W",$key);
  $key=str_replace("理","L",$key);
  $key=substr($key,0,4)."' && class_type like '".substr($key,4,1)."' && class like '".substr($key,5,2);
}
else
{
  if($exact=='0')$key="%".$key."%";
}


$url="https://su-ours.oss-cn-hangzhou.aliyuncs.com/img/";
$dbhost="localhost:3306";
$dbuser="root";
$dbpass="PASSWORD";
$conn=mysqli_connect($dbhost,$dbuser,$dbpass);
mysqli_query($conn,"set names utf8");
mysqli_select_db($conn,'ours');

if($order=="title" || $order=="name")$sql="select * from img where ".$by." like '".$key."' and tag like '%\r\n$gametag\r\n%' order by convert(".$order." using gbk)".($up=='1'?" asc":" desc")." limit ".(($page-1)*10).",10";
else $sql="select * from img where ".$by." like '".$key."' and tag like '%\r\n$gametag\r\n%' order by ".$order.($up=='1'?" asc":" desc")." limit ".(($page-1)*10).",10";

$retval0=mysqli_query($conn,$sql);
$retval=array();

while($row=mysqli_fetch_assoc($retval0))
{
  $sql="select * from zan where id =".$row['id'];
  $retval2=mysqli_query($conn,$sql);
  $row2=mysqli_fetch_assoc($retval2);
  if(empty($row2))$row['zan']=0;
  else $row['zan']=$row2['zan'];
  $retval[]=$row;
}

$ct=sizeof($retval)-1;
if($ct>=0)$mid=intdiv($ct,2);
else $mid=-1;


echo "<div class='row'><div class='col-md-6'>";
for($i=0;$i<=$mid;$i++)
{
  if($retval[$i]['class_type']=='N')$retval[$i]['class_type']="高一";
  echo "<div class='card text-center'>";
  echo "<a href=".$url.$retval[$i]["id"].".".$retval[$i]["file_type"].(($retval[$i]["file_type"]=="GIF" || $retval[$i]["file_type"]=="gif")?"":"!low")." target='_blank'>";
  echo "<img class='card-img-top' src=".$url.$retval[$i]["id"].".".$retval[$i]["file_type"].(($retval[$i]["file_type"]=="GIF" || $retval[$i]["file_type"]=="gif")?"":"!low")." alt='qwq'>";
  echo "</a><div class='card-body'>";
  echo "<h2 class='card-title'>".$retval[$i]["title"]."</h2>";
  echo "<p style='line-height:10%'>".$retval[$i]["grade"]."届".$retval[$i]["class_type"].$retval[$i]["class"]."班  ".$retval[$i]["name"]."</p>";
  echo "<h6>".substr($retval[$i]['date'],0,10)."</h6>";
  echo "<div class='btn-group'><a href=./show.php?id=".$retval[$i]["id"]." class='btn btn-primary'>详情</a>";
  echo "<button type='button' class='btn btn-warning' data-toggle='modal' data-target='#myModal' onclick='get_prob(".$retval[$i]['id'].")' id='img".$retval[$i]['id']."'>赞".$retval[$i]["zan"]."</button></div>";
  echo "</div></div>";
}
echo "</div>";

echo "<div class='col-md-6'>";
for($i=$mid+1;$i<=$ct;$i++)
{
  if($retval[$i]['class_type']=='N')$retval[$i]['class_type']="高一";
  echo "<div class='card text-center'>";
  echo "<a href=".$url.$retval[$i]["id"].".".$retval[$i]["file_type"].(($retval[$i]["file_type"]=="GIF" || $retval[$i]["file_type"]=="gif")?"":"!low")." target='_blank'>";
  echo "<img class='card-img-top' src=".$url.$retval[$i]["id"].".".$retval[$i]["file_type"].(($retval[$i]["file_type"]=="GIF" || $retval[$i]["file_type"]=="gif")?"":"!low")." alt='qwq'>";
  echo "</a><div class='card-body'>";
  echo "<h2 class='card-title'>".$retval[$i]["title"]."</h2>";
  echo "<p style='line-height:10%'>".$retval[$i]["grade"]."届".$retval[$i]["class_type"].$retval[$i]["class"]."班  ".$retval[$i]["name"]."</p>";
  echo "<h6>".substr($retval[$i]['date'],0,10)."</h6>";
  echo "<div class='btn-group'><a href=./show.php?id=".$retval[$i]["id"]." class='btn btn-primary'>详情</a>";
  echo "<button type='button' class='btn btn-warning' data-toggle='modal' data-target='#myModal' onclick='get_prob(".$retval[$i]['id'].")' id='img".$retval[$i]['id']."'>赞".$retval[$i]["zan"]."</button></div>";
  echo "</div></div>";
}
echo "</div></div>";

?>

<div class="card">
  <div class="card-body text-center">
    <h4 class="card-title">啥都木有啦</h4>
    <div class="btn-group">
      <a href=<?php echo str_replace("page=".$page,"page=".($page-1),'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);?> class="btn btn-warning">上一页</a>
      <a href="javascript:window.scrollTo(0,0);location.reload();" class="btn btn-primary">嗖~刷新！</a>
      <a href=<?php echo str_replace("page=".$page,"",'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']).(strstr($_SERVER['REQUEST_URI'],"?")==false?"?":"")."&page=".($page+1);?> class="btn btn-warning">下一页</a>
    </div>
    
  </div>
</div>
</div>


<!-- 模态框 -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
   
        <!-- 模态框头部 -->
        <div class="modal-header">
          <h3 class="modal-title">验证</h3>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
   
        <!-- 模态框主体 -->
        <div class="modal-body">
          <h4 id="ques0"></h4>
          <button class="alert alert-info btn-block" id="ques1"  data-dismiss="modal" onclick="vote('ques1')"></button>
          <button class="alert alert-info btn-block" id="ques2"  data-dismiss="modal" onclick="vote('ques2')"></button>
          <button class="alert alert-info btn-block" id="ques3"  data-dismiss="modal" onclick="vote('ques3')"></button>
          <button class="alert alert-info btn-block" id="ques4"  data-dismiss="modal" onclick="vote('ques4')"></button>
        </div>
   
      </div>
    </div>
  </div>

    <!-- 模态框 -->
    <div class="modal fade" id="myModal2">
        <div class="modal-dialog">
              <div class="alert alert-info" id="mdinfo"></div>
        </div>
      </div>
</body>
</html>
