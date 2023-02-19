# Warp 
Warp - это PocketMine-MP плагин, добавляющий систему варпов на Ваш сервер

## Команды  
|  Команда  |  Описание  |
| ------------- | ------------- |
|  `/setwarp <data:string>`  |  Создание варпа с данными `data`(использование только из консоли)  |
|  `/warp`  |  Открытие UI меню телепортации на варпы  |
|  `/removewarp <name:string>`  |  Удаление варпа с именем `name`(использование только из консоли)  |

## Пример использования
- `/setwarp <warpName|warpX|warpY|warpZ|warpWorldName|warpYaw|warpPitch>`,
к примеру: `/setwarp pvp|100|80|100|arena|0|0`

- `/warp <warpName>`,
к примеру: `/warp pvp`
  
- `/removewarp <warpName>`,
к примеру: `/removewarp pvp`

# UI Меню 
![изображение](https://user-images.githubusercontent.com/103766080/219941089-980a467e-9768-463c-8255-687c187d44f1.png)

# Зависимости
- Требуется [Database](github.com/DenOrekhov567/Database)
- Требуется [forms](github.com/Frago9876543210/forms)

# Приемущества
Плагин контактирует с базой данных только два раза за жизненный цикл:
- При включении запрашиваются данные из базы данных и сохраняются в hash программы
- При выключении из hash программы данные сохраняются в базу данных

И ещё:
- Используется система управления базами данных MySQL 8.0 
- Используется [JsonMapper](github.com/cweiske/jsonmapper) для удобства хранения данных
