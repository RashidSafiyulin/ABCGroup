/**
 *  Задача No 2:
 *      1. Выбрать клики у которых точно есть actions
 *      2. Выбрать клики у которых точно нету actions
 * 
 */
-- Клики у которых точно есть actions
SELECT DISTINCT c.*
FROM         click   AS c
  INNER JOIN actions AS a ON a.click_id = c.id;
-- Клики у которых точно нет actions
SELECT c.*
FROM        click   AS c
  LEFT JOIN actions AS a ON a.click_id = c.id
WHERE a.id IS NULL;
