<?php

namespace Torondor\LaravelAdvertising\Repositories;

/**
 * Class BannersRepository
 * @package Iconx\Advertising\Repositories
 */
class BannersRepository extends AbstractRepository
{
    /**
     * @param $pos
     * @param array $options
     * @return mixed
     */
    public function search($pos, array $options = [])
    {
        $now = new Carbon();
        $query = $this->model
            ->where('position', '=', "{$pos}")
            ->where('start_show', '<=', $now)
            ->where('end_show', '>=', $now)
            ->orderBy('id', 'ASC')
        ;

        if (!empty($options['first'])) {
            $query = $query->limit(1);
        }

        if (!empty($options['seen'])) {
            $query = $query->whereNotIn('id', $options['seen']);
        }

        return $query->get();
    }
}