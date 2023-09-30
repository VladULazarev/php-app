<?php use App\Core\Route;
use App\Http\Controllers\FunctionController;?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="theme-color" content="#1d1e24">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title><?=APP_NAME?></title>
    <meta name="description" content="<?=APP_DESCRIPTION?>">
    <meta name="author" content="<?=AUTHOR_EMAIL?>">

    <link href="/public/favicon.ico" rel="icon">
    <link href="/public/apple-touch-icon.png" rel="apple-touch-icon">
    <link rel="canonical" href="<?=HTTP . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']?>">

    <meta property="og:type" content="article">
    <meta property="og:title" content="<?=APP_NAME?>">
    <meta property="og:description" content="<?=APP_DESCRIPTION?>">
    <meta property="og:url" content="<?=HTTP . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']?>">
    <meta property="og:site_name" content="<?=APP_NAME?>">
    <meta property="og:image" content="https://domain.com/public/twitter-card.jpg">
    <meta property="og:image:width" content="450">
    <meta property="og:image:height" content="300">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?=APP_NAME?>">
    <meta name="twitter:description" content="<?=APP_DESCRIPTION?>">
    <meta name="twitter:image" content="https://domain.com/public/twitter-card.jpg">

    <link href="/public/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="/public/css/app.css" rel="stylesheet">
    <link href="/public/css/custom.css" rel="stylesheet">

</head>
<body class="font-sans antialiased text-[#294d6a]">

<?php include $_SERVER['DOCUMENT_ROOT'] . '/resources/includes/slide-panel.php'?>

<div class="flex flex-col min-h-screen relative">

    <header class="header fixed top-0 w-full shadow-sm z-10 bg-gradient-to-r from-[#00739f]/95 to-[#013670]/95">

        <nav class="max-w-[1320px] mx-auto">
            <div class="max-w-screen-xl mx-auto flex flex-wrap items-center justify-between px-6 md:py-0 py-6">

                <a href="/" class="flex items-center">
                    <img src="/public/img/logo.jpg" class="h-12 rounded-full absolute" alt="<?=APP_NAME?> Logo" />
                    <span class="self-center text-2xl font-semibold whitespace-nowrap pl-16 text-gray-50 md:hover:text-gray-50">
                        <span class="text-[#4285f4]">P</span><span class="text-[#ea4335]">H</span><span class="text-[#fbbc05]">P</span><span class="text-[#34a853]"> A</span>pp <span class="text-[#34a853] hide">D</span><span class="hide">evelopment</span></span>
                </a>

                <div class="w-full md:block md:w-auto hidden">
                    <ul class="font-normal flex flex-col p-4 md:p-0 mt-4 md:flex-row md:space-x-8 md:mt-0 md:border-0">

                        <li class="py-1">
                            <a href="/" class="main-link block text-gray-300 md:hover:text-gray-50 duration-100 py-6"
                            >Главная</a>
                        </li>

                        <li class="py-1">
                            <a href="/blog" class="show-loader main-link block text-gray-300 md:hover:text-gray-50 duration-100 py-6"
                            >Блог</a>
                        </li>

                        <li class="py-1">
                            <a href="/contact" class="main-link block text-gray-300 md:hover:text-gray-50 duration-100 py-6"
                            >Контакты</a>
                        </li>

                        <li class="relative menu-user-icon cursor-pointer">
                            <div class="py-6">
                                <i class="bi bi-person-circle text-2xl text-gray-300 md:hover:text-gray-50 duration-100">
                                </i><?=FunctionController::isAuthenticated() ? '' : "<i class='bi bi-caret-down-fill text-gray-300'></i>"?>
                            </div>

                            <div class="menu-drop-down absolute bg-[#00407e] shadow-md rounded-md <?=FunctionController::isAuthenticated() ? 'right-custom-2' : 'right-custom-1'?>">

                                <span>
                                    <a href="/<?=FunctionController::isAuthenticated() ? 'log-out' : 'log-in'?>" class="show-loader block text-center py-2 px-6 md:border-0 text-white md:hover:text-gray-300 duration-100"><?=FunctionController::isAuthenticated() ? 'Выйти' : 'Войти'?></a>
                                </span>

                                <?php if (FunctionController::isAuthenticated()) {?>
                                <span>
                                    <a href="/blog/create"
                                       class="show-loader block text-center py-2 px-6 md:border-0 text-white md:hover:text-gray-300 duration-100"
                                    >Создать публикацию</a>
                                </span>
                                <?php }?>
                            </div>
                        </li>
                        <li class="menu-user-name py-1"><span class="inline-block text-md text-white mt-6 ml-1"><?=FunctionController::isAuthenticated() ? $_SESSION['user_name'] : ''?></span></li>
                    </ul>
                </div>
                <i class="mobile-nav-toggle text-3xl text-gray-50 md:hidden bi bi-list"></i>
            </div>
        </nav>
    </header>

    <?php if ($_SERVER['REQUEST_URI'] === '/') {
        include $_SERVER['DOCUMENT_ROOT'] . '/resources/includes/top-image.php';
    }
    elseif ($_SERVER['REQUEST_URI'] === '/log-in' | $_SERVER['REQUEST_URI'] === '/register' |
              $_SERVER['REQUEST_URI'] === '/blog/create'
    ) { true;}
    else {echo "<section class='content top-small-image'></section>";}
    ?>

    <main class="content relative xl:min-w-[1240px] min-w-full mx-auto">
        <?php Route::get(explode('/', $_SERVER['REQUEST_URI'])); ?>
    </main>

    <?php if ($_SERVER['REQUEST_URI'] !== '/log-in' && $_SERVER['REQUEST_URI'] !== '/register') {
        include $_SERVER['DOCUMENT_ROOT'] . '/resources/includes/footer.php';}?>

    <div class="w-full bg-white text-[#3b5998] font-normal text-base text-center p-4 shadow-inner">
        <p>&copy; 2023 <?=APP_NAME?>. All rights reserved.</p>
    </div>

</div>

<script src="/public/js/jquery.min.js"></script>
<script src="/public/js/jquery.mobile-events.min.js"></script>
<script src="/public/js/app.js"></script>
<div class="loader"></div>

</body>
</html>