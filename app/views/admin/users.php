<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?php echo $title ?><h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <div class="panel-body">
    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-users">
        <thead>
        <tr>
            <th>Kullanıcı Adı</th>
            <th>Adı</th>
            <th>Soyadı</th>
            <th>Yorum Sayısı</th>
            <th>Son Giriş Tarihi</th>
            <th>Durum</th>
            <th data-orderable="false">İşlem</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user){ ?>
        <tr class="gradeA">
            <td><?php echo $user['user_name'] ?></td>
            <td><?php echo $user['name'] ?></td>
            <td><?php echo $user['surname'] ?></td>
            <td class="center">0</td>
            <td class="center">01:01 01/01/2001</td>
            <td style="color:<?= $user['status'] == 1 ? 'green' : 'indianred' ?>"><i class="fa fa-circle"></i> <?= $user['status'] == 1 ? 'Aktif' : 'Pasif' ?></td>
            <td><a href="?url=admin/updateuser/<?php echo $user['id'] ?>/<?= $user['status'] == 1 ? 0 : 1 ?>" class="btn btn-<?= $user['status'] == 1 ? 'danger' : 'success' ?>"><?= $user['status'] == 1 ? 'Pasif Et' : 'Aktif Et' ?></a></td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
    </div>
</div>

<!-- DataTables JavaScript -->
<script src="/hakkiayrik/dist/vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="/hakkiayrik/dist/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
<script src="/hakkiayrik/dist/vendor/datatables-responsive/dataTables.responsive.js"></script>

<script>
    $(document).ready(function() {
        $('#dataTables-users').DataTable({
            responsive: true
        });
    });
</script>