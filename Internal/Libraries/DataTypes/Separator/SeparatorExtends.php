<?php namespace ZN\DataTypes\Separator;

class SeparatorExtends
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
    // Key
    //--------------------------------------------------------------------------------------------------------
    //
    // @var string
    //
    //--------------------------------------------------------------------------------------------------------
    protected $key = "+-?||?-+" ;

    //--------------------------------------------------------------------------------------------------------
    // Separator
    //--------------------------------------------------------------------------------------------------------
    //
    // @var string
    //
    //--------------------------------------------------------------------------------------------------------
    protected $separator = "|?-++-?|";

    //--------------------------------------------------------------------------------------------------------
    // Protected Security
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string  $data
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _security($data)
    {
        return str_replace([$this->key, $this->separator], '', $data);
    }
}
