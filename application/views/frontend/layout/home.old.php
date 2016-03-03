<!DOCTYPE html>
<html>
	<head>
		
		<base href="<?php echo BASE_URL; ?>"/>
		<title><?php echo isset($seo['title'])?$seo['title']:''; ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="<?php echo isset($seo['keywords'])?htmlspecialchars($seo['keywords']):''; ?>" />
		<meta name="description" content="<?php echo isset($seo['description'])?htmlspecialchars($seo['description']):''; ?>" />
		
		<?php echo isset($seo['canonical'])?'<link ref="canonical" href="'.$seo['canonical'].'" />'."\n":''; ?>
		<?php echo (isset($seo['rel_prev']) && !empty($seo['rel_prev']))?'<link ref="prev" href="'.$seo['rel_prev'].'" />'."\n":''; ?>
		<?php echo (isset($seo['rel_next']) && !empty($seo['rel_next']))?'<link ref="next" href="'.$seo['rel_next'].'" />'."\n":''; ?>
		<?php echo (isset($data['_author']['google_author']) && !empty($data['_author']['google_author']))?'<link ref="author" href="'.$data['_author']['google_author'].'" />'."\n":((isset($this->_config['google_authorship']) && !empty($this->_config['google_authorship']))?'<link ref="authorship" href="'.$this->_config['google_authorship'].'" />'."\n":''); ?>
		<?php echo ((isset($this->_config['google_publisher']) && !empty($this->_config['google_publisher']))?'<link ref="publisher" href="'.$this->_config['google_publisher'].'" />'."\n":''); ?>
		<!-- CSS FILE -->
		<link href="public/template/frontend/css/reset.css" rel="stylesheet" type="text/css" />
		<link href="public/template/frontend/css/style.css" rel="stylesheet" type="text/css" />
		<link href="public/template/frontend/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="public/template/frontend/css/jquery.bxslider.css" rel="stylesheet" type="text/css" />
		<!-- JS FILE -->
		<script type="text/javascript" src="public/template/frontend/js/jquery-1.10.2.min.js"></script>
		<script type="text/javascript" src="public/template/frontend/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="public/template/frontend/js/jquery.bxslider.js"></script>
	</head>
	<body>
		<?php 
			echo $this->lang->line('ft_hello').'<br />';
			$_lang = $this->session->userdata('_lang');
			echo 'Ngôn ngữ hiện tại là:'.$_lang;
			
		?>
			<ul class="lang">
				<?php
					$_lang = $this->session->userdata('_lang');
					$lang = array(
						'jp' => 'Tiếng Nhật',
						'vi' => 'Tiếng Việt',
						'en' => 'Tiếng Anh',
					);
					foreach($lang as $key => $val){
						echo '<li><a href="'.(($key != 'vi')?$key.TT_URL_SUFFIX:'').'" title="'.$val.'">'.$val.'</a></li>';
					}
				?>
			</ul>
		<?php 
			echo frontend_menu(array(
				'article_category' => frontend_menu_getdata('article_category'),
			));
		?>	
					
		<?php
			 if(isset($template)){
				$this->load->view($template,isset($data)?$data:NULL);
			}
			
		?>
		<footer>
			<section class="dt_wrapper">
				<p>Copyright &copy; <?php echo gmdate('Y',time()+7*3600); ?> - powered by TaDinhTich</p>
			</section>
		</footer>
	<body>
</html>