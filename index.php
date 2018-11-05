<?php
require_once 'util.php';
require_once 'Database.php';
require_once 'ProLang.php';

$database = new Database("pro_lang.txt");
$pro_langs = $database->read();
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>The HTML5 Herald</title>
    <meta name="description" content="The HTML5 Herald">
    <meta name="author" content="SitePoint">
    <link rel="stylesheet" href="bulma.min.css">
</head>

<body>

<header>
    <div>
        <nav class="navbar is-link" role="navigation" aria-label="main navigation" style="margin-bottom: 0;border-radius: 0; background-color: #3F51B5">
        </nav>
    </div>
</header>

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
                        <?php foreach($pro_lang->getMembers() as $member) : ?>
                            <td>
                                <?php echo($member) ;?>
                            </td>
                        <?php endforeach; ?>
                        <?php echo("<td><a href='index.php?id=".$pro_lang->getId()."'>削除</a></td>"); ?>
                        <?php echo("<td><a href='update.php?id=".$pro_lang->getId()."'>修正</a></td>"); ?>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </main>
    <!-- Search -->

    <!--/ Footer -->
    <my-footer></my-footer>
    <!-- Footer /-->

</div>

</body>
</html>
