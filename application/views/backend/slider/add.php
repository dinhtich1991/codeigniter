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
							<p class="label">Tiêu đề slider:</p>
							<input type="text" name="data[title]" value="<?php echo isset($_post['title'])?$_post['title']:''; ?>" class="txtText" id="txtText" />
						</label>
						<label class="item">
							<p class="label">Ảnh 1:</p>
							<input type="text" name="data[image1]" value="<?php echo isset($_post['image1'])?$_post['image1']:''; ?>" class="txtText" id="txtImage1" />
							<input type="button" value="Chọn ảnh" class="btnButton" onclick="browseKCFinder('txtImage1','image'); return FALSE;" />
						</label>
						<label class="item">
							<p class="label">Ảnh 2:</p>
							<input type="text" name="data[image2]" value="<?php echo isset($_post['image2'])?$_post['image2']:''; ?>" class="txtText" id="txtImage2" />
							<input type="button" value="Chọn ảnh" class="btnButton" onclick="browseKCFinder('txtImage2','image'); return FALSE;" />
						</label>
						<label class="item">
							<p class="label">Ảnh 3:</p>
							<input type="text" name="data[image3]" value="<?php echo isset($_post['image3'])?$_post['image3']:''; ?>" class="txtText" id="txtImage3" />
							<input type="button" value="Chọn ảnh" class="btnButton" onclick="browseKCFinder('txtImage3','image'); return FALSE;" />
						</label>
						<label class="item">
							<p class="label">Ảnh 4:</p>
							<input type="text" name="data[image4]" value="<?php echo isset($_post['image4'])?$_post['image4']:''; ?>" class="txtText" id="txtImage4" />
							<input type="button" value="Chọn ảnh" class="btnButton" onclick="browseKCFinder('txtImage4','image'); return FALSE;" />
						</label>
						<label class="item">
							<p class="label">Ảnh 5:</p>
							<input type="text" name="data[image5]" value="<?php echo isset($_post['image5'])?$_post['image5']:''; ?>" class="txtText" id="txtImage5" />
							<input type="button" value="Chọn ảnh" class="btnButton" onclick="browseKCFinder('txtImage5','image'); return FALSE;" />
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
		