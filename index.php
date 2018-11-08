<?php
require_once 'util.php';
require_once 'Database.php';
require_once 'ProLang.php';

$database = new Database("pro_lang.txt");

if ((isset($_GET['id']))) {
    $deleteId = $_GET['id'];
    $database->delete($deleteId);
}

$pro_langs = $database->read();
$title = "プログラミング言語辞典";

?>

<!DOCTYPE HTML>
<html lang="ja">
<?php (require "./components/meta.php"); ?>
<body>
<?php (require "./components/header.html"); ?>
<div>
    <section class="hero is-info">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    プログラミング辞典
                </h1>
                <h2 class="subtitle">
                    <p>現在改築中...</p>
                </h2>
            </div>
        </div>
    </section>
    <!-- Header /-->

    <!--/ Search -->
    <main class="columns is-centered" style="margin-top: 20px;">
        <div class="column is-three-quarters">
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>名前</th>
                    <th>著者</th>
                    <th>開発者</th>
                    <th>拡張子</th>
                    <th>好き度</th>
                    <th>コメント</th>
                    <th>削除</th>
                    <th>修正</th>
                </tr>
                </thead>
                <?php foreach ($pro_langs as $pro_lang): ?>
                    <tr>
                        <?php foreach ($pro_lang->getMembers() as $member) : ?>
                            <td>
                                <?php echo(es($member)); ?>
                            </td>
                        <?php endforeach; ?>
                        <?php echo("<td><a href='index.php?id=" . $pro_lang->getId() . "'>削除</a></td>"); ?>
                        <?php echo("<td><a href='update.php?id=" . $pro_lang->getId() . "'>修正</a></td>"); ?>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </main>
    <!-- Search -->

    <?php (require "./components/footer.html"); ?>

</div>
?>
</body>
</html>
