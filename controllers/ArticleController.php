<?php

/**
 * Контроллер ArticleController
 * Управление статьями
 */
class ArticleController {

    /**
     * Action для страницы "Одна статья"
     */
    public function actionView($articleId, $page = 1) {
        // Список последних СТАТЕЙ
        $latestArticle = Article::getLatestArticles(4);
        // Список категорий для левого меню
        $categoriesList = Category::getCategoriesList();
        $articleId = Article ::getArticleIdbyUrl($articleId);
        // Выбираем нужную статью
        $article = Article::getArticleById($articleId);

        $tags = Tag::getTagsById($articleId);

        $tagsList = Tag::getTagList();


        $metaTitle = $article['meta_title'];
        $metaDescription = $article['meta_desc'];

        // Подключаем вид
        require_once(ROOT . '/views/article/view.php');
        return true;
    }

}
