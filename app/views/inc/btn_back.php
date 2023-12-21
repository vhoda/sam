<div class="container text-center" style="padding-top: 15px;">
    <div class="text-center">
    <div class="mb-3 text-center">
    <a href="<?=$_SERVER["HTTP_REFERER"]?>" class="btn btn-success"><i class="bi bi-arrow-bar-left"></i> Regresar atrás</a>
    <script type="text/javascript">
    let btn_back = document.querySelector(".btn-back");

    btn_back.addEventListener('click', function(e){
        e.preventDefault();
        window.history.back();
    });
</script>