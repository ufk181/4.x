<?php namespace ZN\Services\Remote\Email\Drivers;

use Support;
use ZN\Services\Remote\Abstracts\EmailMappingAbstract;
use ZN\Services\Remote\Email\Exception\FailureSendEmailException;
use ZN\Services\Remote\Email\Exception\IOException;

class PipeDriver extends EmailMappingAbstract
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
    // Construct
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function __construct()
    {
        Support::func('popen');
    }

    //--------------------------------------------------------------------------------------------------------
    // Send
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $to
    // @param string $subject
    // @param string $message
    // @param mixed  $headers
    // @param mixed  $settings
    //
    //--------------------------------------------------------------------------------------------------------
    public function send($to, $subject, $message, $headers = NULL, $settings = [])
    {
        $returnPath = $settings['mailPath'].' -oi -f '.$settings['from'].' -t -r '.$settings['returnPath'];

        $open = @popen($returnPath, 'w');

        if( empty($open) )
        {
            throw new FailureSendEmailException('Services', 'email:sendFailureSendmail');
        }

        @fputs($open, $headers);
        @fputs($open, $message);

        $status = @pclose($open);

        if( $status !== 0 )
        {
            $exceptionMessage  = lang('Services', 'email:noSocket').' ';
            $exceptionMessage .= lang('Services', 'email:exitStatus', $status);

            throw new IOException($exceptionMessage);
        }

        return true;
    }
}
