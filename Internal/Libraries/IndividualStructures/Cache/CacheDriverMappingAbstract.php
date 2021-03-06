<?php namespace ZN\IndividualStructures\Abstracts;

abstract class CacheDriverMappingAbstract
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
    // Select
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param  string $key
    // @param  mixed $expressed
    // @return mixed
    //
    //--------------------------------------------------------------------------------------------------------
    abstract public function select($key, $compressed);
    
    //--------------------------------------------------------------------------------------------------------
    // Insert
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param  string $key
    // @param  variable $var
    // @param  numeric $time
    // @param  mixed $expressed
    // @return bool
    //
    //--------------------------------------------------------------------------------------------------------
    abstract public function insert($key, $var, $time, $compressed);
    
    //--------------------------------------------------------------------------------------------------------
    // Delete
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param  string $key
    // @return mixed
    //
    //--------------------------------------------------------------------------------------------------------
    abstract public function delete($key);
    
    //--------------------------------------------------------------------------------------------------------
    // Increment
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param  string  $key
    // @param  numeric $increment
    // @return void
    //
    //--------------------------------------------------------------------------------------------------------
    abstract public function increment($key, $increment);
    
    //--------------------------------------------------------------------------------------------------------
    // Deccrement
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param  string  $key
    // @param  numeric $decrement
    // @return void
    //
    //--------------------------------------------------------------------------------------------------------
    abstract public function decrement($key, $decrement);
    
    //--------------------------------------------------------------------------------------------------------
    // Info
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param  mixed  $info
    // @return mixed
    //
    //--------------------------------------------------------------------------------------------------------
    abstract public function info($type);
    
    //--------------------------------------------------------------------------------------------------------
    // Get Meta Data
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param  string  $key
    // @return mixed
    //
    //--------------------------------------------------------------------------------------------------------
    abstract public function getMetaData($key);
    
    //--------------------------------------------------------------------------------------------------------
    // Clean
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param  void
    // @return void
    //
    //--------------------------------------------------------------------------------------------------------
    abstract public function clean();   
}