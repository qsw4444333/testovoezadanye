<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Мои заметки</title>
    <link rel="stylesheet" href="static/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="content">
        <div class="content-inner">
            <div class="content-left">
                <div class="notes-block">
                    <div class="window-block-name">
                        <span>Заметки</span>
                    </div>
                    <div class="window-block">
                        <div class="window-block-inner notes-blocks">
                            <div class="note-block note-craete-block">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#fff" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/>
                                  </svg>
                                <span>Новая заметка</span>
                            </div>
                            <?php
                                require_once "note.php";
                                require_once "config.php";
    
                                $note = new Note($conn);
                                $notes = $note->get_all();
                                while ($note = mysqli_fetch_array($notes)){
                                    echo '<div class="note-block"  note-id="'.$note["id"].'"><span>'.$note["title"].'</span></div>';
                                }
                            ?>
                        </div>
                    </div>
                </div>  
            </div>
            <div class="content-right">
                <div class="actions-block">
                    <div class="window-block-name">
                        <span>Действия</span>
                    </div>
                    <div class="window-block">
                        <div class="window-block-inner">
                            <div class="action-block" id="action-s">
                                <span>Сохранить</span>
                            </div>
                            <div class="action-block" id="action-d">
                                <span>Удалить</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="notification-block window-block window-block-inner">
                    <div class="notification-left">
                        <svg id="notification-icon-suc" width="48" height="48" viewBox="0 0 49 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_22_90)">
                                <path d="M15.2715 36.7L21.6007 41.5C22.4173 42.3 24.2548 42.7 25.4798 42.7H33.2382C35.6882 42.7 38.3423 40.9 38.9548 38.5L43.8548 23.9C44.8756 21.1 43.0381 18.7 39.9756 18.7H31.809C30.584 18.7 29.5631 17.7 29.7673 16.3L30.7881 9.9C31.1965 8.1 29.9715 6.1 28.134 5.5C26.5006 4.9 24.459 5.7 23.6423 6.9L15.2715 19.1" stroke="white" stroke-width="5" stroke-miterlimit="10"/>
                                <path d="M4.85938 36.7V17.1C4.85938 14.3 6.08437 13.3 8.94271 13.3H10.9844C13.8427 13.3 15.0677 14.3 15.0677 17.1V36.7C15.0677 39.5 13.8427 40.5 10.9844 40.5H8.94271C6.08437 40.5 4.85938 39.5 4.85938 36.7Z" stroke="white" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/>
                            </g>
                            <defs>
                                <clipPath id="clip0_22_90">
                                    <rect width="49" height="48" fill="white"/>
                                </clipPath>
                            </defs>
                        </svg>
                        <svg id="notification-icon-err" width="48" height="48" viewBox="0 0 51 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16.1561 12.3852L22.441 7.52731C23.2503 6.71984 25.084 6.303 26.309 6.29175L34.067 6.22055C36.5169 6.19807 39.1874 7.97363 39.8219 10.3679L44.8557 24.9223C45.9022 27.7128 44.0868 30.1296 41.0244 30.1577L32.8581 30.2327C31.6332 30.2439 30.6216 31.2532 30.8386 32.6513L31.9181 39.0417C32.3429 40.8378 31.1363 42.849 29.3044 43.4658C27.6767 44.0808 25.6277 43.2996 24.8001 42.1071L16.3176 29.9844" stroke="white" stroke-width="5" stroke-miterlimit="10"/>
                            <path d="M5.74423 12.4807L5.92411 32.0799C5.94981 34.8798 7.18393 35.8685 10.0421 35.8423L12.0837 35.8235C14.9419 35.7973 16.1577 34.7861 16.132 31.9862L15.9521 12.3871C15.9264 9.58718 14.6923 8.59846 11.8341 8.62469L9.79252 8.64343C6.9343 8.66966 5.71853 9.68086 5.74423 12.4807Z" stroke="white" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>

                    </div>
                    <div class="notification-right">
                        <span>Заметка "Название 1" успешно сохранена</span>
                    </div>
                </div>
                <div class="note-edit-block">
                    <div class="window-block-name">
                        <span>Рабочая область</span>
                    </div>
                    <div class="window-block">
                        <div class="window-block-inner">
                            <div class="note-name-edit">
                                <div class="input-block">
                                    <label for="note-name">Название заметки</label>
                                    <input type="text" id="note-name">
                                </div>
                            </div>
                            <div class="note-content-edit">
                                <textarea id="note-content" placeholder="Ваш текст"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="static/js/jquery-3.7.1.min.js"></script>
    <script src="static/js/app.js"></script>
</body>
</html>