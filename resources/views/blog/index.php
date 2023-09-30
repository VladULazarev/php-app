<div class="container max-w-[1140px] mx-auto mb-24">
    <h1 class="xl:mt-20 mt-16 mb-10 ml-4 text-2xl font-semibold"><span class="text-[#34a853]">Б</span>лог</h1>
    <div class="grid md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-8 sm:px-4">

        <?php foreach($data['posts'] as $post): ?>
        <div class="click-me group mb-4 py-2 rounded-md shadow-md overflow-hidden cursor-pointer" data-value="/blog/<?=$post->slug?>">

            <img width="600" height="400"
                src="/public/uploads/blog/<?=$post->id?>/<?=$post->img_path?>"
                class="mb-8 w-full duration-500 delay-50 transform group-hover:scale-105"
                alt="<?=htmlentities($post->title)?>">

            <div class="px-6">
                <h3 class="font-normal text-2xl text-[#3b5998] mb-2">
                    <?=htmlentities($post->title)?>
                </h3>
                <div class="text-[#3b5998]/50 font-semibold text-sm mb-6 pb-6 border-b"><?=Carbon\Carbon::parse($post->created_at)->isoFormat('D MMMM Y г.')?></div>
                <p class="text-md leading-6 font-normal mb-4">
                    <?=htmlentities($post->excerpt)?>
                </p>
            </div>

        </div>
        <?php endforeach; ?>
    </div>
</div>