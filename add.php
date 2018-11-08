<?php
require_once 'util.php';
require_once 'Database.php';
require_once 'ProLang.php';

$database = new Database("pro_lang.txt");

if (isset($_POST['btnAdd'])){
    $name=$_POST['name'];
    $writer=$_POST['writer'];
    $developer=$_POST['developer'];
    $extension=$_POST['extension'];
    $like=$_POST['like'];
    $comment=$_POST['comment'];

    $database->add(new ProLang(0,$name,$writer,$developer,$extension,$like,$comment));

    echo "<script>window.alert('ADD OK');</script>";
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
    <main class="columns is-centered" style="margin-top: 20px;">
        <form method="POST">
            <div class="field">
                <label><b>名前</b></label>
                    <input class="input is-info" style="width: 200px; margin-left: 30px" type="text" placeholder="名前入力" name ="name">
            </div>

            <div class="field">
                <label class="label">著者</label>
                <div class="control">
                    <input class="input is-info" type="text" placeholder="著者入力" name ="writer">
                </div>
            </div>

            <div class="field">
                <label class="label">開発者</label>
                <div class="control">
                    <input class="input is-info" type="text" placeholder="開発者入力" name ="developer">
                </div>
            </div>

            <div class="field">
                <label class="label">拡張子</label>
                <div class="control">
                    <input class="input is-info" type="text" placeholder="拡張子入力" name ="extension">
                </div>
            </div>

            <div class="field" style="width: 200px;">
                <label class="label">好き度</label>
                <div class="control">
                    <div class="select is-info">
                        <select style="width: 210px;" name="like">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="field">
                <label class="label">コメント</label>
                <div class="control">
                    <textarea class="textarea is-info" placeholder="コメント入力" name ="comment"></textarea>
                </div>
            </div>

            <input class="button is-link" style="width: 200px;" type="submit" name="btnAdd" value="Add">
        </form>
    </main>
    <!-- Search -->

    <?php (require "./components/footer.html"); ?>

</div>
?>
</body>
</html>
