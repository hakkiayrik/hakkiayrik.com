<?php require VDIR.'/header.php' ?>

<?php foreach ($users as $user): ?>
    <article>
        <h2><a href="?url=default/post/<?= $user['id'] ?>"><?= $user['name'] ?></a></h2>
        <p><?= $user['name'] ?></p>
        <p>
            <!--<?php //foreach (explode(',', $user['tags']) as $tag): ?>
                <a href="?url=default/tag/<?//= $tag ?>" class="btn btn-link btn-sm"><?//= $tag ?></a>
            <?php //endforeach ?> -->
        </p>
    </article>
    <hr>
<?php endforeach ?>

<?php require VDIR.'/footer.php' ?>