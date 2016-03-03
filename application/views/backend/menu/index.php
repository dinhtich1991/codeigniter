	
		<section class="it-tabs">
			<h1>Menu</h1>
			<ul>
				<li class="active"><a href="backend/menu/index">Menu</a></li>
				<li><a href="backend/menu/add">Thêm Menu</a></li>
			</ul>
		</section> <!--end tab-->
		<section class="it-view">
			<section class="advanced">
				<section class="search">
					<form method="get" action="backend/menu/index">
						<input type="hidden" name="sort_field" value="<?php echo $_sort['field']; ?>" />
						<input type="hidden" name="sort_value" value="<?php echo $_sort['value']; ?>" />
						<input type="text" class="text" name="keyword" class="" value="<?php echo isset($_keyword)?common_valuepost($_keyword):''; ?>" />
						<input type="submit" class="submit" value="Tìm kiếm" />
					</form>
				</section>
				<section class="tool">
					<form method="post" action="">
						<input type="button" value="Sắp Xếp" onclick="document.getElementById('btnSort').click(); return false;" />
					</form>
				</section>
			</section><!--end menuanced-->
			<section class="table">
				<form method="post" action="">
				<table cellpadding="0" cellspacing="0" class="main">
					<thead>
						<tr>
							<th>#</th>
							<th><input type="checkbox" id="view-checkall" /></th>
							<th><?php echo get_link_sort(array('base_url'=>$_config['base_url'],'field' =>'title','title' =>'Tên Menu','page'=>$_page,'sort_field' =>$_sort['field'],'sort_value' =>$_sort['value'])); ?></th>
							<th><?php echo get_link_sort(array('base_url'=>$_config['base_url'],'field' =>'created','title' =>'Ngày tạo','page'=>$_page,'sort_field' =>$_sort['field'],'sort_value' =>$_sort['value'])); ?></th>
							<th><?php echo get_link_sort(array('base_url'=>$_config['base_url'],'field' =>'updated','title' =>'Ngày sửa','page'=>$_page,'sort_field' =>$_sort['field'],'sort_value' =>$_sort['value'])); ?></th>
							<th>Người tạo</th>
							<th>Người sửa</th>
							<th><?php echo get_link_sort(array('base_url'=>$_config['base_url'],'field' =>'order','title' =>'Vị trí','page'=>$_page,'sort_field' =>$_sort['field'],'sort_value' =>$_sort['value'])); ?></th>
							<th><?php echo get_link_sort(array('base_url'=>$_config['base_url'],'field' =>'publish','title' =>'Hiển thị','page'=>$_page,'sort_field' =>$_sort['field'],'sort_value' =>$_sort['value'])); ?></th>
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
							<td><input type="checkbox" id="view-checkall" /></td>
							<td class="left"><a href="#"><?php echo $valList['title']; ?></a></td>
							<td><a href=""><?php echo ($valList['created'] !='0000-00-00 00:00:00')?gmdate('H:i d/m/Y',strtotime($valList['created']) + 7*3600):'-'; ?></a></td>
							<td><a href=""><?php echo ($valList['updated'] !='0000-00-00 00:00:00')?gmdate('H:i d/m/Y',strtotime($valList['updated']) + 7*3600):'-'; ?></a></td>
							<td><a href=""><?php $user = get_user($valList['userid_created'],'username'); echo isset($user['username'])?$user['username']:'-'; ?></a></td>
							<td><a href=""><?php $user = get_user($valList['userid_updated'],'username'); echo isset($user['username'])?$user['username']:'-'; ?></a></td>
							<td><input type="input" name="order[<?php echo $valList['id']; ?>]" value="<?php echo $valList['order']; ?>" class="order" /></td>
							<td class="last"><a href="backend/menu/set/publish/<?php echo $valList['id']; ?>?continue=<?php echo base64_encode(common_fullurl()); ?>" title="Trạng thái"><img src="public/template/backend/images/<?php echo ($valList['publish'] ==1)?'check':'uncheck'; ?>.png" title="Trạng thái"/></a></td>
							<td><a href="backend/menu/del/<?php echo $valList['id']; ?>?continue=<?php echo base64_encode(common_fullurl()); ?>" title="Xóa" onclick="return confirm('Bạn Chắc Chắn Muốn Xóa?');"><img src="public/template/backend/images/delete.png" /></a><a href="backend/menu/edit/<?php echo $valList['id']; ?>?continue=<?php echo base64_encode(common_fullurl()); ?>" title="Sửa"><img src="public/template/backend/images/setting.png" /></a></td>
							<td class="last"><?php echo $valList['id']; ?></td>
						</tr>
						
							
					<?php	} ?>
					
					<?php } else{ ?>
							<td class="last" colspan="9"><p>Không có dữ liệu!</p></td>
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
		
