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

                <li><a href="/category/<?php echo $value['url']; ?>"
                       class="<?php if ($value == $value['url']) echo 'active'; ?>"
                       >                                                                                    
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
        <!-- Content -->		
        <div class="content-col">

            <!-- content -->
            <div class="content">
                <div class="feature-holder"><img src="<?php echo $article['image']; ?>" width="620" height="300" alt="Image" class="attachment-post-thumbnail" /></div>
                <div class="padding">
                    <h3 class="p-title"><?php echo $article['name']; ?></h3>
                    <p><?php echo $article['full_text']; ?></p>



                </div>
            </div>
            <!-- ENDS content -->
            <!-- Project gallery -->
            <h3 class="s-title">Project gallery</h3>
            <ul class="project-gallery">
                <li><a href="img/dummies/620x300.gif" rel="prettyPhoto[group]"><img src="img/dummies/140x140.gif" alt="Pic"></a></li>
                <li><a href="img/dummies/620x300.gif" rel="prettyPhoto[group]"><img src="img/dummies/140x140.gif" alt="Pic"></a></li>
                <li><a href="img/dummies/620x300.gif" rel="prettyPhoto[group]"><img src="img/dummies/140x140.gif" alt="Pic"></a></li>
                <li><a href="img/dummies/620x300.gif" rel="prettyPhoto[group]"><img src="img/dummies/140x140.gif" alt="Pic"></a></li>
                <li><a href="img/dummies/620x300.gif" rel="prettyPhoto[group]"><img src="img/dummies/140x140.gif" alt="Pic"></a></li>
                <li><a href="img/dummies/620x300.gif" rel="prettyPhoto[group]"><img src="img/dummies/140x140.gif" alt="Pic"></a></li>
                <li><a href="img/dummies/620x300.gif" rel="prettyPhoto[group]"><img src="img/dummies/140x140.gif" alt="Pic"></a></li>
                <li><a href="img/dummies/620x300.gif" rel="prettyPhoto[group]"><img src="img/dummies/140x140.gif" alt="Pic"></a></li>
            </ul>
            <!-- ENDS Project gallery -->


        </div>
        <!-- ENDS Content -->

        <!-- Sidebar -->		
        <div class="sidebar">
            <!-- project tags -->
            <h6 class="side-title"><span>Project tags</span></h6>
            <ul class="tags">
                <li></li>
                <?php foreach ($tags as $value) : ?>
                    <li><a href="/tags/" ><?php echo Tag::getTagNameById($value['tag_id']); ?> </a></li>
                <?php endforeach ?>
            </ul>
            <!-- ENDS project tags -->

            <!-- last article -->
            <h6 class="side-title"><span>Последние статьи</span></h6>
            <ul>
                <?php foreach ($latestArticle as $value) : ?>
                    <li><div class="imgPreview"><a href="<?php echo $value['url']; ?>" >
                                <img class="imgPreview" src="<?php echo $value['image']; ?>" alt="<?php echo $value['name']; ?>" /></a>
                        </div>
                        <h6 class="p-title"><?php echo $value['name']; ?></a></h6>
                    </li>
                <?php endforeach ?>
            </ul>
            <!-- ENDS last article -->
            <!-- Carbon ad -->
            <div class="ad-holder">
                <div class="carbonad">
                    <span class="carbonad-image"><a href="#"><img src="img/dummies/carbon-ad.gif" alt="ad" /></a></span>
                    <span class="carbonad-text">Pellentesque habitant morbi tristique </span>
                </div>
            </div>
            <!-- ENDS Carbon ad -->







        </div>
        <!-- ENDS Sidebar -->

        <div class="clear"></div>
    </div>
    <!-- ENDS wrapper-main -->
</div>
<!-- ENDS MAIN -->
<?php include ROOT . '/views/layouts/footer.php'; ?>