	
		<section class="it-tabs">
			<h1>Hệ thống cửa hàng</h1>
			<ul>
				<li><a href="backend/store/index" title="Hệ thống cửa hàng">Hệ thống cửa hàng</a></li>
				<li class="active"><a href="backend/store/add" title="Thêm hệ thống cửa hàng">Thêm hệ thống cửa hàng</a></li>
			</ul>
		</section> <!--end tab-->
		<section class="it-view">
			
			<section class="table">
				<form method="post" action="">
				<table cellpadding="0" cellspacing="0" class="main">
					<thead>
						<tr>
							<th>#</th>
							<th><input type="checkbox" id="view-checkall" /></th>
							<th>Tên hệ thống cửa hàng</th>
							<th>Trạng thái</th>
							<th>Thao tác</th>
							<th class="last">Mã</th>
						</tr>
					</thead>
					<tbody>
					<?php
					if(isset($_list) &&count($_list)){ 
						foreach($_list as $keyList => $valList){ ?>
						<tr>
							<td><?php echo ($keyList+1);?></td>
							<td><input type="checkbox" id="view-checkall" /></td>
							<td class="left"><a href="#"><?php echo $valList['name']; ?></a></td>
							<td class="last"><a href="backend/store/set/publish/<?php echo $valList['id']; ?>?continue=<?php echo base64_encode(common_fullurl()); ?>" title="Trạng thái"><img src="public/template/backend/images/<?php echo ($valList['public'] ==1)?'check':'uncheck'; ?>.png" title="Trạng thái"/></a></td>
							<td><a href="backend/store/del/<?php echo $valList['id']; ?>?continue=<?php echo base64_encode(common_fullurl()); ?>" title="Xóa" onclick="return confirm('Bạn Chắc Chắn Muốn Xóa?');"><img src="public/template/backend/images/delete.png" /></a><a href="backend/store/edit/<?php echo $valList['id']; ?>?continue=<?php echo base64_encode(common_fullurl()); ?>" title="Sửa"><img src="public/template/backend/images/setting.png" /></a></td>
							<td class="last"><?php echo $valList['id']; ?></td>
						</tr>
						
							
					<?php	} ?>
					
					<?php } else{ ?>
							<td class="last" colspan="6"><p>Không có dữ liệu!</p></td>
					<?php } ?>
					</tbody>	
				</table>
				
				</form>

			</section>
			
			<section class="pagination">
				<?php echo isset($pagination)?$pagination:''; ?>
			</section>
			
		</section> <!--end view-->
		
