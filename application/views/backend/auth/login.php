<div class="content">
<div class="box">
    <section class="dt_wrapper">
    <form method="post" action="">
		<div class="heading">
			<h3>Đăng Nhập Hệ Thống:</h3>
		</div>
		 <div class="content">
		 	<?php echo common_showerror(validation_errors()); ?> 
			<label class="item">
                <p>Tên Đăng Nhập:</p>
                <input type="text" name="data[Username]" value="<?php echo common_valuepost(isset($post['Username'])?$post['Username']:''); ?>" class="txtText" />
            </label>
            <label class="item">
                <p>Mật Khẩu:</p>
                <input type="password" name="data[Password]" value="" class="txtText" />
            </label>
            <label class="check">
				<input type="checkbox" name="remember" value="1" checked class="txtCheck" />
                <p>Nhớ cho lần sau</p>
            </label>
            <section class="login">
                <input type="submit" name="login" value="Đăng Nhập" class="txtSubmit" />
                <input  type="reset" value="Làm Lại" class="txtReset" />
            </section>
            <nav class="list">
                <ul>
                    <li><a href="#">Về trang chủ</a></li>
                    <li>/</li>
                    <li><a href="">Quên mật khẩu</a></li>
                </ul>
            </nav>                       
        </div>
      </form> 
    </section>
</div>
</div>
