<div id="page-galary">
    <div class="container">
        <h3>BỘ SƯU TẬP</h3>

        <div class="row">
            <div class="col-sm-12 col-xs-12">
                <a href="">
					<img class="caption" src="<?php echo $_bst['image'];?>" />
                </a>
            </div>
		<?php
			foreach($_list as $key => $val){
			
		?>
				<div class="col-sm-4 col-xs-12">
					<div class="content">
						<a href="<?php echo $_bst['route'].'/'.$val['alias'];?>">
							<img src="<?php echo $val['image_content'];?>" />
						</a>

						<div class="bottom">
							<p><i class="fa fa-calendar-o"></i> <?php echo $val['created'];?></p>
							<h5><a href=""><?php echo $val['title'];?></a></h5>
							<div class="arrow"></div>
						</div>
						<div class="line gray"></div>
					</div>
				</div>
		<?php
			}
			
		?>
        </div>

        <div class="paging">
            <ul>
				<?php echo (isset($_pagination) && !empty($_pagination))?$_pagination:''; ?>
			<!--
                <li><a href=""><i class="fa fa-angle-double-left"></i></a></li>
                <li><a class="active" href="">1</a></li>
                <li><a href="">2</a></li>
                <li><a href="">3</a></li>
                <li><a href="">4</a></li>
                <li><a href="">5</a></li>
                <li><span>...</span></li>
                <li><a href="">21</a></li>
                <li><a href=""><i class="fa fa-angle-double-right"></i></a></li>
            -->
			</ul>
			
        </div>
    </div>
</div>