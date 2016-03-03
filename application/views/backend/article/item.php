	
		<section class="it-tabs">
			<h1>Sản phẩm</h1>
			<ul>
				<li class="active"><a href="backend/article/item" title="Sản phẩm">Sản phẩm</a></li>
				<li><a href="backend/article/additem" title="Thêm Sản phẩm">Thêm sản phẩm</a></li>
			</ul>
		</section> <!--end tab-->
		<section class="it-view">
			<section class="advanced">
				<section class="search">
					<form method="get" action="backend/article/item">
						<input type="hidden" name="sort_field" value="<?php echo $_sort['field']; ?>" />
						<input type="hidden" name="sort_value" value="<?php echo $_sort['value']; ?>" />
						<?php echo form_dropdown('parentid', (isset($_show['parentid'])?$_show['parentid']:NULL),common_valuepost(isset($_parentid)?$_parentid:0), 'class="cbSelect"'); ?>
						<input type="text" class="text" name="keyword" class="" value="<?php echo isset($_keyword)?common_valuepost($_keyword):''; ?>" />
						<input type="submit" class="submit" value="Tìm kiếm" />
					</form>
				</section>
				<section class="tool">
					<form method="post" action="">
						<input type="button" value="Sắp Xếp" onclick="document.getElementById('btnSort').click(); return false;" />
						<input type="button" value="Xóa nhiều" onclick="deleteAll();" />
					</form>
				</section>
			</section><!--end advanced-->
			<section class="table">
				<form method="post" action="">
				<table cellpadding="0" cellspacing="0" class="main">
					<thead>
						<tr>
							<th>#</th>
							<th><input type="checkbox" id="check-all" /></th>
							<th><?php echo get_link_sort(array('base_url'=>$_config['base_url'],'field' =>'title','title' =>'Tên Sản phẩm','page'=>$_page,'sort_field' =>$_sort['field'],'sort_value' =>$_sort['value'], 'parentid' =>$_parentid, 'keyword' =>$_keyword)); ?></th>
							<th>Danh mục</th>
							<th><?php echo get_link_sort(array('base_url'=>$_config['base_url'],'field' =>'created','title' =>'Ngày tạo','page'=>$_page,'sort_field' =>$_sort['field'],'sort_value' =>$_sort['value'], 'parentid' =>$_parentid, 'keyword' =>$_keyword)); ?></th>
							<th>Người tạo</th>
							<th>Người sửa</th>
							<th><?php echo get_link_sort(array('base_url'=>$_config['base_url'],'field' =>'order','title' =>'Vị trí','page'=>$_page,'sort_field' =>$_sort['field'],'sort_value' =>$_sort['value'], 'parentid' =>$_parentid, 'keyword' =>$_keyword)); ?></th>
							<th><?php echo get_link_sort(array('base_url'=>$_config['base_url'],'field' =>'publish','title' =>'Hiển thị','page'=>$_page,'sort_field' =>$_sort['field'],'sort_value' =>$_sort['value'], 'parentid' =>$_parentid, 'keyword' =>$_keyword)); ?></th>
							<th><?php echo get_link_sort(array('base_url'=>$_config['base_url'],'field' =>'highlight','title' =>'Nổi bật','page'=>$_page,'sort_field' =>$_sort['field'],'sort_value' =>$_sort['value'], 'parentid' =>$_parentid, 'keyword' =>$_keyword)); ?></th>
							<th><?php echo get_link_sort(array('base_url'=>$_config['base_url'],'field' =>'hot','title' =>'Hot','page'=>$_page,'sort_field' =>$_sort['field'],'sort_value' =>$_sort['value'], 'parentid' =>$_parentid, 'keyword' =>$_keyword)); ?></th>
							<th>Thao tác</th>
							<th class="last"><?php echo get_link_sort(array('base_url'=>$_config['base_url'],'field' =>'id','title' =>'Mã','page'=>$_page,'sort_field' =>$_sort['field'],'sort_value' =>$_sort['value'], 'parentid' =>$_parentid, 'keyword' =>$_keyword)); ?></th>
						</tr>
					</thead>
					<tbody>
					<?php
					if(isset($_list) &&count($_list)){ 
						foreach($_list as $keyList => $valList){ ?>
						<tr>
							<td><?php echo (($keyList+1) + $_config['per_page']*($_page-1)); ?></td>
							<td><input type="checkbox" name="checkbox[<?php echo $valList['id']; ?>]" value="1" class="check-all" /></td>
							<td class="left"><a href="#"><?php echo $valList['title']; ?></a></td>
							<td><?php $cate = get_category('article_category','id, title',array('id' => $valList['parentid'])); echo isset($cate['title'])?$cate['title']:''; ?></td>
							<td><a href=""><?php echo ($valList['created'] !='0000-00-00 00:00:00')?gmdate('H:i d/m/Y',strtotime($valList['created']) + 7*3600):'-'; ?></a></td>
							<td><a href=""><?php $user = get_user($valList['userid_created'],'username'); echo isset($user['username'])?$user['username']:'-'; ?></a></td>
							<td><a href=""><?php $user = get_user($valList['userid_updated'],'username'); echo isset($user['username'])?$user['username']:'-'; ?></a></td>
							<td><input type="input" name="order[<?php echo $valList['id']; ?>]" value="<?php echo $valList['order']; ?>" class="order" /></td>
							<td class="last"><a href="backend/article/setitem/publish/<?php echo $valList['id']; ?>?continue=<?php echo base64_encode(common_fullurl()); ?>" title="Trạng thái"><img src="public/template/backend/images/<?php echo ($valList['publish'] ==1)?'check':'uncheck'; ?>.png" title="Trạng thái"/></a></td>
							<td class="last"><a href="backend/article/setitem/highlight/<?php echo $valList['id']; ?>?continue=<?php echo base64_encode(common_fullurl()); ?>" title="Nổi bật"><img src="public/template/backend/images/<?php echo ($valList['highlight'] ==1)?'check':'uncheck'; ?>.png" title="Nổi bật"/></a></td>
							<td class="last"><a href="backend/article/setitem/hot/<?php echo $valList['id']; ?>?continue=<?php echo base64_encode(common_fullurl()); ?>" title="Hot"><img src="public/template/backend/images/<?php echo ($valList['hot'] ==1)?'check':'uncheck'; ?>.png" title="Hot"/></a></td>
							<td><a href="backend/article/delitem/<?php echo $valList['id'];?>?continue=<?php echo base64_encode(common_fullurl()); ?>" title="Xóa" onclick="return confirm('Bạn Chắc Chắn Muốn Xóa?');"><img src="public/template/backend/images/delete.png" /></a><a href="backend/article/edititem/<?php echo $valList['id']; ?>?continue=<?php echo base64_encode(common_fullurl()); ?>" title="Sửa"><img src="public/template/backend/images/setting.png" /></a></td>
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
					<input type="submit" name="del" value="Xóa nhiều" id="btnDel" />
				</section>
				</form>

			</section>
			
			<section class="pagination">
				<?php echo isset($pagination)?$pagination:''; ?>
			</section>
			
		</section> <!--end view-->
		
