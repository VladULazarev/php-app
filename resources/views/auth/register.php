<?php use App\Http\Controllers\FunctionController;
if(FunctionController::isAuthenticated()){FunctionController::redirect('/');}?>
<div class="h-screen flex items-center justify-center">
    <div class="mx-auto md:min-w-[500px] md:max-w-[500px] min-w-full px-4">

        <form action="/register-user" method="POST">

            <div>
                <label for="name"></label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    placeholder="Login"
                    maxlength="10"
                    autocomplete="off"
                    required
                    class="max-w-[500px] border-b border-b-[#3b5998]/30 focus:border-b-[#494798] text-md block w-full p-2 cursor-pointer">
            </div>

            <div class="mt-8 mb-2">
                <label for="login-password"></label>
                <input
                    type="password"
                    id="login-password"
                    name="password"
                    placeholder="Пароль"
                    maxlength="8"
                    required
                    class="max-w-[500px] border-b border-b-[#3b5998]/30 focus:border-b-[#494798] text-md block w-full p-2 cursor-pointer">
            </div>

            <div class="mt-8 mb-2">
                <label for="confirm-password"></label>
                <input
                    type="password"
                    id="confirm-password"
                    name="confirm-password"
                    placeholder="Подтвердите пароль"
                    maxlength="8"
                    required
                    class="max-w-[500px] border-b border-b-[#3b5998]/30 focus:border-b-[#494798] text-md block w-full p-2 cursor-pointer">
            </div>

            <div class="text-purple-700 pl-2 mt-4 break-words">
                <?=FunctionController::oldInput('register-error')?>
            </div>

            <input
                type="submit"
                name="register"
                value="Зарегистрироваться"
                class="text-white min-w-full justify-center mt-8 mr-2 mb-2 bg-[#0e5386] hover:bg-[#0e5386]/90 focus:ring-4 focus:outline-none focus:ring-[#0e5386]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center duration-100">
        </form>
    </div>
</div>



