$(window).load(function(){
	
	/*============== check - height - main =================*/
	if($('section.it-form .side-panel').height() > $('section.it-form .main-panel').height())
		$('section.it-form').height($('section.it-form .side-panel').height() + 20);
	
	
	$('#txtTimestart, #txtTimeend, #txtTimer').datetimepicker({
		format:'H:i:s d/m/Y',
	});
		
		
	/*============== check - all - list  =================*/
		var _this = '';
		var _temp = '';
		$('#check-all').click(function(){
			if($(this).prop('checked')){
				$('.check-all').prop('checked', true).parent().parent().find('td').addClass('select');
			}
			else{
				$('.check-all').prop('checked', false).parent().parent().find('td').removeClass('select');
			}
		});
			
		$('.check-all').click(function(){
			if($(this).prop('checked') == false){
				$(this).parent().parent().find('td').removeClass('select');
				$('#check-all').prop('checked', false);
			}
			else{
				$(this).parent().parent().find('td').addClass('select');
			}
			if($('.check-all:checked').length == $('.check-all').length){
				$('#check-all').prop('checked', true);
			}
		});
		
	/*============== tags suggest  =================*/		
	$('#tag_suggest').click(function(){
		if($('#tagspicker_suggest').is(':hidden')){
			$('#tagspicker_suggest').show();
			$('#tagspicker_suggest').html('<p><img src="public/template/backend/images/loading.gif" />Đang tải dữ liệu</p>');
			$.post('backend/tag/suggest', function(data){
				$('#tagspicker_suggest').width(468);
				$('#tagspicker_suggest').html(data);
			});
		}
		else{
			$('#tagspicker_suggest').width(168);
			$('#tagspicker_suggest').hide();
			$('#tagspicker_suggest').html('');
		}
		return false;
	});
	$('#tagspicker_suggest').on('click', '.title a', function(){
		_this = $(this);
		$('#tagspicker_suggest').width(168);
		$('#tagspicker_suggest').html('<p><img src="public/template/backend/images/loading.gif" />Đang tải dữ liệu</p>');
		$.post(_this.attr('href'), function(data){
			$('#tagspicker_suggest').width(468);
			$('#tagspicker_suggest').html(data);
		});
		return false;
	});
	$('#tagspicker_suggest').on('click', '.suggest a', function(){
		_this = $(this);
		_temp = $('#txtTags').val();
		$('#txtTags').val('Đang tải dữ liệu...');
		$.post('backend/tag/insert', {item: _this.attr('title'), list: _temp}, function(data){
			$('#txtTags').val(data);
		});
		return false;
	});
	
	/*============== relative suggest  =================*/
	$('#txtRelative').click(function(){
		if($('#relative_suggest').is(':hidden')){
			$('#relative_suggest').show();
			$('#relative_suggest').html('<p><img src="public/template/backend/images/loading.gif" />Đang tải dữ liệu</p>');
			$.post('backend/galary/suggest', function(data){
				$('#relative_suggest').width(468);
				$('#relative_suggest').html(data);
			});
		}
		else{
			$('#relative_suggest').width(168);
			$('#relative_suggest').hide();
			$('#relative_suggest').html('');
		}
		return false;
	});
	$('#relative_suggest').on('click', '.title a', function(){
		_this = $(this);
		$('#relative_suggest').width(168);
		$('#relative_suggest').html('<p><img src="public/template/backend/images/loading.gif" />Đang tải dữ liệu</p>');
		$.post(_this.attr('href'), function(data){
			$('#relative_suggest').width(468);
			$('#relative_suggest').html(data);
		});
		return false;
	});
	$('#relative_suggest').on('click', '.suggest a', function(){
		_this = $(this);
		_temp = $('#Relative').val();
		$('#Relative').val('Đang tải dữ liệu...');
		$.post('backend/galary/insert', {item: _this.attr('title'), list: _temp}, function(data){
			$('#Relative').val(data);
		});
		return false;
	});
	
});

$(document).mouseup(function(e){
	var container = $('#tagspicker_suggest');
	if(!container.is(e.target) && container.has(e.target).length === 0){
		$('#tagspicker_suggest').width(168);
		$('#tagspicker_suggest').html('').hide();
	}
});	
$(document).mouseup(function(e){
	var container = $('#relative_suggest');
	if(!container.is(e.target) && container.has(e.target).length === 0){
		$('#relative_suggest').width(168);
		$('#relative_suggest').html('').hide();
	}
});	
	function deleteAll(){
		if(confirm('Bạn có chắc chắn xóa?')){
			document.getElementById('btnDel').click(); return false;
		}
	}
	function showimage(){
		document.getElementById("show_image").style.display = "block";
	}
	function showimage2(){
		document.getElementById("show_image2").style.display = "block";
	}
	function showimage3(){
		document.getElementById("show_image3").style.display = "block";
	}
	function showimage4(){
		document.getElementById("show_image4").style.display = "block";
	}
	function showimage5(){
		document.getElementById("show_image5").style.display = "block";
	}
	function showimage6(){
		document.getElementById("show_image6").style.display = "block";
	}
	function showimage7(){
		document.getElementById("show_image7").style.display = "block";
	}
	function showimage8(){
		document.getElementById("show_image8").style.display = "block";
	}
	function showimage9(){
		document.getElementById("show_image9").style.display = "block";
	}
	function showimage10(){
		document.getElementById("show_image10").style.display = "block";
	}
	
	

$(function() {

	$(window).scroll(function() {

	if ($(this).scrollTop() > 200)

		$('#goTop').fadeIn();

	else

		$('#goTop').fadeOut();

	});

	$('#goTop').click(function() {

	$('body,html').animate({scrollTop: 0}, 'slow');

	});

});
