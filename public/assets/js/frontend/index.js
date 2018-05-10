define(['jquery', 'bootstrap', 'frontend', 'form', 'template','swiper'], function ($, undefined, Frontend, Form, Template,swiper) {
    // var validatoroptions = {
        // invalid: function (form, errors) {
        //     $.each(errors, function (i, j) {
        //         Layer.msg(j);
        //     });
        // }
    // };


    var Controller = {
        index: function () {

            //nav
            $(document).on("click", ".my-nav", function () {
                $('.my-nav i').addClass('hide');
                $('.my-nav').removeClass('active');
                $(this).children('.fa-minus').removeClass('hide');
                $(this).addClass('active');

            });
            $(function(){
                $('.my-nav i').addClass('hide');
                $('.my-nav').removeClass('active');

                var id;
                if(window.location.hash == ''){
                    id = "#Homepage2tip";
                }else{
                    id = window.location.hash+'tip';
                }

                $(id).children('.fa-minus').removeClass('hide');
                $(id).addClass('active');
            });


            //swiper
            var mySwiper1 = new Swiper('#Homepage .swiper-container', {
                autoplay: true,//可选选项，自动滑动
                loop : true,
                pagination: {
                    el: '.swiper-pagination',
                    type: 'bullets',
                    clickable :true,
                },
                scrollbar: {
                    el: '.swiper-scrollbar',
                },

            });
            var mySwiper2 = new Swiper('#Five-in-one .swiper-container', {
                autoplay: true,//可选选项，自动滑动
                loop : true,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },

            });
            mySwiper2.on('slideChange', function () {
                $('#Five-in-one .row .v1200x540 td').removeClass('tactive');
                $('#Five-in-one .row .v1200x540 .fa-caret-down').addClass('hide');
                var id = this.slides[this.activeIndex].id;

                $('#Five-in-one .row .v1200x540 #title'+id).addClass('tactive');
                $('#Five-in-one .row .v1200x540 #fa'+id).removeClass('hide');
            });
            $(document).on('mouseover','#Five-in-one .row .v1200x540 td',function(){
                var index = parseInt(this.dataset.index) + 1;
                //console.log(index)
                mySwiper2.slideTo(index, 500)
            });


            $(document).on("click", ".btn-mybtn-sub", function () {
                var realname = $('#realname').val(),
                    phone = $('#phone').val(),
                    remark = $('#remark').val();
                if(realname =='' ){
                    Layer.msg('姓名不能为空');
                    return false;
                }
                if(phone == ''){
                    Layer.msg('手机号不能为空');
                    return false;
                }
                if(!/^1\d{10}$/.test(phone)){
                    Layer.msg('手机号格式不正确');
                    return false;
                }
                $.ajax({
                    url:"index/index/index",
                    type:'post',
                    data:{realname:realname,phone:phone,remark:remark},
                    success:function (ret) {
                        console.log(ret)
                        if(ret.code == 'ok'){
                            $('.btn-mybtn-sub').addClass('disabled');
                        }
                        Layer.msg(ret.msg);
                    }
                })
            });

        },

    };
    return Controller;
});
