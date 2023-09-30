<?php use App\Http\Controllers\FunctionController;?>
<div class="flex xl:mt-24 mt-16 mb-20">
    <div class="mx-auto md:min-w-[600px] md:max-w-[600px] min-w-full px-4">
        <h1 class="mb-10 text-2xl font-semibold"><span class="text-[#34a853]">Р</span>едактировать публикацию</h1>
        <form action="/update-post" method="post" enctype="multipart/form-data">

            <div>
                <input
                    type="hidden"
                    id="slug"
                    name="slug"
                    placeholder="URI, например: best-js-framework"
                    value="<?= FunctionController::oldInput('slug') ?>"
                    maxlength="50"
                    autocomplete="off"
                    required
                    class="md:max-w-[600px] w-full border-b border-b-[#3b5998]/30 focus:border-b-[#494798] text-md block p-2 cursor-pointer">
            </div>

            <div class="mt-5">
                <label for="title" class="font-medium text-[#3b5998]">Заголовок</label>
                <input
                    type="text"
                    id="title"
                    name="title"
                    placeholder="Заголовок публикации"
                    value="<?= FunctionController::oldInput('title') ?>"
                    maxlength="50"
                    autocomplete="off"
                    required
                    class="md:max-w-[600px] w-full border-b border-b-[#3b5998]/30 focus:border-b-[#494798] text-md block p-2 cursor-pointer">
                <div class="text-purple-700 pl-2 mt-2 break-words">
                    <?= FunctionController::oldInput('title-error') ?>
                </div>
            </div>

            <div class="mt-5">
                <label for="excerpt" class="font-medium text-[#3b5998]">Краткое содержание</label>
                <input
                    type="text"
                    id="excerpt"
                    name="excerpt"
                    placeholder="Краткое содержание"
                    value="<?= FunctionController::oldInput('excerpt') ?>"
                    maxlength="250"
                    autocomplete="off"
                    required
                    class="md:max-w-[600px] w-full border-b border-b-[#3b5998]/30 focus:border-b-[#494798] text-md block p-2 cursor-pointer">
                <div class="text-purple-700 pl-2 mt-2 break-words">
                    <?=FunctionController::oldInput('excerpt-error')?>
                </div>
            </div>

            <div class="mt-5">
                <label for="body" class="font-medium text-[#3b5998]">Текст публикации</label>
                <textarea
                    type="text"
                    id="body"
                    name="body"
                    placeholder="Текст публикации"
                    maxlength="1000"
                    rows="5"
                    autocomplete="off"
                    required
                    class="md:max-w-[600px] w-full border-b border-b-[#3b5998]/30 focus:border-b-[#494798] text-md block p-2 cursor-pointer"><?=FunctionController::oldInput('body')?></textarea>
                <div class="text-purple-700 pl-2 mt-2 break-words">
                    <?=FunctionController::oldInput('body-error')?>
                </div>
            </div>

            <div class="mt-5">
                <label for="file-upload" class="inline-block font-medium text-[#3b5998] my-4 px-1">Выбрать новое изображение (необязательно)</label>
                <input
                    id="file-upload"
                    type="file"
                    name="image"
                    accept="image/*" class="text-[#3b5998] ml-1">
                <div class="text-purple-700">
                    <?=FunctionController::oldInput('image-error')?>
                </div>

                <div class="mt-6 ml-1">
                    <div class="my-4 font-medium text-[#3b5998]">Текущее изображение</div>
                    <img width="120px" height="80px"
                        src="/public/uploads/blog/<?=FunctionController::oldInput('id')?>/<?=FunctionController::oldInput('img_path')?>"
                        class="mb-3"
                        alt="Текущее изображение">
                </div>

                <input
                    type="submit"
                    name="update-post"
                    value="Сохранить изменения"
                    class="text-white min-w-full justify-center mt-8 mr-2 mb-2 py-2.5 bg-[#0e5386] hover:bg-[#0e5386]/90 focus:ring-4 focus:outline-none focus:ring-[#0e5386]/50 font-medium rounded-lg text-sm text-center inline-flex items-center duration-100">
            </div>
        </form>
    </div>
</div>