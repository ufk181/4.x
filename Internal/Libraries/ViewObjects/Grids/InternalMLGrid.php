<?php namespace ZN\ViewObjects\Grids;

use ML;

class InternalMLGrid extends Abstracts\GridAbstract
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------------
    // Url()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $url
    //
    //--------------------------------------------------------------------------------------------------------
    public function url(String $url) : InternalMLGrid
    {
        ML::url($url);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // limit()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $limit
    //
    //--------------------------------------------------------------------------------------------------------
    public function limit(Int $limit) : InternalMLGrid
    {
        ML::limit($limit);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Create
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed $app
    //
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public function create($app = NULL) : String
    {
        return ML::table($app);
    }
}
