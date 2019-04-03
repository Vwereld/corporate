<?php
/**
 * Created by PhpStorm.
 * User: Vitaly
 * Date: 02/12/2018
 * Time: 18:23
 */
namespace Corp\Repositories;
use Corp\Slider;
//use Illuminate\Config\Repository;

class SlidersRepository extends Repository {

    public function __construct(Slider $slider)
    {
        $this->model = $slider;
    }

}

