		<section class="it-tabs">
			<h1>Thêm menu</h1>
			<ul>
				<li><a href="backend/submenu/index" title="Menu">Menu</a></li>
				<li class="active"><a href="backend/submenu/add" title="Thêm menu">Thêm menu</a></li>
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
							<p class="label">Module:</p>
							<input type="text" name="data[module]" value="<?php echo isset($_post['module'])?$_post['module']:''; ?>" class="txtText">
						</label>
						<label class="item">
							<p class="label">Module ID:</p>
							<input type="text" name="data[module_id]" value="<?php echo isset($_post['module_id'])?$_post['module_id']:''; ?>" class="txtText">
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
		