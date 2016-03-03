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
		<link href="public/template/frontend/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="public/template/frontend/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		<link href="public/template/frontend/css/jquery.bxslider.css" rel="stylesheet" type="text/css" />
		<link href="public/template/frontend/css/reset.css" rel="stylesheet" type="text/css" />
		<link href="public/template/frontend/css/main.css" rel="stylesheet" type="text/css" />
		<link href="public/template/frontend/css/style.css" rel="stylesheet" type="text/css" />
		<!-- JS FILE -->
		<script type="text/javascript" src="public/template/frontend/js/jquery-1.10.2.min.js"></script>
		<script type="text/javascript" src="public/template/frontend/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="public/template/frontend/js/jquery.bxslider.js"></script>
		<script type="text/javascript" src="public/template/frontend/js/myfunction.js"></script>
		<script>
        $(document).ready(function(){
            //config slider
            $('.bxslider').bxSlider({
                adaptiveHeight: false,
                mode: 'fade'
            });
			
			//config slider 2
			$('.bxslider2').bxSlider({
                pagerCustom: '#bx-pager'
            });
			
			//menu category
            $(".menu > ul > li > a").click(function(){
                var is_hidden = $(this).next().is(":hidden");
                if(is_hidden){
                    $(this).next().slideDown();

                    $(this).find('i').addClass("fa-caret-up");
                    $(this).find('i').removeClass("fa-caret-down");
                }else{
                    $(this).next().slideUp();

                    $(this).find('i').removeClass("fa-caret-up");
                    $(this).find('i').addClass("fa-caret-down");
                }
            });
			
			
			$(".stores > ul > li > div").click(function(){
               var is_hidden = $(this).next().is(":hidden");
                if(is_hidden){
                    $(this).next().slideDown();
                }else{
                    $(this).next().slideUp();
                }
            });
            var $obj1 = $("#page-stores .list");
            var $obj2 = $("#page-stores .view");
            var $obj3 = $("#page-stores .stores");
            var h1 = $obj1.height();
            var h2 = $obj2.height();
            var h3 = $obj3.height();
            var h = h1 > h2 ? h1 : h2;
            h = h > h3 ? h : h3;
            h += 50;
            $obj1.css('height', h);
            $obj2.css('height', h);
            $obj3.css('height', h);

            //panel view
            $(document).on("click", ".stores > ul > li > ul > li", function(){
                var $view = $("#view");
                $view.removeClass("hidden");

                $('.slider1').bxSlider({
                    slideWidth: 120,
                    minSlides: 2,
                    maxSlides: 3,
                    slideMargin: 24
                });
            });
			
        });
		
		
		</script>
	
		<script>
		  // This is called with the results from from FB.getLoginStatus().
		  function statusChangeCallback(response) {

			// The response object is returned with a status field that lets the
			// app know the current login status of the person.
			// Full docs on the response object can be found in the documentation
			// for FB.getLoginStatus().
			if (response.status === 'connected') {
			  // Logged into your app and Facebook.
			  //testAPI();
			  var dataFB ='';
			  FB.api('/me', { locale: 'en_US', fields: 'id, name, email' },
				  function(response) {
					dataFB= response;
					window.location.assign("frontend/user/loginfb?id="+dataFB.id+"&name="+dataFB.name+"&email="+dataFB.email);
				  }
			);
			
			//window.location.assign("frontend/user/loginfb?id="+dataFB.id+"&name="+dataFB.name+"&email="+dataFB.email);
			
			} else if (response.status === 'not_authorized') {
			  // The person is logged into Facebook, but not your app.
			  document.getElementById('status').innerHTML = 'Please log ' +
				'into this app.';
			} else {
			  // The person is not logged into Facebook, so we're not sure if
			  // they are logged into this app or not.
			  document.getElementById('status').innerHTML = 'Please log ' +
				'into Facebook.';
			}
		  }

		  // This function is called when someone finishes with the Login
		  // Button.  See the onlogin handler attached to it in the sample
		  // code below.
		  function checkLoginState() {
			FB.getLoginStatus(function(response) {
			  statusChangeCallback(response);
			});
		  }

		  window.fbAsyncInit = function() {
		  FB.init({
			appId      : '1472949049699676',
			cookie     : true,  // enable cookies to allow the server to access 
								// the session
			xfbml      : true,  // parse social plugins on this page
			version    : 'v2.2', // use version 2.2
			status: true
		  });

		  // Now that we've initialized the JavaScript SDK, we call 
		  // FB.getLoginStatus().  This function gets the state of the
		  // person visiting this page and can return one of three states to
		  // the callback you provide.  They can be:
		  //
		  // 1. Logged into your app ('connected')
		  // 2. Logged into Facebook, but not your app ('not_authorized')
		  // 3. Not logged into Facebook and can't tell if they are logged into
		  //    your app or not.
		  //
		  // These three cases are handled in the callback function.



		  };

		  // Load the SDK asynchronously
		  (function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_US/sdk.js";
			fjs.parentNode.insertBefore(js, fjs);
		  }(document, 'script', 'facebook-jssdk'));

		  // Here we run a very simple test of the Graph API after login is
		  // successful.  See statusChangeCallback() for when this call is made.
		  function testAPI() {
			console.log('Welcome!  Fetching your information.... ');
			FB.api('/me', function(response) {
			  console.log('Successful login for: ' + response.name);
			  document.getElementById('status').innerHTML =
				'Thanks for logging in, ' + response.name + '!';
			});
		  }

		</script>
	</head>
	
	<body>
		
	<?php
		//echo isset($login_url)?$login_url:$login_url;
		$_lang = $this->session->userdata('_lang');
		$lang = array('jp' => 'Tiếng Nhật','vi' => 'Tiếng Việt','en' => 'Tiếng Anh',);
		include_once 'header.php';
	
		 if(isset($template)){
			$this->load->view($template,isset($data)?$data:NULL);
		}
		
		include_once 'footer.php';
		
	?>
		
	<body>
</html>