<?php

namespace App\Models;
use mysqli;

class CommandGenerator {

    private $db;

    public function __construct()
    {
        $this->db = new mysqli('localhost', env('DB_USERNAME'), env('DB_PASSWORD'), env('DB_DATABASE'));
    }
    
    public function entryDayMonth($channel,$value) {
        return $this->getSubEndDtCommand($channel,$value);
    }

    public function entryYear($channel,$value) {
        return $this->getSubEndYrCommand($channel,$value);
    }

    public function entryLoadLimit($channel,$value) {
        return "askjdhg";
    }

    public function entryMaxCurrent($channel,$value) {
        return "askjdhg";
    }

    public function entryMonthlyTariff($channel,$value) {
        return "askjdhg";
    }

    public function entryMonthlyWatts($channel,$value) {
        return str_replace(" ", "",$this->getWattsCommand($value,$channel));
    }

    public function entryOverloadDelayTime($channel,$value) {
        return "askjdhg";
    }

    public function entryTodOneStart($channel,$value) {
        return $this->getPkgStTimeCommand($channel,$value);
    }

    public function entryTodOneEnd($channel,$value) {
        return  $this->getPkgEdTimeCommand($channel,$value);
    }

    public function entryTodTwoStart($channel,$value) {
        return $this->getPkgTwoStTimeCommand($value,$channel);
    }

    public function entryTodTwoEnd($channel,$value) {
        return $this->getPkgTwoEdTimeCommand($value,$channel);
    }

    public function entryUnbalanceCurrent($channel,$value) {
        return $this->getUnbalanceCurrent($value,$channel);
    }

    private function getUnbalanceCurrent($value,$channel) {
        $this->setChannelHexa($channel);
        if($this->channelhexa) {
            return  $this->channelhexa." ".$this->valueAndCrc($this->channelhexa,$value);
        }
        return "";
    }

    private function getWattsCommand($pkgWatts,$ch) {
        $this->setChannelHexa($ch);
        if($this->channelhexa) {
            return  $this->channelhexa." ".$this->valueAndCrc($this->channelhexa,$pkgWatts);
        }
        return "";
    }

    private function valueAndCrc($hexa,$value) {
        $hexadecimal = dechex($value);
        $hexadecimal = str_pad($hexadecimal, 4, '0', STR_PAD_LEFT);
        return $hexadecimal;
     
    }
    
    private function getSubEndDtCommand($ch,$dayMonth) {
        $this->setDayMonthHexa($ch);
        if($this->dayMonthHexa) {
            return  $this->dayMonthHexa." ".$this->valueAndCrc($this->dayMonthHexa,$dayMonth);
        }
        return "";
    }

    private function getSubEndYrCommand($ch,$year) {
        $this->setYearHexa($ch);
        if($this->yearHexa) {
            return  $this->yearHexa." ".$this->valueAndCrc($this->yearHexa,$year);
        }
        return "";
    }

    private function getPkgStTimeCommand($time,$ch) {
        //setTodWriteString
        if(!$ch) {
            return "";
        }
        $this->setTodWriteString($ch);
        if($this->todWrOne) {
            return  $this->todWrOne." ".$this->valueAndCrc($this->todWrOne,$time);
        }
        return "";
    }

    private function getPkgEdTimeCommand($time,$ch) {
        if(!$ch) {
            return "";
        }
        $this->setTodWriteString($ch);
        if($this->todWrTwo) {
            return  $this->todWrTwo." ".$this->valueAndCrc($this->todWrTwo,$time);
        }
        //return $pkgEdTime;
    }

    private function getPkgTwoStTimeCommand($time,$ch) {
        //setTodWriteString
        if(!$ch) {
            return "";
        }
        $this->setTodWriteString($ch);
        if($this->todWrThree) {
            return  $this->todWrOne." ".$this->valueAndCrc($this->todWrOne,$time);
        }
        return "";
    }

    private function getPkgTwoEdTimeCommand($time,$ch) {
        if(!$ch) {
            return "";
        }
        $this->setTodWriteString($ch);
        if($this->todWrFour) {
            return  $this->todWrTwo." ".$this->valueAndCrc($this->todWrTwo,$time);
        }
        //return $pkgEdTime;
    }

    private $channelhexa = "";
    private function setChannelHexa($currentChannel) {
        
        switch ($currentChannel) {
            case 1:
                $this->channelhexa = "64060080";
                break;
            case 2:
                $this->channelhexa = "64060081";
                break;
            case 3:
                $this->channelhexa = "64060082";
                break;
            case 4:
                $this->channelhexa = "64060083";
                break;
            case 5:
                $this->channelhexa = "64060084";
                break;
            default:
                $this->channelhexa = "";
                break;
        }
    }

    private $dayMonthHexa = "";
    private function setDayMonthHexa($currentChannel) {
        
        switch ($currentChannel) {
            case 1:
                $this->dayMonthHexa = "64060087";
                break;
            case 2:
                $this->dayMonthHexa = "64060089";
                break;
            case 3:
                $this->dayMonthHexa = "6406008B";
                break;
            case 4:
                $this->dayMonthHexa = "6406008D";
                break;
            case 5:
                $this->dayMonthHexa = "6406008F";
                break;
            default:
                $this->dayMonthHexa = "";
                break;
        }
    }

    private $unbalanceCurrentHexa = "";
    private function setUnbalanceCurrentHexa($currentChannel) {
        
        switch ($currentChannel) {
            case 1:
                $this->unbalanceCurrentHexa = "64060087";
                break;
            case 2:
                $this->unbalanceCurrentHexa = "64060089";
                break;
            case 3:
                $this->unbalanceCurrentHexa = "6406008B";
                break;
            case 4:
                $this->unbalanceCurrentHexa = "6406008D";
                break;
            case 5:
                $this->unbalanceCurrentHexa = "6406008F";
                break;
            default:
                $this->unbalanceCurrentHexa = "";
                break;
        }
    }

    private $todWrOne = "";
    private $todWrTwo = ""; 
    private $todWrThree = "";
    private $todWrFour = "";

    private function setTodWriteString($channelBalanceId) {
        switch ($channelBalanceId) {
            case 1:
                $this->todWrOne = "64060090";
                $this->todWrTwo = "64060091";
                $this->todWrThree = "64060092";
                $this->todWrFour = "64060093";
                break;
            case 2:
                $this->todWrOne = "64060096";
                $this->todWrTwo = "64060097";
                $this->todWrThree = "64060098";
                $this->todWrFour = "64060099";
                break;
            case 3:
                $this->todWrOne = "6406009C";
                $this->todWrTwo = "6406009D";
                $this->todWrThree = "6406009E";
                $this->todWrFour = "6406009F";
                break;
            case 4:
                $this->todWrOne = "640600A2";
                $this->todWrTwo = "640600A3";
                $this->todWrThree = "640600A4";
                $this->todWrFour = "640600A5";
                break;
            case 5:
                $this->todWrOne = "640600A8";
                $this->todWrTwo = "640600A9";
                $this->todWrThree = "640600AA";
                $this->todWrFour = "640600AB";
                break;
        }
    }

    private $yearHexa = "";
    private function setYearHexa($currentChannel) {
        
        switch ($currentChannel) {
            case 1:
                $this->yearHexa = "64060086";
                break;
            case 2:
                $this->yearHexa = "64060088";
                break;
            case 3:
                $this->yearHexa = "6406008A";
                break;
            case 4:
                $this->yearHexa = "6406008C";
                break;
            case 5:
                $this->yearHexa = "6406008E";
                break;
            default:
                $this->yearHexa = "";
                break;
        }
    }

    private function crc16_modbus($msg) {
        $data = pack('H*',$msg);
        $crc = 0xFFFF;
        for ($i = 0; $i < strlen($data); $i++)
        {
            $crc ^=ord($data[$i]);

            for ($j = 8; $j !=0; $j--)
            {
                if (($crc & 0x0001) !=0)
                {
                    $crc >>= 1;
                    $crc ^= 0xA001;
                }
                else $crc >>= 1;
            }
        }   
        return sprintf('%04X', $crc);
    }

    private function saveCommand($meter,$command, $flag = "0") {
        $sql = "INSERT INTO `meter_commands` (`meter`, `command`, `flag`)
                VALUES ('".$meter."','".$command."','".$flag."')"; 

                if($r = mysqli_query($this->db, $sql)) {
                    $response = $r;
        }
    }


}