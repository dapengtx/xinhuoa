var nwjs={init:function(){this.nw=nwjsgui,this.nw&&(this.win=nwjsgui.Window.get())},createtray:function(a,b){var c,d,e,f;this.nw&&(c="images/logo.png",0==b&&(c="images/logo_hui.png"),d=new nwjsgui.Tray({title:a,icon:c}),d.tooltip=a,this.win.setShowInTaskbar(!1),e=new nwjsgui.Menu,e.append(new nwjsgui.MenuItem({label:"打开窗口",click:function(){nwjs.winshow()}})),e.append(new nwjsgui.MenuItem({label:"退出",click:function(){nwjs.win.close()}})),d.menu=e,d.on("click",function(){nwjs.winshow()}),this.tray=d,0!=b&&(this.win.removeAllListeners("minimize"),this.win.removeAllListeners("close"),this.win.on("minimize",function(){nwjs.win.hide()}),this.win.on("close",function(){try{bodyunload(),js.onunload()}catch(a){}nwjsgui.Window.get().close(!0)}),f=js.getoption("kuaijj","Q"),this.addShortcut(f),this.addfile()))},addShortcut:function(a){var b={key:"Ctrl+Alt+"+a,active:function(){nwjs.changewinhide()}};this.shortcut=new nwjsgui.Shortcut(b),nwjsgui.App.unregisterGlobalHotKey(this.shortcut),nwjsgui.App.registerGlobalHotKey(this.shortcut)},changekuai:function(a){var b=a.value;this.addShortcut(b),js.setoption("kuaijj",b)},removetray:function(){this.nw&&(this.server&&this.server.close(),this.tray.remove(),nwjsgui.App.unregisterGlobalHotKey(this.shortcut),this.tray=!1,this.server=!1)},changewinhide:function(){windowfocus?this.win.hide():this.winshow()},winshow:function(){return this.nw?(this.win.show(),this.win.focus(),void 0):(window.focus(),void 0)},changeicon:function(a){if(this.tray){var b="images/logo.png";a>0&&(b="images/logo_new.png"),this.tray.icon=b}},writeFile:function(a,b){if(this.nw){this.fs||(this.fs=require("fs"));var c=this.getpath();this.fs.writeFile(""+c+"/"+a,b,function(a){a&&js.msg("msg","error:"+a)})}},getpath:function(){var a=nwjsgui.App.manifest.main,b=a.lastIndexOf("\\"),c=a.substr(0,b);return"file:"==c.substr(0,5)&&(c=c.substr(7)),c},addfile:function(){},banben:function(a){a.innerHTML="已是最新"},getipmac:function(){var b,c,d,e,a={ip:"",mac:""};if(!this.nw)return a;b=require("os"),c=b.networkInterfaces();for(d in c){for(e=0;e<c[d].length;e++)if(a=c[d][e],"IPv4"==a.family){a.ip=a.address;break}break}return a},udpserver:function(a){return;if(this.nw){a||(a=function(){});try{var b=require("dgram");this.server=b.createSocket("udp4"),this.server.on("error",function(){nwjs.server.close()}),this.server.on("message",function(b,c){a(b,c)}),this.server.on("listening",function(){}),this.server.bind(8299,"0.0.0.0")}catch(c){this.server=!1}}}};