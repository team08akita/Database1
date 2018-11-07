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
    ?>

<div class="notification is-primary">
    <button class="delete"></button>
   OK
</div>

<?php
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
                <label class="label">名前</label>
                <div class="control">
                    <input class="input is-info" type="text" placeholder="名前入力" name ="name">
                </div>
            </div>

            <div class="field">
                <label class="label">著者</label>
                <div class="control">
                    <input class="input is-info" type="text" placeholder="著者入力" name ="writer">
                </div>
            </div>


            <span style="width: 100px">開発者:</span>
            <input type="text" name="developer">
            <br>
            <span style="width: 100px">拡張子:</span>
            <input type="text" name="extension">
            <br>
            <span style="width: 100px">好き度:</span>
            <input type="text" name="like">
            <br>
            <span style="width: 100px">コメント:</span>
            <input type="text" name="comment">
            <br>
            <input type="submit" name="btnAdd" value="Add">
        </form>
    </main>
    <!-- Search -->

    <?php (require "./components/footer.html"); ?>

</div>
?>
</body>
</html>
