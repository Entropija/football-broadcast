<?php
namespace App\Entity;

class Player
{
    private const PLAY_PLAY_STATUS  = 'play';
    private const BENCH_PLAY_STATUS = 'bench';
    private const YELLOW_CARD_TYPE  = 'yellowCard';
    private const RED_CARD_TYPE     = 'redCard';

    private int $number;
    private string $name;
    private string $position;
    private string $playStatus;
    private int $inMinute;
    private int $outMinute;
    private int $goal;
    private array $cards;

    public function __construct(int $number, string $name, string $position)
    {
        $this->number = $number;
        $this->name = $name;
        $this->position = $position;
        $this->playStatus = self::BENCH_PLAY_STATUS;
        $this->inMinute = 0;
        $this->outMinute = 0;
        $this->goal = 0;
        $this->cards = [
            self::YELLOW_CARD_TYPE => 0,
            self::RED_CARD_TYPE => 0
        ];
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPosition(): string
    {
        return $this->position;
    }

    public function getInMinute(): int
    {
        return $this->inMinute;
    }

    public function getOutMinute(): int
    {
        return $this->outMinute;
    }

    public function getGoal(): int
    {
        return $this->goal;
    }

    public function getCards(): array
    {
        return $this->cards;
    }

    public function isPlay(): bool
    {
        return $this->playStatus === self::PLAY_PLAY_STATUS;
    }

    public function getPlayTime(): int
    {
        if(!$this->outMinute) {
            return 0;
        }

        return $this->outMinute - $this->inMinute;
    }

    public function goToPlay(int $minute): void
    {
        $this->inMinute = $minute;
        $this->playStatus = self::PLAY_PLAY_STATUS;
    }

    public function goToBench(int $minute): void
    {
        $this->outMinute = $minute;
        $this->playStatus = self::BENCH_PLAY_STATUS;
    }
 
    public function addGoal(): void
    {
        $this->goal += 1;
    }

    public function addCard(string $type): void
    {
        if (array_key_exists($type, $this->cards)) 
        {
            $this->cards[$type] += 1;
        } 
    }
    

}