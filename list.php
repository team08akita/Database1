<?php
    require_once 'util.php';
    require_once 'Database.php';
    require_once 'ProLang.php';

    $database = new Database("pro_lang.txt");

    if ((isset($_GET['id']))) {
        $deleteId = $_GET['id'];
        $database->delete($deleteId);
        echo "<script>setTimeout(()=>{swal(`Delete!`, `YOU DELETED IT!`, `error`)}, 300);</script>";
    }

    $pro_langs = $database->read();
    $title = "ProDict-List";

?>

<!DOCTYPE HTML>
<html lang="ja">
<?php (require "./components/meta.php"); ?>
<body>
    <?php (require "./components/nav.html"); ?>
    <div>
        <section class="container">
            <h1 style="margin-bottom: 30px;">
                ProDict
            </h1>

            <div class="card-columns">
                <?php foreach ($pro_langs

                               as $pro_lang): ?>
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
                            <a class="btn btn-danger " href="list.php?id=<?php echo es($pro_lang->getId()); ?>"
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
    </div>

    </div>
    <?php (require "./components/footer.html"); ?>
</body>
</html>
