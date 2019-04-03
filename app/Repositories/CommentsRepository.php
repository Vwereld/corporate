<?php
/**
 * Created by PhpStorm.
 * User: Vitaly
 * Date: 02/12/2018
 * Time: 18:23
 */
namespace Corp\Repositories;
use Corp\Comment;

class CommentsRepository extends Repository {

    public function __construct(Comment $comment)
    {

        $this->model = $comment;
    }

}

