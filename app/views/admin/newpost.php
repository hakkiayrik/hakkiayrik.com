<script src="/hakkiayrik/dist/ckeditor/ckeditor.js"></script>
<script src="/hakkiayrik/dist/ckeditor/samples/js/sample.js"></script>
<link rel="stylesheet" href="/hakkiayrik/dist/ckeditor/samples/css/samples.css">
<link rel="stylesheet" href="/hakkiayrik/dist/ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.css">

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?php echo $title ?><h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<form action="?url=admin/newpostform" method="post">
    <div class="row">
        <div class="col-sm-6 col-xs-12">
            <div class="form-group">
                <label>Yazı başlığı</label>
                <input class="form-control" name="data[title]">
                <p class="help-block">Maksimum 250 karakter girebilirsiniz.</p>
            </div>
            <div class="form-group">
                <label>Kategori seç</label>
                <select multiple="multiple" class="form-control" style="height: 110px;" name="data[cat_ids][]">
                    <?php foreach ($categories as $category): ?>
                    <option value="<?php echo $category['id'] ?>"><?php echo $category['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="sehir" style="display: block">Etiketler</label>
                <input type="hidden" name="data[tag_values]" value="" data-role="tagsinput" class="form-control" />
            </div>
        </div>
        <div class="col-sm-6 col-xs-12">
            <div class="form-group">
                <label>Yazı başlık resmi</label>
                <input class="form-control" type='file' id="imgInp" name="data[image_path]" />
            </div>
            <div class="form-group">
                <img alt="500x260" data-src="http://via.placeholder.com/500x255" id="blah" class="img-thumbnail" src="http://via.placeholder.com/500x255" data-holder-rendered="true" style="width: 500px; height: 255px;">
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <textarea cols="150" id="editor1" name="data[content]" rows="100"></textarea>
            </div>
        </div>
    </div>

    <input type="hidden" value="1" name="data[user_id]"/>
    <div class="row">
        <div class="col-xs-12">
            <div class="form-group text-right">
                <button class="btn btn-primary" name="data[save_btn]" type="submit">Kaydet</button>
            </div>
        </div>
    </div>
</form>
<script>
    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#blah').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imgInp").change(function() {
        readURL(this);
    });

    CKEDITOR.replace( 'editor1', {
        language: 'tr',
        uiColor: '#f1f1f1'
    });
</script>
<script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>