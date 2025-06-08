<?php

namespace App\Enums;

enum LearningModeEnum: string
{
    case FaceToFace = 'Face to Face';
    case Distance = 'Distance';
    case BlendedLearning = 'Blended Learning';

    public function label(): string
    {
        return match($this) {
            self::FaceToFace => 'Face to Face (F2F)',
            self::Distance => 'Distance (Online)',
            self::BlendedLearning => 'Blended Learning',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
