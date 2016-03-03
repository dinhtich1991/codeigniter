		<section class="it-tabs">
			<h1>Thêm đối tác</h1>
			<ul>
				<li><a href="backend/partner/index" title="Đối tác">Đối tác</a></li>
				<li class="active"><a href="backend/partner/add" title="Thêm đối tác">Thêm đối tác</a></li>
			</ul>
		</section> <!--end tab-->
		
		<section class="it-form">
			<form method="post" action="">
				<section class="main-panel">
					<header>Thông tin chung</header>
					<?php echo common_showerror(validation_errors()); ?>
					<section class="block">
						<label class="item">
							<p class="label">Tiêu đề:</p>
							<input type="text" name="data[title]" value="<?php echo isset($_post['title'])?$_post['title']:''; ?>" class="txtText">
						</label>
						<label class="item">
							<p class="label">Url:</p>
							<input type="text" name="data[url]" value="<?php echo isset($_post['url'])?$_post['url']:''; ?>" class="txtText">
						</label>
						<label class="item">
							<p class="label">Ảnh đại diện:</p>
							<input type="text" name="data[image]" value="<?php echo isset($_post['image'])?$_post['image']:''; ?>" class="txtText" id="txtImage" />
							<input type="button" value="Chọn ảnh" class="btnButton" onclick="browseKCFinder('txtImage','image'); return FALSE;" />
						</label>
						
						<section class="action">
								<p class="label">Thao tác:</p>
								<section class="group">
									<input type="submit" name="add" value="Thêm mới" />
									<input type="reset" value="Làm lại" />
								</section>
						</section>
					</section><!--end block-->
					
				</section> <!--end main-->
				<aside class="side-panel">
					
					<section class="block">
						<header>Nâng cao</header>
						<section class="container">
							<section class="checkbox-radio">
								<p class="label">Hiển thị:</p>
								<section class="group">
									<label>
										<input type="radio" name="data[publish]" value="1" <?php echo isset($_post['publish'])?(($_post['publish'] == 1)?'checked ="checked"':''):''; ?> /><span>Có</span>
									</label>
									<label>
										<input type="radio" name="data[publish]" value="0" <?php echo isset($_post['publish'])?(($_post['publish'] == 0)?'checked ="checked"':''):''; ?> /><span>Không</span>
									</label>
								</section>
							</section>
						</section>	<!--end container-->							
					</section><!--end block-->
				
					
				</aside><!--end side-->
			</form>
		</section> <!--end form-->
		