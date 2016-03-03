		<?php 
			$_lang = $this->session->userdata('_lang');
		?>
		<section class="it-tabs">
			<h1>Cấu hình hệ thống</h1>
			
			<?php
				$_arr = array(
					'contact' =>'Liên hệ',
					'ftp' =>'FTP',
					'seo' =>'SEO',
					'frontend' =>'Trang chủ',
				);
				echo '<ul>';
				foreach($_arr as $key => $val){
					echo '<li '.(($_group == $key)?'class="active"':'').'><a href="backend/config/index/'.$key.'" title="Cấu hình '.$val.'">'.$val.'</a></li>';
				}
				echo '</ul>'; 
			?>
			
			
		</section> <!--end tab-->
		
		<section class="it-form">
			<form method="post" action=""> 
				<section class="main-panel main-panel-single">
					<header>Thông tin chung</header>
					<section class="block">
						<?php
							if(isset($_config) && count($_config)){
								foreach($_config as $key => $val){
									if($val['type'] =='text'){
										?>
											<label class="item">
												<p class="label"><?php echo $val['label']?>:</p>
												<input type="text" name="data[<?php echo $val['keyword']?>]" value="<?php echo isset($_post[$val['keyword']])?$_post[$val['keyword']]:$val['value_'.$_lang]; ?>" class="txtText" >
											</label>
										<?php
									}
									else if($val['type'] =='textarea'){
										?>
											<label class="item">
												<p class="label"><?php echo $val['label']?>:</p>
												<textarea type="text" name="data[<?php echo $val['keyword']?>]" class="txtTextarea"><?php echo isset($_post[$val['keyword']])?$_post[$val['keyword']]:$val['value_'.$_lang]; ?> </textarea>
											</label>
										<?php
									}
									else if($val['type'] =='editor'){
										?>
											<label class="item">
												<p class="label"><?php echo $val['label']?>:</p>
												<textarea type="text" name="data[<?php echo $val['keyword']?>]" class="txtTextarea mceEditor"><?php echo isset($_post[$val['keyword']])?$_post[$val['keyword']]:$val['value_'.$_lang]; ?> </textarea>
											</label>
										<?php
									}
									else if($val['type'] =='radio'){
										?>
											<section class="checkbox-radio">
												<p class="label"><?php echo $val['label']?>:</p>
												<section class="group">
													<label>
														<input type="radio" name="data[<?php echo $val['keyword']?>]" value="1" <?php echo (($val['value_'.$_lang] ==1)?'checked="checked"':'') ?>  /><span>Có</span>
													</label>
													<label>
														<input type="radio" name="data[<?php echo $val['keyword']?>]" value="0" <?php echo (($val['value_'.$_lang] ==0)?'checked="checked"':'') ?> /><span>Không</span>
													</label>
												</section>
											</section>
										<?php
									}
									
								}
							}
						?>
						
						
						<section class="action">
								<p class="label">Thao tác:</p>
								<section class="group">
									<input type="submit" name="change" value="Thay đổi" />
									<input type="reset" value="Làm lại" />
								</section>
						</section>
					</section><!--end block-->
					
				</section> <!--end main-->
				
			</form>
		</section> <!--end form-->