$(document).ready(function() {

    $('#contact_form').on('submit',function(e){
        e.preventDefault();
        var $that = $(this);
        var userName = $that.find("input[name='user_name']").val();
        var userPhone = $that.find("input[name='user_phone']").val();
        if(userName !== '' && userPhone !==''){
            $.ajax({
                type: 'POST',
                url: '/wp-admin/admin-ajax.php',
                data:{
                    action: 'contacts_send_msg',
                    //nonce: localizedScript._wp_nonce,
                    cf_user_name: userName,
                    cf_user_phone: userPhone
                },
                success: function (result) {
                    console.log('Message Sent!');
                    console.log(result);
                    $that[0].reset();

                    $that.find('.thank-msg').text("Дякуємо! Ми зв'яжемося з вами протягом години!").removeClass('hidden');
                    setTimeout(function(){$that.find(".thank-msg").addClass('hidden')}, 4000);
                }
            });
        }
        else if (userName.length == 0)  {
            $that.find("input[name='user_name']").css({'border-bottom':'1px solid red', 'color': 'red'}).val("Введіть ім'я");
            setTimeout(function(){$that.find("input[name='user_name']").css({'border-color':'#a50d11','color': '#000'}).val('')}, 2000);
        }
        else if (userPhone.length == 0){
            $that.find("input[name='user_phone']").css({'border-bottom':'1px solid red', 'color': 'red'}).val("Введіть телефон");
            setTimeout(function(){$that.find("input[name='user_phone']").css({'border-color':'#a50d11','color': '#000'}).val('')}, 2000);
        }
    });

    $('#popup_form').on('submit',function(e){
        e.preventDefault();
        var $that = $(this);
        var userName = $that.find("input[name='user_name']").val();
        var userPhone = $that.find("input[name='user_phone']").val();
        if(userName !== '' && userPhone !==''){
            $.ajax({
                type: 'POST',
                url: '/wp-admin/admin-ajax.php',
                data:{
                    action: 'contacts_send_msg',
                    //nonce: localizedScript._wp_nonce,
                    cf_user_name: userName,
                    cf_user_phone: userPhone
                },
                success: function (result) {
                    console.log('Message Sent!');
                    console.log(result);
                    $that[0].reset();

                    $('.popup__content').fadeOut(600);
                    $('.thank').fadeIn(600);
                    setTimeout(function(){
                        $('.thank').fadeOut();
                        $('.overlay').fadeOut(600);
                    }, 3000);
                }
            });
        }
        else if (userName.length == 0)  {
            $that.find("input[name='user_name']").css({'border-bottom':'1px solid red', 'color': 'red'}).val("Введіть ім'я");
            setTimeout(function(){$that.find("input[name='user_name']").css({'border-color':'#a50d11', 'color': '#000'}).val('')}, 2000);
        }
        else if (userPhone.length == 0){
            $that.find("input[name='user_phone']").css({'border-bottom':'1px solid red', 'color': 'red'}).val("Введіть телефон");
            setTimeout(function(){$that.find("input[name='user_phone']").css({'border-color':'#a50d11', 'color': '#000'}).val('')}, 2000);
        }
    });

});