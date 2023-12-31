-- Добавляет категории в таблицу
INSERT INTO
    categories (character_code, name_category)
VALUES
    ('boards', 'Доски и лыжи'),
    ('attachment', 'Крепления'),
    ('boots', 'Ботинки'),
    ('clothing', 'Одежда'),
    ('tools', 'Инструменты'),
    ('other', 'Разное');

-- Добавляет пользователей в таблицу
INSERT INTO
    users (email, user_name, user_password, contacts)
VALUES
    ('eo1@yandex.ru', 'danil-1', '1', 'телефон: 1'),
    ('eo12@yandex.ru', 'danil-2', '12', 'телефон: 12'),
    (
        'eo1234@yandex.ru',
        'danil-3',
        '123',
        'телефон: 123'
    ),
    (
        'eo1235@yandex.ru',
        'danil-4',
        '1234',
        'телефон: 1234'
    ),
    (
        'eo123456@yandex.ru',
        'danil-5',
        '12345',
        'телефон: 12345'
    );

-- Добавляет лоты в таблицу
INSERT INTO
    lots (
        title,
        lot_description,
        img,
        start_price,
        date_finish,
        step,
        user_id,
        category_id
    )
VALUES
    (
        '2014 Rossignol District Snowboard',
        'Описание-1',
        'img/lot-1.jpg',
        10999,
        '2019-10-10 14:31',
        50,
        1,
        1
    ),
    (
        'DC Ply Mens 2016/2017 Snowboard',
        'Описание-2',
        'img/lot-2.jpg',
        159999,
        '2019-10-10 15:31',
        100,
        2,
        1
    ),
    (
        'Крепления Union Contact Pro 2015 года размер L/XL',
        'Описание-3',
        'img/lot-3.jpg',
        8000,
        '2019-10-10 16:31',
        200,
        3,
        2
    ),
    (
        'Ботинки для сноуборда DC Mutiny Charocal',
        'Описание-4',
        'img/lot-4.jpg',
        10999,
        '2019-10-10 17:31',
        300,
        4,
        3
    ),
    (
        'Куртка для сноуборда DC Mutiny Charocal',
        'Описание-5',
        'img/lot-5.jpg',
        7500,
        '2019-10-10 18:31',
        400,
        5,
        4
    ),
    (
        'Маска Oakley Canopy',
        'Описание-6',
        'img/lot-6.jpg',
        5400,
        '2023-10-17 20:31',
        500,
        1,
        6
    );

-- Добавляет ставки в таблицу
INSERT INTO
    bets (
        price_bet,
        user_id,
        lot_id
    )
VALUES
    (500, 2, 1),
    (400, 1, 2),
    (1000, 1, 3);

-- Получает все значения из таблицы категория
SELECT
    name_category AS 'Категория'
FROM
    categories;

-- Получает самые новые открытые лоты
SELECT
    DISTINCT title,
    start_price,
    img,
    name_category
FROM
    lots l
    JOIN categories c ON l.category_id = c.id;

-- Получает все лоты
SELECT
    DISTINCT lots.id,
    date_creation,
    title,
    lot_description,
    img,
    start_price,
    date_finish,
    step,
    category_id,
    name_category
FROM
    lots
    JOIN categories ON lots.category_id = categories.id
WHERE
    lots.id = 4;

-- Обновляет значение лота
UPDATE
    lots
SET
    title = 'Ботинки для сноуборда обычные'
WHERE
    id = 4;

-- Получает список ставок для лота
SELECT
    date_bet,
    price_bet title,
    user_name
FROM
    bets
    JOIN lots ON bets.lot_id = lots.id
    JOIN users ON bets.user_id = users.id
WHERE
    lots.id = 4
ORDER BY
    date_bet DESC;
