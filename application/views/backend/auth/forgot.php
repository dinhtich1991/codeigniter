<div class="content">
<div class="box">
    <section class="dt_wrapper">
    <form method="post" action="">
        <fieldset class="scheduler-border">
        <legend class="scheduler-border">Quên mật khẩu:</legend> 
        <?php echo common_showerror(validation_errors()); ?> 
         
            
            <label class="lbfs">
                <p>Email:</p>
                <input type="text" name="data[email]" value="" class="lpip" />
            </label>
            
            <section>
                <input type="submit" name="forgot" value="Gửi" />
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
