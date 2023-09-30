<?php use App\Http\Controllers\FunctionController;?>
<!-- SLIDE PANEL -->
<div class="panel">
    <div class="inner-panel">
        <div class="panel-top">
            <h2>
            <span class="text-[#4285f4]">P</span><span class="text-[#ea4335]">H</span><span class="text-[#fbbc05]">P</span><span class="text-[#34a853]"> A</span>pp <span class="text-[#34a853]">D</span>evelopment
            </h2>
        </div>
        <div class="panel-ul">
            <span class="panel-link pl-4"><?=FunctionController::isAuthenticated() ? 'Привет, ' . $_SESSION['user_name'] . '!' : ''?></span>
        </div>
        <ul class="panel-ul">
            <li><a class="panel-link" href="/"><i class="bi bi-house"></i>Главная</a></li>
            <li><a class="panel-link" href="/blog"><i class="bi bi-newspaper"></i>Блог</a></li>
            <li><a class="panel-link" href="/contact"><i class="bi bi-envelope"></i>Контакты</a></li>
        </ul>
        <ul class="panel-ul">
        <?php if (FunctionController::isAuthenticated()) {?>
            <li><a class="panel-link" href="/blog/create"><i class="bi bi-pen"></i>Создать публикацию</a></li>
        <?php }?>
            <li><a class="panel-link pl-4" href="/<?=FunctionController::isAuthenticated() ? 'log-out' : 'log-in'?>"><?=FunctionController::isAuthenticated() ? "<i class='bi bi-box-arrow-right'></i>Выйти" : "<i class='bi bi-box-arrow-right'></i>Войти"?></a></li>
        </ul>
    </div>
</div>