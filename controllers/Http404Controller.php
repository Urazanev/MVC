<?php

/**
 * Контроллер ArticleController
 * Управление категориями
 */
class Http404Controller
{

    /**
     * Action для страницы "Одна статья"
     */
   

    public static function actionHttp404()
    {
       // Список категорий для левого меню
        $categoriesList = Category::getCategoriesList();
               

        // Подключаем вид
        require_once(ROOT . '/views/site/404.php');
        return true;
    }

}
