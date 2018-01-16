<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?php echo $title ?><h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <textarea class="form-control error_log" disabled rows="30">
        <?php echo Tools::getLog(); ?>
    </textarea>
</div>