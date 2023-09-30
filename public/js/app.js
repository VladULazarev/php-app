function showHideNavigation() {

    let lastScrollTop = 0;

    $(window).scroll(function(){

        let st = $(this).scrollTop();

        if (st > lastScrollTop && st > 250) {

            $('.header').css({'top': '-7rem', 'background-color': 'transparent'});

        } else {

            $('.header').css({'top': '0rem'});
        }
        lastScrollTop = st;
    });
}

$(document).ready(function() {

    showHideNavigation();

    $('.main-link').each(function() {
        if (this.href === window.location.href) {
            $(this).addClass('active-link');
        }
    });

    $('.active-link').on('click', function(event) {
        event.preventDefault();
    });

    $(".content").fadeTo(300, 1);

    $('.menu-user-icon').on("click", function () {
        $('.menu-drop-down').fadeToggle();
    });

    $("form").submit(function(){
        $('.loader').css('display','grid').fadeTo(300, 1);
    });

    $('.show-loader').on("click",function(){
        $('.loader').css('display', 'grid').fadeTo(300, 1);
    });

    $('.click-me').on("click",function(){
        let uri = $(this).data("value");
        $('.loader').css('display','grid').fadeTo(300, 1);
        $(location).attr('href', uri );
    });

    // Очистить данные форма редактирования публикации
    $('.clear-form').on("click", function(e) {

        e.preventDefault();

        let clearPostForm = 'clear-post-form-sessions'

        $.post('/public/scripts/clear-create-post-form-sessions.php', {action: clearPostForm}, function(data) {
            if (data) {
                location.reload();
            } else {
                alert('Что-то пошло не так')
                location.reload();
            }
        });
    });

    if ( $(location).attr('href').split("/")[3] === 'register' ) {
        $('#name').focus();
    } else if ( $(location).attr('href').split("/")[3] === 'log-in' ) {
        $('#login-password').focus();
    } else if ( $(location).attr('href').split("/")[3] === 'contact' ) {
        $('#name').focus();
    }

// ---------------------------------------------------- Show/hide 'Slide panel'

    let panelHeight = window.innerHeight;

    $(".inner-panel").css({"height": panelHeight});

    let panelTrigger = false;

    $('.mobile-nav-toggle').on("tap",function(){

        if (panelTrigger === false) {
            showSlidePanel();
        } else if (panelTrigger === true) {
            hideSlidePanel();
        }
    });

    $('.panel').on("swipeleft",function(){
        hideSlidePanel();
    });

    function showSlidePanel() {

        let windowWidth = $(window).width();
        let docHeight = $(document).height();

        if ( windowWidth <= 1536 ) {
            $(".panel").addClass('panel-visible').css({"height": panelHeight});
            panelTrigger = true;

            // Применить затемнение при видимой панели (dark overlay)
            window.setTimeout(function() {
                $("body").append("<div id='overlay'></div>");
                $("#overlay").height(docHeight + 100).animate({opacity: ".4"}, 200);
            }, 100);

            // Запретить 'scroll' при видимой панели
            setTimeout(function() {$('body').css({"overflow": "hidden"});}, 400);
        }
    }

    function hideSlidePanel() {

        $(".panel").removeClass('panel-visible');

        panelTrigger = false;

        setTimeout(function() {$("#overlay").animate({opacity: '0' });}, 100);
        setTimeout(function() { $("#overlay").remove(); }, 300);
        setTimeout(function() {$("body").css({"overflow": "auto"});}, 400);
    }

    // Сначала панель скрывается и потом переход по ссылке
    $(document).on('tap', '.panel-link', function(event){

        let clickedLink = $(this).attr('href');

        if (clickedLink) {
            event.preventDefault();
            hideSlidePanel();
            setTimeout(function() { $(location).attr('href', clickedLink); }, 500);
        }
    });
});