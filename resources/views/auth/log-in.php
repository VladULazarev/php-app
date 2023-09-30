<?php use App\Http\Controllers\FunctionController;
if (FunctionController::isAuthenticated()){FunctionController::redirect('/');}
    // $_SESSION['get-back-uri'] - чтобы перенаправить пользователя после страницы
    // '/log-in' на ту страницу, с которой он пришел (см. 'app/Models/User::login())
    $_SESSION['get-back-uri'] = $_SESSION['previous_uri'];
?>
<div class="h-screen flex items-center justify-center">
    <div class="mx-auto md:min-w-[500px] md:max-w-[500px] min-w-full px-4">

        <form action="/login-user" method="post">

            <div>
                <label for="login-password"></label>
                <input
                    type="password"
                    id="login-password"
                    name="password"
                    placeholder="Пароль"
                    maxlength="8"
                    required
                    class="max-w-[500px] border-b border-b-[#3b5998]/30 focus:border-b-[#494798] text-md block w-full p-2 cursor-pointer">
                <div class="text-purple-700 pl-2 mt-4 break-words">
                    <?=FunctionController::oldInput('login-error')?>
                </div>
            </div>

            <input
                type="submit"
                name="login"
                value="Войти"
                class="text-white min-w-full justify-center mt-8 mr-2 mb-2 bg-[#0e5386] hover:bg-[#0e5386]/90 focus:ring-4 focus:outline-none focus:ring-[#0e5386]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center duration-100">
        </form>

        <div class="font-medium mt-8">
            <a href="/register" class="block text-[#294d6a] md:hover:text-[#494798] duration-100 py-2">
                Зарегистрироваться
            </a>
        </div>

    </div>
</div>