<?php
/**
 * Author: Paul Bardack paul.bardack@gmail.com http://paulbardack.com
 * Date: 15.02.16
 * Time: 17:39
 */

namespace App\Models;

/**
 * Class Rule
 * @package App\Models
 * @property string $title
 * @property string $description
 * @property string $decision
 * @property string $than
 * @property Condition[] $conditions
 *
 */
class Rule extends Base
{
    protected $visible = ['title', 'decision', 'description', 'than', 'conditions'];

    protected $fillable = ['title', 'description', 'than'];

    protected $casts = [
        '_id' => 'string',
        'title' => 'string',
        'description' => 'string',
    ];

    protected function getArrayableRelations()
    {
        return ['conditions' => $this->conditions];
    }

    public function conditions()
    {
        return $this->embedsMany('App\Models\Condition');
    }

    public function setConditions($conditions)
    {
        $this->conditions()->delete();
        foreach ($conditions as $condition) {
            $this->conditions()->associate(new Condition($condition));
        }

        return $this;
    }
}
