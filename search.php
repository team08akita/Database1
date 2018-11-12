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

function getlink($types, $isSearch, $isShowAll)
{
    $result = "";

    foreach ($types as $s => $type) {
        $result = $result . "ckb" . $type . "=1&";
    }

    if ($isSearch === 1) $result = $result . "btnSearch=1";
    else if ($isShowAll === 1) $result = $result . "btnShowAll=1";

    return $result;
}

if ((isset($_GET['id']))) {
    $deleteId = $_GET['id'];
    $database->delete($deleteId);
    echo "<script>setTimeout(()=>{swal(`Delete!`, `YOU DELETED IT!`, `error`)}, 300);</script>";
}

if (isset($_GET['btnSearch']) && strlen($_GET['keyword']) != 0) {

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

    $keyword = $_GET['keyword'];
    $pro_langs = $database->search($searchArray, $keyword);

    if (count($pro_langs) == 0) echo "<script>setTimeout(()=>{swal(`Sorry`, `Nothing...`, `info`)}, 300);</script>";


} else if ((isset($_GET['btnShowAll']))) {
    $isShowAll = 1;
    $pro_langs = $database->read();
}

$title = "プログラミング言語辞典";

?>

<!DOCTYPE HTML>
<html lang="ja">
<?php (require "./components/meta.php"); ?>
<body>
<?php (require "./components/nav.html"); ?>

<div>

    <section class="container" style="margin-bottom: -140px;">
        <div class="row center-block">
            <form method="GET" action="search.php" class="col-8 mx-auto">
                <div class="form-group">
                    <input class="form-control" type="text" placeholder="keyword" name="keyword"
                           value="<?php echo es($keyword); ?>">
                </div>
                <div class="form-group mx-auto">
                    <label class="checkbox-inline"><input type="checkbox"
                                                          name="ckbName" <?php if ($ckbNameChecked === 1) echo 'checked="checked"' ?>>言語名</label>
                    <label class="checkbox-inline" style="margin-left: 16px;"><input type="checkbox"
                                                                                     name="ckbWriter" <?php if ($ckbWriterChecked === 1) echo 'checked="checked"' ?>>ユーザ名</label>
                    <label class="checkbox-inline" style="margin-left: 16px;"><input type="checkbox"
                                                                                     name="ckbDeveloper" <?php if ($ckbDeveloperChecked === 1) echo 'checked="checked"' ?>>開発者数</label>
                    <label class="checkbox-inline" style="margin-left: 16px;"><input type="checkbox"
                                                                                     name="ckbExtension" <?php if ($ckbExtensionChecked === 1) echo 'checked="checked"' ?>>拡張子</label>
                    <label class="checkbox-inline" style="margin-left: 16px;"><input type="checkbox"
                                                                                     name="ckbLike" <?php if ($ckbLikeChecked === 1) echo 'checked="checked"' ?>>好き度</label>
                    <label class="checkbox-inline" style="margin-left: 16px;"><input type="checkbox"
                                                                                     name="ckbComment" <?php if ($ckbCommentChecked === 1) echo 'checked="checked"' ?>>コメント</label>
                </div>
                <input type="submit" value="検索" class="btn btn-dark" name="btnSearch">
                <input type="submit" value="一覧表示" class="btn btn-dark" name="btnShowAll">
            </form>
        </div>
    </section>

    <?php if (count($pro_langs) > 0) : ?>
        <section class="container">
            <h1 style="margin-bottom: 30px;">
                ProDict
            </h1>
            <div class="card-columns">
                <?php foreach ($pro_langs as $pro_lang): ?>
                    <div class="card p-3 text-white bg-dark" style="max-width: 20rem;">
                        <div class="card-body">
                            <h3 class="card-title"
                                style="margin-bottom: 2px;"><?php echo es($pro_lang->getName()); ?></h3>
                            <div class="card-subtitle"
                                 style="text-align: right; margin-bottom: 5px;"><?php echo es($pro_lang->getWriter()); ?></div>
                            <table class="table ">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col" style="text-align: center">開発者数</th>
                                    <th scope="col" style="text-align: center">拡張子</th>
                                    <th scope="col" style="text-align: center">好き度</th>
                                </tr>
                                </thead>
                                <tbody class="bg-white">
                                <tr>
                                    <td scope="row" class="text-black-50"
                                        style="text-align: center"><?php echo es($pro_lang->getDeveloper()); ?></td>
                                    <td scope="row" class="text-black-50"
                                        style="text-align: center"><?php echo es($pro_lang->getExtension()); ?></td>
                                    <td scope="row" class="text-black-50"
                                        style="text-align: center"><?php echo es($pro_lang->getLike()); ?></td>
                                </tr>
                                </tbody>
                            </table>
                            <p class="card-text"><?php echo es($pro_lang->getComment()); ?></p>
                            <a class="btn btn-danger "
                               href="search.php?id=<?php echo es($pro_lang->getId()) . "&keyword=".es($keyword) ."&". es(getlink($searchArray, $isSearch, $isShowAll)); ?>"
                               role="button"><i
                                        class="icon-remove"></i> 削除</a>
                            <a class="btn" href="edit.php?id=<?php echo es($pro_lang->getId()); ?>" role="button"
                               style="background-color: #ffffff4a; color:white"><i
                                        class="icon-edit"></i> 編集</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endif; ?>

    <?php (require "./components/footer.html"); ?>

</div>
</body>
</html>