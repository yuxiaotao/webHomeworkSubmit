

function getCookie(c_name)
{
if (document.cookie.length>0)
{ 
c_start=document.cookie.indexOf(c_name + "=")
if (c_start!=-1)
{ 
c_start=c_start + c_name.length+1 
c_end=document.cookie.indexOf(";",c_start)
if (c_end==-1) c_end=document.cookie.length
return unescape(document.cookie.substring(c_start,c_end))
} 
}
return ""
}




function getCheckNum(){
	
		    $('#checkImg').attr('src','./?m=ajax&o=checknum&timestmp='+Date.parse(new Date()));
			
}

function confirmGo(url,msg){
	if(msg == '')
	  msg = '确定要执行此操作吗？';
	if(confirm(msg))
		top.location=url;
	return;
}




function clearHTML(id){
     $('#'+id).hide();
}