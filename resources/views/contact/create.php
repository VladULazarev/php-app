<?php use App\Http\Controllers\FunctionController;?>
<h1 class="xl:mt-24 mt-16 mb-10 sm:ml-8 ml-4 text-2xl font-semibold"><span class="text-[#fbbc05]">К</span>онтакты</h1>

<div class="mb-24 w-full mx-auto">
    <div class="grid md:grid-cols-2 gap-8 sm:px-4">

        <div class="md:col-span-1 px-3">
        <form action="/create-contact" method="POST">

            <div class="px-1">
                <label for="name"></label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    placeholder="Имя"
                    value="<?=FunctionController::oldInput('name')?>"
                    maxlength="50"
                    autocomplete="off"
                    required
                    class="w-full border-b border-b-[#3b5998]/30 focus:border-b-[#494798] text-md block p-2 cursor-pointer">
                <div class="text-purple-700 pl-2 mt-2 break-words">
                    <?=FunctionController::oldInput('name-error')?>
                </div>
            </div>

            <div class="mt-5 px-1">
                <label for="email"></label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="Email"
                    value="<?=FunctionController::oldInput('email')?>"
                    maxlength="50"
                    autocomplete="off"
                    required
                    class="w-full border-b border-b-[#3b5998]/30 focus:border-b-[#494798] text-md block p-2 cursor-pointer">
                <div class="text-purple-700 pl-2 mt-2 break-words">
                    <?=FunctionController::oldInput('email-error')?>
                </div>
            </div>

            <div class="mt-5 px-1">
                <label for="message"></label>
                <textarea
                    type="text"
                    id="message"
                    name="message"
                    placeholder="Ваше сообщение"
                    maxlength="300"
                    autocomplete="off"
                    required
                    class="border-b border-b-[#3b5998]/30 focus:border-b-[#494798] text-md block w-full p-2 cursor-pointer"><?=FunctionController::oldInput('message')?></textarea>
                <div class="text-purple-700 pl-2 mt-2 break-words">
                    <?=FunctionController::oldInput('message-error')?>
                </div>
            </div>

            <input
                type="submit"
                name="create-message"
                value="Отправить сообщение"
                class="text-white w-full justify-center mt-8 mr-2 mb-2 bg-[#0e5386] hover:bg-[#0e5386]/90 focus:ring-4 focus:outline-none focus:ring-[#3b5998]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center duration-100">

        </form>
        </div>

        <div class="md:col-span-1 mb-4 py-2 px-4">
            <dl class="">
                <div class="flex flex-col pb-3">
                    <dt class="mb-1 md:text-lg">Email</dt>
                    <dd class="text-lg font-semibold text-[#3b5998] md:hover:text-[#494798]">
                        <a href="mailto:info@company.com">
                            info@company.com
                        </a>
                    </dd>
                </div>
                <div class="flex flex-col py-7">
                    <dt class="mb-1 md:text-lg">Адрес</dt>
                    <dd class="text-lg font-semibold text-[#3b5998]">
                        92 Miles Drive, Newark, NJ 07103, California, USA
                    </dd>
                </div>
                <div class="flex flex-col pt-3">
                    <dt class="mb-1 md:text-lg">Телефон</dt>
                    <dd class="text-lg font-semibold text-[#3b5998] md:hover:text-[#494798]">
                        <a href="tel:090-484-8080">
                            090-484-8080
                        </a>
                    </dd>
                </div>
            </dl>
        </div>
    </div>
    <div id="map" class="mt-24 mb-24">
        <iframe src="https://maps.google.com/maps?q=Av.+L%C3%BAcio+Costa,+Rio+de+Janeiro+-+RJ,+Brazil&t=&z=13&ie=UTF8&iwloc=&output=embed" width="100%" height="450px" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>
</div>


