<?php
	echo frontend_breadcrumb('galary_bst',array('level >=' => 1,'lft <=' => $_bst['lft'], 'rgt >=' => $_bst['rgt']), 'bstdetail');
	if(isset($_children) && count($_children)){
		$str ='<ul>';
		foreach($_children as $key => $val){
			$str = $str.'<li><h3><a href="'.frontend_link_menu($val['route'], $val['alias'], $val['id'], '68').'" title="'.htmlspecialchars($val['title']).'">'.$val['title'].'</a></h3></li>';
		}
		$str = $str.'</ul>';
		echo $str;
	}
	
	
	
	
?>				
	<div id="page-bst-detail">
        <div class="container">

            <div id="slider">
                <ul class="bxslider2">
				<?php
					$temp = explode(',',$_bstdetail['image']); 
					$so = 0;
					//print_r($temp); die;
					foreach($temp as $key => $val){
						if(isset($val) && !empty($val)){
							echo '<li><img src="'.$val.'" /></li>';
						}
					}
				?>
                </ul>

                <div id="bx-pager">
				<?php
					$temp2 = explode(',',$_bstdetail['image']); 
					$so = 0;
					foreach($temp2 as $key => $val){
						if(isset($val) && !empty($val)){
							echo '<a data-slide-index="'.$so.'" href=""><img src="'.$val.'" /></a>';
							$so = $so + 1;
						}
					}
				?>
                </div>
            </div>

            <div id="content">
                <div class="col-sm-8 col-sm-offset-2 col-xs-12">
                    <div id="ct-top">
                        <div class="row">
                            <div class="col-sm-4 col-xs-12 text-left">
                                <strong>8.012</strong> luợt xem
                            </div>
                            <div class="col-sm-4 col-xs-12 text-center">
                                <strong>102</strong> luợt yêu thích
                            </div>
                            <div class="col-sm-4 col-xs-12 text-right">
                                <strong>602</strong> luợt bình luận
                            </div>
                        </div>
                    </div>
                    <div id="ct-middle">
                        <?php echo isset($_bstdetail['content'])?$_bstdetail['content']:''; ?>
                    </div>
                    <div id="ct-bottom">
                        <span>Cùng chia sẻ nào</span> <a href="" class="pull-right btn btn-danger">Yêu thích</a>
                    </div>
                </div>
            </div>

            <h2 class="title-bst-other">Bộ sưu tập khác</h2>

            <?php
				foreach($_relative as $key => $val){
					if(isset($val) && !empty($val)){
				?>
					<div class="col-sm-4 col-xs-12">
						<div class="content">
							<a href="">
								<img src="<?php echo $val['image_content']; ?>" />
							</a>

							<div class="bottom">
								<p><i class="fa fa-calendar-o"></i> <?php echo $val['created']; ?></p>
								<h5><a href=""><?php echo $val['title']; ?></a></h5>
								<div class="arrow"></div>
							</div>
							<div class="line green"></div>
						</div>
					</div>
				<?php
					}
				}
				
				
			?>
			
			 
        </div>
    </div>