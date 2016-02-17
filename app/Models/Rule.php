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
 * @property string $decision
 * @property string $description
 * @property string $than
 * @property Condition[] $conditions
 *
 */
class Rule extends Base
{
    protected $visible = ['decision', 'description'];

    public function conditions()
    {
        return $this->embedsMany('App\Models\Condition');
    }
}
