	
		<section class="it-tabs">
			<h1>Thành viên</h1>
			<ul>
				<li class="active"><a href="backend/user/index">Thành viên</a></li>
				<li><a href="backend/user/add">Thêm thành viên</a></li>
			</ul>
		</section> <!--end tab-->
		<section class="it-view">
			<section class="advanced">
				<section class="search">
					<form method="get" action="backend/user/index">
						<input type="hidden" name="sort_field" value="<?php echo $_sort['field']; ?>" />
						<input type="hidden" name="sort_value" value="<?php echo $_sort['value']; ?>" />
						<?php echo form_dropdown('groupid', (isset($_show['groupid'])?$_show['groupid']:NULL),common_valuepost(isset($_groupid)?$_groupid:0), 'class="cbSelect"'); ?>
						<input type="text" class="text" name="keyword" class="" value="<?php echo isset($_keyword)?common_valuepost($_keyword):''; ?>" />
						<input type="submit" class="submit" value="Tìm kiếm" />
					</form>
				</section>
				
			</section><!--end advanced-->
			<section class="table">
				<form method="post" action="">
				<table cellpadding="0" cellspacing="0" class="main">
					<thead>
						<tr>
							<th>#</th>
							<th><?php echo get_link_sort(array('base_url'=>$_config['base_url'],'field' =>'username','title' =>'Tên thành viên','page'=>$_page,'sort_field' =>$_sort['field'],'sort_value' =>$_sort['value'])); ?></th>
							<th>Bài viết</th>
							<th>Nhóm</th>
							<th><?php echo get_link_sort(array('base_url'=>$_config['base_url'],'field' =>'email','title' =>'Email','page'=>$_page,'sort_field' =>$_sort['field'],'sort_value' =>$_sort['value'])); ?></th>
							<th><?php echo get_link_sort(array('base_url'=>$_config['base_url'],'field' =>'fullname','title' =>'Tên đầy đủ','page'=>$_page,'sort_field' =>$_sort['field'],'sort_value' =>$_sort['value'])); ?></th>
							<th><?php echo get_link_sort(array('base_url'=>$_config['base_url'],'field' =>'created','title' =>'Ngày đăng ký','page'=>$_page,'sort_field' =>$_sort['field'],'sort_value' =>$_sort['value'])); ?></th>
							<th><?php echo get_link_sort(array('base_url'=>$_config['base_url'],'field' =>'update','title' =>'Ngày cập nhật','page'=>$_page,'sort_field' =>$_sort['field'],'sort_value' =>$_sort['value'])); ?></th>
							<th>Thao tác</th>
							<th class="last"><?php echo get_link_sort(array('base_url'=>$_config['base_url'],'field' =>'id','title' =>'Mã','page'=>$_page,'sort_field' =>$_sort['field'],'sort_value' =>$_sort['value'])); ?></th>
						</tr>
					</thead>
					<tbody>
					<?php
					if(isset($_list) &&count($_list)){ 
						foreach($_list as $keyList => $valList){ ?>
						<tr>
							<td><?php echo (($keyList+1) + $_config['per_page']*($_page-1)); ?></td>
							<td class="left"><a href="#"><?php echo $valList['username']; ?></a></td>
							<td><a href="#"><?php echo get_count_post('article_item',array('userid_created' => $valList['id'])); ?></a></td>
							<td><?php $group = get_category('user_group','id, title',array('id' => $valList['groupid'])); echo isset($group['title'])?$group['title']:''; ?></td>
							<td><a href="#"><?php echo $valList['email']; ?></a></td>
							<td><a href="#"><?php echo isset($valList['fullname'])?$valList['fullname']:'-'; ?></a></td>
							<td><a href=""><?php echo ($valList['created'] !='0000-00-00 00:00:00')?gmdate('H:i d/m/Y',strtotime($valList['created']) + 7*3600):'-'; ?></a></td>
							<td><a href=""><?php echo ($valList['update'] !='0000-00-00 00:00:00')?gmdate('H:i d/m/Y',strtotime($valList['update']) + 7*3600):'-'; ?></a></td>
							<td><a href="backend/user/del/<?php echo $valList['id']; ?>?continue=<?php echo base64_encode(common_fullurl()); ?>" title="Xóa" onclick="return confirm('Bạn Chắc Chắn Muốn Xóa?');"><img src="public/template/backend/images/delete.png" /></a><a href="backend/user/edit/<?php echo $valList['id']; ?>?continue=<?php echo base64_encode(common_fullurl()); ?>" title="Sửa"><img src="public/template/backend/images/setting.png" /></a></td>
							<td class="last"><?php echo $valList['id']; ?></td>
						</tr>
						
							
					<?php	} ?>
					
					<?php } else{ ?>
							<td class="last" colspan="10"><p>Không có dữ liệu!</p></td>
					<?php } ?>
					</tbody>	
				</table>
				<section class="display-none">
					<input type="submit" name="sort" value="Sắp Xếp" id="btnSort" />
				</section>
				</form>

			</section>
			
			<section class="pagination">
				<?php echo isset($pagination)?$pagination:''; ?>
			</section>
			
		</section> <!--end view-->
		
