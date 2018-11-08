<?php
require_once 'util.php';
require_once 'Database.php';
require_once 'ProLang.php';

$database = new Database("pro_lang.txt");
$pro_langs=array();
$searchArray=array();
$keyword="";

if ((isset($_POST['btnSearch']))) {
    if (isset($_POST['search'])) $searchArray = $_POST['search'];
    $keyword=$_POST['keyword'];
    $pro_langs = $database->search($searchArray,$keyword);
}


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
    <form method="post">
        <div class="field" style="width: 500px;margin: 20px auto;">
            <div class="control">
                <input style="width: 400px; height: 50px;" class="input is-medium" type="text" placeholder="キーワード入力" value="<?php echo $keyword?>" name="keyword">
                <input type="submit" style="height: 50px; width: 90px" class="button is-link" value="検索" name="btnSearch">
            </div>

            <div class="field" style="margin-top: 10px">
                <label class="checkbox">
                    <input type="checkbox" name="search[]" value="Name">
                    名前
                </label>

                <label class="checkbox">
                    <input type="checkbox" name="search[]" value="Writer">
                    著者
                </label>

                <label class="checkbox">
                    <input type="checkbox" name="search[]" value="Developer">
                    開発者
                </label>

                <label class="checkbox">
                    <input type="checkbox" name="search[]" value="Extension">
                    拡張子
                </label>

                <label class="checkbox">
                    <input type="checkbox" name="search[]" value="Like">
                    好き度
                </label>

                <label class="checkbox">
                    <input type="checkbox" name="search[]" value="Comment">
                    コメント
                </label>
            </div>
        </div>
    </form>

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
