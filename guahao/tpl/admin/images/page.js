$(document).ready(function(){

			var editor;
			KindEditor.ready(function(K) {
				K.create('textarea[name="content"]', {
					resizeType : 1,
					allowPreviewEmoticons : false,
					allowImageUpload : false,
					items : [
						'justifyleft', 'justifycenter', 'justifyright', '|','forecolor', 'bold','removeformat', '|',  'image', 'link'],
					filterMode : true,
					htmlTags:{
						font : ['color', 'size', 'face', '.background-color'],
						span : ['.color',  '.font-size', '.background','.font-weight', '.text-decoration'],
						'div,p' : ['align', '.text-align'],
						table: ['border', 'cellspacing', 'cellpadding', 'align', '.border', 'bgcolor', '.text-align', '.color', '.font-size', '.font-family', '.font-weight', '.font-style', '.text-decoration'],
						'td,th': ['align', 'valign', 'width', 'height', 'colspan', 'rowspan', '.text-align', '.color', '.font-size', '.font-weight','.text-decoration', '.vertical-align'],
						a : ['href', 'target'],
						pre : [],
						'hr,br,tbody,tr,strong,b,sub,sup,em,i,u,strike' : []
					}
				});

			});
});