<?php namespace ZN\Services\Response;

class InternalServer implements InternalServerInterface
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
    // Data -> 4.3.5
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $data = NULL
    //
    //--------------------------------------------------------------------------------------------------------
    public function data(String $data = NULL)
    {
        return server($data);
    }

    //--------------------------------------------------------------------------------------------------------
    // Name -> 4.3.5
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function name() : String
    {
        return $this->data('name');
    }

    //--------------------------------------------------------------------------------------------------------
    // Addr -> 4.3.5
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function addr() : String
    {
        return $this->data('addr');
    }

    //--------------------------------------------------------------------------------------------------------
    // Port -> 4.3.5
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function port() : Int
    {
        return $this->data('port');
    }

    //--------------------------------------------------------------------------------------------------------
    // Admin -> 4.3.5
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function admin() : String
    {
        return $this->data('admin');
    }

    //--------------------------------------------------------------------------------------------------------
    // Protocol -> 4.3.5
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function protocol() : String
    {
        return $this->data('protocol');
    }
}
