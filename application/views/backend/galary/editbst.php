		<section class="it-tabs">
			<h1>Sửa danh mục</h1>
			<ul>
				<li><a href="backend/article/category" title="Danh mục" >Danh mục</a></li>
				<li class="active"><a href="backend/article/addcategory" title="Thêm danh mục" >Thêm danh mục</a></li>
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
							<p class="label">Ảnh đại diện:</p>
							<input type="text" name="data[image]" value="<?php echo isset($_post['image'])?$_post['image']:''; ?>" class="txtText" id="txtImage" />
							<input type="button" value="Chọn ảnh" class="btnButton" onclick="browseKCFinder('txtImage','image'); return FALSE;" />
						</label>
						<label class="item">
							<p class="label">Danh mục cha:</p>
							<?php echo form_dropdown('data[parentid]', (isset($_show['parentid'])?$_show['parentid']:NULL),common_valuepost(isset($_post['parentid'])?$_post['parentid']:0), 'class="cbSelect"'); ?>
							
						</label>
						<label class="item">
							<p class="label">Nội dung:</p>
							<textarea name="data[description]" class="txtTextarea mceEditor"><?php echo isset($_post['description'])?$_post['description']:''; ?></textarea>
						</label>
						
						
						<section class="action">
								<p class="label">Thao tác:</p>
								<section class="group">
									<input type="submit" name="edit" value="Sửa đổi" />
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
					
					<section class="block">
						<header>SEO</header>
						<section class="container">
							<label class="item">
								<p class="label">Meta Title:</p>
								<input type="text" name = "data[meta_title]" value="<?php echo common_valuepost(isset($_post['meta_title'])?$_post['meta_title']:''); ?>" class="txtText" />
							</label>
							<label class="item">
								<p class="label">Meta Keyword:</p>
								<input type="text" name = "data[meta_keyword]" value="<?php echo common_valuepost(isset($_post['meta_keyword'])?$_post['meta_keyword']:''); ?>" class="txtText" />
							</label>
							<label class="item">
								<p class="label">Meta Description:</p>
								<input type="text" name = "data[meta_description]" value="<?php echo common_valuepost(isset($_post['meta_description'])?$_post['meta_description']:''); ?>" class="txtText" />
							</label>
						</section>	<!--end container-->							
					</section><!--end block-->
					<section class="block">
						<header>Khác</header>
						<section class="container">
							<label class="item">
								<p class="label">Url tùy biến:</p>
								<input type="text" name = "data[route]" value="<?php echo common_valuepost(isset($_post['route'])?$_post['route']:''); ?>" class="txtText" />
							</label>
						</section>	<!--end container-->							
					</section><!--end block-->
					
				</aside><!--end side-->
			</form>
		</section> <!--end form-->
		