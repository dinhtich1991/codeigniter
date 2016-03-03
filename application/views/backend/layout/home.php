<!DOCTYPE html>
<html>
	<head>
		
		<base href="<?php echo BASE_URL; ?>"/>
		<title><?php echo isset($seo['title'])?$seo['title']:''; ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="<?php echo isset($seo['keywords'])?htmlspecialchars($seo['keywords']):''; ?>" />
		<meta name="description" content="<?php echo isset($seo['description'])?htmlspecialchars($seo['description']):''; ?>" />
		<link href="public/template/backend/css/style.css" rel="stylesheet" />
		<link href="public/template/backend/plugins/datetimepicker/jquery.datetimepicker.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="public/template/backend/js/1.7.2.jquery.min.js"></script>
	
	</head>
	<body>
	
		
		<header class="it-header">
			<p class="main-title"> Hệ thống quản trị website</p>	
			<ul class="lang">
			<?php
				$_lang = $this->session->userdata('_lang');
				$lang = array(
					'jp' => 'Tiếng Nhật',
					'vi' => 'Tiếng Việt',
					'en' => 'Tiếng Anh',
				);
				foreach($lang as $key => $val){
					if($_lang == $key){
						echo '<li><a href="backend/home/lang/'.$key.'?continue='.base64_encode(common_fullurl()).'" title="'.$val.'">['.$key.']</a></li>';
					}
					else{
						echo '<li><a href="backend/home/lang/'.$key.'?continue='.base64_encode(common_fullurl()).'" title="'.$val.'">'.$key.'</a></li>';	
					}
				}
			?>
			</ul>
		</header>
		<?php $this->load->view('backend/common/nav'); ?>
					
	<?php
         if(isset($template)){
            $this->load->view($template,isset($data)?$data:NULL);
        }
		
	?>
	<?php $this->load->view('backend/common/footer'); ?>
	
	<script type="text/javascript" src="public/template/backend/plugins/datetimepicker/jquery.datetimepicker.js"></script>
	<script type="text/javascript" src="public/template/backend/js/function.js"></script>
	
	<?php $this->load->view('backend/common/tinymce'); ?>
	
	<body>
</html>
