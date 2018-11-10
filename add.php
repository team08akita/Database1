<?php
    require_once 'util.php';
    require_once 'Database.php';
    require_once 'ProLang.php';

    $database = new Database("pro_lang.txt");

    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $writer = $_POST['writer'];
        $developer = $_POST['developer'];
        $extension = $_POST['extension'];
        $like = $_POST['like'];
        $comment = $_POST['comment'];

        $database->add(new ProLang(0, $name, $writer, $developer, $extension, $like, $comment));

        echo "<script>setTimeout(()=>{swal(`Post Completed!`, `Thank you, ".$writer.".`, `success`)}, 300);</script>";
    }
    $title = "ProDict-add";

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
                        <h3 class="card-title" style="color: #FFC406;">投稿フォーム</h3>
                        <form method="POST" action="add.php">
                            <div class="form-group">
                                <label class="control-label">言語名</label>
                                <input class="form-control" type="text" placeholder="ex) c++" name="name" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label">あなたの名前</label>
                                <input class="form-control" type="text" placeholder="ex) ganariya" name="writer"
                                       required>
                            </div>
                            <div class="form-group">
                                <label class="control-label">開発者数</label>
                                <input class="form-control" type="number" placeholder="ex) 100000" name="developer"
                                       required>
                            </div>
                            <div class="form-group">
                                <label class="control-label">拡張子</label>
                                <input class="form-control" type="text" placeholder="ex) cpp" name="extension" required>
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
                                          required></textarea>
                            </div>
                            <input type="submit" value="送信" class="btn btn-danger" name="submit">
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!--    <main class="columns is-centered" style="margin-top: 20px;">-->
        <!--        <form method="POST">-->
        <!--            <div class="field">-->
        <!--                <label><b>名前</b></label>-->
        <!--                    <input class="input is-info" style="width: 200px; margin-left: 30px" type="text" placeholder="名前入力" name ="name">-->
        <!--            </div>-->
        <!---->
        <!--            <div class="field">-->
        <!--                <label class="label">著者</label>-->
        <!--                <div class="control">-->
        <!--                    <input class="input is-info" type="text" placeholder="著者入力" name ="writer">-->
        <!--                </div>-->
        <!--            </div>-->
        <!---->
        <!--            <div class="field">-->
        <!--                <label class="label">開発者</label>-->
        <!--                <div class="control">-->
        <!--                    <input class="input is-info" type="text" placeholder="開発者入力" name ="developer">-->
        <!--                </div>-->
        <!--            </div>-->
        <!---->
        <!--            <div class="field">-->
        <!--                <label class="label">拡張子</label>-->
        <!--                <div class="control">-->
        <!--                    <input class="input is-info" type="text" placeholder="拡張子入力" name ="extension">-->
        <!--                </div>-->
        <!--            </div>-->
        <!---->
        <!--            <div class="field" style="width: 200px;">-->
        <!--                <label class="label">好き度</label>-->
        <!--                <div class="control">-->
        <!--                    <div class="select is-info">-->
        <!--                        <select style="width: 210px;" name="like">-->
        <!--                            <option>1</option>-->
        <!--                            <option>2</option>-->
        <!--                            <option>3</option>-->
        <!--                            <option>4</option>-->
        <!--                            <option>5</option>-->
        <!--                        </select>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--            </div>-->
        <!---->
        <!--            <div class="field">-->
        <!--                <label class="label">コメント</label>-->
        <!--                <div class="control">-->
        <!--                    <textarea class="textarea is-info" placeholder="コメント入力" name ="comment"></textarea>-->
        <!--                </div>-->
        <!--            </div>-->
        <!---->
        <!--            <input class="button is-link" style="width: 200px;" type="submit" name="btnAdd" value="Add">-->
        <!--        </form>-->
        <!--    </main>-->

        <?php (require "./components/footer.html"); ?>

    </div>
</body>
</html>
