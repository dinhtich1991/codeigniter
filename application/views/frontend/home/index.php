	<div id="slider">
        <ul class="bxslider">
            <?php 
				foreach($_slider as $key => $val){
					if(isset($val) && !empty($val)){
						echo '<li><img src="'.$val.'" /></li>';
					}
				}
			?>
        </ul>
    </div>
	<!-- begin top3 homepage -->
    <div id="top3-home">
        <div class="container">
            <div class="col-sm-4 col-xs-12">
                <a href=""><i class="fa fa-gift"></i> ƯU ĐÃI NHẬN SẢN PHẨM TẠI CỬA HÀNG</a>
            </div>

            <div class="col-sm-4 col-xs-12">
                <a href=""><i class="fa fa-dollar"></i> THANH TOÁN NHẬN HÀNG</a>
            </div>

            <div class="col-sm-4 col-xs-12">
                <a href=""><i class="fa fa-calendar-o"></i>ĐỔI TRẢ TRONG VÒNG 3 NGÀY</a>
            </div>
        </div>
    </div>
	
	<!-- begin links homepage -->
    <div id="links-home">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="box">
                        <a href="">
                            <img src="public/template/frontend/images/img01-1.png" />
                            <!--<h5>GEN VIỆT</h5>-->
                        </a>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="box">
                        <a href="">
                            <img src="public/template/frontend/images/img02.png" />
                            <!--<h5>ĐẸP MỖI NGÀY</h5>-->
                        </a>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="box">
                        <a href="">
                            <img src="public/template/frontend/images/img03.png" />
                        </a>
						<h1>Hệ thống cửa hàng</h1>
                    </div>
                </div>

                <div class="col-sm-8">
                    <div class="box">
                        <a href="">
                            <img src="public/template/frontend/images/img04.png" />
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
	
	
	
							
							