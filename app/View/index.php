<?= $this->extends("layout"); ?>

<?= $this->block("layout"); ?>
<div class="container mx-auto w-1/2 mt-28 text-center">
    <h1 class="text-6xl font-bold bg-gradient-to-r box-shadow-sm from-sky-700 to-teal-100 text-transparent bg-clip-text">
        FluxPHP</h1>
    <p class="text-3xl bg-gradient-to-r box-shadow-sm from-sky-700 to-teal-100 text-transparent bg-clip-text sm:text-1xl">
        A PHP MVC Framework</p>
</div>
<?= $this->endBlock(); ?>