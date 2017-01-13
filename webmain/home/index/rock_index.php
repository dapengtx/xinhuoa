<?php if(!defined('HOST'))die('not access');?>
<script>
todocontent = '';
$(document).ready(function(){
	var optdt = '',loadci=0,miao=200;
	var c= {
		gettotal:function(){
			clearTimeout(this.timeteims);
			var url = js.getajaxurl('gettotal','index','home');
			$('#refresh_text').html('刷新统计中...');
			$.post(url,{loadci:loadci,optdt:optdt}, function(da){
				c.gettotalshow(js.decode(da));
			});
		},
		refresh:function(){
			this.gettotal();
		},
		shumiao:function(oi){
			clearTimeout(this.timeteims);
			if(oi<=0){
				this.gettotal();
			}else{
				$('#refresh_text').html(''+oi+'秒后刷新');
				this.timeteims = setTimeout(function(){c.shumiao(oi-1)},1000);
			}
		},
		gettotalshow:function(a){
			this.shumiao(miao);
			loadci++;
			optdt = a.optdt;
			if(loadci==1){
				jm.setJmstr(jm.base64decode(a.showkey));
				admintoken = a.token;
				this.showicons(a.menuarr);
			}
			this.showgonglist(a.gongarr);
			this.showapplylist(a.applyarr);
			$('#guestbook_wd').html(a.todo+'');
			for(var oi in a.total)this.showtotal(a.total[oi],oi);
			var d = a.worklist;
			$("span[tempid='showloat_{rand}']").remove();
			var i=0,s='',s1='';
			if(d)for(i=0; i<d.length; i++){
				s = ''+(i+1)+'、『'+d[i].type+'』'+d[i].title+' <font color="'+statecolor[d[i].state]+'">['+statearr[d[i].state]+']</font>';
				s1 = '<span tempid="showloat_{rand}" class="list-group-item">'+s+'';
				s1+=' <a href="javascript:" onclick="return openwork(\''+d[i].id+'\')">[查看]</a>';
				s1+= '</span>';
				$('#worklist_{rand}').append(s1);
			}
			var s=a.msgar[0],s1=a.msgar[1];
			if(s!=''){
				todocontent = s;
				var tx = this.opennewtx(1);
				if(tx=='0'){
					$('#tishidivshow').fadeIn();
					$('#tishicontent').html(s);
				}
			}
		},
		showtotal:function(to, sid){
			var o = $('#'+sid+'_{rand}');
			if(!o)return;
			if(to<=0){
				o.hide();
			}else{
				o.show();
				o.html(to);
			}
		},
		showicons:function(a){
			a.push({name:'刷新统计中...',icons:'refresh',num:'refresh',color:'#888888'});
			this.menuarr = a;
			var o = $('.homelishow'),s='';
			o.html('');
			for(var i=0; i<a.length;i++){
				s = '<li>';
				s+= '<div onclick="opentabsshowshwo('+i+')" class="homeiconss">';
				s+=	'<div class="div00"><span id="'+a[i].num+'_{rand}" style="display:none" class="badge red"></span></div>';
				s+=	'	<div style="background-color:'+a[i].color+'" class="homeiconss2">';
				s+=	'		<div class="div01"><i class="icon-'+a[i].icons+'"></i></div>';
				s+=	'		<div id="'+a[i].num+'_text">'+a[i].name+'<div>';
				s+=	'	</div>';
				s+=	'</div>';
				s+=	'</li>';
				o.append(s);
			}
		},
		opennewtx:function(lx){
			return '0';
		},
		showgonglist:function(a){
			var s='',a1,i;
			for(i=0;i<a.length;i++){
				a1=a[i];
				s+='<a onclick="openxiangs(\''+a1.typename+'\',\'gong\',\''+a1.id+'\');$(this).remove();" class="list-group-item">◇【'+a1.typename+'】'+a1.title+'['+a1.indate+']</a>';
			}
			$('#homegonglist').html(s);
		},
		showapplylist:function(a){
			var s='',a1,i;
			for(i=0;i<a.length;i++){
				a1=a[i];
				s+='<a onclick="openxiangs(\''+a1.modename+'\',\''+a1.modenum+'\',\''+a1.id+'\');" class="list-group-item">◇'+a1.cont+'</a>';
			}
			if(a1)$('#myapplylisttotal').html(a1.count);
			$('#myapplylist').html(s);
		}
	}
	

	
	js.initbtn(c);
	c.gettotal();
	c.opennewtx(0);
	
	opentabsshowshwo=function(oi){
		var a = c.menuarr[oi];
		if(a.num=='refresh'){
			c.refresh();
		}else{
			var anum = {num:a.num,url:a.url,name:a.name,icons:a.icons,id:a.id};
			addtabs(anum);
		}
		return false;
	}
	
	opennewtodo=function(){
		var l = screen.width-350,t=screen.height-200;
		js.open('?m=index&d=home&a=todo',350,180,'systodowin','toolbar=no,menubar=no,scrollbars=yes,resizable=yes,location=no,status=no,left='+l+'px,top='+t+'px');
	}
	newsetshezttt=function(o){
		var tx = '0';
		if(o.checked){
			setTimeout(function(){opennewtodo()}, 1000);
			tx = '1';
		}
		js.setoption('autoopentodo', tx);
	}
	opentixiangs=function(){
		opentixiang();
		hideTishi();
		return false;
	}
	hideTishi=function(){
		$('#tishidivshow').fadeOut();
		return false;
	}
	$('#banben').html(VERSION);
	
	$('body').append('<div id="tishidivshow" style="display:none" class="box"><div class="title"><ul><li>&nbsp;<i class="icon-bell"></i>&nbsp;系统提醒</li><li style="text-align:right"><a href="javascript:"><img src="images/wclose.png" onclick="return hideTishi()"></a>&nbsp;</li></ul></div><div id="tishicontent" style="height:130px;overflow:auto;padding:10px;text-align:left"></div></div>');
	
	openmobile=function(){
		js.tanbody('loginmobile','登录手机版', 300,200,{
			html:'<div  style="height:160px;padding:5px" align="center"><div><img id="logeweerew" src="images/logo.png" width="130" height="130"></div><div>直接扫一扫即可登录</div></div>'
		});
		var surl = js.getajaxurl('getqrcode','index','home'),surls = js.getajaxurl('getqrcores','index','home');
		$.get(surls,function(ass){
			if(ass!='ok'){
				$('#logeweerew').parent().html('<div style="padding:10px 20px;text-align:left">未开启gd库，不能生成二维码，<br>可手机浏览器输入地址:<br>'+ass+'</div>');
			}else{
				get('logeweerew').src=surl;
			}
		});
	}
	openwangyban=function(){
		window.open('web/login.html?user='+adminuser+'&token='+admintoken+'');
	}
	
	moregonggao=function(){
		addtabs({num:'gong',url:'system,infor,geren',icons:'volume-up',name:'通知公告'});
	}
	moemyapplylist=function(){
		addtabs({num:'applymy',url:'main,fwork,bill,atype=my',icons:'align-left',name:'我的申请'});
	}
	
	
	
	js.importjs('web/res/mode/echarts/echarts.common.min.js');
	js.importjs('web/res/js/jquery-imgview.js');
});
</script>
<style>
.homelishow{display:inline-block}
.homelishow li{float:left;text-align:center;}
.divlisssa li{float:left;padding:8px 0px;text-align:left;width:33%}
.divlisssa ul,.divlisssa{display:inline-block;width:100%}
</style>


<div style="padding:10px;">
	
	<div align="left">
		<ul class="homelishow">
			<li>
				<div  click="refresh" class="homeiconss">
					<div style="background-color:#888888" class="homeiconss2">
						<div class="div01"><i class="icon-refresh"></i></div>
						<div id="refresh_text">刷新中<div>
					</div>	
				</div>	
			</li>
		</ul>
	</div>
	
	<div class="blank1" style="margin:10px 0px"></div>
	<div class="blank10"></div>
	
	<div align="left" style="padding:0px 10px">
		<table  border="0" width="100%" cellspacing="0" cellpadding="0">
		<tr valign="top">
			<td width="50%">
				<div align="left" style="min-width:300px" class="list-group">
				<div class="list-group-item  list-group-item-info">
					<i class="icon-volume-up"></i> 通知公告
					<a style="float:right" onclick="moregonggao()">更多&gt;&gt;</a>
				</div>
				<span id="homegonglist"></span>
				</div>
			</td>
			<td style="padding-left:20px;">
				<div align="left" style="min-width:300px" class="list-group">
				<div class="list-group-item  list-group-item-info">
					<i class="icon-align-left"></i> 我的申请(<span id="myapplylisttotal">0</span>)
					<a style="float:right" onclick="moemyapplylist()">更多&gt;&gt;</a>
				</div>
				<span id="myapplylist"></span>
				</div>
			</td>
			
			
			
		</tr>
		</table>
	</div>
	

	
	<div class="tishi" align="center">Copyright ©2016 <?php echo $config['title'] ?></div>
	
</div>