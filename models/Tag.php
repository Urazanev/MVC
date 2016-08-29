<?php

/**
 * Класс Tag - модель для работы с тегами
 */
class Tag {

    public static function getTagList() {
        // Соединение с БД
        $db = Db::getConnection();

        // Запрос к БД
        $result = $db->query('SELECT * FROM tags ORDER BY tag_name ASC');

        // Получение и возврат результатов
        $i = 0;
        $tagsList = array();
        while ($row = $result->fetch()) {
            $tagsList[$i]['tag_id'] = $row['tag_id'];
            $tagsList[$i]['tag_name'] = $row['tag_name'];
            $i++;
        }
        return $tagsList;
    }

    public static function getTagsById($id) {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT * FROM posts_tags WHERE post_id = :id';

        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Выполняем запрос
        $result->execute();

        // Получение и возврат результатов
        $i = 0;
        $tags = array();
        while ($row = $result->fetch()) {
            $tags[$i]['tag_name'] = Tag::getTagNameById($row['tag_id']);
            $i++;
        }

        // Возвращаем данные
        return $tags;
    }

    public static function getTagNameById($tag_id) {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT tag_name FROM tags WHERE tag_id = :tag_id';

        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':tag_id', $tag_id, PDO::PARAM_INT);

        // Выполняем запрос
        $result->execute();
        $row = $result->fetch();

        // Возвращаем данные
        return $row['tag_name'];
    }

}
