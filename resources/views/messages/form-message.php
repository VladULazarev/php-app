<div class="flex items-center justify-center mt-48 mb-36">
    <h1 class="text-2xl font-semibold flex justify-center px-4">
        <?php if (isset($_SESSION['form-message'])) {
            echo $_SESSION['form-message'];
            unset($_SESSION['form-message']);
        } else { echo "<script>window.location.href = '/'</script>"; }?>
    </h1>
</div>