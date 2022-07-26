<?php 
include_once('header.php');
include_once('left.php'); 
if($udb->get("user","Level",["User"=>$u]) != 999){
    include_once('footer.php');
    exit;
}
$ICP    = UGet('ICP');
$footer = UGet('footer');
$footer = htmlspecialchars_decode(base64_decode($footer));
$Plug     = UGet('Plug');
$apply  = UGet('apply');
?>

<style type="text/css">
.layui-layout-admin .layui-body {top: 40px;}
</style>
<div class="layui-tab layui-tab-brief layui-body layui-row content-body" lay-filter="root" style="padding-bottom: 0px;">
<ul class="layui-tab-title">
 <li class="layui-this" lay-id="1">全局配置</li>
 <li lay-id="2">用户管理</li>
 <li lay-id="3">订阅管理</li>
</ul>
<div class="layui-tab-content" style="padding-bottom: 0px;">
<div class="layui-tab-item layui-show layui-form layui-form-pane"><!--全局配置--> 
<div class="layui-row content-body layui-show layui-form layui-form-pane" >
<div class="layui-col-lg12">
 <div class="layui-form-item">
    <div class="layui-inline">
      <label class="layui-form-label">默认用户</label>
      <div class="layui-input-inline">
        <input type="text" name="DUser" id="DUser" lay-verify="required" value = '<?php echo $Duser;?>' placeholder='admin'  autocomplete="off" class="layui-input">
      </div>
      <div class="layui-form-mid layui-word-aux">默认主页的账号,优先级:Get>Cookie/Host>默认用户>admin</div>
    </div>
 </div>
 <div class="layui-form-item">
    <div class="layui-inline">
      <label class="layui-form-label">注册用户</label>
     <div class="layui-input-inline">
      <select id="Reg" name="Reg"  >
        <option value="0" <?php if($reg==0){echo'selected=""';}?>>禁止注册</option>
        <option value="1" <?php if($reg==1){echo'selected=""';}?>>允许注册</option>
      </select>
      </div>
      <div class="layui-form-mid layui-word-aux">个人使用可以禁止注册哦!</div>
    </div>
 </div>
 <div class="layui-form-item">
    <div class="layui-inline">
      <label class="layui-form-label">注册入口</label>
      <div class="layui-input-inline">
        <input type="text" name="Register" lay-verify="required" value='<?php echo $Register;?>' placeholder='Register' autocomplete="off" class="layui-input">
      </div>
      <div class="layui-form-mid layui-word-aux">默认为Register,不想被随意注册时可以修改!</div>
    </div>
 </div>
 <div class="layui-form-item">
    <div class="layui-inline">
      <label class="layui-form-label">登录入口</label>
      <div class="layui-input-inline">
        <input type="text" name="login" lay-verify="required" value='<?php echo $login;?>' placeholder='login' autocomplete="off" class="layui-input">
      </div>
      <div class="layui-form-mid layui-word-aux">默认为login,修改可以防止被爆破,修改请记好入口名,否则无法登录后台!</div>
    </div>
 </div>
 
 
 <div class="layui-form-item">
    <div class="layui-inline">
      <label class="layui-form-label">静态路径</label>
      <div class="layui-input-inline">
    <input type="text" name="libs" id="libs" lay-verify="required" value = '<?php echo $libs; ?>' placeholder='./static'  autocomplete="off" class="layui-input">
      </div>
      <div class="layui-form-mid layui-word-aux">默认为./static 即本地服务器!建议使用CDN来提高加载速度!</div>
    </div>
 </div> 

 <div class="layui-form-item">
    <div class="layui-inline">
      <label class="layui-form-label">ICP备案号</label>
      <div class="layui-input-inline">
    <input type="text" name="ICP"   value = '<?php echo $ICP; ?>' placeholder='工信部ICP备案号'  autocomplete="off" class="layui-input">
      </div>
      <div class="layui-form-mid layui-word-aux">因法律风险问题,取消了普通用户自定义备案号!这里设置的是全局显示的!</div>
    </div>
 </div> 
<div class="layui-form-item">
    <div class="layui-inline">
      <label class="layui-form-label">自定义代码</label>
      <div class="layui-input-inline">
      <select id="visit" name="Diy"  >
        <option value="0" <?php if($Diy==0){echo'selected=""';}?>>禁止</option>
        <option value="1" <?php if($Diy==1){echo'selected=""';}?>>允许</option>
      </select>
      </div>
      <div class="layui-form-mid " style="color:#FF0000">是否允许普通用户使用自定义头部和底部代码,存在风险请慎用!管理员和防XSS脚本对此无效!</div>
    </div>
 </div> 
  <div class="layui-form-item">
    <div class="layui-inline">
      <label class="layui-form-label">访问控制</label>
      <div class="layui-input-inline">
      <select id="visit" name="visit"  >
        <option value="0" <?php if($Visit==0){echo'selected=""';}?>>禁止访问</option>
        <option value="1" <?php if($Visit==1){echo'selected=""';}?>>允许访问</option>
      </select>
      </div>
      <div class="layui-form-mid layui-word-aux">禁止访问时首页无法预览,链接无法跳转,普通用户无法登录后台,同时关闭注册!管理员账号不受影响!</div>
    </div>
 </div>
  <div class="layui-form-item">
    <div class="layui-inline">
      <label class="layui-form-label">防XSS脚本</label>
      <div class="layui-input-inline">
      <select id="XSS" name="XSS"  >
        <option value="0" <?php if($XSS==0){echo'selected=""';}?>>关闭</option>
        <option value="1" <?php if($XSS==1){echo'selected=""';}?>>开启</option>
      </select>
      </div>
      <div class="layui-form-mid layui-word-aux">拦截POST表单中的XSS恶意代码,提升网站安全性!(测试)</div>
    </div>
 </div> 
  <div class="layui-form-item">
    <div class="layui-inline">
      <label class="layui-form-label">防SQL注入</label>
      <div class="layui-input-inline">
      <select id="SQL" name="SQL"  >
        <option value="0" <?php if($SQL==0){echo'selected=""';}?>>关闭</option>
        <option value="1" <?php if($SQL==1){echo'selected=""';}?>>开启</option>
      </select>
      </div>
      <div class="layui-form-mid layui-word-aux">拦截POST表单中的SQL注入代码,提升网站安全性!(测试)</div>
    </div>
 </div> 
  <div class="layui-form-item">
    <div class="layui-inline">
      <label class="layui-form-label">插件支持</label>
      <div class="layui-input-inline">
      <select id="Plug" name="Plug"  >
        <option value="0" <?php if($Plug==0){echo'selected=""';}?>>默认模式</option>
        <option value="1" <?php if($Plug==1){echo'selected=""';}?>>兼容模式1</option>
        <option value="2" <?php if($Plug==2){echo'selected=""';}?>>兼容模式2</option>
      </select>
      </div>
      <div class="layui-form-mid layui-word-aux">选择兼容模式时,可以使用xiaoz开发的uTools插件 <a href="https://doc.xiaoz.me/books/onenav-extend/page/utools" target="_blank">帮助</a></div>
    </div>
 </div> 
  <div class="layui-form-item">
    <div class="layui-inline">
      <label class="layui-form-label">图标API</label>
      <div class="layui-input-inline">
      <select id="IconAPI" name="IconAPI"  >
        <option value="0" <?php if($IconAPI==0){echo'selected=""';}?>>离线图标</option>
        <option value="1" <?php if($IconAPI==1){echo'selected=""';}?>>本地服务(支持缓存)</option>
        <option value="2" <?php if($IconAPI==2){echo'selected=""';}?>>favicon.rss.ink (小图标)</option>
        <option value="3" <?php if($IconAPI==3){echo'selected=""';}?>>ico.hnysnet.com </option>
        <option value="4" <?php if($IconAPI==4){echo'selected=""';}?>>api.15777.cn </option>
        <option value="5" <?php if($IconAPI==5){echo'selected=""';}?>>favicon.cccyun.cc </option>
        <option value="6" <?php if($IconAPI==6){echo'selected=""';}?>>api.iowen.cn </option>
      </select>
      </div>
      <div class="layui-form-mid layui-word-aux">所有API接口均由其他大佬提供!若有异常请尝试更换接口!</div>
    </div>
 </div>
  <div class="layui-form-item">
    <div class="layui-inline">
      <label class="layui-form-label">收录功能</label>
      <div class="layui-input-inline">
      <select id="apply" name="apply"  >
        <option value="0" <?php if($apply==0){echo'selected=""';}?>>关闭</option>
        <option value="1" <?php if($apply==1){echo'selected=""';}?>>开启</option>
      </select>
      </div>
      <div class="layui-form-mid layui-word-aux">此为全局开关,关闭后所有账号无法使用此功能,账号自己还可设置是否开启!</div>
    </div>
 </div>
 
 <div class="layui-form-item">
    <div class="layui-inline">
      <label class="layui-form-label">二级域名</label>
      <div class="layui-input-inline">
      <select id="Pandomain" name="Pandomain"  >
        <option value="0" <?php if($Pandomain==0){echo'selected=""';}?>>关闭</option>
        <option value="1" <?php if($Pandomain==1){echo'selected=""';}?>>开启</option>
      </select>
      </div>
      <div class="layui-form-mid layui-word-aux">以二级域名的形式直接进入用户主页,需配置域名泛解析和服务器泛域名绑定(需订阅)</div>
    </div>
 </div>
 
  <div class="layui-form-item">
    <div class="layui-inline">
      <label class="layui-form-label">离线模式</label>
      <div class="layui-input-inline">
      <select id="offline" name="offline"  >
        <option value="0" <?php if($offline==0){echo'selected=""';}?>>关闭</option>
        <option value="1" <?php if($offline==1){echo'selected=""';}?>>开启</option>
      </select>
      </div>
      <div class="layui-form-mid layui-word-aux">开启将禁止服务器访问互联网,部分功能将被禁用(如:更新提示,公告,在线主题,链接识别,书签克隆等)!</div>
    </div>
 </div>
 
 
  <div class="layui-form-item layui-form-text">
    <label class="layui-form-label">底部代码</label>
    <div class="layui-input-block"> 
       <textarea name="footer" class="layui-textarea"  placeholder="例如统计代码,又拍云LOGO等,支持HTML,JS,CSS" ><?php echo $footer?></textarea>
    </div>
  </div>
</div>  
  <div class="layui-form-item">
    <div class="layui-input-block">
      <button class="layui-btn" lay-submit lay-filter="edit_root">保存配置</button>
    </div>
  </div>

  </div><!--表单End-->
    
</div><!--全局配置End-->
<div class="layui-tab-item" ><!--用户管理-->
<div class="layui-row content-body" style="margin-top: 0px;margin-left: 0px;margin-right: 0px;">
    <div class="layui-col-lg12">

        <div class="layui-inline" >
        <input class="layui-input" name="keyword" id="user_keyword" placeholder='请输入账号,邮箱,注册IP' value=''autocomplete="off" >
        </div>
        <div class="layui-btn-group ">
        <button class="layui-btn layui-btn " data-type="user_search">搜索</button>
        </div>
        <table id="user_list" lay-filter="user_list"></table>
        <script type="text/html" id="user_tool">
            <div class="layui-btn-container">
            <button class="layui-btn layui-btn-sm layui-btn-danger" lay-event="Del">删除选中</button>
            <button class="layui-btn layui-btn-sm " lay-event="Reg" <?php  echo $reg === '0'? 'style = "display:none;"':'' ?> >注册账号</button>
            <button class="layui-btn layui-btn-sm " lay-event="help" >帮助</button>
            <button class="layui-btn layui-btn-sm " lay-event="repair" >修复/升级</button>
            <button class="layui-btn layui-btn-sm " lay-event="loginlog" >登录日志</button>
        </div>
        </script>
        <!-- 开启表格头部工具栏END -->
    </div>
    <script type="text/html" id="link_operate">
    <a class="layui-btn layui-btn-xs" lay-event="admin">后台</a>
    <a class="layui-btn layui-btn-xs" lay-event="edit">改密</a>
    </script>
</div>

</div><!--用户管理End-->

<div class="layui-tab-item" ><!--订阅-->
<div class="layui-row content-body place-holder" style="padding-bottom: 3em;">
    <!-- 说明提示框 -->
    <div class="layui-col-lg12">
      <div class="setting-msg">
        <ol>
            <li>您可以在下方点击购买订阅，购买后可以：</li>
            <li>1. 可使用标签功能</li>
            <li>2. 可使用二级域名绑定账号功能</li>
            <li>3. 可使用链接检测功能</li>
            <li>4. 建议和反馈优先处理</li>
            <li>5. 更多高级功能开发中</li>
            <li>6. 可帮助OneNav Extend持续发展，让它变得更加美好</li>
        </ol>
      </div>
    </div>
    <!-- 说明提示框END -->
    <!-- 订阅表格 -->
    <div class="layui-col-lg6">
    <h2 style = "margin-bottom:1em;">我的订阅：</h2>
    <form class="layui-form layui-form-pane" action="">

        <div class="layui-form-item">
            <label class="layui-form-label">订单号</label>
            <div class="layui-input-block">
                <input type="text" id = "order_id" name="order_id" value = "<?php echo $subscribe['order_id']; ?>" required  lay-verify="required" autocomplete="off" placeholder="请输入订单号" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">订阅邮箱</label>
            <div class="layui-input-block">
                <input type="email" name="email" id = "email" value = "<?php echo $subscribe['email']; ?>" required lay-verify="required|email" autocomplete="off" placeholder="订阅邮箱" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item" style = "display:none;">
            <label class="layui-form-label">域名</label>
            <div class="layui-input-block">
                <input type="text" name="domain" id = "domain" value = "<?php echo $_SERVER['HTTP_HOST']; ?>" autocomplete="off" placeholder="网站域名" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">到期时间</label>
            <div class="layui-input-block">
            <input type="text" name="end_time" id = "end_time" readonly="readonly" value = "<?php echo date("Y-m-d H:i:s",$subscribe['end_time']); ?>" autocomplete="off" placeholder="订阅到期时间" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <button class="layui-btn" lay-submit="" lay-filter="set_subscribe">保存设置</button>
            <button class="layui-btn" lay-submit="" lay-filter="reset_subscribe">删除订阅</button>
            <a class="layui-btn layui-btn-danger" rel = "nofollow" target = "_blank" title = "点此购买订阅" href="https://shop.xiaoz.top/productinfo-108.html"><i class="fa fa-shopping-cart"></i> 购买订阅</a>
        </div>

    </form>
    </div>
    <!-- 订阅表格END -->

</div><!--订阅End-->


</div>
</div>
</div>
</div>
</div>
<script src = '<?php echo $libs?>/jquery/jquery-3.6.0.min.js'></script>
<script src = '<?php echo $libs?>/Layui/v2.6.8/layui.js'></script>
<script src = '<?php echo $libs?>/jquery/jquery.md5.js'></script>
<script src = "./templates/admin/static/public.js?t=<?php echo $version; ?>"></script>
<script>
layui.use(['element','table','layer','form','util','dropdown'], function(){
    var element = layui.element;
    var table = layui.table;
    var util = layui.util;
    var form = layui.form;
    var dropdown = layui.dropdown;
    layer = layui.layer;

var limit = String(getCookie('lm_limit'));
if (limit < 10 || limit > 90){
    limit = 20 ;
}

    //Hash地址的定位
    var layid = location.hash.replace(/^#root=/, '');
    element.tabChange('root', layid);
    console.log(layid);
    //切换事件
    element.on('tab(root)', function(elem){
        layid = $(this).attr('lay-id');
        location.hash = 'root='+ $(this).attr('lay-id');
    });
    
    
var user_cols=[[ //表头
      {type:'checkbox'} //开启复选框
      ,{field:'ID',title:'ID',width:60,sort:true}
      ,{field:'User',title:'账号',minWidth:120,sort:true,templet:function(d){
          return '<a style="color:#3c78d8" title="打开用户主页" target="_blank" href="./?u='+d.User+'">'+d.User+'</a>'
      }}
      ,{field:'Level',title:'用户组',minWidth:90,sort:true ,event: 'group', style:'cursor: pointer;',templet:function(d){
          if(d.Level ==999){return '管理员'}
          else{return '普通会员'}
      }}
      ,{field:'SQLite3',title:'数据库',minWidth:150,event: 'SetName', style:'cursor: pointer;'}
      ,{field:'Email',title:'Email',minWidth:170,sort:true}
      ,{field:'RegIP',title:'注册IP',minWidth:140,sort:true,templet:function(d){
          return '<a style="color:#3c78d8" title="查询归属地" target="_blank" href="//ip.cn/?ip='+d.RegIP+'">'+d.RegIP+'</a>'
      }}
 
      ,{field:'RegTime',title: '注册时间',minWidth:160,sort:true,templet:function(d){
          if(d.RegTime == null){return '';}
          else{return timestampToTime(d.RegTime);}}} 
      ,{title:'操作',toolbar:'#link_operate',width:130}
    ]]
//用户表渲染
table.render({
    elem: '#user_list'
    ,height: 'full-200' //自适应高度
    ,url: './index.php?c=api&method=user_list&u=<?php echo $u;?>' //数据接口
    ,page: true //开启分页
    ,limit:limit  //默认每页显示行数
    ,even:true //隔行背景色
    ,loading:true //加载条
    ,toolbar: '#user_tool'
    ,id:'user_list'
    ,cols: user_cols
});

dropdown.render({elem: '#libs',data:[{title: '本地服务',url: './static'},{title: '小zCDN',url: '//libs.xiaoz.top/lm21/onenav'}] ,click: function(obj){this.elem.val(obj.url);},style: 'width: 190px;'});
//用户行工具栏事件
table.on('tool(user_list)', function(obj){
    var data = obj.data;
    console.log(data)
    if('<?php echo $u;?>' === data.User){layer.msg('您不能对自己操作!', {icon: 5});return false;}
    if(obj.event === 'edit'){
        layer.prompt({formType: 0,value: '',title: '请输入新密码:'},function(value, index, elem){
            if(value.length<8){
                layer.msg('密码长度不能小于8个字符!', {icon: 5});
                return false;
            }
            $.post('./index.php?c=api&method=func&u=<?php echo $u;?>',{'fn':'rootu','Set':'Pass','id':data.ID,'Pass':$.md5(value)},function(data,status){
                if(data.code == 0){
                    layer.closeAll();//关闭所有层
                }
                layer.msg(data.msg, {icon: data.icon});
            });
        });
    } else if(obj.event === 'admin'){
        $.post('./index.php?c=api&method=user_list_login&u=<?php echo $u;?>',{'id':obj.data.ID},function(data,status){
            if(data.code == 0){
                if(data.msg !='Cookie有效'){
                    layer.msg(data.msg, {time: 20000,btn: ['知道了']}, function(index){
                        window.open('./index.php?c=admin&u=' + obj.data.User);
                    });
                }else{
                window.open('./index.php?c=admin&u=' + obj.data.User);
                }
            } else{
                layer.msg(data.msg, {icon: 5});
            }
        });
    } else if(obj.event === 'group'){
        if(data.Level === '0'){
            layer.confirm('是否将 '+data.User+' 设为管理员?',{icon: 3, title:'温馨提示'}, function(index){
                $.post('./index.php?c=api&method=func&u=<?php echo $u;?>',{'fn':'rootu','Set':'Level','id':data.ID,'Level':'999'},function(data,status){
                    if(data.code == 0){obj.update({Level: data.Level});}
                    layer.msg(data.msg, {icon: data.icon});
                });
            });
        }else if(data.Level === '999'){
            layer.confirm('是否将 '+data.User+' 设为普通用户?',{icon: 3, title:'温馨提示'}, function(index){
                $.post('./index.php?c=api&method=func&u=<?php echo $u;?>',{'fn':'rootu','Set':'Level','id':data.ID,'Level':'0'},function(data,status){
                    if(data.code == 0){obj.update({Level: data.Level});}
                    layer.msg(data.msg, {icon: data.icon});
                });
            });
        }
    } else if(obj.event === 'SetName'){
        layer.confirm('该行为存在风险,建议备份data目录在操作!',{icon: 3,anim: 2, title:'温馨提示'}, function(index){ 
            layer.closeAll();
            layer.prompt({formType: 0,anim: 1,value: '',title: '请输入'+data.User+'的新账号:'},function(value, index, elem){
                if(!/^[A-Za-z0-9]{4,13}$/.test(value)){
                    layer.closeAll();
                    layer.msg('账号只能是4到13位的数字和字母!', {icon: 5});
                    return false;
                } 
                $.post('./index.php?c=api&method=func&u=<?php echo $u;?>',{'fn':'rootu','Set':'SetName','id':data.ID,'NewName':value},function(data,status){
                    if(data.code == 0){
                        layer.closeAll();//关闭所有层
                        obj.update({User: value});//回写账号
                        obj.update({SQLite3: value+'.db3'});//回写数据库
                        if( data.du ==1){document.getElementById("DUser").value = value;}//默认用户同步回写
                    }
                    layer.msg(data.msg, {icon: data.icon});
                });
            });
        });
    }
});
//表头工具
table.on('toolbar(user_list)', function(obj){
    var checkStatus = table.checkStatus(obj.config.id),id='';
    var data = checkStatus.data;
    switch(obj.event){
      case 'Del':
      if( data.length == 0 ) {layer.msg('未选中任何数据!'); return;}else{for (let i = 0; i < data.length; i++) {if (i < data.length-1){id +=data[i].ID+','}else{id +=data[i].ID}}}
      console.log(id) 
      num=randomnum(4);
      layer.prompt({formType: 0,value: '',title: '输入'+num+'确定删除:'},function(value, index, elem){
          if(value != num){
              layer.msg('输入内容有误,无需删除请点击取消!', {icon: 5});
              return;
          }else{
              $.post('./index.php?c=api&method=user_list_del&u=<?php echo $u;?>',{'id':id},function(data,status){
                  if(data.code == 0){
                      layer.closeAll();
                      user_search();//刷新表格
                      open_msg('600px', '500px','处理结果',data.res);
                  } else{layer.msg(data.msg);}});
          }
      }); 
    
      break;
      case 'Reg':
      window.open('./index.php?c=<?php echo $Register;?>');
      break;
      case 'help':
      open_msg('300px', '300px','帮助说明','<div style="padding: 15px;">1.点击账号进入用户主页<br>2.点击注册IP查询IP归属地<br>3.点击后台进入用户后台(免密)<br>4.点击用户组可以切换用户组<br>5.升级后建议点击两次修复<br>6.管理员账号都是权限一样的!<br>7.点击数据库可以修改账号</div>');
      break;
      case 'repair':
      $.post('./index.php?c=api&method=func&u=<?php echo $u;?>',{'fn':'repair'},function(data,status){
          if(data.code == 0){
              layer.msg(data.msg, {icon: 1});
          } else{
              open_msg('88%', '88%','修复详情','<div style="padding: 15px;">'+data.msg+'</div>');
          }
      });
      break;
      case 'loginlog':
      window.location.href="./index.php?c=admin&page=loginlog&u=<?php echo $u;?>";
      break;   
      
    }
});
//回车和按钮事件
$('#user_keyword').keydown(function (e){if(e.keyCode === 13){user_search();}}); 
$('.layui-btn').on('click', function(){
   var type = $(this).data('type');
   active[type] ? active[type].call(this) : '';
});

var active = {
user_search:function(){user_search();}
};
//用户搜索
function user_search(){
var keyword = document.getElementById("user_keyword").value;//获取输入内容
table.reload('user_list', {
  url: './index.php?c=api&method=user_list&u=<?php echo $u;?>'
  ,method: 'post'
  ,request: {
   pageName: 'page'
   ,limitName: 'limit'
  }
  ,where: {
   query : keyword
  }
  ,page: {
   curr: 1
  }
});
}
//全局配置
form.on('submit(edit_root)', function(data){
    console.log(data.field) 
    $.post('./index.php?c=api&method=edit_root&u=<?php echo $u;?>',data.field,function(data,status){
      if(data.code == 0) {
        layer.msg('已修改！', {icon: 1});
      }
      else{
        layer.msg(data.msg, {icon: 5});
      }
    });
    return false; 
});  


  //保存订阅信息
  form.on('submit(set_subscribe)', function(data){
    var order_id = data.field.order_id;
    var index = layer.load(1);
    $.get('https://api.lm21.top/api.php?fn=check_subscribe',data.field,function(data,status){
      if(data.code == 200) {
        email = data.data.email;
        end_time = data.data.end_time;
        domain = data.data.domain;
        $("#end_time").val(timestampToTime(end_time));
        //存储到数据库中
        $.post("./index.php?c=api&method=set_subscribe&u=<?php echo $u;?>",{order_id:order_id,email:email,end_time:end_time,domain:domain},function(data,status){
          if(data.code == 0) {
            layer.closeAll('loading');
            layer.msg(data.msg, {icon: 1});
          }
          else{
            layer.closeAll('loading');
            layer.msg(data.msg, {icon: 5});
          }
        });
      }
      else{
        layer.closeAll('loading');
        layer.msg(data.msg, {icon: 5});
      }

    });
    console.log(data.field) 
    return false;
  });
  //清空订阅信息
  form.on('submit(reset_subscribe)', function(data){
    //存储到数据库中
    $.post("./index.php?c=api&method=set_subscribe&u=<?php echo $u;?>",{order_id:'',email:'',end_time:null},function(data,status){
      if(data.code == 0) {
        //清空表单
      $("#order_id").val('');
      $("#email").val('');
      //$("#domain").val('');
      $("#end_time").val('');
        layer.msg(data.msg, {icon: 1});
      }
      else{
        layer.closeAll('loading');
        layer.msg(data.msg, {icon: 5});
      }
    });
    return false; 
  });

//结果弹出
function open_msg(x,y,t,c){
    layer.open({ //弹出结果
    type: 1
    ,title: t
    ,area: [x, y]
    ,maxmin: true
    ,shadeClose: true
    ,content: c
    ,btn: ['我知道了'] 
    });
}
});
</script>
</body>
</html>