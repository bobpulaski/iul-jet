<?php

namespace App\Enums;
enum SupportRequestTypeEnum: string
{
    case QUESTION = 'Вопрос';
    case ERROR = 'Ошибка';
    case SUGGESTION = 'Пожелание';
    case GRATITUDE = 'Благодарность';
    case OTHER = 'Другое';
}

