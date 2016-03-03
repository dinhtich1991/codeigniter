	
		<section class="it-tabs">
			<h1>Slider</h1>
			<ul>
				<li class="active"><a href="backend/slider/index">slider</a></li>
				<li><a href="backend/slider/add">Thêm slider</a></li>
			</ul>
		</section> <!--end tab-->
		<section class="it-view">
			<section class="advanced">
				
			</section><!--end menuanced-->
			<section class="table">
				<form method="post" action="">
				<table cellpadding="0" cellspacing="0" class="main">
					<thead>
						<tr>
							<th>#</th>
							<th><input type="checkbox" id="view-checkall" /></th>
							<th>Tên Slider</th>
							<th>Ngày tạo</th>
							<th>Ngày sửa</th>
							<th>Người tạo</th>
							<th>Người sửa</th>
							<th>Hiển thị</th>
							<th>Thao tác</th>
							<th>Mã</th>
						</tr>
					</thead>
					<tbody>
					<?php
					if(isset($_list) &&count($_list)){ 
						$stt = 0;
						foreach($_list as $keyList => $valList){ ?>
						<tr>
							<td><?php echo $stt+1; ?></td>
							<td><input type="checkbox" id="view-checkall" /></td>
							<td class="left"><a href="#"><?php echo $valList['title']; ?></a></td>
							<td><a href=""><?php echo ($valList['created'] !='0000-00-00 00:00:00')?gmdate('H:i d/m/Y',strtotime($valList['created']) + 7*3600):'-'; ?></a></td>
							<td><a href=""><?php echo ($valList['updated'] !='0000-00-00 00:00:00')?gmdate('H:i d/m/Y',strtotime($valList['updated']) + 7*3600):'-'; ?></a></td>
							<td><a href=""><?php $user = get_user($valList['userid_created'],'username'); echo isset($user['username'])?$user['username']:'-'; ?></a></td>
							<td><a href=""><?php $user = get_user($valList['userid_updated'],'username'); echo isset($user['username'])?$user['username']:'-'; ?></a></td>
							<td class="last"><a href="backend/slider/set/publish/<?php echo $valList['id']; ?>?continue=<?php echo base64_encode(common_fullurl()); ?>" title="Trạng thái"><img src="public/template/backend/images/<?php echo ($valList['publish'] ==1)?'check':'uncheck'; ?>.png" title="Trạng thái"/></a></td>
							<td><a href="backend/slider/del/<?php echo $valList['id']; ?>?continue=<?php echo base64_encode(common_fullurl()); ?>" title="Xóa" onclick="return confirm('Bạn Chắc Chắn Muốn Xóa?');"><img src="public/template/backend/images/delete.png" /></a><a href="backend/slider/edit/<?php echo $valList['id']; ?>?continue=<?php echo base64_encode(common_fullurl()); ?>" title="Sửa"><img src="public/template/backend/images/setting.png" /></a></td>
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
		
