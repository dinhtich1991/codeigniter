<script>
	$(document).ready(function(){
		//config slider
		$('.slider8').bxSlider({
			mode: 'vertical',
			slideWidth: 70,
			minSlides: 4,
			slideMargin: 3
		});

		$(document).on('click', '.slide > img', function(){
			var imgUrl = $(this).data('url');
			var $img = $("#img-view");
			$img.attr('src', imgUrl);
		});
	});
</script>

<div id="page-item-detail">
	<div class="container">
		<div id="content">

			<?php
				echo frontend_breadcrumb('article_category',array('level >=' => 1,'lft <=' => $_category['lft'], 'rgt >=' => $_category['rgt']), 'item');
				if(isset($_children) && count($_children)){
					$str ='<ul>';
					foreach($_children as $key => $val){
						$str = $str.'<li><h3><a href="'.frontend_link_menu($val['route'], $val['alias'], $val['id'], '68').'" title="'.htmlspecialchars($val['title']).'">'.$val['title'].'</a></h3></li>';
					}
					$str = $str.'</ul>';
					echo $str;
				}
				
				//echo (isset($pagination) && !empty($pagination))?$pagination:'';
				//print_r($_item); 
				
			?>
			<div id="info-product">
			<div class="col-sm-8 col-xs-12">
					<div class="col-sm-7 col-xs-12">
						<div id="slider">
							<div id="left">
								<div class="slider8">
									<div class="slide"><img data-url="public/template/frontend/images/item-detail/1.png" src="public/template/frontend/images/item-detail/1.png"></div>
									<div class="slide"><img data-url="public/template/frontend/images/item-detail/2.png" src="public/template/frontend/images/item-detail/2.png"></div>
									<div class="slide"><img data-url="public/template/frontend/images/item-detail/3.png" src="public/template/frontend/images/item-detail/3.png"></div>
									<div class="slide"><img data-url="public/template/frontend/images/item-detail/4.png" src="public/template/frontend/images/item-detail/4.png"></div>
								</div>
							</div>
							<div id="right">
								<img id="img-view" src="public/template/frontend/images/item-detail/img-large.png" />
							</div>
						</div>
					</div>
					<div class="col-sm-5 col-xs-12">
						<div id="info-right">
							<?php echo $_item['content']; ?>
							
							<div class="tip">
								<?php echo $_item['description']; ?>
							</div>

							<div class="tip-bt">
								<div class="arrow"></div>
								<div class="text">
									<p>Bạn chưa rõ mua hàng hãy <a href="" class="link">vào đây</a></p>
								</div>
								<div class="text">
									<p>Hay bạn muốn được tư vấn?</p>
									<p>Hay bạn muốn được tư vấn?</p>
								</div>
								<div class="text">
									<p>Thời gian làm việc:</p>
									<p>Thứ 2 - CN: 8 giờ sáng đến 9 giờ tối</p>
									<p>Ngày lễ: 9 giờ sáng đến 6 giờ tối</p>
								</div>

							</div>
						</div>
					</div>
				</div>

				<div class="col-sm-4 col-xs-12">
					<div class="box-sidebar">
					<form method="post" action="frontend/cart/index/">
						<div class="panel-price">
							Giá: <strong><?php echo $_item['price']; ?><span>K</span></strong>
						</div>
						<input type="hidden" name="data[price]" value="<?php echo $_item['price']; ?>" />
						<input type="hidden" name="data[id]" value="<?php echo $_item['id']; ?>" />
						<input type="hidden" name="data[name]" value="<?php echo $_item['title']; ?>" />
						<div class="panel-body">
							<label>Số lương: </label>
							<div class="group-button">
								<input name="data[qty]" class="form-control" type="text" value="1" />
								<button class="btn btn-info">-</button>
								<button class="btn btn-info">+</button>
							</div>

							<?php 
								$stt = 0;
								foreach($attribute as $key => $val){
									?>
									<label class="item">
										<p class="label"><?php echo $val['name'] ?></p>
										<?php echo form_dropdown('data[thuoctinh'.$stt.']', get_attribute_item($val['id']),common_valuepost(isset($_post['parentid'])?$_post['parentid']:0), 'class="cbSelect"'); ?>
									</label>
									<br />
									<?php
									$stt ++;
								}
							?>
						</div>
						<div class="panel-footer">
							<input type="submit" class="btn btn-default" value="ĐẶT MUA NGAY" name="cart" />
							<a href="" class="btn btn-info">Đánh dấu yêu thích</a>
						</div>
					</form>
					</div>
					<p id="alert">Đẹp thế này sao không cùng chia sẻ?</p>
					<ul id="share">
						<li>
							<a href=""><i class="fa fa-facebook"></i></a>
						</li>
						<li>
							<a href=""><i class="fa fa-twitter"></i></a>
						</li>
						<li>
							<a href=""><i class="fa fa-google"></i></a>
						</li>
						<li>
							<a href=""><i class="fa fa-envelope-o"></i></a>
						</li>
					</ul>
				</div>
				
			</div>

			<div id="list-pro">
				<h3><span>CÓ THỂ BẠN SẼ THÍCH</span><div></div></h3>

				<div class="row">
					<div class="col-sm-2 col-xs-12">
						<div class="box">
							<div class="img">
								<a href="">
									<img src="public/template/frontend/images/item-detail/img-01.png" />
								</a>
							</div>
							<div class="code">Mã: GP140D</div>
							<div class="price"><span class="new">289.000<sup>đ</sup></span></div>
						</div>
					</div>

					<div class="col-sm-2 col-xs-12">
						<div class="box">
							<div class="img">
								<a href="">
									<img src="public/template/frontend/images/item-detail/img-01.png" />
								</a>
							</div>
							<div class="code">Mã: GP140D</div>
							<div class="price"><span class="new">289.000<sup>đ</sup></span></div>
						</div>
					</div>

					<div class="col-sm-2 col-xs-12">
						<div class="box">
							<div class="img">
								<a href="">
									<img src="public/template/frontend/images/item-detail/img-01.png" />
								</a>
							</div>
							<div class="code">Mã: GP140D</div>
							<div class="price"><span class="new">289.000<sup>đ</sup></span></div>
						</div>
					</div>

					<div class="col-sm-2 col-xs-12">
						<div class="box">
							<div class="img">
								<a href="">
									<img src="public/template/frontend/images/item-detail/img-01.png" />
								</a>
							</div>
							<div class="code">Mã: GP140D</div>
							<div class="price"><span class="new">289.000<sup>đ</sup></span></div>
						</div>
					</div>

					<div class="col-sm-2 col-xs-12">
						<div class="box">
							<div class="img">
								<a href="">
									<img src="public/template/frontend/images/item-detail/img-01.png" />
								</a>
							</div>
							<div class="code">Mã: GP140D</div>
							<div class="price"><span class="new">289.000<sup>đ</sup></span></div>
						</div>
					</div>

					<div class="col-sm-2 col-xs-12">
						<div class="box">
							<div class="img">
								<a href="">
									<img src="public/template/frontend/images/item-detail/img-01.png" />
								</a>
							</div>
							<div class="code">Mã: GP140D</div>
							<div class="price"><span class="new">289.000<sup>đ</sup></span></div>
						</div>
					</div>
				</div>

				<h3><span>SẢN PHẨM ĐÃ XEM</span><div></div></h3>

				<div class="row">
					<div class="col-sm-2 col-xs-12">
						<div class="box">
							<div class="img">
								<a href="">
									<img src="public/template/frontend/images/item-detail/img-01.png" />
								</a>
							</div>
							<div class="code">Mã: GP140D</div>
							<div class="price"><span class="new">289.000<sup>đ</sup></span></div>
						</div>
					</div>

					<div class="col-sm-2 col-xs-12">
						<div class="box">
							<div class="img">
								<a href="">
									<img src="public/template/frontend/images/item-detail/img-01.png" />
								</a>
							</div>
							<div class="code">Mã: GP140D</div>
							<div class="price"><span class="new">289.000<sup>đ</sup></span></div>
						</div>
					</div>

					<div class="col-sm-2 col-xs-12">
						<div class="box">
							<div class="img">
								<a href="">
									<img src="public/template/frontend/images/item-detail/img-01.png" />
								</a>
							</div>
							<div class="code">Mã: GP140D</div>
							<div class="price"><span class="new">289.000<sup>đ</sup></span></div>
						</div>
					</div>

					<div class="col-sm-2 col-xs-12">
						<div class="box">
							<div class="img">
								<a href="">
									<img src="public/template/frontend/images/item-detail/img-01.png" />
								</a>
							</div>
							<div class="code">Mã: GP140D</div>
							<div class="price"><span class="new">289.000<sup>đ</sup></span></div>
						</div>
					</div>

					<div class="col-sm-2 col-xs-12">
						<div class="box">
							<div class="img">
								<a href="">
									<img src="public/template/frontend/images/item-detail/img-01.png" />
								</a>
							</div>
							<div class="code">Mã: GP140D</div>
							<div class="price"><span class="new">289.000<sup>đ</sup></span></div>
						</div>
					</div>

					<div class="col-sm-2 col-xs-12">
						<div class="box">
							<div class="img">
								<a href="">
									<img src="public/template/frontend/images/item-detail/img-01.png" />
								</a>
							</div>
							<div class="code">Mã: GP140D</div>
							<div class="price"><span class="new">289.000<sup>đ</sup></span></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

