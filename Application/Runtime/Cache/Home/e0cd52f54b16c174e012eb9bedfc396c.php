<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/book\Application\Home\View\Store\css\peoplestorelist.css" media="screen" title="no title" charset="utf-8">
    <title>Document</title>
</head>

<body background="/book/Public\img\store.jpg">
    <h1 align="center">个人商品列表</h1>
    <section>
        <ul>
            <?php if(is_array($data)): foreach($data as $key=>$li): ?><li>
                    <a href="#"><img src="/book/Public/image/<?php echo ($li["image"]); ?>" alt="" />
                        <div class="delete">
                            <a href="<?php echo U('Home/Store/Delete',array('id'=>$li['goodsname'],'username'=>$li['username']));?>">删除</a>
                        </div>

                        <div class="desc">类型:<?php echo ($li["goodsname"]); ?></div>
                        <div class="desc">介绍:<?php echo ($li["introduce"]); ?></div>
                        <div class="money">价格:<?php echo ($li["price"]); ?></div>
                        <div class="desc">联系方式:<?php echo ($li["phone"]); ?></div>
                    </a>
                </li><?php endforeach; endif; ?>
        </ul>
    </section>
    <footer>
        &copy BY IMAX2017
    </footer>
</body>

</html>