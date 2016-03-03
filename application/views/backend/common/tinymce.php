	<script type="text/javascript" src="public/template/backend/plugins/tinymce_3.5.11/jscripts/tiny_mce/tiny_mce.js"></script>
	<script type="text/javascript">
		tinyMCE.init({
			// General options
			mode : "textareas",
			editor_selector : "mceEditor",
			theme : "advanced",
			plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,visualblocks",

			file_browser_callback:"openKCFinder",
				
			// Theme options
			theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,fontsizeselect",
			theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor",
			theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
			theme_advanced_statusbar_location : "bottom",
			theme_advanced_resizing : true,

			// Example content CSS (should be your site CSS)
			content_css : "css/content.css",

			// Drop lists for link/image/media/template dialogs
			template_external_list_url : "lists/template_list.js",
			external_link_list_url : "lists/link_list.js",
			external_image_list_url : "lists/image_list.js",
			media_external_list_url : "lists/media_list.js",

			// Style formats
			style_formats : [
				{title : 'Bold text', inline : 'b'},
				{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
				{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
				{title : 'Example 1', inline : 'span', classes : 'example1'},
				{title : 'Example 2', inline : 'span', classes : 'example2'},
				{title : 'Table styles'},
				{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
			],

			// Replace values for the template plugin
			template_replace_values : {
				username : "Some User",
				staffid : "991234"
			}
		});
		/*
		function openKCFinder(field_name, url, type, win){
			tinyMCE.activeEditor.windowManager.open({
				file: 'template/backend/plugins/kcfinder_2.52/browse.php?opener=tinymce&lang=vi&type=' + type,
				title: 'KCFinder',
				width: 700,
				height: 500,
				resizable: "yes",
				inline: true,
				close_previous: "no",
				popup_css: false
			}, {
				window: win,
				input: field_name
			});
			return false;
		}
		*/
		function openKCFinder(c,a,b,d){
		tinyMCE.activeEditor.windowManager.open({
			file:"public/template/backend/plugins/kcfinder-2.52/browse.php?opener=tinymce&lang=vi&type="+b,
			title:"KCFinder",
			width:700,
			height:500,
			resizable:true,
			inline:true,
			close_previous:false,
			popup_css:false
			},{
				window:d,
				input:c
			})
			return false
		};
		
		function browseKCFinder(field, type){
			window.KCFinder = {
				//callBack: function(url) {
				//	document.getElementById(field).value = url;
				//	window.KCFinder = null;
				//}
				callBackMultiple: function(url) {
					window.KCFinder = null;
					var temp = document.getElementById(field);
					temp.value = url;
					//alert(temp.value);
					//for (var i = 0; i < url.length; i++)
					//	temp.value += url[i];
				}
			};
			window.open('public/template/backend/plugins/kcfinder-2.52/browse.php?type='+type+'&lang=vi', 'kcfinder_multiple',
						'status = 0, toolbar=0, location=0, menubar=0, directories=0,' + 
						'resizable=1, scrollbars=0, width=800, height=600'
			
			);
			
		}
		
		
	</script>


