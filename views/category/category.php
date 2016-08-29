<?php include ROOT . '/views/layouts/header.php'; ?>

<!-- MAIN -->
<div id="main">
    <!-- wrapper-main -->
    <div class="wrapper">

        <!-- filter -->
        <ul class="tags">
            <li><span>Категории</span></li>

            <li><a href="#" > All </a></li>
            <?php foreach ($categoriesList as $value) : ?>

                <li class="<?php if ($categoryId == $value['id']) echo 'active'; ?>"><a href="/category/<?php echo $value['url']; ?>">                                                                                    
                        <?php echo $value['name']; ?>
                    </a></li>
            <?php endforeach; ?>
        </ul>		
        <!-- ENDS filter -->

        <!-- search -->
        <div class="top-search">
            <form  method="get" id="searchform" action="#">
                <div>
                    <input type="text" value="Search..." name="s" id="s" onfocus="defaultInput(this, 'Search...')" onblur="clearInput(this, 'Search...')" />
                    <input type="submit" id="searchsubmit" value=" " />
                </div>
            </form>
        </div>
        <!-- ENDS search -->

        <!-- Posts -->
        <div>
            <ul class="blocks-thumbs">
                <?php foreach ($categoryArticles as $value) : ?>
                    <li>
                        <span class="imgPreview">
                            <a href="/article/<?php echo $value['url']; ?>" class="thumb"><img class="imgthumb" src="<?php echo $value['image']; ?>" alt="<?php echo $value['name']; ?>" /></a>
                        </span>	
                        <div class="excerpt">
                            <a href="/article/<?php echo $value['url']; ?>" class="header"><?php echo $value['name']; ?></a>
                            <a href="/article/<?php echo $value['url']; ?>" class="text"><?php echo substr($value['full_text'], 0, 300); ?>...</a>

                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>

            <!-- pager -->	
            <?php echo $pagination->get(); ?>

            <div class="clear"></div>
            <!-- ENDS pager -->


        </div>
        <!-- ENDS posts -->

        <div class="clear"></div>
    </div>
    <!-- ENDS wrapper-main -->
</div>
<!-- ENDS MAIN -->

<?php include ROOT . '/views/layouts/footer.php'; ?>