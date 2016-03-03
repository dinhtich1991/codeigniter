<!-- begin footer -->
    <footer>
        <div id="ft-top">
            <div class="container">
                <span class="text-register">Đăng ký nhận tin khuyến mãi miễn phí: </span>
                <div class="form-register-email">
                    
                        <input type="email" placeholder="Nhập email của bạn..." />
                        <a href="#myModal" role="button" class="btn btn-warning" data-toggle="modal">GỬI</a>
                    
                </div>
            </div>

            <div class="social-network">
                <span class="text-contact-us">Liên kết với chúng tôi: </span>

                <a href=""><i class="fa fa-twitter"></i></a>
                <a href=""><i class="fa fa-facebook"></i></a>
                <a href=""><i class="fa fa-youtube"></i></a>
            </div>
        </div>

        <div id="ft-middle">
            <div class="container">


                <div class="box" style="width: 30%">
                    <h5>LIÊN HỆ<span></span></h5>

                    <div class="contact-us">
                        <p>CÔNG TY CỔ PHẦN THỜI GIAN GENVIET</p>
                        <p>Địa chỉ: 56B Bà Triệu - Hoàn Kiếm - Hà Nội</p>

                        <ul>
                            <li>Tel: 0982 191 375</li>
                            <li>Fax: 0982 191 375</li>
                            <li><a href="">Chăm sóc khách hàng</a></li>
                            <li><a href="">Truyển thông - MKT</a></li>
                            <li><a href="">Mở đại lý</a></li>
                            <li><a href="">Tuyển dụng</a></li>
                        </ul>
                    </div>
                </div>

                <div class="box" style="width: 17.5%">
                    <h5>HỆ THỐNG CỬA HÀNG<span></span></h5>

                    <ul>
                        <li><a href="">* HÀ NỘI</a></li>
                        <li><a href="">* MIỀN BẮC</a></li>
                        <li><a href="">* MIỀN TRUNG</a></li>
                        <li><a href="">* MIỀN NAM</a></li>
                    </ul>
                </div>

                <div class="box" style="width: 17.5%">
                    <h5>TIN TỨC<span></span></h5>

                    <ul>
                        <li><a href="">* Khai trương / Khuyến mại</a></li>
                        <li><a href="">* Hoạt động công ty</a></li>
                        <li><a href="">* Quỹ từ thiện</a></li>
                        <li><a href="">* Tin thời trang</a></li>
                    </ul>
                </div>

                <div class="box" style="width: 20.5%">
                    <h5>QUYỀN LỢI KHÁCH HÀNG<span></span></h5>

                    <ul>
                        <li><a href="">* Chính sách thẻ VIP</a></li>
                        <li><a href="">* Quy định đổi trả hàng</a></li>
                        <li><a href="">* Tư vấn chọn size</a></li>
                        <li><a href="">* Bảo quản Jean</a></li>
                    </ul>
                </div>

                <div class="box" style="width: 14.5%">
                    <h5>&nbsp;<span></span></h5>

                    <div class="time">
                        <p>THỜI GIAN MỞ CỬA</p>
                        <p>8:30 sáng - 10:30 tối</p>
                    </div>
                </div>


            </div>
        </div>

        <div id="ft-bottom">
            <div class="container">
                @2015 - Bản quyền thuộc về GENVIET
            </div>
        </div>
    </footer>
	<div class="modal fade" id="myModal">
		<div class="modal-dialog">
		<form class="form-horizontal" method="post" action="frontend/account/user_email">  
			<div class="modal-content">
				<div class="modal-header">
					<button class="close" data-dismiss="modal">&times;</button>
					
					<h4 class="modal-title">Đăng ký nhận tin khuyến mãi</h4>
				</div>
			 
				<div class="modal-body">
					
					
						<div class="form-group">
							<label class="col-lg-3 control-label">Họ Tên</label>
							<div class="col-lg-9">
								<input class="form-control" id="inputName" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-3 control-label">Email</label>
							<div class="col-lg-9">
								<input class="form-control" id="inputEmail" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-3 control-label">Tin nhắn</label>
							<div class="col-lg-9">
								<textarea class="form-control" id="inputMassage" rows="3" placeholder="Message"></textarea>
							</div>
						</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-success btn-default">Send</button>
					<button class="btn " data-dismiss="modal" type="button">Close</button>
				</div>
			</div>
		</form>
		</div>
	</div>