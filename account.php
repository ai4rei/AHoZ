<?php

set_time_limit(0);

define('HEADER_CA_LOGIN',0x0000);  // <packet type>.W <user>.16 <pass>.16B
define('HEADER_AC_ACCEPT_LOGIN',0x0005);  // <packet type>.W <packet len>.W <auth code>.L <sex>.B <aid>.L { <ip>.L <port>.W <name>.20B }*
define('HEADER_AC_REFUSE_LOGIN',0x0006);

function CString($sBuffer)
{
    $nIdx = strpos($sBuffer,chr(0));

    return $nIdx===false ? $sBuffer : substr($sBuffer,0,$nIdx);
}

function ProcessServer($hSock)
{
    for(;;)
    {
        $sData = socket_read($hSock,8192,PHP_BINARY_READ);

        if($sData===false)
        {
            break;
        }
        elseif($sData==='')
        {
            break;
        }

        $aHead = unpack('Ctype',$sData);

        switch($aHead['type'])
        {
            case HEADER_CA_LOGIN:
                $aPack = unpack('a16user/a16pass',substr($sData,2));

                printf("Login request from %s:%s\n",CString($aPack['user']),CString($aPack['pass']));
                socket_write($hSock,pack('vvVCVNva20',HEADER_AC_ACCEPT_LOGIN,39,0x12345678,0,2000001,ip2long('127.0.0.1'),7001,"Char"));
                break 2;  // disconnect
            default:
                for($nIdx = 0; $nIdx<strlen($sData); $nIdx++)
                {
                    printf("%02x ",ord(substr($sData,$nIdx,1)));
                }
                break;
        }
    }
}

function Main()
{
    printf("Account Server\n");

    $hSock = socket_create(AF_INET,SOCK_STREAM,SOL_TCP) or die;

    socket_bind($hSock,'0.0.0.0',7000) or die;
    socket_listen($hSock) or die;

    for(;;)
    {
        $hConn = socket_accept($hSock) or die;

        ProcessServer($hConn);

        socket_close($hConn);
    }

    socket_close($hSock);
}

Main();

?>