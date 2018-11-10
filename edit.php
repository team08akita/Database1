<?php
    require_once 'util.php';
    require_once 'Database.php';
    require_once 'ProLang.php';

    $database = new Database("pro_lang.txt");

    $pro_lang = null;
    $pro_langs = $database->read();

    //不正アクセス リストへ
    if (!isset($_GET['id'])) {
        http_response_code(301);
        header("Location: ./list.php");
    } else {
        for ($i = 0, $len = count($pro_langs); $i < $len; $i++) {
            if ($pro_langs[$i]->getId() == $_GET['id']) {
                $pro_lang = $pro_langs[$i];
            }
        }
    }

    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $writer = $_POST['writer'];
        $developer = $_POST['developer'];
        $extension = $_POST['extension'];
        $like = $_POST['like'];
        $comment = $_POST['comment'];

        $database->add(new ProLang(0, $name, $writer, $developer, $extension, $like, $comment));

        echo "<script>setTimeout(()=>{swal(`Post Completed!`, `Thank you, " . $writer . ".`, `success`)}, 300);</script>";
    }
    $title = "ProDict-edit";

?>

<!DOCTYPE HTML>
<html lang="ja">
<?php (require "./components/meta.php"); ?>
<body>
    <?php (require "./components/nav.html"); ?>
    <div>

        <section class="container">
            <div class="container">
                <div class="card bg-dark text-white">
                    <div class="card-body">
                        <h3 class="card-title" style="color: #FFC406;">編集フォーム</h3>
                        <form method="POST" action="add.php">
                            <div class="form-group">
                                <label class="control-label">言語名</label>
                                <input class="form-control" type="text" placeholder="ex) c++" name="name" value="<?php echo($pro_lang->getName()); ?>" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label">あなたの名前</label>
                                <input class="form-control" type="text" placeholder="ex) ganariya" name="writer"
                                       value="<?php echo($pro_lang->getWriter()); ?>"   required>
                            </div>
                            <div class="form-group">
                                <label class="control-label">開発者数</label>
                                <input class="form-control" type="number" placeholder="ex) 100000" name="developer"
                                       value="<?php echo(intval($pro_lang->getDeveloper())); ?>"    required>
                            </div>
                            <div class="form-group">
                                <label class="control-label">拡張子</label>
                                <input class="form-control" type="text" placeholder="ex) cpp" name="extension" value="<?php echo($pro_lang->getExtension()); ?>"  required>
                            </div>
                            <div class="form-group">
                                <label class="control-label">好き度</label>
                                <select class="form-control" name="like">
                                    <option value="1">1(大嫌い)</option>
                                    <option value="2">2(使いたくはない)</option>
                                    <option value="3" selected>3(普通)</option>
                                    <option value="4">4(使いたい)</option>
                                    <option value="5">5(大好き)</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">コメント</label>
                                <textarea class="form-control" placeholder="ex) I Love it!" name="comment"
                                              required><?php echo($pro_lang->getComment()); ?></textarea>
                            </div>
                            <input type="submit" value="送信" class="btn btn-danger" name="submit">
                        </form>
                    </div>
                </div>
            </div>
        </section>


        <?php (require "./components/footer.html"); ?>

    </div>
</body>
</html>
