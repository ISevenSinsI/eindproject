    $(function() {
        $('[data-tab]').hide();
        var current = $('.tabs .active').attr('id');
        $('[data-tab="'+ current +'"]').show();

        $('.tabs span').on('click', function() {
            $('.tabs span').removeClass("active");
            $(this).addClass("active");
            $('[data-tab]').hide();
            var current = $('.tabs .active').attr('id');
            $('[data-tab="'+ current +'"]').show();
        });

    });