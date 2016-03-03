<div class="content">
<div class="box">
    <section class="dt_wrapper">
    <form method="post" action="">
        <fieldset class="scheduler-border">
        <legend class="scheduler-border">Tạo tài khoản admin:</legend> 
        <?php echo common_showerror(validation_errors()); ?> 
         
            <label class="lbfs">
                <p>Tên Đăng Nhập:</p>
                <input type="text" name="data[Username]" value="<?php echo common_valuepost(isset($post['Username'])?$post['Username']:''); ?>" class="lbip" />
            </label>
            <label class="lbfs">
                <p>Mật Khẩu:</p>
                <input type="password" name="data[Password]" value="" class="lpip" />
            </label>
            <label class="lbfs">
                <p>Email:</p>
                <input type="text" name="data[Email]" value="" class="lpip" />
            </label>
            <section>
                <input type="submit" name="create" value="Tạo tài khoản" />
                <input  type="reset" value="Làm Lại"/>
            </section>
            <nav>
                <ul>
                    <li><a href="#">Về trang chủ</a></li>
                    <li>/</li>
                    <li><a href="">Quên mật khẩu</a></li>
                </ul>
            </nav>                       
        
         </fieldset>
      </form> 
    </section>
</div>
</div>
