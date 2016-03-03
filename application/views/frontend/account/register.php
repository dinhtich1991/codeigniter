
	<div id="page-register">
        <div class="container">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="box">
                    <h1>ĐĂNG KÝ TÀI KHOẢN</h1>
                    <p>Bạn đã có tài khoản?&nbsp;&nbsp;&nbsp;<a href="">Đăng nhập ngay</a></p>

                    <form class="form-horizontal" method="post" action="">
                        <?php echo common_showerror(validation_errors()); ?>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-3 control-label">
                                Tên đăng nhập: <span class="font-red">*</span>
                            </label>
                            <div class="col-sm-9">
                                <input type="text" name="data[username]" value="<?php echo common_valuepost(isset($post['username'])?$post['username']:''); ?>" class="form-control" id="inputEmail3" placeholder="">
                            </div>
                        </div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-3 control-label">
                                Email: <span class="font-red">*</span>
                            </label>
                            <div class="col-sm-9">
                                <input type="text" name="data[email]" value="<?php echo common_valuepost(isset($post['email'])?$post['email']:''); ?>" class="form-control" id="inputEmail3" placeholder="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label">
                                Mật khẩu: <span class="font-red">*</span>
                            </label>
                            <div class="col-sm-9">
                                <input type="password" name="data[password]" value="<?php echo common_valuepost(isset($post['password'])?$post['password']:''); ?>" class="form-control" id="inputPassword3" placeholder="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label">
                                Nhập lại mật khẩu: <span class="font-red">*</span>
                            </label>
                            <div class="col-sm-9">
                                <input type="password" name="data[repassword]" value="<?php echo common_valuepost(isset($post['repassword'])?$post['repassword']:''); ?>" class="form-control" id="inputPassword3" placeholder="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label">
                                Họ và tên:&nbsp;&nbsp;
                            </label>
                            <div class="col-sm-9">
                                <input type="text" name="data[fullname]" value="<?php echo common_valuepost(isset($post['fullname'])?$post['fullname']:''); ?>" class="form-control" id="inputPassword3" placeholder="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label">
                                Điện thoại: <span class="font-red">*</span>
                            </label>
                            <div class="col-sm-9">
                                <input type="text" name="data[phone]" value="<?php echo common_valuepost(isset($post['phone'])?$post['phone']:''); ?>" class="form-control" id="inputPassword3" placeholder="">
                            </div>
                        </div>
						<div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label">
                                Tỉnh/ thành phố: <span class="font-red">*</span>
                            </label>
                            <div class="col-sm-3">
                                <select class="form-control" name="data[city]" onchange="loadcity(this.value)">
									<option>---</option>
									<?php foreach($_city as $key => $val){ ?>
									<option value="<?php echo $val['id'] ?>"><?php echo $val['tentinhthanh'] ?></option>
									<?php } ?>
								</select>
                            </div>

                            <label for="inputPassword3" class="col-sm-3 control-label">
                                Quận/ huyện: <span class="font-red">*</span>
                            </label>
                            <div class="col-sm-3" id="show_district">
                                <select class="form-control">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label">
                                Địa chỉ: <span class="font-red">*</span>
                            </label>
                            <div class="col-sm-9">
                                <input type="text" name="data[address]" class="form-control" id="inputPassword3" placeholder="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label">
                                Ghi chú:
                            </label>
                            <div class="col-sm-9">
                                <textarea name="data[note]" value="<?php echo common_valuepost(isset($post['note'])?$post['note']:''); ?>" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <input type="submit" name="add" class="btn btn-default" value="TIẾP THEO" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>