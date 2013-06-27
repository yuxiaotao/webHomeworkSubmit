function sendTestMail(){
	if($('#smtpCount')){
	  alert('请填写smtp邮箱账号！');
	  return;
	}
	if($('#smtpPas')){
	  alert('请填写smtp邮箱密码！');
	  return;
	}
	if($('#smtpPort')){
	  alert('请填写smtp发送端口！');
	  return;
	}
	if($('#testEmail')){
	  alert('请填写测试收件箱！');
	  return;
	}
	$.post('?m=system&o=sendTestMail',
	      {smtpCount:$('#smtpCount').attr('value'),
		   smtpPas:$('#smtpPas').attr('value'),
		   smtpPort:$('#smtpPort').attr('value'),
		   testEmail:$('#testEmail').attr('value'),
		  },
		  function(data){
		       if(data == '1'){
				  alert('测试邮件已发送，请查看测试收件箱中是否收到测试邮件！');
			   }
			   else{
					alert('邮件发送失败！');
			   }
          }
	);
	return false;

}