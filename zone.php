<?php

set_time_limit(0);

define('HEADER_CZ_ENTER',0x000E);  // <packet type>.W <aid>.L <cid>.L <auth code>.L <sex>.B
define('HEADER_ZC_ACCEPT_ENTER',0x000F);  // <packet type>.W <starttime>.L <posdir>.3B
//define('HEADER_ZC_REFUSE_ENTER',0x0010);  // TODO: probably wrong, isn't parsed
//define('HEADER_ZC_',0x0011);  // skipped
//define('HEADER_ZC_',0x0012);  // skipped
//define('HEADER_ZC_',0x0013);  // skipped
//define('HEADER_ZC_',0x0016);  // skipped
//define('HEADER_ZC_',0x0017);
//define('HEADER_ZC_',0x0018);
define('HEADER_CZ_NOTIFY_ACTORINIT',0x0019);  // <packet type>.W
define('HEADER_CZ_REQUEST_TIME',0x001A);  // <packet type>.W
define('HEADER_ZC_NOTIFY_TIME',0x001B);  // <packet type>.W <time>.L
//define('HEADER_ZC_',0x001C);
//define('HEADER_ZC_',0x001D);
//define('HEADER_ZC_',0x001F);  // skipped
//define('HEADER_ZC_',0x0020);  // skipped
define('HEADER_CZ_REQUEST_MOVE',0x0021);  // <packet type>.W <dest>.3B
define('HEADER_ZC_NOTIFY_MOVE',0x0022);  // <packet type>.W <gid>.L <move data>.6B <move start time>.L
define('HEADER_ZC_NOTIFY_PLAYERMOVE',0x0023);  // <packet type>.W <move start time>.L <move data>.6B
//define('HEADER_ZC_',0x0024);
define('HEADER_CZ_REQUEST_ACT',0x0025);  // <packet type>.W <target gid>.L <action>.B
define('HEADER_ZC_NOTIFY_ACT',0x0026);  // <packet type>.W <source gid>.L <target gid>.L <>.L <>.W <action>.B
define('HEADER_CZ_REQUEST_CHAT',0x0027);  // <packet type>.W <packet length>.W <text>.?S
define('HEADER_ZC_NOTIFY_CHAT',0x0028);  // <packet type>.W <>.?
define('HEADER_ZC_NOTIFY_PLAYERCHAT',0x0029);  // <packet type>.W <packet length>.W <>.?
//define('HEADER_CZ_',0x002B);  // <packet type>.W <>.L <>.B
//define('HEADER_ZC_',0x002C);
//define('HEADER_ZC_',0x002D);
//define('HEADER_ZC_',0x002E);
//define('HEADER_CZ_',0x002F);  // <packet type>.W <>.L
//define('HEADER_ZC_',0x0030);
//define('HEADER_ZC_',0x0032);
//define('HEADER_ZC_',0x0033);
define('HEADER_CZ_BROADCAST',0x0034);  // <packet type>.W <packet length>.W <text>.?S
define('HEADER_ZC_BROADCAST',0x0035);  // <packet type>.W <packet length>.W <text>.?S
define('HEADER_CZ_CHANGE_DIRECTION',0x0036);  // <packet type>.W <dir>.B
define('HEADER_ZC_CHANGE_DIRECTION',0x0037);  // <packet type>.W <aid>.L <dir>.B
//define('HEADER_ZC_',0x0038);
//define('HEADER_ZC_',0x0039);
//define('HEADER_ZC_',0x003B);
//define('HEADER_ZC_',0x003C);
//define('HEADER_ZC_',0x003E);
//define('HEADER_ZC_',0x003F);
//define('HEADER_ZC_',0x0040);
//define('HEADER_ZC_',0x0041);
//define('HEADER_ZC_',0x0043);
//define('HEADER_ZC_',0x0045);
define('HEADER_CZ_REQ_TAKEOFF_EQUIP',0x0046);  // <packet type>.W <index>.W
//define('HEADER_ZC_',0x0047);
//define('HEADER_ZC_',0x0049);
//define('HEADER_ZC_',0x004A);
//define('HEADER_ZC_',0x004B);
//define('HEADER_ZC_',0x004C);
//define('HEADER_ZC_',0x004E);
//define('HEADER_ZC_',0x004F);
//define('HEADER_ZC_',0x0050);
//define('HEADER_ZC_',0x0051);
//define('HEADER_ZC_',0x0052);
define('HEADER_CZ_STATUS_CHANGE',0x0056);  // <packet type>.W <statusid>.W <change amount>.B (type: 0xD-0x12 STR-LUK)
//define('HEADER_ZC_',0x0057);
//define('HEADER_ZC_',0x0058);
//define('HEADER_ZC_',0x0059);
define('HEADER_CZ_REQ_EMOTION',0x005A);  // <packet type>.W <type>.B
define('HEADER_ZC_EMOTION',0x005B);  // <packet type>.W <gid>.L <type>.B
//define('HEADER_ZC_',0x005D);
//define('HEADER_ZC_',0x005E);
//define('HEADER_ZC_',0x005F);
//define('HEADER_ZC_',0x0061);
//define('HEADER_ZC_',0x0062);
//define('HEADER_ZC_',0x0065);
//define('HEADER_ZC_',0x0066);
//define('HEADER_CZ_REQ_KILL',0x0067);  // <packet type>.W <target name>.16S
//define('HEADER_ZC_ACK_KILL',0x0068);  // <packet type>.W
//define('HEADER_CZ_',0x006A);  // <packet type>.W <>.L <>.L <>.L <>.L <>.B
//define('HEADER_ZC_',0x006C);
//define('HEADER_ZC_',0x006D);
//define('HEADER_ZC_',0x006F);
define('HEADER_CZ_CREATE_CHATROOM',0x0070);  // <packet type>.W <packet length>.W <size>.W <type>.B <passwd>.8B <title>.?B
//define('HEADER_ZC_',0x0071);
//define('HEADER_ZC_',0x0072);
//define('HEADER_ZC_',0x0073);
//define('HEADER_ZC_',0x0075);
//define('HEADER_ZC_',0x0076);
//define('HEADER_ZC_',0x0077);
//define('HEADER_ZC_',0x0078);
//define('HEADER_ZC_',0x007A);
//define('HEADER_ZC_',0x007C);
//define('HEADER_ZC_',0x0080);
//define('HEADER_ZC_',0x0082);
//define('HEADER_ZC_',0x0084);
//define('HEADER_ZC_',0x0085);
//define('HEADER_ZC_',0x0087);
//define('HEADER_ZC_',0x0089);
//define('HEADER_ZC_',0x008B);
//define('HEADER_ZC_',0x008C);
//define('HEADER_ZC_',0x008D);
//define('HEADER_ZC_',0x008F);
//define('HEADER_ZC_',0x0091);
//define('HEADER_ZC_',0x0093);
//define('HEADER_ZC_',0x0095);
//define('HEADER_ZC_',0x0096);
//define('HEADER_ZC_',0x0098);
//define('HEADER_ZC_',0x0099);
//define('HEADER_ZC_',0x009D);
//define('HEADER_ZC_',0x009E);
//define('HEADER_ZC_',0x009F);
//define('HEADER_ZC_',0x00A0);
//define('HEADER_ZC_',0x00A2);
//define('HEADER_ZC_',0x00A3);
//define('HEADER_ZC_',0x00A4);
//define('HEADER_ZC_',0x00A5);
//define('HEADER_ZC_',0x00A6);
//define('HEADER_ZC_',0x00A7);
//define('HEADER_ZC_',0x00A8);
//define('HEADER_ZC_',0x00A9);
//define('HEADER_ZC_',0x00AA);

//define('HEADER_CZ_',0x00);  // <packet type>.W


define('MAX_SEC',0x7FFFFFFF/1000);

function GetTickCount()
{
    $aTime = explode(' ',microtime());

    return ceil(($aTime[0]+($aTime[1]%MAX_SEC))*1000);
}

function CString($sBuffer)
{
    $nIdx = strpos($sBuffer,chr(0));

    return $nIdx===false ? $sBuffer : substr($sBuffer,0,$nIdx);
}

function MakePosDir($nX,$nY,$nDir)
{
    return array(
        (($nX>>2)&0xFF),
        (($nX<<6)&0xC0)|(($nY>>4)&0x3F),
        (($nY<<4)&0xF0)|($nDir&0x0F),
    );
}

function BreakPosDir($nN1,$nN2,$nN3)
{
    return array(
        ($nN1<<2)|($nN2>>6),
        (($nN2&0x3F)<<4)|($nN3>>4),
        ($nN3&0x0F),
    );
}

function MakeMoveData($nXFrom,$nYFrom,$nXTo,$nYTo,$nUNK0,$nUNK1)
{
    return array(
        ($nXFrom&0xFF)>>2,
        (($nXFrom<<6)&0xC0)|(($nYFrom>>4)&0x3F),
        (($nYFrom<<4)&0xF0)|(($nXTo>>6)&0x0F),
        (($nXTo<<2)&0xFC)|(($nYTo>>8)&0x03),
        $nYTo&0xFF,
        (($nUNK0<<4)&0xF0)|($nUNK1&0xF),
    );
}

function ProcessServer($hSock)
{
    $nGid = 0;
    $nCid = 0;
    $nCurX = 99;
    $nCurY = 94;

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
            case HEADER_CZ_ENTER:
                $aPack = unpack('Vaid/Vcid/Vauthcode/Csex',substr($sData,2));

                printf("Enter request for AID/CID:%u/%u, AuthCode:%08x, Sex: %u\n",$aPack['aid'],$aPack['cid'],$aPack['authcode'],$aPack['sex']);
                $nGid = $aPack['aid'];
                $nCid = $aPack['cid'];

                $PosDir = MakePosDir($nCurX,$nCurY,0);

                socket_write($hSock,pack('vVCCCCC',HEADER_ZC_ACCEPT_ENTER,GetTickCount(),$PosDir[0],$PosDir[1],$PosDir[2],0,0));
                break;
            case HEADER_CZ_NOTIFY_ACTORINIT:
                printf("Actor initialized\n");
                break;
            case HEADER_CZ_REQUEST_TIME:
                printf("Timestamp request\n");
                socket_write($hSock,pack('vV',HEADER_ZC_NOTIFY_TIME,GetTickCount()));
                break;
            case HEADER_CZ_REQUEST_MOVE:
                $aPack = unpack('C3',substr($sData,2));

                list($nX,$nY,$nDir) = BreakPosDir($aPack['1'],$aPack['2'],$aPack['3']);

                printf("Move to: %u,%u\n",$nX,$nY);

                $MoveData = MakeMoveData($nCurX,$nCurY,$nX,$nY,8,8);
                list($nCurX,$nCurY) = array($nX,$nY);

                socket_write($hSock,pack('vVCCCCCC',HEADER_ZC_NOTIFY_PLAYERMOVE,GetTickCount(),$MoveData[0],$MoveData[1],$MoveData[2],$MoveData[3],$MoveData[4],$MoveData[5]));
                break;
            case HEADER_CZ_REQUEST_ACT:
                $aPack = unpack('Vgid/Caction',substr($sData,2));

                printf("Action: %u, Target: %u\n",$aPack['action'],$aPack['gid']);

                socket_write($hSock,pack('vVVVvC',HEADER_ZC_NOTIFY_ACT,$nGid,$aPack['gid'],GetTickCount(),0,$aPack['action']));
                break;
            case HEADER_CZ_REQUEST_CHAT:
                $aPack = unpack('vlength',substr($sData,2));
                $aPack = unpack('a'.($aPack['length']-4).'text',substr($sData,4));

                printf("Chat: %s\n", $aPack['text']);

                if(substr(strstr($aPack['text'],':'),2,1)==='!')
                {
                    socket_write($hSock,pack('vVVVvC',HEADER_ZC_NOTIFY_ACT,$nGid,$nGid,GetTickCount(),10,0));
                    break;
                }

                socket_write($hSock,pack('vva'.(strlen($aPack['text'])+1),HEADER_ZC_NOTIFY_PLAYERCHAT,strlen($aPack['text'])+5,$aPack['text']));
                break;
            case HEADER_CZ_CHANGE_DIRECTION:
                $aPack = unpack('Cdir',substr($sData,2));

                socket_write($hSock,pack('vVC',HEADER_ZC_CHANGE_DIRECTION,$nGid,$aPack['dir']));
                break;
            case HEADER_CZ_REQ_EMOTION:
                $aPack = unpack('Ctype',substr($sData,2));

                socket_write($hSock,pack('vVC',HEADER_ZC_EMOTION,$nGid,$aPack['type']));
                break;
            case HEADER_CZ_BROADCAST:
                $aPack = unpack('vlength',substr($sData,2));
                $aPack = unpack('a'.($aPack['length']-4).'text',substr($sData,4));

                printf("Broadcast: %s\n", $aPack['text']);

                socket_write($hSock,pack('vva'.(strlen($aPack['text'])+1),HEADER_ZC_BROADCAST,strlen($aPack['text'])+5,$aPack['text']));
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
    printf("Zone Server\n");

    $hSock = socket_create(AF_INET,SOCK_STREAM,SOL_TCP) or die;

    socket_bind($hSock,'0.0.0.0',7002) or die;

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
