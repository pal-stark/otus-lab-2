# otus-lab-2
Установка и настройка Prometheus, использование exporters
Цель: Необходимо собрать стенд включающий в себя 2 виртуальные машины: 1. Prometheus 2. Nginx На вм с nginx установить и настроить nginx-exporter. С помощью siege (или apache benchmark, или yandex tank) устроить ипровизированное нагрузочное тестирование. Посчитать 99й персентиль по времени ответа за 5 минут. Посчитать количество запросов по каждому коду ответа за 5 минут. Реализовать свой собственный экспортер с собственными метриками (ваше имя\никнейм в название метрики) использую любой ЯП. (Ссылка с реализацией экспортера на bash прилагается) Для сдачи: 1. Скриншоты с prometheus с результатами запросов PromQL 2. Текстовый файлик с примерами метрик вашего экспортера
