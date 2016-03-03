		<nav class="navigation">
			<ul class="main">
				<li class="main">
					<a class="main" href="backend/config/index" title="Cấu hình hệ thống">Hệ thống</a>
					<ul class="item">
						<li class="item">
							<a class="item" href="backend/config/index">Cấu hình</a>
							<ul class="sub">
								<li class="sub"><a class="sub" href="#">Trang quản trị</a></li>
								<li class="sub"><a class="sub" href="#">Trang chủ</a></li>
							</ul>
						</li>
					</ul>
				</li>
				<li class="main">
					<a class="main" href="backend/user/index" title="Quản lí thành viên">Thành viên</a>
					<ul class="item">
						<li class="item"><a class="item" href="backend/user/group" title="Nhóm thành viên">Nhóm thành viên</a></li>
						<li class="item"><a class="item" href="backend/user/index" title="Thành viên">Thành viên</a></li>
					</ul>
				</li>
				<li class="main">
					<a class="main" href="#">Module</a>
					<ul class="item">
						<li class="item"><a class="item" href="backend/menu/index" title="Menu">Menu Chính</a></li>
						<li class="item"><a class="item" href="backend/submenu/index" title="Menu">Menu Phụ</a></li>
						<li class="item"><a class="item" href="backend/slider/index" title="Menu">Slider</a></li>
						<li class="item"><a class="item" href="backend/galary/bst" title="Menu">Bộ Sưu Tập</a></li>
						<li class="item"><a class="item" href="backend/adv/index" title="Quảng cáo">Quảng cáo</a></li>
						<li class="item"><a class="item" href="backend/tag/index" title="Từ khóa">Từ khóa</a></li>
						<li class="item"><a class="item" href="backend/partner/index" title="Từ khóa">Đối tác</a></li>
						<li class="item"><a class="item" href="backend/store/index" title="Từ khóa">Hệ thống store</a>
							<ul class="sub">
								<li class="sub"><a class="" href="backend/store/index">Hệ thống</a></li>
								<li class="sub"><a class="" href="backend/store/item">Chi tiết</a></li>
							</ul>
						</li>
						<li class="item"><a class="item" href="#">Hỗ trợ trực tuyến</a></li>
						<li class="item"><a class="item" href="#">Phản hồi</a></li>
					</ul>
				</li>
				<li class="main">
					<a class="main" href="backend/article/index" title="Bài viết">Sản phẩm</a>
					<ul class="item">
						<li class="item"><a class="item" href="backend/article/category" title="Danh mục">Danh mục</a></li>
						<li class="item"><a class="item" href="backend/article/item" title="Sản phẩm">Sản Phẩm</a></li>
						<li class="item"><a class="item" href="backend/attribute/group" title="Thuộc tính">Nhóm thuộc tính</a>
							<ul class="sub">
								<li class="sub"><a class="" href="backend/attribute/group">Nhóm thuộc tính</a></li>
								<li class="sub"><a class="" href="backend/attribute/item">Thuộc tính</a></li>
							</ul>
						</li>
						<li class="item"><a class="item" href="backend/galary/bstdetail" title="Bài viết">Bài viết cho bộ sưu tập</a></li>
					</ul>
				</li>
				<li class="main"><a class="main" href="#">Phản hồi</a></li>
			</ul>
			<ul class="user-account">
				<li>Chào <strong><?php echo !empty($data['auth']['fullname'])?$data['auth']['fullname']:$data['auth']['username']; ?></strong></li>
				<li><a href="backend/account/info">Thông tin</a></li>
				<li><a href="backend/auth/logout" title="Đăng xuất">Đăng xuất</a></li>
			</ul>			
		</nav>