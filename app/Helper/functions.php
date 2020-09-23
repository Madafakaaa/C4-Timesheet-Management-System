<?php

/**
 * Session过期，返回登陆视图。
 * @return 登陆视图
 */
function loginExpired(){
    return redirect()->action('LoginController@index')
                     ->with(['notify' => true,
                             'type' => 'danger',
                             'title' => '您尚未登录',
                             'message' => '请输入用户名及密码登陆系统']);
}

function pagination($totalRecord, $request, $rowPerPage=20){
    // 获取总页数
    if($totalRecord==0){
        $totalPage = 1;
    }else{
        $totalPage = ceil($totalRecord/$rowPerPage);
    }
    // 获取当前页数
    if ($request->has('page')) {
        $currentPage = $request->input('page');
        if($currentPage<1)
            $currentPage = 1;
        if($currentPage>$totalPage)
            $currentPage = $totalPage;
    }else{
        $currentPage = 1;
    }
    // 计算offset偏移
    $offset = ($currentPage-1)*$rowPerPage;
    return array($offset, $rowPerPage, $currentPage, $totalPage);
}


function numberToCh($num){
    $ch=array('零','一','二','三','四','五','六','七','八','九');
    return $ch[$num];
}

function dateToDay($date){
    $weekarray=array("日","一","二","三","四","五","六");
    return "星期".$weekarray[date('w', strtotime($date))];
}

//加密
function encode($string = '', $skey = 'yuto2018') {
    $strArr = str_split(base64_encode($string));
    $strCount = count($strArr);
    foreach (str_split($skey) as $key => $value)
        $key < $strCount && $strArr[$key].=$value;
    return str_replace(array('=', '+', '/'), array('O0O0O', 'o000o', 'oo00o'), join('', $strArr));
 }

//解密
function decode($string = '', $skey = 'yuto2018') {
    try{
        $strArr = str_split(str_replace(array('O0O0O', 'o000o', 'oo00o'), array('=', '+', '/'), $string), 2);
        $strCount = count($strArr);
        foreach (str_split($skey) as $key => $value)
            $key <= $strCount  && isset($strArr[$key]) && $strArr[$key][1] === $value && $strArr[$key] = $strArr[$key][0];
        $result = base64_decode(join('', $strArr));
    }
    catch(Exception $e){
        return '';
    }
    if(encode($result,$skey)==$string){
        return $result;
    }else{
        return '';
    }
}


// Generate page links for tables
function pageLink($currentPage, $totalPage, $request, $totalNum)
{
  // 获取上一页、下一页页码
  $prevPage = $currentPage-1;
  $nextPage = $currentPage+1;
  // 生成请求URL参数
  $request_str = "";
  $requests = $request->all();
  foreach($requests as $key => $value){
      if($key!="page"){
          $request_str .= "&".$key."=".$value;
      }
  }
  // 输出HTML
  // echo "<div class='card-body p-2'>";
  // 第一行：页码
  echo "<div class='row pb-1'>";
  echo "<div class='col-12'>";
  echo "<nav>";
  echo "<ul class='pagination justify-content-center'>";
  // 上一页按钮
  if($currentPage==1){
      echo "<li class='page-item disabled'>";
  }else{
      echo "<li class='page-item'>";
  }
  echo "<a class='page-link' href='?page={$prevPage}{$request_str}'>";
  echo "<i class='fas fa-angle-left'></i>";
  echo "<span class='sr-only'>Previous</span>";
  echo "</a>";
  echo "</li>";
  // 第一页链接
  if($currentPage==1){
      echo "<li class='page-item active'><a class='page-link' href='#'>1</a></li>";
  }else{
      echo "<li class='page-item'><a class='page-link' href='?page=1{$request_str}'>1</a></li>";
  }
  // 省略图标
  if($currentPage>=5){
      echo "<li class='page-item disabled'><a class='page-link'>...</a></li>";
  }
  // 页数导航
  for($i = $currentPage-2; $i <= $currentPage+2; $i++){
      if($i>1&$i<$totalPage){
          if($i == $currentPage){
              echo "<li class='page-item active'><a class='page-link' href='#'>{$i}</a></li>";
          }else{
              echo "<li class='page-item'><a class='page-link' href='?page={$i}{$request_str}'>{$i}</a></li>";
          }
      }
  }
  // 省略图标
  if($currentPage<=($totalPage-4)){
      echo "<li class='page-item disabled'><a class='page-link'>...</a></li>";
  }
  // 最后一页链接
  if($totalPage!=1){
      if($currentPage==$totalPage){
          echo "<li class='page-item active'><a class='page-link' href='#'>{$totalPage}</a></li>";
      }else{
          echo "<li class='page-item'><a class='page-link' href='?page={$totalPage}{$request_str}'>{$totalPage}</a></li>";
      }
  }
  // 下一页按钮
  if($currentPage==$totalPage){
      echo "<li class='page-item disabled'>";
  }else{
      echo "<li class='page-item'>";
  }
  echo "<a class='page-link' href='?page={$nextPage}{$request_str}'>";
  echo "<i class='fas fa-angle-right'></i>";
  echo "<span class='sr-only'>Next</span>";
  echo "</a>";
  echo "</li>";
  echo "</ul>";
  echo "</nav>";
  echo "</div>";
  echo "</div>";
  // 第二行： 记录数量
  echo "<div class='row justify-content-center'>";
  echo "<div class='col-4 text-center'>";
  echo "<h5 class='m-0 p-0'>共 {$totalNum} 条记录</h5>";
  echo "</div>";
  echo "</div>";
  echo "</div>";
}

function deleteConfirm($id,$messages){
  echo "<button type='button' class='btn btn-sm btn-outline-danger' data-toggle='modal' data-target='#modal-{$id}'>删除</button>
        <div class='modal fade' id='modal-{$id}' tabindex='-1' role='dialog' aria-labelledby='modal-{$id}' aria-hidden='true'>
          <div class='modal-dialog modal-dialog-centered' role='document'>
            <div class='modal-content'>
              <div class='modal-header'>
                <h6 class='modal-title ml-4 mt-4' id='modal-title-default'>确认删除本记录?</h6>
              </div>
              <div class='modal-body text-left ml-4'>";
  for($i=0;$i<count($messages);$i++){
      echo "<p>{$messages[$i]}</p>";
  }
  echo "    </div>
            <div class='modal-footer mt--4'>
              <input type='submit' class='btn btn-sm btn-outline-danger' value='确认删除'>
              <button type='button' class='btn btn-link' data-dismiss='modal'>关闭</button>
            </div>
          </div>
        </div>";
}

function getColor($id){
    $colors = array('#FFA07A','#8769FD','#808080','#FF64C8','#FFD700','#FE9900','#E26FFD','#61A0FF','#323232','#C8FF50','#64F0F0','#D3D3D3');
    return $colors[($id%12)];
}

?>
