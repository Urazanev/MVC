<?php

/**
 * Контроллер CategoryController
 * Управление категориями
 */
class CategoryController {

    /**
     * Action для страницы "Управление категориями"
     */
    public function actionIndex() {
        // Получаем список категорий
        $categoriesList = Category::getCategoriesList();

        $latestArticle = Article::getLatestArticles(8);

        $metaCategory = Category::getCategoryMeta(1);

        $metaTitle = $metaCategory['meta_title'];
        $metaDescription = $metaCategory['meta_desc'];
        // Подключаем вид
        require_once(ROOT . '/views/category/index.php');
        return true;
    }

    public function actionCategory($categoryId, $page = 1) {
        // Список категорий для левого меню
        $categoriesList = Category::getCategoriesList();
        $latestArticle = Article::getLatestArticles(4);

        // имя категории
        $categoryName = $categoryId;

        // Преобразование URL в ID
        $categoryId = Category :: getCategoriesIdbyUrl($categoryId);

        // Список статей в категории
        $categoryArticles = Article::getArticlesListByCategory($categoryId, $page);




        // Общее количетсво товаров (необходимо для постраничной навигации)
        $total = Article::getTotalArticlesInCategory($categoryId);

        // Создаем объект Pagination - постраничная навигация
        $pagination = new Pagination($total, $page, Article::SHOW_BY_DEFAULT, 'page-');

        $metaCategory = Category::getCategoryMeta($categoryId);

        $metaTitle = $metaCategory['meta_title'];
        $metaDescription = $metaCategory['meta_desc'];

        // Подключаем вид
        require_once(ROOT . '/views/category/category.php');
        return true;
    }

}
