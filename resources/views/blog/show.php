<?php use App\Http\Controllers\FunctionController;
if ( isset($_SESSION['user_id']) ) {$_SESSION['post-user-id'] = $data['post'][0]->user_id;}?>
<div class="container mt-24 mb-12 max-w-[1140px] mx-auto">
    <div class="grid md:grid-cols-3 gap-8 sm:px-4">

        <div class="md:col-span-2 col-span-12 mb-12 pt-2 pb-4 rounded-md shadow-md">

            <img width="600" height="400"
                src="/public/uploads/blog/<?=$data['post'][0]->id?>/<?=$data['post'][0]->img_path?>"
                class="mb-8 w-full"
                alt="<?=htmlentities($data['post'][0]->title)?>">

            <div class="px-6"
                <h3 class="font-normal text-2xl text-[#3b5998] mb-2"><?=htmlentities($data['post'][0]->title)?></h3>
                <div class="text-[#3b5998]/50 font-semibold text-sm mb-6 pb-6 border-b"><?=Carbon\Carbon::parse($data['post'][0]->updated_at)->isoFormat('D MMMM Y г.')?></div>
                <p class="text-md leading-6 font-normal mb-4"><?=htmlentities($data['post'][0]->body)?></p>
            </div>

            <?php
            if ( FunctionController::isAuthenticated() && (intval($_SESSION['user_id']) === intval($_SESSION['post-user-id']))) { ?>
            <div class="flex justify-end sm:me-4 me-2">
                <button class="click-me text-white justify-center mt-8 bg-[#0e5386] hover:bg-[#0e5386]/90 focus:ring-4 focus:outline-none focus:ring-[#0e5386]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mr-2 mb-2 duration-100" data-value="/blog/<?=$data['post'][0]->id?>/edit">Редактировать</button>
                <button class="click-me text-white justify-center mt-8 bg-[#983b61] hover:bg-[#983b61]/90 focus:ring-4 focus:outline-none focus:ring-[#983b61]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mr-2 mb-2 duration-100" data-value="/blog/delete/<?=$data['post'][0]->id?>">Удалить</button>
            </div>
            <?php }?>

        </div>

        <div class="md:col-span-1 col-span-12 mb-4 py-2 sm:px-0 px-4">
            <h2 class="text-2xl font-semibold text-[#3b5998] mb-8 pl-3 pb-2 border-b"><span class="text-[#ea4335]">Н</span>овые</h2>
            <?php foreach($data['lastPosts'] as $lastPost) : ?>
                <p class="click-me transition delay-50 hover:translate-x-1 md:hover:text-[#494798] cursor-pointer border-b text-sm font-semibold text-[#3b5998] leading-8 shadow-md rounded-xl py-2 px-4 mb-8" data-value="/blog/<?=$lastPost->slug?>"><?=htmlentities($lastPost->title)?></p>
            <?php endforeach;?>
        </div>
    </div>

