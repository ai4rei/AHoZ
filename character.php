<?php

set_time_limit(0);

define('HEADER_CH_ENTER',0x0001);  // <packet type>.W <aid>.L <auth code>.L <client type>.W <sex>.B
define('HEADER_CH_SELECT_CHAR',0x0002);  // <packet type>.W <charnum>.B
define('HEADER_CH_MAKE_CHAR',0x0003);  // <packet type>.W <name>.16B <str>.B <agi>.B <vit>.B <int>.B <dex>.B <luk>.B <charnum>.B <head>.B
define('HEADER_CH_DELETE_CHAR',0x0004);  // <packet type>.W <gid>.L
define('HEADER_HC_ACCEPT_ENTER',0x0007);  // <packet type>.W <packet len>.W { <gid>.L <exp>.L <money>.L <job exp>.L <>.L <>.L <>.L <job point>.W <hp>.W <max hp>.W <sp>.W <max sp>.W <>.W <>.W <>.W <name>.16B <job>.B <base level>.B <job level>.B <str>.B <agi>.B <vit>.B <int>.B <dex>.B <luk>.B <charnum>.B <>.L }*
define('HEADER_HC_REFUSE_ENTER',0x0008);
define('HEADER_HC_ACCEPT_MAKECHAR',0x0009);  // <packet type>.W <character info>.?B
define('HEADER_HC_REFUSE_MAKECHAR',0x000A);  // <packet type>.W <reason>.B
define('HEADER_HC_ACCEPT_DELETECHAR',0x000B);  // <packet type>.W
define('HEADER_HC_REFUSE_DELETECHAR',0x000C);  // <packet type>.W <reason>.B
define('HEADER_HC_NOTIFY_ZONESVR',0x000D);  // <packet type>.W <gid>.L <mapname>.16B <ip>.L <port>.W

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
            case HEADER_CH_ENTER:
                $aPack = unpack('Vaid/Vauthcode/vclienttype/Csex',substr($sData,2));

                printf("Enter request for AID:%u, AuthCode:%08x, Type: %u, Sex: %u\n",$aPack['aid'],$aPack['authcode'],$aPack['clienttype'],$aPack['sex']);

                socket_write($hSock,pack('vvVVVVVVVvvvvvvvva16CCCCCCCCCCV',HEADER_HC_ACCEPT_ENTER,78,150001,222222222,10,111111111,1,2,3,49,12,12,28,28,33,34,35,"Gravity Error",2 /* job */,99,50,99,99,99,99,99,99,0,4));
                break;
            case HEADER_CH_SELECT_CHAR:
                $aPack = unpack('Ccharnum',substr($sData,2));

                printf("Select character slot %u\n",$aPack['charnum']);

                socket_write($hSock,pack('vVa16Nv',HEADER_HC_NOTIFY_ZONESVR,150001,"prt_vilg00.gat",ip2long('127.0.0.1'),7002));
                break 2;  // disconnect
            case HEADER_CH_MAKE_CHAR:
                $aPack = unpack('a16name/Cstr/Cagi/Cvit/Cint/Cdex/Cluk/Ccharnum/chead',substr($sData,2));

                printf("Character '%s' Make Request, Stats: %u/%u/%u/%u/%u/%u, Slot: %u, Head: %u\n",CString($aPack['name']),$aPack['str'],$aPack['agi'],$aPack['vit'],$aPack['int'],$aPack['dex'],$aPack['luk'],$aPack['charnum'],$aPack['head']);

                socket_write($hSock,pack('vC',HEADER_HC_REFUSE_MAKECHAR,0));
                break;
            case HEADER_CH_DELETE_CHAR:
                $aPack = unpack('Vgid',substr($sData,2));

                printf("Character Delete Request for GID:%08x\n",$aPack['gid']);

                socket_write($hSock,pack('vC',HEADER_HC_REFUSE_DELETECHAR,0));
                break;
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
    printf("Character Server\n");

    $hSock = socket_create(AF_INET,SOCK_STREAM,SOL_TCP) or die;

    socket_bind($hSock,'0.0.0.0',7001) or die;

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