$(document).ready(function(){
	$.post('ajax/obj/viewed', {
		page: page,
		pageid: pageid,
	}, function(data){});
});
if($('.ajax-cartitem').length){
	$.post('ajax/cart/preview', function(data){
		var response = JSON.parse(data);
		if(response.code == 'error'){
			alert(response.message);
		}
		else if(response.code == 'successful'){
			$('.ajax-cartitem').html(response.data.item);
		}
	});
}
if($('.ajax-addtocart').length){
	$(document).on('click', '.ajax-addtocart', function(){
		let button = $(this);
		$.post('ajax/cart/addtocart', {
				id: button.attr('data-id'),
				qty: button.attr('data-qty'),
			}, function(data){
			var response = JSON.parse(data);
			if(response.code == 'error'){
				UIkit.modal.alert('<div class="modal-cart-alert"><p><strong>XẢY RA LỖI</strong></p><p style="color:red;">'+response.data+'</p></div>');
			}
			else if(response.code == 'successful'){
				UIkit.modal.alert('<div class="alert"><p><strong>THÔNG BÁO</strong></p><p>Thêm sản phẩm vào giỏ hàng thành công</p><p><a class="uk-modal-close" href="#">Tiếp tục mua hàng</a></p><p><a href="cart">Đến giỏ hàng</a></p></div>');
				$('.ajax-cartitem').html(response.data.item);
			}
		});
		return false;
	});
}

if($('.ajax-cart').length){
	$(document).on('click', '.ajax-cart .decrease', function(){
		let button = $(this);
		let quantity = parseInt($('#'+button.attr('data-target')).val());
		if(quantity > 1){
			$('#'+button.attr('data-target')).val(quantity - 1).trigger('change');
		}
		return false;
	});
	$(document).on('click', '.ajax-cart .increase', function(){
		let button = $(this);
		let quantity = parseInt($('#'+button.attr('data-target')).val());
		$('#'+button.attr('data-target')).val(quantity + 1).trigger('change');
		return false;
	});
	$(document).on('change', '.ajax-cart .quantity .qty', function(){
		let form = $(this).parents('.uk-form');
		$.post('ajax/cart/update', form.serialize(), function(data){
			var response = JSON.parse(data);
			if(response.code == 'successful'){
				$('.ajax-cartitem').html(response.data.item);
				$('.ajax-cartbill').html(response.data.bill);
			}
		});
		return false;
	});
}
$(document).on('submit', '.ajax-lead .uk-form', function(){
	let form = $(this);
	let parent = form.parents('.ajax-lead');
	$('#overlay').removeClass('uk-hidden');
	$.post(form.attr('action'), form.serialize(), function(data){
		$('#overlay').addClass('uk-hidden');
		response = JSON.parse(data);
		if(response.code == 'error'){
			UIkit.modal.alert('<p><strong>'+response.message+'</strong></p><p><span>'+response.data+'</span></p>');
		}
		else if(response.code == 'successful'){
			alert(response.message);
			location.href = response.data.redirect;
		}
	});
	return false;
});
