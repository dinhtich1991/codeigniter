
<div id="page-payment">
	<div class="container">
		<h1>THÔNG TIN VÀ THANH TOÁN</h1>
		<div class="main-content">
			<div class="box step1">
			<form action="frontend/cart/update" method="post">
				<h3>ĐƠN HÀNG<span></span></h3>
				<ul id="pro">
				<?php
				$temp = $this->cart->contents();
				if(isset($temp) && !empty($temp)){
					$i = 1;
					$total = 0;
					foreach($temp as $cart){
						echo form_hidden('cart[' . $cart['id'] . '][rowid]', $cart['rowid']);
						?>
						<li>
							<a href="">
								<img src="images/img02.png" />
							</a>

							<div class="right">
								<p><?php echo $cart['name'] ?></p>
								<p>
									<?php foreach ($this->cart->product_options($cart['rowid']) as $option_name => $option_value): ?>
										<strong><?php echo $option_name; ?>:</strong> <?php echo $option_value; ?><br />
									<?php endforeach; ?>
									Số lượng: <input type="text" name="cart[<?php echo $cart['id']; ?>][qty]" value="<?php echo $cart['qty'] ?>" size="3" />
								</p>
								<p>Giá: <?php echo $cart['price'] ?>đ</p>
							</div>

							<a href="frontend/cart/delete_item/<?php echo $cart['rowid']; ?>" class="delete">
								<i class="fa fa-times"></i>
							</a>
						</li>
						
						<?php 
						$total += $cart['subtotal'];
					}
					
				}
				else{
					echo '<p>Giỏ hàng trống!</p>';
				}
				?>
				</ul>
				<div class="center" style="text-align:center;">
					<button class="btn btn-primary" onclick="update_cart();">Cập nhật giỏ hảng</button>
				</div>
			</form>
			</div>
			<div class="box step2">
				<h3>
					ĐỊA CHỈ GIAO HÀNG<span></span>
					<a href=""><i class="fa fa-plus"></i>Sửa địa chỉ</a>
				</h3>
				<ul id="form">
					<li>
						<div class="row">
							<label class="col-sm-4 col-xs-12">Họ tên: </label>
							<strong class="col-sm-8 col-xs-12">Nguyễn Nam Anh</strong>
						</div>
					</li>
					<li>
						<div class="row">
							<label class="col-sm-4 col-xs-12">Điện thoại: </label>
							<strong class="col-sm-8 col-xs-12">097 888 8888</strong>
						</div>
					</li>
					<li>
						<div class="row">
							<label class="col-sm-4 col-xs-12">Thành phố:: </label>
							<strong class="col-sm-8 col-xs-12">Hà Nội</strong>
						</div>
					</li>
					<li>
						<div class="row">
							<label class="col-sm-4 col-xs-12">Quận: </label>
							<strong class="col-sm-8 col-xs-12">Cầu Giấy</strong>
						</div>
					</li>
					<li>
						<div class="row">
							<label class="col-sm-4 col-xs-12">Địa chỉ: </label>
							<strong class="col-sm-8 col-xs-12">Số 5, ngõ 81/ 85 Lạc Long Quân</strong>
						</div>
					</li>
					<li>
						<div class="row">
							<label class="col-sm-4 col-xs-12">Lưu ý khi chuyển hàng tới địa chỉ này:: </label>
							<div class="col-sm-8 col-xs-12">
								<textarea></textarea>
							</div>
						</div>
					</li>
				</ul>
			</div>
			<div class="box step3">
				<h3>
					THANH TOÁN VÀ VẬN CHUYỂN<span></span>
				</h3>
				<div class="box-sm">
					<h5>Chọn hình thức giao hàng:</h5>
					<ul>
						<li>
							<label>
								<input name="test" type="radio">Giao hàng tận nơi tới địa chỉ giao hàng
							</label>
						</li>
						<li>
							<label>
								<input name="test" type="radio">Trực tiếp tới cửa hàng lấy hàng
							</label>
						</li>
					</ul>
				</div>
				<div class="box-sm border-top">
					<h5>NHẬP MÃ GIẢM GIÁ:</h5>
					<div class="form-group">
						<input type="text" class="form-control">
					</div>
					<div class="form-group">
						<a href="" class="btn btn-info pull-right">Kiểm tra mã</a>
					</div>
				</div>
			</div>
		</div>
		<div class="bottom">
			<a href="">Tiếp tục mua hàng</a>

			<div class="box-r">
				<ul>
					<li>
						<div class="row">
							<div class="col-sm-6 label">Giá trị đơn hàng</div>
							<div class="col-sm-6 text price"><?php echo isset($total)?$this->cart->format_number($total):'0'; ?><sup>đ</sup></div>
						</div>
					</li>
					<li>
						<div class="row">
							<div class="col-sm-6 label">Phí vận chuyển: </div>
							<div class="col-sm-6 text">Miễn phí</div>
						</div>
					</li>
					<li>
						<div class="row">
							<div class="col-sm-6 label">Giá trị đơn hàng</div>
							<div class="col-sm-6 text">Miễn phí</div>
						</div>
					</li>
				</ul>
				<a href="" class="btn btn-default pull-right">TIẾP THEO</a>
			</div>
		</div>
		<?php 
			$new= new NL_Checkout();
			$url =$new->buildCheckoutUrlExpand('http://demo-ci.bugs3.com/frontend/cart','dinhtich91@gmail.com','','san pham 1','500000','vnd',1,0,0,0,0,'da mua san pham 1 cua chung toi','Ta Dinh Tich','');
		?>
			<a href="<?php echo $url; ?>">Thanh toán Ngân Lượng</a>
		
	</div>
</div>
