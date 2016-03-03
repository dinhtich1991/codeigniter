<script>
        $(document).ready(function(){
            //config slider
            $('.bxslider').bxSlider({
                adaptiveHeight: false,
                mode: 'fade'
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
        });
    </script>
<?php
/*
	echo frontend_menu(array(
			'article_category' => frontend_menu_getdata('article_category'),
		));
*/
	// echo frontend_breadcrumb('article_category',array('level >=' => 1,'lft <=' => $_category['lft'], 'rgt >=' => $_category['rgt']), 'category');
	/*
	if(isset($_children) && count($_children)){
		$str ='<ul>';
		foreach($_children as $key => $val){
			$str = $str.'<li><h3><a href="'.frontend_link_menu($val['route'], $val['alias'], $val['id'], '68').'" title="'.htmlspecialchars($val['title']).'">'.$val['title'].'</a></h3></li>';
		}
		$str = $str.'</ul>';
		echo $str;
	}
	if(isset($_list) && count($_list)){
		$str ='<ol>';
		foreach($_list as $keyList => $valList){
			$str = $str.'<li><h2><a href="'.frontend_link_menu($valList['route'], $valList['alias'], $valList['id'], '88').'" title="'.htmlspecialchars($valList['title']).'">'.$valList['title'].'</a></h2></li>';
		}
		$str = $str.'</ol>';
		echo $str;
	}
	*/
	
	
?>
<div id="page-category">
    <div class="container">

        <div id="content">
            <div class="row">
                <div class="col-sm-3 col-xs-12">
                    <div class="menu">
                        <div class="border-top"></div>
                        <div class="border-bottom"></div>
                        <?php
							echo frontend_menu_left(array(
								'article_category' => frontend_menu_getdata('article_category'),
							));
						?>

                        <div class="choose-color">
                            <h6>Màu sắc</h6>
                            <ul>
                                <li class="active"><a class="color-black" href=""><i class="fa fa-check"></i></a></li>
                                <li class="active"><a class="color-green" href=""><i class="fa fa-check"></i></a></li>
                                <li class="active"><a class="color-gray" href=""><i class="fa fa-check"></i></a></li>
                                <li><a class="color-red" href=""><i class="fa fa-check"></i></a></li>
                                <li><a class="color-yellow" href=""><i class="fa fa-check"></i></a></li>
                                <li><a class="color-blue" href=""><i class="fa fa-check"></i></a></li>
                                <li><a class="color-white" href=""><i class="fa fa-check"></i></a></li>
                            </ul>
                        </div>

                        <div class="choose-size">
                            <h6>Cỡ</h6>
                            <ul>
                                <li><a href="">XS</a></li>
                                <li><a href="">S</a></li>
                                <li><a href="">M</a></li>
                                <li><a href="">L</a></li>
                                <li><a href="">XL</a></li>
                                <li><a href="">XXL</a></li>
                                <li><a href="">24</a></li>
                                <li><a href="">25</a></li>
                                <li><a href="">26</a></li>
                                <li><a href="">XS</a></li>
                                <li><a href="">S</a></li>
                                <li><a href="">M</a></li>
                                <li><a href="">L</a></li>
                                <li><a href="">XL</a></li>
                                <li><a href="">XXL</a></li>
                                <li><a href="">24</a></li>
                                <li><a href="">25</a></li>
                                <li><a href="">26</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-9 col-xs-12">
				<?php
					if(isset($_category) && !empty($_category)){
						
						?>
						<h3 class="title-page"><?php echo $_category['description']; ?></h3>

						<a href="" class="adv-top">
							<img src="<?php echo $_category['image']; ?>" />
						</a>
						<?php
					}
				?>
                    

                    <div id="filter">
                        <span>Sắp xếp theo: </span>

                        <ul>
                            <li class="active"><a href="">Mới nhất</a></li>
                            <li><a href="">Bán chạy nhất</a></li>
                            <li><a href="">Đang giảm giá</a></li>
                        </ul>

                        <div class="right">
                            <span>Hiển thị: </span>
                            <select name="">
                                <option>20</option>
                                <option>30</option>
                                <option>40</option>
                                <option>50</option>
                            </select>
                        </div>
                    </div>

                    <div id="list-pro">
						<div class="row">
						<?php
						if(isset($_list) && !empty($_list)){
							
							foreach($_list as $k => $v){
								$temp = explode(',',$v['image']);
								//print_r($temp); die;
								?>
									<div class="col-sm-3 col-xs-12">
										<div class="box">
										<?php
											if($v['total'] == 0){
												echo '<div class="alert">Hết hàng</div>';
											}
											else if($v['hot'] == 1){
												echo '<div class="alert-new"></div>';
											}
											else if($v['sale'] == 1){
												echo '<div class="alert-discount"></div>';
											}
										?>
											<div class="img">
												<a href="frontend/article/item/<?php echo $v['id']; ?>">
													<img src="<?php echo isset($temp)?$temp[0]:$v['image'];?>" />
												</a>
											</div>
											<div class="code">Mã: <?php echo $v['title']; ?></div>
											<div class="price"><span class="new"><?php echo $v['price']; ?></span><span class="old"><?php echo $v['price_sale']; ?></span></div>
											<ul class="colors">
												<li><a class="color-red" href=""><i class="fa fa-check"></i></a></li>
												<li><a class="color-yellow" href=""><i class="fa fa-check"></i></a></li>
												<li><a class="color-blue" href=""><i class="fa fa-check"></i></a></li>
												<li><a class="color-white" href=""><i class="fa fa-check"></i></a></li>
											</ul>
										</div>
									</div>
									<?php
								$temp = $v['image'];
							}
						}
						?>
						</div>
					</div>
                        <!--
                            <div class="col-sm-3 col-xs-12">
                                <div class="box">
                                    <div class="alert">Hết hàng</div>
                                    <div class="img">
                                        <a href="">
                                            <img src="public/template/frontend/images/img07.png" />
                                        </a>
                                    </div>
                                    <div class="code">Mã: GP140D</div>
                                    <div class="price"><span class="new">289k</span><span class="old">209k</span></div>
                                    <ul class="colors">
                                        <li><a class="color-red" href=""><i class="fa fa-check"></i></a></li>
                                        <li><a class="color-yellow" href=""><i class="fa fa-check"></i></a></li>
                                        <li><a class="color-blue" href=""><i class="fa fa-check"></i></a></li>
                                        <li><a class="color-white" href=""><i class="fa fa-check"></i></a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-sm-3 col-xs-12">
                                <div class="box">
                                    <div class="alert-discount"></div>
                                    <div class="img">
                                        <a href="">
                                            <img src="public/template/frontend/images/img08.png" />
                                        </a>
                                    </div>
                                    <div class="code">Mã: GP140D</div>
                                    <div class="price"><span class="new">289k</span><span class="old">209k</span></div>
                                    <ul class="colors">
                                        <li><a class="color-red" href=""><i class="fa fa-check"></i></a></li>
                                        <li><a class="color-yellow" href=""><i class="fa fa-check"></i></a></li>
                                        <li><a class="color-blue" href=""><i class="fa fa-check"></i></a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-sm-3 col-xs-12">
                                <div class="box">
                                    <div class="alert-new"></div>
                                    <div class="img">
                                        <a href="">
                                            <img src="public/template/frontend/images/img09.png" />
                                        </a>
                                    </div>
                                    <div class="code">Mã: GP140D</div>
                                    <div class="price"><span class="new">289k</span><span class="old">209k</span></div>
                                    <ul class="colors">
                                        <li><a class="color-red" href=""><i class="fa fa-check"></i></a></li>
                                        <li><a class="color-yellow" href=""><i class="fa fa-check"></i></a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-sm-3 col-xs-12">
                                <div class="box">
                                    <div class="img">
                                        <a href="">
                                            <img src="public/template/frontend/images/img10.png" />
                                        </a>
                                    </div>
                                    <div class="code">Mã: GP140D</div>
                                    <div class="price"><span class="new">289k</span><span class="old">209k</span></div>
                                    <ul class="colors">
                                        <li><a class="color-red" href=""><i class="fa fa-check"></i></a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-sm-3 col-xs-12">
                                <div class="box">
                                    <div class="img">
                                        <a href="">
                                            <img src="public/template/frontend/images/img07.png" />
                                        </a>
                                    </div>
                                    <div class="code">Mã: GP140D</div>
                                    <div class="price"><span class="new">289k</span><span class="old">209k</span></div>
                                </div>
                            </div>

                            <div class="col-sm-3 col-xs-12">
                                <div class="box">
                                    <div class="img">
                                        <a href="">
                                            <img src="public/template/frontend/images/img08.png" />
                                        </a>
                                    </div>
                                    <div class="code">Mã: GP140D</div>
                                    <div class="price"><span class="new">289k</span><span class="old">209k</span></div>
                                </div>
                            </div>

                            <div class="col-sm-3 col-xs-12">
                                <div class="box">
                                    <div class="img">
                                        <a href="">
                                            <img src="public/template/frontend/images/img09.png" />
                                        </a>
                                    </div>
                                    <div class="code">Mã: GP140D</div>
                                    <div class="price"><span class="new">289k</span><span class="old">209k</span></div>
                                </div>
                            </div>

                            <div class="col-sm-3 col-xs-12">
                                <div class="box">
                                    <div class="img">
                                        <a href="">
                                            <img src="public/template/frontend/images/img10.png" />
                                        </a>
                                    </div>
                                    <div class="code">Mã: GP140D</div>
                                    <div class="price"><span class="new">289k</span><span class="old">209k</span></div>
                                </div>
                            </div>
						-->
					
                    
                    <div class="paging">
                        <?php echo (isset($pagination) && !empty($pagination))?$pagination:''; ?>
                    </div>
                </div>
            </div>
        </div>

        <div id="more">
            <div class="row">

                <div class="col-sm-6 col-xs-12">
                    <ul id="list">
                        <li>
                            <h5>Huớng dẫn mua hàng</h5>

                            <div>
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's 1500s...
                            </div>
                        </li>
                        <li>
                            <h5>Chính sách bảo hành</h5>

                            <div>
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's 1500s...
                            </div>
                        </li>
                    </ul>

                    <div class="box">
                        <h5>Ưu đãi cho khách hàng mới</h5>

                        <form>
                            <label>
                                <input type="radio" name="sex" value="0" checked />Nam
                            </label>

                            <label>
                                <input type="radio" name="sex" value="0" />Nữ
                            </label>

                            <div id="panel-email">
                                <input type="email" placeholder="Xin nhập email của bạn..." />
                                <i class="fa fa-send"></i>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-sm-6 col-xs-12">
                    <a href="" id="adv">
                        <img src="public/template/frontend/images/img05.png" />
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>



