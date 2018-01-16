<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?php echo $title ?><h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-post">
        <thead>
        <tr>
            <th width="40%">Başlık</th>
            <!--<th>Yazılma Tarihi</th>
            <th>Güncellenme Tarihi</th>-->
            <th width="10%">Beğeni</th>
            <th width="10%">Yorum</th>
            <th width="15%">Kategoriler</th>
            <th width="15%">Etiketler</th>
            <th width="10%">Durum</th>
            <th width="5%" data-orderable="false">İşlem</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($posts as $post){ ?>
            <tr class="gradeA">
                <td><?php echo $post['title'] ?></td>
                <!--<td><?php //echo $post['create_at'] ?></td>
                <td><?php //echo $post['update_at'] ?></td>-->
                <td class="center"><?php echo $post['like_count'] ?></td>
                <td class="center">0</td>
                <td><?php echo $post['cat_ids'] ?></td>
                <td><?php echo $post['tag_ids'] ?></td>
                <td style="color:<?= $post['status'] == 1 ? 'green' : 'indianred' ?>"><i class="fa fa-circle"></i> <?= $post['status'] == 1 ? 'Aktif' : 'Pasif' ?></td>
                <td><a href="?url=admin/updatepost/<?php echo $post['id'] ?>/<?= $post['status'] == 1 ? 0 : 1 ?>" class="btn btn-<?= $post['status'] == 1 ? 'danger' : 'success' ?>"><?= $post['status'] == 1 ? 'Pasif Et' : 'Aktif Et' ?></a></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<!-- DataTables JavaScript -->
<script src="/hakkiayrik/dist/vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="/hakkiayrik/dist/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
<script src="/hakkiayrik/dist/vendor/datatables-responsive/dataTables.responsive.js"></script>

<script>
    $(document).ready(function() {
        $('#dataTables-post').DataTable({
            responsive: true
        });
    });
</script>