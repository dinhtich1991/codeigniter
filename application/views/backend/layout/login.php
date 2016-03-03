<!DOCTYPE html>
<html>
    <head>
    
        <base href="<?php echo BASE_URL; ?>"/>
        <link href="public/template/backend/css/style_login.css" rel="stylesheet" />
        <title><?php echo isset($seo['title'])?$seo['title']:''; ?></title>
    
    </head>


<body>
    <header>
    
    </header>
    <div class="container-fluid">
    <?php
         if(isset($template)){
            $this->load->view($template,isset($data)?$data:NULL);
        }
		
    ?>
    </div>
    <footer>
        <section class="dt_wrapper">
            <p>Copyright &copy; 2014 - powered by TaDinhTich</p>
        </section>
    </footer>
    


</body>
</html>