<div id="page-user">
        <div class="container">

            <div class="wrapper">
                <aside>
                    <div id="user-info">
						<img src="public/template/frontend/images/img02.png" />
						<div>Nguyễn Trang Phương</div>
					 </div>
                    <ul>
                        <li>
                            <h5><a href="">QUẢN LÝ ĐƠN HÀNG</a></h5>
                            <ul>
                                <li><a href="">Đang hoạt động</a></li>
                                <li><a href="">Kết thúc</a></li>
                            </ul>
                        </li>
                        <li>
                            <h5><a href="">CÁ NHÂN</a></h5>
                            <ul>
                                <li><a class="active" href="frontend/user/info">Thông tin cá nhân</a></li>
                                <li><a href="">Địa chỉ nhận hàng</a></li>
                            </ul>
                        </li>
                        <li>
                            <h5><a href="frontend/user/logout">THOÁT</a></h5>
                        </li>
                    </ul>
                </aside>
                <div class="primary">
                    <div class="header">
                        <h3>THÔNG TIN CHUNG</h3>
                    </div>
                    <div class="body">
                        <div class="box">
                            <h5>THÔNG TIN CHUNG</h5>

                            <div class="content">
                                <form class="form-horizontal">
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Họ và tên: </label>
                                        <div class="col-sm-4">
											<input type="text" class="form-control" id="change_fullname" value="<?php echo $_post['fullname']; ?>" placeholder="">
                                        </div>
                                        <div class="col-sm-2 text-right">
                                            <a onclick="changefullname();"><i class="fa fa-pencil"></i>Sửa</a>
                                        </div>
                                    </div>
									<div class="form-group" id="hide_fullname" style="display: none;">
                                        <label class="col-sm-6" style="padding-left:50px; color:red;">Họ và tên không được để trống </label>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Email: </label>
                                        <div class="col-sm-4">
                                            <input type="email" class="form-control" id="change_email" value="<?php echo $_post['email']; ?>" placeholder="">
                                        </div>
                                        <div class="col-sm-2 text-right">
                                            <a onclick="changeemail();"><i class="fa fa-pencil"></i>Sửa</a>
                                        </div>
                                    </div>
									<div class="form-group" id="hide_email" style="display: none;">
                                        <label class="col-sm-6" style="padding-left:50px; color:red;">Email không được để trống </label>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Ngày sinh: </label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="" value="<?php echo $_post['birth']; ?>" placeholder="">
                                        </div>
                                        <div class="col-sm-2 text-right">
                                            <a onclick="changebirth();" ><i class="fa fa-pencil"></i>Sửa</a>
                                        </div>
                                    </div>
									<div class="form-group" id="hide_birth" style="display: none;">
                                        <label class="col-sm-6" style="padding-left:50px; color:red;">Ngày sinh không được để trống </label>
                                    </div>
									<div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Ảnh đại diện: </label>
									<?php
										echo form_open_multipart('frontend/upload/user');
									?>
										<div class="col-sm-4">
											<input type="file" name="userfile" size="18" />
										</div>
										<div class="col-sm-2 text-right">
											<input type="submit" value="upload" />
										</div>
										</form>
									</div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Giới tính: </label>
                                        <div class="col-sm-4">
                                            <label class="radio-inline">
                                                <input type="radio" name="change_sex" value="1" onclick="changesex();" id="" <?php echo isset($_post['sex'])?(($_post['sex'] == 1)?'checked ="checked"':''):''; ?> > Nam
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="change_sex" value="0" onclick="changesex();" id="" <?php echo isset($_post['sex'])?(($_post['sex'] == 0)?'checked ="checked"':''):''; ?> > Nữ
                                            </label>
										</div>
                                    </div>

                                </form>
                            </div>
                        </div>

                        <div class="box">
                            <h5>MẠNG XÃ HỘI</h5>

                            <div class="content">
                                <ul id="socially">
                                    <li>
                                        <img src="public/template/frontend/images/user/img-facebook.png" />
                                        <div>Đã kết nối <a href="">http://www.facebook.com/FaustLibra</a></div>
                                        <a href="" class="btn btn-default">Hủy</a>
                                    </li>
                                    <li>
                                        <img src="public/template/frontend/images/user/img-google.png" />
                                        <div>Chưa kết nối</div>
                                        <a href="" class="btn btn-danger">Đăng nhập</a>
                                    </li>
                                    <li>
                                        <img src="public/template/frontend/images/user/img-twitter.png" />
                                        <div>Chưa kết nối</div>
                                        <a href="" class="btn btn-danger">Đăng nhập</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="box">
                            <h5>ĐỔI MẬT KHẨU</h5>
							<div id="show_error" style="display:none;"></div>
                            <div class="content last">
								<div class="alert alert-success alert-block fade in" id="successAlert" style="display:none;">
								<button type="button" class="close" data-dismiss="alert">&times;</button>
								<p>Đổi mật khẩu thành công!</p>
							</div>
                                <form class="form-horizontal" method="post" action="frontend/user/info">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label text-left">Mật khẩu cũ: </label>
                                        <div class="col-sm-4">
                                            <input type="password" class="form-control" id="change_password_old" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-2 control-label text-left">Mật khẩu mới: </label>
                                        <div class="col-sm-4">
                                            <input type="password" class="form-control" id="change_password_new" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-2 control-label text-left">Nhập lại: </label>
                                        <div class="col-sm-4">
                                            <input type="password" class="form-control" id="change_password_renew" placeholder="">
                                        </div>
                                    </div>
									<div class="form-group">
										<div class="col-sm-2">
										</div>
										<div class="col-sm-4">
											<button type="submit" class="btn btn-primary" id="alertMe">Thay đổi</button>
										</div>
									</div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>