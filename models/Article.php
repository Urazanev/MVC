<?php

/**
 * Класс Article - модель для работы со статьями
 */
class Article {

    // Количество отображаемых статей по умолчанию
    const SHOW_BY_DEFAULT = 6;

    /**
     * Возвращает id категории по url
     * @return integer <p>id категории</p>
     */
    public static function getArticleIdbyUrl($url) {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT Id FROM article WHERE url= :url';

        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':url', $url, PDO::PARAM_INT);

        // Выполняем запрос
        $result->execute();
        $row = $result->fetch();

        // Возвращаем данные
        return $row['Id'];
    }

    /**
     * Возвращает Meta данные статьи по id
     * @param type $id <p>ID статьи</p>
     * @return type <p>Массив с Meta</p>
     */
    public static function getArticleMeta($id) {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT meta_title, meta_desc FROM article WHERE id = :id';

        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        // Выполняем запрос
        $result->execute();
        $row = $result->fetch();

        // Возвращаем данные
        return $row;
    }

    /**
     * Возвращает массив последних статей
     * @param type $count [optional] <p>Количество</p>
     * @param type $page [optional] <p>Номер текущей страницы</p>
     * @return array <p>Массив статей</p>
     */
    public static function getLatestArticles($count = self::SHOW_BY_DEFAULT) {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT id, name, image, intro_text, url, full_text, date FROM article '
                . 'WHERE status = "1" ORDER BY id DESC '
                . 'LIMIT :count';

        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':count', $count, PDO::PARAM_INT);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Выполнение коменды
        $result->execute();

        // Получение и возврат результатов
        $i = 0;
        $articlesList = array();
        while ($row = $result->fetch()) {
            $articlesList[$i]['id'] = $row['id'];
            $articlesList[$i]['name'] = $row['name'];
            $articlesList[$i]['image'] = $row['image'];
            $articlesList[$i]['intro_text'] = $row['intro_text'];
            $articlesList[$i]['url'] = $row['url'];
            $articlesList[$i]['full_text'] = $row['full_text'];
            $articlesList[$i]['date'] = $row['date'];
            $i++;
        }
        return $articlesList;
    }

    /**
     * Возвращает массив последних статей в категории
     * @param type $count [optional] <p>Количество</p>
     * @param type $idcategory  <p>Номер категории</p>
     * @return array <p>Массив со статьями</p>
     */
    public static function getLatestArticlesInCategory($idcategory, $count = self::SHOW_BY_DEFAULT) {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT id, name, image, intro_text, url, full_text, date FROM article '
                . 'WHERE status = "1" AND categoryId= :idcategory ORDER BY id DESC '
                . 'LIMIT :count';

        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':idcategory', $idcategory, PDO::PARAM_INT);
        $result->bindParam(':count', $count, PDO::PARAM_INT);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Выполнение коменды
        $result->execute();

        // Получение и возврат результатов
        $i = 0;
        $articlesList = array();
        while ($row = $result->fetch()) {
            $articlesList[$i]['id'] = $row['id'];
            $articlesList[$i]['name'] = $row['name'];
            $articlesList[$i]['image'] = $row['image'];
            $articlesList[$i]['intro_text'] = $row['intro_text'];
            $articlesList[$i]['url'] = $row['url'];
            $articlesList[$i]['full_text'] = $row['full_text'];
            $articlesList[$i]['date'] = $row['date'];
            $i++;
        }
        return $articlesList;
    }

    /**
     * Возвращает список статей в указанной категории
     * @param type $categoryId <p>id категории</p>
     * @param type $page [optional] <p>Номер страницы</p>
     * @return type <p>Массив со статьями</p>
     */
    public static function getArticlesListByCategory($categoryId, $page = 1) {
        $limit = Article::SHOW_BY_DEFAULT;
        // Смещение (для запроса)
        $offset = ($page - 1) * self::SHOW_BY_DEFAULT;

        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT id, name, image, intro_text, url, full_text FROM article '
                . 'WHERE status = 1 AND categoryId = :category_id '
                . 'ORDER BY id ASC LIMIT :limit OFFSET :offset';
        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
        $result->bindParam(':limit', $limit, PDO::PARAM_INT);
        $result->bindParam(':offset', $offset, PDO::PARAM_INT);

        // Выполнение коменды
        $result->execute();

        // Получение и возврат результатов
        $i = 0;
        $articles = array();
        while ($row = $result->fetch()) {

            $articles[$i]['id'] = $row['id'];
            $articles[$i]['name'] = $row['name'];
            $articles[$i]['image'] = $row['image'];
            $articles[$i]['intro_text'] = $row['intro_text'];
            $articles[$i]['url'] = $row['url'];
            $articles[$i]['full_text'] = $row['full_text'];
            $i++;
        }

        return $articles;
    }

    /**
     * Возвращает сатью с указанным id
     * @param integer $id <p>id сатьи</p>
     * @return array <p>Массив с информацией о статье</p>
     */
    public static function getArticleById($id) {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT * FROM article WHERE id = :id';

        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Выполнение коменды
        $result->execute();

        // Получение и возврат результатов
        return $result->fetch();
    }

    /**
     * Возвращаем количество статей в указанной категории
     * @param integer $categoryId
     * @return integer
     */
    public static function getTotalArticlesInCategory($categoryId) {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT count(id) AS count FROM article WHERE status="1" AND categoryId = :category_id';

        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':category_id', $categoryId, PDO::PARAM_INT);

        // Выполнение коменды
        $result->execute();

        // Возвращаем значение count - количество
        $row = $result->fetch();
        return $row['count'];
    }

    /**
     * Возвращает список статей с указанными индентификторами
     * @param array $idsArray <p>Массив с идентификаторами</p>
     * @return array <p>Массив со списком статей</p>
     */
    public static function getArticlesByIds($idsArray) {
        // Соединение с БД
        $db = Db::getConnection();

        // Превращаем массив в строку для формирования условия в запросе
        $idsString = implode(',', $idsArray);

        // Текст запроса к БД
        $sql = "SELECT * FROM article WHERE status='1' AND id IN ($idsString)";

        $result = $db->query($sql);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Получение и возврат результатов
        $i = 0;
        $articles = array();
        while ($row = $result->fetch()) {
            $articles[$i]['id'] = $row['id'];
            $articles[$i]['code'] = $row['code'];
            $articles[$i]['name'] = $row['name'];
            $articles[$i]['price'] = $row['price'];
            $i++;
        }
        return $articles;
    }

    /**
     * Возвращает список рекомендуемых статей
     * @return array <p>Массив статей</p>
     */
    public static function getRecommendedArticles() {
        // Соединение с БД
        $db = Db::getConnection();

        // Получение и возврат результатов
        $result = $db->query('SELECT id, name, price, is_new FROM article '
                . 'WHERE status = "1" AND is_recommended = "1" '
                . 'ORDER BY id DESC');
        $i = 0;
        $articlesList = array();
        while ($row = $result->fetch()) {
            $articlesList[$i]['id'] = $row['id'];
            $articlesList[$i]['name'] = $row['name'];
            $articlesList[$i]['price'] = $row['price'];
            $articlesList[$i]['is_new'] = $row['is_new'];
            $i++;
        }
        return $articlesList;
    }

    /**
     * Возвращает список статей
     * @return array <p>Массив статей</p>
     */
    public static function getArticlesList() {
        // Соединение с БД
        $db = Db::getConnection();

        // Получение и возврат результатов
        $result = $db->query('SELECT id, name, price, code FROM article ORDER BY id ASC');
        $articlesList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $articlesList[$i]['id'] = $row['id'];
            $articlesList[$i]['name'] = $row['name'];
            $articlesList[$i]['code'] = $row['code'];
            $articlesList[$i]['price'] = $row['price'];
            $i++;
        }
        return $articlesList;
    }

    /**
     * Удаляет статья с указанным id
     * @param integer $id <p>id статьяа</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function deleteArticleById($id) {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'DELETE FROM article WHERE id = :id';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    /**
     * Редактирует статья с заданным id
     * @param integer $id <p>id статьяа</p>
     * @param array $options <p>Массив с информацей о статьяе</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function updateArticleById($id, $options) {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "UPDATE article
            SET 
                name = :name, 
                code = :code, 
                price = :price, 
                category_id = :category_id, 
                brand = :brand, 
                availability = :availability, 
                description = :description, 
                is_new = :is_new, 
                is_recommended = :is_recommended, 
                status = :status
            WHERE id = :id";

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':code', $options['code'], PDO::PARAM_STR);
        $result->bindParam(':price', $options['price'], PDO::PARAM_STR);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(':brand', $options['brand'], PDO::PARAM_STR);
        $result->bindParam(':availability', $options['availability'], PDO::PARAM_INT);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $result->bindParam(':is_new', $options['is_new'], PDO::PARAM_INT);
        $result->bindParam(':is_recommended', $options['is_recommended'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        return $result->execute();
    }

    /**
     * Добавляет новый статья
     * @param array $options <p>Массив с информацией о статьяе</p>
     * @return integer <p>id добавленной в таблицу записи</p>
     */
    public static function createArticle($options) {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'INSERT INTO article '
                . '(name, code, price, category_id, brand, availability,'
                . 'description, is_new, is_recommended, status)'
                . 'VALUES '
                . '(:name, :code, :price, :category_id, :brand, :availability,'
                . ':description, :is_new, :is_recommended, :status)';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':code', $options['code'], PDO::PARAM_STR);
        $result->bindParam(':price', $options['price'], PDO::PARAM_STR);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(':brand', $options['brand'], PDO::PARAM_STR);
        $result->bindParam(':availability', $options['availability'], PDO::PARAM_INT);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $result->bindParam(':is_new', $options['is_new'], PDO::PARAM_INT);
        $result->bindParam(':is_recommended', $options['is_recommended'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        if ($result->execute()) {
            // Если запрос выполенен успешно, возвращаем id добавленной записи
            return $db->lastInsertId();
        }
        // Иначе возвращаем 0
        return 0;
    }

    /**
     * Возвращает текстое пояснение наличия статьяа:<br/>
     * <i>0 - Под заказ, 1 - В наличии</i>
     * @param integer $availability <p>Статус</p>
     * @return string <p>Текстовое пояснение</p>
     */
    public static function getAvailabilityText($availability) {
        switch ($availability) {
            case '1':
                return 'В наличии';
                break;
            case '0':
                return 'Под заказ';
                break;
        }
    }

    /**
     * Возвращает путь к изображению
     * @param integer $id
     * @return string <p>Путь к изображению</p>
     */
    public static function getImage($id) {
        // Название изображения-пустышки
        $noImage = 'no-image.jpg';

        // Путь к папке статей
        $path = '/upload/images/articles/';

        // Путь к изображению статьяа
        $pathToArticleImage = $path . $id . '.jpg';

        if (file_exists($_SERVER['DOCUMENT_ROOT'] . $pathToArticleImage)) {
            // Если изображение для статьяа существует
            // Возвращаем путь изображения статьяа
            return $pathToArticleImage;
        }

        // Возвращаем путь изображения-пустышки
        return $path . $noImage;
    }

}
