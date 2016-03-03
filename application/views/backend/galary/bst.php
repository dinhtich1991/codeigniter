	
		<section class="it-tabs">
			<h1>Bộ sưu tập</h1>
			<ul>
				<li class="active"><a href="backend/galary/bst" title="bộ sưu tập" >bộ sưu tập</a></li>
				<li><a href="backend/galary/addbst" title="Thêm bộ sưu tập" >Thêm bộ sưu tập</a></li>
			</ul>
		</section> <!--end tab-->
		<section class="it-view">
			<section class="advanced">
				
				<section class="tool">
					<form method="post" action="">
						<input type="button" value="Sắp Xếp" onclick="document.getElementById('btnSort').click(); return false;" />
					</form>
				</section>
			</section><!--end advanced-->
			<section class="table">
				<form method="post" action="">
				<table cellpadding="0" cellspacing="0" class="main">
					<thead>
						<tr>
							<th>#</th>
							<th><input type="checkbox" id="view-checkall" /></th>
							<th>Tên bộ sưu tập</th>
							<th>Bài viết</th>
							<th>Ngày tạo</th>
							<th>Ngày sửa</th>
							<th>Người tạo</th>
							<th>Người sửa</th>
							<th>Vị trí</th>
							<th>Hiển thị</th>
							<th>Thao tác</th>
							<th class="last">Mã</th>
						</tr>
					</thead>
					<tbody>
					<?php
					if(isset($_list) &&count($_list)){ 
						foreach($_list as $keyList => $valList){ ?>
						<tr>
							<td><?php echo ($keyList+1); ?></td>
							<td><input type="checkbox" id="view-checkall" /></td>
							<td class="left"><a href="#"><?php echo str_repeat('|----',$valList['level']).$valList['title']; ?></a></td>
							<td><?php echo get_count_bstdetail('galary_bstdetail',array('parentid' =>$valList['id'])); ?> </td>
							<td><a href=""><?php echo ($valList['created'] !='0000-00-00 00:00:00')?gmdate('H:i d/m/Y',strtotime($valList['created']) + 7*3600):'-'; ?></a></td>
							<td><a href=""><?php echo ($valList['updated'] !='0000-00-00 00:00:00')?gmdate('H:i d/m/Y',strtotime($valList['updated']) + 7*3600):'-'; ?></a></td>
							<td><a href=""><?php $user = get_user($valList['userid_created'],'username'); echo isset($user['username'])?$user['username']:'-'; ?></a></td>
							<td><a href=""><?php $user = get_user($valList['userid_updated'],'username'); echo isset($user['username'])?$user['username']:'-'; ?></a></td>
							<td class="last"><a href="backend/galary/setbst/publish/<?php echo $valList['id']; ?>" title="Trạng thái"><img src="public/template/backend/images/<?php echo ($valList['publish'] ==1)?'check':'uncheck'; ?>.png" title="Trạng thái"/></a></td>
							<td><input type="input" name="order[<?php echo $valList['id']; ?>]" value="<?php echo $valList['order']; ?>" class="order" /></td>
							<td><a href="backend/galary/delbst/<?php echo $valList['id']; ?>" title="Xóa" onclick="return confirm('Bạn Chắc Chắn Muốn Xóa?');"><img src="public/template/backend/images/delete.png" /></a><a href="backend/galary/editbst/<?php echo $valList['id']; ?>" title="Sửa"><img src="public/template/backend/images/setting.png" /></a></td>
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
		
