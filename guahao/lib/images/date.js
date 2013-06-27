
var finishtimeformat = {format:'yyyy-MM'};
var appointtimeformat = {format:'HH:mm'};

function CalendarHelper(args) {
 if(document.getElementById("ContainerPanel") == null) {this.InitContainerPanel();}
 //private
 this.pickMode = {"second":1, "minute":2, "hour":3, "day":4, "month":5, "year":6};
 //语言包，可自由扩展
 this.language = {
  "year":[[""], [""]],
  "months":[
   ["一月","二月","三月","四月","五月","六月","七月","八月","九月","十月","十一月","十二月"],
   ["JAN","FEB","MAR","APR","MAY","JUN","JUL","AUG","SEP","OCT","NOV","DEC"]
  ],
  "weeks":[
   ["日","一","二","三","四","五","六"],
   ["SUN","MON","TUR","WED","THU","FRI","SAT"]
  ],
  "hour":[["时"], ["H"]],
  "minute":[["分"], ["M"]],
  "second":[["秒"], ["S"]],
  "clear":[["清空"], ["CLS"]],
  "today":[["今天"], ["TODAY"]],
  "pickTxt":[["确定"], ["OK"]],//精确到年、月时把今天变成“确定”
  "close":[["关闭"], ["CLOSE"]]
 };
 
 //public
 this.form = null;
 this.date = new Date();
 this.year = this.date.getFullYear();
 this.month = this.date.getMonth();
 this.day = this.date.getDate();
 this.hour = this.date.getHours();
 this.minute = this.date.getMinutes();
 this.second = this.date.getSeconds();
 //自定义定位偏移量
 this.leftX = 0;
 this.topY = 0;
 var date = new Date();
 this.isFocus = false;//是否为焦点
 this.beginYearLoad = this.year - 50;
 this.endYearLoad = this.year + 50;
 this.beginYear = this.beginYearLoad;
 this.endYear = this.endYearLoad;
 this.DateMode = this.pickMode["second"];//复位
 this.lang = 0;//0(中文) | 1(英文)
 this.dateFormatStyle = "yyyy-MM-dd HH:mm:ss";
 this.dateFormatStyleOld = this.dateFormatStyle;
 this.dateControl = null;
 this.panel = this.getElementById("calendarPanel");
 this.container = this.getElementById("ContainerPanel");
 
 //重新赋值
 if(args.beginYear != null) this.beginYear = args.beginYear;
 if(args.endYear != null)this.endYear = args.endYear;
 if(args.lang != null) this.lang = args.lang;
}
CalendarHelper.prototype = {
 /**
  * 返回日期
  * @param d the delimiter
  * @param p the pattern of your date
  */
 toDate:function(str, style) {
  if(str == null) return new Date();
  try {
   //alert(str + ",style=" + style);
   if(str.length == style.length)
   {
    var y = str.substring(style.indexOf('y'),style.lastIndexOf('y') + 1);//年
    var M = str.substring(style.indexOf('M'),style.lastIndexOf('M') + 1);//月
    var d = str.substring(style.indexOf('d'),style.lastIndexOf('d') + 1);//日
    var H = str.substring(style.indexOf('H'),style.lastIndexOf('H') + 1);//时
    var m = str.substring(style.indexOf('m'),style.lastIndexOf('m') + 1);//分
    var s = str.substring(style.indexOf('s'),style.lastIndexOf('s') + 1);//秒
    if((s == null || s == "" || isNaN(s))) {s = new Date().getSeconds();}
    if((m == null || m == "" || isNaN(m))) {m = new Date().getMinutes();}
    if((H == null || H == "" || isNaN(H))) {H = new Date().getHours();}
    if((d == null || d == "" || isNaN(d))) {d = new Date().getDate();}
    if((M == null || M == "" || isNaN(M))) {M = new Date().getMonth()+1;}
    if((y == null || y == "" || isNaN(y))) {y = new Date().getFullYear();}
    if(y < 1000) {y = new Date().getFullYear();}
    //alert("y" + y + ",M" + M + ",d" + d + ",H" + H + ",m" + m + ",s" + s + ",style=" + style);
    var dt ;
    eval("dt = new Date('" + y + "', '" + (M - 1) + "','" + d + "','" + H + "','" + m + "','" + s + "')");
    return dt;
   }
   return new Date();
  }
  catch(e) {
   alert(e.name + e.message);
  }
 },
 /**
  * 格式化日期
  * @param d the delimiter
  * @param p the pattern of your date
  */
 format:function(date, style) {
  var o = {
   "M+":date.getMonth() + 1,//month
   "d+":date.getDate(),//day
   "H+":date.getHours(),//hour
   "m+":date.getMinutes(),//minute
   "s+":date.getSeconds(),//second
   "w+":"天一二三四五六".charAt(date.getDay()),//week
   "q+":Math.floor((date.getMonth() + 3) / 3),//quarter
   "S":date.getMilliseconds()//millisecond
  }
  if(/(y+)/.test(style)) {
   style = style.replace(RegExp.$1, (date.getFullYear() + "").substr(4 - RegExp.$1.length));
  }
  for(var k in o) {
   if(new RegExp("("+ k +")").test(style)) {
    style = style.replace(RegExp.$1, RegExp.$1.length == 1 ? o[k] : ("00" + o[k]).substr(("" + o[k]).length));
   }
  }
  return style;
 },
 //确保日历容器节点在 body 最后，否则 FireFox 中不能出现在最上方
 //初始化容器
 InitContainerPanel:function() {
  var str = '<div id="calendarPanel" style="position:absolute;display:none;z-index:9999;" class="CalendarPanel"></div>';
  if(document.all) {
   str += '<iframe style="position:absolute; z-index:2000; width:expression(this.previousSibling.offsetWidth); ';
   str += 'height:expression(this.previousSibling.offsetHeight); ';
   str += 'left:expression(this.previousSibling.offsetLeft); top:expression(this.previousSibling.offsetTop); ';
   str += 'display:expression(this.previousSibling.style.display); " scrolling="no" frameborder="no"></iframe>';
  }
  var div = document.createElement("div");
  div.innerHTML = str;
  div.id = "ContainerPanel";
  div.style.display = "none";
  document.body.appendChild(div);
 },
 //返回所选日期
 ReturnDate:function(dt) {
  var calendar = this;
  if(this.dateControl != null) {this.dateControl.value = dt;}
  calendar.hide();
  if(this.dateControl.onchange == null){return;}
  //将onchange转成其它函数，以免触发验证事件
  var ev = this.dateControl.onchange.toString();//找出函数的字串
  ev = ev.substring(((ev.indexOf("ValidatorOnChange(); ") > 0) ? ev.indexOf("ValidatorOnChange();") + 20 : ev.indexOf("{") + 1), ev.lastIndexOf("}"));//去除验证函数 ValidatorOnChange();
  var fun = new Function(ev);//重新定义函数
  this.dateControl.changeEvent = fun;
  this.dateControl.changeEvent();//触发自定义 changeEvent 函数
 },
 draw:function() {
  var calendar = this;
  var mvAry = [];
  mvAry[mvAry.length] = '<div name="calendarForm" style="margin: 0px; ">';
  //start
  //------------------------------放置上一月、年、月、下一月按钮------------------------------
  mvAry[mvAry.length] = '<table width="100%" cellpadding="0" cellspacing="1" class="CalendarTop">';
  mvAry[mvAry.length] = '<tr class="title">';
  
  mvAry[mvAry.length] = '<th align="left" class="prevMonth"><input style="';
  if(calendar.DateMode > calendar.pickMode["month"]) {mvAry[mvAry.length] = 'display:none; ';}//精确到年时隐藏“月”
  mvAry[mvAry.length] ='" id="prevMonth" name="prevMonth" type="button" value="&lt;" /></th>';
  
  mvAry[mvAry.length] = '<th align="center" width="98%" nowrap="nowrap" class="YearMonth">';
  mvAry[mvAry.length] = '<select name="calendarYear" id="calendarYear" class="Year"></select>';
  mvAry[mvAry.length] = '<select name="calendarMonth" id="calendarMonth" class="Month" style="';
  if(calendar.DateMode > calendar.pickMode["month"]) {mvAry[mvAry.length] = 'display:none;';}//精确到年时隐藏“月”
  mvAry[mvAry.length] = '"></select></th>';
  
  mvAry[mvAry.length] = '<th align="right" class="nextMonth"><input style="';
  if(calendar.DateMode > calendar.pickMode["month"]) {mvAry[mvAry.length] = 'display:none;';}//精确到年时隐藏“月”
  mvAry[mvAry.length] ='" id="nextMonth" name="nextMonth" type="button" value="&gt;" /></th>';
  
  mvAry[mvAry.length] = '</tr>';
  mvAry[mvAry.length] = '</table>';
  
  //------------------------------放置日期------------------------------
  mvAry[mvAry.length] = '<table id="calendarTable" width="100%" class="CalendarDate" style="';
  if(calendar.DateMode >= calendar.pickMode["month"]) {mvAry[mvAry.length] = 'display:none;';}//精确到年、月时隐藏“天”
  mvAry[mvAry.length] = '" cellpadding="0" cellspacing="1">';
  mvAry[mvAry.length] = '<tr class="title">';
  for(var i = 0; i < 7; i++) {
   mvAry[mvAry.length] = '<th>' + this.language["weeks"][this.lang][i] + '</th>';
  }
  mvAry[mvAry.length] = '</tr>';
  for(var i = 0; i < 6; i++) {
   mvAry[mvAry.length] = '<tr align="center" class="date">';
   for(var j = 0; j < 7; j++) {
    if(j == 0) {
     mvAry[mvAry.length] = '<td class="sun" name="tdSun" class="sun"></td>';
    }
    else if(j == 6) {
     mvAry[mvAry.length] = '<td class="sat" name="tdSat" class="sat"></td>';
    }
    else {
     mvAry[mvAry.length] = '<td class="day" name="tdDay" class="day"></td>';
    }
   }
   mvAry[mvAry.length] = '</tr>';
  }
  mvAry[mvAry.length] = '</table>';
  //------------------------------放置时间的行------------------------------
  mvAry[mvAry.length] = '<table width="100%" class="CalendarTime" style="';
  if(calendar.DateMode >= calendar.pickMode["day"]) {mvAry[mvAry.length] = 'display:none;';}//精确到时日隐藏“时间”
  mvAry[mvAry.length] = '" cellpadding="0" cellspacing="1">';
  mvAry[mvAry.length] = '<tr><td align="center" colspan="7">';
  mvAry[mvAry.length] = '<select id="calendarHour" name="calendarHour" class="Hour"></select>' + this.language["hour"][this.lang];
  mvAry[mvAry.length] = '<span style="'
  if(calendar.DateMode >= calendar.pickMode["hour"]) {mvAry[mvAry.length] = 'display:none;';}//精确到小时时隐藏“分”
  mvAry[mvAry.length] = '"><select id="calendarMinute" name="calendarMinute" class="Minute"></select>' + this.language["minute"][this.lang]+'</span>';
  mvAry[mvAry.length] = '<span style="'
  if(calendar.DateMode >= calendar.pickMode["minute"]) {mvAry[mvAry.length] = 'display:none;';}//精确到小时、分时隐藏“秒”
  mvAry[mvAry.length] = '"><select id="calendarSecond" name="calendarSecond" class="Second"></select>'+ this.language["second"][this.lang]+'</span>';
  mvAry[mvAry.length] = '</td></tr>';
  mvAry[mvAry.length] = '</table>';
  
  mvAry[mvAry.length] = '<div align="center" class="CalendarButtonDiv">';
  mvAry[mvAry.length] = '<input id="calendarClear" name="calendarClear" type="button" value="' + this.language["clear"][this.lang] + '"/> ';
  mvAry[mvAry.length] = '<input id="calendarToday" name="calendarToday" type="button" value="'
  mvAry[mvAry.length] = (calendar.DateMode == calendar.pickMode["day"]) ? this.language["today"][this.lang] : this.language["pickTxt"][this.lang];
  mvAry[mvAry.length] = '" /> ';
  mvAry[mvAry.length] = '<input id="calendarClose" name="calendarClose" type="button" value="' + this.language["close"][this.lang] + '" />';
  mvAry[mvAry.length] = '</div>';
  
  mvAry[mvAry.length] = '</div>';
  //end
  this.panel.innerHTML = mvAry.join("");
  
  var obj = this.getElementById("prevMonth");
  obj.onclick = function() {calendar.goPrevMonth(calendar);}
  obj.onblur = function() {calendar.onblur();}
  this.prevMonth= obj;
  
  obj = this.getElementById("nextMonth");
  obj.onclick = function() {calendar.goNextMonth(calendar);}
  obj.onblur = function() {calendar.onblur();}
  this.nextMonth= obj;
  
  obj = this.getElementById("calendarClear");
  obj.onclick = function() {
   calendar.ReturnDate("");
  }
  this.calendarClear = obj;
  
  obj = this.getElementById("calendarClose");
  obj.onclick = function() {calendar.hide();}
  this.calendarClose = obj;
  
  obj = this.getElementById("calendarYear");
  obj.onchange = function() {calendar.update(calendar);}
  obj.onblur = function() {calendar.onblur();}
  this.calendarYear = obj;
  
  obj = this.getElementById("calendarMonth");
  with(obj) {
   onchange = function() {calendar.update(calendar);}
   onblur = function() {calendar.onblur();}
  }
  this.calendarMonth = obj;
  
  obj = this.getElementById("calendarHour");
  obj.onchange = function() {calendar.hour = this.options[this.selectedIndex].value;}
  obj.onblur = function() {calendar.onblur();}
  this.calendarHour = obj;
  
  obj = this.getElementById("calendarMinute");
  obj.onchange = function() {calendar.minute = this.options[this.selectedIndex].value;}
  obj.onblur = function() {calendar.onblur();}
  this.calendarMinute = obj;
  
  obj = this.getElementById("calendarSecond");
  obj.onchange = function() {calendar.second = this.options[this.selectedIndex].value;}
  obj.onblur = function() {calendar.onblur();}
  this.calendarSecond = obj;
  
  obj = this.getElementById("calendarToday");
  obj.onclick = function() {
   var today = 
   (calendar.DateMode != calendar.pickMode["day"])
     ? new Date(calendar.year, calendar.month, calendar.day, calendar.hour, calendar.minute, calendar.second)
     : new Date();
   calendar.ReturnDate(calendar.format(today, calendar.dateFormatStyle));
  }
  this.calendarToday = obj;
 },
 //年份下拉框绑定数据
 bindYear:function() {
  var cy = this.calendarYear;
  cy.length = 0;
  for(var i = this.beginYear; i <= this.endYear; i++) {
   cy.options[cy.length] = new Option(i + this.language["year"][this.lang], i);
  }
 },
 //月份下拉框绑定数据
 bindMonth:function() {
  var cm = this.calendarMonth;
  cm.length = 0;
  for(var i = 0; i < 12; i++) {
   cm.options[cm.length] = new Option(this.language["months"][this.lang][i], i);
  }
 },
 //小时下拉框绑定数据
 bindHour:function() {
  var ch = this.calendarHour;
  if(ch.length > 0) {return;}
  var H;
  for(var i = 0; i < 24; i++) {
   H = ("00" + i + "").substr(("" + i).length);
   ch.options[ch.length] = new Option(H, H);
  }
 },
 //分钟下拉框绑定数据
 bindMinute:function() {
  var cM = this.calendarMinute;
  if(cM.length > 0) {return;}
  var M;
  for(var i = 0; i < 60; i++) {
   M = ("00" + i + "").substr(("" + i).length);
   cM.options[cM.length] = new Option(M, M);
  }
 },
 //秒钟下拉框绑定数据
 bindSecond:function() {
  var cs = this.calendarSecond;
  if(cs.length > 0) {return;}
  var s;
  for(var i = 0; i < 60; i++) {
   s = ("00" + i + "").substr(("" + i).length);
   cs.options[cs.length] = new Option(s, s);
  }
 },
 //向前一月
 goPrevMonth:function(e) {
  if(this.year == this.beginYear && this.month == 0) {return;}
  this.month--;
  if(this.month == -1) {
   this.year--;
   this.month = 11;
  }
  this.date = new Date(this.year, this.month, 1);
  this.changeSelect();
  this.bindData();
 },
 //向后一月
 goNextMonth:function(e) {
  if(this.year == this.endYear && this.month == 11) {return;}
  this.month++;
  if(this.month == 12) {
   this.year++;
   this.month = 0;
  }
  this.date = new Date(this.year, this.month, 1);
  this.changeSelect();
  this.bindData();
 },
 //改变SELECT选中状态
 changeSelect:function() {
  var cy = this.calendarYear;
  var cm = this.calendarMonth;
  var ch = this.calendarHour;
  var cM = this.calendarMinute;
  var cs = this.calendarSecond;
  //当初始值为空时,若有效年份并不包括今天时将有可能超出索引位置
  if(this.date.getFullYear() - this.beginYear < 0 || this.date.getFullYear() - this.beginYear >= cy.length) {
   cy[0].selected = true;
  }
  else {
   cy[this.date.getFullYear() - this.beginYear].selected = true;
  }
  cm[this.date.getMonth()].selected = true;
  //初始化时间的值
  ch[this.hour].selected = true;
  cM[this.minute].selected = true;
  cs[this.second].selected = true;
 },
 //更新年、月
 update:function(e) {
  this.year = e.calendarYear.options[e.calendarYear.selectedIndex].value;
  this.month = e.calendarMonth.options[e.calendarMonth.selectedIndex].value;
  this.date = new Date(this.year, this.month, 1);
  this.bindData();
 },
 //绑定数据到月视图
 bindData:function() {
  var calendar = this;
  if(calendar.DateMode >= calendar.pickMode["month"]) {return;}
  //修改 在Firefox 下年份错误
  //var dateArray = this.getMonthViewArray(this.date.getYear(), this.date.getMonth());
  var dateArray = this.getMonthViewArray(this.date.getFullYear(), this.date.getMonth());
  var tds = this.getElementById("calendarTable").getElementsByTagName("td");
  for(var i = 0; i < tds.length; i++) {
   tds[i].onclick = function() {return;}
   tds[i].onmouseover = function() {return;}
   tds[i].onmouseout = function() {return;}
   if(i > dateArray.length - 1) break;
   tds[i].innerHTML = dateArray[i];
   if(dateArray[i] != "  ") {
    if(tds[i].getAttribute("name") == "tdSun") {
     tds[i].className = "sun";
    }
    else if(tds[i].getAttribute("name") == "tdSat") {
     tds[i].className = "sat";
    }
    else {
     tds[i].className = "day";
    }
    var cur = new Date();
    tds[i].isToday = false;
    if(cur.getFullYear() == calendar.date.getFullYear() && cur.getMonth() == calendar.date.getMonth() && cur.getDate() == dateArray[i]) {
     //是今天的单元格
     tds[i].className = "today";
     tds[i].isToday = true;
    }
    if(calendar.dateControl != null) {
     cur = calendar.toDate(calendar.dateControl.value, calendar.dateFormatStyle);
     if(cur.getFullYear() == calendar.date.getFullYear() && cur.getMonth() == calendar.date.getMonth()&& cur.getDate() == dateArray[i]) {
      //是已被选中的单元格
      calendar.selectedDayTD = tds[i];
      tds[i].className = "selDay";
     }
    }
    tds[i].onclick = function() {
     if(calendar.DateMode == calendar.pickMode["day"]) {//当选择日期时，点击格子即返回值
      calendar.ReturnDate(calendar.format(new Date(calendar.date.getFullYear(), calendar.date.getMonth(), this.innerHTML), calendar.dateFormatStyle));
     }
     else {
      if(calendar.selectedDayTD != null) {//清除已选中的背景色
       if(calendar.selectedDayTD.isToday) {
        calendar.selectedDayTD.className = "today";
       }
       else {
        if(calendar.selectedDayTD.getAttribute("name") == "tdSun") {
         calendar.selectedDayTD.className = "sun";
        }
        else if(calendar.selectedDayTD.getAttribute("name") == "tdSat") {
         calendar.selectedDayTD.className = "sat";
        }
        else {
         calendar.selectedDayTD.className = "day";
        }
       }
      }
      this.className = "selDay";
      calendar.day = this.innerHTML;
      calendar.selectedDayTD = this;//记录已选中的日子
     }
    }
    tds[i].onmouseover = function() {
     this.className = "dayOver";
    }
    tds[i].onmouseout = function() {
     if(calendar.selectedDayTD != this) {
      if(this.isToday) {
       this.className = "today";
      }
      else {
       if(this.getAttribute("name") == "tdSun") {
        this.className = "sun";
       }
       else if(this.getAttribute("name") == "tdSat") {
        this.className = "sat";
       }
       else {
        this.className = "day";
       }
      }
     }
     else {
      this.className = "selDay";
     }
    }
    tds[i].onblur = function() {calendar.onblur();}
   }
  }
 },
 //根据年、月得到月视图数据(数组形式)
 getMonthViewArray:function(y, m) {
  var mvArray = [];
  var dayOfFirstDay = new Date(y, m, 1).getDay();
  var daysOfMonth = new Date(y, m + 1, 0).getDate();
  for(var i = 0; i < 42; i++) {
   mvArray[i] = "  ";
  }
  for(var i = 0; i < daysOfMonth; i++) {
   mvArray[i + dayOfFirstDay] = i + 1;
  }
  return mvArray;
 },
 //扩展 document.getElementById(id) 多浏览器兼容性
 getElementById:function(id) {
  if(typeof(id) != "string" || id == "") return null;
  if(document.getElementById) return document.getElementById(id);
  if(document.all) return document.all(id);
  try {return eval(id);}
  catch(e) {return null;}
 },
 //扩展 object.getElementsByTagName(tagName)
 getElementsByTagName:function(object, tagName) {
  if(document.getElementsByTagName) return document.getElementsByTagName(tagName);
  if(document.all) return document.all.tags(tagName);
 },
 //取得HTML控件绝对位置
 getAbsPoint:function(e) {
  var x = e.offsetLeft;
  var y = e.offsetTop;
  while(e = e.offsetParent){
   x += e.offsetLeft;
   y += e.offsetTop;
  }
  return {"x": x, "y": y};
 },
 reset:function(args) {
  try{
   //全部复位
   this.leftX = 0;
   this.topY = 0;
   this.beginYear = this.beginYearLoad;
   this.endYear = this.endYearLoad;
   //this.lang = 0;
   //重新赋值
   if(args.left != null) this.leftX = args.left;
   if(args.top != null) this.topY = args.top;
   if(args.beginYear != null) this.beginYear = args.beginYear;
   if(args.endYear != null)this.endYear = args.endYear;
   //if(args.lang != null) this.lang = args.lang;//0(中文) | 1(英文)
   this.DateMode = this.pickMode["second"];//复位
   if(args.format == null) {
    args.format = "yyyy-MM-dd HH:mm:ss";
   }
   else {
    args.format = args.format + "";
    if(args.format.indexOf('s') < 0) {this.DateMode = this.pickMode["minute"];}//精度为分
    if(args.format.indexOf('m') < 0) {this.DateMode = this.pickMode["hour"];}//精度为时
    if(args.format.indexOf('H') < 0) {this.DateMode = this.pickMode["day"];}//精度为日
    if(args.format.indexOf('d') < 0) {this.DateMode = this.pickMode["month"];}//精度为月
    if(args.format.indexOf('M') < 0) {this.DateMode = this.pickMode["year"];}//精度为年
    if(args.format.indexOf('y') < 0) {this.DateMode = this.pickMode["second"];}//默认精度为秒
   }
   this.dateFormatStyleOld = this.dateFormatStyle;
   this.dateFormatStyle = args.format;
  }
  catch(e) {
   //alert(e.name + "," + e.message);
  }
 },
 //显示日历
 show:function(dateObj, args, popControl) {
  var calendar = this;
  calendar.reset(args);
  if(dateObj == null) {
   throw new Error("arguments[0] is necessary")
  }
  this.dateControl = dateObj;
  var now = new Date();
  this.date = (dateObj.value.length > 0) ? new Date(calendar.toDate(dateObj.value ,this.dateFormatStyle)) : calendar.toDate(calendar.format(now, this.dateFormatStyle), this.dateFormatStyle);//若为空则根据dateFormatStyle初始化日期
  if(this.panel.innerHTML==""||calendar.dateFormatStyleOld != calendar.dateFormatStyle) {//构造表格，若请示的样式改变，则重新初始化
   this.draw();
   this.bindYear();
   this.bindMonth();
   this.bindHour();
   this.bindMinute();
   this.bindSecond();
  }
  this.year = this.date.getFullYear();
  this.month = this.date.getMonth();
  this.day = this.date.getDate();
  this.hour = this.date.getHours();
  this.minute = this.date.getMinutes();
  this.second = this.date.getSeconds();
  this.changeSelect();
  this.bindData();
  if(popControl == null) {
   popControl = dateObj;
  }
  var xy = this.getAbsPoint(popControl);
  this.panel.style.left = (xy.x + this.leftX) + "px";//自定义偏移量
  this.panel.style.top = (xy.y + this.topY + dateObj.offsetHeight) + "px";
  this.panel.style.display = "";
  this.container.style.display = "";
  if( !this.dateControl.isTransEvent) {
   this.dateControl.isTransEvent = true;
   /* 已写在返回值的时候 ReturnDate 函数中，去除验证事件的函数
   this.dateControl.changeEvent = this.dateControl.onchange;//将 onchange 转成其它函数，以免触发验证事件
   this.dateControl.onchange = function() {
    if(typeof(this.changeEvent) =='function') {this.changeEvent();}
   }*/
   if(this.dateControl.onblur != null) {
   this.dateControl.blurEvent = this.dateControl.onblur;}//保存主文本框的 onblur ，使其原本的事件不被覆盖
   this.dateControl.onblur = function() {
    calendar.onblur();
    if(typeof(this.blurEvent) == 'function') {
     this.blurEvent();
    }
   }
  }
  this.container.onmouseover = function() {calendar.isFocus = true;}
  this.container.onmouseout = function() {calendar.isFocus = false;}
 },
 //隐藏日历
 hide:function() {
  this.panel.style.display = "none";
  this.container.style.display = "none";
  this.isFocus = false;
 },
 //焦点转移时隐藏日历
 onblur:function() {
  if(!(this.isFocus)) {this.hide();}
 }
}

/**
 * 调用方法：
 * 1、传入对象：SelectDate(this,{format:'yyyy 年'})
 * 2、传入 ID：SelectDateById('Txt_CreateDateST01',{format:'yyyy 年'})
 * 3、参数 SelectDate(this,{format:'yyyy 年',left:0,top:-150})
 * 目前支持如下参数
 * args{beginYear:1950,endYear:2050,lang:0,format:"yyyy-MM-dd HH-mm-ss",left:0,top:0}
 * @param beginYear Integer 大于1000小于9999 如1950
 * @param endYear Integer 大于1000小于9999 如2050
 * @param lang Integer 0(中文)|1(英语) 可自由扩充
 * @param format String "yyyy-MM-dd HH-mm-ss"
 * @param left Integer 相对X坐标
 * @param top Integer 相对Y坐标
 * 格式（注意大小写）：yyyy→年，MM→月，dd→天，HH→24小时制，mm→分钟，ss→秒
 * 0 → 相对于文本框的横向偏移量
 * -50 → 相对于文本框的纵向偏移量
 */
//选择日期,通过ID来选日期
function SelectDateById(id, args) {
 var obj = document.getElementById(id);
 if(obj == null) {return false;}
 obj.focus();
 if(obj.onclick != null) {obj.onclick();}
 else if(obj.click != null) {obj.click();}
 else {SelectDate(obj, args)}
}
var __cal__;
//选择日期
function SelectDate(obj, args) {
 //不用每次都初始化，第一次和语言包有变化时重新初始化
 __cal__ = (__cal__ == null || (args.lang != null && args.lang != __cal__.lang))
  ? new CalendarHelper(args)
  : __cal__;
 __cal__.show(obj, args);
}