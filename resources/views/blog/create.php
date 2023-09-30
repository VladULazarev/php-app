<?php use App\Http\Controllers\FunctionController;?>
<div class="flex xl:mt-48 mt-36 mb-20">
    <div class="mx-auto md:min-w-[600px] md:max-w-[600px] min-w-full px-4">
        <h1 class="mb-10 text-2xl font-semibold"><span class="text-[#34a853]">С</span>оздать публикацию</h1>
        <form action="/create-post" method="post" enctype="multipart/form-data">

            <div>
                <label for="slug"></label>
                <input
                    type="text"
                    id="slug"
                    name="slug"
                    placeholder="URI, например: best-js-framework"
                    value="<?=FunctionController::oldInput('slug')?>"
                    maxlength="50"
                    autocomplete="off"
                    required
                    class="md:max-w-[600px] w-full border-b border-b-[#3b5998]/30 focus:border-b-[#494798] text-md block p-2 cursor-pointer">
                <div class="text-purple-700 pl-2 mt-2 break-words">
                    <?=FunctionController::oldInput('slug-error')?>
                </div>
            </div>

            <div class="mt-5">
                <label for="title"></label>
                <input
                    type="text"
                    id="title"
                    name="title"
                    placeholder="Заголовок публикации"
                    value="<?=FunctionController::oldInput('title')?>"
                    maxlength="50"
                    autocomplete="off"
                    required
                    class="md:max-w-[600px] w-full border-b border-b-[#3b5998]/30 focus:border-b-[#494798] text-md block p-2 cursor-pointer">
                <div class="text-purple-700 pl-2 mt-2 break-words">
                    <?=FunctionController::oldInput('title-error')?>
                </div>
            </div>

            <div class="mt-5">
                <label for="excerpt"></label>
                <input
                    type="text"
                    id="excerpt"
                    name="excerpt"
                    placeholder="Краткое содержание"
                    value="<?=FunctionController::oldInput('excerpt')?>"
                    maxlength="250"
                    autocomplete="off"
                    required
                    class="md:max-w-[600px] w-full border-b border-b-[#3b5998]/30 focus:border-b-[#494798] text-md block p-2 cursor-pointer">
                <div class="text-purple-700 pl-2 mt-2 break-words">
                    <?=FunctionController::oldInput('excerpt-error')?>
                </div>
            </div>

            <div class="mt-5">
                <label for="body"></label>
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
                <label for="file-upload" class="inline-block font-medium text-[#3b5998] my-4 px-1">Выбрать изображение для публикации</label>
                <input
                    id="file-upload"
                    type="file"
                    name="image"
                    accept="image/*" class="text-[#3b5998] ml-1" required>
                <div class="text-purple-700 mt-2">
                    <?=FunctionController::oldInput('image-error')?>
                </div>

                <div class="flex justify-end sm:me-4 me-2">
                    <button class="clear-form text-white justify-center mt-8 bg-[#983b61] hover:bg-[#983b61]/90 focus:ring-4 focus:outline-none focus:ring-[#983b61]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mr-2 mb-2 duration-100">Очистить форму</button>
                </div>
                <input
                    type="submit"
                    name="create-post"
                    value="Создать"
                    class="text-white min-w-full justify-center mt-8 mr-2 mb-2 py-2.5 bg-[#0e5386] hover:bg-[#0e5386]/90 focus:ring-4 focus:outline-none focus:ring-[#0e5386]/50 font-medium rounded-lg text-sm text-center inline-flex items-center dark:focus:ring-[#3b5998]/55 duration-100">
            </div>
        </form>
    </div>
</div>