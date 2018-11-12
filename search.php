<?php
require_once 'util.php';
require_once 'Database.php';
require_once 'ProLang.php';

$database = new Database("pro_lang.txt");
$pro_langs = array();
$searchArray = array();
$keyword = "";
$ckbNameChecked = 0;
$ckbWriterChecked = 0;
$ckbDeveloperChecked = 0;
$ckbLikeChecked = 0;
$ckbCommentChecked = 0;
$ckbExtensionChecked = 0;
$isSearch = 0;
$isShowAll = 0;

if ((isset($_GET['id']))) {
    $deleteId = $_GET['id'];
    $database->delete($deleteId);
}

if (isset($_GET['btnSearch'])) {
    $isSearch = 1;
    if (isset($_GET['ckbName'])) {
        $ckbNameChecked = 1;
        array_push($searchArray, "Name");
    }
    if (isset($_GET['ckbWriter'])) {
        $ckbWriterChecked = 1;
        array_push($searchArray, "Writer");
    }
    if (isset($_GET['ckbDeveloper'])) {
        $ckbDeveloperChecked = 1;
        array_push($searchArray, "Developer");
    }
    if (isset($_GET['ckbLike'])) {
        $ckbLikeChecked = 1;
        array_push($searchArray, "Like");
    }
    if (isset($_GET['ckbComment'])) {
        $ckbCommentChecked = 1;
        array_push($searchArray, "Comment");
    }
    if (isset($_GET['ckbExtension'])) {
        $ckbExtensionChecked = 1;
        array_push($searchArray, "Extension");
    }

    //echo getlink($searchArray,1,0);
    $keyword = $_GET['keyword'];
    $pro_langs = $database->search($searchArray, $keyword);
} else if ((isset($_GET['btnShowAll']))) {
    $isShowAll = 1;
    $pro_langs = $database->read();
}

//if ((isset($_POST['btnSearch']))) {
//    if (isset($_POST['search'])) $searchArray = $_POST['search'];
//    $keyword = $_POST['keyword'];
//    $pro_langs = $database->search($searchArray, $keyword);
//} else if ((isset($_POST['btnShowAll']))) {
//    $pro_langs = $database->read();
//}


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
    <form method="get">
        <div class="field" style="width: 500px;margin: 20px auto;">
            <div class="control">
                <input style="width: 500px; height: 50px;" class="input is-medium" type="text" placeholder="キーワード入力"
                       value="<?php echo $keyword ?>" name="keyword">

            </div>

            <div class="field" style="margin-top: 10px">
                    <label class="checkbox">
                        <input type="checkbox" name="ckbName"
                               value="Name" <?php if ($ckbNameChecked === 1) echo 'checked="checked"' ?>>
                        名前
                    </label>

                    <label class="checkbox">
                        <input type="checkbox" name="ckbWriter" value="Writer"
                               style="margin-left: 20px" <?php if ($ckbWriterChecked === 1) echo 'checked="checked"' ?>>
                        著者
                    </label>

                <label class="checkbox">
                    <input type="checkbox" name="ckbDeveloper" value="Developer"
                           style="margin-left: 20px" <?php if ($ckbDeveloperChecked === 1) echo 'checked="checked"' ?>>
                    開発者
                </label>

                <label class="checkbox">
                    <input type="checkbox" name="ckbExtension" value="Extension"
                           style="margin-left: 20px" <?php if ($ckbExtensionChecked === 1) echo 'checked="checked"' ?>>
                    拡張子
                </label>

                <label class="checkbox">
                    <input type="checkbox" name="ckbLike" value="Like"
                           style="margin-left: 20px" <?php if ($ckbLikeChecked === 1) echo 'checked="checked"' ?>>
                    好き度
                </label>

                <label class="checkbox">
                    <input type="checkbox" name="ckbComment" value="Comment"
                           style="margin-left: 20px" <?php if ($ckbCommentChecked === 1) echo 'checked="checked"' ?>>
                    コメント
                </label>

                <br>
                <div style="margin-top: 20px">
                    <input type="submit" style="height: 50px; width: 200px; margin-left: 20px"
                           class="button is-link" value="検索" name="btnSearch">
                    <input type="submit" style="height: 50px; width: 200px; margin-left: 50px" class="button is-link"
                           value="全て表示"
                           name="btnShowAll">
                </div>
            </div>
        </div>
    </form>

    <main class="columns is-centered" style="margin-top: 20px;">
        <div class="column is-three-quarters">
            <table class="table is-striped is-centered" <?php if (count($pro_langs) == 0) echo 'style="visibility: hidden;"' ?>>
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
                        <?php echo("<td><a href='search.php?id=" . $pro_lang->getId() . "&" . getlink($searchArray, $isSearch, $isShowAll) . "'>削除</a></td>"); ?>
                        <?php echo("<td><a href='update.php?id=" . $pro_lang->getId() . "'>修正</a></td>"); ?>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </main>
    <!-- Search -->

    <?php (require "./components/footer.html"); ?>

</div>
</body>
</html>
